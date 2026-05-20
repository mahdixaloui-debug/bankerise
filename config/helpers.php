<?php
/* ============================================
   Bankerise — Helper Functions
   ============================================ */

/**
 * Sanitize input string
 */
function sanitize($input) {
    if (is_array($input)) {
        return array_map('sanitize', $input);
    }
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Send JSON response and exit
 */
function jsonResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

/**
 * Redirect helper
 */
function redirect($url) {
    header('Location: ' . $url);
    exit;
}

/**
 * Log an activity to the activity_log table
 */
function logActivity($userId, $action, $description, $targetType = null, $targetId = null) {
    try {
        $db = getDB();
        $stmt = $db->prepare('INSERT INTO activity_log (user_id, action, description, target_type, target_id, created_at) VALUES (?, ?, ?, ?, ?, NOW())');
        $stmt->execute([$userId, $action, $description, $targetType, $targetId]);
    } catch (Exception $e) {
        // Silently fail — activity logging should not break the app
    }
}

/**
 * Get request method
 */
function getMethod() {
    return $_SERVER['REQUEST_METHOD'];
}

/**
 * Get JSON body from POST/PUT request
 */
function getJsonBody() {
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true);
    return is_array($data) ? $data : [];
}

/**
 * Require specific HTTP method(s)
 */
function requireMethod($methods) {
    if (!is_array($methods)) $methods = [$methods];
    if (!in_array(getMethod(), $methods)) {
        jsonResponse(['error' => 'Method not allowed'], 405);
    }
}

/**
 * Get base URL for the project
 */
function baseUrl() {
    return '';
}

/**
 * Create a notification for a single user
 */
function notify($userId, $title, $body = '', $type = 'info', $link = null) {
    if (!$userId) return false;
    try {
        $db = getDB();
        $stmt = $db->prepare('INSERT INTO notifications (user_id, title, body, type, link, is_read, created_at) VALUES (?, ?, ?, ?, ?, 0, NOW())');
        $stmt->execute([$userId, $title, $body, $type, $link]);
        return (int)$db->lastInsertId();
    } catch (Exception $e) {
        return false;
    }
}

/**
 * Broadcast a notification to every admin user
 */
function notifyAdmins($title, $body = '', $type = 'info', $link = null) {
    try {
        $db = getDB();
        $stmt = $db->query("SELECT id FROM users WHERE role = 'admin' AND is_active = 1");
        while ($row = $stmt->fetch()) {
            notify((int)$row['id'], $title, $body, $type, $link);
        }
    } catch (Exception $e) {
        // silently fail
    }
}

/**
 * Notify the partner-user linked to a given partner_id
 */
function notifyPartner($partnerId, $title, $body = '', $type = 'info', $link = null) {
    if (!$partnerId) return;
    try {
        $db = getDB();
        $stmt = $db->prepare('SELECT id FROM users WHERE partner_id = ? AND is_active = 1');
        $stmt->execute([$partnerId]);
        while ($row = $stmt->fetch()) {
            notify((int)$row['id'], $title, $body, $type, $link);
        }
    } catch (Exception $e) {
        // silently fail
    }
}
