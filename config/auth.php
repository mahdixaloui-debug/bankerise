<?php
/* ============================================
   Bankerise — Authentication & Session
   ============================================ */

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/helpers.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

/**
 * Check if logged-in user is admin
 */
function isAdmin() {
    return isLoggedIn() && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

/**
 * Get current user data from session
 * @return array|null
 */
function currentUser() {
    if (!isLoggedIn()) return null;
    return [
        'id'         => $_SESSION['user_id'],
        'full_name'  => $_SESSION['user_name'] ?? '',
        'email'      => $_SESSION['user_email'] ?? '',
        'role'       => $_SESSION['user_role'] ?? '',
        'partner_id' => $_SESSION['partner_id'] ?? null,
    ];
}

/**
 * Require login — redirect to login page if not authenticated
 */
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: /bankerise/partners/login.php');
        exit;
    }
}

/**
 * Require admin role — redirect if not admin
 */
function requireAdmin() {
    requireLogin();
    if (!isAdmin()) {
        header('Location: /bankerise/partners/dashboard.php');
        exit;
    }
}

/**
 * Attempt login with email and password
 * @return array ['success' => bool, 'message' => string, 'role' => string]
 */
function login($email, $password) {
    $db = getDB();
    $stmt = $db->prepare('SELECT id, full_name, email, password_hash, role, partner_id, is_active FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        return ['success' => false, 'message' => 'Invalid email or password.'];
    }

    if (!$user['is_active']) {
        return ['success' => false, 'message' => 'Your account has been deactivated.'];
    }

    if (!password_verify($password, $user['password_hash'])) {
        return ['success' => false, 'message' => 'Invalid email or password.'];
    }

    // Set session
    $_SESSION['user_id']    = $user['id'];
    $_SESSION['user_name']  = $user['full_name'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_role']  = $user['role'];
    $_SESSION['partner_id'] = $user['partner_id'];

    // Update last_login
    $db->prepare('UPDATE users SET last_login = NOW() WHERE id = ?')->execute([$user['id']]);

    // Log activity
    logActivity($user['id'], 'login', $user['full_name'] . ' logged in', 'user', $user['id']);

    return [
        'success'  => true,
        'message'  => 'Login successful.',
        'role'     => $user['role'],
        'name'     => $user['full_name'],
        'redirect' => $user['role'] === 'admin'
            ? '/bankerise/partners/backoffice.php'
            : '/bankerise/partners/dashboard.php',
    ];
}

/**
 * Logout — destroy session
 */
function logout() {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}
