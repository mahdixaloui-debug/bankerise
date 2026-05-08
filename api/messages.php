<?php
/* ============================================
   API: Chat Messages with Leads
   GET  ?action=threads          → list of leads with last message + unread count
   GET  ?action=thread&lead_id=N → full message thread (also marks inbound as read)
   POST {lead_id, body}          → send a message as partner
   POST {action:'simulate', lead_id, body} → (demo) simulate inbound lead reply
   POST {action:'mark_read', lead_id}      → mark thread read
   ============================================ */
require_once __DIR__ . '/../config/auth.php';
requireLogin();

$user = currentUser();
$db = getDB();
$method = getMethod();

// Admin may view any partner's threads via ?partner_id=N (read-only)
if ($method === 'GET' && isAdmin() && !empty($_GET['partner_id'])) {
    $pid = (int)$_GET['partner_id'];
    $action = $_GET['action'] ?? 'threads';
    if ($action === 'threads') {
        $sql = "
            SELECT l.id, l.company_name, l.contact_first_name, l.contact_last_name,
                   l.status,
                   (SELECT body FROM lead_messages m WHERE m.lead_id=l.id ORDER BY m.created_at DESC LIMIT 1) AS last_body,
                   (SELECT sender FROM lead_messages m WHERE m.lead_id=l.id ORDER BY m.created_at DESC LIMIT 1) AS last_sender,
                   (SELECT created_at FROM lead_messages m WHERE m.lead_id=l.id ORDER BY m.created_at DESC LIMIT 1) AS last_at,
                   (SELECT COUNT(*) FROM lead_messages m WHERE m.lead_id=l.id) AS message_count
            FROM leads l WHERE l.partner_id=? ORDER BY COALESCE(last_at, l.created_at) DESC
        ";
        $stmt = $db->prepare($sql);
        $stmt->execute([$pid]);
        jsonResponse(['threads' => $stmt->fetchAll()]);
    }
}

$partnerId = $user['partner_id'] ?? null;
if (!$partnerId) jsonResponse(['error' => 'No partner record linked to this user.'], 404);

function ownsLead($db, $leadId, $partnerId) {
    $stmt = $db->prepare('SELECT id, company_name, contact_first_name, contact_last_name, contact_email FROM leads WHERE id=? AND partner_id=?');
    $stmt->execute([$leadId, $partnerId]);
    return $stmt->fetch();
}

if ($method === 'GET') {
    $action = $_GET['action'] ?? 'threads';

    if ($action === 'threads') {
        // One row per lead: last message + unread count
        $sql = "
            SELECT l.id, l.company_name, l.contact_first_name, l.contact_last_name,
                   l.contact_email, l.status,
                   (SELECT body FROM lead_messages m WHERE m.lead_id=l.id ORDER BY m.created_at DESC LIMIT 1) AS last_body,
                   (SELECT sender FROM lead_messages m WHERE m.lead_id=l.id ORDER BY m.created_at DESC LIMIT 1) AS last_sender,
                   (SELECT created_at FROM lead_messages m WHERE m.lead_id=l.id ORDER BY m.created_at DESC LIMIT 1) AS last_at,
                   (SELECT COUNT(*) FROM lead_messages m WHERE m.lead_id=l.id AND m.sender='lead' AND m.is_read=0) AS unread
            FROM leads l
            WHERE l.partner_id=?
            ORDER BY COALESCE(last_at, l.created_at) DESC
        ";
        $stmt = $db->prepare($sql);
        $stmt->execute([$partnerId]);
        $threads = $stmt->fetchAll();

        $totalUnread = 0;
        foreach ($threads as $t) $totalUnread += (int)$t['unread'];

        jsonResponse(['threads' => $threads, 'total_unread' => $totalUnread]);
    }

    if ($action === 'thread') {
        $leadId = (int)($_GET['lead_id'] ?? 0);
        $lead = ownsLead($db, $leadId, $partnerId);
        if (!$lead) jsonResponse(['error' => 'Lead not found.'], 404);

        $stmt = $db->prepare('SELECT id, sender, body, is_read, created_at FROM lead_messages WHERE lead_id=? ORDER BY created_at ASC');
        $stmt->execute([$leadId]);
        $messages = $stmt->fetchAll();

        // Mark inbound (lead → partner) as read
        $db->prepare("UPDATE lead_messages SET is_read=1 WHERE lead_id=? AND sender='lead' AND is_read=0")->execute([$leadId]);

        jsonResponse(['lead' => $lead, 'messages' => $messages]);
    }

    jsonResponse(['error' => 'Unknown action'], 400);
}

if ($method === 'POST') {
    $d = getJsonBody();
    $action = $d['action'] ?? 'send';

    if ($action === 'mark_read') {
        $leadId = (int)($d['lead_id'] ?? 0);
        if (!ownsLead($db, $leadId, $partnerId)) jsonResponse(['error' => 'Lead not found.'], 404);
        $db->prepare("UPDATE lead_messages SET is_read=1 WHERE lead_id=? AND sender='lead'")->execute([$leadId]);
        jsonResponse(['success' => true]);
    }

    $leadId = (int)($d['lead_id'] ?? 0);
    $body   = trim($d['body'] ?? '');
    if (!$leadId || $body === '') jsonResponse(['error' => 'lead_id and body required.'], 400);

    $lead = ownsLead($db, $leadId, $partnerId);
    if (!$lead) jsonResponse(['error' => 'Lead not found.'], 404);

    if ($action === 'simulate') {
        // Demo: lead replies
        $stmt = $db->prepare("INSERT INTO lead_messages (lead_id, partner_id, sender, body, is_read) VALUES (?,?, 'lead', ?, 0)");
        $stmt->execute([$leadId, $partnerId, $body]);
        $mid = (int)$db->lastInsertId();

        // Create a notification for the partner user
        $leadName = trim(($lead['contact_first_name'] ?? '') . ' ' . ($lead['contact_last_name'] ?? '')) ?: $lead['company_name'];
        $n = $db->prepare('INSERT INTO notifications (user_id, title, body, type, link) VALUES (?, ?, ?, ?, ?)');
        $n->execute([$user['id'], 'New message from ' . $leadName, mb_substr($body, 0, 200), 'message', '#chat']);
        jsonResponse(['success' => true, 'id' => $mid]);
    }

    // Partner sending a message
    $stmt = $db->prepare("INSERT INTO lead_messages (lead_id, partner_id, sender, body, is_read) VALUES (?,?, 'partner', ?, 1)");
    $stmt->execute([$leadId, $partnerId, $body]);
    $mid = (int)$db->lastInsertId();

    logActivity($user['id'], 'message_send', 'Message to ' . $lead['company_name'], 'lead', $leadId);
    jsonResponse(['success' => true, 'id' => $mid, 'created_at' => date('Y-m-d H:i:s')]);
}

jsonResponse(['error' => 'Method not allowed'], 405);
