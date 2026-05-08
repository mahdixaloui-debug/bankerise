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

-- ─── Seed: sample chat + notifications for Amir (user_id=2, partner_id=1) ──
-- Assuming lead IDs 1,2,3 exist for partner 1 from previous migration
INSERT INTO lead_messages (lead_id, partner_id, sender, body, is_read, created_at) VALUES
(1, 1, 'partner', 'Hi Youssef, thanks for your interest in Bankerise. When would be a good time to walk through the platform?', 1, '2026-04-10 09:00:00'),
(1, 1, 'lead', 'Hello — thank you. Tomorrow afternoon works for me, can we aim for 3pm CET?', 0, '2026-04-10 14:22:00'),
(1, 1, 'lead', 'Also, do you have the pricing deck handy?', 0, '2026-04-10 14:23:00'),
(2, 1, 'partner', 'Rustam, following up on our last call — please find the technical overview attached.', 1, '2026-04-06 11:10:00'),
(2, 1, 'lead', 'Great, reviewing with our CTO this week.', 0, '2026-04-08 16:40:00'),
(3, 1, 'partner', 'Hello Ahmed, would love to understand your current MFI stack.', 1, '2026-04-02 10:00:00');

INSERT INTO notifications (user_id, title, body, type, link, is_read, created_at) VALUES
(2, 'New message from Youssef El Amrani', 'Also, do you have the pricing deck handy?', 'message', '#chat', 0, '2026-04-10 14:23:00'),
(2, 'Lead approved', 'Your lead Atlas Microfinance has been approved.', 'lead', '#leads', 0, '2026-04-09 08:30:00'),
(2, 'Commission paid', '€62,500 for Dubai FinBank — Q1 was deposited.', 'finance', '#commissions', 1, '2026-04-01 10:00:00');
