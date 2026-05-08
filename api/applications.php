<?php
/* ============================================
   API: Applications
   ============================================ */
require_once __DIR__ . '/../config/auth.php';

$method = getMethod();
$db = getDB();

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

    $stmt = $db->prepare('INSERT INTO applications (company_name, website, country, company_size, partner_type, contact_name, contact_email, contact_phone, message) VALUES (?,?,?,?,?,?,?,?,?)');
    $stmt->execute([
        sanitize($data['company_name']),
        sanitize($data['website'] ?? ''),
        sanitize($data['country'] ?? ''),
        sanitize($data['company_size'] ?? ''),
        sanitize($data['partner_type'] ?? ''),
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

    $db->prepare('UPDATE applications SET status = ? WHERE id = ?')->execute([$status, $id]);

    $action = $status === 'Approved' ? 'accept' : ($status === 'Rejected' ? 'decline' : ($status === 'Reviewed' ? 'stall' : 'review_app'));
    logActivity($_SESSION['user_id'], $action, "Application #{$id} marked as {$status}", 'application', $id);

    // Notify all admins so the team sees the decision
    $row = $db->prepare('SELECT contact_name, company_name FROM applications WHERE id=?');
    $row->execute([$id]);
    $app = $row->fetch();
    if ($app) {
        notifyAdmins(
            "Application {$status}",
            ($app['contact_name'] ?? '') . ' — ' . ($app['company_name'] ?? ''),
            'application',
            '#applications'
        );
    }

    jsonResponse(['success' => true]);
}

jsonResponse(['error' => 'Method not allowed'], 405);
