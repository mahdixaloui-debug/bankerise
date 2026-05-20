<?php
require_once __DIR__ . '/../config/auth.php';
// If already logged in, redirect
if (isLoggedIn()) {
    header('Location: ' . (isAdmin() ? 'backoffice.php' : 'dashboard.php'));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Partner Area — Log in to your Bankerise partner dashboard to manage deals, track commissions, and access resources.">
  <title>Partner Area — Bankerise®</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            grape: '#4C4E89',
            'indigo-brand': '#35365F',
            pacific: '#4DB8CD',
            aqua: '#766CFF',
            bell: '#4799D1',
            dark: '#0D0F1C',
            dark2: '#141729',
            dark3: '#1A1D35',
          },
          fontFamily: { montserrat: ['Montserrat', 'sans-serif'] },
        }
      }
    }
  </script>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">

  <!-- Shared CSS -->
  <link rel="stylesheet" href="../assets/css/shared.css">

  <style>
    /* ============================================
       Partner Login — Custom Styles
       ============================================ */

    html,
    body {
      height: 100%;
      margin: 0;
      overflow: hidden;
      background: transparent !important;
    }

    .login-page {
      height: 100vh;
      width: 100%;
      display: flex;
      position: relative;
      overflow: hidden;
      background: transparent;
    }

    /* Background video (clones use-cases.php hero treatment) */
    .login-bg-video {
      position: fixed;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: 0;
      pointer-events: none;
    }

    .login-bg-overlay {
      position: fixed;
      inset: 0;
      z-index: 1;
      pointer-events: none;
      background: linear-gradient(to bottom,
          rgba(13, 15, 28, 0.35) 0%,
          rgba(13, 15, 28, 0.75) 60%,
          rgba(13, 15, 28, 0.9) 100%);
    }

    /* Form panel — full width */
    .login-form-panel {
      flex: 1 1 100%;
      width: 100%;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
      position: relative;
      z-index: 2;
    }

    /* Login card — glassmorphism container */
    .login-card {
      width: 100%;
      max-width: 440px;
      position: relative;
      z-index: 3;
      padding: 1.75rem 2rem 1.25rem;
      background: rgba(13, 15, 28, 0.1);
      backdrop-filter: blur(10px) saturate(140%);
      -webkit-backdrop-filter: blur(10px) saturate(140%);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 20px;
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.75);
      max-height: calc(100vh - 3rem);
      overflow-y: auto;
    }

    .login-card::-webkit-scrollbar {
      width: 0;
      display: none;
    }

    /* Form field group */
    .field-group {
      position: relative;
      margin-bottom: 0.875rem;
    }

    .field-group label {
      display: block;
      font-size: 12px;
      font-weight: 600;
      color: #94A3B8;
      margin-bottom: 6px;
      letter-spacing: 0.02em;
    }

    .field-group .field-icon {
      position: absolute;
      left: 16px;
      bottom: 13px;
      width: 18px;
      height: 18px;
      color: rgba(255, 255, 255, 0.25);
      pointer-events: none;
      transition: color 0.3s;
    }

    .field-group input:focus~.field-icon,
    .field-group input:not(:placeholder-shown)~.field-icon {
      color: #4DB8CD;
    }

    .field-group input {
      width: 100%;
      padding: 12px 16px 12px 44px;
      background: rgba(255, 255, 255, 0.06);
      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 12px;
      color: #fff;
      font-family: 'Montserrat', sans-serif;
      font-size: 14px;
      outline: none;
      transition: all 0.3s ease;
    }

    .field-group input::placeholder {
      color: rgba(255, 255, 255, 0.35);
    }

    .field-group input:focus {
      border-color: #4DB8CD;
      background: rgba(77, 184, 205, 0.08);
      box-shadow: 0 0 0 3px rgba(77, 184, 205, 0.15);
    }

    /* Password toggle */
    .password-toggle {
      position: absolute;
      right: 14px;
      bottom: 11px;
      background: none;
      border: none;
      cursor: pointer;
      color: rgba(255, 255, 255, 0.4);
      transition: color 0.2s;
      padding: 2px;
    }

    .password-toggle:hover {
      color: rgba(255, 255, 255, 0.8);
    }

    /* Login button */
    .login-btn {
      width: 100%;
      padding: 13px;
      background: linear-gradient(135deg, #4DB8CD, #766CFF);
      color: #fff;
      font-family: 'Montserrat', sans-serif;
      font-weight: 700;
      font-size: 15px;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .login-btn::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), transparent);
      opacity: 0;
      transition: opacity 0.3s;
    }

    .login-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 35px rgba(77, 184, 205, 0.3);
    }

    .login-btn:hover::before {
      opacity: 1;
    }

    .login-btn:active {
      transform: translateY(0);
    }

    /* Loading state */
    .login-btn.loading {
      pointer-events: none;
      opacity: 0.8;
    }

    .login-btn .btn-text {
      transition: opacity 0.3s;
    }

    .login-btn.loading .btn-text {
      opacity: 0;
    }

    .login-btn .btn-spinner {
      position: absolute;
      inset: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: opacity 0.3s;
    }

    .login-btn.loading .btn-spinner {
      opacity: 1;
    }

    .spinner {
      width: 22px;
      height: 22px;
      border: 2.5px solid rgba(255, 255, 255, 0.3);
      border-top-color: #fff;
      border-radius: 50%;
      animation: spin 0.7s linear infinite;
    }

    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }

    /* Divider */
    .login-divider {
      display: flex;
      align-items: center;
      gap: 16px;
      margin: 14px 0;
    }

    .login-divider::before,
    .login-divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: rgba(255, 255, 255, 0.06);
    }

    .login-divider span {
      font-size: 12px;
      color: rgba(255, 255, 255, 0.25);
      text-transform: uppercase;
      letter-spacing: 0.1em;
      font-weight: 500;
    }

    /* Social login */
    .social-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      width: 100%;
      padding: 11px;
      background: rgba(255, 255, 255, 0.06);
      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 12px;
      color: #fff;
      font-family: 'Montserrat', sans-serif;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .social-btn:hover {
      background: rgba(255, 255, 255, 0.1);
      border-color: rgba(255, 255, 255, 0.2);
      transform: translateY(-1px);
    }

    /* Sign-up link-button */
    .login-signup-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      width: 100%;
      margin-top: 12px;
      padding: 11px 16px;
      border-radius: 12px;
      border: 1px solid rgba(77, 184, 205, 0.35);
      background: rgba(77, 184, 205, 0.08);
      color: #E8EEF5;
      font-family: 'Montserrat', sans-serif;
      font-size: 13px;
      font-weight: 500;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .login-signup-btn strong {
      color: #4DB8CD;
      font-weight: 700;
    }

    .login-signup-btn:hover {
      background: rgba(77, 184, 205, 0.16);
      border-color: #4DB8CD;
      transform: translateY(-1px);
    }

    .social-btn svg {
      width: 18px;
      height: 18px;
      flex-shrink: 0;
    }

    /* Checkbox */
    .custom-checkbox {
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      font-size: 13px;
      color: #94A3B8;
    }

    .custom-checkbox input {
      display: none;
    }

    .custom-checkbox .checkmark {
      width: 18px;
      height: 18px;
      border: 1.5px solid rgba(255, 255, 255, 0.15);
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
      flex-shrink: 0;
    }

    .custom-checkbox .checkmark svg {
      width: 12px;
      height: 12px;
      color: #0D0F1C;
      opacity: 0;
      transform: scale(0.5);
      transition: all 0.2s;
    }

    .custom-checkbox input:checked+.checkmark {
      background: #4DB8CD;
      border-color: #4DB8CD;
    }

    .custom-checkbox input:checked+.checkmark svg {
      opacity: 1;
      transform: scale(1);
    }

    /* Error toast */
    .login-error {
      display: none;
      align-items: center;
      gap: 10px;
      padding: 12px 16px;
      background: rgba(239, 68, 68, 0.1);
      border: 1px solid rgba(239, 68, 68, 0.2);
      border-radius: 10px;
      font-size: 13px;
      color: #f87171;
      margin-bottom: 1rem;
      animation: shake 0.4s ease;
    }

    .login-error.visible {
      display: flex;
    }

    @keyframes shake {

      0%,
      100% {
        transform: translateX(0);
      }

      25% {
        transform: translateX(-6px);
      }

      75% {
        transform: translateX(6px);
      }
    }

    /* Particle canvas */
    #login-particles {
      position: absolute;
      inset: 0;
      pointer-events: none;
      z-index: 0;
    }

    /* Back link */
    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 13px;
      font-weight: 500;
      color: #94A3B8;
      text-decoration: none;
      transition: color 0.2s;
      margin-bottom: 1.25rem;
    }

    .back-link:hover {
      color: #4DB8CD;
    }

    .back-link svg {
      width: 16px;
      height: 16px;
    }

    /* Tighter header spacing */
    .login-card h2 {
      font-size: 22px;
      line-height: 1.2;
    }

    .login-header {
      margin-bottom: 1.25rem;
    }

    .login-card .field-group:last-of-type {
      margin-bottom: 0.75rem;
    }

    .login-card .social-grid {
      margin-bottom: 0;
    }
  </style>
</head>

<body class="font-montserrat">

  <!-- ═══════════════════════════════════════════
       BACKGROUND VIDEO (mirrors use-cases.php hero)
       Drop the video path in the src="" below.
       ═══════════════════════════════════════════ -->
  <video class="login-bg-video" autoplay loop muted playsinline>
    <source src="../assets/videos/6889565-hd_1920_1080_25fps.mp4" type="video/mp4">
  </video>
  <div class="login-bg-overlay"></div>

  <div class="login-page">

    <!-- ═══════════════════════════════════════════
         LOGIN FORM — full width
         ═══════════════════════════════════════════ -->
    <div class="login-form-panel">
      <canvas id="login-particles"></canvas>

      <div class="login-card relative z-10">
        <!-- Back link -->
        <a href="../partners.php" class="back-link block">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Back to Partners
        </a>

        <!-- Header -->
        <div class="login-header">
          <h2 class="font-extrabold text-white mb-1">Welcome back</h2>
          <p class="text-gray-400 text-sm">Sign in to access your partner dashboard</p>
        </div>

        <!-- Error message -->
        <div class="login-error" id="login-error">
          <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
          </svg>
          <span id="login-error-text">Invalid email or password. Please try again.</span>
        </div>

        <!-- Login form -->
        <form id="login-form" novalidate>
          <!-- Email -->
          <div class="field-group">
            <label for="login-email">Email address</label>
            <input type="email" id="login-email" placeholder="partner@company.com" autocomplete="email" required>
            <svg class="field-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
          </div>

          <!-- Password -->
          <div class="field-group">
            <label for="login-password">Password</label>
            <input type="password" id="login-password" placeholder="Enter your password" autocomplete="current-password"
              required>
            <svg class="field-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            <button type="button" class="password-toggle" id="toggle-password" aria-label="Toggle password visibility">
              <svg class="eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24" width="18" height="18">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
              <svg class="eye-closed" fill="none" stroke="currentColor" viewBox="0 0 24 24" width="18" height="18"
                style="display:none">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
              </svg>
            </button>
          </div>

          <!-- Remember + Forgot -->
          <div class="flex items-center justify-between mb-4">
            <label class="custom-checkbox">
              <input type="checkbox" id="remember-me">
              <span class="checkmark">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
              </span>
              Remember me
            </label>
            <a href="#" class="text-sm text-pacific font-medium hover:underline">Forgot password?</a>
          </div>

          <!-- Login button -->
          <button type="submit" class="login-btn" id="login-submit">
            <span class="btn-text">Sign In to Dashboard</span>
            <span class="btn-spinner"><span class="spinner"></span></span>
          </button>
        </form>

        <!-- Divider -->
        <div class="login-divider">
          <span>or continue with</span>
        </div>

        <!-- Social logins -->
        <div class="grid grid-cols-2 gap-3 social-grid">
          <button class="social-btn" type="button">
            <svg viewBox="0 0 24 24" fill="currentColor">
              <path
                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"
                fill="#4285F4" />
              <path
                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                fill="#34A853" />
              <path
                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                fill="#FBBC05" />
              <path
                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                fill="#EA4335" />
            </svg>
            Google
          </button>
          <button class="social-btn" type="button">
            <svg viewBox="0 0 24 24" fill="currentColor">
              <path
                d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"
                fill="white" />
            </svg>
            GitHub
          </button>
        </div>

        <!-- Sign-up link-button (for users without an account) -->
        <a href="apply.php" class="login-signup-btn">
          Don't have an account yet? <strong>Apply now →</strong>
        </a>

        <!-- Security badge -->
        <div class="flex items-center justify-center gap-2 mt-4 text-gray-700 text-xs">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
          </svg>
          <span>Secured with 256-bit SSL encryption</span>
        </div>
      </div>
    </div>

  </div>

  <!-- ═══════════════════════════════════════════
       SCRIPTS
       ═══════════════════════════════════════════ -->
  <script>
      (function () {
        'use strict';

        /* ── Particles ──────────────────────────────── */
        var canvas = document.getElementById('login-particles');
        if (canvas) {
          var ctx = canvas.getContext('2d');
          var particles = [];

          function resize() {
            var panel = canvas.parentElement;
            canvas.width = panel.offsetWidth;
            canvas.height = panel.offsetHeight;
          }
          resize();
          window.addEventListener('resize', resize);

          for (var i = 0; i < 35; i++) {
            particles.push({
              x: Math.random() * canvas.width,
              y: Math.random() * canvas.height,
              r: Math.random() * 1.2 + 0.3,
              dx: (Math.random() - 0.5) * 0.2,
              dy: (Math.random() - 0.5) * 0.2,
              o: Math.random() * 0.3 + 0.05
            });
          }

          function tick() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(function (p) {
              p.x += p.dx; p.y += p.dy;
              if (p.x < 0 || p.x > canvas.width) p.dx *= -1;
              if (p.y < 0 || p.y > canvas.height) p.dy *= -1;
              ctx.beginPath();
              ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
              ctx.fillStyle = 'rgba(77,184,205,' + p.o + ')';
              ctx.fill();
            });
            for (var a = 0; a < particles.length; a++) {
              for (var b = a + 1; b < particles.length; b++) {
                var dx = particles[a].x - particles[b].x;
                var dy = particles[a].y - particles[b].y;
                var d = Math.sqrt(dx * dx + dy * dy);
                if (d < 80) {
                  ctx.beginPath();
                  ctx.moveTo(particles[a].x, particles[a].y);
                  ctx.lineTo(particles[b].x, particles[b].y);
                  ctx.strokeStyle = 'rgba(77,184,205,' + (0.04 * (1 - d / 80)) + ')';
                  ctx.lineWidth = 0.5;
                  ctx.stroke();
                }
              }
            }
            requestAnimationFrame(tick);
          }
          tick();
        }

        /* ── Password Toggle ────────────────────────── */
        var toggleBtn = document.getElementById('toggle-password');
        var passInput = document.getElementById('login-password');
        if (toggleBtn && passInput) {
          toggleBtn.addEventListener('click', function () {
            var isPassword = passInput.type === 'password';
            passInput.type = isPassword ? 'text' : 'password';
            toggleBtn.querySelector('.eye-open').style.display = isPassword ? 'none' : 'block';
            toggleBtn.querySelector('.eye-closed').style.display = isPassword ? 'block' : 'none';
          });
        }

        /* ── Form Submit ────────────────────────────── */
        var form = document.getElementById('login-form');
        var submitBtn = document.getElementById('login-submit');
        var errorBox = document.getElementById('login-error');

        if (form) {
          form.addEventListener('submit', function (e) {
            e.preventDefault();
            errorBox.classList.remove('visible');

            var email = document.getElementById('login-email').value.trim();
            var password = document.getElementById('login-password').value;

            // Basic validation
            if (!email || !password) {
              errorBox.classList.add('visible');
              document.getElementById('login-error-text').textContent = 'Please fill in all fields.';
              return;
            }

            if (!email.includes('@') || !email.includes('.')) {
              errorBox.classList.add('visible');
              document.getElementById('login-error-text').textContent = 'Please enter a valid email address.';
              return;
            }

            // Show loading
            submitBtn.classList.add('loading');

            // Real login via API
            fetch('/api/auth.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({ email: email, password: password })
            })
            .then(function(res) { return res.json(); })
            .then(function(data) {
              submitBtn.classList.remove('loading');
              if (data.success) {
                window.location.href = data.redirect;
              } else {
                errorBox.classList.add('visible');
                document.getElementById('login-error-text').textContent = data.message || 'Login failed.';
              }
            })
            .catch(function(err) {
              submitBtn.classList.remove('loading');
              errorBox.classList.add('visible');
              document.getElementById('login-error-text').textContent = 'Network error. Check your connection.';
            });
          });
        }

        /* ── Input focus animation ──────────────────── */
        document.querySelectorAll('.field-group input').forEach(function (input) {
          input.addEventListener('focus', function () {
            this.parentElement.classList.add('focused');
          });
          input.addEventListener('blur', function () {
            this.parentElement.classList.remove('focused');
          });
        });

      })();
  </script>

</body>

</html>