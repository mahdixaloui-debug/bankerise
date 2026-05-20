<?php
/* ============================================
   Bankerise — SMTP smoke test
   Open:  http://localhost/config/mail-test.php?to=you@example.com
   ============================================ */

require_once __DIR__ . '/smtp.php';

$to = $_GET['to'] ?? '';
$result = null;
if ($to && filter_var($to, FILTER_VALIDATE_EMAIL)) {
    $result = sendPartnerWelcomeEmail($to, 'Test Partner', 'demoPASS123');
}
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><title>SMTP test — Bankerise</title>
<style>
  body{font-family:'Segoe UI',sans-serif;background:#0D0F1C;color:#fff;display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0}
  .card{background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:36px;max-width:640px;width:100%;margin:20px}
  h1{font-size:22px;margin:0 0 16px}
  p{color:#94A3B8;font-size:14px}
  input,button{font:inherit;padding:10px 14px;border-radius:8px;border:1px solid rgba(255,255,255,0.12);background:rgba(255,255,255,0.04);color:#fff;outline:none}
  input{width:60%}
  button{background:linear-gradient(135deg,#4DB8CD,#766CFF);border:none;cursor:pointer;font-weight:600}
  .ok{background:rgba(34,197,94,0.1);color:#86EFAC;border:1px solid rgba(34,197,94,0.3);padding:12px;border-radius:10px;margin-top:16px;font-size:13px}
  .err{background:rgba(239,68,68,0.1);color:#FCA5A5;border:1px solid rgba(239,68,68,0.3);padding:12px;border-radius:10px;margin-top:16px;font-size:13px;white-space:pre-wrap;word-break:break-word}
  pre{background:#000;color:#9CA3AF;padding:14px;border-radius:8px;font-size:11px;max-height:280px;overflow:auto;margin-top:12px}
</style></head><body>
<div class="card">
  <h1>📧 SMTP smoke test</h1>
  <p>Sends the partner-welcome email to whatever address you enter — uses the same credentials configured in <code>config/mail.php</code>.</p>
  <form method="GET" style="margin-top:16px;display:flex;gap:8px">
    <input type="email" name="to" placeholder="you@example.com" value="<?= htmlspecialchars($to) ?>" required>
    <button type="submit">Send test</button>
  </form>
  <?php if ($result !== null): ?>
    <?php if ($result['success']): ?>
      <div class="ok">✅ Sent successfully to <strong><?= htmlspecialchars($to) ?></strong>. Check the inbox (and spam folder).</div>
    <?php else: ?>
      <div class="err">❌ Failed: <?= htmlspecialchars($result['error']) ?></div>
    <?php endif; ?>
    <?php if (!empty($result['log'])): ?>
      <pre><?php foreach ($result['log'] as $line) echo htmlspecialchars($line) . "\n"; ?></pre>
    <?php endif; ?>
  <?php endif; ?>
</div>
</body></html>
