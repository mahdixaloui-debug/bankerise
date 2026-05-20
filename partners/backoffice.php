<?php
require_once __DIR__ . '/../config/auth.php';
requireAdmin();
$user = currentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Bankerise Admin Backoffice — Manage partners, track service progress, and view analytics across the partner ecosystem.">
  <title>Admin Backoffice — Bankerise®</title>
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

    /* ─── Ambient Background ─── */
    .dash-bg{position:fixed;inset:0;z-index:-2;overflow:hidden;pointer-events:none;background:#0D0F1C}
    .dash-bg .blob{position:absolute;border-radius:50%;filter:blur(100px);opacity:0.22;will-change:transform}
    .dash-bg .blob-1{width:520px;height:520px;background:#EF4444;top:-12%;right:-6%;animation:dash-blob 22s ease-in-out infinite}
    .dash-bg .blob-2{width:460px;height:460px;background:#766CFF;bottom:-10%;left:18%;animation:dash-blob 26s ease-in-out infinite -7s}
    .dash-bg .blob-3{width:380px;height:380px;background:#F97316;top:35%;left:55%;animation:dash-blob 30s ease-in-out infinite -14s;opacity:0.12}
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

    /* ─── Sidebar ─── */
    .sidebar{
      position:fixed;top:0;left:0;width:264px;height:100vh;
      background:linear-gradient(180deg,#05070F 0%,#070A14 55%,#05070F 100%);
      border-right:1px solid rgba(239,68,68,0.08);
      box-shadow:1px 0 0 rgba(255,255,255,0.02), 4px 0 30px rgba(0,0,0,0.35);
      z-index:40;display:flex;flex-direction:column;transition:transform 0.3s
    }
    .sidebar-head{position:relative;padding:20px 20px 18px;border-bottom:1px solid rgba(255,255,255,0.05)}
    .sidebar-head::after{content:'';position:absolute;left:20px;right:20px;bottom:-1px;height:1px;background:linear-gradient(90deg,transparent,rgba(239,68,68,0.4),transparent)}
    .sidebar-logo-row{display:flex;align-items:center;gap:12px;text-decoration:none}
    .sidebar-logo{height:34px;width:auto;filter:drop-shadow(0 2px 8px rgba(239,68,68,0.25))}
    .sidebar-brand-badge{
      display:inline-flex;align-items:center;gap:6px;
      margin-top:10px;padding:4px 10px;
      border-radius:9999px;
      background:linear-gradient(135deg,rgba(239,68,68,0.18),rgba(249,115,22,0.18));
      border:1px solid rgba(239,68,68,0.35);
      font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;
      color:#EF4444;
      box-shadow:0 0 12px rgba(239,68,68,0.12) inset;
    }
    .sidebar-brand-badge::before{
      content:'';width:6px;height:6px;border-radius:50%;
      background:#EF4444;box-shadow:0 0 8px #EF4444;
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
      background:linear-gradient(180deg,#EF4444,#F97316);
      transition:height 0.25s ease;
    }
    .sidebar-link:hover{color:#fff;background:rgba(255,255,255,0.04);border-color:rgba(255,255,255,0.06);transform:translateX(2px)}
    .sidebar-link:hover::before{height:60%}
    .sidebar-link.active{
      color:#EF4444;font-weight:600;
      background:linear-gradient(90deg,rgba(239,68,68,0.12),rgba(239,68,68,0.02));
      border-color:rgba(239,68,68,0.18);
    }
    .sidebar-link.active::before{height:70%}
    .sidebar-link svg{width:18px;height:18px;flex-shrink:0}
    .sidebar-group-label{padding:0 24px;font-size:10px;font-weight:700;color:#4B5563;text-transform:uppercase;letter-spacing:0.12em;margin-bottom:6px;margin-top:18px}
    .sidebar-badge{margin-left:auto;font-size:10px;font-weight:700;padding:2px 8px;border-radius:9999px;background:rgba(239,68,68,0.15);color:#EF4444;border:1px solid rgba(239,68,68,0.25)}

    .sidebar-user{
      padding:14px;margin:10px;border-radius:14px;
      background:rgba(255,255,255,0.03);
      border:1px solid rgba(255,255,255,0.06);
      transition:all 0.25s ease;
    }
    .sidebar-user:hover{border-color:rgba(239,68,68,0.2);background:rgba(255,255,255,0.05)}

    /* ─── Main content ─── */
    .main-content{margin-left:264px;min-height:100vh;padding:0;position:relative}
    .topbar{
      position:sticky;top:0;z-index:30;
      background:rgba(13,15,28,0.55);
      backdrop-filter:blur(18px) saturate(140%);
      -webkit-backdrop-filter:blur(18px) saturate(140%);
      border-bottom:1px solid rgba(255,255,255,0.06);
      padding:16px 32px;display:flex;align-items:center;justify-content:space-between
    }

    /* ─── Cards ─── */
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
      border-color:rgba(239,68,68,0.35);
      transform:translateY(-4px);
      box-shadow:0 18px 50px rgba(0,0,0,0.35),0 0 40px rgba(239,68,68,0.08);
    }
    .stat-card:hover::after{transform:translateX(100%)}

    /* ─── Table ─── */
    .data-table{width:100%;border-collapse:separate;border-spacing:0}
    .data-table thead th{padding:13px 16px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#64748B;text-align:left;border-bottom:1px solid rgba(255,255,255,0.08);position:sticky;top:0;background:rgba(13,15,28,0.85);backdrop-filter:blur(12px)}
    .data-table tbody td{padding:14px 16px;font-size:13px;color:#CBD5E1;border-bottom:1px solid rgba(255,255,255,0.04)}
    .data-table tbody tr{transition:background 0.25s ease;cursor:pointer}
    .data-table tbody tr:hover{background:linear-gradient(90deg,rgba(239,68,68,0.06),rgba(249,115,22,0.04))}
    .data-table tbody tr:last-child td{border-bottom:none}

    /* ─── Badges ─── */
    .badge{display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:600;padding:4px 10px;border-radius:9999px;letter-spacing:0.02em}
    .badge-pending,.badge-stalled{background:rgba(251,191,36,0.12);color:#FBBF24;border:1px solid rgba(251,191,36,0.25)}
    .badge-accepted,.badge-approved{background:rgba(34,197,94,0.12);color:#22C55E;border:1px solid rgba(34,197,94,0.25)}
    .badge-declined,.badge-rejected{background:rgba(239,68,68,0.12);color:#EF4444;border:1px solid rgba(239,68,68,0.25)}
    .badge-processing,.badge-progress{background:rgba(77,184,205,0.12);color:#4DB8CD;border:1px solid rgba(77,184,205,0.25)}

    /* Tier badges */
    .tier-badge-bronze{background:rgba(205,127,50,0.12);color:#CD7F32;border:1px solid rgba(205,127,50,0.3);font-size:11px;font-weight:700;padding:5px 14px;border-radius:9999px;display:inline-flex;align-items:center;gap:6px}
    .tier-badge-silver{background:rgba(192,192,192,0.12);color:#C0C0C0;border:1px solid rgba(192,192,192,0.3);font-size:11px;font-weight:700;padding:5px 14px;border-radius:9999px;display:inline-flex;align-items:center;gap:6px}
    .tier-badge-gold{background:linear-gradient(135deg,rgba(255,215,0,0.15),rgba(255,179,0,0.08));color:#FFD700;border:1px solid rgba(255,215,0,0.35);font-size:11px;font-weight:700;padding:5px 14px;border-radius:9999px;display:inline-flex;align-items:center;gap:6px;box-shadow:0 0 20px rgba(255,215,0,0.08)}

    /* ─── Buttons ─── */
    .btn-p{
      display:inline-flex;align-items:center;gap:8px;
      padding:10px 20px;
      background:linear-gradient(135deg,#EF4444,#F97316);
      color:#fff;font-weight:600;font-size:13px;
      border-radius:10px;border:none;cursor:pointer;
      font-family:'Montserrat',sans-serif;
      transition:transform 0.25s ease,box-shadow 0.25s ease;
      box-shadow:0 6px 20px rgba(239,68,68,0.25);
      position:relative;overflow:hidden;
    }
    .btn-p::after{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(255,255,255,0.15),transparent);opacity:0;transition:opacity 0.3s}
    .btn-p:hover{transform:translateY(-2px);box-shadow:0 12px 35px rgba(239,68,68,0.4)}
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
    .btn-s:hover{background:rgba(255,255,255,0.1);border-color:rgba(239,68,68,0.35);transform:translateY(-1px)}
    .btn-accept{background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.3);color:#22C55E;padding:8px 18px;border-radius:10px;font-size:12px;font-weight:600;cursor:pointer;font-family:'Montserrat',sans-serif;transition:all 0.25s}
    .btn-accept:hover{background:rgba(34,197,94,0.2);transform:translateY(-1px);box-shadow:0 4px 15px rgba(34,197,94,0.2)}
    .btn-decline{background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:#EF4444;padding:8px 18px;border-radius:10px;font-size:12px;font-weight:600;cursor:pointer;font-family:'Montserrat',sans-serif;transition:all 0.25s}
    .btn-decline:hover{background:rgba(239,68,68,0.2);transform:translateY(-1px);box-shadow:0 4px 15px rgba(239,68,68,0.2)}
    .btn-stall{background:rgba(251,191,36,0.1);border:1px solid rgba(251,191,36,0.3);color:#FBBF24;padding:8px 18px;border-radius:10px;font-size:12px;font-weight:600;cursor:pointer;font-family:'Montserrat',sans-serif;transition:all 0.25s}
    .btn-stall:hover{background:rgba(251,191,36,0.2);transform:translateY(-1px);box-shadow:0 4px 15px rgba(251,191,36,0.2)}

    /* ─── Input ─── */
    .input{padding:10px 14px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:#fff;font-size:13px;outline:none;font-family:'Montserrat',sans-serif;transition:all 0.25s;width:100%}
    .input:focus{border-color:#EF4444;background:rgba(239,68,68,0.06);box-shadow:0 0 0 3px rgba(239,68,68,0.15)}
    .input::placeholder{color:rgba(255,255,255,0.3)}
    select.input{cursor:pointer;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='rgba(255,255,255,0.4)' viewBox='0 0 16 16'%3E%3Cpath d='M4 6l4 4 4-4'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center}
    select.input option{background:#1F2937;color:#fff}
    textarea.input{resize:vertical;min-height:80px}

    /* ─── Section ─── */
    .dash-section{display:none;padding:32px;position:relative;z-index:1}
    .dash-section.active{display:block;animation:dash-fade 0.4s ease}
    @keyframes dash-fade{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}

    /* ─── Progress Bar ─── */
    .progress-track{width:100%;height:12px;background:rgba(255,255,255,0.06);border-radius:9999px;overflow:hidden;position:relative}
    .progress-fill{height:100%;border-radius:9999px;transition:width 0.8s cubic-bezier(0.25,0.46,0.45,0.94);position:relative;overflow:hidden}
    .progress-fill::after{content:'';position:absolute;inset:0;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.2),transparent);animation:progress-shimmer 2s infinite}
    @keyframes progress-shimmer{0%{transform:translateX(-100%)}100%{transform:translateX(100%)}}
    .progress-fill.accepted{background:linear-gradient(90deg,#22C55E,#4ADE80)}
    .progress-fill.declined{background:linear-gradient(90deg,#EF4444,#F87171)}
    .progress-fill.stalled{background:linear-gradient(90deg,#FBBF24,#FCD34D)}
    .progress-fill.in-progress{background:linear-gradient(90deg,#4DB8CD,#766CFF)}

    /* ─── Partner edit panel ─── */
    .partner-edit-panel{display:none;animation:dash-fade 0.4s ease}
    .partner-edit-panel.active{display:block}

    /* ─── Donut center text ─── */
    .chart-center-label{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;pointer-events:none}

    /* ─── Toggle ─── */
    .toggle-btn{padding:6px 14px;font-size:12px;font-weight:600;border-radius:8px;border:1px solid rgba(255,255,255,0.1);background:transparent;color:#94A3B8;cursor:pointer;transition:all 0.25s;font-family:'Montserrat',sans-serif}
    .toggle-btn:hover{color:#fff;border-color:rgba(255,255,255,0.25)}
    .toggle-btn.active{background:rgba(239,68,68,0.12);border-color:rgba(239,68,68,0.4);color:#EF4444;box-shadow:0 0 12px rgba(239,68,68,0.15)}

    /* ─── Gradient text ─── */
    .admin-gradient-text{background:linear-gradient(135deg,#EF4444,#F97316);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}

    /* ─── Metric Ring ─── */
    .metric-ring{position:relative;width:100px;height:100px}
    .metric-ring svg{width:100%;height:100%;transform:rotate(-90deg)}
    .metric-ring .ring-bg{fill:none;stroke:rgba(255,255,255,0.06);stroke-width:8}
    .metric-ring .ring-fill{fill:none;stroke-width:8;stroke-linecap:round;transition:stroke-dashoffset 1.5s cubic-bezier(0.25,0.46,0.45,0.94)}
    .metric-ring .ring-label{position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center}

    /* ─── Action row buttons ─── */
    .row-action{background:none;border:none;cursor:pointer;padding:4px;border-radius:6px;transition:all 0.2s;color:#64748B}
    .row-action:hover{color:#fff;background:rgba(255,255,255,0.08)}
    .row-action.delete:hover{color:#EF4444;background:rgba(239,68,68,0.1)}

    /* ─── Responsive ─── */
    @media(max-width:1024px){
      .sidebar{transform:translateX(-100%)}
      .sidebar.open{transform:translateX(0)}
      .main-content{margin-left:0}
    }

    /* ─── Gold shimmer ─── */
    @keyframes gold-shimmer{0%{background-position:-200% 0}100%{background-position:200% 0}}
    .gold-shimmer{background:linear-gradient(90deg,#FFD700,#FFF8DC,#FFD700);background-size:200% 100%;-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;animation:gold-shimmer 3s linear infinite}

    /* ─── Admin Notification Dropdown ─── */
    .anotif-wrap{position:relative}
    .anotif-btn{position:relative;padding:8px;border-radius:10px;color:#9CA3AF;background:transparent;border:1px solid transparent;transition:all 0.2s;cursor:pointer}
    .anotif-btn:hover{color:#fff;background:rgba(239,68,68,0.08);border-color:rgba(239,68,68,0.3)}
    .anotif-count{position:absolute;top:2px;right:2px;min-width:16px;height:16px;padding:0 4px;border-radius:9999px;background:#EF4444;color:#fff;font-size:9px;font-weight:700;display:flex;align-items:center;justify-content:center;box-shadow:0 0 0 2px #0D0F1C;animation:anotif-pulse 2s ease-in-out infinite}
    @keyframes anotif-pulse{0%,100%{box-shadow:0 0 0 2px #0D0F1C,0 0 0 0 rgba(239,68,68,0.5)}50%{box-shadow:0 0 0 2px #0D0F1C,0 0 0 6px rgba(239,68,68,0)}}
    .anotif-dropdown{position:absolute;top:calc(100% + 8px);right:0;width:380px;max-width:calc(100vw - 40px);background:linear-gradient(180deg,#111827,#0D0F1C);border:1px solid rgba(239,68,68,0.2);border-radius:14px;box-shadow:0 20px 60px rgba(0,0,0,0.5),0 0 30px rgba(239,68,68,0.08);opacity:0;visibility:hidden;transform:translateY(-8px);transition:all 0.25s cubic-bezier(0.4,0,0.2,1);z-index:50;overflow:hidden}
    .anotif-dropdown.open{opacity:1;visibility:visible;transform:translateY(0)}
    .anotif-head{display:flex;align-items:center;justify-content:space-between;padding:14px 16px;border-bottom:1px solid rgba(255,255,255,0.05);font-size:13px;font-weight:700;color:#fff}
    .anotif-mark{font-size:10px;color:#EF4444;background:transparent;border:none;cursor:pointer;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;padding:4px 8px;border-radius:6px;transition:background 0.2s}
    .anotif-mark:hover{background:rgba(239,68,68,0.08)}
    .anotif-list{max-height:420px;overflow-y:auto}
    .anotif-item{display:flex;gap:12px;padding:12px 16px;border-bottom:1px solid rgba(255,255,255,0.03);cursor:pointer;transition:background 0.15s;position:relative}
    .anotif-item:hover{background:rgba(255,255,255,0.03)}
    .anotif-item.unread{background:rgba(239,68,68,0.05)}
    .anotif-item.unread::before{content:'';position:absolute;left:6px;top:50%;transform:translateY(-50%);width:5px;height:5px;border-radius:50%;background:#EF4444;box-shadow:0 0 6px #EF4444}
    .anotif-icon{width:32px;height:32px;border-radius:10px;flex-shrink:0;display:flex;align-items:center;justify-content:center}
    .anotif-body{flex:1;min-width:0}
    .anotif-title{font-size:12px;font-weight:600;color:#fff;margin-bottom:2px}
    .anotif-sub{font-size:11px;color:#94A3B8;line-height:1.4;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical}
    .anotif-time{font-size:10px;color:#64748B;margin-top:4px}

    /* ─── Partner Activity tabs ─── */
    .pa-tab{padding:8px 14px;font-size:12px;font-weight:600;color:#94A3B8;border:none;background:transparent;cursor:pointer;border-bottom:2px solid transparent;transition:all 0.2s}
    .pa-tab:hover{color:#fff}
    .pa-tab.active{color:#EF4444;border-bottom-color:#EF4444}
    .pa-panel{padding:8px 0;min-height:80px}
    .pa-row{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:10px 12px;border-radius:10px;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.04);margin-bottom:8px;transition:background 0.2s}
    .pa-row:hover{background:rgba(255,255,255,0.04)}

    /* ─── Refresh spin ─── */
    @keyframes adm-spin{to{transform:rotate(360deg)}}
    .adm-spinning{animation:adm-spin 0.8s linear infinite;transform-origin:center}

    /* ─── Heatmap cell ─── */
    .heatmap-cell{width:100%;aspect-ratio:1;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;transition:all 0.3s;cursor:default}
    .heatmap-cell:hover{transform:scale(1.15);z-index:2}

    /* ─── Sparkline ─── */
    .sparkline-wrap{display:flex;align-items:end;gap:2px;height:32px}
    .sparkline-bar{width:6px;border-radius:2px;transition:height 0.4s cubic-bezier(0.25,0.46,0.45,0.94);min-height:3px}
  </style>
</head>
<body class="font-montserrat">

<!-- ═══════════════════════════════════════════════
     AMBIENT BACKGROUND
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
    <span class="sidebar-brand-badge">Admin Control</span>
  </div>

  <div class="flex-1 overflow-y-auto py-3">
    <p class="sidebar-group-label">Overview</p>
    <button class="sidebar-link active" data-section="overview" onclick="showSection('overview')">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
      Dashboard
    </button>

    <p class="sidebar-group-label">Management</p>
    <button class="sidebar-link" data-section="partners" onclick="showSection('partners')">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
      All Partners <span class="sidebar-badge" id="sidebar-partners-count">0</span>
    </button>
    <button class="sidebar-link" data-section="applications" onclick="showSection('applications')">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
      Applications <span class="sidebar-badge" id="sidebar-apps-count" style="background:rgba(251,191,36,0.15);color:#FBBF24;border-color:rgba(251,191,36,0.3)">0</span>
    </button>
    <button class="sidebar-link" data-section="reports" onclick="showSection('reports')">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h4m-4-4V5a1 1 0 00-1-1H5a1 1 0 00-1 1v14a1 1 0 001 1h14a1 1 0 001-1v-6"/></svg>
      Reports <span class="sidebar-badge" id="sidebar-reports-count" style="background:rgba(118,108,255,0.15);color:#766CFF;border-color:rgba(118,108,255,0.3)">0</span>
    </button>

    <p class="sidebar-group-label">Analytics</p>
    <button class="sidebar-link" data-section="analytics" onclick="showSection('analytics')">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
      Advanced Analytics
    </button>

    <p class="sidebar-group-label">System</p>
    <button class="sidebar-link" data-section="settings" onclick="showSection('settings')">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
      Settings
    </button>
  </div>

  <div class="sidebar-user">
    <div class="flex items-center gap-3">
      <div class="w-9 h-9 rounded-full bg-gradient-to-br from-red-500 to-orange-500 flex items-center justify-center text-xs font-bold shadow-lg shadow-red-500/30">SA</div>
      <div class="flex-1 min-w-0">
        <p class="text-xs font-semibold text-white truncate">System Admin</p>
        <p class="text-[10px] font-semibold tracking-wider uppercase" style="color:#EF4444">Super Admin</p>
      </div>
      <a href="javascript:void(0)" onclick="doLogout()" class="text-gray-500 hover:text-red-400 transition-colors" title="Sign out">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
      </a>
    </div>
  </div>
</aside>

<!-- ═══════════════════════════════════════════════
     MAIN CONTENT
     ═══════════════════════════════════════════════ -->
<div class="main-content">

  <!-- Topbar -->
  <div class="topbar">
    <div class="flex items-center gap-3">
      <button class="lg:hidden text-white p-1" onclick="document.getElementById('sidebar').classList.toggle('open')">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
      </button>
      <h1 class="text-lg font-bold" id="section-title">Dashboard</h1>
    </div>
    <div class="flex items-center gap-3">
      <div class="relative">
        <input type="text" placeholder="Search partners..." class="input !py-2 !text-xs !pl-9 w-52" id="global-search" oninput="onGlobalSearch()">
        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
      </div>
      <button id="admin-refresh-btn" class="relative text-gray-400 hover:text-white transition-colors p-2 rounded-lg border border-white/10 hover:border-red-500/40 hover:bg-red-500/10 flex items-center gap-2" onclick="refreshAdminDashboard()" title="Refresh all data">
        <svg id="admin-refresh-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
        <span class="text-xs hidden sm:inline">Refresh</span>
      </button>
      <div class="anotif-wrap" id="anotif-wrap">
        <button class="anotif-btn" onclick="toggleAdminNotif(event)" aria-label="Notifications">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
          <span class="anotif-count" id="anotif-count" style="display:none">0</span>
        </button>
        <div class="anotif-dropdown" id="anotif-dropdown">
          <div class="anotif-head">
            <span>Notifications</span>
            <button class="anotif-mark" onclick="markAllAdminNotifRead()">Mark all read</button>
          </div>
          <div class="anotif-list" id="anotif-list">
            <p class="text-xs text-gray-500 text-center py-8">Loading…</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SECTION 1: OVERVIEW / DASHBOARD
       ═══════════════════════════════════════════ -->
  <div class="dash-section active" id="sec-overview">

    <!-- Hero Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
      <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
          <div class="w-10 h-10 rounded-xl bg-red-500/10 flex items-center justify-center">
            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          </div>
          <div class="sparkline-wrap" id="sparkline-partners"></div>
        </div>
        <p class="text-2xl font-extrabold text-white" id="stat-total">—</p>
        <p class="text-xs text-gray-500 mt-1">Total Partners</p>
        <p class="text-[10px] text-green-400 mt-1" id="stat-total-sub">Live from DB</p>
      </div>
      <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
          <div class="w-10 h-10 rounded-xl bg-green-500/10 flex items-center justify-center">
            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </div>
          <div class="sparkline-wrap" id="sparkline-accepted"></div>
        </div>
        <p class="text-2xl font-extrabold" style="color:#22C55E" id="stat-accepted">—</p>
        <p class="text-xs text-gray-500 mt-1">Accepted Partners</p>
        <p class="text-[10px] text-gray-500 mt-1" id="stat-accepted-sub">—% acceptance rate</p>
      </div>
      <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
          <div class="w-10 h-10 rounded-xl bg-yellow-500/10 flex items-center justify-center">
            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </div>
          <div class="sparkline-wrap" id="sparkline-pending"></div>
        </div>
        <p class="text-2xl font-extrabold text-yellow-400" id="stat-pending">—</p>
        <p class="text-xs text-gray-500 mt-1">Pending / Stalled</p>
        <p class="text-[10px] text-yellow-500 mt-1" id="stat-pending-sub">— awaiting review</p>
      </div>
      <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
          <div class="w-10 h-10 rounded-xl bg-red-500/10 flex items-center justify-center">
            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
          </div>
          <div class="sparkline-wrap" id="sparkline-declined"></div>
        </div>
        <p class="text-2xl font-extrabold text-red-400" id="stat-declined">—</p>
        <p class="text-xs text-gray-500 mt-1">Declined</p>
        <p class="text-[10px] text-gray-500 mt-1" id="stat-declined-sub">—% decline rate</p>
      </div>
    </div>

    <!-- Charts Row -->
    <div class="grid lg:grid-cols-3 gap-6 mb-8">
      <!-- Tier Distribution Donut -->
      <div class="stat-card">
        <h3 class="text-sm font-bold mb-4 flex items-center gap-2">
          <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
          Partners by Tier
        </h3>
        <div class="flex items-center justify-center" style="height:200px;position:relative">
          <canvas id="chart-tier-donut"></canvas>
          <div class="chart-center-label">
            <p class="text-2xl font-extrabold text-white" id="donut-center-total">—</p>
            <p class="text-[10px] text-gray-500 uppercase tracking-wider">Total</p>
          </div>
        </div>
        <div class="flex justify-center gap-4 mt-4">
          <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full" style="background:#CD7F32"></span><span class="text-xs text-gray-400">Bronze (<span id="legend-bronze">0</span>)</span></div>
          <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full" style="background:#C0C0C0"></span><span class="text-xs text-gray-400">Silver (<span id="legend-silver">0</span>)</span></div>
          <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full" style="background:#FFD700"></span><span class="text-xs text-gray-400">Gold (<span id="legend-gold">0</span>)</span></div>
        </div>
      </div>

      <!-- Partner Type Distribution -->
      <div class="stat-card">
        <h3 class="text-sm font-bold mb-4 flex items-center gap-2">
          <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
          Partners by Type
        </h3>
        <div style="height:200px">
          <canvas id="chart-type-bar"></canvas>
        </div>
        <div class="grid grid-cols-3 gap-2 mt-4">
          <div class="text-center p-2 rounded-lg" style="background:rgba(77,184,205,0.06)">
            <p class="text-lg font-bold text-pacific" id="type-banking">0</p>
            <p class="text-[9px] text-gray-500 leading-tight">Banking Decision</p>
          </div>
          <div class="text-center p-2 rounded-lg" style="background:rgba(118,108,255,0.06)">
            <p class="text-lg font-bold text-aqua" id="type-it">0</p>
            <p class="text-[9px] text-gray-500 leading-tight">IT Manager</p>
          </div>
          <div class="text-center p-2 rounded-lg" style="background:rgba(249,115,22,0.06)">
            <p class="text-lg font-bold text-orange-400" id="type-local">0</p>
            <p class="text-[9px] text-gray-500 leading-tight">Local Integrator</p>
          </div>
        </div>
      </div>

      <!-- Acceptance Rate by Type Heatmap -->
      <div class="stat-card">
        <h3 class="text-sm font-bold mb-4 flex items-center gap-2">
          <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
          Acceptance Heatmap
        </h3>
        <p class="text-[10px] text-gray-500 mb-3 uppercase tracking-wider">Status ÷ Partner Type</p>
        <!-- Heatmap Grid -->
        <div class="space-y-2">
          <div class="grid grid-cols-4 gap-2">
            <div class="text-[9px] text-gray-500 flex items-center"></div>
            <div class="text-[9px] text-gray-500 text-center">Banking DM</div>
            <div class="text-[9px] text-gray-500 text-center">IT Manager</div>
            <div class="text-[9px] text-gray-500 text-center">Local Integ.</div>
          </div>
          <div class="grid grid-cols-4 gap-2 items-center">
            <div class="text-[10px] text-green-400 font-semibold">Accepted</div>
            <div class="heatmap-cell" style="background:rgba(34,197,94,0.2);color:#22C55E" id="heat-Accepted-Banking">0</div>
            <div class="heatmap-cell" style="background:rgba(34,197,94,0.2);color:#22C55E" id="heat-Accepted-IT">0</div>
            <div class="heatmap-cell" style="background:rgba(34,197,94,0.2);color:#22C55E" id="heat-Accepted-Local">0</div>
          </div>
          <div class="grid grid-cols-4 gap-2 items-center">
            <div class="text-[10px] text-yellow-400 font-semibold">Stalled</div>
            <div class="heatmap-cell" style="background:rgba(251,191,36,0.15);color:#FBBF24" id="heat-Stalled-Banking">0</div>
            <div class="heatmap-cell" style="background:rgba(251,191,36,0.15);color:#FBBF24" id="heat-Stalled-IT">0</div>
            <div class="heatmap-cell" style="background:rgba(251,191,36,0.15);color:#FBBF24" id="heat-Stalled-Local">0</div>
          </div>
          <div class="grid grid-cols-4 gap-2 items-center">
            <div class="text-[10px] text-red-400 font-semibold">Declined</div>
            <div class="heatmap-cell" style="background:rgba(239,68,68,0.1);color:#EF4444" id="heat-Declined-Banking">0</div>
            <div class="heatmap-cell" style="background:rgba(239,68,68,0.1);color:#EF4444" id="heat-Declined-IT">0</div>
            <div class="heatmap-cell" style="background:rgba(239,68,68,0.1);color:#EF4444" id="heat-Declined-Local">0</div>
          </div>
          <div class="grid grid-cols-4 gap-2 items-center">
            <div class="text-[10px] text-pacific font-semibold">Pending</div>
            <div class="heatmap-cell" style="background:rgba(77,184,205,0.1);color:#4DB8CD" id="heat-Pending-Banking">0</div>
            <div class="heatmap-cell" style="background:rgba(77,184,205,0.1);color:#4DB8CD" id="heat-Pending-IT">0</div>
            <div class="heatmap-cell" style="background:rgba(77,184,205,0.1);color:#4DB8CD" id="heat-Pending-Local">0</div>
          </div>
        </div>
        <!-- Summary -->
        <div class="flex items-center justify-between mt-4 pt-3 border-t border-white/5">
          <span class="text-[10px] text-gray-500" id="heat-summary-label">Highest acceptance: —</span>
          <span class="text-[10px] text-green-400 font-semibold" id="heat-summary-rate">—%</span>
        </div>
      </div>
    </div>

    <!-- Acceptance Over Time + Tier Metric Rings -->
    <div class="grid lg:grid-cols-2 gap-6 mb-8">
      <!-- Stacked bar: Acceptance over time -->
      <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-sm font-bold flex items-center gap-2">
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/></svg>
            Forms Processed Over Time
          </h3>
          <div class="flex gap-2">
            <span class="flex items-center gap-1 text-[10px] text-gray-400"><span class="w-2 h-2 rounded-sm bg-green-500"></span>Accepted</span>
            <span class="flex items-center gap-1 text-[10px] text-gray-400"><span class="w-2 h-2 rounded-sm bg-yellow-400"></span>Stalled</span>
            <span class="flex items-center gap-1 text-[10px] text-gray-400"><span class="w-2 h-2 rounded-sm bg-red-500"></span>Declined</span>
          </div>
        </div>
        <div style="height:220px"><canvas id="chart-timeline"></canvas></div>
      </div>

      <!-- Tier acceptance metric rings -->
      <div class="stat-card">
        <h3 class="text-sm font-bold mb-6 flex items-center gap-2">
          <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
          Acceptance Rate by Tier
        </h3>
        <div class="flex items-center justify-around">
          <!-- Bronze Ring -->
          <div class="text-center">
            <div class="metric-ring mx-auto" data-color="#CD7F32">
              <svg viewBox="0 0 100 100">
                <circle class="ring-bg" cx="50" cy="50" r="42"/>
                <circle class="ring-fill" cx="50" cy="50" r="42" stroke="#CD7F32" stroke-dasharray="263.9" stroke-dashoffset="263.9" id="ring-bronze-fill"/>
              </svg>
              <div class="ring-label">
                <p class="text-lg font-bold" style="color:#CD7F32" id="ring-bronze-pct">0%</p>
              </div>
            </div>
            <p class="text-xs text-gray-400 mt-2">🥉 Bronze</p>
            <p class="text-[10px] text-gray-600" id="ring-bronze-ratio">0 of 0</p>
          </div>
          <!-- Silver Ring -->
          <div class="text-center">
            <div class="metric-ring mx-auto" data-color="#C0C0C0">
              <svg viewBox="0 0 100 100">
                <circle class="ring-bg" cx="50" cy="50" r="42"/>
                <circle class="ring-fill" cx="50" cy="50" r="42" stroke="#C0C0C0" stroke-dasharray="263.9" stroke-dashoffset="263.9" id="ring-silver-fill"/>
              </svg>
              <div class="ring-label">
                <p class="text-lg font-bold" style="color:#C0C0C0" id="ring-silver-pct">0%</p>
              </div>
            </div>
            <p class="text-xs text-gray-400 mt-2">🥈 Silver</p>
            <p class="text-[10px] text-gray-600" id="ring-silver-ratio">0 of 0</p>
          </div>
          <!-- Gold Ring -->
          <div class="text-center">
            <div class="metric-ring mx-auto" data-color="#FFD700">
              <svg viewBox="0 0 100 100">
                <circle class="ring-bg" cx="50" cy="50" r="42"/>
                <circle class="ring-fill" cx="50" cy="50" r="42" stroke="#FFD700" stroke-dasharray="263.9" stroke-dashoffset="263.9" id="ring-gold-fill"/>
              </svg>
              <div class="ring-label">
                <p class="text-lg font-bold gold-shimmer" id="ring-gold-pct">0%</p>
              </div>
            </div>
            <p class="text-xs text-gray-400 mt-2">🏆 Gold</p>
            <p class="text-[10px] text-gray-600" id="ring-gold-ratio">0 of 0</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Activity Feed -->
    <div class="stat-card">
      <h3 class="text-sm font-bold mb-4 flex items-center gap-2">
        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Recent Activity
      </h3>
      <div class="space-y-3" id="activity-feed">
        <p class="text-xs text-gray-500 text-center py-6">Loading activity…</p>
      </div>
    </div>

  </div>

  <!-- ═══════════════════════════════════════════
       SECTION 2: ALL PARTNERS — LIST + EDIT
       ═══════════════════════════════════════════ -->
  <div class="dash-section" id="sec-partners">

    <!-- Partners List View -->
    <div id="partners-list-view">
      <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div class="flex flex-wrap items-center gap-3">
          <select class="input !w-36 !py-2 !text-xs" id="filter-tier" onchange="filterPartnerList()">
            <option value="">All Tiers</option><option value="Bronze">Bronze</option><option value="Silver">Silver</option><option value="Gold">Gold</option>
          </select>
          <select class="input !w-44 !py-2 !text-xs" id="filter-type" onchange="filterPartnerList()">
            <option value="">All Types</option><option value="Banking Decision Maker">Banking Decision Maker</option><option value="IT Manager">IT Manager</option><option value="Local Integrator">Local Integrator</option>
          </select>
          <select class="input !w-36 !py-2 !text-xs" id="filter-status" onchange="filterPartnerList()">
            <option value="">All Statuses</option><option value="Accepted">Accepted</option><option value="Stalled">Stalled</option><option value="Declined">Declined</option><option value="Pending">Pending</option>
          </select>
        </div>
        <p class="text-xs text-gray-500" id="partner-count-label">Showing 18 partners</p>
      </div>

      <div class="rounded-xl border border-white/5 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="data-table" id="partners-table">
            <thead><tr>
              <th>Partner Name</th><th>Company</th><th>Type</th><th>Tier</th><th>Status</th><th>Progress</th><th style="text-align:right">Actions</th>
            </tr></thead>
            <tbody id="partners-tbody">
              <!-- Rows injected by JS -->
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Partner Edit View (hidden by default) -->
    <div class="partner-edit-panel" id="partner-edit-panel">
      <button class="btn-s mb-6" onclick="closePartnerEdit()">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Back to Partners List
      </button>

      <!-- Partner Header -->
      <div class="stat-card mb-6">
        <div class="flex flex-wrap items-start justify-between gap-4">
          <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-red-500/20 to-orange-500/20 flex items-center justify-center text-xl font-bold" id="edit-avatar">AK</div>
            <div>
              <h2 class="text-xl font-bold text-white" id="edit-name">Partner Name</h2>
              <p class="text-sm text-gray-400" id="edit-company">Company Name</p>
              <div class="flex items-center gap-3 mt-2">
                <span id="edit-type-badge" class="badge badge-processing">Type</span>
                <span id="edit-tier-badge" class="tier-badge-gold">🏆 Gold</span>
              </div>
            </div>
          </div>
          <div class="flex items-center gap-2">
            <span class="badge" id="edit-status-badge">Status</span>
          </div>
        </div>
      </div>

      <!-- Service Progress -->
      <div class="stat-card mb-6">
        <h3 class="text-sm font-bold mb-4 flex items-center gap-2">
          <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
          Service Progress Tracker
        </h3>
        <div class="flex items-center gap-4 mb-4">
          <div class="flex-1">
            <div class="progress-track">
              <div class="progress-fill in-progress" id="edit-progress-bar" style="width:65%"></div>
            </div>
          </div>
          <span class="text-lg font-bold text-white" id="edit-progress-pct">65%</span>
        </div>
        <div class="flex items-center justify-between mb-6">
          <div class="flex items-center gap-6">
            <div class="flex items-center gap-2">
              <span class="w-2 h-2 rounded-full bg-green-500"></span>
              <span class="text-[10px] text-gray-500">Application Submitted</span>
            </div>
            <div class="flex items-center gap-2">
              <span class="w-2 h-2 rounded-full" style="background:#4DB8CD"></span>
              <span class="text-[10px] text-gray-500">Under Review</span>
            </div>
            <div class="flex items-center gap-2">
              <span class="w-2 h-2 rounded-full bg-gray-600"></span>
              <span class="text-[10px] text-gray-500">Onboarding</span>
            </div>
            <div class="flex items-center gap-2">
              <span class="w-2 h-2 rounded-full bg-gray-700"></span>
              <span class="text-[10px] text-gray-500">Active</span>
            </div>
          </div>
        </div>

        <!-- Admin Decision Buttons -->
        <div class="flex flex-wrap gap-3">
          <button class="btn-accept" onclick="setPartnerStatus('Accepted')">
            <svg class="w-4 h-4 inline -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Accept Partner
          </button>
          <button class="btn-stall" onclick="setPartnerStatus('Stalled')">
            <svg class="w-4 h-4 inline -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Stall Review
          </button>
          <button class="btn-decline" onclick="setPartnerStatus('Declined')">
            <svg class="w-4 h-4 inline -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            Decline Partner
          </button>
        </div>
      </div>

      <!-- Partner Details Grid -->
      <div class="grid lg:grid-cols-2 gap-6">
        <div class="stat-card">
          <h3 class="text-sm font-bold mb-4">Partner Information</h3>
          <div class="space-y-4">
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Full Name</label><input class="input" id="edit-fullname" placeholder="Partner Name"></div>
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Email</label><input class="input" id="edit-email" type="email" placeholder="email@company.com"></div>
            <div class="grid grid-cols-2 gap-3">
              <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Phone</label><input class="input" id="edit-phone" placeholder="+1 234 567 890"></div>
              <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Country</label><input class="input" id="edit-country" placeholder="Country"></div>
            </div>
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Partner Type</label>
              <select class="input" id="edit-ptype">
                <option>Banking Decision Maker</option><option>IT Manager</option><option>Local Integrator</option>
              </select>
            </div>
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Tier</label>
              <select class="input" id="edit-ptier" onchange="updateTierPreview()">
                <option value="Bronze">Bronze</option><option value="Silver">Silver</option><option value="Gold">Gold</option>
              </select>
            </div>
          </div>
        </div>

        <div class="stat-card">
          <h3 class="text-sm font-bold mb-4">Business Details</h3>
          <div class="space-y-4">
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Company Name</label><input class="input" id="edit-company-name" placeholder="Company"></div>
            <div class="grid grid-cols-2 gap-3">
              <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Industry</label>
                <select class="input" id="edit-industry"><option>Banking</option><option>Microfinance</option><option>Insurance</option><option>Fintech</option><option>Payment</option></select>
              </div>
              <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Company Size</label>
                <select class="input" id="edit-compsize"><option>1-10</option><option>11-50</option><option>51-200</option><option>200+</option></select>
              </div>
            </div>
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Website</label><input class="input" id="edit-website" placeholder="https://"></div>
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Region</label><input class="input" id="edit-region" placeholder="North Africa, Middle East..."></div>
            <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Admin Notes</label><textarea class="input" id="edit-notes" rows="3" placeholder="Internal notes about this partner..."></textarea></div>
          </div>
        </div>
      </div>

      <!-- Partner Activity (admin view of this partner's real data) -->
      <div class="stat-card mt-6">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-sm font-bold flex items-center gap-2">
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h4m-4-4V5a1 1 0 00-1-1H5a1 1 0 00-1 1v14a1 1 0 001 1h14a1 1 0 001-1v-6"/></svg>
            Partner Activity
          </h3>
          <button class="btn-s" onclick="loadPartnerActivity(currentEditId)" style="padding:6px 12px">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            Reload
          </button>
        </div>

        <!-- Stats strip -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-5">
          <div class="p-3 rounded-xl" style="background:rgba(77,184,205,0.06);border:1px solid rgba(77,184,205,0.15)">
            <p class="text-[10px] text-gray-500 uppercase tracking-wider">Leads</p>
            <p class="text-xl font-extrabold text-pacific" id="pa-leads-count">—</p>
          </div>
          <div class="p-3 rounded-xl" style="background:rgba(34,197,94,0.06);border:1px solid rgba(34,197,94,0.15)">
            <p class="text-[10px] text-gray-500 uppercase tracking-wider">Approved Leads</p>
            <p class="text-xl font-extrabold text-green-400" id="pa-leads-approved">—</p>
          </div>
          <div class="p-3 rounded-xl" style="background:rgba(118,108,255,0.06);border:1px solid rgba(118,108,255,0.15)">
            <p class="text-[10px] text-gray-500 uppercase tracking-wider">Reports</p>
            <p class="text-xl font-extrabold text-aqua" id="pa-reports-count">—</p>
          </div>
          <div class="p-3 rounded-xl" style="background:rgba(251,191,36,0.06);border:1px solid rgba(251,191,36,0.15)">
            <p class="text-[10px] text-gray-500 uppercase tracking-wider">Chat Threads</p>
            <p class="text-xl font-extrabold text-yellow-400" id="pa-threads-count">—</p>
          </div>
        </div>

        <!-- Tabs -->
        <div class="flex items-center gap-2 mb-3 border-b border-white/5">
          <button class="pa-tab active" data-pa="leads" onclick="switchPaTab('leads')">Leads</button>
          <button class="pa-tab" data-pa="reports" onclick="switchPaTab('reports')">Reports</button>
          <button class="pa-tab" data-pa="threads" onclick="switchPaTab('threads')">Chat Threads</button>
        </div>

        <div id="pa-panel-leads" class="pa-panel"><p class="text-xs text-gray-500 text-center py-4">Open this section to load…</p></div>
        <div id="pa-panel-reports" class="pa-panel" style="display:none"></div>
        <div id="pa-panel-threads" class="pa-panel" style="display:none"></div>
      </div>

      <!-- Save button -->
      <div class="flex justify-end mt-6 gap-3">
        <button class="btn-s" onclick="closePartnerEdit()">Cancel</button>
        <button class="btn-p" onclick="savePartner(event)">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          Save Changes
        </button>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SECTION 3: APPLICATIONS
       ═══════════════════════════════════════════ -->
  <div class="dash-section" id="sec-applications">
    <div class="flex items-center justify-between mb-4">
      <p class="text-gray-400 text-sm">Review and process new partnership applications. These are partners awaiting initial review.</p>
      <div class="flex items-center gap-2">
        <select id="apps-filter" class="input" style="max-width:170px" onchange="loadApplications()">
          <option value="Pending">Pending</option>
          <option value="Reviewed">Reviewed</option>
          <option value="Approved">Approved</option>
          <option value="Rejected">Rejected</option>
          <option value="">All statuses</option>
        </select>
        <button class="btn-p" onclick="loadApplications()" style="padding:8px 16px;white-space:nowrap;flex-shrink:0">Refresh</button>
      </div>
    </div>
    <div class="grid gap-4" id="apps-container">
      <p class="text-xs text-gray-500 text-center py-8">Loading applications…</p>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SECTION 4: ADVANCED ANALYTICS
       ═══════════════════════════════════════════ -->
  <div class="dash-section" id="sec-analytics">
    <div class="grid lg:grid-cols-2 gap-6 mb-8">
      <div class="stat-card">
        <h3 class="text-sm font-bold mb-4">Acceptance Rate by Partner Type</h3>
        <div style="height:260px"><canvas id="chart-type-acceptance"></canvas></div>
      </div>
      <div class="stat-card">
        <h3 class="text-sm font-bold mb-4">Tier Distribution Growth (Quarterly)</h3>
        <div style="height:260px"><canvas id="chart-tier-growth"></canvas></div>
      </div>
    </div>
    <div class="grid lg:grid-cols-3 gap-6">
      <div class="stat-card text-center">
        <div class="w-12 h-12 rounded-2xl bg-green-500/10 flex items-center justify-center mx-auto mb-4">
          <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <p class="text-3xl font-extrabold text-green-400 mb-1" id="metric-accept-rate">—%</p>
        <p class="text-xs text-gray-500">Overall Acceptance Rate</p>
        <p class="text-[10px] text-green-400 mt-1" id="metric-accept-sub">—</p>
      </div>
      <div class="stat-card text-center">
        <div class="w-12 h-12 rounded-2xl bg-pacific/10 flex items-center justify-center mx-auto mb-4">
          <svg class="w-6 h-6 text-pacific" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <p class="text-3xl font-extrabold text-pacific mb-1">4.2 days</p>
        <p class="text-xs text-gray-500">Avg. Processing Time</p>
        <p class="text-[10px] text-pacific mt-1">↓ 1.3 days improvement</p>
      </div>
      <div class="stat-card text-center">
        <div class="w-12 h-12 rounded-2xl bg-yellow-500/10 flex items-center justify-center mx-auto mb-4">
          <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
        </div>
        <p class="text-3xl font-extrabold text-yellow-400 mb-1">27.8%</p>
        <p class="text-xs text-gray-500">Stall Rate</p>
        <p class="text-[10px] text-yellow-400 mt-1">↓ 5% vs last quarter</p>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SECTION: ALL REPORTS
       ═══════════════════════════════════════════ -->
  <div class="dash-section" id="sec-reports">
    <div class="flex items-center justify-between mb-4 flex-wrap gap-3">
      <p class="text-gray-400 text-sm">Every report submitted by every partner. Search by partner, company, or title.</p>
      <div class="flex items-center gap-2">
        <input type="text" class="input" placeholder="Search reports…" id="reports-search" oninput="filterReports()" style="max-width:220px">
        <select class="input" id="reports-type-filter" onchange="filterReports()" style="max-width:160px">
          <option value="">All types</option>
          <option>Sales</option>
          <option>Activity</option>
          <option>Pipeline</option>
          <option>Performance</option>
          <option>Other</option>
        </select>
        <button class="btn-p" onclick="loadAllReports()" style="padding:8px 16px;white-space:nowrap;flex-shrink:0">Refresh</button>
      </div>
    </div>
    <div class="rounded-xl border border-white/5 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="data-table">
          <thead><tr>
            <th>Partner</th>
            <th>Company</th>
            <th>Title</th>
            <th>Type</th>
            <th>Period</th>
            <th>Submitted</th>
            <th>Status</th>
            <th style="text-align:right">Actions</th>
          </tr></thead>
          <tbody id="reports-tbody">
            <tr><td colspan="8" class="text-center text-xs text-gray-500 py-6">Loading reports…</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Report Detail Modal -->
  <div id="report-detail-modal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.7);z-index:60;align-items:center;justify-content:center;padding:20px" onclick="if(event.target===this)closeReportModal()">
    <div class="stat-card" style="max-width:640px;width:100%;max-height:85vh;overflow-y:auto">
      <div class="flex items-start justify-between mb-4 gap-4">
        <div class="flex-1 min-w-0">
          <p class="text-[10px] text-gray-500 uppercase tracking-wider" id="rm-partner">—</p>
          <h3 class="text-lg font-bold text-white mt-1" id="rm-title">—</h3>
          <p class="text-xs text-gray-400 mt-1" id="rm-meta">—</p>
        </div>
        <button class="btn-s" onclick="closeReportModal()" style="padding:6px 10px">✕</button>
      </div>
      <div class="rounded-xl p-4" style="background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.05)">
        <pre id="rm-content" style="white-space:pre-wrap;word-break:break-word;font-family:inherit;font-size:12px;color:#CBD5E1;line-height:1.6"></pre>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SECTION 5: SETTINGS (placeholder)
       ═══════════════════════════════════════════ -->
  <div class="dash-section" id="sec-settings">
    <div class="max-w-2xl">
      <div class="stat-card mb-6">
        <h3 class="text-sm font-bold mb-4">Admin Account</h3>
        <div class="space-y-4">
          <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Admin Email</label><input class="input" value="admin@bankerise.com" readonly></div>
          <div><label class="text-xs text-gray-500 font-semibold mb-1 block">Password</label><input class="input" type="password" value="••••••••••"></div>
          <button class="btn-p">Update Credentials</button>
        </div>
      </div>
      <div class="stat-card">
        <h3 class="text-sm font-bold mb-4">Notification Preferences</h3>
        <div class="space-y-3">
          <label class="flex items-center justify-between p-3 rounded-xl border border-white/5 hover:border-white/10 cursor-pointer transition-colors">
            <span class="text-xs text-gray-300">Email on new application</span>
            <input type="checkbox" class="accent-red-500" checked>
          </label>
          <label class="flex items-center justify-between p-3 rounded-xl border border-white/5 hover:border-white/10 cursor-pointer transition-colors">
            <span class="text-xs text-gray-300">Email on partner status change</span>
            <input type="checkbox" class="accent-red-500" checked>
          </label>
          <label class="flex items-center justify-between p-3 rounded-xl border border-white/5 hover:border-white/10 cursor-pointer transition-colors">
            <span class="text-xs text-gray-300">Weekly analytics digest</span>
            <input type="checkbox" class="accent-red-500">
          </label>
        </div>
      </div>
    </div>
  </div>

</div><!-- end main-content -->

<!-- ═══════════════════════════════════════════════
     SCRIPTS
     ═══════════════════════════════════════════════ -->
<script>
(function(){
'use strict';

/* ══════════════════════════════════════════════
   PARTNER DATA — loaded from MySQL via API
   ══════════════════════════════════════════════ */
var partners = [];

// Load partners from DB
function loadPartners(callback) {
  fetch('/api/partners.php')
    .then(function(r){ return r.json(); })
    .then(function(data){
      if(Array.isArray(data)){
        partners = data.map(function(p){
          return {
            id: p.id, name: p.name, company: p.company, type: p.type,
            tier: p.tier, status: p.status, progress: parseInt(p.progress),
            email: p.email, phone: p.phone || '', country: p.country || '',
            industry: p.industry || '', size: p.company_size || '',
            website: p.website || '', region: p.region || '',
            notes: p.admin_notes || ''
          };
        });
      }
      if(callback) callback();
    })
    .catch(function(err){ console.error('Failed to load partners:', err); });
}

// Logout
window.doLogout = function(){
  fetch('/api/auth.php', {method:'DELETE'})
    .then(function(){ window.location.href = 'login.php'; })
    .catch(function(){ window.location.href = 'login.php'; });
};

var currentEditId = null;

/* ── Section Navigation ──────────────── */
var titles = {overview:'Dashboard',partners:'All Partners',applications:'Applications',reports:'All Reports',analytics:'Advanced Analytics',settings:'Settings'};

window.showSection = function(id){
  document.querySelectorAll('.dash-section').forEach(function(s){s.classList.remove('active')});
  document.getElementById('sec-'+id).classList.add('active');
  document.querySelectorAll('.sidebar-link').forEach(function(l){l.classList.remove('active')});
  var link = document.querySelector('[data-section="'+id+'"]');
  if(link) link.classList.add('active');
  document.getElementById('section-title').textContent = titles[id] || id;
  document.getElementById('sidebar').classList.remove('open');

  // Hide partner edit when switching sections
  if(id !== 'partners'){
    document.getElementById('partner-edit-panel').classList.remove('active');
    document.getElementById('partners-list-view').style.display = '';
  }

  // Init charts on first visit
  if(id === 'overview') initOverviewCharts();
  if(id === 'analytics') initAnalyticsCharts();
  if(id === 'reports') loadAllReports();
};

/* ── Render Partner Table ──────────── */
function renderPartnerTable(list){
  var tbody = document.getElementById('partners-tbody');
  tbody.innerHTML = '';
  list.forEach(function(p){
    var tierBadge = p.tier === 'Gold' ? '<span class="tier-badge-gold">🏆 Gold</span>' :
                    p.tier === 'Silver' ? '<span class="tier-badge-silver">🥈 Silver</span>' :
                    '<span class="tier-badge-bronze">🥉 Bronze</span>';
    var statusClass = p.status === 'Accepted' ? 'badge-accepted' :
                      p.status === 'Stalled' ? 'badge-stalled' :
                      p.status === 'Declined' ? 'badge-declined' : 'badge-pending';
    var progressColor = p.status === 'Accepted' ? '#22C55E' :
                        p.status === 'Stalled' ? '#FBBF24' :
                        p.status === 'Declined' ? '#EF4444' : '#4DB8CD';

    var tr = document.createElement('tr');
    tr.onclick = function(e){ if(!e.target.closest('.row-action')) openPartnerEdit(p.id); };
    tr.innerHTML =
      '<td class="font-medium text-white">' + p.name + '</td>' +
      '<td>' + p.company + '</td>' +
      '<td class="text-xs">' + p.type + '</td>' +
      '<td>' + tierBadge + '</td>' +
      '<td><span class="badge ' + statusClass + '">' + p.status + '</span></td>' +
      '<td><div class="flex items-center gap-2"><div class="w-20 h-1.5 rounded-full bg-white/5 overflow-hidden"><div style="width:' + p.progress + '%;height:100%;border-radius:9999px;background:' + progressColor + '"></div></div><span class="text-[10px] text-gray-500">' + p.progress + '%</span></div></td>' +
      '<td class="text-right"><button class="row-action" title="Edit" onclick="event.stopPropagation();openPartnerEdit(' + p.id + ')"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>' +
      '<button class="row-action delete" title="Delete" onclick="event.stopPropagation();deletePartner(' + p.id + ')"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button></td>';
    tbody.appendChild(tr);
  });
  document.getElementById('partner-count-label').textContent = 'Showing ' + list.length + ' partners';
  var sb = document.getElementById('sidebar-partners-count');
  if(sb) sb.textContent = partners.length;
}

/* ── Filter partner list ─────────── */
// Topbar search: auto-jump to Partners section so the user sees results
window.onGlobalSearch = function(){
  var q = (document.getElementById('global-search').value || '').trim();
  if(q.length > 0){
    var active = document.querySelector('.dash-section.active');
    if(!active || active.id !== 'sec-partners'){
      showSection('partners');
      // Re-focus the input since showSection may blur it on some layouts
      var el = document.getElementById('global-search');
      if(el){ el.focus(); try{ el.setSelectionRange(q.length, q.length); }catch(e){} }
    }
  }
  filterPartnerList();
};

window.filterPartnerList = function(){
  var search = (document.getElementById('global-search').value || '').toLowerCase();
  var tier = document.getElementById('filter-tier') ? document.getElementById('filter-tier').value : '';
  var type = document.getElementById('filter-type') ? document.getElementById('filter-type').value : '';
  var status = document.getElementById('filter-status') ? document.getElementById('filter-status').value : '';

  var filtered = partners.filter(function(p){
    var matchSearch = !search || p.name.toLowerCase().indexOf(search) !== -1 || p.company.toLowerCase().indexOf(search) !== -1;
    var matchTier = !tier || p.tier === tier;
    var matchType = !type || p.type === type;
    var matchStatus = !status || p.status === status;
    return matchSearch && matchTier && matchType && matchStatus;
  });
  renderPartnerTable(filtered);
};

/* ── Open partner edit panel ─────── */
window.openPartnerEdit = function(id){
  var p = partners.find(function(x){return x.id === id});
  if(!p) return;
  currentEditId = id;

  document.getElementById('partners-list-view').style.display = 'none';
  var panel = document.getElementById('partner-edit-panel');
  panel.classList.add('active');

  // Populate fields
  var initials = p.name.split(' ').map(function(w){return w[0]}).join('').substring(0,2);
  document.getElementById('edit-avatar').textContent = initials;
  document.getElementById('edit-name').textContent = p.name;
  document.getElementById('edit-company').textContent = p.company;
  document.getElementById('edit-fullname').value = p.name;
  document.getElementById('edit-email').value = p.email;
  document.getElementById('edit-phone').value = p.phone;
  document.getElementById('edit-country').value = p.country;
  document.getElementById('edit-company-name').value = p.company;
  document.getElementById('edit-website').value = p.website || '';
  document.getElementById('edit-region').value = p.region || '';
  document.getElementById('edit-notes').value = p.notes || '';

  // Selects
  setSelectValue('edit-ptype', p.type);
  setSelectValue('edit-ptier', p.tier);
  setSelectValue('edit-industry', p.industry);
  setSelectValue('edit-compsize', p.size);

  // Status
  updateStatusBadge(p.status);
  updateTierBadgeDisplay(p.tier);

  // Progress bar
  var pBar = document.getElementById('edit-progress-bar');
  pBar.style.width = p.progress + '%';
  document.getElementById('edit-progress-pct').textContent = p.progress + '%';
  pBar.className = 'progress-fill ' + (p.status === 'Accepted' ? 'accepted' : p.status === 'Declined' ? 'declined' : p.status === 'Stalled' ? 'stalled' : 'in-progress');

  // Type badge
  document.getElementById('edit-type-badge').textContent = p.type;

  // Load this partner's leads / reports / chat threads
  if(typeof loadPartnerActivity === 'function') loadPartnerActivity(id);
};

function setSelectValue(selectId, value){
  var sel = document.getElementById(selectId);
  for(var i=0;i<sel.options.length;i++){
    if(sel.options[i].value === value || sel.options[i].text === value){
      sel.selectedIndex = i; break;
    }
  }
}

function updateStatusBadge(status){
  var badge = document.getElementById('edit-status-badge');
  badge.textContent = status;
  badge.className = 'badge ' + (status === 'Accepted' ? 'badge-accepted' : status === 'Declined' ? 'badge-declined' : status === 'Stalled' ? 'badge-stalled' : 'badge-pending');
}

function updateTierBadgeDisplay(tier){
  var badge = document.getElementById('edit-tier-badge');
  if(tier === 'Gold'){
    badge.className = 'tier-badge-gold';
    badge.innerHTML = '🏆 Gold';
  } else if(tier === 'Silver'){
    badge.className = 'tier-badge-silver';
    badge.innerHTML = '🥈 Silver';
  } else {
    badge.className = 'tier-badge-bronze';
    badge.innerHTML = '🥉 Bronze';
  }
}

window.updateTierPreview = function(){
  var val = document.getElementById('edit-ptier').value;
  updateTierBadgeDisplay(val);
};

/* ── Close partner edit ──────────── */
window.closePartnerEdit = function(){
  document.getElementById('partner-edit-panel').classList.remove('active');
  document.getElementById('partners-list-view').style.display = '';
  currentEditId = null;
};

/* ── Set partner status (API) ──────── */
window.setPartnerStatus = function(status){
  if(!currentEditId) return;
  fetch('/api/partner-status.php', {
    method: 'PUT',
    credentials: 'same-origin',
    headers: {'Content-Type':'application/json'},
    body: JSON.stringify({id: currentEditId, status: status})
  })
  .then(function(r){ return r.json(); })
  .then(function(data){
    if(data.success){
      var p = partners.find(function(x){return x.id == currentEditId});
      if(p){ p.status = data.status; p.progress = data.progress; }
      updateStatusBadge(data.status);
      var pBar = document.getElementById('edit-progress-bar');
      pBar.style.width = data.progress + '%';
      document.getElementById('edit-progress-pct').textContent = data.progress + '%';
      pBar.className = 'progress-fill ' + (data.status === 'Accepted' ? 'accepted' : data.status === 'Declined' ? 'declined' : 'stalled');
      filterPartnerList();
      if(data.login && data.login.email && data.login.password){
        var emailLine = data.email_sent
          ? '\n\n📧 A welcome email with these credentials has been sent to the partner.'
          : '\n\n⚠️ Email delivery failed' + (data.email_error ? ' (' + data.email_error + ')' : '') + '. Please share the credentials manually.';
        alert(
          'Partner accepted.\n\n' +
          'A login was just provisioned:\n' +
          'Email: ' + data.login.email + '\n' +
          'Temporary password: ' + data.login.password +
          emailLine
        );
      }
    }
  })
  .catch(function(err){ alert('Error updating status'); });
};

/* ── Save partner changes (API) ───── */
window.savePartner = function(ev){
  if(!currentEditId) return;
  // Capture the button BEFORE the async call (event is not reliable inside .then)
  var btn = (ev && ev.currentTarget) || (ev && ev.target) ||
            document.querySelector('#partner-edit-panel .btn-p');
  var p = partners.find(function(x){return x.id == currentEditId});
  var payload = {
    id: currentEditId,
    name: document.getElementById('edit-fullname').value,
    email: document.getElementById('edit-email').value,
    phone: document.getElementById('edit-phone').value,
    country: document.getElementById('edit-country').value,
    company: document.getElementById('edit-company-name').value,
    type: document.getElementById('edit-ptype').value,
    tier: document.getElementById('edit-ptier').value,
    industry: document.getElementById('edit-industry').value,
    company_size: document.getElementById('edit-compsize').value,
    website: document.getElementById('edit-website').value,
    region: document.getElementById('edit-region').value,
    admin_notes: document.getElementById('edit-notes').value,
    status: p ? p.status : 'Pending',
    progress: p ? p.progress : 0
  };
  fetch('/api/partners.php', {
    method: 'PUT',
    credentials: 'same-origin',
    headers: {'Content-Type':'application/json'},
    body: JSON.stringify(payload)
  })
  .then(function(r){ return r.json().catch(function(){ return {error:'Server did not return JSON'}; }); })
  .then(function(data){
    if(data && data.success){
      // Update local cache
      if(p){
        p.name=payload.name; p.email=payload.email; p.phone=payload.phone;
        p.country=payload.country; p.company=payload.company; p.type=payload.type;
        p.tier=payload.tier; p.industry=payload.industry; p.size=payload.company_size;
        p.website=payload.website; p.region=payload.region; p.notes=payload.admin_notes;
      }
      document.getElementById('edit-name').textContent = payload.name;
      document.getElementById('edit-company').textContent = payload.company;
      var initials = payload.name.split(' ').map(function(w){return w[0]||''}).join('').substring(0,2).toUpperCase();
      document.getElementById('edit-avatar').textContent = initials;
      if(btn){
        btn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Saved!';
        btn.style.background = 'linear-gradient(135deg,#22C55E,#4ADE80)';
        setTimeout(function(){
          btn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Save Changes';
          btn.style.background = '';
        }, 1500);
      }
      filterPartnerList();
    } else {
      alert('Error saving: ' + ((data && data.error) || 'Unknown'));
    }
  })
  .catch(function(err){
    console.error('savePartner failed', err);
    alert('Network error saving partner: ' + (err && err.message || err));
  });
};

/* ── Delete partner (API) ─────────── */
window.deletePartner = function(id){
  if(!confirm('Are you sure you want to delete this partner?')) return;
  fetch('/api/partners.php', {
    method: 'DELETE',
    credentials: 'same-origin',
    headers: {'Content-Type':'application/json'},
    body: JSON.stringify({id: id})
  })
  .then(function(r){ return r.json(); })
  .then(function(data){
    if(data.success){
      partners = partners.filter(function(p){return p.id != id});
      filterPartnerList();
    } else { alert('Error deleting partner'); }
  })
  .catch(function(err){ alert('Network error'); });
};

/* ══════════════════════════════════════════════
   LIVE DATA — dashboard stats, activity, apps
   ══════════════════════════════════════════════ */
var dashStats = null;
var tierDonut = null, typeBar = null, timelineBar = null;
var typeAcceptChart = null, tierGrowthChart = null;

function esc(s){ return String(s==null?'':s).replace(/[&<>"']/g,function(c){return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[c]}); }

function loadOverviewStats(){
  return fetch('/api/dashboard.php', {credentials:'same-origin'})
    .then(function(r){ return r.json(); })
    .then(function(data){
      if(!data || data.error) return;
      dashStats = data;
      renderStatCards(data);
      renderHeatmap(data);
      renderRings(data);
      renderTypeLegends(data);
      renderCharts(data);
    })
    .catch(function(err){ console.error('stats load failed', err); });
}

function renderStatCards(d){
  var t = d.totals || {};
  var total = t.total||0, acc = t.accepted||0, decl = t.declined||0;
  var pendStall = (t.pending||0) + (t.stalled||0);
  setText('stat-total', total);
  setText('stat-accepted', acc);
  setText('stat-pending', pendStall);
  setText('stat-declined', decl);
  setText('stat-total-sub', total>0 ? ('Across ' + total + ' records') : 'No partners yet');
  setText('stat-accepted-sub', (total? (Math.round((acc/total)*1000)/10):0) + '% acceptance rate');
  setText('stat-pending-sub', (t.pending||0) + ' awaiting review');
  setText('stat-declined-sub', (total? (Math.round((decl/total)*1000)/10):0) + '% decline rate');
  setText('donut-center-total', total);
  setText('sidebar-partners-count', total);
  setText('sidebar-apps-count', d.pendingApps || 0);
  setText('legend-bronze', (d.byTier && d.byTier.Bronze) || 0);
  setText('legend-silver', (d.byTier && d.byTier.Silver) || 0);
  setText('legend-gold',   (d.byTier && d.byTier.Gold)   || 0);
}

function renderTypeLegends(d){
  var bt = d.byType || {};
  setText('type-banking', bt['Banking Decision Maker'] || 0);
  setText('type-it',      bt['IT Manager'] || 0);
  setText('type-local',   bt['Local Integrator'] || 0);
}

function renderHeatmap(d){
  var h = d.heatmap || {};
  var statuses = ['Accepted','Stalled','Declined','Pending'];
  var typeMap = {'Banking':'Banking Decision Maker','IT':'IT Manager','Local':'Local Integrator'};
  statuses.forEach(function(s){
    Object.keys(typeMap).forEach(function(k){
      var cell = document.getElementById('heat-'+s+'-'+k);
      if(!cell) return;
      var v = (h[s] && h[s][typeMap[k]]) || 0;
      cell.textContent = v;
    });
  });
  // Summary: find type with highest accepted rate among partner totals of that type
  var accByType = h.Accepted || {};
  var byType = d.byType || {};
  var bestLabel = '—', bestRate = 0;
  Object.keys(byType).forEach(function(t){
    var r = byType[t]>0 ? (accByType[t]||0) / byType[t] * 100 : 0;
    if(r > bestRate){ bestRate = r; bestLabel = t; }
  });
  setText('heat-summary-label','Highest acceptance: ' + bestLabel);
  setText('heat-summary-rate', Math.round(bestRate) + '%');
}

function renderRings(d){
  var ta = d.tierAcceptance || {};
  ['Bronze','Silver','Gold'].forEach(function(tier){
    var row = ta[tier] || {total:0,accepted:0,rate:0};
    var pct = row.rate || 0;
    var k = tier.toLowerCase();
    setText('ring-'+k+'-pct', pct + '%');
    setText('ring-'+k+'-ratio', (row.accepted||0) + ' of ' + (row.total||0));
    var fill = document.getElementById('ring-'+k+'-fill');
    if(fill){
      var circumference = 263.9;
      fill.setAttribute('stroke-dashoffset', circumference * (1 - pct/100));
    }
  });
}

function setText(id, v){ var el = document.getElementById(id); if(el) el.textContent = v; }

function renderCharts(d){
  var bt = d.byTier || {};
  var bType = d.byType || {};
  var h = d.heatmap || {};

  // Tier Donut
  var donutData = [bt.Bronze||0, bt.Silver||0, bt.Gold||0];
  if(tierDonut){ tierDonut.data.datasets[0].data = donutData; tierDonut.update(); }
  else {
    tierDonut = new Chart(document.getElementById('chart-tier-donut'),{
      type:'doughnut',
      data:{labels:['Bronze','Silver','Gold'],datasets:[{data:donutData,backgroundColor:['#CD7F32','#C0C0C0','#FFD700'],borderWidth:0,hoverOffset:8}]},
      options:{responsive:true,maintainAspectRatio:false,cutout:'72%',plugins:{legend:{display:false}},animation:{animateRotate:true,duration:1000}}
    });
  }

  // Type Bar
  var typeData = [bType['Banking Decision Maker']||0, bType['IT Manager']||0, bType['Local Integrator']||0];
  if(typeBar){ typeBar.data.datasets[0].data = typeData; typeBar.update(); }
  else {
    typeBar = new Chart(document.getElementById('chart-type-bar'),{
      type:'bar',
      data:{labels:['Banking DM','IT Manager','Local Integ.'],datasets:[{data:typeData,backgroundColor:['rgba(77,184,205,0.6)','rgba(118,108,255,0.6)','rgba(249,115,22,0.6)'],borderRadius:8,borderSkipped:false}]},
      options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{x:{grid:{color:'rgba(255,255,255,0.03)'},ticks:{color:'#64748B',font:{size:10}}},y:{grid:{color:'rgba(255,255,255,0.03)'},ticks:{color:'#64748B',font:{size:10},stepSize:1}}}}
    });
  }

  // Timeline (status totals as single-bucket bars)
  var tl = d.totals || {};
  if(timelineBar){
    timelineBar.data.datasets[0].data = [tl.accepted||0];
    timelineBar.data.datasets[1].data = [tl.stalled||0];
    timelineBar.data.datasets[2].data = [tl.declined||0];
    timelineBar.update();
  } else {
    timelineBar = new Chart(document.getElementById('chart-timeline'),{
      type:'bar',
      data:{labels:['Current'],datasets:[
        {label:'Accepted',data:[tl.accepted||0],backgroundColor:'rgba(34,197,94,0.7)',borderRadius:4,borderSkipped:false},
        {label:'Stalled',data:[tl.stalled||0],backgroundColor:'rgba(251,191,36,0.6)',borderRadius:4,borderSkipped:false},
        {label:'Declined',data:[tl.declined||0],backgroundColor:'rgba(239,68,68,0.5)',borderRadius:4,borderSkipped:false}
      ]},
      options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{x:{stacked:true,grid:{color:'rgba(255,255,255,0.03)'},ticks:{color:'#64748B',font:{size:10}}},y:{stacked:true,grid:{color:'rgba(255,255,255,0.03)'},ticks:{color:'#64748B',font:{size:10},stepSize:1}}}}
    });
  }

  // Analytics charts
  var labels = ['Banking DM','IT Manager','Local Integ.'];
  var tKeys = ['Banking Decision Maker','IT Manager','Local Integrator'];
  var accArr = tKeys.map(function(k){return (h.Accepted&&h.Accepted[k])||0});
  var staArr = tKeys.map(function(k){return (h.Stalled&&h.Stalled[k])||0});
  var decArr = tKeys.map(function(k){return (h.Declined&&h.Declined[k])||0});

  if(typeAcceptChart){
    typeAcceptChart.data.datasets[0].data = accArr;
    typeAcceptChart.data.datasets[1].data = staArr;
    typeAcceptChart.data.datasets[2].data = decArr;
    typeAcceptChart.update();
  } else if(document.getElementById('chart-type-acceptance')) {
    typeAcceptChart = new Chart(document.getElementById('chart-type-acceptance'),{
      type:'bar',
      data:{labels:labels,datasets:[
        {label:'Accepted',data:accArr,backgroundColor:'rgba(34,197,94,0.6)',borderRadius:6,borderSkipped:false},
        {label:'Stalled', data:staArr,backgroundColor:'rgba(251,191,36,0.5)',borderRadius:6,borderSkipped:false},
        {label:'Declined',data:decArr,backgroundColor:'rgba(239,68,68,0.4)',borderRadius:6,borderSkipped:false}
      ]},
      options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{position:'top',labels:{color:'#94A3B8',font:{size:10},usePointStyle:true,pointStyle:'circle'}}},scales:{x:{grid:{color:'rgba(255,255,255,0.03)'},ticks:{color:'#64748B',font:{size:10}}},y:{grid:{color:'rgba(255,255,255,0.03)'},ticks:{color:'#64748B',font:{size:10},stepSize:1}}}}
    });
  }

  // Tier growth: plot current totals per tier as a simple bar-as-line (no time-series DB).
  var tierLabels = ['Bronze','Silver','Gold'];
  var tierVals = tierLabels.map(function(k){return bt[k]||0});
  if(tierGrowthChart){
    tierGrowthChart.data.datasets[0].data = tierVals;
    tierGrowthChart.update();
  } else if(document.getElementById('chart-tier-growth')) {
    tierGrowthChart = new Chart(document.getElementById('chart-tier-growth'),{
      type:'bar',
      data:{labels:tierLabels,datasets:[{label:'Current partners',data:tierVals,backgroundColor:['#CD7F32','#C0C0C0','#FFD700'],borderRadius:8,borderSkipped:false}]},
      options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{x:{grid:{color:'rgba(255,255,255,0.03)'},ticks:{color:'#64748B',font:{size:10}}},y:{grid:{color:'rgba(255,255,255,0.03)'},ticks:{color:'#64748B',font:{size:10},stepSize:1}}}}
    });
  }

  // Analytics metric card
  setText('metric-accept-rate', (d.acceptanceRate||0) + '%');
  setText('metric-accept-sub', (d.totals.accepted||0) + ' of ' + (d.totals.total||0) + ' partners accepted');

  // Sparkline wraps (simple placeholder drawn once)
  drawSparklinesOnce();
}

var sparklinesDrawn = false;
function drawSparklinesOnce(){
  if(sparklinesDrawn) return;
  sparklinesDrawn = true;
  createSparkline('sparkline-partners',[2,4,6,8,10,13,(dashStats&&dashStats.totals.total)||0],'rgba(239,68,68,0.6)');
  createSparkline('sparkline-accepted',[1,2,3,5,7,9,(dashStats&&dashStats.totals.accepted)||0],'rgba(34,197,94,0.6)');
  createSparkline('sparkline-pending',[0,1,2,2,3,4,((dashStats&&dashStats.totals.pending)||0)+((dashStats&&dashStats.totals.stalled)||0)],'rgba(251,191,36,0.6)');
  createSparkline('sparkline-declined',[0,0,1,0,1,1,(dashStats&&dashStats.totals.declined)||0],'rgba(239,68,68,0.4)');
}

function createSparkline(containerId, data, color){
  var container = document.getElementById(containerId);
  if(!container) return;
  container.innerHTML = '';
  var max = Math.max.apply(null, data) || 1;
  data.forEach(function(val){
    var bar = document.createElement('div');
    bar.className = 'sparkline-bar';
    bar.style.height = ((val / max) * 100) + '%';
    bar.style.background = color;
    container.appendChild(bar);
  });
}

/* ══════════════════════════════════════════════
   ACTIVITY FEED
   ══════════════════════════════════════════════ */
function iconForAction(action){
  // returns {bg, border, iconBg, color, svg}
  var map = {
    'accept':        {bg:'rgba(34,197,94,0.04)',  border:'rgba(34,197,94,0.1)',  iconBg:'bg-green-500/10', color:'text-green-400',  svg:'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>'},
    'accept_partner':{bg:'rgba(34,197,94,0.04)',  border:'rgba(34,197,94,0.1)',  iconBg:'bg-green-500/10', color:'text-green-400',  svg:'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>'},
    'apply':         {bg:'rgba(77,184,205,0.04)', border:'rgba(77,184,205,0.1)', iconBg:'bg-pacific/10',   color:'text-pacific',    svg:'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>'},
    'review_app':    {bg:'rgba(77,184,205,0.04)', border:'rgba(77,184,205,0.1)', iconBg:'bg-pacific/10',   color:'text-pacific',    svg:'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>'},
    'stall':         {bg:'rgba(251,191,36,0.04)', border:'rgba(251,191,36,0.1)', iconBg:'bg-yellow-500/10',color:'text-yellow-400', svg:'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>'},
    'decline':       {bg:'rgba(239,68,68,0.04)',  border:'rgba(239,68,68,0.1)',  iconBg:'bg-red-500/10',   color:'text-red-400',    svg:'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>'},
    'login':         {bg:'rgba(118,108,255,0.04)',border:'rgba(118,108,255,0.1)',iconBg:'bg-aqua/10',      color:'text-aqua',       svg:'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>'},
    'default':       {bg:'rgba(148,163,184,0.04)',border:'rgba(148,163,184,0.1)',iconBg:'bg-white/5',      color:'text-gray-300',   svg:'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'}
  };
  return map[action] || map.default;
}

function loadActivityFeed(){
  var feed = document.getElementById('activity-feed');
  if(!feed) return;
  fetch('/api/activity.php?limit=12', {credentials:'same-origin'})
    .then(function(r){ return r.json(); })
    .then(function(items){
      if(!Array.isArray(items) || items.length===0){
        feed.innerHTML = '<p class="text-xs text-gray-500 text-center py-6">No recent activity.</p>';
        return;
      }
      feed.innerHTML = items.map(function(a){
        var ic = iconForAction(a.action);
        var who = a.user_name ? ('<strong>' + esc(a.user_name) + '</strong> · ') : '';
        return '<div class="flex items-center gap-3 p-3 rounded-xl" style="background:'+ic.bg+';border:1px solid '+ic.border+'">'+
          '<div class="w-8 h-8 rounded-full '+ic.iconBg+' flex items-center justify-center flex-shrink-0">'+
            '<svg class="w-4 h-4 '+ic.color+'" fill="none" stroke="currentColor" viewBox="0 0 24 24">'+ic.svg+'</svg>'+
          '</div>'+
          '<div class="flex-1 min-w-0">'+
            '<p class="text-xs text-white font-medium">'+esc(a.description||a.action)+'</p>'+
            '<p class="text-[10px] text-gray-500">'+who+esc(a.relative||'')+'</p>'+
          '</div>'+
        '</div>';
      }).join('');
    })
    .catch(function(){ feed.innerHTML = '<p class="text-xs text-red-400 text-center py-6">Failed to load activity.</p>'; });
}

/* ══════════════════════════════════════════════
   APPLICATIONS
   ══════════════════════════════════════════════ */
function tierFromSize(size){
  if(size === '1000+' || size === '500-1000' || size === '501-1000') return 'Gold';
  if(size === '100-500' || size === '51-500' || size === '201-500') return 'Silver';
  return 'Bronze';
}
function initialsFrom(name){
  if(!name) return '?';
  var parts = name.trim().split(/\s+/);
  return ((parts[0]||'')[0] || '') + ((parts[1]||'')[0] || '');
}

function loadApplications(){
  var wrap = document.getElementById('apps-container');
  if(!wrap) return;
  var status = document.getElementById('apps-filter').value;
  var url = '/api/applications.php' + (status ? ('?status=' + encodeURIComponent(status)) : '');
  wrap.innerHTML = '<p class="text-xs text-gray-500 text-center py-8">Loading applications…</p>';
  fetch(url, {credentials:'same-origin'})
    .then(function(r){ return r.json(); })
    .then(function(list){
      if(!Array.isArray(list) || list.length===0){
        wrap.innerHTML = '<p class="text-xs text-gray-500 text-center py-10">No applications match this filter.</p>';
        return;
      }
      wrap.innerHTML = list.map(function(a){
        // Prefer the tier the applicant requested on the form; fall back to size heuristic
        var tier = a.requested_tier || tierFromSize(a.company_size);
        var tierBadge = tier==='Gold' ? '<span class="tier-badge-gold">🏆 Gold</span>' :
                        tier==='Silver' ? '<span class="tier-badge-silver">🥈 Silver</span>' :
                        '<span class="tier-badge-bronze">🥉 Bronze</span>';
        if(a.requested_tier) tierBadge += ' <span class="text-[9px] text-gray-500 uppercase tracking-wider ml-1">requested</span>';
        var statusClass = a.status==='Approved' ? 'badge-accepted' :
                          a.status==='Rejected' ? 'badge-declined' :
                          a.status==='Reviewed' ? 'badge-stalled' : 'badge-pending';
        var buttons = a.status === 'Pending' || a.status === 'Reviewed'
          ? '<button class="btn-accept" onclick="setApplicationStatus('+a.id+',\'Approved\')">Accept</button>'+
            (a.status==='Pending' ? '<button class="btn-stall" onclick="setApplicationStatus('+a.id+',\'Reviewed\')">Stall</button>' : '')+
            '<button class="btn-decline" onclick="setApplicationStatus('+a.id+',\'Rejected\')">Decline</button>'
          : '<span class="text-[10px] text-gray-500">Processed</span>';
        return '<div class="stat-card flex flex-wrap items-center justify-between gap-4" data-app-id="'+a.id+'">'+
          '<div class="flex items-center gap-4">'+
            '<div class="w-11 h-11 rounded-xl bg-pacific/10 flex items-center justify-center text-sm font-bold text-pacific">'+esc(initialsFrom(a.contact_name).toUpperCase())+'</div>'+
            '<div>'+
              '<p class="font-semibold text-sm">'+esc(a.contact_name)+'</p>'+
              '<p class="text-xs text-gray-500">'+esc(a.company_name)+' · '+esc(a.partner_type||'—')+'</p>'+
              '<p class="text-[10px] text-gray-600 mt-0.5">'+esc(a.contact_email)+(a.country?(' · '+esc(a.country)):'')+'</p>'+
            '</div>'+
          '</div>'+
          '<div class="flex items-center gap-2">'+tierBadge+'<span class="badge '+statusClass+'">'+esc(a.status)+'</span></div>'+
          '<div class="flex gap-2">'+buttons+'</div>'+
        '</div>';
      }).join('');
    })
    .catch(function(){ wrap.innerHTML = '<p class="text-xs text-red-400 text-center py-8">Failed to load applications.</p>'; });
}
window.loadApplications = loadApplications;

window.setLeadStatus = function(leadId, status, partnerId){
  fetch('/api/leads.php', {
    method:'PUT',
    credentials:'same-origin',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify({id: leadId, status: status})
  })
  .then(function(r){ return r.json(); })
  .then(function(res){
    if(res && res.success){
      // Reload this partner's activity panel + global stats/activity feed
      if(typeof loadPartnerActivity === 'function' && partnerId){
        paLoadedFor = null; // force re-render
        loadPartnerActivity(partnerId);
      }
      if(typeof loadActivityFeed === 'function') loadActivityFeed();
      if(typeof loadOverviewStats === 'function') loadOverviewStats();
    } else {
      alert('Error: ' + (res && res.error || 'Update failed'));
    }
  })
  .catch(function(){ alert('Network error'); });
};

window.setApplicationStatus = function(id, status){
  fetch('/api/applications.php', {
    method:'PUT',
    credentials:'same-origin',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify({id:id, status:status})
  })
  .then(function(r){ return r.json(); })
  .then(function(res){
    if(res && res.success){
      // If the approval just provisioned a partner login, show it so the admin
      // can share the credentials with the new partner.
      if(res.login && res.login.email && res.login.password){
        var emailLine = res.email_sent
          ? '\n\n📧 A welcome email with these credentials has been sent to the partner.'
          : '\n\n⚠️ Email delivery failed' + (res.email_error ? ' (' + res.email_error + ')' : '') + '. Please share the credentials manually.';
        alert(
          'Application approved.\n\n' +
          'A new partner account was created:\n' +
          'Email: ' + res.login.email + '\n' +
          'Temporary password: ' + res.login.password +
          emailLine
        );
      }
      loadApplications();
      loadActivityFeed();
      loadOverviewStats();
      if(typeof loadPartners === 'function') loadPartners(function(){
        if(typeof renderPartnerTable === 'function') renderPartnerTable(partners);
      });
    } else {
      alert('Error: ' + (res && res.error || 'Update failed'));
    }
  })
  .catch(function(){ alert('Network error'); });
};

/* ══════════════════════════════════════════════
   CHART INIT STUBS (wired above via renderCharts)
   ══════════════════════════════════════════════ */
function initOverviewCharts(){ if(!dashStats) loadOverviewStats(); }
function initAnalyticsCharts(){ if(!dashStats) loadOverviewStats(); }

/* ══════════════════════════════════════════════
   INIT
   ══════════════════════════════════════════════ */
loadPartners(function(){ renderPartnerTable(partners); });
loadOverviewStats();
loadActivityFeed();
loadApplications();
loadAllReports();

// Poll every 45s for live admin view
setInterval(function(){
  loadOverviewStats();
  loadActivityFeed();
}, 45000);

// Refresh stats + activity after partner status change
var _origSetStatus = window.setPartnerStatus;
window.setPartnerStatus = function(status){
  _origSetStatus(status);
  setTimeout(function(){
    loadOverviewStats();
    loadActivityFeed();
    if(currentEditId) loadPartnerActivity(currentEditId);
  }, 600);
};

/* ══════════════════════════════════════════════
   GLOBAL REFRESH BUTTON
   ══════════════════════════════════════════════ */
window.refreshAdminDashboard = function(){
  var icon = document.getElementById('admin-refresh-icon');
  var btn  = document.getElementById('admin-refresh-btn');
  if(icon) icon.classList.add('adm-spinning');
  if(btn)  btn.disabled = true;

  // Fire everything; always release the spinner at the end
  try { loadOverviewStats(); } catch(e){}
  try { loadActivityFeed(); } catch(e){}
  try { loadPartners(function(){ renderPartnerTable(partners); if(typeof filterPartnerList==='function') filterPartnerList(); }); } catch(e){}
  try { if(typeof loadApplications==='function') loadApplications(); } catch(e){}
  try { if(typeof loadAllReports==='function') loadAllReports(); } catch(e){}
  try { loadAdminNotifications(); } catch(e){}
  if(currentEditId){ try { loadPartnerActivity(currentEditId); } catch(e){} }

  setTimeout(function(){
    if(icon) icon.classList.remove('adm-spinning');
    if(btn)  btn.disabled = false;
  }, 900);
};

/* ══════════════════════════════════════════════
   ALL REPORTS (admin global view)
   ══════════════════════════════════════════════ */
var allReports = [];

function loadAllReports(){
  var tbody = document.getElementById('reports-tbody');
  if(!tbody) return;
  tbody.innerHTML = '<tr><td colspan="8" class="text-center text-xs text-gray-500 py-6">Loading reports…</td></tr>';
  fetch('/api/reports.php?all=1', {credentials:'same-origin'})
    .then(function(r){ return r.json(); })
    .then(function(data){
      allReports = (data && data.reports) || [];
      setText('sidebar-reports-count', allReports.length);
      renderReports(allReports);
    })
    .catch(function(){
      tbody.innerHTML = '<tr><td colspan="8" class="text-center text-xs text-red-400 py-6">Failed to load.</td></tr>';
    });
}
window.loadAllReports = loadAllReports;

function renderReports(list){
  var tbody = document.getElementById('reports-tbody');
  if(!tbody) return;
  if(!list.length){
    tbody.innerHTML = '<tr><td colspan="8" class="text-center text-xs text-gray-500 py-10">No reports found.</td></tr>';
    return;
  }
  tbody.innerHTML = list.map(function(r){
    var tierBadge = r.partner_tier==='Gold' ? '<span class="tier-badge-gold">🏆</span>' :
                    r.partner_tier==='Silver' ? '<span class="tier-badge-silver">🥈</span>' :
                    r.partner_tier==='Bronze' ? '<span class="tier-badge-bronze">🥉</span>' : '';
    var sClass = r.status==='Reviewed' ? 'badge-accepted' : 'badge-processing';
    var pName = r.partner_name || ('Partner #' + (r.partner_id||'?'));
    var initials = (function(n){ var p=(n||'').trim().split(/\s+/); return ((p[0]||'')[0]||'').toUpperCase()+((p[1]||'')[0]||'').toUpperCase(); })(pName);
    return '<tr>'+
      '<td class="font-medium text-white">'+
        '<div class="flex items-center gap-2">'+
          '<div class="w-7 h-7 rounded-full bg-pacific/10 text-pacific text-[10px] font-bold flex items-center justify-center flex-shrink-0">'+esc(initials||'?')+'</div>'+
          '<div class="min-w-0">'+
            '<div class="truncate">'+tierBadge+' '+esc(pName)+'</div>'+
          '</div>'+
        '</div>'+
      '</td>'+
      '<td>'+esc(r.partner_company||'—')+'</td>'+
      '<td class="font-medium">'+esc(r.title||'')+'</td>'+
      '<td class="text-xs">'+esc(r.type||'')+'</td>'+
      '<td class="text-xs text-gray-400">'+esc(r.period||'—')+'</td>'+
      '<td class="text-xs text-gray-400">'+fmtDate(r.created_at)+'</td>'+
      '<td><span class="badge '+sClass+'">'+esc(r.status||'Sent')+'</span></td>'+
      '<td class="text-right"><button class="row-action" title="View" onclick="openReportModal('+r.id+')"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></button></td>'+
    '</tr>';
  }).join('');
}

window.filterReports = function(){
  var q = (document.getElementById('reports-search').value || '').toLowerCase();
  var t = document.getElementById('reports-type-filter').value;
  var filtered = allReports.filter(function(r){
    var matchQ = !q ||
      (r.partner_name||'').toLowerCase().indexOf(q) !== -1 ||
      (r.partner_company||'').toLowerCase().indexOf(q) !== -1 ||
      (r.title||'').toLowerCase().indexOf(q) !== -1 ||
      (r.content||'').toLowerCase().indexOf(q) !== -1;
    var matchT = !t || r.type === t;
    return matchQ && matchT;
  });
  renderReports(filtered);
};

window.openReportModal = function(id){
  var r = allReports.find(function(x){ return x.id == id; });
  if(!r) return;
  document.getElementById('rm-partner').textContent = (r.partner_name||'—') + ' · ' + (r.partner_company||'');
  document.getElementById('rm-title').textContent = r.title || '—';
  document.getElementById('rm-meta').textContent = (r.type||'') + (r.period?(' · '+r.period):'') + ' · Submitted ' + fmtDate(r.created_at);
  document.getElementById('rm-content').textContent = r.content || '(no content)';
  document.getElementById('report-detail-modal').style.display = 'flex';
};
window.closeReportModal = function(){
  document.getElementById('report-detail-modal').style.display = 'none';
};

/* ══════════════════════════════════════════════
   PARTNER ACTIVITY PANEL (inside edit view)
   ══════════════════════════════════════════════ */
var paLoadedFor = null;

window.switchPaTab = function(tab){
  document.querySelectorAll('.pa-tab').forEach(function(t){
    t.classList.toggle('active', t.getAttribute('data-pa') === tab);
  });
  ['leads','reports','threads'].forEach(function(k){
    var el = document.getElementById('pa-panel-'+k);
    if(el) el.style.display = (k === tab) ? '' : 'none';
  });
};

function fmtDate(s){ if(!s) return '—'; try { return new Date(s.replace(' ','T')).toLocaleDateString(); } catch(e){ return s; } }

window.loadPartnerActivity = function(partnerId){
  if(!partnerId) return;
  paLoadedFor = partnerId;
  var leadsEl = document.getElementById('pa-panel-leads');
  var reportsEl = document.getElementById('pa-panel-reports');
  var threadsEl = document.getElementById('pa-panel-threads');
  if(leadsEl) leadsEl.innerHTML = '<p class="text-xs text-gray-500 text-center py-4">Loading leads…</p>';
  if(reportsEl) reportsEl.innerHTML = '<p class="text-xs text-gray-500 text-center py-4">Loading reports…</p>';
  if(threadsEl) threadsEl.innerHTML = '<p class="text-xs text-gray-500 text-center py-4">Loading chat threads…</p>';

  // Leads
  fetch('/api/leads.php?partner_id='+partnerId, {credentials:'same-origin'})
    .then(function(r){return r.json()})
    .then(function(data){
      if(paLoadedFor !== partnerId) return;
      var list = (data && data.leads) || [];
      setText('pa-leads-count', list.length);
      var approved = list.filter(function(l){return l.status==='Approved'}).length;
      setText('pa-leads-approved', approved);
      if(!list.length){ leadsEl.innerHTML = '<p class="text-xs text-gray-500 text-center py-4">No leads submitted.</p>'; return; }
      leadsEl.innerHTML = list.map(function(l){
        var statusClass = l.status==='Approved' ? 'badge-accepted' :
                          l.status==='Rejected' ? 'badge-declined' : 'badge-pending';
        var contact = esc((l.contact_first_name||'') + ' ' + (l.contact_last_name||'')).trim();
        var actions = '';
        if(l.status !== 'Approved'){
          actions += '<button class="text-[10px] font-semibold px-2 py-1 rounded bg-green-500/15 text-green-400 hover:bg-green-500/25 transition-colors" onclick="setLeadStatus('+l.id+',\'Approved\','+partnerId+')">Approve</button>';
        }
        if(l.status !== 'Rejected'){
          actions += '<button class="text-[10px] font-semibold px-2 py-1 rounded bg-red-500/15 text-red-400 hover:bg-red-500/25 transition-colors" onclick="setLeadStatus('+l.id+',\'Rejected\','+partnerId+')">Reject</button>';
        }
        if(l.status !== 'Pending'){
          actions += '<button class="text-[10px] font-semibold px-2 py-1 rounded bg-white/5 text-gray-400 hover:bg-white/10 transition-colors" onclick="setLeadStatus('+l.id+',\'Pending\','+partnerId+')">Reset</button>';
        }
        return '<div class="pa-row" style="flex-wrap:wrap;gap:8px">'+
          '<div class="min-w-0 flex-1">'+
            '<p class="text-xs font-semibold text-white truncate">'+esc(l.company_name)+'</p>'+
            '<p class="text-[10px] text-gray-500 truncate">'+contact+' · '+esc(l.contact_email||'')+'</p>'+
            '<p class="text-[10px] text-gray-600 mt-0.5">'+fmtDate(l.created_at)+(l.project_types?(' · '+esc(l.project_types)):'')+'</p>'+
          '</div>'+
          '<span class="badge '+statusClass+'" style="flex-shrink:0">'+esc(l.status)+'</span>'+
          '<div class="flex gap-1 w-full justify-end" style="margin-top:4px">'+actions+'</div>'+
        '</div>';
      }).join('');
    })
    .catch(function(){ if(leadsEl) leadsEl.innerHTML = '<p class="text-xs text-red-400 text-center py-4">Failed to load leads.</p>'; });

  // Reports
  fetch('/api/reports.php?partner_id='+partnerId, {credentials:'same-origin'})
    .then(function(r){return r.json()})
    .then(function(data){
      if(paLoadedFor !== partnerId) return;
      var list = (data && data.reports) || [];
      setText('pa-reports-count', list.length);
      if(!list.length){ reportsEl.innerHTML = '<p class="text-xs text-gray-500 text-center py-4">No reports submitted.</p>'; return; }
      reportsEl.innerHTML = list.map(function(rep){
        return '<div class="pa-row">'+
          '<div class="min-w-0 flex-1">'+
            '<p class="text-xs font-semibold text-white truncate">'+esc(rep.title)+'</p>'+
            '<p class="text-[10px] text-gray-500">'+esc(rep.type||'')+(rep.period?(' · '+esc(rep.period)):'')+' · '+fmtDate(rep.created_at)+'</p>'+
          '</div>'+
          '<span class="badge badge-accepted" style="flex-shrink:0">'+esc(rep.status||'Sent')+'</span>'+
        '</div>';
      }).join('');
    })
    .catch(function(){ if(reportsEl) reportsEl.innerHTML = '<p class="text-xs text-red-400 text-center py-4">Failed to load reports.</p>'; });

  // Threads
  fetch('/api/messages.php?partner_id='+partnerId+'&action=threads', {credentials:'same-origin'})
    .then(function(r){return r.json()})
    .then(function(data){
      if(paLoadedFor !== partnerId) return;
      var list = (data && data.threads) || [];
      var activeThreads = list.filter(function(t){return (t.message_count||0)>0});
      setText('pa-threads-count', activeThreads.length);
      if(!list.length){ threadsEl.innerHTML = '<p class="text-xs text-gray-500 text-center py-4">No chat threads yet.</p>'; return; }
      threadsEl.innerHTML = list.map(function(t){
        var contact = esc((t.contact_first_name||'') + ' ' + (t.contact_last_name||'')).trim() || esc(t.company_name);
        var preview = t.last_body ? esc(String(t.last_body).substring(0,90)) : '<em class="text-gray-600">No messages yet</em>';
        var who = t.last_sender === 'lead' ? '<span class="text-pacific">lead</span>' :
                  t.last_sender === 'partner' ? '<span class="text-aqua">partner</span>' : '';
        return '<div class="pa-row">'+
          '<div class="min-w-0 flex-1">'+
            '<p class="text-xs font-semibold text-white truncate">'+esc(t.company_name)+' · '+contact+'</p>'+
            '<p class="text-[10px] text-gray-400 truncate">'+(who?who+': ':'')+preview+'</p>'+
            '<p class="text-[10px] text-gray-600">'+(t.message_count||0)+' message(s)'+(t.last_at?' · '+fmtDate(t.last_at):'')+'</p>'+
          '</div>'+
        '</div>';
      }).join('');
    })
    .catch(function(){ if(threadsEl) threadsEl.innerHTML = '<p class="text-xs text-red-400 text-center py-4">Failed to load threads.</p>'; });
};

/* ══════════════════════════════════════════════
   ADMIN NOTIFICATIONS
   ══════════════════════════════════════════════ */
function notifIconStyle(type){
  var map = {
    'application': {bg:'rgba(77,184,205,0.12)',  color:'#4DB8CD', svg:'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>'},
    'partner':     {bg:'rgba(118,108,255,0.12)', color:'#766CFF', svg:'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>'},
    'lead':        {bg:'rgba(34,197,94,0.12)',   color:'#22C55E', svg:'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>'},
    'report':      {bg:'rgba(251,191,36,0.12)',  color:'#FBBF24', svg:'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h4m-4-4V5a1 1 0 00-1-1H5a1 1 0 00-1 1v14a1 1 0 001 1h14a1 1 0 001-1v-6"/>'},
    'message':     {bg:'rgba(77,184,205,0.12)',  color:'#4DB8CD', svg:'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>'},
    'success':     {bg:'rgba(34,197,94,0.12)',   color:'#22C55E', svg:'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>'},
    'warning':     {bg:'rgba(239,68,68,0.12)',   color:'#EF4444', svg:'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>'},
    'info':        {bg:'rgba(148,163,184,0.12)', color:'#94A3B8', svg:'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'}
  };
  return map[type] || map.info;
}

function relTime(iso){
  if(!iso) return '';
  try {
    var d = new Date(iso.replace(' ','T'));
    var diff = (Date.now() - d.getTime())/1000;
    if(diff < 60) return 'just now';
    if(diff < 3600) return Math.floor(diff/60)+' min ago';
    if(diff < 86400) return Math.floor(diff/3600)+' h ago';
    if(diff < 604800) return Math.floor(diff/86400)+' d ago';
    return d.toLocaleDateString();
  } catch(e){ return ''; }
}

window.toggleAdminNotif = function(ev){
  if(ev) ev.stopPropagation();
  var dd = document.getElementById('anotif-dropdown');
  if(!dd) return;
  dd.classList.toggle('open');
  if(dd.classList.contains('open')) loadAdminNotifications();
};

function loadAdminNotifications(){
  var list = document.getElementById('anotif-list');
  var countEl = document.getElementById('anotif-count');
  fetch('/api/notifications.php', {credentials:'same-origin'})
    .then(function(r){ return r.json(); })
    .then(function(data){
      var items = (data && data.notifications) || [];
      var unread = (data && data.unread) || 0;
      if(countEl){
        if(unread > 0){ countEl.textContent = unread > 99 ? '99+' : unread; countEl.style.display = 'flex'; }
        else { countEl.style.display = 'none'; }
      }
      if(!items.length){
        list.innerHTML = '<p class="text-xs text-gray-500 text-center py-8">No notifications yet.</p>';
        return;
      }
      list.innerHTML = items.map(function(n){
        var s = notifIconStyle(n.type || 'info');
        return '<div class="anotif-item '+(parseInt(n.is_read)?'':'unread')+'" data-id="'+n.id+'" data-link="'+esc(n.link||'')+'" onclick="handleAdminNotifClick('+n.id+', this)">'+
          '<div class="anotif-icon" style="background:'+s.bg+'"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:'+s.color+'">'+s.svg+'</svg></div>'+
          '<div class="anotif-body">'+
            '<div class="anotif-title">'+esc(n.title||'')+'</div>'+
            (n.body ? '<div class="anotif-sub">'+esc(n.body)+'</div>' : '')+
            '<div class="anotif-time">'+relTime(n.created_at)+'</div>'+
          '</div>'+
        '</div>';
      }).join('');
    })
    .catch(function(){
      list.innerHTML = '<p class="text-xs text-red-400 text-center py-8">Failed to load.</p>';
    });
}

window.handleAdminNotifClick = function(id, el){
  // mark this one as read
  fetch('/api/notifications.php', {
    method:'POST', credentials:'same-origin',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify({action:'mark_read', id:id})
  }).then(function(){ loadAdminNotifications(); });

  var link = el && el.getAttribute('data-link');
  if(link){
    var map = {'#applications':'applications','#partners':'partners','#reports':'partners','#profile':'partners','#leads':'partners','#chat':'partners'};
    var sec = map[link];
    if(sec){ showSection(sec); }
  }
  document.getElementById('anotif-dropdown').classList.remove('open');
};

window.markAllAdminNotifRead = function(){
  fetch('/api/notifications.php', {
    method:'POST', credentials:'same-origin',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify({action:'mark_read'})
  }).then(function(){ loadAdminNotifications(); });
};

// Close dropdown on outside click
document.addEventListener('click', function(e){
  var wrap = document.getElementById('anotif-wrap');
  var dd = document.getElementById('anotif-dropdown');
  if(wrap && dd && dd.classList.contains('open') && !wrap.contains(e.target)){
    dd.classList.remove('open');
  }
});

// Initial load + 30s polling of count
loadAdminNotifications();
setInterval(loadAdminNotifications, 30000);

})();
</script>

</body>
</html>
