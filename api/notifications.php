<?php
/* ============================================
   API: Notifications
   GET              → list (recent 30) + unread count
   POST {action:'mark_read', id?}       → mark one (or all) as read
   ============================================ */
require_once __DIR__ . '/../config/auth.php';
requireLogin();

$user = currentUser();
$db = getDB();
$method = getMethod();

if ($method === 'GET') {
    $stmt = $db->prepare('SELECT id, title, body, type, link, is_read, created_at FROM notifications WHERE user_id=? ORDER BY created_at DESC LIMIT 30');
    $stmt->execute([$user['id']]);
    $items = $stmt->fetchAll();

    $stmt = $db->prepare('SELECT COUNT(*) FROM notifications WHERE user_id=? AND is_read=0');
    $stmt->execute([$user['id']]);
    $unread = (int)$stmt->fetchColumn();

    jsonResponse(['notifications' => $items, 'unread' => $unread]);
}

if ($method === 'POST') {
    $d = getJsonBody();
    $action = $d['action'] ?? 'mark_read';

    if ($action === 'mark_read') {
        $id = (int)($d['id'] ?? 0);
        if ($id > 0) {
            $stmt = $db->prepare('UPDATE notifications SET is_read=1 WHERE id=? AND user_id=?');
            $stmt->execute([$id, $user['id']]);
        } else {
            $stmt = $db->prepare('UPDATE notifications SET is_read=1 WHERE user_id=?');
            $stmt->execute([$user['id']]);
        }
        jsonResponse(['success' => true]);
    }

    jsonResponse(['error' => 'Unknown action'], 400);
}

jsonResponse(['error' => 'Method not allowed'], 405);
