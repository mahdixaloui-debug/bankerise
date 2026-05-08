<?php
/* ============================================
   API: Partners CRUD
   ============================================ */
require_once __DIR__ . '/../config/auth.php';

$method = getMethod();
$db = getDB();

// ─── GET — List or single partner ────────
if ($method === 'GET') {
    // Public directory endpoint
    if (isset($_GET['public']) && $_GET['public'] == '1') {
        $stmt = $db->query("SELECT id, name, company, country, region, type, tier FROM partners WHERE status = 'Accepted' ORDER BY name");
        jsonResponse($stmt->fetchAll());
    }

    // Admin: require login
    if (!isLoggedIn()) jsonResponse(['error' => 'Unauthorized'], 401);

    // Single partner by ID
    if (isset($_GET['id'])) {
        $stmt = $db->prepare('SELECT * FROM partners WHERE id = ?');
        $stmt->execute([(int)$_GET['id']]);
        $partner = $stmt->fetch();
        if (!$partner) jsonResponse(['error' => 'Partner not found'], 404);
        jsonResponse($partner);
    }

    // All partners (admin only)
    if (!isAdmin()) jsonResponse(['error' => 'Forbidden'], 403);

    $query = 'SELECT * FROM partners WHERE 1=1';
    $params = [];

    if (!empty($_GET['tier'])) {
        $query .= ' AND tier = ?';
        $params[] = $_GET['tier'];
    }
    if (!empty($_GET['type'])) {
        $query .= ' AND type = ?';
        $params[] = $_GET['type'];
    }
    if (!empty($_GET['status'])) {
        $query .= ' AND status = ?';
        $params[] = $_GET['status'];
    }
    if (!empty($_GET['search'])) {
        $query .= ' AND (name LIKE ? OR company LIKE ?)';
        $s = '%' . $_GET['search'] . '%';
        $params[] = $s;
        $params[] = $s;
    }

    $query .= ' ORDER BY created_at DESC';
    $stmt = $db->prepare($query);
    $stmt->execute($params);
    jsonResponse($stmt->fetchAll());
}

// ─── POST — Create partner ──────────────
if ($method === 'POST') {
    if (!isAdmin()) jsonResponse(['error' => 'Forbidden'], 403);

    $data = getJsonBody();
    $stmt = $db->prepare('INSERT INTO partners (name, email, phone, country, company, industry, company_size, website, region, type, tier, status, progress, admin_notes) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $stmt->execute([
        sanitize($data['name'] ?? ''),
        sanitize($data['email'] ?? ''),
        sanitize($data['phone'] ?? ''),
        sanitize($data['country'] ?? ''),
        sanitize($data['company'] ?? ''),
        sanitize($data['industry'] ?? ''),
        sanitize($data['company_size'] ?? ''),
        sanitize($data['website'] ?? ''),
        sanitize($data['region'] ?? ''),
        sanitize($data['type'] ?? 'Banking Decision Maker'),
        sanitize($data['tier'] ?? 'Bronze'),
        sanitize($data['status'] ?? 'Pending'),
        (int)($data['progress'] ?? 0),
        sanitize($data['admin_notes'] ?? ''),
    ]);

    $id = $db->lastInsertId();
    logActivity($_SESSION['user_id'], 'create', 'Created partner: ' . ($data['name'] ?? ''), 'partner', $id);
    jsonResponse(['success' => true, 'id' => $id], 201);
}

// ─── PUT — Update partner ───────────────
if ($method === 'PUT') {
    if (!isAdmin()) jsonResponse(['error' => 'Forbidden'], 403);

    $data = getJsonBody();
    $id = (int)($data['id'] ?? 0);
    if (!$id) jsonResponse(['error' => 'Partner ID required'], 400);

    $stmt = $db->prepare('UPDATE partners SET name=?, email=?, phone=?, country=?, company=?, industry=?, company_size=?, website=?, region=?, type=?, tier=?, status=?, progress=?, admin_notes=?, updated_at=NOW() WHERE id=?');
    $stmt->execute([
        sanitize($data['name'] ?? ''),
        sanitize($data['email'] ?? ''),
        sanitize($data['phone'] ?? ''),
        sanitize($data['country'] ?? ''),
        sanitize($data['company'] ?? ''),
        sanitize($data['industry'] ?? ''),
        sanitize($data['company_size'] ?? ''),
        sanitize($data['website'] ?? ''),
        sanitize($data['region'] ?? ''),
        sanitize($data['type'] ?? 'Banking Decision Maker'),
        sanitize($data['tier'] ?? 'Bronze'),
        sanitize($data['status'] ?? 'Pending'),
        (int)($data['progress'] ?? 0),
        sanitize($data['admin_notes'] ?? ''),
        $id,
    ]);

    logActivity($_SESSION['user_id'], 'update', 'Updated partner: ' . ($data['name'] ?? ''), 'partner', $id);
    notifyPartner($id, 'Your profile was updated by an admin', 'Name/company/tier/contact details may have changed.', 'info', '#profile');
    jsonResponse(['success' => true]);
}

// ─── DELETE — Remove partner ────────────
if ($method === 'DELETE') {
    if (!isAdmin()) jsonResponse(['error' => 'Forbidden'], 403);

    $data = getJsonBody();
    $id = (int)($data['id'] ?? $_GET['id'] ?? 0);
    if (!$id) jsonResponse(['error' => 'Partner ID required'], 400);

    // Get name before deleting
    $stmt = $db->prepare('SELECT name FROM partners WHERE id = ?');
    $stmt->execute([$id]);
    $partner = $stmt->fetch();

    $db->prepare('DELETE FROM partners WHERE id = ?')->execute([$id]);
    $db->prepare('DELETE FROM users WHERE partner_id = ?')->execute([$id]);

    logActivity($_SESSION['user_id'], 'delete', 'Deleted partner: ' . ($partner['name'] ?? 'Unknown'), 'partner', $id);
    jsonResponse(['success' => true]);
}

jsonResponse(['error' => 'Method not allowed'], 405);
