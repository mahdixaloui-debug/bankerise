<?php
require_once __DIR__ . '/../config/auth.php';
requireLogin();
$user = currentUser();

// Fetch the partner record linked to this user (if any)
$partner = null;
if (!empty($user['partner_id'])) {
    $stmt = getDB()->prepare('SELECT * FROM partners WHERE id = ?');
    $stmt->execute([$user['partner_id']]);
    $partner = $stmt->fetch();
}

// Display fields with sensible fallbacks
$displayName   = $user['full_name'] ?: 'Partner';
$displayEmail  = $user['email'] ?: '';
$displayTier   = $partner['tier']   ?? 'Bronze';
$displayStatus = $partner['status'] ?? 'Pending';
$displayCompany= $partner['company']?? '';

// Initials (up to 2 letters)
$parts = preg_split('/\s+/', trim($displayName));
$initials = strtoupper(substr($parts[0] ?? 'P', 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
if ($initials === '') $initials = 'P';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Partner Dashboard — Bankerise®</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            pacific: '#4DB8CD', aqua: '#766CFF', bell: '#4799D1',
            grape: '#4C4E89', dark: '#0D0F1C', dark2: '#141729', dark3: '#1A1D35',
            surface: '#111827', card: '#1F2937',
          },
          fontFamily: { montserrat: ['Montserrat', 'sans-serif'] },
        }
      }
    }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/shared.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:'Montserrat',sans-serif;background:#0D0F1C;color:#fff;overflow-x:hidden;position:relative}
    ::-webkit-scrollbar{width:6px;height:6px}
    ::-webkit-scrollbar-track{background:transparent}
    ::-webkit-scrollbar-thumb{background:rgba(77,184,205,0.2);border-radius:3px}
    ::-webkit-scrollbar-thumb:hover{background:rgba(77,184,205,0.4)}

    /* ─── Ambient Background (mirrors index.php hero) ─── */
    .dash-bg{position:fixed;inset:0;z-index:-2;overflow:hidden;pointer-events:none;background:#0D0F1C}
    .dash-bg .blob{position:absolute;border-radius:50%;filter:blur(100px);opacity:0.22;will-change:transform}
    .dash-bg .blob-1{width:520px;height:520px;background:#4DB8CD;top:-12%;right:-6%;animation:dash-blob 22s ease-in-out infinite}
    .dash-bg .blob-2{width:460px;height:460px;background:#766CFF;bottom:-10%;left:18%;animation:dash-blob 26s ease-in-out infinite -7s}
    .dash-bg .blob-3{width:380px;height:380px;background:#4C4E89;top:35%;left:55%;animation:dash-blob 30s ease-in-out infinite -14s;opacity:0.18}
    @keyframes dash-blob{
      0%,100%{transform:translate(0,0) scale(1)}
      33%{transform:translate(40px,-30px) scale(1.08)}
      66%{transform:translate(-25px,25px) scale(0.94)}
    }
    .dash-bg-grid{position:fixed;inset:0;z-index:-1;pointer-events:none;
      background-image:
        linear-gradient(rgba(255,255,255,0.018) 1px,transparent 1px),
        linear-gradient(90deg,rgba(255,255,255,0.018) 1px,transparent 1px);
      background-size:64px 64px;
      mask-image:radial-gradient(ellipse 80% 60% at 55% 40%,black 20%,transparent 75%);
      -webkit-mask-image:radial-gradient(ellipse 80% 60% at 55% 40%,black 20%,transparent 75%);
    }
    .dash-bg-noise{position:fixed;inset:0;z-index:-1;pointer-events:none;opacity:0.035;mix-blend-mode:overlay;
      background-image:url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='180' height='180'><filter id='n'><feTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='2' stitchTiles='stitch'/></filter><rect width='100%' height='100%' filter='url(%23n)' opacity='0.7'/></svg>");
    }

    /* ─── Sidebar (high contrast vs main) ─── */
    .sidebar{
      position:fixed;top:0;left:0;width:264px;height:100vh;
      background:linear-gradient(180deg,#05070F 0%,#070A14 55%,#05070F 100%);
      border-right:1px solid rgba(77,184,205,0.08);
      box-shadow:1px 0 0 rgba(255,255,255,0.02), 4px 0 30px rgba(0,0,0,0.35);
      z-index:40;display:flex;flex-direction:column;transition:transform 0.3s
    }
    .sidebar-head{position:relative;padding:20px 20px 18px;border-bottom:1px solid rgba(255,255,255,0.05)}
    .sidebar-head::after{content:'';position:absolute;left:20px;right:20px;bottom:-1px;height:1px;background:linear-gradient(90deg,transparent,rgba(77,184,205,0.4),transparent)}
    .sidebar-logo-row{display:flex;align-items:center;gap:12px}
    .sidebar-logo{height:34px;width:auto;filter:drop-shadow(0 2px 8px rgba(77,184,205,0.25))}
    .sidebar-brand-badge{
      display:inline-flex;align-items:center;gap:6px;
      margin-top:10px;padding:4px 10px;
      border-radius:9999px;
      background:linear-gradient(135deg,rgba(77,184,205,0.18),rgba(118,108,255,0.18));
      border:1px solid rgba(77,184,205,0.35);
      font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;
      color:#4DB8CD;
      box-shadow:0 0 12px rgba(77,184,205,0.12) inset;
    }
    .sidebar-brand-badge::before{
      content:'';width:6px;height:6px;border-radius:50%;
      background:#4DB8CD;box-shadow:0 0 8px #4DB8CD;
      animation:dash-pulse 2s ease-in-out infinite;
    }
    @keyframes dash-pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:0.5;transform:scale(1.25)}}

    .sidebar-link{
      display:flex;align-items:center;gap:12px;
      padding:10px 16px;font-size:13px;font-weight:500;color:#9CA3AF;
      border-radius:10px;margin:2px 10px;cursor:pointer;
      transition:all 0.25s ease;border:1px solid transparent;background:none;
      width:calc(100% - 20px);text-align:left;position:relative;overflow:hidden;
    }
    .sidebar-link::before{
      content:'';position:absolute;left:0;top:50%;transform:translateY(-50%);
      width:3px;height:0;border-radius:0 3px 3px 0;
      background:linear-gradient(180deg,#4DB8CD,#766CFF);
      transition:height 0.25s ease;
    }
    .sidebar-link:hover{color:#fff;background:rgba(255,255,255,0.04);border-color:rgba(255,255,255,0.06);transform:translateX(2px)}
    .sidebar-link:hover::before{height:60%}
    .sidebar-link.active{
      color:#4DB8CD;font-weight:600;
      background:linear-gradient(90deg,rgba(77,184,205,0.12),rgba(77,184,205,0.02));
      border-color:rgba(77,184,205,0.18);
    }
    .sidebar-link.active::before{height:70%}
    .sidebar-link svg{width:18px;height:18px;flex-shrink:0}
    .sidebar-group-label{padding:0 24px;font-size:10px;font-weight:700;color:#4B5563;text-transform:uppercase;letter-spacing:0.12em;margin-bottom:6px;margin-top:18px}
    .sidebar-badge{margin-left:auto;font-size:10px;font-weight:700;padding:2px 8px;border-radius:9999px;background:rgba(77,184,205,0.15);color:#4DB8CD;border:1px solid rgba(77,184,205,0.25)}

    .sidebar-user{
      padding:14px;margin:10px;border-radius:14px;
      background:rgba(255,255,255,0.03);
      border:1px solid rgba(255,255,255,0.06);
      transition:all 0.25s ease;
    }
    .sidebar-user:hover{border-color:rgba(77,184,205,0.2);background:rgba(255,255,255,0.05)}

    /* ─── Main content ─── */
    .main-content{
      margin-left:264px;min-height:100vh;padding:0;position:relative;
      background:
        radial-gradient(ellipse 80% 50% at 80% 10%, rgba(77,184,205,0.07) 0%, transparent 60%),
        radial-gradient(ellipse 60% 50% at 20% 90%, rgba(118,108,255,0.06) 0%, transparent 60%),
        radial-gradient(ellipse 50% 40% at 60% 50%, rgba(76,78,137,0.04) 0%, transparent 60%),
        linear-gradient(180deg, #0D0F1C 0%, #0A0C18 50%, #0D0F1C 100%);
      background-attachment:scroll;
    }
    .topbar{
      position:sticky;top:0;z-index:30;
      background:rgba(13,15,28,0.55);
      backdrop-filter:blur(18px) saturate(140%);
      -webkit-backdrop-filter:blur(18px) saturate(140%);
      border-bottom:1px solid rgba(255,255,255,0.06);
      padding:16px 32px;display:flex;align-items:center;justify-content:space-between
    }

    /* ─── Cards (index.php glass style) ─── */
    .stat-card{
      background:rgba(255,255,255,0.04);
      border:1px solid rgba(255,255,255,0.08);
      backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);
      border-radius:16px;padding:24px;
      transition:transform 0.35s cubic-bezier(0.25,0.46,0.45,0.94),border-color 0.3s,box-shadow 0.35s;
      position:relative;overflow:hidden;
    }
    .stat-card::after{
      content:'';position:absolute;top:-50%;left:-50%;width:200%;height:200%;
      background:linear-gradient(45deg,transparent 40%,rgba(255,255,255,0.04) 45%,rgba(255,255,255,0.07) 50%,rgba(255,255,255,0.04) 55%,transparent 60%);
      transform:translateX(-100%);transition:transform 0.7s ease;pointer-events:none;
    }
    .stat-card:hover{
      border-color:rgba(77,184,205,0.35);
      transform:translateY(-4px);
      box-shadow:0 18px 50px rgba(0,0,0,0.35),0 0 40px rgba(77,184,205,0.08);
    }
    .stat-card:hover::after{transform:translateX(100%)}

    /* ─── Table ─── */
    .data-table{width:100%;border-collapse:separate;border-spacing:0}
    .data-table thead th{padding:13px 16px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#64748B;text-align:left;border-bottom:1px solid rgba(255,255,255,0.08);position:sticky;top:0;background:rgba(13,15,28,0.85);backdrop-filter:blur(12px)}
    .data-table tbody td{padding:14px 16px;font-size:13px;color:#CBD5E1;border-bottom:1px solid rgba(255,255,255,0.04)}
    .data-table tbody tr{transition:background 0.25s ease}
    .data-table tbody tr:hover{background:linear-gradient(90deg,rgba(77,184,205,0.06),rgba(118,108,255,0.04))}
    .data-table tbody tr:last-child td{border-bottom:none}

    /* ─── Badges ─── */
    .badge{display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:600;padding:4px 10px;border-radius:9999px;letter-spacing:0.02em}
    .badge-pending{background:rgba(251,191,36,0.12);color:#FBBF24;border:1px solid rgba(251,191,36,0.25)}
    .badge-approved,.badge-paid,.badge-resolved{background:rgba(34,197,94,0.12);color:#22C55E;border:1px solid rgba(34,197,94,0.25)}
    .badge-rejected,.badge-closed{background:rgba(239,68,68,0.12);color:#EF4444;border:1px solid rgba(239,68,68,0.25)}
    .badge-processing,.badge-progress{background:rgba(77,184,205,0.12);color:#4DB8CD;border:1px solid rgba(77,184,205,0.25)}
    .badge-open{background:rgba(118,108,255,0.12);color:#766CFF;border:1px solid rgba(118,108,255,0.25)}

    /* ─── Kanban ─── */
    .kanban-col{min-width:280px;background:rgba(255,255,255,0.025);border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:16px;flex-shrink:0;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px)}
    .kanban-card{
      background:rgba(255,255,255,0.05);
      border:1px solid rgba(255,255,255,0.08);
      border-radius:12px;padding:16px;margin-bottom:10px;cursor:grab;
      transition:all 0.25s ease;position:relative;
    }
    .kanban-card:hover{border-color:rgba(77,184,205,0.35);transform:translateY(-3px);box-shadow:0 10px 30px rgba(0,0,0,0.25),0 0 20px rgba(77,184,205,0.06)}
    .kanban-card:active{cursor:grabbing}

    /* ─── Buttons (index.php style) ─── */
    .btn-p{
      display:inline-flex;align-items:center;gap:8px;
      padding:10px 20px;
      background:linear-gradient(135deg,#4DB8CD,#766CFF);
      color:#fff;font-weight:600;font-size:13px;
      border-radius:10px;border:none;cursor:pointer;
      font-family:'Montserrat',sans-serif;
      transition:transform 0.25s ease,box-shadow 0.25s ease;
      box-shadow:0 6px 20px rgba(77,184,205,0.25);
      position:relative;overflow:hidden;
    }
    .btn-p::after{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(255,255,255,0.15),transparent);opacity:0;transition:opacity 0.3s}
    .btn-p:hover{transform:translateY(-2px);box-shadow:0 12px 35px rgba(77,184,205,0.4)}
    .btn-p:hover::after{opacity:1}
    .btn-p:active{transform:translateY(0)}
    .btn-s{
      display:inline-flex;align-items:center;gap:8px;
      padding:10px 20px;
      background:rgba(255,255,255,0.05);
      border:1px solid rgba(255,255,255,0.12);
      color:#fff;font-weight:500;font-size:13px;
      border-radius:10px;cursor:pointer;
      font-family:'Montserrat',sans-serif;
      transition:all 0.25s ease;
    }
    .btn-s:hover{background:rgba(255,255,255,0.1);border-color:rgba(77,184,205,0.35);transform:translateY(-1px)}

    /* ─── Input ─── */
    .input{padding:10px 14px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:#fff;font-size:13px;outline:none;font-family:'Montserrat',sans-serif;transition:all 0.25s;width:100%}
    .input:focus{border-color:#4DB8CD;background:rgba(77,184,205,0.06);box-shadow:0 0 0 3px rgba(77,184,205,0.15)}
    .input::placeholder{color:rgba(255,255,255,0.3)}
    select.input{cursor:pointer;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='rgba(255,255,255,0.4)' viewBox='0 0 16 16'%3E%3Cpath d='M4 6l4 4 4-4'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center}
    select.input option{background:#1F2937;color:#fff}
    textarea.input{resize:vertical;min-height:80px}

    /* ─── Modal ─── */
    .modal-overlay{position:fixed;inset:0;background:rgba(5,7,15,0.7);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);z-index:50;display:none;align-items:center;justify-content:center;padding:24px}
    .modal-overlay.open{display:flex}
    .modal-box{
      background:rgba(20,23,41,0.92);
      backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);
      border:1px solid rgba(77,184,205,0.18);
      border-radius:20px;width:100%;max-width:640px;max-height:90vh;overflow-y:auto;padding:32px;
      box-shadow:0 30px 80px rgba(0,0,0,0.6),0 0 60px rgba(77,184,205,0.08);
    }

    /* ─── Step indicator ─── */
    .step-indicator{display:flex;align-items:center;gap:0;margin-bottom:32px}
    .step-dot{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;border:2px solid rgba(255,255,255,0.1);color:#64748B;transition:all 0.3s;flex-shrink:0}
    .step-dot.active{border-color:#4DB8CD;color:#4DB8CD;background:rgba(77,184,205,0.1);box-shadow:0 0 14px rgba(77,184,205,0.35)}
    .step-dot.done{border-color:#22C55E;color:#fff;background:#22C55E}
    .step-line{flex:1;height:2px;background:rgba(255,255,255,0.08);margin:0 8px}
    .step-line.done{background:#22C55E}

    /* ─── Resource / Feature cards ─── */
    .resource-card{background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:14px;padding:20px;transition:all 0.35s cubic-bezier(0.25,0.46,0.45,0.94);cursor:pointer}
    .resource-card:hover{border-color:rgba(77,184,205,0.35);transform:translateY(-4px);box-shadow:0 14px 40px rgba(0,0,0,0.3),0 0 30px rgba(77,184,205,0.08)}
    .feature-card{background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:28px;text-align:center;transition:all 0.35s cubic-bezier(0.25,0.46,0.45,0.94)}
    .feature-card:hover{border-color:rgba(77,184,205,0.35);transform:translateY(-6px);box-shadow:0 16px 44px rgba(0,0,0,0.3),0 0 40px rgba(77,184,205,0.1)}

    /* ─── Chat widget (FAB trigger) ─── */
    .chat-widget{position:fixed;bottom:24px;right:24px;width:56px;height:56px;border-radius:50%;background:linear-gradient(135deg,#4DB8CD,#766CFF);display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 8px 30px rgba(77,184,205,0.4);z-index:60;transition:all 0.3s;border:none}
    .chat-widget:hover{transform:scale(1.08) rotate(-4deg);box-shadow:0 14px 50px rgba(77,184,205,0.55)}
    .chat-widget .fab-badge{
      position:absolute;top:-4px;right:-4px;min-width:20px;height:20px;padding:0 5px;border-radius:10px;
      background:#EF4444;color:#fff;font-size:11px;font-weight:700;
      display:none;align-items:center;justify-content:center;
      box-shadow:0 0 0 2px #0D0F1C,0 4px 12px rgba(239,68,68,0.5);
      animation:chat-pulse-dot 2s ease-in-out infinite;
    }
    .chat-widget .fab-badge.active{display:flex}
    @keyframes chat-pulse-dot{0%,100%{transform:scale(1)}50%{transform:scale(1.15)}}

    /* ─── Chat Panel (slides from right) ─── */
    .chat-panel{
      position:fixed;top:0;right:0;width:420px;max-width:92vw;height:100vh;
      background:linear-gradient(180deg,#0A0C18 0%,#0D0F1C 100%);
      border-left:1px solid rgba(77,184,205,0.12);
      box-shadow:-8px 0 40px rgba(0,0,0,0.55);
      z-index:70;transform:translateX(100%);transition:transform 0.35s cubic-bezier(0.25,0.46,0.45,0.94);
      display:flex;flex-direction:column;
    }
    .chat-panel.open{transform:translateX(0)}
    .chat-panel-head{
      padding:16px 18px;border-bottom:1px solid rgba(255,255,255,0.06);
      display:flex;align-items:center;gap:12px;
      background:linear-gradient(90deg,rgba(77,184,205,0.08),transparent);
    }
    .chat-panel-head .back-btn{display:none;width:32px;height:32px;border-radius:8px;align-items:center;justify-content:center;color:#94A3B8;cursor:pointer;border:none;background:transparent;transition:all .2s}
    .chat-panel-head .back-btn:hover{background:rgba(255,255,255,0.05);color:#fff}
    .chat-panel-head.in-thread .back-btn{display:flex}
    .chat-panel-title{flex:1;min-width:0}
    .chat-panel-title p.t{font-size:14px;font-weight:700;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .chat-panel-title p.s{font-size:11px;color:#64748B;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .chat-close-btn{width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#94A3B8;background:transparent;border:none;cursor:pointer;transition:all .2s}
    .chat-close-btn:hover{background:rgba(255,255,255,0.06);color:#fff}

    .chat-search{padding:12px 14px;border-bottom:1px solid rgba(255,255,255,0.04)}
    .chat-search input{width:100%;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.06);border-radius:10px;padding:10px 12px 10px 36px;color:#fff;font-size:12px;font-family:inherit;outline:none;transition:border-color .2s}
    .chat-search input:focus{border-color:rgba(77,184,205,0.4)}
    .chat-search{position:relative}
    .chat-search svg{position:absolute;left:26px;top:50%;transform:translateY(-50%);width:14px;height:14px;color:#64748B;pointer-events:none}

    .chat-thread-list{flex:1;overflow-y:auto;padding:6px 0}
    .chat-thread-item{display:flex;align-items:center;gap:12px;padding:12px 16px;cursor:pointer;transition:background .2s;border-left:2px solid transparent}
    .chat-thread-item:hover{background:rgba(77,184,205,0.05)}
    .chat-thread-item.active{background:rgba(77,184,205,0.08);border-left-color:#4DB8CD}
    .chat-avatar{width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,#4DB8CD,#766CFF);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;color:#fff;flex-shrink:0}
    .chat-thread-meta{flex:1;min-width:0}
    .chat-thread-meta .row1{display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:3px}
    .chat-thread-meta .name{font-size:13px;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .chat-thread-meta .time{font-size:10px;color:#64748B;flex-shrink:0}
    .chat-thread-meta .preview{font-size:11px;color:#94A3B8;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:flex;align-items:center;gap:6px}
    .chat-thread-meta .preview.unread{color:#fff;font-weight:600}
    .chat-unread-dot{background:#4DB8CD;color:#fff;min-width:18px;height:18px;padding:0 6px;border-radius:9px;font-size:10px;font-weight:700;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0}

    .chat-thread-view{flex:1;display:none;flex-direction:column;min-height:0}
    .chat-thread-view.active{display:flex}
    .chat-messages{flex:1;overflow-y:auto;padding:18px 16px;display:flex;flex-direction:column;gap:10px}
    .chat-msg{max-width:78%;padding:9px 13px;border-radius:14px;font-size:12.5px;line-height:1.5;word-wrap:break-word;position:relative}
    .chat-msg .t{display:block;font-size:9px;color:#64748B;margin-top:3px;letter-spacing:.03em}
    .chat-msg.out{align-self:flex-end;background:linear-gradient(135deg,#4DB8CD,#766CFF);color:#fff;border-bottom-right-radius:4px}
    .chat-msg.out .t{color:rgba(255,255,255,0.75);text-align:right}
    .chat-msg.in{align-self:flex-start;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.06);color:#E5E7EB;border-bottom-left-radius:4px}
    .chat-msg .msg-del{position:absolute;top:-8px;right:-8px;width:22px;height:22px;border-radius:50%;background:#EF4444;color:#fff;border:2px solid #0D0F1C;display:none;align-items:center;justify-content:center;cursor:pointer;font-size:12px;line-height:1;padding:0}
    .chat-msg.out:hover .msg-del{display:flex}
    .chat-msg .msg-del:hover{background:#DC2626;transform:scale(1.1)}
    .chat-msg-empty{text-align:center;color:#64748B;font-size:12px;padding:32px 16px}
    .chat-day-sep{align-self:center;font-size:10px;color:#475569;padding:4px 10px;background:rgba(255,255,255,0.03);border-radius:8px;text-transform:uppercase;letter-spacing:.1em}

    .chat-compose{border-top:1px solid rgba(255,255,255,0.06);padding:12px;display:flex;gap:8px;align-items:flex-end;background:rgba(10,12,24,0.6)}
    .chat-compose textarea{flex:1;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:12px;padding:10px 12px;color:#fff;font-size:12.5px;font-family:inherit;resize:none;outline:none;min-height:40px;max-height:120px;transition:border-color .2s}
    .chat-compose textarea:focus{border-color:rgba(77,184,205,0.4)}
    .chat-send-btn{width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,#4DB8CD,#766CFF);border:none;color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 4px 14px rgba(77,184,205,0.35);transition:all .2s}
    .chat-send-btn:hover:not(:disabled){transform:scale(1.05);box-shadow:0 6px 20px rgba(77,184,205,0.5)}
    .chat-send-btn:disabled{opacity:0.4;cursor:not-allowed;transform:none}
    .chat-simulate{font-size:10px;color:#64748B;text-align:center;padding:6px;cursor:pointer;border-top:1px solid rgba(255,255,255,0.04);transition:color .2s}
    .chat-simulate:hover{color:#4DB8CD}

    /* ─── Notification bell dropdown ─── */
    .notif-wrap{position:relative}
    .notif-btn{position:relative;color:#94A3B8;padding:8px;background:transparent;border:none;cursor:pointer;transition:color .2s;border-radius:8px}
    .notif-btn:hover{color:#fff;background:rgba(255,255,255,0.04)}
    .notif-count{position:absolute;top:2px;right:2px;min-width:16px;height:16px;padding:0 4px;border-radius:8px;background:#EF4444;color:#fff;font-size:10px;font-weight:700;display:none;align-items:center;justify-content:center;box-shadow:0 0 0 2px #0D0F1C}
    .notif-count.active{display:flex}
    .notif-dropdown{
      position:absolute;top:calc(100% + 8px);right:0;width:360px;max-width:92vw;
      background:linear-gradient(180deg,#0A0C18 0%,#0D0F1C 100%);
      border:1px solid rgba(77,184,205,0.15);border-radius:14px;
      box-shadow:0 20px 60px rgba(0,0,0,0.6);
      z-index:55;opacity:0;transform:translateY(-8px);pointer-events:none;transition:all .25s;
      max-height:70vh;display:flex;flex-direction:column;
    }
    .notif-dropdown.open{opacity:1;transform:translateY(0);pointer-events:auto}
    .notif-head{padding:14px 16px;border-bottom:1px solid rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:space-between}
    .notif-head h4{font-size:13px;font-weight:700;color:#fff}
    .notif-head button{font-size:11px;color:#4DB8CD;background:transparent;border:none;cursor:pointer;font-family:inherit;font-weight:600}
    .notif-head button:hover{text-decoration:underline}
    .notif-list{overflow-y:auto;flex:1}
    .notif-item{display:flex;gap:12px;padding:12px 16px;border-bottom:1px solid rgba(255,255,255,0.03);cursor:pointer;transition:background .2s;position:relative}
    .notif-item:hover{background:rgba(77,184,205,0.04)}
    .notif-item.unread{background:rgba(77,184,205,0.03)}
    .notif-item.unread::before{content:'';position:absolute;left:6px;top:50%;transform:translateY(-50%);width:6px;height:6px;border-radius:50%;background:#4DB8CD;box-shadow:0 0 6px #4DB8CD}
    .notif-icon{width:34px;height:34px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .notif-icon.message{background:rgba(77,184,205,0.12);color:#4DB8CD}
    .notif-icon.lead{background:rgba(34,197,94,0.12);color:#22C55E}
    .notif-icon.finance{background:rgba(251,191,36,0.12);color:#FBBF24}
    .notif-icon.info{background:rgba(118,108,255,0.12);color:#766CFF}
    .notif-body{flex:1;min-width:0}
    .notif-body .t{font-size:12.5px;font-weight:600;color:#fff;margin-bottom:2px}
    .notif-body .b{font-size:11px;color:#94A3B8;line-height:1.4;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .notif-body .ts{font-size:10px;color:#64748B;margin-top:4px}
    .notif-empty{padding:32px 16px;text-align:center;color:#64748B;font-size:12px}

    @media (max-width:640px){
      .chat-panel{width:100vw}
      .notif-dropdown{width:calc(100vw - 32px);right:-10px}
    }

    /* ─── Section ─── */
    .dash-section{display:none;padding:32px;position:relative;z-index:1}
    .dash-section.active{display:block;animation:dash-fade 0.4s ease}
    @keyframes dash-fade{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}

    /* ─── Data container (rounded wrapper around tables) ─── */
    .data-wrap{
      border-radius:16px;
      border:1px solid rgba(255,255,255,0.08);
      background:rgba(13,15,28,0.55);
      backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);
      overflow:hidden;
      box-shadow:0 10px 30px rgba(0,0,0,0.25);
    }

    /* ─── Responsive ─── */
    @media(max-width:1024px){
      .sidebar{transform:translateX(-100%)}
      .sidebar.open{transform:translateX(0)}
      .main-content{margin-left:0}
      .topbar{padding:12px 16px}
    }

    /* ─── Mobile overlay for sidebar ─── */
    .sidebar-backdrop{
      display:none;position:fixed;inset:0;background:rgba(5,7,15,0.6);
      backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px);
      z-index:35;opacity:0;transition:opacity 0.3s ease;
    }
    .sidebar-backdrop.visible{display:block;opacity:1}

    /* ─── Tablet & Small Desktop (≤1024px) ─── */
    @media(max-width:1024px){
      .dash-section{padding:24px 16px}
    }

    /* ─── Mobile (≤768px) ─── */
    @media(max-width:768px){
      .dash-section{padding:20px 14px}
      .topbar{padding:10px 14px;gap:8px}
      .topbar #global-search{width:120px}
      .topbar h1#section-title{font-size:15px}
      .stat-card{padding:18px}
      .data-table thead th{padding:10px 12px;font-size:10px;letter-spacing:0.08em}
      .data-table tbody td{padding:10px 12px;font-size:12px}
      .kanban-col{min-width:240px;padding:12px}
      .kanban-card{padding:12px}
      .modal-box{padding:20px;border-radius:16px}
      .resource-card{padding:16px}
      .feature-card{padding:20px}
      .stat-card .flex.items-center.gap-4{gap:12px}

      /* Force ALL 2-col grids to single column */
      .grid-cols-2{grid-template-columns:1fr !important}

      /* Support section — force single column, table fits screen */
      #sec-support > .grid{grid-template-columns:1fr !important;gap:24px !important}
      #sec-support .data-table{min-width:0 !important;width:100% !important;table-layout:auto}
      #sec-support .data-table thead th,
      #sec-support .data-table tbody td{white-space:normal;word-break:break-word;padding:8px 6px !important;font-size:11px !important}

      /* Reports section — force single column, table fits screen */
      #sec-reports > .grid{grid-template-columns:1fr !important;gap:24px !important}
      #sec-reports .lg\:col-span-2,
      #sec-reports .lg\:col-span-3{grid-column:span 1 !important}
      #sec-reports .data-table{min-width:0 !important;width:100% !important;table-layout:auto}
      #sec-reports .data-table thead th,
      #sec-reports .data-table tbody td{white-space:normal;word-break:break-word;padding:8px 6px !important;font-size:11px !important}
      /* Hide Period column on mobile to save space */
      #sec-reports .data-table thead th:nth-child(3),
      #sec-reports .data-table tbody td:nth-child(3){display:none}

      /* Profile section — force single column */
      #sec-profile > .grid{grid-template-columns:1fr !important}
      #sec-profile .lg\:col-span-2{grid-column:span 1 !important}
    }

    /* ─── Small Mobile (≤480px) ─── */
    @media(max-width:480px){
      .dash-section{padding:16px 10px}
      .topbar{padding:8px 10px}
      .topbar #global-search{width:100px;font-size:11px}
      .topbar h1#section-title{font-size:14px}
      .stat-card p.text-2xl{font-size:1.3rem}
      .data-table{font-size:11px}
      .data-table thead th{padding:8px 8px;font-size:9px}
      .data-table tbody td{padding:8px 8px;font-size:11px;white-space:nowrap}
      .kanban-col{min-width:220px;padding:10px}
      .kanban-card{padding:10px}
      .kanban-card p.text-sm{font-size:12px}
      .modal-overlay{padding:10px}
      .modal-box{padding:16px;max-height:95vh;border-radius:14px}
      .step-dot{width:28px;height:28px;font-size:11px}
      .step-line{margin:0 4px}
      .btn-p{padding:8px 16px;font-size:12px}
      .btn-s{padding:8px 16px;font-size:12px}
      .toggle-btn{padding:5px 10px;font-size:11px}
      .input{padding:8px 12px;font-size:12px}
      .chat-widget{width:48px;height:48px;bottom:16px;right:16px}
      .dash-section > .flex.flex-wrap{gap:8px}
      .modal-box .grid-cols-2{grid-template-columns:1fr !important}

      /* Support — compact */
      #sec-support .grid{gap:16px !important}
      #sec-support .border-dashed{padding:16px 12px}
      #sec-support .btn-p{width:100%;justify-content:center}

      /* Reports — compact + full-width button */
      #sec-reports .grid{gap:16px !important}
      #sec-reports .btn-p{width:100%;justify-content:center}
      #sec-reports textarea.input{min-height:100px}
    }

    /* ─── Ensure horizontal scroll hint on tables ─── */
    .overflow-x-auto{-webkit-overflow-scrolling:touch}
    .overflow-x-auto::-webkit-scrollbar{height:4px}
    .overflow-x-auto::-webkit-scrollbar-thumb{background:rgba(77,184,205,0.15);border-radius:2px}

    /* Make table wrappers scrollable on mobile */
    @media(max-width:768px){
      .rounded-xl.border{overflow-x:auto;-webkit-overflow-scrolling:touch}
      .rounded-xl.border::-webkit-scrollbar{height:4px}
      .rounded-xl.border::-webkit-scrollbar-thumb{background:rgba(77,184,205,0.15);border-radius:2px}
      .data-table{min-width:600px}
    }

    /* ─── Pipeline stage colors ─── */
    .stage-contacted{color:#766CFF}.stage-bg-contacted{background:rgba(118,108,255,0.1);border-color:rgba(118,108,255,0.2)}
    .stage-qualified{color:#4DB8CD}.stage-bg-qualified{background:rgba(77,184,205,0.1);border-color:rgba(77,184,205,0.2)}
    .stage-proposal{color:#FBBF24}.stage-bg-proposal{background:rgba(251,191,36,0.1);border-color:rgba(251,191,36,0.2)}
    .stage-negotiation{color:#F97316}.stage-bg-negotiation{background:rgba(249,115,22,0.1);border-color:rgba(249,115,22,0.2)}
    .stage-closing{color:#22C55E}.stage-bg-closing{background:rgba(34,197,94,0.1);border-color:rgba(34,197,94,0.2)}

    /* ─── Toggle ─── */
    .toggle-btn{padding:6px 14px;font-size:12px;font-weight:600;border-radius:8px;border:1px solid rgba(255,255,255,0.1);background:transparent;color:#94A3B8;cursor:pointer;transition:all 0.25s;font-family:'Montserrat',sans-serif;white-space:nowrap;flex-shrink:0}
    .toggle-btn:hover{color:#fff;border-color:rgba(255,255,255,0.25)}
    .toggle-btn.active{background:rgba(77,184,205,0.12);border-color:rgba(77,184,205,0.4);color:#4DB8CD;box-shadow:0 0 12px rgba(77,184,205,0.15)}

    /* ─── Gradient text reusable ─── */
    .dash-gradient-text{background:linear-gradient(135deg,#4DB8CD,#766CFF);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
  </style>
</head>
<body class="font-montserrat">

<!-- ═══════════════════════════════════════════════
     AMBIENT BACKGROUND (mirrors index.php hero)
     ═══════════════════════════════════════════════ -->
<div class="dash-bg" aria-hidden="true">
  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>
  <div class="blob blob-3"></div>
</div>
<div class="dash-bg-grid" aria-hidden="true"></div>
<div class="dash-bg-noise" aria-hidden="true"></div>

<!-- ═══════════════════════════════════════════════
     SIDEBAR
     ═══════════════════════════════════════════════ -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar-head">
    <a href="../index.php" class="sidebar-logo-row">
      <img src="../assets/images/brand/logo-white.svg" alt="Bankerise" class="sidebar-logo site-logo" />
    </a>
    <span class="sidebar-brand-badge">Partner Space</span>
  </div>

  <div class="flex-1 overflow-y-auto py-3">
    <p class="sidebar-group-label">Pipeline</p>
    <button class="sidebar-link active" data-section="leads" onclick="showSection('leads')">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
      Reserved Leads <span class="sidebar-badge">12</span>
    </button>
    <button class="sidebar-link" data-section="deals" onclick="showSection('deals')">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
      Deals in Progress <span class="sidebar-badge">8</span>
    </button>
    <button class="sidebar-link" data-section="signed" onclick="showSection('signed')">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      Signed Deals
    </button>

    <p class="sidebar-group-label">Finance</p>
    <button class="sidebar-link" data-section="commissions" onclick="showSection('commissions')">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      Commissions
    </button>

    <p class="sidebar-group-label">Resources</p>
    <button class="sidebar-link" data-section="documents" onclick="showSection('documents')">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
      Documents
    </button>
    <button class="sidebar-link" data-section="features" onclick="showSection('features')">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
      Key Features
    </button>

    <p class="sidebar-group-label">Account</p>
    <button class="sidebar-link" data-section="profile" onclick="showSection('profile')">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
      My Profile
    </button>
    <button class="sidebar-link" data-section="reports" onclick="showSection('reports')">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h13M9 17H4a1 1 0 01-1-1V4a1 1 0 011-1h5m0 14V3m0 0h5a1 1 0 011 1v5M9 3l5 5"/></svg>
      Reports
    </button>

    <p class="sidebar-group-label">Help</p>
    <button class="sidebar-link" data-section="support" onclick="showSection('support')">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
      Support <span class="sidebar-badge" style="background:rgba(239,68,68,0.15);color:#EF4444">2</span>
    </button>
  </div>

  <div class="sidebar-user">
    <div class="flex items-center gap-3">
      <div id="sidebar-avatar" class="w-9 h-9 rounded-full bg-gradient-to-br from-pacific to-aqua flex items-center justify-center text-xs font-bold shadow-lg shadow-pacific/30 overflow-hidden"<?php if(!empty($partner['avatar'])): ?> style="background-image:url('/uploads/avatars/<?= htmlspecialchars($partner['avatar']) ?>');background-size:cover;background-position:center;color:transparent"<?php endif; ?>><?= htmlspecialchars($initials) ?></div>
      <div class="flex-1 min-w-0">
        <p class="text-xs font-semibold text-white truncate"><?= htmlspecialchars($displayName) ?></p>
        <p class="text-[10px] text-pacific font-semibold tracking-wider uppercase"><?= htmlspecialchars($displayTier) ?> Partner</p>
      </div>
      <a href="javascript:void(0)" onclick="fetch('/api/auth.php',{method:'DELETE'}).then(function(){window.location.href='login.php'}).catch(function(){window.location.href='login.php'})" class="text-gray-500 hover:text-red-400 transition-colors" title="Sign out">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
      </a>
    </div>
  </div>
</aside>
<div class="sidebar-backdrop" id="sidebar-backdrop" onclick="closeSidebar()"></div>

<!-- ═══════════════════════════════════════════════
     MAIN CONTENT
     ═══════════════════════════════════════════════ -->
<div class="main-content">

  <!-- Topbar -->
  <div class="topbar">
    <div class="flex items-center gap-3">
      <button class="lg:hidden text-white p-1" onclick="toggleSidebar()">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
      </button>
      <h1 class="text-lg font-bold" id="section-title">Reserved Leads</h1>
    </div>
    <div class="flex items-center gap-3">
      <div class="relative">
        <input type="text" placeholder="Search..." class="input !py-2 !text-xs !pl-9 w-48 max-[768px]:w-28 max-[480px]:w-20" id="global-search">
        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
      </div>
      <div class="notif-wrap">
        <button class="notif-btn" id="notif-btn" aria-label="Notifications" onclick="toggleNotif(event)">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
          <span class="notif-count" id="notif-count">0</span>
        </button>
        <div class="notif-dropdown" id="notif-dropdown">
          <div class="notif-head">
            <h4>Notifications</h4>
            <button onclick="markAllNotifRead()">Mark all read</button>
          </div>
          <div class="notif-list" id="notif-list">
            <div class="notif-empty">Loading…</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SECTION 1: RESERVED LEADS
       ═══════════════════════════════════════════ -->
  <div class="dash-section active" id="sec-leads">
    <!-- Filters -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
      <div class="flex flex-wrap items-center gap-3 max-[480px]:gap-2 max-[480px]:w-full">
        <select class="input !py-2 !text-xs w-36 max-[480px]:w-full"><option>All Statuses</option><option>Pending</option><option>Approved</option><option>Rejected</option></select>
        <select class="input !py-2 !text-xs w-36 max-[480px]:w-full"><option>All Industries</option><option>Banking</option><option>Insurance</option><option>Microfinance</option><option>Fintech</option></select>
        <input type="date" class="input !py-2 !text-xs w-40 max-[480px]:w-full">
      </div>
      <button class="btn-p max-[480px]:w-full max-[480px]:justify-center" onclick="openModal()">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Reserve a New Lead
      </button>
    </div>

    <!-- Table -->
    <div class="rounded-xl border border-white/5 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="data-table">
          <thead><tr>
            <th>Lead Name</th><th>Company</th><th>Industry</th><th>Date Reserved</th><th>Status</th><th>Actions</th>
          </tr></thead>
          <tbody id="leads-tbody">
            <tr><td colspan="6" class="text-center text-gray-500 py-6 text-xs">Loading leads…</td></tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- Count -->
    <div class="flex items-center justify-between mt-4 text-xs text-gray-500">
      <span id="leads-count">—</span>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SECTION 2: DEALS IN PROGRESS
       ═══════════════════════════════════════════ -->
  <div class="dash-section" id="sec-deals">
    <div class="flex items-center justify-between mb-6">
      <div class="flex gap-2">
        <button class="toggle-btn active" onclick="setView(this,'kanban')">Kanban</button>
        <button class="toggle-btn" onclick="setView(this,'list')">List</button>
      </div>
      <p class="text-xs text-gray-500">8 active deals · €1.85M pipeline</p>
    </div>

    <!-- Kanban -->
    <div class="flex gap-4 overflow-x-auto pb-4" id="kanban-view">
      <div class="kanban-col">
        <div class="flex items-center gap-2 mb-4"><span class="w-2.5 h-2.5 rounded-full bg-[#766CFF]"></span><h3 class="text-sm font-bold">Contacted</h3><span class="text-xs text-gray-500">2</span></div>
        <div class="kanban-card"><p class="text-sm font-semibold text-white mb-1">Atlas Microfinance</p><p class="text-xs text-gray-500 mb-2">€120,000</p><div class="flex items-center justify-between"><span class="text-[10px] text-gray-600">Apr 8</span><span class="badge badge-open text-[10px]">Contacted</span></div></div>
        <div class="kanban-card"><p class="text-sm font-semibold text-white mb-1">Tunis Digital Bank</p><p class="text-xs text-gray-500 mb-2">€85,000</p><div class="flex items-center justify-between"><span class="text-[10px] text-gray-600">Apr 6</span><span class="badge badge-open text-[10px]">Contacted</span></div></div>
      </div>
      <div class="kanban-col">
        <div class="flex items-center gap-2 mb-4"><span class="w-2.5 h-2.5 rounded-full bg-pacific"></span><h3 class="text-sm font-bold">Qualified</h3><span class="text-xs text-gray-500">2</span></div>
        <div class="kanban-card"><p class="text-sm font-semibold text-white mb-1">Gulf Digital Solutions</p><p class="text-xs text-gray-500 mb-2">€340,000</p><div class="flex items-center justify-between"><span class="text-[10px] text-gray-600">Apr 5</span><span class="badge badge-processing text-[10px]">Qualified</span></div></div>
        <div class="kanban-card"><p class="text-sm font-semibold text-white mb-1">Lyon Crédit Union</p><p class="text-xs text-gray-500 mb-2">€210,000</p><div class="flex items-center justify-between"><span class="text-[10px] text-gray-600">Apr 4</span><span class="badge badge-processing text-[10px]">Qualified</span></div></div>
      </div>
      <div class="kanban-col">
        <div class="flex items-center gap-2 mb-4"><span class="w-2.5 h-2.5 rounded-full bg-[#FBBF24]"></span><h3 class="text-sm font-bold">Proposal Sent</h3><span class="text-xs text-gray-500">2</span></div>
        <div class="kanban-card"><p class="text-sm font-semibold text-white mb-1">Cairo MFI Group</p><p class="text-xs text-gray-500 mb-2">€180,000</p><div class="flex items-center justify-between"><span class="text-[10px] text-gray-600">Apr 3</span><span class="badge badge-pending text-[10px]">Proposal</span></div></div>
        <div class="kanban-card"><p class="text-sm font-semibold text-white mb-1">Almaty FinServ</p><p class="text-xs text-gray-500 mb-2">€290,000</p><div class="flex items-center justify-between"><span class="text-[10px] text-gray-600">Apr 1</span><span class="badge badge-pending text-[10px]">Proposal</span></div></div>
      </div>
      <div class="kanban-col">
        <div class="flex items-center gap-2 mb-4"><span class="w-2.5 h-2.5 rounded-full bg-[#F97316]"></span><h3 class="text-sm font-bold">Negotiation</h3><span class="text-xs text-gray-500">1</span></div>
        <div class="kanban-card"><p class="text-sm font-semibold text-white mb-1">Tashkent Digital</p><p class="text-xs text-gray-500 mb-2">€420,000</p><div class="flex items-center justify-between"><span class="text-[10px] text-gray-600">Mar 29</span><span class="badge text-[10px]" style="background:rgba(249,115,22,0.1);color:#F97316;border:1px solid rgba(249,115,22,0.2)">Negotiation</span></div></div>
      </div>
      <div class="kanban-col">
        <div class="flex items-center gap-2 mb-4"><span class="w-2.5 h-2.5 rounded-full bg-[#22C55E]"></span><h3 class="text-sm font-bold">Closing</h3><span class="text-xs text-gray-500">1</span></div>
        <div class="kanban-card" style="border-color:rgba(34,197,94,0.2)"><p class="text-sm font-semibold text-white mb-1">Casablanca Finance</p><p class="text-xs text-gray-500 mb-2">€205,000</p><div class="flex items-center justify-between"><span class="text-[10px] text-gray-600">Mar 26</span><span class="badge badge-approved text-[10px]">Closing</span></div></div>
      </div>
    </div>

    <!-- List view (hidden by default) -->
    <div class="hidden rounded-xl border border-white/5 overflow-hidden" id="list-view">
      <table class="data-table"><thead><tr><th>Client</th><th>Value</th><th>Stage</th><th>Last Activity</th><th>Next Step</th></tr></thead>
        <tbody>
          <tr><td class="font-medium text-white">Atlas Microfinance</td><td>€120,000</td><td><span class="badge badge-open">Contacted</span></td><td>Apr 8</td><td class="text-xs">Schedule demo</td></tr>
          <tr><td class="font-medium text-white">Gulf Digital Solutions</td><td>€340,000</td><td><span class="badge badge-processing">Qualified</span></td><td>Apr 5</td><td class="text-xs">Send proposal</td></tr>
          <tr><td class="font-medium text-white">Cairo MFI Group</td><td>€180,000</td><td><span class="badge badge-pending">Proposal</span></td><td>Apr 3</td><td class="text-xs">Follow up call</td></tr>
          <tr><td class="font-medium text-white">Tashkent Digital</td><td>€420,000</td><td><span class="badge" style="background:rgba(249,115,22,0.1);color:#F97316;border:1px solid rgba(249,115,22,0.2)">Negotiation</span></td><td>Mar 29</td><td class="text-xs">Final pricing</td></tr>
          <tr><td class="font-medium text-white">Casablanca Finance</td><td>€205,000</td><td><span class="badge badge-approved">Closing</span></td><td>Mar 26</td><td class="text-xs">Contract signing</td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SECTION 3: SIGNED DEALS
       ═══════════════════════════════════════════ -->
  <div class="dash-section" id="sec-signed">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
      <div class="stat-card"><p class="text-xs text-gray-500 mb-1">Total Deals Signed</p><p class="text-2xl font-extrabold text-white">24</p></div>
      <div class="stat-card"><p class="text-xs text-gray-500 mb-1">Total Revenue Generated</p><p class="text-2xl font-extrabold" style="color:#22C55E">€4.2M</p></div>
      <div class="stat-card"><p class="text-xs text-gray-500 mb-1">Avg Deal Size</p><p class="text-2xl font-extrabold text-pacific">€175K</p></div>
    </div>
    <div class="flex justify-end mb-4"><button class="btn-s" onclick="exportCSV()"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>Export CSV</button></div>
    <div class="rounded-xl border border-white/5 overflow-hidden">
      <table class="data-table"><thead><tr><th>Client</th><th>Deal Value</th><th>Signing Date</th><th>Commission %</th><th>Commission Earned</th><th>Status</th></tr></thead>
        <tbody>
          <tr><td class="font-medium text-white">Algiers National Bank</td><td>€520,000</td><td>Mar 15, 2026</td><td>18%</td><td class="text-green-400 font-semibold">€93,600</td><td><span class="badge badge-approved">Active</span></td></tr>
          <tr><td class="font-medium text-white">Rabat MFI Network</td><td>€180,000</td><td>Feb 28, 2026</td><td>18%</td><td class="text-green-400 font-semibold">€32,400</td><td><span class="badge badge-approved">Active</span></td></tr>
          <tr><td class="font-medium text-white">Dubai FinBank</td><td>€750,000</td><td>Feb 10, 2026</td><td>25%</td><td class="text-green-400 font-semibold">€187,500</td><td><span class="badge badge-approved">Active</span></td></tr>
          <tr><td class="font-medium text-white">Lyon Savings Co</td><td>€310,000</td><td>Jan 22, 2026</td><td>18%</td><td class="text-green-400 font-semibold">€55,800</td><td><span class="badge badge-approved">Active</span></td></tr>
          <tr><td class="font-medium text-white">Bishkek Digital</td><td>€420,000</td><td>Jan 5, 2026</td><td>25%</td><td class="text-green-400 font-semibold">€105,000</td><td><span class="badge badge-pending">Renewal</span></td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SECTION 4: COMMISSIONS
       ═══════════════════════════════════════════ -->
  <div class="dash-section" id="sec-commissions">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
      <div class="stat-card"><p class="text-xs text-gray-500 mb-1">Total Earned</p><p class="text-2xl font-extrabold" style="color:#22C55E">€474,300</p><p class="text-[10px] text-green-500 mt-1">↑ 23% vs last quarter</p></div>
      <div class="stat-card"><p class="text-xs text-gray-500 mb-1">Pending Payment</p><p class="text-2xl font-extrabold text-yellow-400">€93,600</p><p class="text-[10px] text-gray-500 mt-1">2 invoices processing</p></div>
      <div class="stat-card"><p class="text-xs text-gray-500 mb-1">Paid to Date</p><p class="text-2xl font-extrabold text-pacific">€380,700</p><p class="text-[10px] text-gray-500 mt-1">Last payout: Apr 1</p></div>
    </div>
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-sm font-bold">Monthly Commissions</h3>
      <button class="btn-p !py-2 !text-xs">Request Payout</button>
    </div>
    <div class="stat-card mb-8" style="padding:20px"><canvas id="commission-chart" height="200"></canvas></div>
    <h3 class="text-sm font-bold mb-4">Transaction History</h3>
    <div class="rounded-xl border border-white/5 overflow-hidden">
      <table class="data-table"><thead><tr><th>Date</th><th>Deal Reference</th><th>Amount</th><th>Status</th></tr></thead>
        <tbody>
          <tr><td>Apr 1, 2026</td><td class="text-white">Dubai FinBank — Q1</td><td class="text-green-400 font-semibold">€62,500</td><td><span class="badge badge-approved">Paid</span></td></tr>
          <tr><td>Mar 15, 2026</td><td class="text-white">Algiers National — Setup</td><td class="text-yellow-400 font-semibold">€93,600</td><td><span class="badge badge-pending">Pending</span></td></tr>
          <tr><td>Mar 1, 2026</td><td class="text-white">Lyon Savings — Q4</td><td class="text-green-400 font-semibold">€55,800</td><td><span class="badge badge-approved">Paid</span></td></tr>
          <tr><td>Feb 15, 2026</td><td class="text-white">Bishkek Digital — Q4</td><td class="text-green-400 font-semibold">€105,000</td><td><span class="badge badge-approved">Paid</span></td></tr>
          <tr><td>Feb 1, 2026</td><td class="text-white">Rabat MFI — Setup</td><td class="text-green-400 font-semibold">€32,400</td><td><span class="badge badge-approved">Paid</span></td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SECTION 5: DOCUMENTS & RESOURCES
       ═══════════════════════════════════════════ -->
  <div class="dash-section" id="sec-documents">
    <div class="flex flex-wrap items-center gap-3 mb-6 max-[480px]:flex-nowrap max-[480px]:overflow-x-auto max-[480px]:pb-2 max-[480px]:-mx-2 max-[480px]:px-2">
      <button class="toggle-btn active" onclick="filterDocs(this,'all')">All</button>
      <button class="toggle-btn" onclick="filterDocs(this,'sales')">Sales Decks</button>
      <button class="toggle-btn" onclick="filterDocs(this,'product')">Product Sheets</button>
      <button class="toggle-btn" onclick="filterDocs(this,'tech')">Technical</button>
      <button class="toggle-btn" onclick="filterDocs(this,'training')">Training</button>
      <button class="toggle-btn" onclick="filterDocs(this,'legal')">Legal</button>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4" id="doc-grid">
      <div class="resource-card" data-cat="sales"><div class="flex items-center justify-between mb-3"><span class="badge" style="background:rgba(239,68,68,0.1);color:#EF4444;border:1px solid rgba(239,68,68,0.2)">PDF</span><span class="text-[10px] text-gray-600">Updated Apr 5</span></div><h4 class="font-bold text-sm mb-1">Bankerise Sales Deck 2026</h4><p class="text-xs text-gray-500 mb-4">Complete sales presentation with ROI calculators and case studies.</p><a href="download-doc.php?doc=sales-deck" class="btn-s !py-2 !text-xs w-full justify-center" style="text-decoration:none"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>Download</a></div>
      <div class="resource-card" data-cat="product"><div class="flex items-center justify-between mb-3"><span class="badge" style="background:rgba(77,184,205,0.1);color:#4DB8CD;border:1px solid rgba(77,184,205,0.2)">PDF</span><span class="text-[10px] text-gray-600">Updated Mar 20</span></div><h4 class="font-bold text-sm mb-1">Platform Overview</h4><p class="text-xs text-gray-500 mb-4">End-to-end product datasheet covering all modules and integrations.</p><a href="download-doc.php?doc=platform-overview" class="btn-s !py-2 !text-xs w-full justify-center" style="text-decoration:none"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>Download</a></div>
      <div class="resource-card" data-cat="tech"><div class="flex items-center justify-between mb-3"><span class="badge" style="background:rgba(118,108,255,0.1);color:#766CFF;border:1px solid rgba(118,108,255,0.2)">HTML</span><span class="text-[10px] text-gray-600">Updated Mar 15</span></div><h4 class="font-bold text-sm mb-1">API Integration Guide</h4><p class="text-xs text-gray-500 mb-4">Technical reference for REST API endpoints, authentication, and webhooks.</p><a href="download-doc.php?doc=api-guide" class="btn-s !py-2 !text-xs w-full justify-center" style="text-decoration:none"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>Download</a></div>
      <div class="resource-card" data-cat="training"><div class="flex items-center justify-between mb-3"><span class="badge" style="background:rgba(251,191,36,0.1);color:#FBBF24;border:1px solid rgba(251,191,36,0.2)">HTML</span><span class="text-[10px] text-gray-600">Updated Feb 28</span></div><h4 class="font-bold text-sm mb-1">Partner Onboarding Kit</h4><p class="text-xs text-gray-500 mb-4">Step-by-step onboarding guide with checklists and training schedule.</p><a href="download-doc.php?doc=onboarding-kit" class="btn-s !py-2 !text-xs w-full justify-center" style="text-decoration:none"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>Download</a></div>
      <div class="resource-card" data-cat="legal"><div class="flex items-center justify-between mb-3"><span class="badge" style="background:rgba(239,68,68,0.1);color:#EF4444;border:1px solid rgba(239,68,68,0.2)">PDF</span><span class="text-[10px] text-gray-600">Updated Jan 10</span></div><h4 class="font-bold text-sm mb-1">Partner Agreement Template</h4><p class="text-xs text-gray-500 mb-4">Standard partnership contract with commission schedules and SLAs.</p><a href="download-doc.php?doc=partner-agreement" class="btn-s !py-2 !text-xs w-full justify-center" style="text-decoration:none"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>Download</a></div>
      <div class="resource-card" data-cat="sales"><div class="flex items-center justify-between mb-3"><span class="badge" style="background:rgba(251,191,36,0.1);color:#FBBF24;border:1px solid rgba(251,191,36,0.2)">HTML</span><span class="text-[10px] text-gray-600">Updated Mar 1</span></div><h4 class="font-bold text-sm mb-1">ROI Calculator Deck</h4><p class="text-xs text-gray-500 mb-4">Interactive presentation to show prospects their projected returns.</p><a href="download-doc.php?doc=roi-calculator" class="btn-s !py-2 !text-xs w-full justify-center" style="text-decoration:none"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>Download</a></div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SECTION 6: SUPPORT
       ═══════════════════════════════════════════ -->
  <div class="dash-section" id="sec-support">
    <div class="grid lg:grid-cols-2 gap-8">
      <!-- Open Ticket Form -->
      <div>
        <h3 class="text-sm font-bold mb-4">Open a Support Ticket</h3>
        <div class="stat-card">
          <div class="space-y-4">
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Subject</label><input class="input" placeholder="Brief description of your issue"></div>
            <div class="grid grid-cols-2 gap-3">
              <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Priority</label><select class="input"><option>Low</option><option>Medium</option><option selected>High</option><option>Urgent</option></select></div>
              <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Category</label><select class="input"><option>Technical</option><option>Billing</option><option>Sales</option><option>Other</option></select></div>
            </div>
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Description</label><textarea class="input" rows="4" placeholder="Describe your issue in detail..."></textarea></div>
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Attachment</label><div class="border border-dashed border-white/10 rounded-xl p-6 text-center"><svg class="w-8 h-8 text-gray-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg><p class="text-xs text-gray-500">Drag & drop or <span class="text-pacific cursor-pointer">browse files</span></p></div></div>
            <button class="btn-p w-full justify-center">Submit Ticket</button>
          </div>
        </div>
      </div>
      <!-- My Tickets -->
      <div>
        <h3 class="text-sm font-bold mb-4">My Tickets</h3>
        <div class="rounded-xl border border-white/5 overflow-hidden">
          <table class="data-table"><thead><tr><th>ID</th><th>Subject</th><th>Status</th><th>Updated</th></tr></thead>
            <tbody>
              <tr><td class="text-pacific font-mono text-xs">#TK-1042</td><td class="font-medium text-white text-xs">API webhook not triggering</td><td><span class="badge badge-progress">In Progress</span></td><td class="text-xs">2h ago</td></tr>
              <tr><td class="text-pacific font-mono text-xs">#TK-1038</td><td class="font-medium text-white text-xs">Commission discrepancy Q1</td><td><span class="badge badge-open">Open</span></td><td class="text-xs">1d ago</td></tr>
              <tr><td class="text-pacific font-mono text-xs">#TK-1031</td><td class="font-medium text-white text-xs">Sandbox access expired</td><td><span class="badge badge-approved">Resolved</span></td><td class="text-xs">3d ago</td></tr>
              <tr><td class="text-pacific font-mono text-xs">#TK-1025</td><td class="font-medium text-white text-xs">Contract renewal questions</td><td><span class="badge badge-rejected">Closed</span></td><td class="text-xs">5d ago</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SECTION 7: KEY FEATURES
       ═══════════════════════════════════════════ -->
  <div class="dash-section" id="sec-features">
    <p class="text-gray-400 text-sm mb-8 max-w-xl">Everything your partnership needs to thrive — from pipeline management to performance analytics.</p>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
      <div class="feature-card"><div class="w-12 h-12 rounded-2xl bg-pacific/10 flex items-center justify-center mx-auto mb-4"><svg class="w-6 h-6 text-pacific" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg></div><h4 class="font-bold text-sm mb-2">Lead Management</h4><p class="text-xs text-gray-500 leading-relaxed">Reserve, track, and qualify leads with full pipeline visibility and automated status updates.</p></div>
      <div class="feature-card"><div class="w-12 h-12 rounded-2xl bg-green-500/10 flex items-center justify-center mx-auto mb-4"><svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div><h4 class="font-bold text-sm mb-2">Commission Tracking</h4><p class="text-xs text-gray-500 leading-relaxed">Real-time visibility into earned, pending, and paid commissions with monthly breakdowns.</p></div>
      <div class="feature-card"><div class="w-12 h-12 rounded-2xl bg-aqua/10 flex items-center justify-center mx-auto mb-4"><svg class="w-6 h-6 text-aqua" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg></div><h4 class="font-bold text-sm mb-2">Enablement Resources</h4><p class="text-xs text-gray-500 leading-relaxed">Sales decks, technical docs, and training materials — always up to date and ready to deploy.</p></div>
      <div class="feature-card"><div class="w-12 h-12 rounded-2xl bg-bell/10 flex items-center justify-center mx-auto mb-4"><svg class="w-6 h-6 text-bell" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div><h4 class="font-bold text-sm mb-2">Dedicated Support</h4><p class="text-xs text-gray-500 leading-relaxed">Ticket system, live chat, and a named partner manager for priority assistance.</p></div>
      <div class="feature-card"><div class="w-12 h-12 rounded-2xl bg-yellow-500/10 flex items-center justify-center mx-auto mb-4"><svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg></div><h4 class="font-bold text-sm mb-2">Performance Analytics</h4><p class="text-xs text-gray-500 leading-relaxed">Dashboards and reports to monitor KPIs, pipeline health, and revenue trends.</p></div>
      <div class="feature-card"><div class="w-12 h-12 rounded-2xl bg-grape/10 flex items-center justify-center mx-auto mb-4"><svg class="w-6 h-6 text-grape" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div><h4 class="font-bold text-sm mb-2">Contract Management</h4><p class="text-xs text-gray-500 leading-relaxed">Track signings, renewals, and contract statuses with automated notifications.</p></div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SECTION 8: MY PROFILE
       ═══════════════════════════════════════════ -->
  <div class="dash-section" id="sec-profile">
    <div class="grid lg:grid-cols-3 gap-6">
      <!-- Summary card -->
      <div class="stat-card">
        <div class="flex items-center gap-4 mb-5">
          <div class="relative group">
            <div id="prof-avatar" class="w-16 h-16 rounded-2xl bg-gradient-to-br from-pacific to-aqua flex items-center justify-center text-xl font-extrabold shadow-lg shadow-pacific/30 overflow-hidden cursor-pointer"<?php if(!empty($partner['avatar'])): ?> style="background-image:url('/uploads/avatars/<?= htmlspecialchars($partner['avatar']) ?>');background-size:cover;background-position:center;color:transparent"<?php endif; ?> onclick="document.getElementById('avatar-input').click()" title="Click to change photo"><?= htmlspecialchars($initials) ?></div>
            <button type="button" onclick="document.getElementById('avatar-input').click()" class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-pacific hover:bg-aqua flex items-center justify-center shadow-lg border-2 border-dark2 transition-colors" title="Upload photo">
              <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </button>
            <input type="file" id="avatar-input" accept="image/png,image/jpeg,image/webp,image/gif" class="hidden" onchange="uploadAvatar(this)">
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-base font-bold text-white" id="prof-sum-name"><?= htmlspecialchars($displayName) ?></p>
            <p class="text-[11px] text-pacific font-semibold tracking-wider uppercase"><?= htmlspecialchars($displayTier) ?> Partner</p>
            <div class="flex items-center gap-2 mt-1">
              <button type="button" class="text-[10px] text-pacific hover:underline" onclick="document.getElementById('avatar-input').click()">Change photo</button>
              <?php if(!empty($partner['avatar'])): ?>
              <span class="text-gray-600">·</span>
              <button type="button" id="avatar-remove-btn" class="text-[10px] text-red-400 hover:underline" onclick="removeAvatar()">Remove</button>
              <?php endif; ?>
              <span id="avatar-msg" class="text-[10px] text-gray-500"></span>
            </div>
          </div>
        </div>
        <div class="space-y-3 text-xs">
          <div class="flex justify-between"><span class="text-gray-500">Status</span><span class="badge badge-approved"><?= htmlspecialchars($displayStatus) ?></span></div>
          <div class="flex justify-between"><span class="text-gray-500">Email</span><span class="text-white truncate ml-2" id="prof-sum-email"><?= htmlspecialchars($displayEmail) ?></span></div>
          <div class="flex justify-between"><span class="text-gray-500">Company</span><span class="text-white truncate ml-2" id="prof-sum-company"><?= htmlspecialchars($displayCompany ?: '—') ?></span></div>
          <div class="flex justify-between"><span class="text-gray-500">Country</span><span class="text-white" id="prof-sum-country"><?= htmlspecialchars($partner['country'] ?? '—') ?></span></div>
          <div class="flex justify-between"><span class="text-gray-500">Region</span><span class="text-white" id="prof-sum-region"><?= htmlspecialchars($partner['region'] ?? '—') ?></span></div>
          <div class="pt-3 border-t border-white/5">
            <p class="text-gray-500 mb-1">Pipeline Progress</p>
            <div class="h-1.5 rounded-full bg-white/5 overflow-hidden"><div class="h-full bg-gradient-to-r from-pacific to-aqua" style="width:<?= (int)($partner['progress'] ?? 0) ?>%"></div></div>
            <p class="text-[10px] text-gray-500 mt-1"><?= (int)($partner['progress'] ?? 0) ?>%</p>
          </div>
        </div>
      </div>
      <!-- Edit form -->
      <div class="lg:col-span-2 stat-card">
        <h3 class="text-sm font-bold mb-1">Edit Profile</h3>
        <p class="text-xs text-gray-500 mb-5">Keep your details up to date. These power the partner directory and commission records.</p>
        <form id="profile-form" class="space-y-4" onsubmit="return false">
          <div class="grid sm:grid-cols-2 gap-3">
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Full Name *</label><input class="input" name="name" value="<?= htmlspecialchars($displayName) ?>" required></div>
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Email *</label><input class="input" type="email" name="email" value="<?= htmlspecialchars($displayEmail) ?>" required></div>
          </div>
          <div class="grid sm:grid-cols-2 gap-3">
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Phone</label><input class="input" name="phone" value="<?= htmlspecialchars($partner['phone'] ?? '') ?>"></div>
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Country</label><input class="input" name="country" value="<?= htmlspecialchars($partner['country'] ?? '') ?>"></div>
          </div>
          <div class="grid sm:grid-cols-2 gap-3">
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Company *</label><input class="input" name="company" value="<?= htmlspecialchars($displayCompany) ?>" required></div>
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Industry</label>
              <select class="input" name="industry">
                <?php foreach (['Banking','Microfinance','Insurance','Fintech','Payment','Other'] as $opt): ?>
                  <option<?= (($partner['industry'] ?? '') === $opt) ? ' selected' : '' ?>><?= $opt ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="grid sm:grid-cols-2 gap-3">
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Company Size</label>
              <select class="input" name="company_size">
                <?php foreach (['1-10','11-50','51-200','200+'] as $opt): ?>
                  <option<?= (($partner['company_size'] ?? '') === $opt) ? ' selected' : '' ?>><?= $opt ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Region</label><input class="input" name="region" value="<?= htmlspecialchars($partner['region'] ?? '') ?>"></div>
          </div>
          <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Website</label><input class="input" name="website" value="<?= htmlspecialchars($partner['website'] ?? '') ?>" placeholder="https://"></div>
          <div class="flex items-center justify-end gap-3 pt-2">
            <span class="text-xs text-gray-500" id="profile-msg"></span>
            <button class="btn-p" onclick="saveProfile()">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SECTION 9: REPORTS
       ═══════════════════════════════════════════ -->
  <div class="dash-section" id="sec-reports">
    <div class="grid lg:grid-cols-5 gap-6">
      <!-- Compose -->
      <div class="lg:col-span-2 stat-card">
        <h3 class="text-sm font-bold mb-1">Send a Report</h3>
        <p class="text-xs text-gray-500 mb-5">Share activity updates, pipeline summaries or performance reviews with the Bankerise partner team.</p>
        <form id="report-form" class="space-y-4" onsubmit="return false">
          <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Title *</label><input class="input" name="title" placeholder="e.g. Q2 Pipeline Review" required></div>
          <div class="grid grid-cols-2 gap-3">
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Type</label>
              <select class="input" name="type">
                <option>Activity</option><option>Sales</option><option>Pipeline</option><option>Performance</option><option>Other</option>
              </select>
            </div>
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Period</label><input class="input" name="period" placeholder="e.g. Apr 2026 / Q2 2026"></div>
          </div>
          <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Content *</label><textarea class="input" name="content" rows="8" placeholder="Summarize key wins, challenges, numbers and next steps…" required></textarea></div>
          <div class="flex items-center justify-end gap-3 pt-2">
            <span class="text-xs text-gray-500" id="report-msg"></span>
            <button class="btn-p" onclick="sendReport()">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
              Send Report
            </button>
          </div>
        </form>
      </div>
      <!-- History -->
      <div class="lg:col-span-3">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-sm font-bold">Sent Reports</h3>
          <span class="text-xs text-gray-500" id="reports-count">—</span>
        </div>
        <div class="rounded-xl border border-white/5 overflow-hidden">
          <table class="data-table">
            <thead><tr><th>Title</th><th>Type</th><th>Period</th><th>Sent</th><th>Status</th></tr></thead>
            <tbody id="reports-tbody">
              <tr><td colspan="5" class="text-center text-gray-500 py-6 text-xs">Loading reports…</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div><!-- end main-content -->

<!-- ═══════════════════════════════════════════════
     LEAD RESERVATION MODAL (Multi-Step)
     ═══════════════════════════════════════════════ -->
<div class="modal-overlay" id="lead-modal">
  <div class="modal-box">
    <div class="flex items-center justify-between mb-2">
      <h2 class="text-lg font-bold">Reserve a New Lead</h2>
      <button onclick="closeModal()" class="text-gray-500 hover:text-white transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
    </div>

    <!-- Step Indicator -->
    <div class="step-indicator" id="step-indicator">
      <div class="step-dot active" data-step="1">1</div><div class="step-line"></div>
      <div class="step-dot" data-step="2">2</div><div class="step-line"></div>
      <div class="step-dot" data-step="3">3</div><div class="step-line"></div>
      <div class="step-dot" data-step="4">4</div>
    </div>

    <!-- Step 1 -->
    <div class="form-step" id="step-1">
      <h3 class="text-sm font-bold mb-1 text-pacific">Company Information</h3>
      <p class="text-xs text-gray-500 mb-5">Tell us about the prospect's organization.</p>
      <div class="space-y-4">
        <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Company Name *</label><input class="input" id="f-company" placeholder="e.g. Atlas Finance Group" required></div>
        <div class="grid grid-cols-2 gap-3">
          <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Industry</label><select class="input" id="f-industry"><option>Banking</option><option>Microfinance</option><option>Insurance</option><option>Fintech</option><option>Payment</option><option>Other</option></select></div>
          <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Company Size</label><select class="input" id="f-size"><option>1-10</option><option>11-50</option><option>51-200</option><option>200+</option></select></div>
        </div>
        <div class="grid grid-cols-2 gap-3">
          <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Website</label><input class="input" id="f-website" placeholder="https://"></div>
          <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Country</label><input class="input" id="f-country" placeholder="e.g. Morocco"></div>
        </div>
      </div>
    </div>

    <!-- Step 2 -->
    <div class="form-step hidden" id="step-2">
      <h3 class="text-sm font-bold mb-1 text-pacific">Contact Details</h3>
      <p class="text-xs text-gray-500 mb-5">Who is the primary contact at this company?</p>
      <div class="space-y-4">
        <div class="grid grid-cols-2 gap-3">
          <div><label class="text-xs text-gray-500 font-semibold mb-1 block">First Name *</label><input class="input" id="f-fname" placeholder="John" required></div>
          <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Last Name *</label><input class="input" id="f-lname" placeholder="Doe" required></div>
        </div>
        <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Job Title</label><input class="input" id="f-title" placeholder="e.g. Chief Digital Officer"></div>
        <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Professional Email *</label><input type="email" class="input" id="f-email" placeholder="john@company.com" required></div>
        <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Phone</label><input class="input" id="f-phone" placeholder="+1 234 567 890"></div>
      </div>
    </div>

    <!-- Step 3 -->
    <div class="form-step hidden" id="step-3">
      <h3 class="text-sm font-bold mb-1 text-pacific">Project Qualification</h3>
      <p class="text-xs text-gray-500 mb-5">Details about the prospect's project needs.</p>
      <div class="space-y-4">
        <div><label class="text-xs text-gray-500 font-semibold mb-2 block">Project Type</label>
          <div class="grid grid-cols-2 gap-2">
            <label class="flex items-center gap-2 p-2.5 rounded-lg border border-white/8 hover:border-pacific/30 cursor-pointer transition-all text-xs"><input type="checkbox" class="accent-pacific" value="Digital Banking"> Digital Banking</label>
            <label class="flex items-center gap-2 p-2.5 rounded-lg border border-white/8 hover:border-pacific/30 cursor-pointer transition-all text-xs"><input type="checkbox" class="accent-pacific" value="Core Banking"> Core Banking</label>
            <label class="flex items-center gap-2 p-2.5 rounded-lg border border-white/8 hover:border-pacific/30 cursor-pointer transition-all text-xs"><input type="checkbox" class="accent-pacific" value="Payments"> Payments</label>
            <label class="flex items-center gap-2 p-2.5 rounded-lg border border-white/8 hover:border-pacific/30 cursor-pointer transition-all text-xs"><input type="checkbox" class="accent-pacific" value="Lending"> Lending</label>
            <label class="flex items-center gap-2 p-2.5 rounded-lg border border-white/8 hover:border-pacific/30 cursor-pointer transition-all text-xs"><input type="checkbox" class="accent-pacific" value="Compliance"> Compliance</label>
            <label class="flex items-center gap-2 p-2.5 rounded-lg border border-white/8 hover:border-pacific/30 cursor-pointer transition-all text-xs"><input type="checkbox" class="accent-pacific" value="Other"> Other</label>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-3">
          <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Budget Range</label><select class="input" id="f-budget"><option>&lt;50K€</option><option>50K-200K€</option><option>200K-500K€</option><option>500K+€</option></select></div>
          <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Timeline</label><select class="input" id="f-timeline"><option>&lt;3 months</option><option>3-6 months</option><option>6-12 months</option><option>12M+</option></select></div>
        </div>
        <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Decision maker on board?</label><div class="flex gap-3"><button type="button" class="toggle-btn active" onclick="this.classList.add('active');this.nextElementSibling.classList.remove('active')" id="dm-yes">Yes</button><button type="button" class="toggle-btn" onclick="this.classList.add('active');this.previousElementSibling.classList.remove('active')" id="dm-no">No</button></div></div>
        <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Additional Notes</label><textarea class="input" id="f-notes" rows="3" placeholder="Any other relevant details..."></textarea></div>
      </div>
    </div>

    <!-- Step 4 — Review -->
    <div class="form-step hidden" id="step-4">
      <h3 class="text-sm font-bold mb-1 text-pacific">Review & Submit</h3>
      <p class="text-xs text-gray-500 mb-5">Please verify all information before submitting.</p>
      <div class="space-y-3 text-sm" id="review-summary"></div>
      <label class="flex items-start gap-3 mt-6 cursor-pointer text-xs text-gray-400">
        <input type="checkbox" class="accent-pacific mt-0.5" id="confirm-check">
        <span>I confirm this lead has not been registered by another partner and all information is accurate.</span>
      </label>
    </div>

    <!-- Confirmation -->
    <div class="form-step hidden text-center py-8" id="step-confirm">
      <div class="w-16 h-16 rounded-full bg-green-500/10 flex items-center justify-center mx-auto mb-4"><svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
      <h3 class="text-xl font-bold mb-2 text-white">Lead Submitted!</h3>
      <p class="text-sm text-gray-400 max-w-sm mx-auto mb-6">Your lead reservation has been submitted and is pending approval by the Bankerise team. You will be notified within 24-48 hours.</p>
      <button class="btn-p" onclick="closeModal()">Back to Dashboard</button>
    </div>

    <!-- Navigation -->
    <div class="flex items-center justify-between mt-8" id="modal-nav">
      <button class="btn-s" id="btn-prev" onclick="prevStep()" style="visibility:hidden">← Previous</button>
      <button class="btn-p" id="btn-next" onclick="nextStep()">Next Step →</button>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════
     LEAD DETAILS MODAL (View)
     ═══════════════════════════════════════════════ -->
<div class="modal-overlay" id="lead-view-modal">
  <div class="modal-box">
    <div class="flex items-center justify-between mb-4">
      <div>
        <h2 class="text-lg font-bold" id="lv-company">Lead Details</h2>
        <p class="text-xs text-gray-500" id="lv-sub">—</p>
      </div>
      <button onclick="closeLeadView()" class="text-gray-500 hover:text-white transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
    </div>
    <div id="lv-body" class="space-y-5"></div>
    <div class="flex justify-end pt-5">
      <button class="btn-p" onclick="closeLeadView()">Close</button>
    </div>
  </div>
</div>

<!-- Chat Floating Trigger -->
<button class="chat-widget" id="chat-fab" title="Messages" onclick="openChat()" aria-label="Open messages">
  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
  <span class="fab-badge" id="chat-fab-badge">0</span>
</button>

<!-- Chat Panel -->
<aside class="chat-panel" id="chat-panel" aria-hidden="true">
  <div class="chat-panel-head" id="chat-head">
    <button class="back-btn" onclick="backToList()" aria-label="Back">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <div class="chat-avatar" id="chat-head-avatar" style="width:36px;height:36px;font-size:12px">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
    </div>
    <div class="chat-panel-title">
      <p class="t" id="chat-head-title">Messages</p>
      <p class="s" id="chat-head-sub">Chat with your leads</p>
    </div>
    <button class="chat-close-btn" onclick="closeChat()" aria-label="Close">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
  </div>

  <!-- Thread list -->
  <div id="chat-list-view" style="flex:1;display:flex;flex-direction:column;min-height:0">
    <div class="chat-search">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
      <input type="text" id="chat-search-input" placeholder="Search leads…" oninput="filterThreads(this.value)">
    </div>
    <div class="chat-thread-list" id="chat-thread-list">
      <div class="chat-msg-empty">Loading conversations…</div>
    </div>
  </div>

  <!-- Thread view -->
  <div class="chat-thread-view" id="chat-thread-view">
    <div class="chat-messages" id="chat-messages"></div>
    <div class="chat-compose">
      <textarea id="chat-input" rows="1" placeholder="Write a message…" onkeydown="chatKey(event)" oninput="autoGrow(this)"></textarea>
      <button class="chat-send-btn" id="chat-send" onclick="sendMessage()" aria-label="Send" disabled>
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M3.4 20.4 21.5 12.8c.8-.3.8-1.4 0-1.7L3.4 3.6c-.7-.3-1.4.4-1.2 1.1L4 11l12 1-12 1-1.8 6.3c-.2.7.5 1.4 1.2 1.1z"/></svg>
      </button>
    </div>
    <div class="chat-simulate" onclick="simulateReply()" title="Demo: simulate a reply from this lead">↻ Simulate lead reply (demo)</div>
  </div>
</aside>

<!-- ═══════════════════════════════════════════════
     SCRIPTS
     ═══════════════════════════════════════════════ -->
<script>
(function(){
'use strict';

/* ── Section Navigation ──────────────────────── */
var titles = {leads:'Reserved Leads',deals:'Deals in Progress',signed:'Signed Deals',commissions:'Commissions',documents:'Documents & Resources',features:'Key Features',support:'Support',profile:'My Profile',reports:'Reports'};
var API = '/api';

/* ── Sidebar toggle (mobile) ─────────────────── */
window.toggleSidebar = function(){
  var sb = document.getElementById('sidebar');
  var bd = document.getElementById('sidebar-backdrop');
  var isOpen = sb.classList.contains('open');
  if(isOpen){
    sb.classList.remove('open');
    bd.classList.remove('visible');
  } else {
    sb.classList.add('open');
    bd.classList.add('visible');
  }
};
window.closeSidebar = function(){
  document.getElementById('sidebar').classList.remove('open');
  document.getElementById('sidebar-backdrop').classList.remove('visible');
};

window.showSection = function(id){
  document.querySelectorAll('.dash-section').forEach(function(s){s.classList.remove('active')});
  document.getElementById('sec-'+id).classList.add('active');
  document.querySelectorAll('.sidebar-link').forEach(function(l){l.classList.remove('active')});
  document.querySelector('[data-section="'+id+'"]').classList.add('active');
  document.getElementById('section-title').textContent = titles[id] || id;
  if(id==='commissions') initChart();
  if(id==='reports') loadReports();
  // Close mobile sidebar + backdrop
  closeSidebar();
};

/* ═══════════════════════════════════════════════
   GLOBAL SEARCH
   ═══════════════════════════════════════════════ */
(function(){
  var searchInput = document.getElementById('global-search');
  if(!searchInput) return;

  // Create dropdown
  var dropdown = document.createElement('div');
  dropdown.id = 'search-dropdown';
  dropdown.style.cssText = 'position:absolute;top:100%;left:0;right:0;margin-top:6px;background:rgba(10,12,24,0.96);border:1px solid rgba(77,184,205,0.2);border-radius:12px;max-height:360px;overflow-y:auto;z-index:100;display:none;box-shadow:0 20px 50px rgba(0,0,0,0.6);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px)';
  searchInput.parentElement.appendChild(dropdown);

  // Sidebar nav items for search
  var navItems = [];
  document.querySelectorAll('.sidebar-link[data-section]').forEach(function(link){
    navItems.push({
      label: link.textContent.trim().replace(/\d+$/,'').trim(),
      section: link.getAttribute('data-section'),
      icon: 'nav'
    });
  });

  // Search keywords mapped to sections
  var keywords = {
    leads: ['lead','reserve','pipeline','prospect','client'],
    deals: ['deal','progress','kanban','negotiation','proposal','qualified','contacted','closing'],
    signed: ['signed','closed','active','contract','revenue'],
    commissions: ['commission','payout','payment','earned','pending','money','finance'],
    documents: ['document','resource','download','sales deck','pdf','api guide','onboarding','agreement','roi'],
    features: ['feature','capability','module'],
    support: ['support','ticket','help','issue','bug','technical'],
    profile: ['profile','account','settings','email','phone','company','edit'],
    reports: ['report','activity','performance','summary']
  };

  function doSearch(query){
    var q = query.toLowerCase().trim();
    if(!q){ dropdown.style.display='none'; return; }

    var results = [];

    // 1. Search navigation items
    navItems.forEach(function(item){
      if(item.label.toLowerCase().indexOf(q) !== -1){
        results.push({type:'nav', label:item.label, section:item.section});
      }
    });

    // 2. Search by keywords
    Object.keys(keywords).forEach(function(section){
      keywords[section].forEach(function(kw){
        if(kw.indexOf(q) !== -1){
          var label = titles[section] || section;
          // Avoid duplicates
          var exists = results.some(function(r){ return r.section === section && r.type === 'nav'; });
          if(!exists) results.push({type:'nav', label:label, section:section, match:kw});
        }
      });
    });

    // 3. Search table rows in ALL sections
    document.querySelectorAll('.dash-section').forEach(function(sec){
      var sectionId = sec.id.replace('sec-','');
      sec.querySelectorAll('.data-table tbody tr').forEach(function(row){
        var text = row.textContent.toLowerCase();
        if(text.indexOf(q) !== -1){
          var firstCell = row.querySelector('td');
          var preview = firstCell ? firstCell.textContent.trim().substring(0,40) : 'Row match';
          results.push({type:'data', label:preview, section:sectionId, row:row});
        }
      });
    });

    // 4. Search kanban cards
    document.querySelectorAll('.kanban-card').forEach(function(card){
      var text = card.textContent.toLowerCase();
      if(text.indexOf(q) !== -1){
        var name = card.querySelector('p');
        results.push({type:'data', label:name ? name.textContent.trim() : 'Deal match', section:'deals', row:card});
      }
    });

    // Render dropdown
    if(!results.length){
      dropdown.innerHTML = '<div style="padding:16px;text-align:center;color:#64748B;font-size:12px">No results for "'+q+'"</div>';
      dropdown.style.display = 'block';
      return;
    }

    // Deduplicate nav results
    var seen = {};
    results = results.filter(function(r){
      var key = r.type + '-' + (r.section||'') + '-' + r.label;
      if(seen[key]) return false;
      seen[key] = true;
      return true;
    });

    var html = '';

    // Nav results
    var navResults = results.filter(function(r){ return r.type==='nav'; });
    if(navResults.length){
      html += '<div style="padding:8px 14px 4px;font-size:9px;font-weight:700;color:#4DB8CD;text-transform:uppercase;letter-spacing:0.1em">Navigation</div>';
      navResults.forEach(function(r){
        html += '<div class="search-result" data-section="'+r.section+'" style="padding:10px 14px;cursor:pointer;display:flex;align-items:center;gap:10px;transition:background 0.2s;border-bottom:1px solid rgba(255,255,255,0.03)">'
          + '<svg style="width:14px;height:14px;color:#4DB8CD;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>'
          + '<span style="font-size:12px;color:#E5E7EB;font-weight:500">'+r.label+'</span>'
          + (r.match ? '<span style="font-size:10px;color:#64748B;margin-left:auto">matched: '+r.match+'</span>' : '')
          + '</div>';
      });
    }

    // Data results
    var dataResults = results.filter(function(r){ return r.type==='data'; });
    if(dataResults.length){
      html += '<div style="padding:8px 14px 4px;font-size:9px;font-weight:700;color:#766CFF;text-transform:uppercase;letter-spacing:0.1em">Data</div>';
      dataResults.slice(0,8).forEach(function(r){
        html += '<div class="search-result" data-section="'+r.section+'" data-highlight="true" style="padding:10px 14px;cursor:pointer;display:flex;align-items:center;gap:10px;transition:background 0.2s;border-bottom:1px solid rgba(255,255,255,0.03)">'
          + '<svg style="width:14px;height:14px;color:#766CFF;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/></svg>'
          + '<span style="font-size:12px;color:#E5E7EB">'+r.label+'</span>'
          + '<span style="font-size:10px;color:#64748B;margin-left:auto">in '+(titles[r.section]||r.section)+'</span>'
          + '</div>';
      });
      if(dataResults.length > 8){
        html += '<div style="padding:8px 14px;font-size:10px;color:#64748B;text-align:center">+'+(dataResults.length-8)+' more results</div>';
      }
    }

    dropdown.innerHTML = html;
    dropdown.style.display = 'block';

    // Click handlers
    dropdown.querySelectorAll('.search-result').forEach(function(el, idx){
      el.addEventListener('mouseenter', function(){ el.style.background='rgba(77,184,205,0.08)'; });
      el.addEventListener('mouseleave', function(){ el.style.background='transparent'; });
      el.addEventListener('click', function(){
        var sec = el.getAttribute('data-section');
        showSection(sec);

        // Highlight matching row if data result
        if(el.getAttribute('data-highlight')==='true'){
          var matchingResult = (el.getAttribute('data-section')==='deals' ? dataResults : dataResults).filter(function(r){return r.section===sec;})[idx - navResults.length];
          if(matchingResult && matchingResult.row){
            matchingResult.row.style.background = 'rgba(77,184,205,0.15)';
            matchingResult.row.style.boxShadow = 'inset 3px 0 0 #4DB8CD';
            matchingResult.row.scrollIntoView({behavior:'smooth', block:'center'});
            setTimeout(function(){ matchingResult.row.style.background=''; matchingResult.row.style.boxShadow=''; }, 3000);
          }
        }

        dropdown.style.display = 'none';
        searchInput.value = '';
      });
    });
  }

  // Debounced input
  var timer = null;
  searchInput.addEventListener('input', function(){
    clearTimeout(timer);
    timer = setTimeout(function(){ doSearch(searchInput.value); }, 200);
  });

  // Close on click outside
  document.addEventListener('click', function(e){
    if(!searchInput.parentElement.contains(e.target)){
      dropdown.style.display = 'none';
    }
  });

  // Close on Escape
  searchInput.addEventListener('keydown', function(e){
    if(e.key === 'Escape'){ dropdown.style.display = 'none'; searchInput.blur(); }
  });
})();

/* ── Kanban / List Toggle ────────────────────── */
window.setView = function(btn, view){
  btn.parentElement.querySelectorAll('.toggle-btn').forEach(function(b){b.classList.remove('active')});
  btn.classList.add('active');
  document.getElementById('kanban-view').classList.toggle('hidden', view==='list');
  document.getElementById('kanban-view').style.display = view==='kanban' ? 'flex' : 'none';
  document.getElementById('list-view').classList.toggle('hidden', view==='kanban');
};

/* ── Document Filter ─────────────────────────── */
window.filterDocs = function(btn, cat){
  btn.parentElement.querySelectorAll('.toggle-btn').forEach(function(b){b.classList.remove('active')});
  btn.classList.add('active');
  document.querySelectorAll('#doc-grid .resource-card').forEach(function(c){
    c.style.display = (cat==='all' || c.dataset.cat===cat) ? '' : 'none';
  });
};

/* ── Commission Chart ────────────────────────── */
var chartInstance = null;
function initChart(){
  if(chartInstance) return;
  var ctx = document.getElementById('commission-chart');
  if(!ctx) return;
  chartInstance = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Oct','Nov','Dec','Jan','Feb','Mar','Apr'],
      datasets: [{
        label: 'Commissions (€)',
        data: [28000,35000,42000,55800,137400,93600,62500],
        backgroundColor: function(ctx){
          var g = ctx.chart.ctx.createLinearGradient(0,0,0,200);
          g.addColorStop(0,'rgba(77,184,205,0.8)');
          g.addColorStop(1,'rgba(118,108,255,0.4)');
          return g;
        },
        borderRadius: 8,
        borderSkipped: false,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {legend:{display:false}},
      scales: {
        x:{grid:{color:'rgba(255,255,255,0.03)'},ticks:{color:'#64748B',font:{size:11,family:'Montserrat'}}},
        y:{grid:{color:'rgba(255,255,255,0.03)'},ticks:{color:'#64748B',font:{size:11,family:'Montserrat'},callback:function(v){return '€'+v/1000+'K'}}}
      }
    }
  });
}

/* ── CSV Export ───────────────────────────────── */
window.exportCSV = function(){
  var csv = 'Client,Deal Value,Signing Date,Commission %,Commission Earned,Status\n';
  csv += 'Algiers National Bank,€520000,Mar 15 2026,18%,€93600,Active\n';
  csv += 'Rabat MFI Network,€180000,Feb 28 2026,18%,€32400,Active\n';
  csv += 'Dubai FinBank,€750000,Feb 10 2026,25%,€187500,Active\n';
  var blob = new Blob([csv],{type:'text/csv'});
  var a = document.createElement('a');
  a.href = URL.createObjectURL(blob);
  a.download = 'bankerise-signed-deals.csv';
  a.click();
};

/* ── Multi-Step Form ─────────────────────────── */
var currentStep = 1;
var totalSteps = 4;

window.openModal = function(){
  currentStep = 1;
  updateStepUI();
  document.getElementById('lead-modal').classList.add('open');
  document.getElementById('step-confirm').classList.add('hidden');
  document.getElementById('modal-nav').style.display = 'flex';
  for(var i=1;i<=4;i++) document.getElementById('step-'+i).classList.toggle('hidden',i!==1);
};
window.closeModal = function(){
  document.getElementById('lead-modal').classList.remove('open');
};

window.nextStep = function(){
  // Validation
  if(currentStep===1 && !document.getElementById('f-company').value.trim()){
    document.getElementById('f-company').style.borderColor='#EF4444';return;
  }
  if(currentStep===2){
    var fn=document.getElementById('f-fname').value.trim();
    var em=document.getElementById('f-email').value.trim();
    if(!fn){document.getElementById('f-fname').style.borderColor='#EF4444';return;}
    if(!em||!em.includes('@')){document.getElementById('f-email').style.borderColor='#EF4444';return;}
  }
  if(currentStep===4){
    if(!document.getElementById('confirm-check').checked) return;
    submitLead();
    return;
  }
  // Build review on step 3->4
  if(currentStep===3) buildReview();

  document.getElementById('step-'+currentStep).classList.add('hidden');
  currentStep++;
  document.getElementById('step-'+currentStep).classList.remove('hidden');
  updateStepUI();
};

window.prevStep = function(){
  if(currentStep<=1) return;
  document.getElementById('step-'+currentStep).classList.add('hidden');
  currentStep--;
  document.getElementById('step-'+currentStep).classList.remove('hidden');
  updateStepUI();
};

function updateStepUI(){
  document.getElementById('btn-prev').style.visibility = currentStep>1?'visible':'hidden';
  document.getElementById('btn-next').textContent = currentStep===4?'Submit Lead':'Next Step →';
  document.querySelectorAll('.step-dot').forEach(function(d,i){
    d.classList.remove('active','done');
    if(i+1<currentStep) d.classList.add('done');
    else if(i+1===currentStep) d.classList.add('active');
  });
  document.querySelectorAll('.step-line').forEach(function(l,i){
    l.classList.toggle('done',i+1<currentStep);
  });
  // Reset border colors
  document.querySelectorAll('.modal-box input,.modal-box select').forEach(function(el){el.style.borderColor=''});
}

function buildReview(){
  var html = '<div class="grid grid-cols-2 gap-3">';
  html += rv('Company', document.getElementById('f-company').value);
  html += rv('Industry', document.getElementById('f-industry').value);
  html += rv('Size', document.getElementById('f-size').value);
  html += rv('Country', document.getElementById('f-country').value);
  html += rv('Contact', document.getElementById('f-fname').value+' '+document.getElementById('f-lname').value);
  html += rv('Email', document.getElementById('f-email').value);
  html += rv('Budget', document.getElementById('f-budget').value);
  html += rv('Timeline', document.getElementById('f-timeline').value);
  html += '</div>';
  document.getElementById('review-summary').innerHTML = html;
}
function rv(label,val){
  return '<div class="p-3 rounded-lg bg-white/3 border border-white/5"><p class="text-[10px] text-gray-500 uppercase tracking-wider mb-1">'+label+'</p><p class="text-xs font-semibold text-white">'+(val||'—')+'</p></div>';
}

/* ── Helpers ────────────────────────────────── */
function esc(s){return (s==null?'':String(s)).replace(/[&<>"']/g,function(c){return({"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;"})[c]})}
function fmtDate(s){
  if(!s) return '—';
  var d = new Date(s.replace(' ','T'));
  if(isNaN(d)) return s;
  return d.toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'});
}
function badgeForStatus(s){
  var cls = 'badge-pending';
  if(s==='Approved') cls='badge-approved';
  else if(s==='Rejected') cls='badge-rejected';
  return '<span class="badge '+cls+'">'+esc(s)+'</span>';
}

/* ── Leads: load from API ───────────────────── */
function loadLeads(){
  var tbody = document.getElementById('leads-tbody');
  fetch(API+'/leads.php',{credentials:'same-origin'})
    .then(function(r){return r.json()})
    .then(function(d){
      var leads = d.leads || [];
      if(!leads.length){
        tbody.innerHTML = '<tr><td colspan="6" class="text-center text-gray-500 py-8 text-xs">No leads yet. Click “Reserve a New Lead” to add your first.</td></tr>';
      } else {
        tbody.innerHTML = leads.map(function(l){
          var name = (l.contact_first_name||'')+' '+(l.contact_last_name||'');
          return '<tr data-id="'+l.id+'">'
            + '<td class="font-medium text-white">'+esc(name.trim()||'—')+'</td>'
            + '<td>'+esc(l.company_name)+'</td>'
            + '<td>'+esc(l.industry||'—')+'</td>'
            + '<td>'+fmtDate(l.created_at)+'</td>'
            + '<td>'+badgeForStatus(l.status)+'</td>'
            + '<td><button class="text-pacific text-xs font-semibold hover:underline" onclick="viewLead('+l.id+')">View</button></td>'
            + '</tr>';
        }).join('');
      }
      document.getElementById('leads-count').textContent = 'Showing '+leads.length+' lead'+(leads.length===1?'':'s');
      // Update sidebar count
      var badge = document.querySelector('[data-section="leads"] .sidebar-badge');
      if(badge) badge.textContent = leads.length;
    })
    .catch(function(){
      tbody.innerHTML = '<tr><td colspan="6" class="text-center text-red-400 py-6 text-xs">Failed to load leads.</td></tr>';
    });
}

window.viewLead = function(id){
  fetch(API+'/leads.php',{credentials:'same-origin'})
    .then(function(r){return r.json()})
    .then(function(d){
      var l = (d.leads||[]).find(function(x){return x.id==id});
      if(!l) return;
      var fullName = ((l.contact_first_name||'')+' '+(l.contact_last_name||'')).trim() || '—';
      document.getElementById('lv-company').textContent = l.company_name || '—';
      document.getElementById('lv-sub').innerHTML = esc(fullName) + ' · ' + badgeForStatus(l.status);

      function row(label, val){
        return '<div class="p-3 rounded-lg bg-white/3 border border-white/5">'
             + '<p class="text-[10px] text-gray-500 uppercase tracking-wider mb-1">'+esc(label)+'</p>'
             + '<p class="text-xs font-semibold text-white break-words">'+(val ? esc(val) : '<span class="text-gray-500">—</span>')+'</p>'
             + '</div>';
      }
      function section(title, rows){
        return '<div><h3 class="text-xs font-bold text-pacific uppercase tracking-wider mb-2">'+esc(title)+'</h3>'
             + '<div class="grid sm:grid-cols-2 gap-2">'+rows.join('')+'</div></div>';
      }

      var html = '';
      html += section('Company', [
        row('Company Name', l.company_name),
        row('Industry', l.industry),
        row('Company Size', l.company_size),
        row('Website', l.website),
        row('Country', l.country)
      ]);
      html += section('Contact', [
        row('Full Name', fullName),
        row('Job Title', l.contact_title),
        row('Email', l.contact_email),
        row('Phone', l.contact_phone),
        row('Decision Maker', (l.decision_maker==1||l.decision_maker===true||l.decision_maker==='1') ? 'Yes' : 'No')
      ]);
      html += section('Project', [
        row('Project Types', l.project_types),
        row('Budget Range', l.budget_range),
        row('Timeline', l.timeline),
        row('Status', l.status),
        row('Created', fmtDate(l.created_at))
      ]);
      if(l.notes){
        html += '<div><h3 class="text-xs font-bold text-pacific uppercase tracking-wider mb-2">Notes</h3>'
              + '<div class="p-3 rounded-lg bg-white/3 border border-white/5 text-xs text-gray-200 whitespace-pre-wrap">'+esc(l.notes)+'</div></div>';
      }
      document.getElementById('lv-body').innerHTML = html;
      document.getElementById('lead-view-modal').classList.add('open');
    });
};
window.closeLeadView = function(){
  document.getElementById('lead-view-modal').classList.remove('open');
};

/* ── Lead modal submit → POST ───────────────── */
function collectProjectTypes(){
  var out = [];
  document.querySelectorAll('#step-3 input[type=checkbox]').forEach(function(cb){
    if(cb.checked) out.push(cb.value);
  });
  return out;
}
function submitLead(){
  var btn = document.getElementById('btn-next');
  btn.disabled = true; var orig = btn.textContent; btn.textContent = 'Submitting…';
  var payload = {
    company_name: document.getElementById('f-company').value.trim(),
    industry: document.getElementById('f-industry').value,
    company_size: document.getElementById('f-size').value,
    website: document.getElementById('f-website').value.trim(),
    country: document.getElementById('f-country').value.trim(),
    contact_first_name: document.getElementById('f-fname').value.trim(),
    contact_last_name: document.getElementById('f-lname').value.trim(),
    contact_title: document.getElementById('f-title').value.trim(),
    contact_email: document.getElementById('f-email').value.trim(),
    contact_phone: document.getElementById('f-phone').value.trim(),
    project_types: collectProjectTypes(),
    budget_range: document.getElementById('f-budget').value,
    timeline: document.getElementById('f-timeline').value,
    decision_maker: document.getElementById('dm-yes').classList.contains('active'),
    notes: document.getElementById('f-notes').value.trim()
  };
  fetch(API+'/leads.php',{
    method:'POST', credentials:'same-origin',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify(payload)
  })
  .then(function(r){return r.json().then(function(d){return {ok:r.ok,data:d}})})
  .then(function(res){
    if(!res.ok){
      alert(res.data.error || 'Failed to submit lead.');
      btn.disabled = false; btn.textContent = orig;
      return;
    }
    document.getElementById('step-4').classList.add('hidden');
    document.getElementById('step-confirm').classList.remove('hidden');
    document.getElementById('modal-nav').style.display='none';
    loadLeads();
    // Reset form
    ['f-company','f-website','f-country','f-fname','f-lname','f-title','f-email','f-phone','f-notes']
      .forEach(function(id){ var el=document.getElementById(id); if(el) el.value=''; });
    document.querySelectorAll('#step-3 input[type=checkbox]').forEach(function(cb){cb.checked=false});
    document.getElementById('confirm-check').checked = false;
  })
  .catch(function(){
    alert('Network error while submitting lead.');
    btn.disabled = false; btn.textContent = orig;
  });
}

/* ── Profile save ───────────────────────────── */
window.saveProfile = function(){
  var form = document.getElementById('profile-form');
  var fd = new FormData(form);
  var payload = {};
  fd.forEach(function(v,k){ payload[k] = v; });
  var msg = document.getElementById('profile-msg');
  msg.textContent = 'Saving…'; msg.style.color = '#94A3B8';
  fetch(API+'/profile.php',{
    method:'PUT', credentials:'same-origin',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify(payload)
  })
  .then(function(r){return r.json().then(function(d){return {ok:r.ok,data:d}})})
  .then(function(res){
    if(!res.ok){ msg.textContent = res.data.error || 'Failed to save.'; msg.style.color = '#EF4444'; return; }
    msg.textContent = 'Saved ✓'; msg.style.color = '#22C55E';
    // Update sidebar + summary live
    var name = payload.name || '';
    var parts = name.trim().split(/\s+/);
    var initials = ((parts[0]||'P')[0] + (parts[1]?parts[1][0]:'')).toUpperCase();
    var sidebarName = document.querySelector('.sidebar-user p.text-xs');
    var sidebarInitials = document.querySelector('.sidebar-user .w-9');
    if(sidebarName) sidebarName.textContent = name;
    if(sidebarInitials) sidebarInitials.textContent = initials;
    var set = function(id,v){var el=document.getElementById(id); if(el) el.textContent = v || '—';};
    set('prof-sum-name', name);
    set('prof-sum-email', payload.email);
    set('prof-sum-company', payload.company);
    set('prof-sum-country', payload.country);
    set('prof-sum-region', payload.region);
    setTimeout(function(){ msg.textContent=''; }, 2500);
  })
  .catch(function(){ msg.textContent = 'Network error.'; msg.style.color = '#EF4444'; });
};

window.uploadAvatar = function(input){
  if(!input.files || !input.files[0]) return;
  var file = input.files[0];
  var msg = document.getElementById('avatar-msg');
  if(file.size > 4*1024*1024){
    msg.textContent = 'Max 4 MB'; msg.style.color = '#EF4444';
    input.value = ''; return;
  }
  msg.textContent = 'Uploading…'; msg.style.color = '#94A3B8';
  var fd = new FormData();
  fd.append('photo', file);
  fetch(API+'/profile-photo.php',{ method:'POST', credentials:'same-origin', body: fd })
    .then(function(r){return r.json().then(function(d){return {ok:r.ok,data:d}})})
    .then(function(res){
      if(!res.ok){ msg.textContent = res.data.error || 'Upload failed.'; msg.style.color = '#EF4444'; return; }
      var url = res.data.url + '?t=' + Date.now();
      applyAvatar(url);
      msg.textContent = 'Updated ✓'; msg.style.color = '#22C55E';
      setTimeout(function(){ msg.textContent=''; }, 2500);
      if(!document.getElementById('avatar-remove-btn')){
        var btn = document.createElement('button');
        btn.id = 'avatar-remove-btn';
        btn.type = 'button';
        btn.className = 'text-[10px] text-red-400 hover:underline';
        btn.textContent = 'Remove';
        btn.onclick = removeAvatar;
        var sep = document.createElement('span');
        sep.className = 'text-gray-600'; sep.textContent = '·';
        msg.parentNode.insertBefore(sep, msg);
        msg.parentNode.insertBefore(btn, msg);
      }
    })
    .catch(function(){ msg.textContent = 'Network error.'; msg.style.color = '#EF4444'; })
    .finally(function(){ input.value = ''; });
};

window.removeAvatar = function(){
  if(!confirm('Remove your profile photo?')) return;
  fetch(API+'/profile-photo.php',{ method:'DELETE', credentials:'same-origin' })
    .then(function(r){return r.json()})
    .then(function(d){
      if(d.error){ alert(d.error); return; }
      applyAvatar(null);
      var btn = document.getElementById('avatar-remove-btn');
      if(btn){
        var prev = btn.previousSibling;
        if(prev && prev.textContent === '·') prev.remove();
        btn.remove();
      }
    });
};

function applyAvatar(url){
  ['prof-avatar','sidebar-avatar'].forEach(function(id){
    var el = document.getElementById(id);
    if(!el) return;
    if(url){
      el.style.backgroundImage = "url('"+url+"')";
      el.style.backgroundSize = 'cover';
      el.style.backgroundPosition = 'center';
      el.style.color = 'transparent';
    } else {
      el.style.backgroundImage = '';
      el.style.color = '';
    }
  });
}

/* ── Reports ────────────────────────────────── */
var reportsLoaded = false;
function loadReports(){
  var tbody = document.getElementById('reports-tbody');
  fetch(API+'/reports.php',{credentials:'same-origin'})
    .then(function(r){return r.json()})
    .then(function(d){
      var reports = d.reports || [];
      if(!reports.length){
        tbody.innerHTML = '<tr><td colspan="5" class="text-center text-gray-500 py-8 text-xs">No reports sent yet.</td></tr>';
      } else {
        tbody.innerHTML = reports.map(function(r){
          return '<tr>'
            + '<td class="font-medium text-white">'+esc(r.title)+'</td>'
            + '<td>'+esc(r.type)+'</td>'
            + '<td>'+esc(r.period||'—')+'</td>'
            + '<td>'+fmtDate(r.created_at)+'</td>'
            + '<td><span class="badge badge-approved">'+esc(r.status)+'</span></td>'
            + '</tr>';
        }).join('');
      }
      document.getElementById('reports-count').textContent = reports.length+' report'+(reports.length===1?'':'s');
      reportsLoaded = true;
    })
    .catch(function(){
      tbody.innerHTML = '<tr><td colspan="5" class="text-center text-red-400 py-6 text-xs">Failed to load reports.</td></tr>';
    });
}

window.sendReport = function(){
  var form = document.getElementById('report-form');
  var fd = new FormData(form);
  var payload = {};
  fd.forEach(function(v,k){ payload[k] = v; });
  var msg = document.getElementById('report-msg');
  if(!payload.title || !payload.content){
    msg.textContent = 'Title and content required.'; msg.style.color = '#EF4444'; return;
  }
  msg.textContent = 'Sending…'; msg.style.color = '#94A3B8';
  fetch(API+'/reports.php',{
    method:'POST', credentials:'same-origin',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify(payload)
  })
  .then(function(r){return r.json().then(function(d){return {ok:r.ok,data:d}})})
  .then(function(res){
    if(!res.ok){ msg.textContent = res.data.error || 'Failed to send.'; msg.style.color = '#EF4444'; return; }
    msg.textContent = 'Report sent ✓'; msg.style.color = '#22C55E';
    form.reset();
    loadReports();
    setTimeout(function(){ msg.textContent=''; }, 3000);
  })
  .catch(function(){ msg.textContent = 'Network error.'; msg.style.color = '#EF4444'; });
};

/* ═══════════════════════════════════════════════
   CHAT SYSTEM
   ═══════════════════════════════════════════════ */
var chatState = {
  threads: [],
  activeLeadId: null,
  activeLead: null,
  pollTimer: null
};

function initialsFrom(name){
  var parts = (name||'').trim().split(/\s+/);
  return ((parts[0]||'?')[0] + (parts[1]?parts[1][0]:'')).toUpperCase();
}
function fmtTime(iso){
  if(!iso) return '';
  var d = new Date(iso.replace(' ','T'));
  if(isNaN(d)) return '';
  var now = new Date();
  var sameDay = d.toDateString() === now.toDateString();
  if(sameDay) return d.toLocaleTimeString([], {hour:'2-digit',minute:'2-digit'});
  var diffDays = Math.round((now - d) / 86400000);
  if(diffDays < 7) return d.toLocaleDateString([], {weekday:'short'});
  return d.toLocaleDateString([], {month:'short',day:'numeric'});
}
function dayLabel(iso){
  var d = new Date(iso.replace(' ','T'));
  if(isNaN(d)) return '';
  var t = new Date(); t.setHours(0,0,0,0);
  var y = new Date(t); y.setDate(y.getDate()-1);
  var dd = new Date(d); dd.setHours(0,0,0,0);
  if(dd.getTime()===t.getTime()) return 'Today';
  if(dd.getTime()===y.getTime()) return 'Yesterday';
  return d.toLocaleDateString([], {month:'short',day:'numeric',year:'numeric'});
}

window.openChat = function(){
  var p = document.getElementById('chat-panel');
  p.classList.add('open');
  p.setAttribute('aria-hidden','false');
  backToList();
  loadThreads();
  if(chatState.pollTimer) clearInterval(chatState.pollTimer);
  chatState.pollTimer = setInterval(function(){
    if(!document.getElementById('chat-panel').classList.contains('open')) return;
    if(chatState.activeLeadId) loadThread(chatState.activeLeadId, true);
    else loadThreads(true);
  }, 12000);
};
window.closeChat = function(){
  document.getElementById('chat-panel').classList.remove('open');
  document.getElementById('chat-panel').setAttribute('aria-hidden','true');
  if(chatState.pollTimer){ clearInterval(chatState.pollTimer); chatState.pollTimer=null; }
};
window.backToList = function(){
  chatState.activeLeadId = null;
  chatState.activeLead = null;
  document.getElementById('chat-list-view').style.display = 'flex';
  document.getElementById('chat-thread-view').classList.remove('active');
  document.getElementById('chat-head').classList.remove('in-thread');
  document.getElementById('chat-head-title').textContent = 'Messages';
  document.getElementById('chat-head-sub').textContent = 'Chat with your leads';
  var av = document.getElementById('chat-head-avatar');
  av.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>';
};

function loadThreads(silent){
  fetch(API+'/messages.php?action=threads',{credentials:'same-origin'})
    .then(function(r){return r.json()})
    .then(function(d){
      chatState.threads = d.threads || [];
      renderThreads(chatState.threads, document.getElementById('chat-search-input').value);
      updateChatBadge(d.total_unread || 0);
    })
    .catch(function(){
      if(!silent) document.getElementById('chat-thread-list').innerHTML = '<div class="chat-msg-empty">Failed to load. Check your connection.</div>';
    });
}

function renderThreads(threads, filter){
  var list = document.getElementById('chat-thread-list');
  var f = (filter||'').toLowerCase().trim();
  var items = threads.filter(function(t){
    if(!f) return true;
    var hay = (t.company_name+' '+(t.contact_first_name||'')+' '+(t.contact_last_name||'')).toLowerCase();
    return hay.indexOf(f) !== -1;
  });
  if(!items.length){
    list.innerHTML = '<div class="chat-msg-empty">'+(threads.length ? 'No matches.' : 'No leads to chat with yet.<br><span style="font-size:11px">Reserve a lead to start a conversation.</span>')+'</div>';
    return;
  }
  list.innerHTML = items.map(function(t){
    var name = (t.contact_first_name||'') + ' ' + (t.contact_last_name||'');
    name = name.trim() || t.company_name;
    var preview = t.last_body ? ((t.last_sender==='partner'?'You: ':'')+t.last_body) : 'No messages yet';
    var unread = parseInt(t.unread||0,10);
    var cls = 'chat-thread-item' + (chatState.activeLeadId==t.id ? ' active' : '');
    return '<div class="'+cls+'" onclick="openThread('+t.id+')">'
      + '<div class="chat-avatar">'+esc(initialsFrom(name))+'</div>'
      + '<div class="chat-thread-meta">'
      +   '<div class="row1"><span class="name">'+esc(name)+'</span><span class="time">'+esc(fmtTime(t.last_at))+'</span></div>'
      +   '<div class="preview '+(unread?'unread':'')+'">'
      +     '<span style="flex:1;overflow:hidden;text-overflow:ellipsis">'+esc(preview)+'</span>'
      +     (unread ? '<span class="chat-unread-dot">'+unread+'</span>' : '')
      +   '</div>'
      + '</div>'
      + '</div>';
  }).join('');
}

window.filterThreads = function(v){ renderThreads(chatState.threads, v); };

window.openThread = function(leadId){
  chatState.activeLeadId = leadId;
  document.getElementById('chat-list-view').style.display = 'none';
  document.getElementById('chat-thread-view').classList.add('active');
  document.getElementById('chat-head').classList.add('in-thread');
  document.getElementById('chat-messages').innerHTML = '<div class="chat-msg-empty">Loading…</div>';
  loadThread(leadId);
  setTimeout(function(){ document.getElementById('chat-input').focus(); }, 150);
};

function loadThread(leadId, silent){
  fetch(API+'/messages.php?action=thread&lead_id='+leadId, {credentials:'same-origin'})
    .then(function(r){return r.json()})
    .then(function(d){
      if(d.error){ document.getElementById('chat-messages').innerHTML = '<div class="chat-msg-empty">'+esc(d.error)+'</div>'; return; }
      chatState.activeLead = d.lead;
      var name = ((d.lead.contact_first_name||'') + ' ' + (d.lead.contact_last_name||'')).trim() || d.lead.company_name;
      document.getElementById('chat-head-title').textContent = name;
      document.getElementById('chat-head-sub').textContent = d.lead.company_name + ' · ' + (d.lead.contact_email||'');
      var av = document.getElementById('chat-head-avatar');
      av.textContent = initialsFrom(name);
      av.innerHTML = initialsFrom(name);
      renderMessages(d.messages || []);
      // Refresh threads to update unread / last message
      loadThreads(true);
    })
    .catch(function(){
      if(!silent) document.getElementById('chat-messages').innerHTML = '<div class="chat-msg-empty">Failed to load conversation.</div>';
    });
}

function renderMessages(messages){
  var box = document.getElementById('chat-messages');
  if(!messages.length){
    box.innerHTML = '<div class="chat-msg-empty">No messages yet. Say hello 👋</div>';
    return;
  }
  var html = '';
  var lastDay = null;
  messages.forEach(function(m){
    var d = dayLabel(m.created_at);
    if(d !== lastDay){ html += '<div class="chat-day-sep">'+esc(d)+'</div>'; lastDay = d; }
    var cls = m.sender==='partner' ? 'out' : 'in';
    var delBtn = m.sender==='partner'
      ? '<button class="msg-del" title="Delete message" onclick="deleteMessage('+m.id+',event)"><svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg></button>'
      : '';
    html += '<div class="chat-msg '+cls+'" data-msg-id="'+m.id+'">'+esc(m.body).replace(/\n/g,'<br>')
         + '<span class="t">'+esc(fmtTime(m.created_at))+'</span>'+delBtn+'</div>';
  });
  box.innerHTML = html;
  box.scrollTop = box.scrollHeight;
}

window.deleteMessage = function(id, ev){
  if(ev){ ev.stopPropagation(); }
  if(!confirm('Delete this message? This cannot be undone.')) return;
  fetch(API+'/messages.php?id='+id,{method:'DELETE', credentials:'same-origin'})
    .then(function(r){return r.json()})
    .then(function(d){
      if(d.error){ alert(d.error); return; }
      var el = document.querySelector('.chat-msg[data-msg-id="'+id+'"]');
      if(el) el.remove();
      if(chatState.activeLeadId) loadThreads(true);
    })
    .catch(function(){ alert('Failed to delete message.'); });
};

window.chatKey = function(e){
  var input = document.getElementById('chat-input');
  document.getElementById('chat-send').disabled = input.value.trim()==='';
  if(e.key==='Enter' && !e.shiftKey){ e.preventDefault(); sendMessage(); }
};
window.autoGrow = function(el){
  el.style.height = 'auto';
  el.style.height = Math.min(el.scrollHeight, 120) + 'px';
  document.getElementById('chat-send').disabled = el.value.trim()==='';
};

window.sendMessage = function(){
  if(!chatState.activeLeadId) return;
  var input = document.getElementById('chat-input');
  var body = input.value.trim();
  if(!body) return;
  var btn = document.getElementById('chat-send');
  btn.disabled = true;
  fetch(API+'/messages.php',{
    method:'POST', credentials:'same-origin',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify({lead_id: chatState.activeLeadId, body: body})
  })
  .then(function(r){return r.json()})
  .then(function(d){
    if(d.error){ alert(d.error); btn.disabled=false; return; }
    input.value = ''; input.style.height='auto';
    loadThread(chatState.activeLeadId);
  })
  .catch(function(){ alert('Failed to send.'); btn.disabled=false; });
};

window.simulateReply = function(){
  if(!chatState.activeLeadId) return;
  var canned = [
    'Thanks for the details, reviewing internally.',
    'Sounds good — could you share a pricing proposal?',
    'Let me loop in our CTO and get back to you.',
    'Great, booking a slot next week works.',
    'One question: is the sandbox access included?'
  ];
  var msg = canned[Math.floor(Math.random()*canned.length)];
  fetch(API+'/messages.php',{
    method:'POST', credentials:'same-origin',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify({action:'simulate', lead_id: chatState.activeLeadId, body: msg})
  })
  .then(function(){
    loadThread(chatState.activeLeadId);
    loadNotifications(true);
  });
};

/* ═══════════════════════════════════════════════
   NOTIFICATIONS
   ═══════════════════════════════════════════════ */
window.toggleNotif = function(e){
  if(e) e.stopPropagation();
  var d = document.getElementById('notif-dropdown');
  var opening = !d.classList.contains('open');
  d.classList.toggle('open');
  if(opening) loadNotifications();
};

function loadNotifications(silent){
  fetch(API+'/notifications.php',{credentials:'same-origin'})
    .then(function(r){return r.json()})
    .then(function(d){
      var items = d.notifications || [];
      var unread = d.unread || 0;
      var badge = document.getElementById('notif-count');
      badge.textContent = unread > 99 ? '99+' : unread;
      badge.classList.toggle('active', unread > 0);
      var list = document.getElementById('notif-list');
      if(!items.length){
        list.innerHTML = '<div class="notif-empty">No notifications yet.</div>';
        return;
      }
      list.innerHTML = items.map(function(n){
        var ico = iconForType(n.type);
        return '<div class="notif-item '+(n.is_read?'':'unread')+'" data-id="'+n.id+'" data-link="'+esc(n.link||'')+'" onclick="clickNotif('+n.id+', \''+esc(n.link||'')+'\')">'
          + '<div class="notif-icon '+esc(n.type||'info')+'">'+ico+'</div>'
          + '<div class="notif-body">'
          +   '<p class="t">'+esc(n.title)+'</p>'
          +   (n.body ? '<p class="b">'+esc(n.body)+'</p>' : '')
          +   '<p class="ts">'+esc(fmtTime(n.created_at))+'</p>'
          + '</div>'
          + '</div>';
      }).join('');
    })
    .catch(function(){
      if(!silent) document.getElementById('notif-list').innerHTML = '<div class="notif-empty">Failed to load.</div>';
    });
}

function iconForType(type){
  if(type==='message') return '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>';
  if(type==='lead') return '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
  if(type==='finance') return '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8"/></svg>';
  return '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
}

window.clickNotif = function(id, link){
  // Mark read optimistically
  var el = document.querySelector('.notif-item[data-id="'+id+'"]');
  if(el) el.classList.remove('unread');
  fetch(API+'/notifications.php',{
    method:'POST', credentials:'same-origin',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify({action:'mark_read', id: id})
  }).then(function(){ loadNotifications(true); });

  document.getElementById('notif-dropdown').classList.remove('open');
  if(link === '#chat') openChat();
  else if(link === '#leads') showSection('leads');
  else if(link === '#commissions') showSection('commissions');
  else if(link === '#reports') showSection('reports');
};

window.markAllNotifRead = function(){
  fetch(API+'/notifications.php',{
    method:'POST', credentials:'same-origin',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify({action:'mark_read'})
  }).then(function(){ loadNotifications(); });
};

function updateChatBadge(n){
  var b = document.getElementById('chat-fab-badge');
  if(!b) return;
  b.textContent = n > 99 ? '99+' : n;
  b.classList.toggle('active', n > 0);
}

/* Close notif dropdown on outside click */
document.addEventListener('click', function(e){
  var wrap = document.querySelector('.notif-wrap');
  var dd = document.getElementById('notif-dropdown');
  if(dd && dd.classList.contains('open') && wrap && !wrap.contains(e.target)){
    dd.classList.remove('open');
  }
});

/* ── Initial load ───────────────────────────── */
document.addEventListener('DOMContentLoaded', function(){
  loadLeads();
  loadNotifications(true);
  // Preload chat threads so FAB badge is accurate
  fetch(API+'/messages.php?action=threads',{credentials:'same-origin'})
    .then(function(r){return r.json()})
    .then(function(d){
      chatState.threads = d.threads || [];
      updateChatBadge(d.total_unread || 0);
    });
  // Poll every 30s for new notifications + chat unread
  setInterval(function(){
    loadNotifications(true);
    fetch(API+'/messages.php?action=threads',{credentials:'same-origin'})
      .then(function(r){return r.json()})
      .then(function(d){ updateChatBadge(d.total_unread || 0); });
  }, 30000);
});

})();
</script>
</body>
</html>