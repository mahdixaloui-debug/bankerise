<?php
/* ============================================
   API: Authentication (Login / Logout)
   ============================================ */
require_once __DIR__ . '/../config/auth.php';

$method = getMethod();

if ($method === 'POST') {
    // ─── LOGIN ──────────────────────────────
    $data = getJsonBody();
    $email    = sanitize($data['email'] ?? '');
    $password = $data['password'] ?? '';

    if (empty($email) || empty($password)) {
        jsonResponse(['success' => false, 'message' => 'Email and password are required.'], 400);
    }

    $result = login($email, $password);
    jsonResponse($result, $result['success'] ? 200 : 401);

} elseif ($method === 'DELETE' || ($method === 'POST' && isset($_GET['action']) && $_GET['action'] === 'logout')) {
    // ─── LOGOUT ─────────────────────────────
    logout();
    jsonResponse(['success' => true, 'message' => 'Logged out.']);

} elseif ($method === 'GET') {
    // ─── CHECK SESSION ──────────────────────
    if (isLoggedIn()) {
        jsonResponse(['loggedIn' => true, 'user' => currentUser()]);
    } else {
        jsonResponse(['loggedIn' => false]);
    }

} else {
    jsonResponse(['error' => 'Method not allowed'], 405);
}
