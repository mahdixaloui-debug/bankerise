<?php
$pageTitle = 'Retail Banking Solution — Bankerise®';
$pageDescription = 'Bankerise Retail Banking — Deliver excellence for your banking app. Engage customers from onboarding to lending and beyond with ready-to-use digital experiences.';
$isSubfolder = true;
include '../includes/head.php';
?>
  <link rel="stylesheet" href="../assets/css/pages/solution-retail.css">
</head>
<body class="font-montserrat bg-dark text-white">
  <?php include '../includes/navbar.php'; ?>

  <main id="main-content">

    <!-- ═══════════════════════════════════════════
         VIDEO HERO + PHONE MOCKUP
         ═══════════════════════════════════════════ -->
    <section class="retail-hero noise-overlay">
      <!-- Background Video placeholder -->
      <div class="retail-hero-video">
        <video src="../assets/videos/retail-hero-bg.mp4" autoplay loop muted playsinline></video>
      </div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10 pt-32 pb-20">
        <!-- Breadcrumb -->
        <nav class="mb-8" data-animate aria-label="Breadcrumb">
          <ol class="flex items-center gap-2 text-sm">
            <li><a href="../index.php" class="breadcrumb-link">Home</a></li>
            <li class="text-gray-600">/</li>
            <li><a href="../product.php" class="breadcrumb-link">Product</a></li>
            <li class="text-gray-600">/</li>
            <li class="retail-accent font-medium">Retail Banking</li>
          </ol>
        </nav>

        <div class="max-w-3xl" data-animate>
            <div class="hero-badge">
              <div class="badge-dot"></div>
              Mobile-First Solution
            </div>
            
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
              Banking in their pockets.<br>
              <span class="gradient-text">Excellence Delivered.</span>
            </h1>
            
            <p class="text-lg text-gray-400 max-w-xl mb-10 leading-relaxed">
              Engage your customers every step of the way — from instant onboarding to 1-click loans. Our mobile-first retail platform helps your bank excel and boost market share.
            </p>
            
            <div class="flex flex-wrap gap-4">
              <a href="../contact.php" class="btn-primary">Request a Demo <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg></a>
              <a href="../product.php" class="btn-ghost">Explore Platform</a>
            </div>
          </div>


        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         STATS COUNTERS
         ═══════════════════════════════════════════ -->
    <section class="section-spacing-sm bg-dark2 border-y border-white/5">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="retail-stats-row" data-animate>
          <div class="retail-stat-card">
            <div class="retail-stat-number">60%</div>
            <div class="retail-stat-label">Faster Onboarding</div>
          </div>
          <div class="retail-stat-card">
            <div class="retail-stat-number">3x</div>
            <div class="retail-stat-label">Loan Approval Speed</div>
          </div>
          <div class="retail-stat-card">
            <div class="retail-stat-number">40%</div>
            <div class="retail-stat-label">Engagement Lift</div>
          </div>
          <div class="retail-stat-card">
            <div class="retail-stat-number">85%</div>
            <div class="retail-stat-label">Digital Adoption</div>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         CAROUSEL SECTION: CAPABILITIES
         ═══════════════════════════════════════════ -->
    <section class="section-spacing-lg">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12" data-animate>
          <div>
            <p class="eyebrow">DIGITAL LENDING & ONBOARDING</p>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold">Everything your retail <br><span class="gradient-text">customers need</span></h2>
          </div>
        </div>

        <div class="retail-carousel" data-animate="left" data-animate-delay="1">
          <!-- Card 1 -->
          <div class="retail-carousel-card">
            <div class="card-image">
              <img src="../assets/images/solutions/retail-onboarding.jpg" alt="Instant Onboarding">
            </div>
            <div class="card-body">
              <div class="w-10 h-10 rounded-xl retail-accent-bg flex items-center justify-center mb-4">
                <svg class="w-5 h-5 retail-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
              </div>
              <h3 class="text-xl font-bold mb-2">Instant Onboarding</h3>
              <p class="text-gray-400 text-sm">eKYC with biometric & face ID verification, AI-powered document scanning, and multi-product account opening.</p>
            </div>
          </div>

          <!-- Card 2 -->
          <div class="retail-carousel-card">
            <div class="card-image">
              <img src="../assets/images/solutions/retail-lending.jpg" alt="Digital Lending">
            </div>
            <div class="card-body">
              <div class="w-10 h-10 rounded-xl retail-accent-bg flex items-center justify-center mb-4">
                <svg class="w-5 h-5 retail-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V7m0 1v8m0 0v1"/></svg>
              </div>
              <h3 class="text-xl font-bold mb-2">Digital Lending</h3>
              <p class="text-gray-400 text-sm">AI-powered credit scoring, automated document collection, and instant loan origination for personal products.</p>
            </div>
          </div>

          <!-- Card 3 -->
          <div class="retail-carousel-card">
            <div class="card-image">
              <img src="../assets/images/solutions/retail-selfcare.jpg" alt="Selfcare & Insights">
            </div>
            <div class="card-body">
              <div class="w-10 h-10 rounded-xl retail-accent-bg flex items-center justify-center mb-4">
                <svg class="w-5 h-5 retail-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
              </div>
              <h3 class="text-xl font-bold mb-2">Selfcare & Insights</h3>
              <p class="text-gray-400 text-sm">Budgeting tools, spending insights, account alerts, and financial literacy features right in the app.</p>
            </div>
          </div>
          
          <!-- Card 4 -->
          <div class="retail-carousel-card">
            <div class="card-image">
              <img src="../assets/images/solutions/retail-branch.jpg" alt="Digital Branch">
            </div>
            <div class="card-body">
              <div class="w-10 h-10 rounded-xl retail-accent-bg flex items-center justify-center mb-4">
                <svg class="w-5 h-5 retail-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
              </div>
              <h3 class="text-xl font-bold mb-2">Digital Branch</h3>
              <p class="text-gray-400 text-sm">Equip staff with powerful agent apps, CRM tools, and clear data traceability for in-person support.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         CUSTOMER JOURNEY
         ═══════════════════════════════════════════ -->
    <section class="section-spacing-lg bg-dark2">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16" data-animate>
          <p class="eyebrow">SEAMLESS EXPERIENCE</p>
          <h2 class="text-3xl sm:text-4xl font-bold mb-6">The <span class="gradient-text">Retail Journey</span></h2>
          <p class="text-gray-400">A smooth, fully connected customer lifecycle that reduces friction and boosts conversion at every step.</p>
        </div>

        <div class="retail-journey" data-animate="scale">
          <div class="retail-journey-step">
            <div class="retail-journey-icon">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            </div>
            <h4 class="font-bold mb-2">1. Acquire</h4>
            <p class="text-xs text-gray-400">Digital onboarding & eKYC</p>
            <div class="retail-journey-connector"></div>
          </div>
          
          <div class="retail-journey-step">
            <div class="retail-journey-icon">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            </div>
            <h4 class="font-bold mb-2">2. Transact</h4>
            <p class="text-xs text-gray-400">Cards & daily payments</p>
            <div class="retail-journey-connector"></div>
          </div>
          
          <div class="retail-journey-step">
            <div class="retail-journey-icon">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h4 class="font-bold mb-2">3. Engage</h4>
            <p class="text-xs text-gray-400">Insights & savings goals</p>
            <div class="retail-journey-connector"></div>
          </div>
          
          <div class="retail-journey-step">
            <div class="retail-journey-icon">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <h4 class="font-bold mb-2">4. Grow</h4>
            <p class="text-xs text-gray-400">Instant loans & cross-sell</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         VIDEO PLAYER SECTION
         ═══════════════════════════════════════════ -->
    <section class="retail-video-section">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10" data-animate>
          <p class="eyebrow">SEE IT IN ACTION</p>
          <h2 class="text-3xl font-bold">Experience the App</h2>
        </div>

        <div class="retail-video-player" data-animate="scale" data-animate-delay="1" style="cursor: default;">
          <video src="../assets/videos/retail-experience.mp4" autoplay loop muted playsinline class="w-full h-full object-cover"></video>
        </div>
      </div>
    </section>



    <!-- ═══════════════════════════════════════════
         OTHER SOLUTIONS
         ═══════════════════════════════════════════ -->
    <section class="section-spacing-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-animate>
          <p class="eyebrow">EXPLORE MORE</p>
          <h2 class="text-3xl sm:text-4xl font-bold">Other Solutions</h2>
        </div>
        <div class="grid sm:grid-cols-2 gap-6 max-w-2xl mx-auto" data-animate>
          <a href="corporate.php" class="solution-feature-card group text-center border-t-2 border-t-[#766CFF]/50 hover:border-[#766CFF]/30">
            <div class="w-14 h-14 rounded-2xl bg-[#766CFF]/10 flex items-center justify-center mx-auto mb-4 transition-transform group-hover:scale-110">
              <svg class="w-7 h-7 text-[#766CFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <h3 class="text-lg font-bold mb-2 group-hover:text-[#766CFF] transition-colors">Corporate Banking</h3>
            <p class="text-gray-500 text-sm">Accelerate business growth with a comprehensive business banking solution.</p>
          </a>
          <a href="micro.php" class="solution-feature-card group text-center border-t-2 border-t-[#4799D1]/50 hover:border-[#4799D1]/30">
            <div class="w-14 h-14 rounded-2xl bg-[#4799D1]/10 flex items-center justify-center mx-auto mb-4 transition-transform group-hover:scale-110">
              <svg class="w-7 h-7 text-[#4799D1]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <h3 class="text-lg font-bold mb-2 group-hover:text-[#4799D1] transition-colors">Microfinance</h3>
            <p class="text-gray-500 text-sm">Empower microfinance agents with flexible financial inclusion solutions.</p>
          </a>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="section-spacing-lg relative overflow-hidden noise-overlay">
      <div class="mesh-gradient"><div class="blob blob-1"></div><div class="blob blob-2"></div></div>
      <div class="absolute inset-0 bg-dark/60 pointer-events-none"></div>
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6" data-animate>Ready to transform <span class="gradient-text">retail banking</span>?</h2>
        <p class="text-gray-300 text-lg max-w-2xl mx-auto mb-10" data-animate>Schedule a personalized demo and explore how Bankerise can power your retail banking digital transformation.</p>
        <a href="../contact.php" class="btn-primary text-lg !py-4 !px-10" data-animate>Request a Demo <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg></a>
      </div>
    </section>

  </main>
  <?php include '../includes/footer.php'; ?>
  <script src="../assets/js/shared.js"></script>
</body>
</html>
