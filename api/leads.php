<?php
/* ============================================
   API: Partner Leads — GET (list) / POST (create)
   ============================================ */
require_once __DIR__ . '/../config/auth.php';
requireLogin();

$user = currentUser();
$db = getDB();
$method = getMethod();

// Admin can view any partner's leads via ?partner_id=N
if ($method === 'GET' && isAdmin() && !empty($_GET['partner_id'])) {
    $pid = (int)$_GET['partner_id'];
    $stmt = $db->prepare('SELECT * FROM leads WHERE partner_id = ? ORDER BY created_at DESC');
    $stmt->execute([$pid]);
    $leads = $stmt->fetchAll();
    jsonResponse(['leads' => $leads, 'total' => count($leads)]);
}

$partnerId = $user['partner_id'] ?? null;
if (!$partnerId) jsonResponse(['error' => 'No partner record linked to this user.'], 404);

if ($method === 'GET') {
    $stmt = $db->prepare('SELECT * FROM leads WHERE partner_id = ? ORDER BY created_at DESC');
    $stmt->execute([$partnerId]);
    $leads = $stmt->fetchAll();
    jsonResponse(['leads' => $leads, 'total' => count($leads)]);
}

if ($method === 'POST') {
    $d = getJsonBody();
    $company = trim($d['company_name'] ?? '');
    $fname   = trim($d['contact_first_name'] ?? '');
    $email   = trim($d['contact_email'] ?? '');
    if ($company === '' || $fname === '' || $email === '') {
        jsonResponse(['error' => 'Company, first name and email are required.'], 400);
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        jsonResponse(['error' => 'Invalid contact email.'], 400);
    }

    $projectTypes = $d['project_types'] ?? [];
    if (is_array($projectTypes)) $projectTypes = implode(', ', $projectTypes);

    $stmt = $db->prepare('INSERT INTO leads
        (partner_id, company_name, industry, company_size, website, country,
         contact_first_name, contact_last_name, contact_title, contact_email, contact_phone,
         project_types, budget_range, timeline, decision_maker, notes, status)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, "Pending")');
    $stmt->execute([
        $partnerId,
        $company,
        trim($d['industry'] ?? ''),
        trim($d['company_size'] ?? ''),
        trim($d['website'] ?? ''),
        trim($d['country'] ?? ''),
        $fname,
        trim($d['contact_last_name'] ?? ''),
        trim($d['contact_title'] ?? ''),
        $email,
        trim($d['contact_phone'] ?? ''),
        $projectTypes,
        trim($d['budget_range'] ?? ''),
        trim($d['timeline'] ?? ''),
        !empty($d['decision_maker']) ? 1 : 0,
        trim($d['notes'] ?? ''),
    ]);
    $leadId = (int)$db->lastInsertId();
    logActivity($user['id'], 'lead_create', 'Lead reserved: ' . $company, 'lead', $leadId);
    notifyAdmins(
        'New lead submitted',
        ($user['full_name'] ?? 'Partner') . ' reserved: ' . $company,
        'lead',
        '#partners'
    );
    // Confirmation notification to the partner themselves
    notify(
        $user['id'],
        'Lead reserved',
        '“' . $company . '” has been added to your pipeline.',
        'success',
        '#leads'
    );
    jsonResponse(['success' => true, 'id' => $leadId]);
}

jsonResponse(['error' => 'Method not allowed'], 405);
