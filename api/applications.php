<?php
/* ============================================
   API: Applications
   ============================================ */
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/smtp.php';

$method = getMethod();
$db = getDB();

// Lazy migration — ensure applications.requested_tier exists
try {
    $col = $db->query("SHOW COLUMNS FROM applications LIKE 'requested_tier'")->fetch();
    if (!$col) {
        $db->exec("ALTER TABLE applications ADD COLUMN requested_tier ENUM('Bronze','Silver','Gold') DEFAULT 'Bronze' AFTER partner_type");
    }
} catch (Throwable $e) { /* ignore — surfaces in real queries */ }

// ─── GET — List applications (admin) ─────
if ($method === 'GET') {
    if (!isAdmin()) jsonResponse(['error' => 'Forbidden'], 403);

    $status = $_GET['status'] ?? '';
    $query = 'SELECT * FROM applications';
    $params = [];

    if ($status) {
        $query .= ' WHERE status = ?';
        $params[] = $status;
    }

    $query .= ' ORDER BY created_at DESC';
    $stmt = $db->prepare($query);
    $stmt->execute($params);
    jsonResponse($stmt->fetchAll());
}

// ─── POST — Submit new application (public) ─
if ($method === 'POST') {
    $data = getJsonBody();

    // Validate required fields
    $required = ['company_name', 'contact_name', 'contact_email'];
    foreach ($required as $field) {
        if (empty($data[$field])) {
            jsonResponse(['error' => "Field '{$field}' is required."], 400);
        }
    }

    // Validate email
    if (!filter_var($data['contact_email'], FILTER_VALIDATE_EMAIL)) {
        jsonResponse(['error' => 'Invalid email address.'], 400);
    }

    $tier = sanitize($data['requested_tier'] ?? 'Bronze');
    if (!in_array($tier, ['Bronze', 'Silver', 'Gold'], true)) $tier = 'Bronze';

    $stmt = $db->prepare('INSERT INTO applications (company_name, website, country, company_size, partner_type, requested_tier, contact_name, contact_email, contact_phone, message) VALUES (?,?,?,?,?,?,?,?,?,?)');
    $stmt->execute([
        sanitize($data['company_name']),
        sanitize($data['website'] ?? ''),
        sanitize($data['country'] ?? ''),
        sanitize($data['company_size'] ?? ''),
        sanitize($data['partner_type'] ?? ''),
        $tier,
        sanitize($data['contact_name']),
        sanitize($data['contact_email']),
        sanitize($data['contact_phone'] ?? ''),
        sanitize($data['message'] ?? ''),
    ]);

    // Log
    $appId = (int)$db->lastInsertId();
    logActivity(null, 'apply', 'New application from ' . sanitize($data['contact_name']), 'application', $appId);

    // Notify admins
    notifyAdmins(
        'New partner application',
        sanitize($data['contact_name']) . ' from ' . sanitize($data['company_name']) . ' applied.',
        'application',
        '#applications'
    );

    jsonResponse(['success' => true, 'message' => 'Application submitted successfully.'], 201);
}

// ─── PUT — Update application status (admin) ─
if ($method === 'PUT') {
    if (!isAdmin()) jsonResponse(['error' => 'Forbidden'], 403);

    $data = getJsonBody();
    $id     = (int)($data['id'] ?? 0);
    $status = sanitize($data['status'] ?? '');

    if (!$id) jsonResponse(['error' => 'Application ID required'], 400);

    $valid = ['Pending', 'Reviewed', 'Approved', 'Rejected'];
    if (!in_array($status, $valid)) {
        jsonResponse(['error' => 'Invalid status'], 400);
    }

    // Fetch the full application BEFORE the status update so we can promote it
    $row = $db->prepare('SELECT * FROM applications WHERE id=?');
    $row->execute([$id]);
    $app = $row->fetch();
    if (!$app) jsonResponse(['error' => 'Application not found'], 404);

    $db->prepare('UPDATE applications SET status = ? WHERE id = ?')->execute([$status, $id]);

    $action = $status === 'Approved' ? 'accept' : ($status === 'Rejected' ? 'decline' : ($status === 'Reviewed' ? 'stall' : 'review_app'));
    logActivity($_SESSION['user_id'], $action, "Application #{$id} marked as {$status}", 'application', $id);

    // When an application is approved, automatically create the matching partner
    // record + a partner user so they can log in. This is what makes the
    // apply → approve → login flow work end-to-end.
    $autoCreds  = null;
    $newPartnerId = null;
    if ($status === 'Approved' && !empty($app['contact_email'])) {
        // Don't double-create if a partner already exists for this email
        $existing = $db->prepare('SELECT id FROM partners WHERE email = ? LIMIT 1');
        $existing->execute([$app['contact_email']]);
        $found = $existing->fetch();

        if ($found) {
            $newPartnerId = (int)$found['id'];
        } else {
            // Map the application's partner_type label onto the partners.type enum
            $rawType = (string)($app['partner_type'] ?? '');
            $type = 'Banking Decision Maker';
            if (stripos($rawType, 'Integrator') !== false || stripos($rawType, 'Implementation') !== false) {
                $type = 'Local Integrator';
            } elseif (stripos($rawType, 'Technology') !== false || stripos($rawType, 'IT') !== false) {
                $type = 'IT Manager';
            }
            $sizeRaw = (string)($app['company_size'] ?? '');
            $size = '';
            if (preg_match('/(1-10|11-50|51-200|200\+)/', $sizeRaw, $m)) $size = $m[1];

            $reqTier = $app['requested_tier'] ?? 'Bronze';
            if (!in_array($reqTier, ['Bronze', 'Silver', 'Gold'], true)) $reqTier = 'Bronze';

            $ins = $db->prepare('INSERT INTO partners (name, email, phone, country, company, company_size, website, type, tier, status, progress) VALUES (?,?,?,?,?,?,?,?,?, "Accepted", 85)');
            $ins->execute([
                $app['contact_name'],
                $app['contact_email'],
                $app['contact_phone'] ?? '',
                $app['country'] ?? '',
                $app['company_name'],
                $size,
                $app['website'] ?? '',
                $type,
                $reqTier,
            ]);
            $newPartnerId = (int)$db->lastInsertId();
            logActivity($_SESSION['user_id'], 'create', 'Partner created from application: ' . $app['company_name'], 'partner', $newPartnerId);
        }

        // Auto-provision the partner user (mirror of partner-status.php logic)
        $u = $db->prepare('SELECT id FROM users WHERE partner_id = ? OR email = ? LIMIT 1');
        $u->execute([$newPartnerId, $app['contact_email']]);
        $existingUser = $u->fetch();
        if (!$existingUser) {
            $tempPass = bin2hex(random_bytes(4)); // 8-char temp password
            $hash = password_hash($tempPass, PASSWORD_DEFAULT);
            try {
                $userIns = $db->prepare('INSERT INTO users (full_name, email, password_hash, role, partner_id, is_active) VALUES (?, ?, ?, "partner", ?, 1)');
                $userIns->execute([$app['contact_name'], $app['contact_email'], $hash, $newPartnerId]);
                $autoCreds = ['email' => $app['contact_email'], 'password' => $tempPass];
            } catch (Exception $e) { /* email collision — ignore */ }
        } else {
            $db->prepare('UPDATE users SET partner_id = ?, is_active = 1 WHERE id = ?')
               ->execute([$newPartnerId, $existingUser['id']]);
        }
    }

    notifyAdmins(
        "Application {$status}",
        ($app['contact_name'] ?? '') . ' — ' . ($app['company_name'] ?? ''),
        'application',
        '#applications'
    );

    // Send the welcome email with the temporary password
    $emailSent = false;
    $emailError = null;
    if ($autoCreds) {
        $r = sendPartnerWelcomeEmail($autoCreds['email'], $app['contact_name'] ?? '', $autoCreds['password']);
        $emailSent  = $r['success'];
        $emailError = $r['success'] ? null : $r['error'];
        logActivity($_SESSION['user_id'], $emailSent ? 'email_sent' : 'email_failed',
            ($emailSent ? 'Welcome email sent to ' : 'Welcome email FAILED for ') . $autoCreds['email'],
            'partner', $newPartnerId);
    }

    jsonResponse([
        'success'     => true,
        'partner_id'  => $newPartnerId,
        'login'       => $autoCreds,
        'email_sent'  => $emailSent,
        'email_error' => $emailError,
    ]);
}

jsonResponse(['error' => 'Method not allowed'], 405);
