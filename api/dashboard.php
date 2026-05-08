<?php
/* ============================================
   API: Dashboard Statistics
   ============================================ */
require_once __DIR__ . '/../config/auth.php';

if (!isLoggedIn()) jsonResponse(['error' => 'Unauthorized'], 401);

$db = getDB();

// ─── Overall counts ─────────────────────
$total     = (int)$db->query('SELECT COUNT(*) FROM partners')->fetchColumn();
$accepted  = (int)$db->query("SELECT COUNT(*) FROM partners WHERE status = 'Accepted'")->fetchColumn();
$stalled   = (int)$db->query("SELECT COUNT(*) FROM partners WHERE status = 'Stalled'")->fetchColumn();
$declined  = (int)$db->query("SELECT COUNT(*) FROM partners WHERE status = 'Declined'")->fetchColumn();
$pending   = (int)$db->query("SELECT COUNT(*) FROM partners WHERE status = 'Pending'")->fetchColumn();

// ─── By Tier ────────────────────────────
$tierStmt = $db->query("SELECT tier, COUNT(*) as count FROM partners GROUP BY tier");
$byTier = [];
while ($row = $tierStmt->fetch()) {
    $byTier[$row['tier']] = (int)$row['count'];
}

// ─── By Type ────────────────────────────
$typeStmt = $db->query("SELECT type, COUNT(*) as count FROM partners GROUP BY type");
$byType = [];
while ($row = $typeStmt->fetch()) {
    $byType[$row['type']] = (int)$row['count'];
}

// ─── Heatmap: Status × Type ─────────────
$heatmapStmt = $db->query("SELECT type, status, COUNT(*) as count FROM partners GROUP BY type, status");
$heatmap = [];
while ($row = $heatmapStmt->fetch()) {
    $heatmap[$row['status']][$row['type']] = (int)$row['count'];
}

// ─── Acceptance by Tier ─────────────────
$tierAccStmt = $db->query("SELECT tier, status, COUNT(*) as count FROM partners GROUP BY tier, status");
$tierAcceptance = [];
while ($row = $tierAccStmt->fetch()) {
    if (!isset($tierAcceptance[$row['tier']])) {
        $tierAcceptance[$row['tier']] = ['total' => 0, 'accepted' => 0];
    }
    $tierAcceptance[$row['tier']]['total'] += (int)$row['count'];
    if ($row['status'] === 'Accepted') {
        $tierAcceptance[$row['tier']]['accepted'] = (int)$row['count'];
    }
}

// Calculate percentages
foreach ($tierAcceptance as $tier => &$data) {
    $data['rate'] = $data['total'] > 0 ? round(($data['accepted'] / $data['total']) * 100) : 0;
}
unset($data);

// ─── Pending applications count ─────────
$pendingApps = (int)$db->query("SELECT COUNT(*) FROM applications WHERE status = 'Pending'")->fetchColumn();

// ─── Response ───────────────────────────
jsonResponse([
    'totals' => [
        'total'    => $total,
        'accepted' => $accepted,
        'stalled'  => $stalled,
        'declined' => $declined,
        'pending'  => $pending,
    ],
    'byTier'          => $byTier,
    'byType'          => $byType,
    'heatmap'         => $heatmap,
    'tierAcceptance'  => $tierAcceptance,
    'pendingApps'     => $pendingApps,
    'acceptanceRate'  => $total > 0 ? round(($accepted / $total) * 100, 1) : 0,
]);
