-- ============================================
-- Bankerise — Chat + Notifications migration
-- ============================================
USE bankerise_db;

-- ─── Lead messages (partner <-> lead thread) ──
CREATE TABLE IF NOT EXISTS lead_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lead_id INT NOT NULL,
    partner_id INT NOT NULL,
    sender ENUM('partner','lead') NOT NULL,
    body TEXT NOT NULL,
    is_read TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_lead (lead_id),
    INDEX idx_partner (partner_id),
    INDEX idx_unread (is_read)
) ENGINE=InnoDB;

-- ─── Notifications ────────────────────────────
CREATE TABLE IF NOT EXISTS notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    body VARCHAR(500) DEFAULT NULL,
    type VARCHAR(40) DEFAULT 'info',
    link VARCHAR(255) DEFAULT NULL,
    is_read TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user (user_id),
    INDEX idx_unread (is_read)
) ENGINE=InnoDB;

-- No seed messages or notifications — start fresh.
