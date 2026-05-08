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
-- SEED DATA
-- ═══════════════════════════════════════════════

-- Admin user: admin@bankerise.com / bankerise2026
INSERT INTO users (full_name, email, password_hash, role) VALUES
('System Admin', 'admin@bankerise.com', '$2y$10$placeholder', 'admin');

-- Partner users (all password: partner123)
INSERT INTO users (full_name, email, password_hash, role) VALUES
('Amir Karimov', 'amir@dbfinance.uz', '$2y$10$placeholder', 'partner'),
('Sophie Durand', 'sophie@lyoncredit.fr', '$2y$10$placeholder', 'partner');

-- ─── Seed Partners ──────────────────────────
INSERT INTO partners (name, email, phone, country, company, industry, company_size, website, region, type, tier, status, progress, admin_notes) VALUES
('Amir Karimov', 'amir@dbfinance.uz', '+998 90 123 4567', 'Uzbekistan', 'DigitalBridge Finance', 'Fintech', '51-200', 'https://dbfinance.uz', 'Central Asia', 'Banking Decision Maker', 'Gold', 'Accepted', 100, 'Gold tier partner with strong pipeline.'),
('Sophie Durand', 'sophie@lyoncredit.fr', '+33 4 72 00 1234', 'France', 'Lyon Crédit Union', 'Banking', '200+', 'https://lyoncredit.fr', 'Europe', 'IT Manager', 'Silver', 'Stalled', 45, 'Awaiting additional compliance docs.'),
('Rustam Umarov', 'rustam@tdb.uz', '+998 71 234 5678', 'Uzbekistan', 'Tashkent Digital Bank', 'Banking', '200+', 'https://tdb.uz', 'Central Asia', 'Banking Decision Maker', 'Gold', 'Accepted', 85, ''),
('Fatima Benani', 'fatima@casafinance.ma', '+212 5 22 334455', 'Morocco', 'Casablanca Finance', 'Banking', '51-200', 'https://casafinance.ma', 'North Africa', 'Banking Decision Maker', 'Silver', 'Accepted', 90, ''),
('Ahmed Hassan', 'ahmed@cairomfi.eg', '+20 2 2345 6789', 'Egypt', 'Cairo MFI Group', 'Microfinance', '11-50', 'https://cairomfi.eg', 'North Africa', 'Banking Decision Maker', 'Bronze', 'Accepted', 70, ''),
('Khalid Al-Rashid', 'khalid@gulfdigi.ae', '+971 4 234 5678', 'UAE', 'Gulf Digital Solutions', 'Fintech', '51-200', 'https://gulfdigi.ae', 'Middle East', 'Local Integrator', 'Gold', 'Accepted', 95, 'Regional exclusivity agreement.'),
('Youssef El Amrani', 'youssef@atlasmf.ma', '+212 5 22 112233', 'Morocco', 'Atlas Microfinance', 'Microfinance', '11-50', 'https://atlasmf.ma', 'North Africa', 'Banking Decision Maker', 'Silver', 'Accepted', 60, ''),
('Elena Kowalska', 'elena@wfthub.pl', '+48 22 345 6789', 'Poland', 'Warsaw FinTech Hub', 'Fintech', '11-50', 'https://wfthub.pl', 'Europe', 'IT Manager', 'Bronze', 'Stalled', 30, 'Missing company verification.'),
('Mohamed Diallo', 'mohamed@dbc.sn', '+221 33 822 1234', 'Senegal', 'Dakar Banking Co', 'Banking', '1-10', 'https://dbc.sn', 'Sub-Saharan Africa', 'Local Integrator', 'Bronze', 'Accepted', 55, ''),
('Marco Rivoli', 'marco@rivoli.it', '+39 02 1234567', 'Italy', 'Rivoli Systems', 'Fintech', '1-10', 'https://rivoli.it', 'Europe', 'Local Integrator', 'Bronze', 'Declined', 15, 'Insufficient market coverage.'),
('Olga Petrova', 'olga@almatyfx.kz', '+7 727 234 5678', 'Kazakhstan', 'Almaty FX Group', 'Fintech', '51-200', 'https://almatyfx.kz', 'Central Asia', 'IT Manager', 'Silver', 'Accepted', 80, ''),
('Karim Benslimane', 'karim@tunisdb.tn', '+216 71 234 567', 'Tunisia', 'Tunis Digital Bank', 'Banking', '200+', 'https://tunisdb.tn', 'North Africa', 'Banking Decision Maker', 'Silver', 'Stalled', 40, 'Under compliance review.'),
('David Mensah', 'david@accrapay.gh', '+233 30 234 5678', 'Ghana', 'AccraPay', 'Payment', '11-50', 'https://accrapay.gh', 'Sub-Saharan Africa', 'Local Integrator', 'Bronze', 'Accepted', 65, ''),
('Nurlan Abykeev', 'nurlan@bishkekd.kg', '+996 312 234 567', 'Kyrgyzstan', 'Bishkek Digital', 'Banking', '51-200', 'https://bishkekd.kg', 'Central Asia', 'IT Manager', 'Gold', 'Accepted', 100, 'Top performer in Central Asia.'),
('Amina Zourob', 'amina@anb.dz', '+213 21 234 567', 'Algeria', 'Algiers National Bank', 'Banking', '200+', 'https://anb.dz', 'North Africa', 'Banking Decision Maker', 'Silver', 'Accepted', 75, ''),
('Pierre Leclerc', 'pierre@finobanque.fr', '+33 1 23 45 67 89', 'France', 'Paris FinoBanque', 'Banking', '11-50', 'https://finobanque.fr', 'Europe', 'IT Manager', 'Bronze', 'Stalled', 25, 'Awaiting budget approval.'),
('Omar Jourdani', 'omar@rabatmfi.ma', '+212 5 37 234 567', 'Morocco', 'Rabat MFI Network', 'Microfinance', '51-200', 'https://rabatmfi.ma', 'North Africa', 'Banking Decision Maker', 'Gold', 'Accepted', 88, ''),
('Layla Nasser', 'layla@dubaifinbank.ae', '+971 4 345 6789', 'UAE', 'Dubai FinBank', 'Banking', '200+', 'https://dubaifinbank.ae', 'Middle East', 'Local Integrator', 'Silver', 'Accepted', 92, '');

-- Link partner users to partner records
UPDATE users SET partner_id = 1 WHERE email = 'amir@dbfinance.uz';
UPDATE users SET partner_id = 2 WHERE email = 'sophie@lyoncredit.fr';

-- Seed activity log
INSERT INTO activity_log (user_id, action, description, target_type, target_id, created_at) VALUES
(1, 'accept', 'Partner Amir Karimov was accepted', 'partner', 1, NOW() - INTERVAL 2 HOUR),
(1, 'stall', 'Partner Sophie Durand was stalled', 'partner', 2, NOW() - INTERVAL 5 HOUR),
(NULL, 'apply', 'New application from Hassan Al-Farsi', 'application', NULL, NOW() - INTERVAL 1 DAY),
(1, 'decline', 'Partner Marco Rivoli was declined', 'partner', 10, NOW() - INTERVAL 2 DAY);

-- Seed applications (pending)
INSERT INTO applications (company_name, website, country, company_size, partner_type, contact_name, contact_email, contact_phone, message, status, created_at) VALUES
('Gulf Tech Solutions', 'https://gulftechsol.ae', 'UAE', '51-200 employees', 'Implementation Partner (Integrator)', 'Hassan Al-Farsi', 'hassan@gulftechsol.ae', '+971 4 567 8901', 'Interested in expanding digital banking services.', 'Pending', NOW() - INTERVAL 1 DAY),
('Casablanca Digital', 'https://casadigital.ma', 'Morocco', '11-50 employees', 'Technology Partner', 'Lina Wahbi', 'lina@casadigital.ma', '+212 5 22 998877', 'We specialize in IT infrastructure for banks.', 'Pending', NOW() - INTERVAL 2 DAY),
('Almaty FinServ', 'https://almatyfinserv.kz', 'Kazakhstan', '200+ employees', 'Implementation Partner (Integrator)', 'Timur Bekmuratov', 'timur@almatyfinserv.kz', '+7 727 345 678', 'Looking to partner for Central Asia expansion.', 'Pending', NOW() - INTERVAL 3 DAY),
('Cairo MFI Group', 'https://cairomfi2.eg', 'Egypt', '51-200 employees', 'Referral Partner', 'Nadia Khalil', 'nadia@cairomfi2.eg', '+20 2 3456 7890', 'Want to offer Bankerise to our client network.', 'Pending', NOW() - INTERVAL 4 DAY),
('Lyon Crédit Union Tech', 'https://lyoncredittech.fr', 'France', '11-50 employees', 'Technology Partner', 'Jean-Marc Dupont', 'jeanmarc@lyoncredittech.fr', '+33 4 72 11 2233', 'Microfinance technology provider seeking partnership.', 'Pending', NOW() - INTERVAL 5 DAY);
