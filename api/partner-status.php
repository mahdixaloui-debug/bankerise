<?php
/* ============================================
   API: Partner Status Change (Accept/Stall/Decline)
   ============================================ */
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/smtp.php';

requireMethod('PUT');
if (!isAdmin()) jsonResponse(['error' => 'Forbidden'], 403);

$data = getJsonBody();
$id     = (int)($data['id'] ?? 0);
$status = sanitize($data['status'] ?? '');

if (!$id) jsonResponse(['error' => 'Partner ID required'], 400);

$validStatuses = ['Accepted', 'Stalled', 'Declined', 'Pending'];
if (!in_array($status, $validStatuses)) {
    jsonResponse(['error' => 'Invalid status. Must be: ' . implode(', ', $validStatuses)], 400);
}

$db = getDB();

// Get current partner data
$stmt = $db->prepare('SELECT name, email, progress FROM partners WHERE id = ?');
$stmt->execute([$id]);
$partner = $stmt->fetch();
if (!$partner) jsonResponse(['error' => 'Partner not found'], 404);

// Auto-provision a partner user account when accepted (so they can log in and receive notifications)
$autoCreds = null;
if ($status === 'Accepted' && !empty($partner['email'])) {
    $u = $db->prepare('SELECT id FROM users WHERE partner_id = ? OR email = ? LIMIT 1');
    $u->execute([$id, $partner['email']]);
    if (!$u->fetch()) {
        $tempPass = bin2hex(random_bytes(4)); // 8-char temp password
        $hash = password_hash($tempPass, PASSWORD_DEFAULT);
        try {
            $ins = $db->prepare('INSERT INTO users (full_name, email, password_hash, role, partner_id, is_active) VALUES (?, ?, ?, "partner", ?, 1)');
            $ins->execute([$partner['name'], $partner['email'], $hash, $id]);
            $autoCreds = ['email' => $partner['email'], 'password' => $tempPass];
        } catch (Exception $e) { /* email may collide — ignore */ }
    } else {
        // Ensure an existing orphan user is linked to this partner
        $db->prepare('UPDATE users SET partner_id = ?, is_active = 1 WHERE email = ? AND (partner_id IS NULL OR partner_id = ?)')
           ->execute([$id, $partner['email'], $id]);
    }
}

// Adjust progress based on status
$progress = $partner['progress'];
if ($status === 'Accepted')  $progress = max($progress, 85);
if ($status === 'Declined')  $progress = min($progress, 20);
if ($status === 'Stalled')   $progress = min($progress, 50);

// Update
$stmt = $db->prepare('UPDATE partners SET status = ?, progress = ?, updated_at = NOW() WHERE id = ?');
$stmt->execute([$status, $progress, $id]);

// Log activity
$actionMap = ['Accepted' => 'accept', 'Declined' => 'decline', 'Stalled' => 'stall', 'Pending' => 'pending'];
$action = $actionMap[$status] ?? 'update';
logActivity($_SESSION['user_id'], $action, 'Partner ' . $partner['name'] . ' was ' . strtolower($status), 'partner', $id);

// Notify admins (audit)
notifyAdmins(
    'Partner ' . strtolower($status),
    $partner['name'] . ' was marked as ' . strtolower($status) . '.',
    'partner',
    '#partners'
);

// Notify the partner themselves
$typeMap = ['Accepted'=>'success','Declined'=>'warning','Stalled'=>'info','Pending'=>'info'];
notifyPartner(
    $id,
    'Your partner status is now ' . $status,
    'An admin updated your account status.',
    $typeMap[$status] ?? 'info',
    '#profile'
);

// Send the welcome email with the temporary password
$emailSent = false;
$emailError = null;
if ($autoCreds) {
    $r = sendPartnerWelcomeEmail($autoCreds['email'], $partner['name'] ?? '', $autoCreds['password']);
    $emailSent  = $r['success'];
    $emailError = $r['success'] ? null : $r['error'];
    logActivity($_SESSION['user_id'], $emailSent ? 'email_sent' : 'email_failed',
        ($emailSent ? 'Welcome email sent to ' : 'Welcome email FAILED for ') . $autoCreds['email'],
        'partner', $id);
}

jsonResponse([
    'success'     => true,
    'status'      => $status,
    'progress'    => $progress,
    'login'       => $autoCreds,
    'email_sent'  => $emailSent,
    'email_error' => $emailError,
]);
