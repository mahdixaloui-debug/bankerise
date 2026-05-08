<?php
/* ============================================
   Bankerise — Database Connection (PDO)
   ============================================ */

define('DB_HOST', 'localhost');
define('DB_NAME', 'bankerise_db');
define('DB_USER', 'root');
define('DB_PASS', ''); // XAMPP default — no password

/**
 * Get PDO database connection
 * @return PDO
 */
function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
            exit;
        }
    }
    return $pdo;
}

/**
 * Get PDO connection without selecting a database (for install)
 * @return PDO
 */
function getDBRoot() {
    try {
        $dsn = 'mysql:host=' . DB_HOST . ';charset=utf8mb4';
        return new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'MySQL connection failed: ' . $e->getMessage()]);
        exit;
    }
}
