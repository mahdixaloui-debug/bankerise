<?php
$pageTitle = 'Bankerise® — Experience Banking beyond Transactions';
$pageDescription = 'Bankerise — The B2B digital banking platform helping financial institutions accelerate digital transformation through onboarding, lending, omnichannel engagement, and partner-driven growth.';
$pageStyles = ['assets/css/sections/partners-section.css'];
include 'includes/head.php';
?>
</head>

<body class="font-montserrat bg-dark text-white">

  <!-- Navbar -->
  <?php include 'includes/navbar.php'; ?>

  <!-- Main Content -->
  <main id="main-content">
    <!-- ═══════════════════════════════════════════
         SECTION 1: HERO
         ═══════════════════════════════════════════ -->
    <section class="relative min-h-screen flex items-center overflow-hidden">
      <!-- Full-width Background Image -->
      <div class="absolute inset-0 z-0">
        <img src="assets/images/hero-bg.jpg" alt="" class="w-full h-full object-cover" loading="eager">
        <!-- Dark overlay gradients for text readability -->
        <div class="absolute inset-0 bg-gradient-to-r from-dark/95 via-dark/80 to-dark/50"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-dark via-transparent to-dark/60"></div>
        <!-- Subtle brand color overlay -->
        <div class="absolute inset-0 bg-pacific/5 mix-blend-overlay"></div>
      </div>

      <!-- Noise texture -->
      <div class="absolute inset-0 noise-overlay pointer-events-none z-[1]"></div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32 relative z-10 w-full">
        <div class="max-w-3xl">

          <p class="eyebrow" data-animate data-animate-delay="1">B2B DIGITAL BANKING PLATFORM</p>
          <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold leading-tight mb-6" data-animate
            data-animate-delay="2">
            Experience Banking<br>
            <span class="gradient-text">beyond Transactions</span>
          </h1>
          <p class="text-lg text-gray-300 max-w-xl mb-10 leading-relaxed" data-animate data-animate-delay="3">
            Bankerise helps financial institutions modernize customer experience and accelerate digital transformation
            through a flexible, omnichannel platform.
          </p>
          <div class="flex flex-wrap gap-4 mb-12" data-animate data-animate-delay="4">
            <a href="contact.php" class="btn-primary">
              Request a Demo
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </a>
            <a href="product.php" class="btn-ghost">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Watch Overview
            </a>
          </div>
          <!-- Trust bar — bank logos + rating -->
          <div data-animate data-animate-delay="5" class="space-y-5">

            <!-- Rating row -->
            <div class="flex items-center gap-3 flex-wrap">
              <div class="flex items-center gap-1" aria-label="Rated 4.9 out of 5">
                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.363 1.118l1.287 3.957c.3.922-.755 1.688-1.539 1.118L10 15.347l-3.37 2.448c-.784.57-1.838-.196-1.539-1.118l1.287-3.957a1 1 0 00-.363-1.118L2.645 9.154c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.957z"/></svg>
                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.363 1.118l1.287 3.957c.3.922-.755 1.688-1.539 1.118L10 15.347l-3.37 2.448c-.784.57-1.838-.196-1.539-1.118l1.287-3.957a1 1 0 00-.363-1.118L2.645 9.154c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.957z"/></svg>
                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.363 1.118l1.287 3.957c.3.922-.755 1.688-1.539 1.118L10 15.347l-3.37 2.448c-.784.57-1.838-.196-1.539-1.118l1.287-3.957a1 1 0 00-.363-1.118L2.645 9.154c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.957z"/></svg>
                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.363 1.118l1.287 3.957c.3.922-.755 1.688-1.539 1.118L10 15.347l-3.37 2.448c-.784.57-1.838-.196-1.539-1.118l1.287-3.957a1 1 0 00-.363-1.118L2.645 9.154c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.957z"/></svg>
                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><defs><linearGradient id="halfStar"><stop offset="50%" stop-color="currentColor"/><stop offset="50%" stop-color="rgba(255,255,255,0.15)"/></linearGradient></defs><path fill="url(#halfStar)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.363 1.118l1.287 3.957c.3.922-.755 1.688-1.539 1.118L10 15.347l-3.37 2.448c-.784.57-1.838-.196-1.539-1.118l1.287-3.957a1 1 0 00-.363-1.118L2.645 9.154c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.957z"/></svg>
              </div>
              <p class="text-sm">
                <span class="text-white font-semibold">4.9/5</span>
                <span class="text-gray-500"> · trusted by 20+ leading banks worldwide</span>
              </p>
            </div>

            <!-- Logo strip -->
            <div class="flex items-center gap-4 sm:gap-6 overflow-x-auto no-scrollbar pb-2 sm:flex-wrap sm:overflow-visible">
              <img src="assets/images/logos/uib.jpg" alt="UIB" class="client-logo h-8 flex-shrink-0 bg-white rounded px-2 py-1">
              <img src="assets/images/logos/coris-bank.png" alt="Coris Bank" class="client-logo h-8 flex-shrink-0 bg-white rounded px-2 py-1">
              <img src="assets/images/logos/qiib.jpg" alt="QIIB" class="client-logo h-8 flex-shrink-0 bg-white rounded px-2 py-1">
              <img src="assets/images/logos/dukhan-bank.jpg" alt="Dukhan Bank" class="client-logo h-8 flex-shrink-0 bg-white rounded px-2 py-1">
              <img src="assets/images/logos/al-baraka.jpg" alt="Al Baraka" class="client-logo h-8 flex-shrink-0 bg-white rounded px-2 py-1">
            </div>
          </div>

        </div>
      </div>

      <!-- Scroll indicator -->
      <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce hidden lg:block z-10">
        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
        </svg>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         SECTION 2: SOCIAL PROOF BAR
         ═══════════════════════════════════════════ -->
    <section class="section-spacing-sm border-y border-white/5 bg-dark2">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-center text-gray-300 text-sm font-semibold tracking-wide uppercase mb-10" data-animate>Trusted by leading banks across MEA &amp; Africa</p>
        <div class="marquee-container">
          <div class="marquee-track-logos">
            <?php
              // Real Bankerise / Proxym Group bank clients (verified partners)
              $banks = [
                ['uib.png',            'UIB — Union Internationale de Banques'],
                ['amen-bank.png',      'Amen Bank'],
                ['coris-bank.png',     'Coris Bank International'],
                ['qiib.jpg',           'QIIB — Qatar International Islamic Bank'],
                ['dukhan-bank.jpg',    'Dukhan Bank'],
                ['oman-arab-bank.png', 'Oman Arab Bank'],
                ['adib.png',           'ADIB — Abu Dhabi Islamic Bank'],
                ['al-baraka.png',      'Al Baraka Bank'],
                ['arab-bank.png',      'Arab Bank'],
                ['bicici.png',         'BICICI'],
                ['bsic.png',           'BSIC'],
                ['opec.png',           'OPEC Fund'],
                ['agb.jpg',            'AGB — Gulf Bank Algeria'],
              ];
              // Render twice for seamless marquee loop
              foreach (array_merge($banks, $banks) as $b):
            ?>
            <div class="logo-cell"><img src="assets/images/logos/<?= $b[0] ?>" alt="<?= htmlspecialchars($b[1]) ?>" loading="lazy" class="client-logo"></div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         SECTION 3: VALUE PROPOSITIONS
         ═══════════════════════════════════════════ -->
    <section class="section-spacing-lg">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16" data-animate>
          <p class="eyebrow">WHY BANKERISE</p>
          <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6">One platform. Every banking journey.</h2>
          <p class="text-gray-400 text-lg">From onboarding to lending, from engagement to growth — Bankerise unifies it
            all.</p>
        </div>

        <!-- 3 Cards -->
        <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
          <!-- Card 1: Digital Onboarding -->
          <div class="glass-card glass-card-shine p-8" data-animate data-animate-delay="1">
            <div class="w-14 h-14 rounded-2xl bg-pacific/10 flex items-center justify-center mb-6">
              <svg class="w-7 h-7 text-pacific" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-3">Digital Onboarding</h3>
            <p class="text-gray-400 text-sm leading-relaxed mb-6">Seamless KYC, account opening, and identity
              verification — fully digital, fully compliant.</p>
            <p class="text-3xl font-bold gradient-text" data-count="60" data-suffix="%"
              aria-label="60% faster onboarding">0%</p>
            <p class="text-gray-500 text-sm mt-1">faster onboarding</p>
          </div>

          <!-- Card 2: Smart Lending -->
          <div class="glass-card glass-card-shine p-8" data-animate data-animate-delay="2">
            <div class="w-14 h-14 rounded-2xl bg-aqua/10 flex items-center justify-center mb-6">
              <svg class="w-7 h-7 text-aqua" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-3">Smart Lending</h3>
            <p class="text-gray-400 text-sm leading-relaxed mb-6">End-to-end loan origination, scoring, and management
              with configurable workflows.</p>
            <p class="text-3xl font-bold gradient-text" data-count="3" data-suffix="x" aria-label="3x approval speed">0x
            </p>
            <p class="text-gray-500 text-sm mt-1">approval speed</p>
          </div>

          <!-- Card 3: Omnichannel Engagement -->
          <div class="glass-card glass-card-shine p-8" data-animate data-animate-delay="3">
            <div class="w-14 h-14 rounded-2xl bg-bell/10 flex items-center justify-center mb-6">
              <svg class="w-7 h-7 text-bell" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-3">Omnichannel Engagement</h3>
            <p class="text-gray-400 text-sm leading-relaxed mb-6">Meet customers on mobile, web, branch, and API —
              consistent experience everywhere.</p>
            <p class="text-3xl font-bold gradient-text" data-count="40" data-suffix="%"
              aria-label="40% engagement lift">0%</p>
            <p class="text-gray-500 text-sm mt-1">engagement lift</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         SECTION 3.5: VIDEO DEMO (Creative Layout)
         ═══════════════════════════════════════════ -->
    <section class="section-spacing-lg relative overflow-hidden noise-overlay" id="video-demo-section">
      <!-- Background Effects from Use Cases -->
      <div class="absolute inset-0 pointer-events-none">
        <!-- Glowing Orbs -->
        <div class="absolute top-1/2 left-1/4 w-[500px] h-[500px] bg-pacific/10 rounded-full blur-[120px] -translate-y-1/2 z-0"></div>
        <div class="absolute top-1/2 right-1/4 w-[600px] h-[600px] bg-aqua/5 rounded-full blur-[150px] -translate-y-1/2 z-0"></div>
        
        <!-- Animated Orbitals -->
        <div class="absolute top-1/2 left-1/2 w-[800px] h-[800px] -translate-x-1/2 -translate-y-1/2 border border-white/5 rounded-full z-0 animate-[spin_60s_linear_infinite]"></div>
        <div class="absolute top-1/2 left-1/2 w-[1100px] h-[1100px] -translate-x-1/2 -translate-y-1/2 border border-white/5 rounded-full z-0 animate-[spin_80s_reverse_linear_infinite] border-dashed"></div>
      </div>

      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="mb-12" data-animate>
          <p class="eyebrow text-pacific">SEE IT IN ACTION</p>
          <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4">Watch the <span class="gradient-text">Platform in Action</span></h2>
          <p class="text-gray-400 text-lg max-w-2xl mx-auto">A 2-minute overview of how Bankerise transforms digital banking for financial institutions worldwide.</p>
        </div>

        <div data-animate data-animate-delay="2" class="relative group mx-auto w-full max-w-4xl">
          <!-- Main Video Container -->
          <div id="videoDemoPoster" role="button" tabindex="0" aria-label="Play platform demo video"
            class="relative w-full rounded-2xl md:rounded-[2rem] overflow-hidden border border-white/10 shadow-[0_0_50px_rgba(77,184,205,0.15)] bg-dark2 transition-transform duration-500 hover:scale-[1.02] cursor-pointer" style="aspect-ratio: 16/9;">

            <!-- Looping Video Teaser (muted preview) -->
            <video
              id="videoDemoPreview"
              class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
              autoplay
              loop
              muted
              playsinline
              preload="metadata"
              src="assets/videos/platform-demo.mp4"
            ></video>

            <!-- Overlays -->
            <div class="absolute inset-0 bg-gradient-to-t from-dark/95 via-dark/40 to-transparent pointer-events-none"></div>
            <div class="absolute inset-0 bg-pacific/10 mix-blend-overlay transition-opacity duration-500 group-hover:opacity-0 pointer-events-none"></div>

            <!-- Central Play Button -->
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
              <div class="w-16 h-16 md:w-20 md:h-20 bg-white/15 backdrop-blur-md border border-white/30 rounded-full flex items-center justify-center transition-all duration-300 group-hover:scale-110 group-hover:bg-pacific/30 group-hover:border-pacific/60 shadow-lg shadow-black/40">
                <svg class="w-6 h-6 md:w-8 md:h-8 text-white translate-x-[2px]" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M9 6.5v11a1 1 0 0 0 1.55.83l8.5-5.5a1 1 0 0 0 0-1.66l-8.5-5.5A1 1 0 0 0 9 6.5z"/>
                </svg>
              </div>
            </div>

            <!-- Bottom Video Details -->
            <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 flex flex-col sm:flex-row items-start sm:items-end justify-between pointer-events-none transition-transform duration-500 transform translate-y-2 group-hover:translate-y-0 text-left">
              <div>
                <div class="flex items-center gap-2 mb-3">
                  <span class="inline-flex items-center justify-center px-3 py-1 bg-pacific/20 border border-pacific/30 text-pacific text-[10px] md:text-xs font-bold rounded-full backdrop-blur-md uppercase tracking-wide">
                    <span class="w-1.5 h-1.5 rounded-full bg-pacific animate-pulse mr-2"></span> Platform Demo
                  </span>
                  <span class="inline-flex items-center justify-center px-3 py-1 bg-white/10 border border-white/20 text-white text-[10px] md:text-xs font-bold rounded-full backdrop-blur-md">
                    4K Ultra HD
                  </span>
                </div>
                <h3 class="text-xl md:text-3xl font-bold text-white drop-shadow-md">Bankerise Core Banking Walkthrough</h3>
              </div>
              
              <div class="mt-4 sm:mt-0 flex items-center gap-3 bg-black/60 backdrop-blur-md px-3 py-2 md:px-4 md:py-2 rounded-xl border border-white/10">
                <div class="flex flex-col text-right">
                  <span class="text-[9px] md:text-[10px] text-gray-400 uppercase tracking-widest font-semibold">Duration</span>
                  <span class="text-sm md:text-base font-bold text-white font-mono">02:34</span>
                </div>
                <!-- Animated sound waves icon -->
                <div class="flex items-end gap-[3px] h-5 md:h-6">
                  <div class="w-1 bg-pacific rounded-full animate-[pulse_1s_ease-in-out_infinite]" style="height: 40%"></div>
                  <div class="w-1 bg-pacific rounded-full animate-[pulse_1.5s_ease-in-out_infinite]" style="height: 100%"></div>
                  <div class="w-1 bg-pacific rounded-full animate-[pulse_0.8s_ease-in-out_infinite]" style="height: 60%"></div>
                  <div class="w-1 bg-pacific rounded-full animate-[pulse_1.2s_ease-in-out_infinite]" style="height: 80%"></div>
                </div>
              </div>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute top-6 left-6 right-6 hidden md:flex justify-between items-center pointer-events-none">
              <div class="flex gap-2 bg-dark/20 backdrop-blur px-3 py-1.5 rounded-full border border-white/10">
                <div class="w-1.5 h-1.5 rounded-full bg-red-400/80"></div>
                <div class="w-1.5 h-1.5 rounded-full bg-yellow-400/80"></div>
                <div class="w-1.5 h-1.5 rounded-full bg-green-400/80"></div>
              </div>
            </div>
            
          </div>
          
          <!-- Outer subtle reflection/shadow -->
          <div class="absolute -bottom-8 left-1/2 -translate-x-1/2 w-3/4 h-10 bg-pacific/20 blur-[50px] pointer-events-none rounded-full"></div>
        </div>
      </div>

      <!-- Video Lightbox Modal -->
      <div id="videoDemoModal" class="video-demo-modal" aria-hidden="true" role="dialog" aria-label="Platform demo video">
        <div class="video-demo-modal__backdrop" data-video-close></div>
        <div class="video-demo-modal__dialog">
          <button type="button" class="video-demo-modal__close" aria-label="Close video" data-video-close>&times;</button>
          <div class="video-demo-modal__frame">
            <video id="videoDemoPlayer" controls playsinline preload="none" src="assets/videos/platform-demo.mp4"></video>
          </div>
        </div>
      </div>

      <style>
        .video-demo-modal {
          position: fixed; inset: 0; z-index: 10000;
          display: flex; align-items: center; justify-content: center;
          padding: 1.5rem;
          opacity: 0; visibility: hidden;
          transition: opacity .3s ease, visibility .3s ease;
        }
        .video-demo-modal.is-open { opacity: 1; visibility: visible; }
        .video-demo-modal__backdrop {
          position: absolute; inset: 0;
          background: rgba(5, 8, 20, .85);
          backdrop-filter: blur(8px);
          -webkit-backdrop-filter: blur(8px);
        }
        .video-demo-modal__dialog {
          position: relative; width: 100%; max-width: 1100px;
          transform: scale(.96); transition: transform .35s cubic-bezier(.19,1,.22,1);
        }
        .video-demo-modal.is-open .video-demo-modal__dialog { transform: scale(1); }
        .video-demo-modal__frame {
          position: relative; width: 100%; aspect-ratio: 16/9;
          border-radius: 16px; overflow: hidden;
          background: #000;
          box-shadow: 0 30px 80px rgba(0,0,0,.6), 0 0 0 1px rgba(77,184,205,.2);
        }
        .video-demo-modal__frame video { width: 100%; height: 100%; display: block; object-fit: contain; background:#000; }
        .video-demo-modal__close {
          position: absolute; top: -14px; right: -14px;
          width: 42px; height: 42px; border-radius: 50%;
          background: #fff; color: #0f172a; border: 0;
          font-size: 26px; line-height: 1; cursor: pointer;
          display: flex; align-items: center; justify-content: center;
          box-shadow: 0 8px 20px rgba(0,0,0,.4);
          transition: transform .2s, background .2s;
          z-index: 2;
        }
        .video-demo-modal__close:hover { transform: scale(1.08) rotate(90deg); background: #00d2ff; color: #fff; }
        @media (max-width: 640px) {
          .video-demo-modal { padding: 1rem; }
          .video-demo-modal__close { top: -10px; right: -4px; width: 36px; height: 36px; font-size: 22px; }
        }
        body.video-demo-open { overflow: hidden; }
      </style>

      <script>
        (function() {
          const poster = document.getElementById('videoDemoPoster');
          const preview = document.getElementById('videoDemoPreview');
          const modal = document.getElementById('videoDemoModal');
          const player = document.getElementById('videoDemoPlayer');
          if (!poster || !modal || !player) return;

          function openVideo() {
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('video-demo-open');
            if (preview) { try { preview.pause(); } catch(e){} }
            player.currentTime = 0;
            player.muted = false;
            const p = player.play();
            if (p && p.catch) p.catch(() => { player.muted = true; player.play(); });
          }
          function closeVideo() {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('video-demo-open');
            try { player.pause(); } catch(e){}
            if (preview) { try { preview.play(); } catch(e){} }
          }

          poster.addEventListener('click', openVideo);
          poster.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openVideo(); }
          });
          modal.querySelectorAll('[data-video-close]').forEach(el => el.addEventListener('click', closeVideo));
          document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.classList.contains('is-open')) closeVideo();
          });
        })();
      </script>
    </section>

    <hr class="section-divider">

    <!-- ═══════════════════════════════════════════
         SECTION 4: PLATFORM SCROLL-STORY
         ═══════════════════════════════════════════ -->
    <link rel="stylesheet" href="assets/css/pages/index.css">

    <section class="section-spacing-lg platform-scroll" id="product-tabs">
      <div class="platform-scroll__intro" data-animate>
        <p class="eyebrow">THE PLATFORM</p>
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6">Built for modern banking</h2>
        <p class="text-gray-400 text-lg">A modular, omnichannel platform designed to let banks configure — not code — their digital transformation. Scroll to explore.</p>
      </div>

      <div class="platform-scroll__track" id="platformTrack">
        <div class="platform-scroll__sticky">
          <div class="platform-scroll__inner">
            <!-- LEFT: Text panels (swap on scroll) -->
            <div class="platform-scroll__text-wrap" id="platformTextWrap">
              <!-- Panel 1: Onboarding -->
              <div class="platform-panel is-active mobile-show" data-panel="0">
                <div class="flex items-center gap-3 mb-4">
                  <div class="w-10 h-10 rounded-xl bg-pacific/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-pacific" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                  </div>
                  <span class="text-xs font-semibold tracking-widest text-pacific">01 — DIGITAL ONBOARDING</span>
                </div>
                <h3 class="text-3xl sm:text-4xl font-bold mb-4">From prospect to active account in minutes</h3>
                <p class="text-gray-400 mb-6 leading-relaxed">Enable fast, paperless account opening with eKYC, biometric identity verification, and real-time compliance checks — fully digital, fully compliant.</p>
                <ul class="space-y-3">
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>eKYC with biometric &amp; face ID verification</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Document scanning, OCR &amp; automated validation</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Multi-product account opening</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Configurable compliance flows per jurisdiction</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Risk-based MFA (location, amount, device)</li>
                </ul>
              </div>

              <!-- Panel 2: Lending -->
              <div class="platform-panel mobile-show" data-panel="1">
                <div class="flex items-center gap-3 mb-4">
                  <div class="w-10 h-10 rounded-xl bg-aqua/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-aqua" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                  </div>
                  <span class="text-xs font-semibold tracking-widest text-aqua">02 — LENDING &amp; FINANCE</span>
                </div>
                <h3 class="text-3xl sm:text-4xl font-bold mb-4">The full financing lifecycle, automated</h3>
                <p class="text-gray-400 mb-6 leading-relaxed">From application intake and AI credit scoring to approval workflows, disbursement, and real-time portfolio monitoring — personal loans, SME, and Islamic finance.</p>
                <ul class="space-y-3">
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-aqua flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>AI-powered credit scoring with configurable models</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-aqua flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Multi-level approval workflows with SLA tracking</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-aqua flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Instant loan origination for personal &amp; SME</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-aqua flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Real-time portfolio monitoring &amp; risk dashboards</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-aqua flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Shariah-compliant lending product support</li>
                </ul>
              </div>

              <!-- Panel 3: Omnichannel -->
              <div class="platform-panel mobile-show" data-panel="2">
                <div class="flex items-center gap-3 mb-4">
                  <div class="w-10 h-10 rounded-xl bg-bell/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-bell" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                  </div>
                  <span class="text-xs font-semibold tracking-widest text-bell">03 — OMNICHANNEL BANKING</span>
                </div>
                <h3 class="text-3xl sm:text-4xl font-bold mb-4">One customer, every channel</h3>
                <p class="text-gray-400 mb-6 leading-relaxed">A unified experience across mobile, internet banking, branch tablets, and AI chatbots — every channel shares the same customer data layer.</p>
                <ul class="space-y-3">
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-bell flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Mobile-first banking apps (iOS &amp; Android)</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-bell flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Internet banking portal with full self-service</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-bell flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Direct &amp; field sales tablet application</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-bell flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Live chat, chatbot &amp; offline messaging</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-bell flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Transfers, Western Union, bill pay &amp; PFM tools</li>
                </ul>
              </div>

              <!-- Panel 4: Analytics -->
              <div class="platform-panel mobile-show" data-panel="3">
                <div class="flex items-center gap-3 mb-4">
                  <div class="w-10 h-10 rounded-xl bg-green-400/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                  </div>
                  <span class="text-xs font-semibold tracking-widest text-green-400">04 — ANALYTICS &amp; CRM</span>
                </div>
                <h3 class="text-3xl sm:text-4xl font-bold mb-4">Data intelligence built-in</h3>
                <p class="text-gray-400 mb-6 leading-relaxed">Segment customers, run campaigns, and track lifetime value from a CRM that's bundled with omnichannel banking — all from one platform.</p>
                <ul class="space-y-3">
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Real-time operational dashboards</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Customer segmentation &amp; offers (CMS)</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Predictive risk models &amp; churn detection</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Regulatory reporting automation</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Third-party loyalty apps integration</li>
                </ul>
              </div>

              <!-- Panel 5: Partner Portal -->
              <div class="platform-panel mobile-show" data-panel="4">
                <div class="flex items-center gap-3 mb-4">
                  <div class="w-10 h-10 rounded-xl bg-grape/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-aqua" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                  </div>
                  <span class="text-xs font-semibold tracking-widest text-grape">05 — PARTNER PORTAL</span>
                </div>
                <h3 class="text-3xl sm:text-4xl font-bold mb-4">Scale your indirect sales engine</h3>
                <p class="text-gray-400 mb-6 leading-relaxed">A dedicated workspace for channel partners to manage deals, track commissions, access training, and download sales collateral — built to scale across regions.</p>
                <ul class="space-y-3">
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-grape flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Deal registration &amp; pipeline management</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-grape flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Automated commission tracking &amp; payout reports</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-grape flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Sales playbooks, pitch decks &amp; collateral library</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-grape flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Training, certification &amp; Bankerise Academy</li>
                  <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-grape flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Regional exclusivity &amp; territory management</li>
                </ul>
              </div>
            </div>

            <!-- RIGHT: Media/Video panels (swap on scroll) -->
            <div class="platform-scroll__media-wrap" id="platformMediaWrap">
              <div class="platform-media is-active mobile-show" data-media="0">
                <video src="assets/videos/platform/onboarding.mp4" poster="assets/images/platform/onboarding.png" autoplay muted loop playsinline></video>
                <span class="platform-media__badge"><span class="platform-media__badge-dot" style="background:#079bc5"></span>eKYC · Face ID · Biometric Scan</span>
              </div>
              <div class="platform-media mobile-show" data-media="1">
                <video src="assets/videos/platform/lending.mp4" poster="assets/images/platform/lending.png" autoplay muted loop playsinline></video>
                <span class="platform-media__badge"><span class="platform-media__badge-dot" style="background:#4ade80"></span>Credit Scoring · Decision Engine · SME Lending</span>
              </div>
              <div class="platform-media mobile-show" data-media="2">
                <video src="assets/videos/platform/omnichannel.mp4" poster="assets/images/platform/omnichannel.png" autoplay muted loop playsinline></video>
                <span class="platform-media__badge"><span class="platform-media__badge-dot" style="background:#f59e0b"></span>Mobile · Web · Tablet · AI Chatbot</span>
              </div>
              <div class="platform-media mobile-show" data-media="3">
                <video src="assets/videos/platform/analytics.mp4" poster="assets/images/platform/analytics.png" autoplay muted loop playsinline></video>
                <span class="platform-media__badge"><span class="platform-media__badge-dot" style="background:#4ade80"></span>Live Dashboards · CRM · Predictive Analytics</span>
              </div>
              <div class="platform-media mobile-show" data-media="4">
                <video src="assets/videos/platform/partners.mp4" poster="assets/images/platform/partners.png" autoplay muted loop playsinline></video>
                <span class="platform-media__badge"><span class="platform-media__badge-dot" style="background:#a855f7"></span>Deal Pipeline · Commissions · Training</span>
              </div>
            </div>
          </div>

          <!-- Progress dots -->
          <nav class="platform-scroll__steps" aria-label="Platform sections">
            <button class="platform-step-dot is-active" data-dot="0" aria-label="Digital Onboarding"></button>
            <button class="platform-step-dot" data-dot="1" aria-label="Lending &amp; Finance"></button>
            <button class="platform-step-dot" data-dot="2" aria-label="Omnichannel Banking"></button>
            <button class="platform-step-dot" data-dot="3" aria-label="Analytics &amp; CRM"></button>
            <button class="platform-step-dot" data-dot="4" aria-label="Partner Portal"></button>
          </nav>
        </div>

        <!-- scroll spacer: drives step progression -->
        <div class="platform-scroll__spacer" aria-hidden="true"></div>
      </div>
    </section>

    <script src="assets/js/pages/index.js?v=<?= $assetVersion ?>"></script>

    <section style="display:none;" data-legacy-tabs>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-3 mb-12">
          <button class="tab-btn active" data-tab="onboarding">Digital Onboarding</button>
          <button class="tab-btn" data-tab="lending">Lending & Finance</button>
          <button class="tab-btn" data-tab="engagement">Omnichannel Banking</button>
          <button class="tab-btn" data-tab="analytics">Analytics & CRM</button>
          <button class="tab-btn" data-tab="partner-portal">Partner Portal</button>
        </div>

        <!-- Tab contents -->
        <div>
          <!-- Digital Onboarding Tab -->
          <div class="tab-content active flex flex-col lg:flex-row items-center gap-12" data-tab-content="onboarding">
            <div class="lg:w-1/2">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-pacific/10 flex items-center justify-center">
                  <svg class="w-5 h-5 text-pacific" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                  </svg>
                </div>
                <h3 class="text-2xl font-bold">Digital Onboarding</h3>
              </div>
              <p class="text-gray-400 mb-6 leading-relaxed">Enable fast, paperless account opening with eKYC, biometric identity verification, and real-time compliance checks. Customers go from prospect to active account in minutes — fully digital, fully compliant.</p>
              <ul class="space-y-3 mb-8">
                <li class="flex items-center gap-3 text-gray-300">
                  <svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                  eKYC with biometric & face ID verification
                </li>
                <li class="flex items-center gap-3 text-gray-300">
                  <svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                  Document scanning, OCR & automated validation
                </li>
                <li class="flex items-center gap-3 text-gray-300">
                  <svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                  Multi-product account opening (savings, current, cards)
                </li>
                <li class="flex items-center gap-3 text-gray-300">
                  <svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                  Configurable compliance flows per jurisdiction
                </li>
                <li class="flex items-center gap-3 text-gray-300">
                  <svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                  Risk-based MFA (location, amount, device)
                </li>
              </ul>
              <a href="product.php#onboarding" class="text-pacific font-semibold text-sm hover:underline inline-flex items-center gap-2">
                Explore Onboarding module
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
              </a>
            </div>
            <div class="lg:w-1/2">
              <div class="relative group rounded-2xl overflow-hidden shadow-2xl shadow-pacific/10">
                <img src="assets/images/platform/onboarding.png" alt="Digital banking onboarding — biometric verification on mobile" class="w-full h-auto object-cover rounded-2xl transition-transform duration-700 group-hover:scale-[1.03]" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-dark/80 via-dark/20 to-transparent rounded-2xl"></div>
                <div class="absolute bottom-5 left-5 right-5 flex items-center justify-between">
                  <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-dark/60 backdrop-blur-md border border-white/10 text-xs font-semibold text-white">
                    <span class="w-2 h-2 bg-pacific rounded-full animate-pulse"></span>
                    eKYC · Face ID · Biometric Scan
                  </span>
                </div>
              </div>
            </div>
          </div>

          <!-- Lending & Finance Tab -->
          <div class="tab-content flex-col lg:flex-row items-center gap-12" data-tab-content="lending">
            <div class="lg:w-1/2">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-aqua/10 flex items-center justify-center">
                  <svg class="w-5 h-5 text-aqua" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </div>
                <h3 class="text-2xl font-bold">Lending & Finance</h3>
              </div>
              <p class="text-gray-400 mb-6 leading-relaxed">Streamline the entire financing lifecycle — from application intake and automated credit scoring to approval workflows, disbursement, and real-time portfolio monitoring. Supports personal loans, SME lending, and Islamic finance products.</p>
              <ul class="space-y-3 mb-8">
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>AI-powered credit scoring with configurable models</li>
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Multi-level approval workflows with SLA tracking</li>
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Instant loan origination for personal & SME products</li>
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Real-time portfolio monitoring & risk dashboards</li>
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Shariah-compliant lending product support</li>
              </ul>
              <a href="product.php#lending" class="text-pacific font-semibold text-sm hover:underline inline-flex items-center gap-2">Explore Lending module <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg></a>
            </div>
            <div class="lg:w-1/2">
              <div class="relative group rounded-2xl overflow-hidden shadow-2xl shadow-aqua/10">
                <img src="assets/images/platform/lending.png" alt="AI-powered credit scoring and loan decision engine" class="w-full h-auto object-cover rounded-2xl transition-transform duration-700 group-hover:scale-[1.03]" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-dark/80 via-dark/20 to-transparent rounded-2xl"></div>
                <div class="absolute bottom-5 left-5 right-5 flex items-center justify-between">
                  <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-dark/60 backdrop-blur-md border border-white/10 text-xs font-semibold text-white">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    Credit Scoring · Decision Engine · SME Lending
                  </span>
                </div>
              </div>
            </div>
          </div>

          <!-- Omnichannel Banking Tab -->
          <div class="tab-content flex-col lg:flex-row items-center gap-12" data-tab-content="engagement">
            <div class="lg:w-1/2">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-bell/10 flex items-center justify-center">
                  <svg class="w-5 h-5 text-bell" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                  </svg>
                </div>
                <h3 class="text-2xl font-bold">Omnichannel Banking</h3>
              </div>
              <p class="text-gray-400 mb-6 leading-relaxed">Deliver a seamless, unified experience across mobile banking, internet banking, branch tablet apps, and AI chatbots. Every channel shares the same customer data layer, ensuring consistency at every touchpoint.</p>
              <ul class="space-y-3 mb-8">
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Mobile-first banking apps (iOS & Android)</li>
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Internet banking portal with full self-service</li>
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Direct & field sales tablet application</li>
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Live chat, chatbot & offline messaging integration</li>
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Transfers, Western Union, bill pay & PFM tools</li>
              </ul>
              <a href="product.php#omnichannel" class="text-pacific font-semibold text-sm hover:underline inline-flex items-center gap-2">Explore Omnichannel module <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg></a>
            </div>
            <div class="lg:w-1/2">
              <div class="relative group rounded-2xl overflow-hidden shadow-2xl shadow-bell/10">
                <img src="assets/images/platform/omnichannel.png" alt="Omnichannel banking across mobile, tablet, and web" class="w-full h-auto object-cover rounded-2xl transition-transform duration-700 group-hover:scale-[1.03]" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-dark/80 via-dark/20 to-transparent rounded-2xl"></div>
                <div class="absolute bottom-5 left-5 right-5 flex items-center justify-between">
                  <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-dark/60 backdrop-blur-md border border-white/10 text-xs font-semibold text-white">
                    <span class="w-2 h-2 bg-bell rounded-full animate-pulse"></span>
                    Mobile · Web · Tablet · AI Chatbot
                  </span>
                </div>
              </div>
            </div>
          </div>

          <!-- Analytics & CRM Tab -->
          <div class="tab-content flex-col lg:flex-row items-center gap-12" data-tab-content="analytics">
            <div class="lg:w-1/2">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-green-400/10 flex items-center justify-center">
                  <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                  </svg>
                </div>
                <h3 class="text-2xl font-bold">Analytics & CRM</h3>
              </div>
              <p class="text-gray-400 mb-6 leading-relaxed">Leverage built-in data analytics, customer segmentation, and a CRM bundled with omnichannel banking. Build targeted marketing campaigns, manage offers, and track customer lifetime value — all from one platform.</p>
              <ul class="space-y-3 mb-8">
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Real-time operational dashboards</li>
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Customer segmentation & offers management (CMS)</li>
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Predictive risk models & churn detection</li>
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Regulatory reporting automation</li>
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Third-party loyalty apps integration</li>
              </ul>
              <a href="product.php#analytics" class="text-pacific font-semibold text-sm hover:underline inline-flex items-center gap-2">Explore Analytics module <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg></a>
            </div>
            <div class="lg:w-1/2">
              <div class="relative group rounded-2xl overflow-hidden shadow-2xl shadow-green-500/10">
                <img src="assets/images/platform/analytics.png" alt="Real-time banking analytics and CRM dashboard" class="w-full h-auto object-cover rounded-2xl transition-transform duration-700 group-hover:scale-[1.03]" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-dark/80 via-dark/20 to-transparent rounded-2xl"></div>
                <div class="absolute bottom-5 left-5 right-5 flex items-center justify-between">
                  <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-dark/60 backdrop-blur-md border border-white/10 text-xs font-semibold text-white">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    Live Dashboards · CRM · Predictive Analytics
                  </span>
                </div>
              </div>
            </div>
          </div>

          <!-- Partner Portal Tab -->
          <div class="tab-content flex-col lg:flex-row items-center gap-12" data-tab-content="partner-portal">
            <div class="lg:w-1/2">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-grape/20 flex items-center justify-center">
                  <svg class="w-5 h-5 text-aqua" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                </div>
                <h3 class="text-2xl font-bold">Partner Portal</h3>
              </div>
              <p class="text-gray-400 mb-6 leading-relaxed">Give your channel partners a dedicated workspace to manage deals, track commissions, access training resources, and download sales collateral. Built to scale your indirect sales engine across regions.</p>
              <ul class="space-y-3 mb-8">
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Deal registration & pipeline management</li>
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Automated commission tracking & payout reports</li>
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Sales playbooks, pitch decks & collateral library</li>
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Training, certification & Bankerise Academy access</li>
                <li class="flex items-center gap-3 text-gray-300"><svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Regional exclusivity & territory management</li>
              </ul>
              <a href="partners.php" class="text-pacific font-semibold text-sm hover:underline inline-flex items-center gap-2">Explore Partner program <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg></a>
            </div>
            <div class="lg:w-1/2">
              <div class="relative group rounded-2xl overflow-hidden shadow-2xl shadow-grape/10">
                <img src="assets/images/platform/partners.png" alt="Partner meeting and deal pipeline management" class="w-full h-auto object-cover rounded-2xl transition-transform duration-700 group-hover:scale-[1.03]" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-dark/80 via-dark/20 to-transparent rounded-2xl"></div>
                <div class="absolute bottom-5 left-5 right-5 flex items-center justify-between">
                  <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-dark/60 backdrop-blur-md border border-white/10 text-xs font-semibold text-white">
                    <span class="w-2 h-2 bg-aqua rounded-full animate-pulse"></span>
                    Deal Pipeline · Commissions · Training
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



    <!-- ═══════════════════════════════════════════
         SECTION 6: STATS / IMPACT
         ═══════════════════════════════════════════ -->
    <section class="section-spacing-lg relative overflow-hidden">
      <div class="absolute inset-0 pointer-events-none">
        <div
          class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full bg-pacific/5 blur-[120px]">
        </div>
      </div>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
          <div class="text-center" data-animate data-animate-delay="1">
            <p class="text-4xl sm:text-5xl font-extrabold gradient-text mb-2" data-count="150" data-suffix="+">0</p>
            <p class="text-gray-400 text-sm">Banks & Financial Institutions</p>
          </div>
          <div class="text-center" data-animate data-animate-delay="2">
            <p class="text-4xl sm:text-5xl font-extrabold gradient-text mb-2" data-count="14" data-suffix="M+">0</p>
            <p class="text-gray-400 text-sm">End Users Served</p>
          </div>
          <div class="text-center" data-animate data-animate-delay="3">
            <p class="text-4xl sm:text-5xl font-extrabold gradient-text mb-2" data-count="26" data-suffix="+">0</p>
            <p class="text-gray-400 text-sm">Countries Active</p>
          </div>
          <div class="text-center" data-animate data-animate-delay="4">
            <p class="text-4xl sm:text-5xl font-extrabold gradient-text mb-2" data-count="99.9" data-suffix="%">0</p>
            <p class="text-gray-400 text-sm">Platform Uptime</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         SECTION 7: PARTNERS PREVIEW
         ═══════════════════════════════════════════ -->
    <section class="pp-section">
      <div class="pp-orb"></div>
      <div class="pp-content">

        <!-- SVG gradient definition for icons -->
        <svg width="0" height="0" style="position:absolute">
          <defs>
            <linearGradient id="pp-icon-grad" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" stop-color="#45D4C5" />
              <stop offset="100%" stop-color="#2B8FD8" />
            </linearGradient>
          </defs>
        </svg>

        <!-- Header -->
        <div class="pp-header">
          <p class="pp-eyebrow">BECOME A PARTNER</p>
          <h2 class="pp-title">Find your place in the Bankerise ecosystem</h2>
          <div class="pp-shimmer"></div>
          <p class="pp-subtitle">3 partner profiles. One powerful network.</p>
        </div>

        <!-- 3 Cards -->
        <div class="pp-cards">

          <!-- Card 1: Banking Decision Maker -->
          <a href="partners.php?profile=decision-maker" class="pp-card">
            <div class="pp-card-border"></div>
            <div class="pp-card-spotlight"></div>
            <div class="pp-card-grid"></div>
            <span class="pp-number">01</span>
            <div class="pp-icon-wrap">
              <svg fill="none" stroke="url(#pp-icon-grad)" viewBox="0 0 24 24" stroke-width="1.4">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
              </svg>
            </div>
            <h3 class="pp-card-title">Banking Decision Maker</h3>
            <div class="pp-card-tags">
              <span class="pp-tag">Director</span>
              <span class="pp-tag">C-Level</span>
              <span class="pp-tag">Digital Lead</span>
            </div>
            <div class="pp-separator"></div>
            <p class="pp-card-desc">Modernize your institution with a proven end-to-end digital banking platform.</p>
            <div class="pp-card-cta">
              <span class="pp-card-cta-text">Discover your benefits</span>
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </div>
          </a>

          <!-- Card 2: IT Banking Manager -->
          <a href="partners.php?profile=it-manager" class="pp-card">
            <div class="pp-card-border"></div>
            <div class="pp-card-spotlight"></div>
            <div class="pp-card-grid"></div>
            <span class="pp-number">02</span>
            <div class="pp-icon-wrap">
              <svg fill="none" stroke="url(#pp-icon-grad)" viewBox="0 0 24 24" stroke-width="1.4">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M16 3v1.5m0 15V21m-8-9h8m-8 4h8M7.5 7.5h9v9h-9v-9z" />
              </svg>
            </div>
            <h3 class="pp-card-title">IT Banking Manager</h3>
            <div class="pp-card-tags">
              <span class="pp-tag">CTO</span>
              <span class="pp-tag">IT Lead</span>
              <span class="pp-tag">Architect</span>
            </div>
            <div class="pp-separator"></div>
            <p class="pp-card-desc">Integrate a secure, compatible, and scalable banking solution into your
              infrastructure.</p>
            <div class="pp-card-cta">
              <span class="pp-card-cta-text">Discover your benefits</span>
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </div>
          </a>

          <!-- Card 3: Local Partner & Integrator -->
          <a href="partners.php?profile=integrator" class="pp-card">
            <div class="pp-card-border"></div>
            <div class="pp-card-spotlight"></div>
            <div class="pp-card-grid"></div>
            <span class="pp-number">03</span>
            <div class="pp-icon-wrap">
              <svg fill="none" stroke="url(#pp-icon-grad)" viewBox="0 0 24 24" stroke-width="1.4">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
              </svg>
            </div>
            <h3 class="pp-card-title">Local Partner &amp; Integrator</h3>
            <div class="pp-card-tags">
              <span class="pp-tag">Distributor</span>
              <span class="pp-tag">Reseller</span>
              <span class="pp-tag">Integrator</span>
            </div>
            <div class="pp-separator"></div>
            <p class="pp-card-desc">Build a regional portfolio and earn commissions with full Bankerise support.</p>
            <div class="pp-card-cta">
              <span class="pp-card-cta-text">Discover your benefits</span>
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </div>
          </a>

        </div>

        <!-- Bottom CTA -->
        <div class="pp-bottom">
          <p class="pp-bottom-text">Not sure which profile fits you?</p>
          <a href="partners.php" class="pp-bottom-btn">
            Explore All Partnerships
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
          </a>
        </div>

      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         SECTION 8: TESTIMONIALS MARQUEE
         ═══════════════════════════════════════════ -->
    <section class="tm-section" id="testimonials-section">
      <style>
        /* ── Testimonials Marquee ── */
        .tm-section {
          padding: 64px 0 56px;
          background: #141729;
          overflow: hidden;
          position: relative;
        }
        .tm-section::before {
          content: '';
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          height: 1px;
          background: linear-gradient(90deg, transparent, rgba(77,184,205,0.15), transparent);
        }
        .tm-header {
          text-align: center;
          max-width: 600px;
          margin: 0 auto 40px;
          padding: 0 24px;
        }
        .tm-header .eyebrow {
          font-size: 11px;
          letter-spacing: 3px;
          text-transform: uppercase;
          color: #4DB8CD;
          font-weight: 600;
          margin-bottom: 12px;
        }
        .tm-header h2 {
          font-size: 28px;
          font-weight: 700;
          color: #fff;
          line-height: 1.3;
        }

        /* Marquee container */
        .tm-marquee-wrap {
          position: relative;
          width: 100%;
        }
        .tm-marquee-wrap::before,
        .tm-marquee-wrap::after {
          content: '';
          position: absolute;
          top: 0;
          bottom: 0;
          width: 100px;
          z-index: 2;
          pointer-events: none;
        }
        .tm-marquee-wrap::before {
          left: 0;
          background: linear-gradient(90deg, #141729 0%, transparent 100%);
        }
        .tm-marquee-wrap::after {
          right: 0;
          background: linear-gradient(270deg, #141729 0%, transparent 100%);
        }

        .tm-track {
          display: flex;
          gap: 20px;
          width: max-content;
          animation: tm-scroll 25s linear infinite;
        }
        .tm-marquee-wrap:hover .tm-track {
          animation-play-state: paused;
        }

        @keyframes tm-scroll {
          0% { transform: translateX(0); }
          100% { transform: translateX(-50%); }
        }

        /* Card */
        .tm-card {
          flex-shrink: 0;
          width: 300px;
          background: rgba(255,255,255,0.03);
          border: 1px solid rgba(255,255,255,0.06);
          border-radius: 14px;
          padding: 22px 20px;
          transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
          cursor: default;
          position: relative;
          overflow: hidden;
        }
        .tm-card::before {
          content: '';
          position: absolute;
          inset: 0;
          border-radius: 14px;
          opacity: 0;
          background: linear-gradient(135deg, rgba(77,184,205,0.06), rgba(118,108,255,0.04));
          transition: opacity 0.4s ease;
        }
        .tm-card:hover::before {
          opacity: 1;
        }

        /* Hover: dim siblings, brighten hovered */
        .tm-marquee-wrap:hover .tm-card {
          opacity: 0.35;
          filter: brightness(0.65);
        }
        .tm-marquee-wrap:hover .tm-card:hover {
          opacity: 1;
          filter: brightness(1.1) contrast(1.05);
          border-color: rgba(77,184,205,0.25);
          box-shadow: 0 0 30px rgba(77,184,205,0.08), 0 8px 24px rgba(0,0,0,0.3);
          transform: translateY(-2px);
        }

        .tm-card-quote {
          font-size: 12.5px;
          line-height: 1.6;
          color: rgba(255,255,255,0.55);
          margin-bottom: 16px;
          display: -webkit-box;
          -webkit-line-clamp: 3;
          -webkit-box-orient: vertical;
          overflow: hidden;
          position: relative;
          z-index: 1;
        }

        .tm-card-author {
          display: flex;
          align-items: center;
          gap: 10px;
          position: relative;
          z-index: 1;
        }
        .tm-avatar {
          width: 32px;
          height: 32px;
          border-radius: 50%;
          flex-shrink: 0;
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 11px;
          font-weight: 700;
          color: #fff;
        }
        .tm-avatar--gradient1 { background: linear-gradient(135deg, #4DB8CD, #766CFF); }
        .tm-avatar--gradient2 { background: linear-gradient(135deg, #766CFF, #4C4E89); }
        .tm-avatar--gradient3 { background: linear-gradient(135deg, #34D399, #4DB8CD); }
        .tm-avatar--gradient4 { background: linear-gradient(135deg, #4799D1, #4DB8CD); }
        .tm-avatar--gradient5 { background: linear-gradient(135deg, #F472B6, #766CFF); }
        .tm-avatar--gradient6 { background: linear-gradient(135deg, #FBBF24, #F97316); }

        .tm-author-info {
          min-width: 0;
        }
        .tm-author-name {
          font-size: 12px;
          font-weight: 600;
          color: #fff;
          white-space: nowrap;
          overflow: hidden;
          text-overflow: ellipsis;
        }
        .tm-author-role {
          font-size: 10.5px;
          color: rgba(255,255,255,0.35);
          white-space: nowrap;
          overflow: hidden;
          text-overflow: ellipsis;
        }
        .tm-badge {
          display: inline-block;
          font-size: 9px;
          font-weight: 600;
          letter-spacing: 0.5px;
          text-transform: uppercase;
          padding: 3px 8px;
          border-radius: 20px;
          margin-bottom: 12px;
          position: relative;
          z-index: 1;
        }
        .tm-badge--client {
          background: rgba(77,184,205,0.1);
          color: #4DB8CD;
        }
        .tm-badge--partner {
          background: rgba(118,108,255,0.1);
          color: #766CFF;
        }
        .tm-badge--enterprise {
          background: rgba(52,211,153,0.1);
          color: #34D399;
        }

        @media (max-width: 640px) {
          .tm-section { padding: 48px 0 40px; }
          .tm-header h2 { font-size: 22px; }
          .tm-card { width: 260px; padding: 18px 16px; }
          .tm-card-quote { font-size: 11.5px; -webkit-line-clamp: 3; }
          .tm-marquee-wrap::before,
          .tm-marquee-wrap::after { width: 40px; }
        }
      </style>

      <div class="tm-header" data-animate>
        <p class="eyebrow">TESTIMONIALS</p>
        <h2>Trusted by teams across the globe</h2>
      </div>

      <div class="tm-marquee-wrap">
        <div class="tm-track">
          <!-- Card 1 -->
          <div class="tm-card">
            <span class="tm-badge tm-badge--client">Client</span>
            <p class="tm-card-quote">"Proxym's teams established a strong synergy with ours, combining technical skills with outstanding project management and human qualities in a multicultural environment."</p>
            <div class="tm-card-author">
              <div class="tm-avatar tm-avatar--gradient1">GH</div>
              <div class="tm-author-info">
                <p class="tm-author-name">George Hobeika</p>
                <p class="tm-author-role">Senior Director, Qatar Financial Centre</p>
              </div>
            </div>
          </div>
          <!-- Card 2 -->
          <div class="tm-card">
            <span class="tm-badge tm-badge--partner">Partner</span>
            <p class="tm-card-quote">"We are very satisfied with the project delivery and the professionalism of the teams. All automated processes are running flawlessly since the production launch."</p>
            <div class="tm-card-author">
              <div class="tm-avatar tm-avatar--gradient2">AW</div>
              <div class="tm-author-info">
                <p class="tm-author-name">Abdourakhmane Wone</p>
                <p class="tm-author-role">IT Director, BSIC Group</p>
              </div>
            </div>
          </div>
          <!-- Card 3 -->
          <div class="tm-card">
            <span class="tm-badge tm-badge--enterprise">Enterprise</span>
            <p class="tm-card-quote">"Many thanks for the exceptional efforts and outstanding support. The team's commitment and timely delivery for such a critical implementation were truly remarkable."</p>
            <div class="tm-card-author">
              <div class="tm-avatar tm-avatar--gradient3">VK</div>
              <div class="tm-author-info">
                <p class="tm-author-name">Vasanthi Kallahalli</p>
                <p class="tm-author-role">Program Manager, National Bank of Fujairah</p>
              </div>
            </div>
          </div>
          <!-- Card 4 -->
          <div class="tm-card">
            <span class="tm-badge tm-badge--client">Client</span>
            <p class="tm-card-quote">"The quality of service, the level of detail and accountability demonstrated a form of excellence and mastery in the way they conduct business as a whole."</p>
            <div class="tm-card-author">
              <div class="tm-avatar tm-avatar--gradient4">YH</div>
              <div class="tm-author-info">
                <p class="tm-author-name">Yasmine Helal</p>
                <p class="tm-author-role">CEO, Takka Financial Services</p>
              </div>
            </div>
          </div>
          <!-- Card 5 -->
          <div class="tm-card">
            <span class="tm-badge tm-badge--partner">Partner</span>
            <p class="tm-card-quote">"The platform accelerated our digital transformation and helped us launch new products across three markets in record time with seamless integration capabilities."</p>
            <div class="tm-card-author">
              <div class="tm-avatar tm-avatar--gradient5">KM</div>
              <div class="tm-author-info">
                <p class="tm-author-name">Karim Mansouri</p>
                <p class="tm-author-role">Chief Digital Officer, Atlas Finance Group</p>
              </div>
            </div>
          </div>
          <!-- Card 6 -->
          <div class="tm-card">
            <span class="tm-badge tm-badge--enterprise">Enterprise</span>
            <p class="tm-card-quote">"Their agile delivery model and deep domain expertise in digital banking made them the ideal partner for our core banking modernization initiative."</p>
            <div class="tm-card-author">
              <div class="tm-avatar tm-avatar--gradient6">NB</div>
              <div class="tm-author-info">
                <p class="tm-author-name">Nadia Benjelloun</p>
                <p class="tm-author-role">CTO, Meridian Microfinance</p>
              </div>
            </div>
          </div>

          <!-- ── Duplicated set for seamless loop ── -->
          <div class="tm-card">
            <span class="tm-badge tm-badge--client">Client</span>
            <p class="tm-card-quote">"Proxym's teams established a strong synergy with ours, combining technical skills with outstanding project management and human qualities in a multicultural environment."</p>
            <div class="tm-card-author">
              <div class="tm-avatar tm-avatar--gradient1">GH</div>
              <div class="tm-author-info">
                <p class="tm-author-name">George Hobeika</p>
                <p class="tm-author-role">Senior Director, Qatar Financial Centre</p>
              </div>
            </div>
          </div>
          <div class="tm-card">
            <span class="tm-badge tm-badge--partner">Partner</span>
            <p class="tm-card-quote">"We are very satisfied with the project delivery and the professionalism of the teams. All automated processes are running flawlessly since the production launch."</p>
            <div class="tm-card-author">
              <div class="tm-avatar tm-avatar--gradient2">AW</div>
              <div class="tm-author-info">
                <p class="tm-author-name">Abdourakhmane Wone</p>
                <p class="tm-author-role">IT Director, BSIC Group</p>
              </div>
            </div>
          </div>
          <div class="tm-card">
            <span class="tm-badge tm-badge--enterprise">Enterprise</span>
            <p class="tm-card-quote">"Many thanks for the exceptional efforts and outstanding support. The team's commitment and timely delivery for such a critical implementation were truly remarkable."</p>
            <div class="tm-card-author">
              <div class="tm-avatar tm-avatar--gradient3">VK</div>
              <div class="tm-author-info">
                <p class="tm-author-name">Vasanthi Kallahalli</p>
                <p class="tm-author-role">Program Manager, National Bank of Fujairah</p>
              </div>
            </div>
          </div>
          <div class="tm-card">
            <span class="tm-badge tm-badge--client">Client</span>
            <p class="tm-card-quote">"The quality of service, the level of detail and accountability demonstrated a form of excellence and mastery in the way they conduct business as a whole."</p>
            <div class="tm-card-author">
              <div class="tm-avatar tm-avatar--gradient4">YH</div>
              <div class="tm-author-info">
                <p class="tm-author-name">Yasmine Helal</p>
                <p class="tm-author-role">CEO, Takka Financial Services</p>
              </div>
            </div>
          </div>
          <div class="tm-card">
            <span class="tm-badge tm-badge--partner">Partner</span>
            <p class="tm-card-quote">"The platform accelerated our digital transformation and helped us launch new products across three markets in record time with seamless integration capabilities."</p>
            <div class="tm-card-author">
              <div class="tm-avatar tm-avatar--gradient5">KM</div>
              <div class="tm-author-info">
                <p class="tm-author-name">Karim Mansouri</p>
                <p class="tm-author-role">Chief Digital Officer, Atlas Finance Group</p>
              </div>
            </div>
          </div>
          <div class="tm-card">
            <span class="tm-badge tm-badge--enterprise">Enterprise</span>
            <p class="tm-card-quote">"Their agile delivery model and deep domain expertise in digital banking made them the ideal partner for our core banking modernization initiative."</p>
            <div class="tm-card-author">
              <div class="tm-avatar tm-avatar--gradient6">NB</div>
              <div class="tm-author-info">
                <p class="tm-author-name">Nadia Benjelloun</p>
                <p class="tm-author-role">CTO, Meridian Microfinance</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         SECTION 10: FINAL CTA
         ═══════════════════════════════════════════ -->
    <section class="section-spacing-lg relative overflow-hidden noise-overlay">
      <div class="mesh-gradient">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
      </div>
      <div class="absolute inset-0 bg-dark/60 pointer-events-none"></div>
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6" data-animate>Ready to transform your banking
          experience?</h2>
        <p class="text-gray-300 text-lg max-w-2xl mx-auto mb-10" data-animate>
          Schedule a personalized demo and see how Bankerise can accelerate your digital journey.
        </p>
        <a href="contact.php" class="btn-primary text-lg !py-4 !px-10" data-animate>
          Request a Demo
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
          </svg>
        </a>
      </div>
    </section>

  </main>

  <!-- Footer -->
  <?php include 'includes/footer.php'; ?>

  <!-- Scripts -->
  <script src="assets/js/shared.js?v=<?= $assetVersion ?>"></script>

  <script src="assets/js/sections/partners-section.js?v=<?= $assetVersion ?>"></script>


  <script>
    // Initialize product tabs
    document.addEventListener('DOMContentLoaded', function () {
      initTabs('#product-tabs');
    });
  </script>
</body>

</html>
