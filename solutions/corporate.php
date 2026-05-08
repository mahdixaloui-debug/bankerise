<?php
$pageTitle = 'Corporate Banking Solution — Bankerise®';
$pageDescription = 'Bankerise Corporate Banking — Accelerate business growth with a one-stop digital platform for corporate clients, SME lending, and business account management.';
$isSubfolder = true;
include '../includes/head.php';
?>
  <link rel="stylesheet" href="../assets/css/pages/solution-corporate.css">
</head>
<body class="font-montserrat bg-dark text-white">
  <?php include '../includes/navbar.php'; ?>

  <main id="main-content">

    <!-- ═══════════════════════════════════════════
         SPLIT HERO + DATA TICKER
         ═══════════════════════════════════════════ -->
    <section class="corp-hero">
      <div class="corp-hero-bg">
        <img src="../assets/images/solutions/corporate-treasury.jpg" alt="Corporate Treasury Dashboard">
      </div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10 pt-32 pb-16">
        <!-- Breadcrumb -->
        <nav class="mb-8" data-animate aria-label="Breadcrumb">
          <ol class="flex items-center gap-2 text-sm">
            <li><a href="../index.php" class="breadcrumb-link">Home</a></li>
            <li class="text-gray-600">/</li>
            <li><a href="../product.php" class="breadcrumb-link">Product</a></li>
            <li class="text-gray-600">/</li>
            <li class="corp-accent font-medium">Corporate Banking</li>
          </ol>
        </nav>

        <div class="max-w-3xl" data-animate>
          <div class="hero-badge">
            <div class="badge-icon">
              <svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            </div>
            Enterprise Grade
          </div>
          
          <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
            Corporate Banking.<br>
            <span class="corp-accent">Growth Accelerated.</span>
          </h1>
          
          <p class="text-lg text-gray-400 max-w-xl mb-10 leading-relaxed">
            Empower your business clients with a comprehensive digital platform. From multi-signatory onboarding to complex trade finance, deliver a seamless corporate experience.
          </p>
          
          <div class="flex flex-wrap gap-4">
            <a href="../contact.php" class="btn-primary" style="background: linear-gradient(135deg, #766CFF, #5B52E0);">Request a Demo <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg></a>
            <a href="../product.php" class="btn-ghost">Explore Platform</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Data Ticker Strip -->
    <div class="corp-ticker" data-animate>
      <div class="corp-ticker-track">
        <div class="corp-ticker-item">Faster Onboarding <span class="ticker-dot"></span> <span class="ticker-value">80%</span></div>
        <div class="corp-ticker-item">Loan Processing Speed <span class="ticker-dot"></span> <span class="ticker-value">5x</span></div>
        <div class="corp-ticker-item">Operational Cost Reduction <span class="ticker-dot"></span> <span class="ticker-value">45%</span></div>
        <div class="corp-ticker-item">Platform Uptime <span class="ticker-dot"></span> <span class="ticker-value">99.99%</span></div>
        <div class="corp-ticker-item">Faster Onboarding <span class="ticker-dot"></span> <span class="ticker-value">80%</span></div>
        <div class="corp-ticker-item">Loan Processing Speed <span class="ticker-dot"></span> <span class="ticker-value">5x</span></div>
        <div class="corp-ticker-item">Operational Cost Reduction <span class="ticker-dot"></span> <span class="ticker-value">45%</span></div>
        <div class="corp-ticker-item">Platform Uptime <span class="ticker-dot"></span> <span class="ticker-value">99.99%</span></div>
        <!-- Duplicated for seamless scrolling -->
        <div class="corp-ticker-item">Faster Onboarding <span class="ticker-dot"></span> <span class="ticker-value">80%</span></div>
        <div class="corp-ticker-item">Loan Processing Speed <span class="ticker-dot"></span> <span class="ticker-value">5x</span></div>
      </div>
    </div>

    <!-- ═══════════════════════════════════════════
         BENTO GRID FEATURES
         ═══════════════════════════════════════════ -->
    <section class="section-spacing-lg bg-dark2">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16" data-animate>
          <p class="eyebrow text-[#766CFF]">WHY BANKERISE</p>
          <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6">Enhance interactions with <br><span class="corp-accent">business customers</span></h2>
          <p class="text-gray-400 text-lg">Simplify complex business banking with tailored experiences for SMEs and large corporations.</p>
        </div>

        <div class="corp-bento" data-animate="scale">
          <!-- Featured Large Card -->
          <div class="corp-bento-card corp-bento-card--featured">
            <div class="flex flex-col h-full">
              <div class="corp-bento-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
              </div>
              <h3 class="text-2xl font-bold mb-3">Effortless Company Onboarding</h3>
              <p class="text-gray-400 mb-8 max-w-md">Digitize the entire corporate KYC process. Support multi-signatory approvals, UBO declarations, and instant account provisioning without branch visits.</p>
              
              <div class="corp-bento-image mt-auto border border-white/5">
                <img src="../assets/images/solutions/corporate-meeting.jpg" alt="Corporate Onboarding">
              </div>
            </div>
          </div>

          <!-- Tall Card -->
          <div class="corp-bento-card corp-bento-card--tall">
            <div class="corp-bento-icon">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <h3 class="text-xl font-bold mb-3">SME Lending Pipeline</h3>
            <p class="text-gray-400 text-sm mb-6">Streamline commercial loan origination with automated document collection, credit scoring integrations, and multi-level approval workflows.</p>
            
            <div class="space-y-4">
              <div class="flex justify-between text-sm"><span class="text-gray-400">TechCorp Ltd.</span><span class="text-[#766CFF] font-bold">$2.5M</span></div>
              <div class="w-full bg-white/10 rounded-full h-1.5"><div class="bg-[#766CFF] h-1.5 rounded-full" style="width:75%"></div></div>
              
              <div class="flex justify-between text-sm pt-2"><span class="text-gray-400">Al-Noor Holdings</span><span class="text-[#766CFF] font-bold">$8.1M</span></div>
              <div class="w-full bg-white/10 rounded-full h-1.5"><div class="bg-[#766CFF] h-1.5 rounded-full" style="width:40%"></div></div>
              
              <div class="flex justify-between text-sm pt-2"><span class="text-gray-400">Sahara Industries</span><span class="text-[#766CFF] font-bold">$1.2M</span></div>
              <div class="w-full bg-white/10 rounded-full h-1.5"><div class="bg-[#766CFF] h-1.5 rounded-full" style="width:90%"></div></div>
            </div>
          </div>

          <!-- Normal Card 1 -->
          <div class="corp-bento-card">
            <div class="corp-bento-icon">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="text-lg font-bold mb-2">Trade Finance</h3>
            <p class="text-gray-400 text-sm">Digitize Letters of Credit and Guarantees for faster global trade operations.</p>
          </div>

          <!-- Normal Card 2 -->
          <div class="corp-bento-card">
            <div class="corp-bento-icon">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <h3 class="text-lg font-bold mb-2">Cash Management</h3>
            <p class="text-gray-400 text-sm">Real-time liquidity visibility and bulk payment processing capabilities.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         ANIMATED WORKFLOW TIMELINE
         ═══════════════════════════════════════════ -->
    <section class="section-spacing-lg">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
          <div data-animate>
            <p class="eyebrow text-[#766CFF]">AUTOMATED COMPLIANCE</p>
            <h3 class="text-3xl font-bold mb-6">Zero-friction <span class="corp-accent">account setup</span></h3>
            <p class="text-gray-400 mb-8 leading-relaxed">Corporate onboarding involves complex compliance checks and multiple stakeholders. Our platform orchestrates the entire workflow automatically, keeping everyone informed while reducing setup time from weeks to days.</p>
            
            <div class="corp-timeline">
              <div class="corp-timeline-item">
                <div class="corp-timeline-dot"><div class="dot-inner"></div></div>
                <div class="corp-timeline-content">
                  <h4 class="font-bold mb-1">Company Registration</h4>
                  <p class="text-sm text-gray-400">Digital capture of business details and foundational documents via secure portal.</p>
                </div>
              </div>
              <div class="corp-timeline-item">
                <div class="corp-timeline-dot"><div class="dot-inner"></div></div>
                <div class="corp-timeline-content">
                  <h4 class="font-bold mb-1">Director Verification</h4>
                  <p class="text-sm text-gray-400">Automated eKYC links sent to all authorized signatories and UBOs.</p>
                </div>
              </div>
              <div class="corp-timeline-item">
                <div class="corp-timeline-dot"><div class="dot-inner"></div></div>
                <div class="corp-timeline-content">
                  <h4 class="font-bold mb-1">Compliance Check</h4>
                  <p class="text-sm text-gray-400">Instant AML/CFT screening and algorithmic risk assessment scoring.</p>
                </div>
              </div>
              <div class="corp-timeline-item">
                <div class="corp-timeline-dot" style="border-color: #22C55E; background: rgba(34, 197, 94, 0.1);"><div class="dot-inner" style="background: #22C55E;"></div></div>
                <div class="corp-timeline-content border-l-2 border-l-[#22C55E]">
                  <h4 class="font-bold text-[#22C55E] mb-1">Account Activation</h4>
                  <p class="text-sm text-gray-400">Instant access granted to web and mobile corporate banking channels.</p>
                </div>
              </div>
            </div>
          </div>

          <div data-animate="right">
            <div class="glass-card p-8 text-center border-t-2 border-t-[#766CFF]">
              <div class="w-20 h-20 rounded-full bg-[#766CFF]/10 flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-[#766CFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              </div>
              <h3 class="text-2xl font-bold mb-2">Ready for Business</h3>
              <p class="text-gray-400 mb-6">Accelerate time-to-revenue with automated corporate provisioning.</p>
              <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 rounded-full text-sm">
                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                System Operational
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



    <!-- ═══════════════════════════════════════════
         ADDED VALUE
         ═══════════════════════════════════════════ -->
    <section class="section-spacing-lg bg-dark2">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16" data-animate>
          <p class="eyebrow text-[#766CFF]">OUR ADDED VALUE</p>
          <h2 class="text-3xl sm:text-4xl font-bold mb-6">Gain a competitive <span class="corp-accent">advantage</span></h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6" data-animate>
          <div class="glass-card p-6 text-center hover:border-[#766CFF]/30">
            <div class="w-12 h-12 rounded-full bg-[#766CFF]/10 flex items-center justify-center mx-auto mb-4">
              <svg class="w-6 h-6 text-[#766CFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V7m0 1v8m0 0v1"/></svg>
            </div>
            <h4 class="font-bold text-sm mb-2">Revenue Growth</h4>
            <p class="text-gray-500 text-xs">Increase cross-sell ratios with targeted product recommendations.</p>
          </div>
          <div class="glass-card p-6 text-center hover:border-[#766CFF]/30">
            <div class="w-12 h-12 rounded-full bg-[#766CFF]/10 flex items-center justify-center mx-auto mb-4">
              <svg class="w-6 h-6 text-[#766CFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <h4 class="font-bold text-sm mb-2">Operational Speed</h4>
            <p class="text-gray-500 text-xs">Automate manual processes and reduce time-to-market for new products.</p>
          </div>
          <div class="glass-card p-6 text-center hover:border-[#766CFF]/30">
            <div class="w-12 h-12 rounded-full bg-[#766CFF]/10 flex items-center justify-center mx-auto mb-4">
              <svg class="w-6 h-6 text-[#766CFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <h4 class="font-bold text-sm mb-2">Risk Mitigation</h4>
            <p class="text-gray-500 text-xs">Real-time compliance monitoring and automated regulatory reporting.</p>
          </div>
          <div class="glass-card p-6 text-center hover:border-[#766CFF]/30">
            <div class="w-12 h-12 rounded-full bg-[#766CFF]/10 flex items-center justify-center mx-auto mb-4">
              <svg class="w-6 h-6 text-[#766CFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h4 class="font-bold text-sm mb-2">Client Loyalty</h4>
            <p class="text-gray-500 text-xs">Digital-first experience that fosters deeper relationships and retention.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         OTHER SOLUTIONS
         ═══════════════════════════════════════════ -->
    <section class="section-spacing-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-animate>
          <p class="eyebrow text-[#766CFF]">EXPLORE MORE</p>
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
      <div class="mesh-gradient"><div class="blob blob-1" style="background:#766CFF"></div><div class="blob blob-2" style="background:#5B52E0"></div></div>
      <div class="absolute inset-0 bg-dark/70 pointer-events-none"></div>
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6" data-animate>Ready to transform <span class="corp-accent">corporate banking</span>?</h2>
        <p class="text-gray-300 text-lg max-w-2xl mx-auto mb-10" data-animate>Schedule a personalized demo and explore how Bankerise can power your corporate banking digital transformation.</p>
        <a href="../contact.php" class="btn-primary text-lg !py-4 !px-10" style="background: linear-gradient(135deg, #766CFF, #5B52E0);" data-animate>Request a Demo <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg></a>
      </div>
    </section>

  </main>
  <?php include '../includes/footer.php'; ?>
  <script src="../assets/js/shared.js"></script>
</body>
</html>
