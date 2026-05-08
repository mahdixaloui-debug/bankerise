<?php
/* ============================================
   Bankerise — Database Installer
   Run once: http://localhost/bankerise/config/install.php
   ============================================ */

require_once __DIR__ . '/database.php';

$messages = [];
$success = true;

try {
    // 1. Connect without DB selected
    $pdo = getDBRoot();
    $messages[] = '✅ Connected to MySQL server.';

    // 2. Create database
    $pdo->exec('CREATE DATABASE IF NOT EXISTS bankerise_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    $messages[] = '✅ Database "bankerise_db" created (or already exists).';

    // 3. Select database
    $pdo->exec('USE bankerise_db');

    // 4. Read and execute SQL file (skip CREATE DATABASE / USE lines — we already did that)
    $sql = file_get_contents(__DIR__ . '/setup.sql');

    // Remove the CREATE DATABASE and USE lines since we already ran them
    $sql = preg_replace('/^CREATE DATABASE.*$/m', '', $sql);
    $sql = preg_replace('/^USE .*$/m', '', $sql);

    // Split into individual statements
    $statements = array_filter(
        array_map('trim', explode(';', $sql)),
        function($s) { return !empty($s) && $s !== ''; }
    );

    foreach ($statements as $stmt) {
        // Skip comments-only blocks
        $clean = trim(preg_replace('/--.*$/m', '', $stmt));
        if (empty($clean)) continue;

        $pdo->exec($stmt);
    }
    $messages[] = '✅ All tables created successfully.';

    // 5. Generate proper password hashes and update
    $db = getDB();

    $adminHash = password_hash('bankerise2026', PASSWORD_DEFAULT);
    $partnerHash = password_hash('partner123', PASSWORD_DEFAULT);

    $db->prepare("UPDATE users SET password_hash = ? WHERE email = 'admin@bankerise.com'")->execute([$adminHash]);
    $db->prepare("UPDATE users SET password_hash = ? WHERE email = 'amir@dbfinance.uz'")->execute([$partnerHash]);
    $db->prepare("UPDATE users SET password_hash = ? WHERE email = 'sophie@lyoncredit.fr'")->execute([$partnerHash]);

    $messages[] = '✅ User passwords hashed securely.';

    // 6. Verify
    $count = $db->query('SELECT COUNT(*) FROM partners')->fetchColumn();
    $messages[] = "✅ Seeded {$count} partners.";

    $userCount = $db->query('SELECT COUNT(*) FROM users')->fetchColumn();
    $messages[] = "✅ Seeded {$userCount} users.";

    $appCount = $db->query('SELECT COUNT(*) FROM applications')->fetchColumn();
    $messages[] = "✅ Seeded {$appCount} applications.";

} catch (Exception $e) {
    $success = false;
    $messages[] = '❌ Error: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bankerise — Database Installer</title>
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Segoe UI',sans-serif;background:#0D0F1C;color:#fff;display:flex;align-items:center;justify-content:center;min-height:100vh}
        .card{background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:40px;max-width:600px;width:100%;margin:20px}
        h1{font-size:24px;margin-bottom:8px}
        .sub{color:#94A3B8;font-size:14px;margin-bottom:24px}
        .msg{padding:10px 14px;border-radius:8px;font-size:13px;margin-bottom:8px}
        .msg.ok{background:rgba(34,197,94,0.1);color:#22C55E;border:1px solid rgba(34,197,94,0.2)}
        .msg.err{background:rgba(239,68,68,0.1);color:#EF4444;border:1px solid rgba(239,68,68,0.2)}
        .creds{margin-top:24px;padding:20px;background:rgba(77,184,205,0.08);border:1px solid rgba(77,184,205,0.2);border-radius:12px}
        .creds h3{color:#4DB8CD;font-size:14px;margin-bottom:12px}
        .creds p{font-size:13px;color:#CBD5E1;margin-bottom:4px}
        .creds strong{color:#fff}
        a.btn{display:inline-block;margin-top:24px;padding:12px 28px;background:linear-gradient(135deg,#4DB8CD,#766CFF);color:#fff;border-radius:10px;text-decoration:none;font-weight:600;font-size:14px}
        a.btn:hover{opacity:0.9}
    </style>
</head>
<body>
    <div class="card">
        <h1>🏦 Bankerise Database Installer</h1>
        <p class="sub">Setting up your MySQL database...</p>

        <?php foreach ($messages as $msg): ?>
            <div class="msg <?php echo strpos($msg, '❌') !== false ? 'err' : 'ok'; ?>">
                <?php echo $msg; ?>
            </div>
        <?php endforeach; ?>

        <?php if ($success): ?>
            <div class="creds">
                <h3>🔐 Default Login Credentials</h3>
                <p><strong>Admin:</strong> admin@bankerise.com / bankerise2026</p>
                <p><strong>Partner (Amir):</strong> amir@dbfinance.uz / partner123</p>
                <p><strong>Partner (Sophie):</strong> sophie@lyoncredit.fr / partner123</p>
            </div>
            <a href="/bankerise/partners/login.php" class="btn">Go to Login →</a>
        <?php else: ?>
            <p style="color:#EF4444;margin-top:16px;font-size:13px">Please fix the errors above and refresh this page.</p>
        <?php endif; ?>
    </div>
</body>
</html>
