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

-- ─── Seed: sample leads for partner #1 (Amir) ─
INSERT INTO leads (partner_id, company_name, industry, company_size, country, contact_first_name, contact_last_name, contact_email, contact_phone, budget_range, timeline, status, created_at) VALUES
(1, 'Atlas Microfinance', 'Microfinance', '11-50', 'Morocco', 'Youssef', 'El Amrani', 'youssef@atlasmf.ma', '+212 5 22 112233', '200K-500K€', '3-6 months', 'Approved', '2026-04-08 10:00:00'),
(1, 'Tashkent Digital Bank', 'Fintech', '200+', 'Uzbekistan', 'Rustam', 'Umarov', 'rustam@tdb.uz', '+998 71 234 5678', '500K+€', '6-12 months', 'Approved', '2026-04-04 14:30:00'),
(1, 'Cairo MFI Group', 'Microfinance', '11-50', 'Egypt', 'Ahmed', 'Hassan', 'ahmed@cairomfi.eg', '+20 2 2345 6789', '50K-200K€', '3-6 months', 'Pending', '2026-04-01 09:15:00');
