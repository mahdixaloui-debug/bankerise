<?php
$pageTitle = 'About — Bankerise®';
$pageDescription = 'About Bankerise — Our mission, vision, values, and the team behind the leading B2B digital banking platform by Proxym Group.';
include 'includes/head.php';
?>
  <link rel="stylesheet" href="assets/css/pages/about.css">
</head>

<body class="font-montserrat bg-dark text-white">
  <?php include 'includes/navbar.php'; ?>

  <main id="main-content">

    <!-- ═══════════════════════════════════════════
         HERO — Immersive intro with particles & orbitals
         ═══════════════════════════════════════════ -->
    <section class="relative pt-32 pb-20 lg:pt-44 lg:pb-32 overflow-hidden noise-overlay">
      <!-- Background Video -->
      <video src="assets/videos/about-hero.mp4" autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover opacity-40"></video>
      <div class="absolute inset-0 bg-gradient-to-b from-dark/80 via-dark/40 to-dark"></div>

      <div class="mesh-gradient opacity-40">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
      </div>



      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="proxym-badge mx-auto mb-6" data-animate>
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
          </svg>
          BY PROXYM GROUP
        </div>
        <p class="eyebrow" data-animate data-animate-delay="0">ABOUT BANKERISE</p>
        <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold mb-6 leading-tight" data-animate data-animate-delay="1">
          Crafting the Future of<br>
          <span class="gradient-text">Digital Banking</span>
        </h1>
        <p class="text-lg lg:text-xl text-gray-400 max-w-2xl mx-auto mb-12" data-animate data-animate-delay="2">
          Born from two decades of engineering excellence, Bankerise transforms how financial institutions
          serve their customers — across 26 countries and counting.
        </p>

        <!-- Hero stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-3xl mx-auto" data-animate data-animate-delay="3">
          <div class="stat-card">
            <p class="stat-number" data-count="150">0</p>
            <p class="text-gray-500 text-xs mt-1 font-medium tracking-wide">INSTITUTIONS</p>
          </div>
          <div class="stat-card">
            <p class="stat-number" data-count="26">0</p>
            <p class="text-gray-500 text-xs mt-1 font-medium tracking-wide">COUNTRIES</p>
          </div>
          <div class="stat-card">
            <p class="stat-number" data-count="14">0</p>
            <p class="text-gray-500 text-xs mt-1 font-medium tracking-wide">M+ END USERS</p>
          </div>
          <div class="stat-card">
            <p class="stat-number" data-count="500">0</p>
            <p class="text-gray-500 text-xs mt-1 font-medium tracking-wide">ENGINEERS</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         OUR STORY + TIMELINE  (redesigned)
         ═══════════════════════════════════════════ -->
    <section class="story-section py-20 lg:py-32 relative overflow-hidden">
      <div class="story-bg-orb story-bg-orb--1"></div>
      <div class="story-bg-orb story-bg-orb--2"></div>
      <div class="story-grid-overlay"></div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-20 items-start">

          <!-- ── Story narrative (sticky) ── -->
          <div class="lg:col-span-5 lg:sticky lg:top-28" data-animate>
            <p class="eyebrow story-eyebrow">
              <span class="eyebrow-line"></span> OUR STORY
            </p>
            <h2 class="text-4xl sm:text-5xl lg:text-[3.25rem] font-extrabold leading-[1.05] mb-8 tracking-tight">
              From engineering roots<br>
              to <span class="gradient-text">banking innovation</span>.
            </h2>

            <div class="space-y-5 text-gray-300/90 leading-relaxed text-[15.5px] story-typewriter">
              <p>
                <span class="dropcap">B</span>ankerise was born from a simple observation: financial institutions in
                emerging markets deserve the same world-class digital tools as global banks — without the complexity
                and cost.
              </p>
              <p>
                Backed by <strong class="text-white font-semibold">Proxym Group</strong>, a technology company with
                20+ years of experience delivering enterprise software across Africa, the Middle East, and Central
                Asia, we built Bankerise to be modular, flexible, and ready for the unique challenges of high-growth
                markets.
              </p>
              <p>
                Today, our platform powers digital transformation for 150+ financial institutions across 26 countries,
                serving over 14 million end users — and we're just getting started.
              </p>
            </div>

            <!-- Pull quote -->
            <figure class="story-quote">
              <svg class="story-quote-mark" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M7.17 6C4.32 6 2 8.32 2 11.17V18h6.83v-6.83H5.5C5.5 9.42 6.92 8 8.67 8H10V6H7.17zm10 0c-2.85 0-5.17 2.32-5.17 5.17V18h6.83v-6.83H15.5c0-1.75 1.42-3.17 3.17-3.17H20V6h-2.83z"/>
              </svg>
              <blockquote>
                Banking should be accessible, intelligent, and beautifully designed — for every market, not just the
                wealthy ones.
              </blockquote>
              <figcaption>— Founding Principle, 2019</figcaption>
            </figure>

            <!-- Mini inline stats -->
            <div class="story-mini-stats">
              <div>
                <p class="story-mini-num">23<span>yrs</span></p>
                <p class="story-mini-lbl">Engineering DNA</p>
              </div>
              <div>
                <p class="story-mini-num">4<span>+</span></p>
                <p class="story-mini-lbl">Continents Served</p>
              </div>
              <div>
                <p class="story-mini-num">14<span>M+</span></p>
                <p class="story-mini-lbl">Lives Touched</p>
              </div>
            </div>
          </div>

          <!-- ── Timeline ── -->
          <div class="lg:col-span-7" data-animate="right">
            <div class="story-timeline">
              <div class="story-timeline-track">
                <div class="story-timeline-progress"></div>
              </div>

              <!-- 2003 -->
              <article class="story-milestone is-past" style="--ms-color:#4DB8CD;">
                <div class="story-milestone-marker">
                  <span class="story-milestone-chapter">01</span>
                  <span class="story-milestone-pulse"></span>
                </div>
                <div class="story-milestone-card">
                  <header>
                    <span class="story-milestone-year">2003</span>
                    <span class="story-milestone-tag">Origin</span>
                  </header>
                  <h3>Proxym Group Founded</h3>
                  <p>An enterprise software consultancy established in Tunisia, laying the engineering foundation
                    for what would become Bankerise.</p>
                </div>
              </article>

              <!-- 2015 -->
              <article class="story-milestone is-past" style="--ms-color:#4DB8CD;">
                <div class="story-milestone-marker">
                  <span class="story-milestone-chapter">02</span>
                </div>
                <div class="story-milestone-card">
                  <header>
                    <span class="story-milestone-year">2015</span>
                    <span class="story-milestone-tag">Banking</span>
                  </header>
                  <h3>First Banking Projects</h3>
                  <p>Digital channels built for leading North African banks, proving the need for a purpose-built
                    platform.</p>
                </div>
              </article>

              <!-- 2019 -->
              <article class="story-milestone is-past" style="--ms-color:#4799D1;">
                <div class="story-milestone-marker">
                  <span class="story-milestone-chapter">03</span>
                </div>
                <div class="story-milestone-card is-highlight">
                  <header>
                    <span class="story-milestone-year">2019</span>
                    <span class="story-milestone-tag">Launch</span>
                  </header>
                  <h3>Bankerise Platform Launched</h3>
                  <p>The modular digital banking platform was born as a standalone, API-first product — designed for
                    emerging markets from day one.</p>
                </div>
              </article>

              <!-- 2022 -->
              <article class="story-milestone is-past" style="--ms-color:#766CFF;">
                <div class="story-milestone-marker">
                  <span class="story-milestone-chapter">04</span>
                </div>
                <div class="story-milestone-card">
                  <header>
                    <span class="story-milestone-year">2022</span>
                    <span class="story-milestone-tag">Expansion</span>
                  </header>
                  <h3>International Expansion</h3>
                  <p>Entered Middle East, West Africa, and Central Asia markets. Partner ecosystem launched to drive
                    regional growth.</p>
                </div>
              </article>

              <!-- 2026 (current) -->
              <article class="story-milestone is-current" style="--ms-color:#766CFF;">
                <div class="story-milestone-marker">
                  <span class="story-milestone-chapter">05</span>
                  <span class="story-milestone-pulse story-milestone-pulse--strong"></span>
                </div>
                <div class="story-milestone-card is-current">
                  <header>
                    <span class="story-milestone-year">2026</span>
                    <span class="story-milestone-tag story-milestone-tag--live">
                      <span class="live-dot"></span> Today
                    </span>
                  </header>
                  <h3>150+ Institutions, 26+ Countries</h3>
                  <p>Scaling the partner ecosystem, entering new continents, and continuing to shape the future of
                    digital banking.</p>
                </div>
              </article>

              <!-- Future -->
              <article class="story-milestone is-future" style="--ms-color:#34D399;">
                <div class="story-milestone-marker">
                  <span class="story-milestone-chapter">06</span>
                </div>
                <div class="story-milestone-card is-future">
                  <header>
                    <span class="story-milestone-year">Next</span>
                    <span class="story-milestone-tag">Horizon</span>
                  </header>
                  <h3>The Next Chapter</h3>
                  <p>AI-native banking, embedded finance, and a global partner ecosystem reaching every emerging
                    market on the map.</p>
                </div>
              </article>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         MISSION & VISION
         ═══════════════════════════════════════════ -->
    <hr class="section-divider">
    <section class="purpose-section py-20 lg:py-32 bg-dark2 relative overflow-hidden">
      <!-- Decorative background -->
      <div class="purpose-bg-orb purpose-bg-orb--left"></div>
      <div class="purpose-bg-orb purpose-bg-orb--right"></div>
      <div class="purpose-grid-overlay"></div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Manifesto header -->
        <div class="text-center max-w-3xl mx-auto mb-20" data-animate>
          <div class="purpose-eyebrow-wrap">
            <span class="purpose-eyebrow-line"></span>
            <p class="eyebrow !mb-0">PURPOSE</p>
            <span class="purpose-eyebrow-line"></span>
          </div>
          <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mt-6 mb-6 leading-[1.05] tracking-tight">
            Why <span class="gradient-text">we exist</span>.
          </h2>
          <p class="text-gray-400 text-lg leading-relaxed">
            Two beliefs shape every decision we make — from the architecture of our platform
            to the partnerships we build.
          </p>
        </div>

        <!-- Mission / Vision cards -->
        <div class="grid lg:grid-cols-2 gap-6 lg:gap-10 relative">

          <!-- Center compass (lg+ only) -->
          <div class="purpose-compass" aria-hidden="true">
            <div class="purpose-compass-ring"></div>
            <div class="purpose-compass-ring purpose-compass-ring--2"></div>
            <div class="purpose-compass-core">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v4M12 18v4M2 12h4M18 12h4M5 5l3 3M16 16l3 3M5 19l3-3M16 8l3-3"/>
              </svg>
            </div>
          </div>

          <!-- MISSION -->
          <article class="purpose-card" style="--p-color:#4DB8CD; --p-color-2:#4799D1;" data-animate data-animate-delay="1">
            <div class="purpose-card-glow"></div>
            <div class="purpose-card-corner purpose-card-corner--tl"></div>
            <div class="purpose-card-corner purpose-card-corner--br"></div>

            <div class="purpose-card-head">
              <div class="purpose-card-icon">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
              </div>
              <div class="purpose-card-meta">
                <span class="purpose-card-index">PRINCIPLE 01</span>
                <h3 class="purpose-card-title">Our Mission</h3>
              </div>
            </div>

            <p class="purpose-card-lead">
              To empower financial institutions worldwide with flexible, modular digital banking technology
              that accelerates transformation, elevates customer experience, and drives financial inclusion
              in underserved markets.
            </p>

            <ul class="purpose-pillars">
              <li>
                <span class="purpose-pillar-dot"></span>
                <div>
                  <strong>Empower</strong>
                  <span>Give every bank the tools of a hyperscaler.</span>
                </div>
              </li>
              <li>
                <span class="purpose-pillar-dot"></span>
                <div>
                  <strong>Accelerate</strong>
                  <span>Cut transformation timelines from years to months.</span>
                </div>
              </li>
              <li>
                <span class="purpose-pillar-dot"></span>
                <div>
                  <strong>Include</strong>
                  <span>Bring banking to the unbanked — not just the affluent.</span>
                </div>
              </li>
            </ul>

            <div class="purpose-card-foot">
              <span class="purpose-card-tag">Today</span>
              <span class="purpose-card-arrow" aria-hidden="true">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
              </span>
            </div>
          </article>

          <!-- VISION -->
          <article class="purpose-card" style="--p-color:#766CFF; --p-color-2:#9F7AEA;" data-animate data-animate-delay="2">
            <div class="purpose-card-glow"></div>
            <div class="purpose-card-corner purpose-card-corner--tl"></div>
            <div class="purpose-card-corner purpose-card-corner--br"></div>

            <div class="purpose-card-head">
              <div class="purpose-card-icon">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
              </div>
              <div class="purpose-card-meta">
                <span class="purpose-card-index">PRINCIPLE 02</span>
                <h3 class="purpose-card-title">Our Vision</h3>
              </div>
            </div>

            <p class="purpose-card-lead">
              To become the global standard for digital banking platforms in emerging markets — trusted by
              every institution that believes banking should be accessible, intelligent, and beautifully
              designed.
            </p>

            <ul class="purpose-pillars">
              <li>
                <span class="purpose-pillar-dot"></span>
                <div>
                  <strong>Accessible</strong>
                  <span>Banking that meets people where they are — on any device.</span>
                </div>
              </li>
              <li>
                <span class="purpose-pillar-dot"></span>
                <div>
                  <strong>Intelligent</strong>
                  <span>AI-native, data-driven, and adaptive by default.</span>
                </div>
              </li>
              <li>
                <span class="purpose-pillar-dot"></span>
                <div>
                  <strong>Beautiful</strong>
                  <span>Craft and design as serious as the engineering beneath.</span>
                </div>
              </li>
            </ul>

            <div class="purpose-card-foot">
              <span class="purpose-card-tag purpose-card-tag--future">Tomorrow</span>
              <span class="purpose-card-arrow" aria-hidden="true">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
              </span>
            </div>
          </article>
        </div>

        <!-- Closing manifesto strip -->
        <div class="purpose-manifesto" data-animate data-animate-delay="3">
          <span class="purpose-manifesto-divider"></span>
          <p>
            Mission is what we do <em>today</em>. Vision is where we're going <em>tomorrow</em>.
            Both point in the same direction.
          </p>
          <span class="purpose-manifesto-divider"></span>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         OUR VALUES
         ═══════════════════════════════════════════ -->
    <section class="values-section py-20 lg:py-32 relative overflow-hidden">
      <div class="values-bg-orb values-bg-orb--1"></div>
      <div class="values-bg-orb values-bg-orb--2"></div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16" data-animate>
          <div class="purpose-eyebrow-wrap">
            <span class="purpose-eyebrow-line"></span>
            <p class="eyebrow !mb-0">OUR VALUES</p>
            <span class="purpose-eyebrow-line"></span>
          </div>
          <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mt-6 mb-6 leading-[1.05] tracking-tight">
            What drives us <span class="gradient-text">every day</span>.
          </h2>
          <p class="text-gray-400 text-lg leading-relaxed">
            Four principles that shape every product decision, every partnership, and every line of code.
          </p>
        </div>

        <div class="values-grid">
          <!-- 01 INNOVATION -->
          <article class="v-card" style="--v-color:#4DB8CD;" data-animate data-animate-delay="1">
            <div class="v-card-bg"></div>
            <div class="v-card-corner v-card-corner--tl"></div>
            <div class="v-card-corner v-card-corner--br"></div>
            <span class="v-card-num">01</span>

            <div class="v-card-icon">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
              </svg>
            </div>

            <h4 class="v-card-title">Innovation</h4>
            <p class="v-card-tagline">Build what's next.</p>
            <p class="v-card-desc">
              We push boundaries, challenge conventions, and build what the market needs next — not what worked yesterday.
            </p>

            <div class="v-card-foot">
              <span class="v-card-line"></span>
              <span class="v-card-mantra">"Question everything."</span>
            </div>
          </article>

          <!-- 02 TRUST -->
          <article class="v-card" style="--v-color:#766CFF;" data-animate data-animate-delay="2">
            <div class="v-card-bg"></div>
            <div class="v-card-corner v-card-corner--tl"></div>
            <div class="v-card-corner v-card-corner--br"></div>
            <span class="v-card-num">02</span>

            <div class="v-card-icon">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
              </svg>
            </div>

            <h4 class="v-card-title">Trust</h4>
            <p class="v-card-tagline">Earned, never assumed.</p>
            <p class="v-card-desc">
              Banking demands trust. We earn it through security, transparency, and reliability — in every release and every interaction.
            </p>

            <div class="v-card-foot">
              <span class="v-card-line"></span>
              <span class="v-card-mantra">"Reliability is the feature."</span>
            </div>
          </article>

          <!-- 03 COLLABORATION -->
          <article class="v-card" style="--v-color:#4799D1;" data-animate data-animate-delay="3">
            <div class="v-card-bg"></div>
            <div class="v-card-corner v-card-corner--tl"></div>
            <div class="v-card-corner v-card-corner--br"></div>
            <span class="v-card-num">03</span>

            <div class="v-card-icon">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>

            <h4 class="v-card-title">Collaboration</h4>
            <p class="v-card-tagline">Better together.</p>
            <p class="v-card-desc">
              We succeed together — with our clients, our partners, and each other. Every voice matters, every perspective counts.
            </p>

            <div class="v-card-foot">
              <span class="v-card-line"></span>
              <span class="v-card-mantra">"Strong opinions, loosely held."</span>
            </div>
          </article>

          <!-- 04 EXCELLENCE -->
          <article class="v-card" style="--v-color:#34D399;" data-animate data-animate-delay="4">
            <div class="v-card-bg"></div>
            <div class="v-card-corner v-card-corner--tl"></div>
            <div class="v-card-corner v-card-corner--br"></div>
            <span class="v-card-num">04</span>

            <div class="v-card-icon">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
              </svg>
            </div>

            <h4 class="v-card-title">Excellence</h4>
            <p class="v-card-tagline">Craft, always.</p>
            <p class="v-card-desc">
              Good enough isn't. We strive for craft in everything we ship — from code architecture to pixel-perfect interfaces.
            </p>

            <div class="v-card-foot">
              <span class="v-card-line"></span>
              <span class="v-card-mantra">"Sweat the details."</span>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         LEADERSHIP
         ═══════════════════════════════════════════ -->
    <hr class="section-divider">
    <section class="py-20 lg:py-28 bg-dark2">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16" data-animate>
          <p class="eyebrow">LEADERSHIP</p>
          <h2 class="text-3xl sm:text-4xl font-bold mb-4">The team behind Bankerise</h2>
          <p class="text-gray-400">A diverse team of engineers, designers, and banking experts united by a shared
            mission to democratize digital banking.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <div class="team-card" data-animate data-animate-delay="1">
            <div class="team-avatar">
              <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=200&h=200&fit=crop&crop=faces&auto=format&q=80"
                alt="Ahmed Hadj-Said" loading="lazy"
                class="w-full h-full object-cover rounded-full" />
            </div>
            <h4 class="font-bold text-lg">Ahmed Hadj-Said</h4>
            <p class="text-pacific text-sm font-medium mb-3">CEO & Co-Founder</p>
            <p class="text-gray-500 text-xs leading-relaxed mb-4">20+ years in enterprise software. Led Proxym Group
              from a small consultancy to a 500-engineer technology company.</p>
            <a href="#" class="text-gray-500 hover:text-pacific transition-colors inline-block" aria-label="LinkedIn">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
              </svg>
            </a>
          </div>

          <div class="team-card" data-animate data-animate-delay="2">
            <div class="team-avatar">
              <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=200&h=200&fit=crop&crop=faces&auto=format&q=80"
                alt="Sana Khelifi" loading="lazy"
                class="w-full h-full object-cover rounded-full" />
            </div>
            <h4 class="font-bold text-lg">Sana Khelifi</h4>
            <p class="text-aqua text-sm font-medium mb-3">CTO</p>
            <p class="text-gray-500 text-xs leading-relaxed mb-4">Architecture & platform engineering lead. Expert in
              distributed systems and API-first banking infrastructure.</p>
            <a href="#" class="text-gray-500 hover:text-pacific transition-colors inline-block" aria-label="LinkedIn">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
              </svg>
            </a>
          </div>

          <div class="team-card" data-animate data-animate-delay="3">
            <div class="team-avatar">
              <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop&crop=faces&auto=format&q=80"
                alt="Youssef Ben Ali" loading="lazy"
                class="w-full h-full object-cover rounded-full" />
            </div>
            <h4 class="font-bold text-lg">Youssef Ben Ali</h4>
            <p class="text-bell text-sm font-medium mb-3">VP Partnerships</p>
            <p class="text-gray-500 text-xs leading-relaxed mb-4">Built the global partner network from zero. Manages
              relationships across 4 continents and 150+ institutions.</p>
            <a href="#" class="text-gray-500 hover:text-pacific transition-colors inline-block" aria-label="LinkedIn">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
              </svg>
            </a>
          </div>

          <div class="team-card" data-animate data-animate-delay="4">
            <div class="team-avatar">
              <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=200&h=200&fit=crop&crop=faces&auto=format&q=80"
                alt="Lina Mezghani" loading="lazy"
                class="w-full h-full object-cover rounded-full" />
            </div>
            <h4 class="font-bold text-lg">Lina Mezghani</h4>
            <p class="text-green-400 text-sm font-medium mb-3">VP Product</p>
            <p class="text-gray-500 text-xs leading-relaxed mb-4">Product strategy & UX visionary. Ensures every module
              is intuitive, beautiful, and built for real-world banking needs.</p>
            <a href="#" class="text-gray-500 hover:text-pacific transition-colors inline-block" aria-label="LinkedIn">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         PROXYM GROUP — Backed by
         ═══════════════════════════════════════════ -->
    <section class="py-20 lg:py-28">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="glass-card p-8 lg:p-14 relative overflow-hidden" data-animate>
          <!-- Decorative gradient blobs reflecting Proxym logo colors -->
          <div class="absolute -top-20 -right-10 w-72 h-72 rounded-full blur-[90px] pointer-events-none opacity-[0.15]" style="background: #ED287A;"></div>
          <div class="absolute top-1/2 right-1/4 w-64 h-64 rounded-full blur-[80px] pointer-events-none opacity-[0.15]" style="background: #D6E047;"></div>
          <div class="absolute -bottom-20 -left-10 w-80 h-80 rounded-full blur-[100px] pointer-events-none opacity-[0.15]" style="background: #6AB4B8;"></div>
          <div class="absolute top-0 left-1/4 w-64 h-64 rounded-full blur-[80px] pointer-events-none opacity-[0.12]" style="background: #6D468E;"></div>

          <div class="relative z-10 grid lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-8">
              <div class="mb-8">
                <p class="eyebrow mb-2">PART OF SOMETHING BIGGER</p>
                <h2 class="text-3xl sm:text-4xl font-bold">Backed by Proxym Group</h2>
              </div>
              <p class="text-gray-400 text-lg leading-relaxed mb-10">Bankerise is a product of Proxym Group — a
                technology company with 20+ years of experience delivering enterprise solutions across Africa, the Middle
                East, and Central Asia. With 500+ engineers and a track record of mission-critical software delivery,
                Proxym provides the engineering backbone that makes Bankerise possible.</p>

              <div class="grid grid-cols-3 gap-6 max-w-md">
                <div class="text-center">
                  <p class="stat-number text-3xl" data-count="20">0</p>
                  <p class="text-gray-500 text-xs mt-1 font-medium">YEARS</p>
                </div>
                <div class="text-center">
                  <p class="stat-number text-3xl" data-count="500">0</p>
                  <p class="text-gray-500 text-xs mt-1 font-medium">ENGINEERS</p>
                </div>
                <div class="text-center">
                  <p class="stat-number text-3xl" data-count="15">0</p>
                  <p class="text-gray-500 text-xs mt-1 font-medium">COUNTRIES</p>
                </div>
              </div>
            </div>
            <div class="lg:col-span-4 flex justify-center lg:justify-end">
              <img src="assets/images/brand/proxym-logo.png" alt="Proxym Group Logo" class="w-48 lg:w-full max-w-[240px] drop-shadow-2xl opacity-90 hover:opacity-100 transition-opacity">
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         GLOBAL PRESENCE
         ═══════════════════════════════════════════ -->
    <section class="presence-section py-20 lg:py-32 bg-dark2 relative overflow-hidden">
      <div class="presence-bg-orb presence-bg-orb--1"></div>
      <div class="presence-bg-orb presence-bg-orb--2"></div>
      <div class="presence-grid-overlay"></div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-14" data-animate>
          <div class="purpose-eyebrow-wrap">
            <span class="purpose-eyebrow-line"></span>
            <p class="eyebrow !mb-0">GLOBAL PRESENCE</p>
            <span class="purpose-eyebrow-line"></span>
          </div>
          <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mt-6 mb-6 leading-[1.05] tracking-tight">
            Close to our <span class="gradient-text">customers</span>.
          </h2>
          <p class="text-gray-400 text-lg leading-relaxed">
            Proxym works in a multicultural environment, accompanying clients across
            <strong class="text-white font-semibold">Europe, Africa, and the Middle East</strong> —
            with <strong class="text-white font-semibold">5 regional offices</strong> serving
            <strong class="text-white font-semibold">20+ countries</strong>.
          </p>
        </div>
      </div>

      <!-- ── Animated flag marquees (full bleed) ── -->
      <div class="flag-marquee-wrap" data-animate>
        <!-- Edge fades -->
        <div class="flag-marquee-fade flag-marquee-fade--left"></div>
        <div class="flag-marquee-fade flag-marquee-fade--right"></div>

        <!-- Row 1 — scroll left  (Europe + North Africa + Egypt) -->
        <div class="flag-marquee">
          <div class="flag-track flag-track--left">
            <?php
              $row1 = [
                ['fr','France'],
                ['tn','Tunisia'], ['ma','Morocco'], ['dz','Algeria'], ['ly','Libya'],
                ['eg','Egypt'],
                ['sa','Saudi Arabia'], ['ae','UAE'], ['qa','Qatar'], ['kw','Kuwait'],
                ['bh','Bahrain'], ['om','Oman'], ['jo','Jordan'], ['iq','Iraq'],
              ];
              // Duplicate the list for seamless loop
              foreach (array_merge($row1, $row1) as $c):
            ?>
              <div class="flag-chip">
                <img src="https://flagcdn.com/w80/<?= $c[0] ?>.png" srcset="https://flagcdn.com/w160/<?= $c[0] ?>.png 2x" alt="<?= $c[1] ?> flag" loading="lazy" width="40" height="28">
                <span><?= $c[1] ?></span>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Row 2 — scroll right (West & Sub-Saharan Africa) -->
        <div class="flag-marquee">
          <div class="flag-track flag-track--right">
            <?php
              $row2 = [
                ['sn','Senegal'], ['ci',"Côte d'Ivoire"], ['ng','Nigeria'], ['gh','Ghana'],
                ['cm','Cameroon'], ['ml','Mali'], ['bf','Burkina Faso'], ['ne','Niger'],
                ['tg','Togo'], ['bj','Benin'], ['gn','Guinea'], ['mr','Mauritania'],
                ['kz','Kazakhstan'], ['uz','Uzbekistan'], ['kg','Kyrgyzstan'],
                ['tm','Turkmenistan'], ['tj','Tajikistan'],
              ];
              foreach (array_merge($row2, $row2) as $c):
            ?>
              <div class="flag-chip">
                <img src="https://flagcdn.com/w80/<?= $c[0] ?>.png" srcset="https://flagcdn.com/w160/<?= $c[0] ?>.png 2x" alt="<?= $c[1] ?> flag" loading="lazy" width="40" height="28">
                <span><?= $c[1] ?></span>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 mt-16">
        <!-- Stats strip -->
        <div class="presence-stats" data-animate>
          <div>
            <p class="presence-stat-num" data-count="20">0</p>
            <p class="presence-stat-lbl">Countries</p>
          </div>
          <div class="presence-stat-divider"></div>
          <div>
            <p class="presence-stat-num" data-count="5">0</p>
            <p class="presence-stat-lbl">Regional Offices</p>
          </div>
          <div class="presence-stat-divider"></div>
          <div>
            <p class="presence-stat-num" data-count="3" data-suffix="">0</p>
            <p class="presence-stat-lbl">Continents</p>
          </div>
          <div class="presence-stat-divider"></div>
          <div>
            <p class="presence-stat-num" data-count="150">0</p>
            <p class="presence-stat-lbl">Institutions</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         CTA
         ═══════════════════════════════════════════ -->
    <hr class="section-divider">
    <section class="py-20 lg:py-28 relative overflow-hidden noise-overlay">
      <div class="mesh-gradient">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
      </div>
      <div class="absolute inset-0 bg-dark/60 pointer-events-none"></div>
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6" data-animate>Join us on this journey</h2>
        <p class="text-gray-300 text-lg max-w-2xl mx-auto mb-10" data-animate data-animate-delay="1">Whether you're a
          bank looking to transform, a partner looking to grow, or a talent looking to build — we'd love to connect.</p>
        <div class="flex flex-wrap justify-center gap-4" data-animate data-animate-delay="2">
          <a href="contact.php" class="btn-primary text-lg !py-4 !px-10">Get in Touch
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
          </a>
          <a href="partners.php" class="btn-ghost text-lg !py-4 !px-10">Partner With Us</a>
        </div>
      </div>
    </section>

  </main>

  <?php include 'includes/footer.php'; ?>
  <script src="assets/js/shared.js"></script>

  <script>
    (function () {
      'use strict';



      /* ══════════════════════════════════════════════
         STORY TYPEWRITER
         ══════════════════════════════════════════════ */
      function initStoryTypewriter() {
        var root = document.querySelector('.story-typewriter');
        if (!root) return;

        // Snapshot original nodes, then clear visible content.
        var paragraphs = Array.prototype.slice.call(root.querySelectorAll(':scope > p'));
        var snapshots = paragraphs.map(function (p) {
          var clone = p.cloneNode(true);
          p.classList.add('tw-pending');
          p.innerHTML = '';
          return clone;
        });

        function typeNode(targetEl, sourceNode, charDelay, done) {
          var children = Array.prototype.slice.call(sourceNode.childNodes);
          var i = 0;

          function next() {
            if (i >= children.length) { done && done(); return; }
            var node = children[i++];

            if (node.nodeType === Node.TEXT_NODE) {
              var text = node.nodeValue;
              var idx = 0;
              (function tick() {
                if (idx < text.length) {
                  targetEl.appendChild(document.createTextNode(text.charAt(idx++)));
                  setTimeout(tick, charDelay);
                } else {
                  next();
                }
              })();
            } else if (node.nodeType === Node.ELEMENT_NODE) {
              var el = node.cloneNode(false); // clone tag + attrs, no kids
              targetEl.appendChild(el);
              typeNode(el, node, charDelay, next);
            } else {
              next();
            }
          }
          next();
        }

        function runSequence() {
          var idx = 0;
          function step() {
            if (idx >= paragraphs.length) return;
            var target = paragraphs[idx];
            var source = snapshots[idx];
            target.classList.remove('tw-pending');
            target.classList.add('tw-typing');
            // Faster on first paragraph (which has dropcap), feels punchier
            var delay = idx === 0 ? 14 : 12;
            typeNode(target, source, delay, function () {
              target.classList.remove('tw-typing');
              target.classList.add('tw-done');
              idx++;
              setTimeout(step, 240);
            });
          }
          step();
        }

        var io = new IntersectionObserver(function (entries) {
          entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            if (root.dataset.typed) return;
            root.dataset.typed = '1';
            runSequence();
            io.disconnect();
          });
        }, { threshold: 0.25 });
        io.observe(root);
      }

      /* ══════════════════════════════════════════════
         COUNTER ANIMATION
         ══════════════════════════════════════════════ */
      function animateCounters() {
        var counters = document.querySelectorAll('[data-count]');
        var observer = new IntersectionObserver(function (entries) {
          entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            var el = entry.target;
            if (el.dataset.counted) return;
            el.dataset.counted = '1';

            var target = parseInt(el.dataset.count, 10);
            var duration = 2000;
            var start = performance.now();
            var suffix = el.dataset.suffix || '+';

            function step(now) {
              var progress = Math.min((now - start) / duration, 1);
              var eased = 1 - Math.pow(1 - progress, 3);
              var current = Math.round(target * eased);
              el.textContent = current + suffix;
              if (progress < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
          });
        }, { threshold: 0.3 });

        counters.forEach(function (c) { observer.observe(c); });
      }

      /* ══════════════════════════════════════════════
         TEAM CARD SPOTLIGHT
         ══════════════════════════════════════════════ */
      function initTeamSpotlight() {
        document.querySelectorAll('.team-card').forEach(function (card) {
          card.addEventListener('mousemove', function (e) {
            var rect = card.getBoundingClientRect();
            var x = ((e.clientX - rect.left) / rect.width) * 100;
            var y = ((e.clientY - rect.top) / rect.height) * 100;
            card.style.setProperty('--mx', x + '%');
            card.style.setProperty('--my', y + '%');
          });
        });
      }

      /* ══════════════════════════════════════════════
         INIT
         ══════════════════════════════════════════════ */
      document.addEventListener('DOMContentLoaded', function () {
        animateCounters();
        initTeamSpotlight();
        initStoryTypewriter();
      });
    })();
  </script>
</body>

</html>
