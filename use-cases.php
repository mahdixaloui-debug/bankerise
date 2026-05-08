<?php
$pageTitle = 'Use Cases — Bankerise®';
$pageDescription = 'Bankerise real-world use cases — How banks across Africa, Middle East, and beyond leverage digital banking to transform check processing, proxy payments, group finance, and more.';
$pageStyles = ['assets/css/pages/use-cases.css'];
$pageScripts = ['assets/js/pages/use-cases.js?v=' . time()];
include 'includes/head.php';
?>
</head>
<body class="font-montserrat bg-dark text-white">
  <?php include 'includes/navbar.php'; ?>

  <main id="main-content">

    <!-- ═══════════════════════════════════════════
         HERO — VIDEO BACKGROUND
         ═══════════════════════════════════════════ -->
    <section class="uc-hero relative overflow-hidden" id="uc-hero">
      <style>
        .uc-hero {
          position: relative;
          min-height: 420px;
          display: flex;
          align-items: center;
          justify-content: center;
          padding: 8rem 0 4rem;
          overflow: hidden;
        }

        @media (min-width: 1024px) {
          .uc-hero {
            padding: 10rem 0 5rem;
          }
        }

        /* Background video — fills the entire section */
        .uc-hero-video {
          position: absolute;
          inset: 0;
          width: 100%;
          height: 100%;
          object-fit: cover;
          z-index: 0;
          pointer-events: none;
        }

        /* Gradient overlay: transparent at top → solid #0D0F1C at bottom */
        .uc-hero-overlay {
          position: absolute;
          inset: 0;
          z-index: 1;
          background: linear-gradient(
            to bottom,
            rgba(13, 15, 28, 0) 0%,
            rgba(13, 15, 28, 1) 100%
          );
          pointer-events: none;
        }
      </style>

      <!-- Video background (loop, muted, autoplay) -->
      <video
        class="uc-hero-video"
        autoplay
        loop
        muted
        playsinline
        src="assets/videos/7224311-uhd_3840_2160_25fps.mp4"
      ></video>

      <!-- Gradient fade overlay -->
      <div class="uc-hero-overlay"></div>

      <!-- Text content -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <p class="eyebrow" data-animate>USE CASES</p>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mb-6" data-animate data-animate-delay="1">
          Real Banks. Real Results.<br><span class="gradient-text">Proven at Scale.</span>
        </h1>
        <p class="text-lg text-gray-400 max-w-2xl mx-auto" data-animate data-animate-delay="2">
          From check digitization to proxy payments, group savings to full digital onboarding — see how financial institutions across 3 continents trust Bankerise to transform their operations.
        </p>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         USE CASES — CARD CAROUSEL
         ═══════════════════════════════════════════ -->
    <section id="use-cases-section" class="uc-section">
      <!-- Background -->
      <div class="uc-bg">
        <div class="uc-bg-gradient"></div>
        <div class="uc-bg-grid"></div>
        <div class="uc-orbital uc-orbital--1"></div>
        <div class="uc-orbital uc-orbital--2"></div>
        <div class="uc-orbital uc-orbital--3"></div>
        <canvas id="uc-particles-canvas" class="uc-particles-canvas"></canvas>
        <div class="uc-radial-glow uc-radial-glow--1"></div>
        <div class="uc-radial-glow uc-radial-glow--2"></div>
      </div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Section Header -->
        <div class="uc-section-header" data-animate>
          <p class="eyebrow">CLIENT SUCCESS STORIES</p>
          <h2>Transforming Banking <span class="gradient-text">Across Every Channel</span></h2>
          <p>Each deployment is a tailored implementation — here's how real banks achieved real impact.</p>
        </div>

        <!-- Filter Bar -->
        <div class="uc-filter-bar">
          <div class="uc-filters">
            <button class="uc-filter-btn active" data-uc-filter="all" style="--dot-color:#4DB8CD">
              <span class="uc-filter-dot"></span>All Cases
            </button>
            <button class="uc-filter-btn" data-uc-filter="clevel" style="--dot-color:#4DB8CD">
              <span class="uc-filter-dot"></span>Bank Decision Makers
            </button>
            <button class="uc-filter-btn" data-uc-filter="tech" style="--dot-color:#766CFF">
              <span class="uc-filter-dot"></span>Technology &amp; Product
            </button>
            <button class="uc-filter-btn" data-uc-filter="partner" style="--dot-color:#34D399">
              <span class="uc-filter-dot"></span>Partner Ecosystem
            </button>
          </div>
        </div>

        <!-- Marquee Carousel (cards rendered by JS) -->
        <div class="uc-marquee-wrap">
          <div class="uc-marquee-track" id="uc-marquee-track"></div>
        </div>

        <!-- Bottom CTA -->
        <div class="uc-bottom-cta">
          <div class="uc-bottom-cta-inner">
            <div class="uc-bottom-cta-text">
              <h3 class="text-xl font-bold mb-2">Have a similar challenge?</h3>
              <p class="text-sm text-gray-400">Tell us about your use case — we'll show you how Bankerise maps to your goals.</p>
            </div>
            <div class="uc-bottom-cta-actions">
              <a href="contact.php" class="btn-primary">
                Discuss Your Use Case
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
              </a>
              <a href="product.php" class="btn-ghost">Explore the Platform</a>
            </div>
          </div>
        </div>

      </div>
    </section>

  </main>
  <?php include 'includes/footer.php'; ?>
  <script src="assets/js/shared.js"></script>
</body>
</html>
