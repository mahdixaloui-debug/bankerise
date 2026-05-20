<?php
/* ============================================
   Bankerise — Demo Data Reset
   Wipes ALL data from the live DB (keeps schema)
   and recreates the admin user.

   Run once: http://localhost/config/reset.php
   ============================================ */

require_once __DIR__ . '/database.php';

// Tiny CSRF: require an explicit confirm=yes in the URL
if (empty($_GET['confirm']) || $_GET['confirm'] !== 'yes') {
    ?>
    <!DOCTYPE html>
    <html lang="en"><head><meta charset="UTF-8"><title>Reset — Bankerise</title>
    <style>
      body{font-family:'Segoe UI',sans-serif;background:#0D0F1C;color:#fff;display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0}
      .card{background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:40px;max-width:560px;margin:20px}
      h1{font-size:22px;margin:0 0 12px}
      p{color:#94A3B8;font-size:14px;line-height:1.6;margin:0 0 16px}
      .warn{background:rgba(239,68,68,0.1);color:#FCA5A5;border:1px solid rgba(239,68,68,0.3);border-radius:10px;padding:14px;font-size:13px;margin-bottom:20px}
      a.btn{display:inline-block;padding:12px 24px;border-radius:10px;text-decoration:none;font-weight:600;font-size:14px;margin-right:8px}
      .btn-go{background:#EF4444;color:#fff}
      .btn-back{background:rgba(255,255,255,0.08);color:#fff}
    </style></head><body>
    <div class="card">
      <h1>⚠️ Reset Demo Data</h1>
      <div class="warn">This will <strong>permanently delete</strong> every partner, application, lead, message, notification, report and uploaded avatar in <code>bankerise_db</code>. Only the schema and the admin login are kept.</div>
      <p>Use this to give the jury a clean slate so they can watch the full flow: apply → admin approves → partner logs in → reserves leads → chats → uploads photo.</p>
      <a class="btn btn-go" href="?confirm=yes">Yes, wipe everything</a>
      <a class="btn btn-back" href="/partners/backoffice.php">Cancel</a>
    </div></body></html>
    <?php
    exit;
}

$messages = [];
$ok = true;

try {
    $db = getDB();

    // Tables that hold demo data — order matters only insofar as foreign keys go,
    // but we have none defined, so simple TRUNCATE works.
    $tables = [
        'lead_messages',
        'notifications',
        'reports',
        'leads',
        'applications',
        'contact_messages',
        'activity_log',
        'partners',
    ];

    $db->exec('SET FOREIGN_KEY_CHECKS=0');
    foreach ($tables as $t) {
        try {
            $db->exec("TRUNCATE TABLE `$t`");
            $messages[] = "✅ Cleared <code>$t</code>";
        } catch (Throwable $e) {
            // Table might not exist on older installs — ignore
            $messages[] = "⚠️ Skipped <code>$t</code> (" . htmlspecialchars($e->getMessage()) . ')';
        }
    }

    // Drop every user except the admin, then unlink partner_id
    $db->exec("DELETE FROM users WHERE role <> 'admin'");
    $db->exec("UPDATE users SET partner_id = NULL");
    $messages[] = '✅ Removed all non-admin users';

    // Ensure the admin row exists with a known password
    $adminHash = password_hash('bankerise2026', PASSWORD_DEFAULT);
    $exists = (int)$db->query("SELECT COUNT(*) FROM users WHERE email='admin@bankerise.com'")->fetchColumn();
    if ($exists === 0) {
        $db->prepare("INSERT INTO users (full_name, email, password_hash, role) VALUES ('System Admin', 'admin@bankerise.com', ?, 'admin')")
           ->execute([$adminHash]);
        $messages[] = '✅ Re-created admin account';
    } else {
        $db->prepare("UPDATE users SET password_hash=?, is_active=1 WHERE email='admin@bankerise.com'")->execute([$adminHash]);
        $messages[] = '✅ Admin password reset to <strong>bankerise2026</strong>';
    }

    $db->exec('SET FOREIGN_KEY_CHECKS=1');

    // Wipe uploaded avatars from disk
    $dir = realpath(__DIR__ . '/..') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'avatars';
    $removed = 0;
    if (is_dir($dir)) {
        foreach (glob($dir . DIRECTORY_SEPARATOR . '*') as $f) {
            if (is_file($f) && @unlink($f)) $removed++;
        }
    }
    $messages[] = "✅ Deleted $removed uploaded avatar file(s)";

} catch (Throwable $e) {
    $ok = false;
    $messages[] = '❌ ' . htmlspecialchars($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Reset Complete — Bankerise</title>
    <style>
        body{font-family:'Segoe UI',sans-serif;background:#0D0F1C;color:#fff;display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0}
        .card{background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:40px;max-width:600px;margin:20px;width:100%}
        h1{font-size:24px;margin:0 0 16px}
        .msg{padding:10px 14px;border-radius:8px;font-size:13px;margin-bottom:6px;background:rgba(34,197,94,0.08);color:#86EFAC;border:1px solid rgba(34,197,94,0.2)}
        .creds{margin-top:20px;padding:18px;background:rgba(77,184,205,0.08);border:1px solid rgba(77,184,205,0.2);border-radius:12px}
        .creds h3{color:#4DB8CD;font-size:14px;margin:0 0 8px}
        .creds p{font-size:13px;color:#CBD5E1;margin:4px 0}
        a.btn{display:inline-block;margin-top:20px;padding:12px 24px;background:linear-gradient(135deg,#4DB8CD,#766CFF);color:#fff;border-radius:10px;text-decoration:none;font-weight:600;font-size:14px;margin-right:8px}
    </style>
</head>
<body>
<div class="card">
  <h1>🧹 Database Reset Complete</h1>
  <?php foreach ($messages as $m): ?>
    <div class="msg"><?= $m ?></div>
  <?php endforeach; ?>
  <?php if ($ok): ?>
    <div class="creds">
      <h3>🔐 Login</h3>
      <p><strong>Admin:</strong> admin@bankerise.com / bankerise2026</p>
      <p style="opacity:.7;margin-top:6px">No partner accounts. Use the public Apply form to create one and approve it from the backoffice.</p>
    </div>
    <a class="btn" href="/partners/login.php">Go to Login →</a>
    <a class="btn" style="background:rgba(255,255,255,0.08)" href="/partners/apply.php">Open Apply Form →</a>
  <?php endif; ?>
</div>
</body></html>
