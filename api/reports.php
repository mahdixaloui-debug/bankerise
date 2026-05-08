<?php
/* ============================================
   API: Partner Reports — GET (list) / POST (send)
   ============================================ */
require_once __DIR__ . '/../config/auth.php';
requireLogin();

$user = currentUser();
$db = getDB();
$method = getMethod();

// Admin can view any partner's reports via ?partner_id=N
if ($method === 'GET' && isAdmin() && !empty($_GET['partner_id'])) {
    $pid = (int)$_GET['partner_id'];
    $stmt = $db->prepare('SELECT * FROM reports WHERE partner_id = ? ORDER BY created_at DESC');
    $stmt->execute([$pid]);
    jsonResponse(['reports' => $stmt->fetchAll()]);
}

// Admin can view all reports across all partners via ?all=1
if ($method === 'GET' && isAdmin() && !empty($_GET['all'])) {
    $stmt = $db->query('SELECT r.*, p.name AS partner_name, p.company AS partner_company, p.tier AS partner_tier
                        FROM reports r
                        LEFT JOIN partners p ON p.id = r.partner_id
                        ORDER BY r.created_at DESC');
    jsonResponse(['reports' => $stmt->fetchAll()]);
}

$partnerId = $user['partner_id'] ?? null;
if (!$partnerId) jsonResponse(['error' => 'No partner record linked to this user.'], 404);

if ($method === 'GET') {
    $stmt = $db->prepare('SELECT * FROM reports WHERE partner_id = ? ORDER BY created_at DESC');
    $stmt->execute([$partnerId]);
    jsonResponse(['reports' => $stmt->fetchAll()]);
}

if ($method === 'POST') {
    $d = getJsonBody();
    $title   = trim($d['title'] ?? '');
    $period  = trim($d['period'] ?? '');
    $type    = trim($d['type'] ?? 'Activity');
    $content = trim($d['content'] ?? '');

    if ($title === '' || $content === '') {
        jsonResponse(['error' => 'Title and content are required.'], 400);
    }
    $validTypes = ['Sales','Activity','Pipeline','Performance','Other'];
    if (!in_array($type, $validTypes)) $type = 'Activity';

    $stmt = $db->prepare('INSERT INTO reports (partner_id, title, period, type, content, status) VALUES (?,?,?,?,?, "Sent")');
    $stmt->execute([$partnerId, $title, $period, $type, $content]);
    $id = (int)$db->lastInsertId();

    // Resolve partner display name for richer audit trail
    $pnStmt = $db->prepare('SELECT name, company FROM partners WHERE id = ?');
    $pnStmt->execute([$partnerId]);
    $pInfo = $pnStmt->fetch() ?: ['name' => $user['full_name'] ?? 'Partner', 'company' => ''];
    $partnerName = $pInfo['name'];
    $partnerCompany = $pInfo['company'] ?? '';

    logActivity($user['id'], 'report_send', $partnerName . ' sent a ' . $type . ' report: ' . $title, 'report', $id);
    notifyAdmins(
        'New report from ' . $partnerName,
        $title . ($period ? ' · ' . $period : '') . ($partnerCompany ? ' · ' . $partnerCompany : ''),
        'report',
        '#reports'
    );
    // Confirmation notification to the partner themselves
    notify(
        $user['id'],
        'Report submitted',
        '“' . $title . '” was delivered to the Bankerise team.',
        'success',
        '#reports'
    );
    jsonResponse(['success' => true, 'id' => $id]);
}

jsonResponse(['error' => 'Method not allowed'], 405);
