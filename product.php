<?php
$pageTitle = 'Platform Overview — Bankerise®';
$pageDescription = 'Bankerise Platform — A modular, API-first digital banking platform for onboarding, lending, omnichannel engagement, analytics, and partner management.';
include 'includes/head.php';
?>
</head>
<body class="font-montserrat bg-dark text-white">
  <?php include 'includes/navbar.php'; ?>

  <main id="main-content">

    <!-- HERO -->
    <section class="relative min-h-[80vh] flex items-center overflow-hidden noise-overlay">
      <div class="mesh-gradient"><div class="blob blob-1"></div><div class="blob blob-2"></div><div class="blob blob-3"></div></div>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
          <div>
            <p class="eyebrow" data-animate>THE BANKERISE PLATFORM</p>
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold leading-tight mb-6" data-animate data-animate-delay="1">One Platform.<br><span class="gradient-text">Infinite Possibilities.</span></h1>
            <p class="text-lg text-gray-400 max-w-xl mb-10 leading-relaxed" data-animate data-animate-delay="2">A modular, API-first digital banking platform built for financial institutions that demand flexibility, security, and scale.</p>
            <div class="flex flex-wrap gap-4" data-animate data-animate-delay="3">
              <a href="contact.php" class="btn-primary">Request a Demo <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg></a>
            </div>
          </div>
          <!-- Architecture mini visual -->
          <div class="hidden lg:block" data-animate="right" data-animate-delay="2">
            <div class="space-y-4 max-w-sm ml-auto animate-float">
              <div class="glass-card p-4 text-center"><p class="text-xs text-gray-400 mb-2">CHANNELS</p><div class="flex justify-center gap-2"><span class="bg-white/5 rounded-lg px-3 py-1.5 text-xs">Mobile</span><span class="bg-white/5 rounded-lg px-3 py-1.5 text-xs">Web</span><span class="bg-white/5 rounded-lg px-3 py-1.5 text-xs">API</span><span class="bg-white/5 rounded-lg px-3 py-1.5 text-xs">Branch</span></div></div>
              <div class="flex justify-center"><svg class="w-5 h-5 text-pacific/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7"/></svg></div>
              <div class="glass-card p-3 text-center border-pacific/20"><p class="text-xs font-semibold text-pacific">API GATEWAY</p></div>
              <div class="flex justify-center"><svg class="w-5 h-5 text-pacific/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7"/></svg></div>
              <div class="glass-card p-4 text-center"><p class="text-xs text-gray-400 mb-2">CORE MODULES</p><div class="flex flex-wrap justify-center gap-2"><span class="bg-pacific/10 text-pacific rounded-lg px-3 py-1.5 text-xs font-medium">Onboarding</span><span class="bg-aqua/10 text-aqua rounded-lg px-3 py-1.5 text-xs font-medium">Lending</span><span class="bg-bell/10 text-bell rounded-lg px-3 py-1.5 text-xs font-medium">Engagement</span><span class="bg-green-400/10 text-green-400 rounded-lg px-3 py-1.5 text-xs font-medium">Analytics</span></div></div>
              <div class="flex justify-center"><svg class="w-5 h-5 text-pacific/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7"/></svg></div>
              <div class="glass-card p-3 text-center"><p class="text-xs text-gray-400">INFRASTRUCTURE</p><p class="text-xs text-gray-500">Cloud · Security · Database</p></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- PLATFORM ARCHITECTURE -->
    <section class="py-20 lg:py-32 bg-dark2">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16" data-animate>
          <p class="eyebrow">ARCHITECTURE</p>
          <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6">Designed for composability</h2>
          <p class="text-gray-400 text-lg">A layered, modular architecture where every component is independently deployable and API-accessible.</p>
        </div>

        <!-- Architecture diagram -->
        <div class="max-w-4xl mx-auto space-y-6" data-animate>
          <!-- Channels layer -->
          <div>
            <p class="text-xs text-gray-500 font-semibold tracking-widest mb-3 text-center">DELIVERY CHANNELS</p>
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
              <div class="glass-card p-4 text-center"><svg class="w-6 h-6 text-pacific mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg><p class="text-xs font-medium">Mobile</p></div>
              <div class="glass-card p-4 text-center"><svg class="w-6 h-6 text-pacific mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg><p class="text-xs font-medium">Web</p></div>
              <div class="glass-card p-4 text-center"><svg class="w-6 h-6 text-pacific mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg><p class="text-xs font-medium">Branch</p></div>
              <div class="glass-card p-4 text-center"><svg class="w-6 h-6 text-pacific mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg><p class="text-xs font-medium">API</p></div>
              <div class="glass-card p-4 text-center hidden sm:block"><svg class="w-6 h-6 text-pacific mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg><p class="text-xs font-medium">Chatbot</p></div>
            </div>
          </div>
          <!-- Connector -->
          <div class="flex justify-center"><div class="w-px h-8 bg-gradient-to-b from-pacific/30 to-transparent"></div></div>
          <!-- API Gateway -->
          <div class="gradient-border p-5 text-center" data-animate>
            <p class="font-semibold text-pacific text-sm">API Gateway & Orchestration Layer</p>
            <p class="text-xs text-gray-500 mt-1">Authentication · Rate Limiting · Routing · Load Balancing</p>
          </div>
          <div class="flex justify-center"><div class="w-px h-8 bg-gradient-to-b from-pacific/30 to-transparent"></div></div>
          <!-- Core modules -->
          <div>
            <p class="text-xs text-gray-500 font-semibold tracking-widest mb-3 text-center">CORE MODULES</p>
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
              <div class="gradient-border p-4 text-center"><svg class="w-6 h-6 text-pacific mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg><p class="text-xs font-medium">Onboarding</p></div>
              <div class="gradient-border p-4 text-center"><svg class="w-6 h-6 text-aqua mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V7m0 1v8m0 0v1"/></svg><p class="text-xs font-medium">Lending</p></div>
              <div class="gradient-border p-4 text-center"><svg class="w-6 h-6 text-bell mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg><p class="text-xs font-medium">Engagement</p></div>
              <div class="gradient-border p-4 text-center"><svg class="w-6 h-6 text-green-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg><p class="text-xs font-medium">Analytics</p></div>
              <div class="gradient-border p-4 text-center"><svg class="w-6 h-6 text-grape mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg><p class="text-xs font-medium">Compliance</p></div>
            </div>
          </div>
          <div class="flex justify-center"><div class="w-px h-8 bg-gradient-to-b from-pacific/30 to-transparent"></div></div>
          <!-- Infrastructure -->
          <div class="glass-card p-5 text-center" data-animate>
            <p class="text-xs text-gray-500 font-semibold tracking-widest mb-2">INFRASTRUCTURE</p>
            <div class="flex justify-center gap-6 text-xs text-gray-400">
              <span>Cloud-Native</span><span class="text-white/10">|</span><span>Multi-Tenant</span><span class="text-white/10">|</span><span>Encrypted</span><span class="text-white/10">|</span><span>99.99% SLA</span>
            </div>
          </div>
        </div>

        <!-- Platform screenshot placeholder -->
        <!-- Replace with: <img src="assets/images/product/platform-screenshot.png" alt="Bankerise Platform" class="w-full rounded-2xl"> -->
        <div class="mt-12 img-placeholder" style="min-height:300px;aspect-ratio:16/9" data-animate>
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          <span>platform-architecture-screenshot.png — 1440x900</span>
        </div>
      </div>
    </section>

    <!-- MODULE DEEP DIVES -->

    <!-- Onboarding -->
    <section class="py-20 lg:py-28" id="onboarding">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
          <div data-animate>
            <p class="eyebrow">MODULE</p>
            <h3 class="text-3xl font-bold mb-4">Digital Onboarding</h3>
            <p class="text-gray-400 mb-6 leading-relaxed">Transform customer acquisition with a fully digital, compliant onboarding experience. Reduce drop-offs and accelerate time-to-value.</p>
            <ul class="space-y-3 mb-8">
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>eKYC with biometric verification</li>
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Document scanning and OCR</li>
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Multi-product account opening</li>
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Real-time compliance checks</li>
            </ul>
          </div>
          <div data-animate="right">
            <div class="glass-card p-6">
              <!-- Replace with: <img src="assets/images/modules/onboarding-screenshot.jpg" alt="Digital Onboarding" class="w-full rounded-xl mb-4"> -->
              <div class="img-placeholder mb-4" style="min-height:180px">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>onboarding-screenshot.jpg — 800x450</span>
              </div>
              <div class="flex items-center gap-3 mb-5"><div class="w-10 h-10 rounded-xl bg-pacific/10 flex items-center justify-center"><svg class="w-5 h-5 text-pacific" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg></div><div><p class="font-bold text-sm">New Account</p><p class="text-xs text-gray-500">Step 3 of 4</p></div></div>
              <div class="w-full bg-white/10 rounded-full h-1.5 mb-5"><div class="bg-gradient-to-r from-pacific to-aqua h-1.5 rounded-full" style="width:75%"></div></div>
              <div class="space-y-3">
                <div class="flex items-center gap-3 text-sm"><div class="w-6 h-6 rounded-full bg-green-500/20 flex items-center justify-center"><svg class="w-3 h-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div><span class="text-gray-400 line-through">Personal Info</span></div>
                <div class="flex items-center gap-3 text-sm"><div class="w-6 h-6 rounded-full bg-green-500/20 flex items-center justify-center"><svg class="w-3 h-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div><span class="text-gray-400 line-through">Documents</span></div>
                <div class="flex items-center gap-3 text-sm"><div class="w-6 h-6 rounded-full bg-pacific/20 flex items-center justify-center"><div class="w-2 h-2 bg-pacific rounded-full animate-pulse"></div></div><span class="text-white font-medium">Identity Verification</span></div>
                <div class="flex items-center gap-3 text-sm"><div class="w-6 h-6 rounded-full bg-white/10 flex items-center justify-center"><span class="text-xs text-gray-500">4</span></div><span class="text-gray-600">Account Activation</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <hr class="section-divider">

    <!-- Lending -->
    <section class="py-20 lg:py-28 bg-dark2" id="lending">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
          <div class="order-2 lg:order-1" data-animate="left">
            <div class="glass-card p-6">
              <!-- Replace with: <img src="assets/images/modules/lending-screenshot.jpg" alt="Lending Engine" class="w-full rounded-xl mb-4"> -->
              <div class="img-placeholder mb-4" style="min-height:180px">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>lending-screenshot.jpg — 800x450</span>
              </div>
              <p class="font-bold text-sm mb-4">Loan Decision Engine</p>
              <div class="space-y-4">
                <div class="flex justify-between"><span class="text-sm text-gray-400">Credit Score</span><span class="text-sm font-bold text-green-400">742 — Excellent</span></div>
                <div class="w-full bg-white/10 rounded-full h-1.5"><div class="bg-green-400 h-1.5 rounded-full" style="width:85%"></div></div>
                <div class="flex justify-between"><span class="text-sm text-gray-400">DTI Ratio</span><span class="text-sm font-bold text-pacific">28%</span></div>
                <div class="flex justify-between"><span class="text-sm text-gray-400">Requested Amount</span><span class="text-sm font-bold">$50,000</span></div>
                <div class="flex justify-between"><span class="text-sm text-gray-400">Term</span><span class="text-sm font-bold">36 months</span></div>
                <div class="p-3 rounded-lg bg-green-400/10 border border-green-400/20 flex items-center gap-3 mt-2">
                  <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                  <span class="text-sm text-green-400 font-medium">Auto-approved in 3.2s</span>
                </div>
              </div>
            </div>
          </div>
          <div class="order-1 lg:order-2" data-animate>
            <p class="eyebrow">MODULE</p>
            <h3 class="text-3xl font-bold mb-4">Lending Engine</h3>
            <p class="text-gray-400 mb-6 leading-relaxed">Automate your entire loan lifecycle — from application to disbursement. Configurable scoring models, instant decisioning, and full portfolio management.</p>
            <ul class="space-y-3 mb-8">
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Automated credit scoring</li>
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Configurable approval workflows</li>
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Multi-product loan origination</li>
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Real-time portfolio monitoring</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Omnichannel -->
    <section class="py-20 lg:py-28" id="omnichannel">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
          <div data-animate>
            <p class="eyebrow">MODULE</p>
            <h3 class="text-3xl font-bold mb-4">Omnichannel Engagement</h3>
            <p class="text-gray-400 mb-6 leading-relaxed">Deliver consistent, personalized experiences across every touchpoint. One platform powering mobile, web, branch, chatbot, and API channels.</p>
            <ul class="space-y-3 mb-8">
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Mobile-first banking apps</li>
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Web portal with full self-service</li>
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>AI-powered chatbot integration</li>
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Unified customer data layer</li>
            </ul>
          </div>
          <div data-animate="right">
            <div class="glass-card p-6">
              <!-- Replace with: <img src="assets/images/modules/omnichannel-screenshot.jpg" alt="Omnichannel" class="w-full rounded-xl mb-4"> -->
              <div class="img-placeholder mb-4" style="min-height:180px">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>omnichannel-screenshot.jpg — 800x450</span>
              </div>
              <p class="font-bold text-sm mb-4 text-center">Channel Distribution</p>
              <div class="grid grid-cols-2 gap-3">
                <div class="p-4 rounded-xl bg-white/5 text-center"><p class="text-2xl font-bold text-pacific">68%</p><p class="text-xs text-gray-400 mt-1">Mobile</p></div>
                <div class="p-4 rounded-xl bg-white/5 text-center"><p class="text-2xl font-bold text-aqua">22%</p><p class="text-xs text-gray-400 mt-1">Web</p></div>
                <div class="p-4 rounded-xl bg-white/5 text-center"><p class="text-2xl font-bold text-bell">7%</p><p class="text-xs text-gray-400 mt-1">Branch</p></div>
                <div class="p-4 rounded-xl bg-white/5 text-center"><p class="text-2xl font-bold text-green-400">3%</p><p class="text-xs text-gray-400 mt-1">Chatbot</p></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <hr class="section-divider">

    <!-- Analytics -->
    <section class="py-20 lg:py-28 bg-dark2" id="analytics">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
          <div class="order-2 lg:order-1" data-animate="left">
            <div class="glass-card p-6">
              <!-- Replace with: <img src="assets/images/modules/analytics-screenshot.jpg" alt="Analytics" class="w-full rounded-xl mb-4"> -->
              <div class="img-placeholder mb-4" style="min-height:180px">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>analytics-screenshot.jpg — 800x450</span>
              </div>
              <p class="font-bold text-sm mb-4">Key Metrics — This Month</p>
              <div class="space-y-4">
                <div><div class="flex justify-between text-sm mb-1"><span class="text-gray-400">Customer Acquisition</span><span class="font-medium text-green-400">+24%</span></div><div class="w-full bg-white/10 rounded-full h-1.5"><div class="bg-pacific h-1.5 rounded-full" style="width:78%"></div></div></div>
                <div><div class="flex justify-between text-sm mb-1"><span class="text-gray-400">Digital Adoption</span><span class="font-medium">87%</span></div><div class="w-full bg-white/10 rounded-full h-1.5"><div class="bg-aqua h-1.5 rounded-full" style="width:87%"></div></div></div>
                <div><div class="flex justify-between text-sm mb-1"><span class="text-gray-400">NPS Score</span><span class="font-medium">72</span></div><div class="w-full bg-white/10 rounded-full h-1.5"><div class="bg-green-400 h-1.5 rounded-full" style="width:72%"></div></div></div>
                <div><div class="flex justify-between text-sm mb-1"><span class="text-gray-400">Loan Default Rate</span><span class="font-medium">1.2%</span></div><div class="w-full bg-white/10 rounded-full h-1.5"><div class="bg-bell h-1.5 rounded-full" style="width:12%"></div></div></div>
              </div>
            </div>
          </div>
          <div class="order-1 lg:order-2" data-animate>
            <p class="eyebrow">MODULE</p>
            <h3 class="text-3xl font-bold mb-4">Analytics & Insights</h3>
            <p class="text-gray-400 mb-6 leading-relaxed">Make data-driven decisions with real-time dashboards, custom reports, and predictive analytics. Understand your customers like never before.</p>
            <ul class="space-y-3 mb-8">
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Real-time operational dashboards</li>
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Customer behavior analytics</li>
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Regulatory reporting automation</li>
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Predictive risk models</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Integration Hub -->
    <section class="py-20 lg:py-28" id="integration">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
          <div data-animate>
            <p class="eyebrow">MODULE</p>
            <h3 class="text-3xl font-bold mb-4">Integration Hub</h3>
            <p class="text-gray-400 mb-6 leading-relaxed">Connect Bankerise to your existing ecosystem with open APIs, webhooks, and pre-built connectors. Integrate once, extend infinitely.</p>
            <ul class="space-y-3 mb-8">
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>RESTful APIs with full documentation</li>
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Webhooks for real-time events</li>
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Pre-built core banking connectors</li>
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Third-party payment gateways</li>
            </ul>
          </div>
          <div data-animate="right">
            <div class="glass-card p-6">
              <!-- Replace with: <img src="assets/images/modules/integration-screenshot.jpg" alt="Integration Hub" class="w-full rounded-xl mb-4"> -->
              <div class="img-placeholder mb-4" style="min-height:180px">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>integration-screenshot.jpg — 800x450</span>
              </div>
              <p class="font-bold text-sm mb-4">API Endpoints</p>
              <div class="space-y-2">
                <div class="flex items-center gap-3 p-3 rounded-lg bg-white/5"><span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">GET</span><span class="text-sm text-gray-300 font-mono">/api/v2/accounts</span></div>
                <div class="flex items-center gap-3 p-3 rounded-lg bg-white/5"><span class="text-xs font-bold text-pacific bg-pacific/10 px-2 py-0.5 rounded">POST</span><span class="text-sm text-gray-300 font-mono">/api/v2/loans/apply</span></div>
                <div class="flex items-center gap-3 p-3 rounded-lg bg-white/5"><span class="text-xs font-bold text-yellow-400 bg-yellow-400/10 px-2 py-0.5 rounded">PUT</span><span class="text-sm text-gray-300 font-mono">/api/v2/kyc/verify</span></div>
                <div class="flex items-center gap-3 p-3 rounded-lg bg-white/5"><span class="text-xs font-bold text-green-400 bg-green-400/10 px-2 py-0.5 rounded">GET</span><span class="text-sm text-gray-300 font-mono">/api/v2/analytics/dashboard</span></div>
                <div class="flex items-center gap-3 p-3 rounded-lg bg-white/5"><span class="text-xs font-bold text-pacific bg-pacific/10 px-2 py-0.5 rounded">POST</span><span class="text-sm text-gray-300 font-mono">/api/v2/webhooks/subscribe</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- TECHNOLOGY STACK -->
    <section class="py-20 lg:py-28 bg-dark2">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16" data-animate>
          <p class="eyebrow">TECHNOLOGY</p>
          <h2 class="text-3xl sm:text-4xl font-bold mb-6">Enterprise-grade infrastructure</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div class="glass-card p-8" data-animate data-animate-delay="1">
            <svg class="w-10 h-10 text-pacific mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/></svg>
            <h4 class="text-lg font-bold mb-2">Cloud-Native</h4>
            <p class="text-gray-400 text-sm">Kubernetes orchestration, Docker containers, and auto-scaling infrastructure that grows with your needs.</p>
          </div>
          <div class="glass-card p-8" data-animate data-animate-delay="2">
            <svg class="w-10 h-10 text-aqua mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
            <h4 class="text-lg font-bold mb-2">API-First</h4>
            <p class="text-gray-400 text-sm">RESTful APIs, GraphQL endpoints, and webhooks — every feature accessible programmatically.</p>
          </div>
          <div class="glass-card p-8" data-animate data-animate-delay="3">
            <svg class="w-10 h-10 text-bell mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            <h4 class="text-lg font-bold mb-2">Microservices</h4>
            <p class="text-gray-400 text-sm">Independently deployable services with isolated failure domains and independent scaling.</p>
          </div>
          <div class="glass-card p-8" data-animate data-animate-delay="1">
            <svg class="w-10 h-10 text-green-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            <h4 class="text-lg font-bold mb-2">Security</h4>
            <p class="text-gray-400 text-sm">End-to-end encryption, zero-trust architecture, and continuous security monitoring.</p>
          </div>
          <div class="glass-card p-8" data-animate data-animate-delay="2">
            <svg class="w-10 h-10 text-grape mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <h4 class="text-lg font-bold mb-2">Multi-Tenancy</h4>
            <p class="text-gray-400 text-sm">Isolated tenant environments with configurable data residency and dedicated resource allocation.</p>
          </div>
          <div class="glass-card p-8" data-animate data-animate-delay="3">
            <svg class="w-10 h-10 text-pacific mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            <h4 class="text-lg font-bold mb-2">High Availability</h4>
            <p class="text-gray-400 text-sm">99.99% uptime SLA with multi-region failover, automated recovery, and zero-downtime deployments.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- COMPLIANCE -->
    <section class="py-20 lg:py-28">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="eyebrow" data-animate>COMPLIANCE & SECURITY</p>
        <h2 class="text-3xl sm:text-4xl font-bold mb-6" data-animate>Built for compliance</h2>
        <p class="text-gray-400 text-lg max-w-2xl mx-auto mb-12" data-animate>Bankerise meets the most demanding regulatory requirements across regions, ensuring your digital banking operations stay compliant.</p>
        <div class="flex flex-wrap justify-center gap-4" data-animate>
          <div class="glass-card px-8 py-6 text-center"><p class="text-lg font-bold text-pacific">PCI DSS</p><p class="text-xs text-gray-500 mt-1">Level 1</p></div>
          <div class="glass-card px-8 py-6 text-center"><p class="text-lg font-bold text-aqua">SOC 2</p><p class="text-xs text-gray-500 mt-1">Type II</p></div>
          <div class="glass-card px-8 py-6 text-center"><p class="text-lg font-bold text-bell">GDPR</p><p class="text-xs text-gray-500 mt-1">Compliant</p></div>
          <div class="glass-card px-8 py-6 text-center"><p class="text-lg font-bold text-green-400">PSD2</p><p class="text-xs text-gray-500 mt-1">Ready</p></div>
          <div class="glass-card px-8 py-6 text-center"><p class="text-lg font-bold text-grape">ISO 27001</p><p class="text-xs text-gray-500 mt-1">Certified</p></div>
        </div>
      </div>
    </section>

    <hr class="section-divider">

    <!-- CTA -->
    <section class="py-20 lg:py-28 relative overflow-hidden noise-overlay">
      <div class="mesh-gradient"><div class="blob blob-1"></div><div class="blob blob-2"></div></div>
      <div class="absolute inset-0 bg-dark/60 pointer-events-none"></div>
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6" data-animate>See it in action</h2>
        <p class="text-gray-300 text-lg max-w-2xl mx-auto mb-10" data-animate>Schedule a personalized demo and explore how Bankerise can power your digital banking transformation.</p>
        <a href="contact.php" class="btn-primary text-lg !py-4 !px-10" data-animate>Request a Demo <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg></a>
      </div>
    </section>

  </main>
  <?php include 'includes/footer.php'; ?>
  <script src="assets/js/shared.js"></script>
</body>
</html>
