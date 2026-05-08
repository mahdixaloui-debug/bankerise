<?php
/* ============================================
   API: Partner Profile — GET / PUT
   ============================================ */
require_once __DIR__ . '/../config/auth.php';
requireLogin();

$user = currentUser();
$partnerId = $user['partner_id'] ?? null;
if (!$partnerId) jsonResponse(['error' => 'No partner record linked to this user.'], 404);

$db = getDB();
$method = getMethod();

if ($method === 'GET') {
    $stmt = $db->prepare('SELECT p.*, u.email AS account_email FROM partners p JOIN users u ON u.id = ? WHERE p.id = ?');
    $stmt->execute([$user['id'], $partnerId]);
    $p = $stmt->fetch();
    if (!$p) jsonResponse(['error' => 'Partner not found.'], 404);
    jsonResponse(['partner' => $p, 'user' => ['id' => $user['id'], 'full_name' => $user['full_name'], 'email' => $user['email']]]);
}

if ($method === 'PUT') {
    $data = getJsonBody();
    $name     = trim($data['name'] ?? '');
    $email    = trim($data['email'] ?? '');
    $phone    = trim($data['phone'] ?? '');
    $country  = trim($data['country'] ?? '');
    $company  = trim($data['company'] ?? '');
    $industry = trim($data['industry'] ?? '');
    $size     = trim($data['company_size'] ?? '');
    $website  = trim($data['website'] ?? '');
    $region   = trim($data['region'] ?? '');

    if ($name === '' || $email === '' || $company === '') {
        jsonResponse(['error' => 'Name, email and company are required.'], 400);
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        jsonResponse(['error' => 'Invalid email address.'], 400);
    }

    $stmt = $db->prepare('UPDATE partners SET name=?, email=?, phone=?, country=?, company=?, industry=?, company_size=?, website=?, region=?, updated_at=NOW() WHERE id=?');
    $stmt->execute([$name, $email, $phone, $country, $company, $industry, $size, $website, $region, $partnerId]);

    $stmt = $db->prepare('UPDATE users SET full_name=?, email=? WHERE id=?');
    $stmt->execute([$name, $email, $user['id']]);

    $_SESSION['user_name']  = $name;
    $_SESSION['user_email'] = $email;

    logActivity($user['id'], 'update', 'Partner profile updated', 'partner', $partnerId);
    jsonResponse(['success' => true, 'message' => 'Profile updated.']);
}

jsonResponse(['error' => 'Method not allowed'], 405);
