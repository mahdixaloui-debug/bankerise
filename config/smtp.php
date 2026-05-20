<?php
/* ============================================
   Bankerise — Minimal SMTP client (no Composer)
   Supports STARTTLS + AUTH LOGIN (Gmail-compatible).
   Public API: sendMail($to, $toName, $subject, $htmlBody, $textBody=null)
   ============================================ */

function _smtpConfig() {
    static $cfg = null;
    if ($cfg === null) {
        $path = __DIR__ . '/mail.php';
        $cfg = is_file($path) ? require $path : [];
    }
    return $cfg;
}

function _smtpRead($fp) {
    $out = '';
    while (!feof($fp)) {
        $line = fgets($fp, 4096);
        if ($line === false) break;
        $out .= $line;
        // SMTP multi-line responses: code followed by '-' continues, by ' ' ends
        if (isset($line[3]) && $line[3] === ' ') break;
    }
    return $out;
}

function _smtpCmd($fp, $cmd, $expect = null, &$log = null) {
    if ($cmd !== null) {
        fwrite($fp, $cmd . "\r\n");
        if ($log !== null) $log[] = '> ' . $cmd;
    }
    $resp = _smtpRead($fp);
    if ($log !== null) $log[] = '< ' . trim($resp);
    if ($expect !== null) {
        $code = (int)substr($resp, 0, 3);
        $expected = is_array($expect) ? $expect : [$expect];
        if (!in_array($code, $expected, true)) {
            throw new RuntimeException("SMTP unexpected response: $resp");
        }
    }
    return $resp;
}

/**
 * Send an email via SMTP. Returns ['success'=>bool, 'error'=>string|null, 'log'=>array]
 */
function sendMail($to, $toName, $subject, $htmlBody, $textBody = null) {
    $cfg = _smtpConfig();
    if (empty($cfg['host']) || empty($cfg['username']) || empty($cfg['password'])) {
        return ['success' => false, 'error' => 'Mail not configured (config/mail.php missing).', 'log' => []];
    }

    $log = [];
    $fp = null;
    try {
        $errno = 0; $errstr = '';
        $fp = @stream_socket_client(
            'tcp://' . $cfg['host'] . ':' . (int)$cfg['port'],
            $errno, $errstr, 15, STREAM_CLIENT_CONNECT
        );
        if (!$fp) throw new RuntimeException("Connect failed: $errstr ($errno)");
        stream_set_timeout($fp, 15);

        _smtpCmd($fp, null, 220, $log); // greeting
        _smtpCmd($fp, 'EHLO localhost', 250, $log);
        _smtpCmd($fp, 'STARTTLS', 220, $log);

        // Upgrade to TLS — try the strongest method available, fall back if needed.
        $cryptoOk = @stream_socket_enable_crypto(
            $fp, true,
            STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT
            | (defined('STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT') ? STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT : 0)
        );
        if (!$cryptoOk) throw new RuntimeException('STARTTLS handshake failed');

        _smtpCmd($fp, 'EHLO localhost', 250, $log);
        _smtpCmd($fp, 'AUTH LOGIN', 334, $log);
        _smtpCmd($fp, base64_encode($cfg['username']), 334, $log);
        _smtpCmd($fp, base64_encode($cfg['password']), 235, $log);

        $fromEmail = $cfg['from_email'] ?? $cfg['username'];
        $fromName  = $cfg['from_name']  ?? 'Bankerise';

        _smtpCmd($fp, 'MAIL FROM:<' . $fromEmail . '>', 250, $log);
        _smtpCmd($fp, 'RCPT TO:<' . $to . '>', [250, 251], $log);
        _smtpCmd($fp, 'DATA', 354, $log);

        // Build MIME message (multipart/alternative if text alt provided)
        $boundary  = 'bk_' . bin2hex(random_bytes(8));
        $date      = date('r');
        $messageId = '<' . bin2hex(random_bytes(8)) . '@bankerise.local>';

        $headers  = "From: " . _mimeEncode($fromName) . " <$fromEmail>\r\n";
        $headers .= "To: " . _mimeEncode($toName ?: $to) . " <$to>\r\n";
        $headers .= "Subject: " . _mimeEncode($subject) . "\r\n";
        $headers .= "Date: $date\r\n";
        $headers .= "Message-ID: $messageId\r\n";
        $headers .= "MIME-Version: 1.0\r\n";

        if ($textBody !== null) {
            $headers .= "Content-Type: multipart/alternative; boundary=\"$boundary\"\r\n";
            $body  = "--$boundary\r\n";
            $body .= "Content-Type: text/plain; charset=UTF-8\r\n";
            $body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
            $body .= _dotStuff($textBody) . "\r\n";
            $body .= "--$boundary\r\n";
            $body .= "Content-Type: text/html; charset=UTF-8\r\n";
            $body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
            $body .= _dotStuff($htmlBody) . "\r\n";
            $body .= "--$boundary--\r\n";
        } else {
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            $headers .= "Content-Transfer-Encoding: 8bit\r\n";
            $body = _dotStuff($htmlBody);
        }

        _smtpCmd($fp, $headers . "\r\n" . $body . "\r\n.", 250, $log);
        _smtpCmd($fp, 'QUIT', [221, 250], $log);
        fclose($fp);

        return ['success' => true, 'error' => null, 'log' => $log];
    } catch (Throwable $e) {
        if ($fp) { @fwrite($fp, "QUIT\r\n"); @fclose($fp); }
        return ['success' => false, 'error' => $e->getMessage(), 'log' => $log];
    }
}

function _mimeEncode($s) {
    if (preg_match('/[^\x20-\x7E]/', $s)) {
        return '=?UTF-8?B?' . base64_encode($s) . '?=';
    }
    return $s;
}

/** RFC 5321 §4.5.2 — escape any line starting with a single dot. */
function _dotStuff($body) {
    $body = str_replace("\r\n", "\n", str_replace("\r", "\n", $body));
    $lines = explode("\n", $body);
    foreach ($lines as &$l) {
        if (isset($l[0]) && $l[0] === '.') $l = '.' . $l;
    }
    return implode("\r\n", $lines);
}

/**
 * Send the "your application was approved" email.
 * Returns the same shape as sendMail().
 */
function sendPartnerWelcomeEmail($toEmail, $toName, $tempPassword) {
    $cfg = _smtpConfig();
    $base = rtrim($cfg['app_base_url'] ?? 'http://localhost/bankerise', '/');
    $loginUrl = $base . '/partners/login.php';

    $safeName = htmlspecialchars($toName ?: 'Partner', ENT_QUOTES, 'UTF-8');
    $safeEmail = htmlspecialchars($toEmail, ENT_QUOTES, 'UTF-8');
    $safePass  = htmlspecialchars($tempPassword, ENT_QUOTES, 'UTF-8');

    $subject = 'Welcome to Bankerise — your partner account is ready';

    $html = <<<HTML
<!DOCTYPE html>
<html><head><meta charset="UTF-8"></head>
<body style="margin:0;padding:0;background:#0D0F1C;font-family:'Segoe UI',Arial,sans-serif;color:#E5E7EB">
  <div style="max-width:560px;margin:0 auto;padding:40px 24px">
    <div style="background:linear-gradient(135deg,#4DB8CD,#766CFF);padding:32px;border-radius:16px 16px 0 0;text-align:center">
      <h1 style="margin:0;color:#fff;font-size:24px;font-weight:800;letter-spacing:.5px">Bankerise®</h1>
      <p style="margin:8px 0 0;color:rgba(255,255,255,.85);font-size:13px">Partner Program</p>
    </div>
    <div style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-top:none;border-radius:0 0 16px 16px;padding:32px">
      <h2 style="margin:0 0 12px;color:#fff;font-size:20px">Welcome, {$safeName} 👋</h2>
      <p style="line-height:1.7;font-size:14px;color:#CBD5E1;margin:0 0 16px">
        Great news — your partner application has been <strong style="color:#22C55E">approved</strong>.
        We've created your Bankerise partner account so you can start reserving leads,
        chatting with prospects and tracking commissions.
      </p>
      <div style="background:rgba(77,184,205,0.08);border:1px solid rgba(77,184,205,0.25);border-radius:12px;padding:20px;margin:24px 0">
        <p style="margin:0 0 10px;color:#4DB8CD;font-size:12px;font-weight:700;letter-spacing:1px;text-transform:uppercase">Your sign-in credentials</p>
        <p style="margin:6px 0;font-size:14px;color:#fff"><strong>Email:</strong> {$safeEmail}</p>
        <p style="margin:6px 0;font-size:14px;color:#fff"><strong>Temporary password:</strong> <code style="background:rgba(0,0,0,0.3);padding:4px 8px;border-radius:6px;font-size:14px;color:#FCD34D">{$safePass}</code></p>
      </div>
      <p style="line-height:1.6;font-size:13px;color:#94A3B8;margin:0 0 24px">
        Please change this temporary password the first time you sign in.
      </p>
      <div style="text-align:center;margin:28px 0">
        <a href="{$loginUrl}" style="display:inline-block;background:linear-gradient(135deg,#4DB8CD,#766CFF);color:#fff;text-decoration:none;padding:14px 32px;border-radius:10px;font-weight:600;font-size:14px">Sign in to the partner portal →</a>
      </div>
      <hr style="border:none;border-top:1px solid rgba(255,255,255,0.08);margin:24px 0">
      <p style="font-size:11px;color:#64748B;line-height:1.6;margin:0">
        You're receiving this because someone applied to the Bankerise Partner Program using this email address.
        If that wasn't you, simply ignore this message.
      </p>
    </div>
  </div>
</body></html>
HTML;

    $text =
        "Welcome to Bankerise, {$toName}!\n\n" .
        "Your partner application has been approved.\n\n" .
        "Sign in here: {$loginUrl}\n" .
        "Email:    {$toEmail}\n" .
        "Password: {$tempPassword}\n\n" .
        "Please change this temporary password after your first sign-in.\n\n" .
        "— Bankerise Partner Team";

    return sendMail($toEmail, $toName, $subject, $html, $text);
}
