<?php
/* ============================================
   API: Contact Form Submissions
   ============================================ */
require_once __DIR__ . '/../config/auth.php';

$method = getMethod();
$db = getDB();

// ─── POST — Submit contact form (public) ──
if ($method === 'POST') {
    $data = getJsonBody();

    // Validate
    $required = ['full_name', 'email', 'message'];
    foreach ($required as $field) {
        if (empty($data[$field])) {
            jsonResponse(['error' => "Field '{$field}' is required."], 400);
        }
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        jsonResponse(['error' => 'Invalid email address.'], 400);
    }

    $stmt = $db->prepare('INSERT INTO contact_messages (full_name, email, company, country, contact_type, subject, message) VALUES (?,?,?,?,?,?,?)');
    $stmt->execute([
        sanitize($data['full_name']),
        sanitize($data['email']),
        sanitize($data['company'] ?? ''),
        sanitize($data['country'] ?? ''),
        sanitize($data['contact_type'] ?? ''),
        sanitize($data['subject'] ?? ''),
        sanitize($data['message']),
    ]);

    jsonResponse(['success' => true, 'message' => 'Message sent successfully.'], 201);
}

// ─── GET — List messages (admin) ──────────
if ($method === 'GET') {
    if (!isAdmin()) jsonResponse(['error' => 'Forbidden'], 403);

    $stmt = $db->query('SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 50');
    jsonResponse($stmt->fetchAll());
}

jsonResponse(['error' => 'Method not allowed'], 405);
