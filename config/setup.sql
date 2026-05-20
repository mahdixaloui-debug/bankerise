-- ============================================
-- Bankerise — Database Schema & Seed Data
-- ============================================

CREATE DATABASE IF NOT EXISTS bankerise_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bankerise_db;

-- ─── Users ──────────────────────────────────
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('partner','admin') NOT NULL DEFAULT 'partner',
    partner_id INT DEFAULT NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_login DATETIME DEFAULT NULL,
    INDEX idx_email (email),
    INDEX idx_role (role)
) ENGINE=InnoDB;

-- ─── Partners ───────────────────────────────
CREATE TABLE IF NOT EXISTS partners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(30) DEFAULT NULL,
    country VARCHAR(60) DEFAULT NULL,
    company VARCHAR(150) NOT NULL,
    industry VARCHAR(100) DEFAULT NULL,
    company_size VARCHAR(30) DEFAULT NULL,
    website VARCHAR(200) DEFAULT NULL,
    region VARCHAR(100) DEFAULT NULL,
    avatar VARCHAR(255) DEFAULT NULL,
    type ENUM('Banking Decision Maker','IT Manager','Local Integrator') NOT NULL,
    tier ENUM('Bronze','Silver','Gold') NOT NULL DEFAULT 'Bronze',
    status ENUM('Pending','Accepted','Stalled','Declined') NOT NULL DEFAULT 'Pending',
    progress INT NOT NULL DEFAULT 0,
    admin_notes TEXT DEFAULT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_tier (tier),
    INDEX idx_type (type)
) ENGINE=InnoDB;

-- ─── Applications ───────────────────────────
CREATE TABLE IF NOT EXISTS applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(150) NOT NULL,
    website VARCHAR(200) DEFAULT NULL,
    country VARCHAR(60) DEFAULT NULL,
    company_size VARCHAR(50) DEFAULT NULL,
    partner_type VARCHAR(80) DEFAULT NULL,
    requested_tier ENUM('Bronze','Silver','Gold') DEFAULT 'Bronze',
    contact_name VARCHAR(100) NOT NULL,
    contact_email VARCHAR(150) NOT NULL,
    contact_phone VARCHAR(30) DEFAULT NULL,
    message TEXT DEFAULT NULL,
    status ENUM('Pending','Reviewed','Approved','Rejected') NOT NULL DEFAULT 'Pending',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_status (status)
) ENGINE=InnoDB;

-- ─── Contact Messages ───────────────────────
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    company VARCHAR(150) DEFAULT NULL,
    country VARCHAR(60) DEFAULT NULL,
    contact_type VARCHAR(50) DEFAULT NULL,
    subject VARCHAR(80) DEFAULT NULL,
    message TEXT NOT NULL,
    is_read TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_is_read (is_read)
) ENGINE=InnoDB;

-- ─── Activity Log ───────────────────────────
CREATE TABLE IF NOT EXISTS activity_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT DEFAULT NULL,
    action VARCHAR(50) NOT NULL,
    description VARCHAR(255) DEFAULT NULL,
    target_type VARCHAR(50) DEFAULT NULL,
    target_id INT DEFAULT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user (user_id),
    INDEX idx_created (created_at)
) ENGINE=InnoDB;

-- ═══════════════════════════════════════════════
-- SEED DATA (clean — admin only)
-- ═══════════════════════════════════════════════

-- Admin user: admin@bankerise.com / bankerise2026
-- Password hash is set securely by install.php right after this insert.
INSERT INTO users (full_name, email, password_hash, role) VALUES
('System Admin', 'admin@bankerise.com', '$2y$10$placeholder', 'admin');
