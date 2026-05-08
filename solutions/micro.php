<?php
$pageTitle = 'Microfinance Solution — Bankerise®';
$pageDescription = 'Bankerise Microfinance — Flexible and customizable digital platform for Microfinance institutions. Empower agents on the ground with financial inclusion solutions.';
$isSubfolder = true;
include '../includes/head.php';
?>
  <link rel="stylesheet" href="../assets/css/pages/solution-micro.css">
</head>
<body class="font-montserrat bg-dark text-white">
  <?php include '../includes/navbar.php'; ?>

  <main id="main-content">

    <!-- ═══════════════════════════════════════════
         CINEMATIC PARALLAX HERO
         ═══════════════════════════════════════════ -->
    <section class="micro-hero">
      <div class="micro-hero-bg">
        <img src="../assets/images/solutions/micro-field-agent.jpg" alt="Microfinance Field Agent">
      </div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative micro-hero-content pt-32 pb-20">
        <!-- Breadcrumb -->
        <nav class="mb-8" data-animate aria-label="Breadcrumb">
          <ol class="flex items-center gap-2 text-sm">
            <li><a href="../index.php" class="breadcrumb-link">Home</a></li>
            <li class="text-gray-400">/</li>
            <li><a href="../product.php" class="breadcrumb-link">Product</a></li>
            <li class="text-gray-400">/</li>
            <li class="micro-accent font-medium">Microfinance</li>
          </ol>
        </nav>

        <div class="max-w-3xl" data-animate>
          <div class="hero-badge">
            <div class="badge-pulse"></div>
            Financial Inclusion
          </div>
          
          <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold leading-tight mb-6">
            Empower communities.<br>
            <span class="micro-gradient-text">Digitally.</span>
          </h1>
          
          <p class="text-lg sm:text-xl text-gray-300 max-w-2xl mb-10 leading-relaxed font-medium">
            Take banking to the last mile. Equip your field agents with offline-first tablets and flexible group lending tools designed specifically for the realities of microfinance.
          </p>
          
          <div class="flex flex-wrap gap-4">
            <a href="../contact.php" class="btn-primary" style="background: linear-gradient(135deg, #4799D1, #4C4E89);">Request a Demo <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg></a>
            <a href="../product.php" class="btn-ghost">Explore Platform</a>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         LARGE IMPACT TYPOGRAPHY
         ═══════════════════════════════════════════ -->
    <section class="section-spacing-lg bg-dark relative">
      <!-- Decorative grain -->
      <div class="absolute inset-0 noise-overlay pointer-events-none"></div>
      
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16" data-animate>
          <p class="eyebrow text-[#4799D1]">MEASURABLE IMPACT</p>
          <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6">Transforming the <span class="micro-gradient-text">economics of inclusion</span></h2>
        </div>

        <div class="micro-impact-grid" data-animate="scale">
          <div class="micro-impact-card">
            <div class="micro-impact-number">75%</div>
            <div class="micro-impact-label">Faster Disbursement</div>
            <div class="micro-impact-desc">Reduce waiting times for borrowers by automating document collection and approval workflows directly from the field.</div>
          </div>
          
          <div class="micro-impact-card">
            <div class="micro-impact-number">50%</div>
            <div class="micro-impact-label">Cost Reduction</div>
            <div class="micro-impact-desc">Lower the cost to serve by digitizing paper-heavy processes and enabling offline synchronization for rural areas.</div>
          </div>
          
          <div class="micro-impact-card">
            <div class="micro-impact-number">2x</div>
            <div class="micro-impact-label">Agent Productivity</div>
            <div class="micro-impact-desc">Double the number of clients each agent can serve per day with intuitive mobile tools and biometric verification.</div>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         FULL-BLEED IMAGE STRIP 1
         ═══════════════════════════════════════════ -->
    <div class="micro-image-strip">
      <img src="../assets/images/solutions/micro-community.jpg" alt="Microfinance Community">
      <div class="strip-content" data-animate>
        <div class="strip-quote">"Technology should adapt to communities, not force communities to adapt to technology."</div>
      </div>
    </div>

    <!-- ═══════════════════════════════════════════
         CORE FEATURES / AGENT EMPOWERMENT
         ═══════════════════════════════════════════ -->
    <section class="section-spacing-lg bg-dark2">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
          <div data-animate>
            <p class="eyebrow text-[#4799D1]">AGENT EMPOWERMENT</p>
            <h3 class="text-3xl font-bold mb-4">Digital tools for the <span class="micro-gradient-text">field</span></h3>
            <p class="text-gray-400 mb-6 leading-relaxed">Ensure your agents have everything they need right on their tablets. Our digital engagement platform includes AI document scanning, offline-sync capabilities, and robust eKYC designed for challenging connectivity environments.</p>
            <ul class="space-y-3 mb-8">
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-[#4799D1] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Offline-first architecture for rural areas</li>
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-[#4799D1] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>AI-powered document scanning & identity verification</li>
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-[#4799D1] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Biometric authentication integration</li>
              <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-[#4799D1] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Group lending & solidarity-based models</li>
            </ul>
          </div>
          <div data-animate="right">
            <div class="micro-img-showcase aspect-[4/3]">
              <img src="../assets/images/solutions/micro-tablet-app.jpg" alt="Agent Tablet App">
              <div class="img-overlay"></div>
              <div class="img-label">
                <div class="dot"></div>
                Field Agent Dashboard
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         FIELD AGENT VIDEO SECTION
         ═══════════════════════════════════════════ -->
    <section class="micro-video-section section-spacing-lg">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="micro-video-wrapper">
          <div class="micro-video-player order-2 lg:order-1" data-animate="left" style="cursor: default;">
            <video src="../assets/videos/micro-field-day.mp4" autoplay loop muted playsinline class="w-full h-full object-cover"></video>
          </div>

          <div class="micro-video-info order-1 lg:order-2" data-animate="right">
            <div class="info-eyebrow">SEE IT IN ACTION</div>
            <h3>Connecting the unconnected</h3>
            <p>Follow Amina, a microfinance field agent, as she uses the Bankerise platform to onboard clients, process loans, and collect repayments in remote villages without reliable internet.</p>
            <ul class="space-y-4 mb-6">
              <li class="flex items-start gap-3">
                <div class="w-6 h-6 rounded-full bg-[#4799D1]/20 flex items-center justify-center flex-shrink-0 mt-0.5"><span class="w-2 h-2 rounded-full bg-[#4799D1]"></span></div>
                <div class="text-sm text-gray-300">Syncs data automatically when back online</div>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-6 h-6 rounded-full bg-[#4799D1]/20 flex items-center justify-center flex-shrink-0 mt-0.5"><span class="w-2 h-2 rounded-full bg-[#4799D1]"></span></div>
                <div class="text-sm text-gray-300">Captures signatures digitally</div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         COVERAGE MAP VISUALIZATION
         ═══════════════════════════════════════════ -->
    <section class="section-spacing-lg bg-dark">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16" data-animate>
          <p class="eyebrow text-[#4799D1]">REACH & SCALE</p>
          <h2 class="text-3xl sm:text-4xl font-bold mb-6">Built for <span class="micro-gradient-text">scale</span></h2>
          <p class="text-gray-400">Manage thousands of agents and millions of micro-transactions seamlessly.</p>
        </div>

        <div class="micro-reach-grid" data-animate="scale">
          <div class="micro-reach-card">
            <div class="micro-reach-icon">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div class="micro-reach-value">10k+</div>
            <div class="micro-reach-label">Agents Supported</div>
          </div>
          
          <div class="micro-reach-card">
            <div class="micro-reach-icon">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <div class="micro-reach-value"><0.1s</div>
            <div class="micro-reach-label">Transaction Speed</div>
          </div>

          <div class="micro-reach-card">
            <div class="micro-reach-icon">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="micro-reach-value">Multi</div>
            <div class="micro-reach-label">Language/Currency</div>
          </div>

          <div class="micro-reach-card">
            <div class="micro-reach-icon">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="micro-reach-value">99.9%</div>
            <div class="micro-reach-label">Offline Reliability</div>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         OTHER SOLUTIONS
         ═══════════════════════════════════════════ -->
    <section class="section-spacing-sm bg-dark2">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-animate>
          <p class="eyebrow text-[#4799D1]">EXPLORE MORE</p>
          <h2 class="text-3xl sm:text-4xl font-bold">Other Solutions</h2>
        </div>
        <div class="grid sm:grid-cols-2 gap-6 max-w-2xl mx-auto" data-animate>
          <a href="retail.php" class="solution-feature-card group text-center border-t-2 border-t-[#4DB8CD]/50 hover:border-[#4DB8CD]/30">
            <div class="w-14 h-14 rounded-2xl bg-[#4DB8CD]/10 flex items-center justify-center mx-auto mb-4 transition-transform group-hover:scale-110">
              <svg class="w-7 h-7 text-[#4DB8CD]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <h3 class="text-lg font-bold mb-2 group-hover:text-[#4DB8CD] transition-colors">Retail Banking</h3>
            <p class="text-gray-500 text-sm">Deliver excellence for your retail banking customers.</p>
          </a>
          <a href="corporate.php" class="solution-feature-card group text-center border-t-2 border-t-[#766CFF]/50 hover:border-[#766CFF]/30">
            <div class="w-14 h-14 rounded-2xl bg-[#766CFF]/10 flex items-center justify-center mx-auto mb-4 transition-transform group-hover:scale-110">
              <svg class="w-7 h-7 text-[#766CFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <h3 class="text-lg font-bold mb-2 group-hover:text-[#766CFF] transition-colors">Corporate Banking</h3>
            <p class="text-gray-500 text-sm">Accelerate business growth with a comprehensive business banking solution.</p>
          </a>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="section-spacing-lg relative overflow-hidden noise-overlay">
      <div class="mesh-gradient"><div class="blob blob-1" style="background:#4799D1"></div><div class="blob blob-2" style="background:#4C4E89"></div></div>
      <div class="absolute inset-0 bg-dark/80 pointer-events-none"></div>
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6" data-animate>Ready to transform <span class="micro-gradient-text">microfinance</span>?</h2>
        <p class="text-gray-300 text-lg max-w-2xl mx-auto mb-10" data-animate>Schedule a personalized demo and explore how Bankerise can power your microfinance digital transformation.</p>
        <a href="../contact.php" class="btn-primary text-lg !py-4 !px-10" style="background: linear-gradient(135deg, #4799D1, #4C4E89);" data-animate>Request a Demo <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg></a>
      </div>
    </section>

  </main>
  <?php include '../includes/footer.php'; ?>
  <script src="../assets/js/shared.js"></script>
</body>
</html>
