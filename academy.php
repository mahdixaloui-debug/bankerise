<?php
$pageTitle = 'Partner Academy — Bankerise®';
$pageDescription = 'Bankerise Partner Academy — interactive courses to learn how to become a partner, master the platform, and sell Bankerise. Enrol, download, and certify.';
$pageStyles = ['assets/css/pages/academy.css'];
include 'includes/head.php';
?>
</head>
<body class="font-montserrat bg-dark text-white">
  <?php include 'includes/navbar.php'; ?>

  <main id="main-content">

    <!-- HERO -->
    <section class="pt-32 pb-16 lg:pt-48 lg:pb-24 relative overflow-hidden">
      <!-- Full-width Background Image -->
      <div class="absolute inset-0 z-0">
        <img src="assets/images/academy-hero.jpg" alt="Academy Background" class="w-full h-full object-cover opacity-60" style="object-position: center 20%;" />
        <div class="absolute inset-0 bg-dark/60 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/80 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-dark via-transparent to-dark opacity-80"></div>
      </div>
      
      <div class="noise-overlay z-0"></div>
      
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <p class="eyebrow text-pacific shadow-sm" data-animate>BANKERISE PARTNER ACADEMY</p>
        <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold mb-6 leading-tight drop-shadow-xl" data-animate data-animate-delay="1">
          Become a Bankerise pro<br>
          <span class="gradient-text">Enrol. Download. Certify.</span>
        </h1>
        <p class="text-lg text-gray-300 max-w-2xl mx-auto mb-10 drop-shadow-md" data-animate data-animate-delay="2">
          Three short tracks — <strong class="text-white">Become a Partner</strong>, <strong class="text-white">Use Bankerise</strong>,
          <strong class="text-white">Sell Bankerise</strong>. Enrol in any course, download the playbook PDF, and mark it
          complete when you're done. Your progress is saved on this device.
        </p>
        <div class="flex flex-wrap justify-center gap-4" data-animate data-animate-delay="3">
          <a href="#tracks" class="btn-primary shadow-xl shadow-pacific/20">Start Learning <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></a>
          <a href="partners/apply.php" class="btn-ghost backdrop-blur-md bg-white/5 border border-white/10 hover:bg-white/10">Apply to be a Partner</a>
        </div>
      </div>
    </section>

    <!-- PROGRESS DASHBOARD -->
    <section class="pb-12 mt-8 lg:-mt-12 relative z-20" id="tracks">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="academy-progress-card glass-card p-6 sm:p-8 flex flex-col lg:flex-row items-start lg:items-center gap-8 shadow-2xl border border-white/10 rounded-2xl bg-dark/80 backdrop-blur-xl">
          
          <div class="flex items-center gap-6 flex-shrink-0">
            <div class="w-20 h-20 rounded-2xl flex items-center justify-center bg-gradient-to-br from-pacific to-aqua text-white font-extrabold text-3xl shadow-lg shadow-pacific/20">
              <span id="academyProgressBig">0%</span>
            </div>
            <div>
              <p class="text-sm uppercase tracking-widest text-pacific font-bold mb-1.5">Your Progress</p>
              <p id="academyProgressText" class="text-lg font-medium text-white">0 of 9 courses completed</p>
            </div>
          </div>

          <div class="flex-1 w-full mt-2 lg:mt-0">
            <div class="academy-progress-bar" style="height: 12px;">
              <span id="academyProgressBar"></span>
            </div>
          </div>

          <button data-action="reset" class="text-sm font-medium text-gray-400 hover:text-white transition-colors flex items-center gap-2 self-end lg:self-center bg-white/5 hover:bg-white/10 px-4 py-2.5 rounded-xl border border-white/5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            Reset Progress
          </button>

        </div>
      </div>
    </section>

    <!-- TRACKS + COURSES -->
    <section class="pb-16 lg:pb-20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <?php
        $tracks = [
          [
            'id'   => 'partner',
            'name' => 'Become a Partner',
            'desc' => 'Everything you need to apply, choose your tier, and onboard with Bankerise.',
            'color'=> '#4DB8CD',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>',
            'courses' => [
              ['id'=>'p1', 'code'=>'P-101', 'title'=>'Bankerise Partner Program 101', 'tag'=>'Why partner with Bankerise, who the program is for, and the benefits at every tier.', 'duration'=>'45 min', 'modules'=>4],
              ['id'=>'p2', 'code'=>'P-110', 'title'=>'Choosing Your Tier — Bronze, Silver or Gold', 'tag'=>'A decision framework to pick the tier that matches your team size, market and ambition.', 'duration'=>'30 min', 'modules'=>3],
              ['id'=>'p3', 'code'=>'P-120', 'title'=>'Onboarding & Legal Setup', 'tag'=>'From application to credentials — paperwork, MoU, NDAs and how long each step takes.', 'duration'=>'40 min', 'modules'=>4],
            ],
          ],
          [
            'id'   => 'use',
            'name' => 'Use Bankerise',
            'desc' => 'Master the platform — architecture, configuration, APIs. The technical foundation.',
            'color'=> '#766CFF',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M16 3v1.5m0 15V21m-8-9h8m-8 4h8M7.5 7.5h9v9h-9v-9z"/>',
            'courses' => [
              ['id'=>'u1', 'code'=>'U-201', 'title'=>'Bankerise Platform Architecture', 'tag'=>'Modules, services, data flow — the mental model every consultant needs day one.', 'duration'=>'55 min', 'modules'=>5],
              ['id'=>'u2', 'code'=>'U-210', 'title'=>'Configuring the Banking Modules', 'tag'=>'Walk through configuration — products, rules, channels — without writing a line of code.', 'duration'=>'60 min', 'modules'=>6],
              ['id'=>'u3', 'code'=>'U-220', 'title'=>'API Integration Basics', 'tag'=>'Authenticate, call core APIs, subscribe to webhooks. The minimum viable integration.', 'duration'=>'50 min', 'modules'=>5],
            ],
          ],
          [
            'id'   => 'sell',
            'name' => 'Sell Bankerise',
            'desc' => 'Pitch, demo, handle objections, close. The playbook that turns interest into deals.',
            'color'=> '#4799D1',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>',
            'courses' => [
              ['id'=>'s1', 'code'=>'S-301', 'title'=>'The Bankerise Pitch', 'tag'=>'A 3-minute story that lands with bank executives — from problem to proof.', 'duration'=>'35 min', 'modules'=>4],
              ['id'=>'s2', 'code'=>'S-310', 'title'=>'Live Demo Walkthrough', 'tag'=>'A 25-minute scripted demo covering onboarding, lending and analytics — in that order.', 'duration'=>'50 min', 'modules'=>5],
              ['id'=>'s3', 'code'=>'S-320', 'title'=>'Handling Objections & Closing', 'tag'=>'The 8 objections you will hear in MEA and how to answer each in under 60 seconds.', 'duration'=>'40 min', 'modules'=>4],
            ],
          ],
        ];
        ?>

        <?php foreach ($tracks as $idx => $track): ?>
        <div class="academy-track" data-track-id="<?= $track['id'] ?>" data-animate data-animate-delay="<?= $idx ?>">
          <div class="academy-track__head">
            <div class="academy-track__title">
              <div class="academy-track__icon" style="background: <?= $track['color'] ?>1a; color: <?= $track['color'] ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><?= $track['icon'] ?></svg>
              </div>
              <div>
                <p class="text-xs font-semibold tracking-widest" style="color: <?= $track['color'] ?>">TRACK 0<?= $idx+1 ?></p>
                <h2 class="text-xl sm:text-2xl font-bold"><?= $track['name'] ?></h2>
              </div>
            </div>
            <div class="flex items-center gap-3 flex-wrap justify-end">
              <span class="text-xs text-gray-400" data-track-label>0 / <?= count($track['courses']) ?></span>
              <div class="academy-track__bar"><span data-track-bar></span></div>
              <span class="academy-track__badge" data-track-badge>
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17l-3.5-3.5-1.42 1.41L9 19l11-11-1.41-1.41z"/></svg>
                Track Certified
              </span>
            </div>
          </div>
          <p class="text-sm text-gray-400 mb-5 max-w-3xl"><?= $track['desc'] ?></p>

          <div class="grid md:grid-cols-3 gap-4">
            <?php foreach ($track['courses'] as $course): ?>
              <article class="academy-course" data-course-id="<?= $course['id'] ?>" data-status="idle">
                <div class="academy-course__head">
                  <span class="academy-course__code"><?= $course['code'] ?></span>
                  <span class="academy-course__check" data-check>✓</span>
                </div>
                <h3 class="academy-course__title"><?= htmlspecialchars($course['title']) ?></h3>
                <p class="academy-course__tag"><?= htmlspecialchars($course['tag']) ?></p>
                <div class="academy-course__meta">
                  <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <?= $course['duration'] ?>
                  </span>
                  <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                    <?= $course['modules'] ?> modules
                  </span>
                </div>
                <div class="academy-course__actions">
                  <button class="academy-btn academy-btn--enroll" data-action="enroll">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    Enrol
                  </button>
                  <button class="academy-btn academy-btn--download hidden" data-action="download">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Download PDF
                  </button>
                  <button class="academy-btn academy-btn--complete hidden" data-action="complete">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Mark as Complete
                  </button>
                </div>
                <p class="academy-state-label" data-state-label>Not started</p>
              </article>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; ?>

      </div>
    </section>

    <!-- CERTIFICATE -->
    <section class="py-16 lg:py-20" id="certificate">
      <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="academy-cert" id="academyCertificate">
          <div class="academy-cert__seal">★</div>
          <p class="eyebrow" style="color:#4ade80">CERTIFIED PARTNER</p>
          <h2 class="text-3xl sm:text-4xl font-bold mt-3 mb-3">Bankerise Partner Academy Diploma</h2>
          <p class="text-gray-400 max-w-xl mx-auto">Complete every course in the three tracks to unlock your Bankerise Partner certification — proof you're ready to onboard, deliver, and sell.</p>
          <p class="academy-cert__lock mt-4">
            <span class="not-unlocked">🔒 Locked — finish all 9 courses to unlock</span>
            <span class="is-unlocked-msg">★ Unlocked — ready to share with the partner team</span>
          </p>
          <div class="mt-6 flex flex-wrap justify-center gap-3">
            <a href="partners/apply.php" class="btn-primary">Apply with my certificate <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg></a>
            <a href="contact.php" class="btn-ghost">Talk to a partner manager</a>
          </div>
        </div>
      </div>
    </section>

    <!-- HOW IT WORKS -->
    <section class="py-12 bg-dark2">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 grid sm:grid-cols-3 gap-6">
        <div class="text-center">
          <div class="w-12 h-12 rounded-full bg-pacific/15 text-pacific flex items-center justify-center mx-auto mb-3 font-bold">1</div>
          <h4 class="font-bold mb-1">Enrol</h4>
          <p class="text-sm text-gray-400">Pick any course and click Enrol. No account, no login — just start.</p>
        </div>
        <div class="text-center">
          <div class="w-12 h-12 rounded-full bg-aqua/15 text-aqua flex items-center justify-center mx-auto mb-3 font-bold">2</div>
          <h4 class="font-bold mb-1">Download the PDF</h4>
          <p class="text-sm text-gray-400">A branded course playbook is generated and downloads to your device.</p>
        </div>
        <div class="text-center">
          <div class="w-12 h-12 rounded-full bg-bell/15 text-bell flex items-center justify-center mx-auto mb-3 font-bold">3</div>
          <h4 class="font-bold mb-1">Mark complete</h4>
          <p class="text-sm text-gray-400">Once you've read it, mark the course complete to update your progress.</p>
        </div>
      </div>
    </section>

  </main>

  <?php include 'includes/footer.php'; ?>
  <script src="assets/js/shared.js?v=<?= $assetVersion ?>"></script>
  <script src="assets/js/pages/academy.js?v=<?= $assetVersion ?>"></script>
</body>
</html>
