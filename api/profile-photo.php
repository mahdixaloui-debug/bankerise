<?php
/* ============================================
   API: Partner Profile Photo — POST (upload) / DELETE
   ============================================ */
require_once __DIR__ . '/../config/auth.php';
requireLogin();

$user = currentUser();
$partnerId = $user['partner_id'] ?? null;
if (!$partnerId) jsonResponse(['error' => 'No partner record linked to this user.'], 404);

$db = getDB();
$method = getMethod();

// Lazy migration: ensure `avatar` column exists on partners
try {
    $col = $db->query("SHOW COLUMNS FROM partners LIKE 'avatar'")->fetch();
    if (!$col) {
        $db->exec("ALTER TABLE partners ADD COLUMN avatar VARCHAR(255) DEFAULT NULL");
    }
} catch (Throwable $e) {
    // ignore — selects will surface real errors below
}

$uploadDir = realpath(__DIR__ . '/..') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'avatars';
if (!is_dir($uploadDir)) {
    @mkdir($uploadDir, 0775, true);
}

if ($method === 'POST') {
    if (empty($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        jsonResponse(['error' => 'No file uploaded or upload failed.'], 400);
    }
    $file = $_FILES['photo'];

    // Size limit: 4 MB
    if ($file['size'] > 4 * 1024 * 1024) {
        jsonResponse(['error' => 'File too large (max 4 MB).'], 400);
    }

    // Validate mime type via finfo
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime  = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    $allowed = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp',
        'image/gif'  => 'gif',
    ];
    if (!isset($allowed[$mime])) {
        jsonResponse(['error' => 'Unsupported image type. Use JPG, PNG, WEBP or GIF.'], 400);
    }
    $ext = $allowed[$mime];

    $filename = 'partner_' . $partnerId . '_' . time() . '.' . $ext;
    $dest = $uploadDir . DIRECTORY_SEPARATOR . $filename;
    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        jsonResponse(['error' => 'Failed to save uploaded file.'], 500);
    }

    // Remove previous avatar file if any
    $prev = $db->prepare('SELECT avatar FROM partners WHERE id=?');
    $prev->execute([$partnerId]);
    $prevName = $prev->fetchColumn();
    if ($prevName) {
        $prevPath = $uploadDir . DIRECTORY_SEPARATOR . basename($prevName);
        if (is_file($prevPath)) @unlink($prevPath);
    }

    $db->prepare('UPDATE partners SET avatar=?, updated_at=NOW() WHERE id=?')
       ->execute([$filename, $partnerId]);

    logActivity($user['id'], 'update', 'Profile photo updated', 'partner', $partnerId);

    jsonResponse([
        'success' => true,
        'avatar'  => $filename,
        'url'     => '/bankerise/uploads/avatars/' . $filename,
    ]);
}

if ($method === 'DELETE') {
    $prev = $db->prepare('SELECT avatar FROM partners WHERE id=?');
    $prev->execute([$partnerId]);
    $prevName = $prev->fetchColumn();
    if ($prevName) {
        $prevPath = $uploadDir . DIRECTORY_SEPARATOR . basename($prevName);
        if (is_file($prevPath)) @unlink($prevPath);
    }
    $db->prepare('UPDATE partners SET avatar=NULL, updated_at=NOW() WHERE id=?')->execute([$partnerId]);
    jsonResponse(['success' => true]);
}

jsonResponse(['error' => 'Method not allowed'], 405);
