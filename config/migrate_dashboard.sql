-- ============================================
-- Bankerise — Dashboard migration: leads + reports
-- Run once against bankerise_db
-- ============================================
USE bankerise_db;

-- ─── Leads ──────────────────────────────────
CREATE TABLE IF NOT EXISTS leads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    partner_id INT NOT NULL,
    company_name VARCHAR(150) NOT NULL,
    industry VARCHAR(60) DEFAULT NULL,
    company_size VARCHAR(30) DEFAULT NULL,
    website VARCHAR(200) DEFAULT NULL,
    country VARCHAR(60) DEFAULT NULL,
    contact_first_name VARCHAR(80) DEFAULT NULL,
    contact_last_name VARCHAR(80) DEFAULT NULL,
    contact_title VARCHAR(100) DEFAULT NULL,
    contact_email VARCHAR(150) NOT NULL,
    contact_phone VARCHAR(30) DEFAULT NULL,
    project_types VARCHAR(255) DEFAULT NULL,
    budget_range VARCHAR(30) DEFAULT NULL,
    timeline VARCHAR(30) DEFAULT NULL,
    decision_maker TINYINT(1) DEFAULT 0,
    notes TEXT DEFAULT NULL,
    status ENUM('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_partner (partner_id),
    INDEX idx_status (status)
) ENGINE=InnoDB;

-- ─── Reports ────────────────────────────────
CREATE TABLE IF NOT EXISTS reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    partner_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    period VARCHAR(40) DEFAULT NULL,
    type ENUM('Sales','Activity','Pipeline','Performance','Other') NOT NULL DEFAULT 'Activity',
    content TEXT NOT NULL,
    status ENUM('Draft','Sent','Reviewed') NOT NULL DEFAULT 'Sent',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_partner (partner_id),
    INDEX idx_status (status)
) ENGINE=InnoDB;

-- No seed data — start with a clean pipeline.
