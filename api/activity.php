<?php
/* ============================================
   API: Activity Feed
   ============================================ */
require_once __DIR__ . '/../config/auth.php';

if (!isAdmin()) jsonResponse(['error' => 'Forbidden'], 403);

requireMethod('GET');

$db = getDB();
$limit = (int)($_GET['limit'] ?? 20);
$limit = min($limit, 50);

$stmt = $db->prepare("
    SELECT 
        a.id, a.action, a.description, a.target_type, a.target_id, a.created_at,
        u.full_name as user_name
    FROM activity_log a
    LEFT JOIN users u ON a.user_id = u.id
    ORDER BY a.created_at DESC
    LIMIT ?
");
$stmt->execute([$limit]);
$activities = $stmt->fetchAll();

// Add relative time
foreach ($activities as &$act) {
    $diff = time() - strtotime($act['created_at']);
    if ($diff < 3600)      $act['relative'] = floor($diff / 60) . ' min ago';
    elseif ($diff < 86400) $act['relative'] = floor($diff / 3600) . ' hours ago';
    elseif ($diff < 604800) $act['relative'] = floor($diff / 86400) . ' days ago';
    else                   $act['relative'] = date('M j', strtotime($act['created_at']));
}
unset($act);

jsonResponse($activities);
