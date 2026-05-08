<?php
/**
 * Bankerise — Use Case Detail Page (Dynamic)
 * Renders a full case study based on ?case=slug
 */

$cases = [
  'coris-digital-banking' => [
    'audience' => 'clevel', 'accent' => '#4DB8CD',
    'client' => ['abbr'=>'CG','name'=>'Coris Group','region'=>'West Africa'],
    'title' => 'Redefining Banking of Tomorrow through Strategic Partnership',
    'subtitle' => 'How Coris Group and Bankerise partnered to build a next-generation digital banking experience across multiple West African markets.',
    'metrics' => [['val'=>'8M+','label'=>'Customers'],['val'=>'10+','label'=>'Countries'],['val'=>'60%','label'=>'Digital Adoption'],['val'=>'3x','label'=>'Faster Onboarding']],
    'tags' => ['Digital Strategy','Partnership','Scale','West Africa'],
    'challenge' => 'Coris Group, one of West Africa\'s largest banking networks, needed to unify digital banking across 10+ countries with different regulatory environments while maintaining a consistent customer experience.',
    'solution' => 'Bankerise deployed a multi-tenant digital banking platform with country-specific regulatory adapters, enabling Coris to launch unified mobile and internet banking across all markets from a single codebase.',
    'results' => ['Unified digital experience across 10+ countries','8M+ customers onboarded digitally','60% increase in digital channel adoption','3x faster account opening process','Regulatory compliance automated per jurisdiction'],
    'products' => ['Digital Onboarding','Omnichannel Banking','Analytics & CRM'],
  ],
  'sme-credit-ai' => [
    'audience' => 'tech', 'accent' => '#766CFF',
    'client' => ['abbr'=>'AI','name'=>'AI Credit Engine','region'=>'Global'],
    'title' => 'Empowering SME Credit Decisioning with Responsible AI',
    'subtitle' => 'Leveraging AI to reduce manual credit assessment, speed up risk scoring, and ensure regulatory compliance across jurisdictions.',
    'metrics' => [['val'=>'60%','label'=>'Faster Scoring'],['val'=>'3x','label'=>'Throughput'],['val'=>'92%','label'=>'Accuracy'],['val'=>'45%','label'=>'Cost Reduction']],
    'tags' => ['AI / ML','Credit Risk','Compliance','SME'],
    'challenge' => 'Traditional credit scoring for SMEs relied on manual processes that took days, with high error rates and inconsistent decisioning across branches.',
    'solution' => 'Bankerise integrated an AI-powered credit scoring engine with configurable risk models, automated document collection, and real-time portfolio monitoring.',
    'results' => ['60% faster credit scoring turnaround','3x increase in loan processing throughput','92% model accuracy on SME risk assessment','Fully auditable AI decisions for regulators','Multi-jurisdiction compliance built-in'],
    'products' => ['Smart Lending','Analytics & CRM'],
  ],
  'mobile-banking-ux' => [
    'audience' => 'clevel', 'accent' => '#4DB8CD',
    'client' => ['abbr'=>'UX','name'=>'Mobile-First Banking','region'=>'MENA & Africa'],
    'title' => 'Ultra-Connected Customers Expect Banking at Their Fingertips',
    'subtitle' => 'How leading institutions meet the demands of hyper-connected customers while preserving human touchpoints.',
    'metrics' => [['val'=>'85%','label'=>'Mobile Adoption'],['val'=>'4.8★','label'=>'App Rating'],['val'=>'40%','label'=>'Branch Reduction'],['val'=>'2M+','label'=>'Active Users']],
    'tags' => ['Mobile UX','Digital Channels','CX'],
    'challenge' => 'Banks across MENA and Africa faced declining branch traffic while mobile penetration soared. They needed a mobile-first banking experience without losing the human touch.',
    'solution' => 'Bankerise delivered a mobile-first banking app with biometric login, instant transfers, AI chatbot support, and seamless branch-to-digital handoffs.',
    'results' => ['85% mobile banking adoption in 12 months','4.8-star app store rating','40% reduction in routine branch visits','AI chatbot handling 65% of support queries','Seamless omnichannel customer journey'],
    'products' => ['Omnichannel Banking','Digital Onboarding'],
  ],
  'africa-positioning' => [
    'audience' => 'partner', 'accent' => '#34D399',
    'client' => ['abbr'=>'PG','name'=>'Proxym Group','region'=>'Pan-Africa'],
    'title' => 'Strengthening Strategic Positioning Across the African Continent',
    'subtitle' => 'How Bankerise expanded its footprint across Africa with localized deployment and domain expertise.',
    'metrics' => [['val'=>'20+','label'=>'Countries'],['val'=>'50+','label'=>'Deployments'],['val'=>'150+','label'=>'Institutions'],['val'=>'14M+','label'=>'End Users']],
    'tags' => ['Market Expansion','Africa','Localization'],
    'challenge' => 'Expanding digital banking across Africa requires deep understanding of local regulations, languages, payment systems, and infrastructure constraints in each market.',
    'solution' => 'Bankerise built a partner-driven expansion model with localized deployments, regional compliance engines, and multi-language support for each African market.',
    'results' => ['Presence in 20+ African countries','50+ successful deployments','Local partner network in every region','Multi-language and multi-currency support','Offline-first capability for low-connectivity areas'],
    'products' => ['Partner Portal','Omnichannel Banking','Analytics & CRM'],
  ],
  'digital-transformation-2025' => [
    'audience' => 'tech', 'accent' => '#766CFF',
    'client' => ['abbr'=>'DT','name'=>'Digital Platform','region'=>'Global'],
    'title' => 'Accelerating User-Centric Digital Transformation in 2025',
    'subtitle' => 'How Bankerise enables financial institutions to build user-centered digital products using composable architecture.',
    'metrics' => [['val'=>'40%','label'=>'Faster TTM'],['val'=>'99.9%','label'=>'Uptime'],['val'=>'200+','label'=>'API Endpoints'],['val'=>'50%','label'=>'Dev Cost Cut']],
    'tags' => ['Architecture','Composable','DevOps'],
    'challenge' => 'Financial institutions struggled with monolithic legacy systems that made it impossible to iterate quickly on digital products or integrate with modern fintech partners.',
    'solution' => 'Bankerise provides a composable, API-first platform with microservices architecture, enabling banks to assemble digital experiences from modular building blocks.',
    'results' => ['40% faster time-to-market for new features','99.9% platform uptime SLA','200+ REST API endpoints for integration','50% reduction in development costs','CI/CD pipelines with automated testing'],
    'products' => ['Smart Lending','Digital Onboarding','Analytics & CRM'],
  ],
  'customer-onboarding' => [
    'audience' => 'clevel', 'accent' => '#4DB8CD',
    'client' => ['abbr'=>'KY','name'=>'Digital Onboarding','region'=>'MENA'],
    'title' => 'Overcoming Customer Onboarding Challenges in Banking',
    'subtitle' => 'From manual document submission to AI-powered eKYC in under 4 minutes.',
    'metrics' => [['val'=>'87%','label'=>'Completion'],['val'=>'4min','label'=>'Avg. Time'],['val'=>'95%','label'=>'Auto-Verify'],['val'=>'70%','label'=>'Drop-off Cut']],
    'tags' => ['eKYC','Onboarding','Compliance'],
    'challenge' => 'Banks in MENA faced 60%+ drop-off rates during account opening due to lengthy paper-based KYC processes requiring multiple branch visits.',
    'solution' => 'Bankerise Digital Onboarding uses AI-powered document scanning, biometric verification, and real-time compliance checks to complete eKYC in under 4 minutes.',
    'results' => ['87% onboarding completion rate','Average 4-minute account opening','95% automated document verification','70% reduction in drop-off rates','Full regulatory compliance maintained'],
    'products' => ['Digital Onboarding'],
  ],
  'check-digitization' => [
    'audience' => 'tech', 'accent' => '#766CFF',
    'client' => ['abbr'=>'BS','name'=>'BSIC Sénégal','region'=>'West Africa'],
    'title' => 'Digitizing Check Clearing with AI-Powered MICR & OCR',
    'subtitle' => 'Eliminating paper-based check clearing across 12 branches with real-time scanning and same-day settlement.',
    'metrics' => [['val'=>'92%','label'=>'Paper Cut'],['val'=>'$180K','label'=>'Savings/Yr'],['val'=>'12','label'=>'Branches'],['val'=>'<1hr','label'=>'Settlement']],
    'tags' => ['MICR/OCR','Check Processing','Automation'],
    'challenge' => 'BSIC Sénégal processed thousands of checks manually across 12 branches, with high error rates, slow clearing times, and significant operational costs.',
    'solution' => 'Bankerise deployed an AI-powered check digitization system with MICR/OCR scanning, automated validation, and BCEAO-compliant digital settlement.',
    'results' => ['92% reduction in paper-based processing','$180K annual operational savings','Same-day check clearing (from 3-5 days)','Automated fraud detection on check images','Full BCEAO regulatory compliance'],
    'products' => ['Smart Lending','Analytics & CRM'],
  ],
  'proxy-payments' => [
    'audience' => 'clevel', 'accent' => '#4DB8CD',
    'client' => ['abbr'=>'DB','name'=>'Dukhan Bank','region'=>'Qatar'],
    'title' => 'Instant Transfers via Phone Number & QR Code Proxy',
    'subtitle' => 'Replacing IBAN-based transfers with phone and QR proxy payments for faster, error-free transactions.',
    'metrics' => [['val'=>'340K','label'=>'Monthly Txns'],['val'=>'<2s','label'=>'Settlement'],['val'=>'0.3%','label'=>'Error Rate'],['val'=>'4x','label'=>'P2P Growth']],
    'tags' => ['Proxy Pay','QR Code','FAWRI+'],
    'challenge' => 'Dukhan Bank customers found IBAN-based transfers error-prone (8.3% failure rate) and slow, leading to low adoption of digital payment channels.',
    'solution' => 'Bankerise implemented proxy payment capabilities allowing transfers via phone number and QR code, integrated with Qatar\'s FAWRI+ instant payment system.',
    'results' => ['340K+ monthly proxy transactions','Sub-2-second settlement times','Error rate reduced from 8.3% to 0.3%','4x growth in P2P transaction volume','Full FAWRI+ system integration'],
    'products' => ['Omnichannel Banking'],
  ],
  'group-banking-tontines' => [
    'audience' => 'partner', 'accent' => '#34D399',
    'client' => ['abbr'=>'AC','name'=>'ADI Consumer Finance','region'=>'Côte d\'Ivoire'],
    'title' => 'Digitizing Tontines & Group Savings Circles at Scale',
    'subtitle' => 'Bringing the $12B informal tontine market into formal banking with digital group finance.',
    'metrics' => [['val'=>'8.4K','label'=>'Active Groups'],['val'=>'34K','label'=>'New Accounts'],['val'=>'$2.1M','label'=>'Monthly Volume'],['val'=>'78%','label'=>'Retention']],
    'tags' => ['Group Finance','Mobile Money','Inclusion'],
    'challenge' => 'The informal tontine market in West Africa represents $12B+ in annual savings, but operates entirely outside the banking system with no digital infrastructure.',
    'solution' => 'Bankerise built a digital group savings platform with mobile money integration, automated contribution scheduling, and transparent fund management.',
    'results' => ['8,400+ active savings groups digitized','34,000 new bank accounts opened','$2.1M monthly group savings volume','78% member retention rate','Mobile money integration for unbanked'],
    'products' => ['Digital Onboarding','Omnichannel Banking'],
  ],
  'multi-country-platform' => [
    'audience' => 'partner', 'accent' => '#34D399',
    'client' => ['abbr'=>'BG','name'=>'BGFI Bank','region'=>'Pan-Africa · 11 Countries'],
    'title' => 'Unified Digital Platform Across 11 Countries & Regulators',
    'subtitle' => 'A single multi-tenant deployment powering digital banking across 11 African countries.',
    'metrics' => [['val'=>'1.2M','label'=>'Users'],['val'=>'45%','label'=>'Ops Cost Cut'],['val'=>'11','label'=>'Countries'],['val'=>'99.9%','label'=>'Uptime']],
    'tags' => ['Multi-Tenant','Pan-Africa','Unified'],
    'challenge' => 'BGFI Bank needed a unified digital platform across 11 countries, each with different regulators, currencies, languages, and payment systems.',
    'solution' => 'Bankerise deployed a multi-tenant platform with country-specific regulatory adapters, multi-currency support, and centralized management.',
    'results' => ['1.2M+ active digital banking users','45% reduction in operational costs','Single platform across 11 countries','Country-specific regulatory compliance','Centralized analytics and reporting'],
    'products' => ['Omnichannel Banking','Analytics & CRM','Partner Portal'],
  ],
  'digital-lending' => [
    'audience' => 'tech', 'accent' => '#766CFF',
    'client' => ['abbr'=>'DL','name'=>'Digital Lending','region'=>'MENA'],
    'title' => 'Transforming Lending into a Seamless Digital Experience',
    'subtitle' => 'End-to-end digital loan origination reducing approval cycles from days to minutes.',
    'metrics' => [['val'=>'15min','label'=>'Avg. Approval'],['val'=>'3x','label'=>'Volume Growth'],['val'=>'85%','label'=>'Auto-Decision'],['val'=>'$50M+','label'=>'Disbursed']],
    'tags' => ['Lending','E-Signature','Automation'],
    'challenge' => 'Loan applications required multiple branch visits, manual document processing, and committee-based approvals taking 5-7 business days.',
    'solution' => 'Bankerise digitized the entire lending lifecycle with online applications, automated scoring, e-signature workflows, and real-time disbursement.',
    'results' => ['Average 15-minute loan approval','3x increase in loan volume','85% of decisions fully automated','$50M+ disbursed digitally','E-signature eliminating paper contracts'],
    'products' => ['Smart Lending','Digital Onboarding'],
  ],
  'omnichannel-banking' => [
    'audience' => 'clevel', 'accent' => '#4DB8CD',
    'client' => ['abbr'=>'OC','name'=>'Omnichannel Suite','region'=>'Global'],
    'title' => 'Seamless Banking Across Every Channel and Touchpoint',
    'subtitle' => 'Delivering a consistent experience across mobile, web, branch, and agent channels.',
    'metrics' => [['val'=>'4','label'=>'Channels'],['val'=>'60%','label'=>'Digital Shift'],['val'=>'35%','label'=>'Cost Savings'],['val'=>'4.6★','label'=>'CSAT Score']],
    'tags' => ['Omnichannel','Branch','Unified CX'],
    'challenge' => 'Customers interacting across mobile, web, and branch channels experienced fragmented journeys with no session continuity or unified data.',
    'solution' => 'Bankerise\'s omnichannel platform provides unified session management, real-time data synchronization, and consistent UX across all banking channels.',
    'results' => ['4 channels unified under one platform','60% shift from branch to digital','35% reduction in service costs','4.6-star customer satisfaction score','Seamless branch-to-mobile handoff'],
    'products' => ['Omnichannel Banking','Analytics & CRM'],
  ],
];

$slug = isset($_GET['case']) ? $_GET['case'] : '';
if (!isset($cases[$slug])) {
  header('Location: ../use-cases.php');
  exit;
}

$uc = $cases[$slug];
$isSubfolder = true;
$pageTitle = $uc['title'] . ' — Bankerise® Use Case';
$pageDescription = $uc['subtitle'];
$pageStyles = ['assets/css/pages/use-case-detail.css'];
include '../includes/head.php';

$audienceLabels = [
  'clevel' => ['label'=>'Bank Decision Makers','cls'=>'ucd-badge--clevel','icon'=>'<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>'],
  'tech' => ['label'=>'Technology & Product','cls'=>'ucd-badge--tech','icon'=>'<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>'],
  'partner' => ['label'=>'Partner Ecosystem','cls'=>'ucd-badge--partner','icon'=>'<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>'],
];
$aud = $audienceLabels[$uc['audience']];

// Get 3 other cases for "More Cases" section
$otherCases = [];
foreach ($cases as $k => $v) {
  if ($k !== $slug && count($otherCases) < 3) {
    $otherCases[$k] = $v;
  }
}
?>
</head>
<body class="font-montserrat bg-dark text-white" style="--accent:<?= $uc['accent'] ?>">
  <?php include '../includes/navbar.php'; ?>

  <main id="main-content">

    <!-- HERO -->
    <section class="ucd-hero noise-overlay">
      <div class="mesh-gradient opacity-30">
        <div class="blob blob-1" style="background:<?= $uc['accent'] ?>"></div>
        <div class="blob blob-2"></div>
      </div>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
        <div class="ucd-hero-content" data-animate>
          <nav class="ucd-breadcrumb">
            <a href="<?= $base ?>index.php">Home</a><span class="sep">/</span>
            <a href="<?= $base ?>use-cases.php">Use Cases</a><span class="sep">/</span>
            <span class="current"><?= htmlspecialchars($uc['client']['name']) ?></span>
          </nav>
          <span class="ucd-badge <?= $aud['cls'] ?>"><?= $aud['icon'] ?> <?= $aud['label'] ?></span>
          <h1 class="ucd-title"><?= htmlspecialchars($uc['title']) ?></h1>
          <p class="ucd-subtitle"><?= htmlspecialchars($uc['subtitle']) ?></p>
          <div class="ucd-client-bar">
            <div class="ucd-client-logo"><?= htmlspecialchars($uc['client']['abbr']) ?></div>
            <div>
              <div class="ucd-client-name"><?= htmlspecialchars($uc['client']['name']) ?></div>
              <div class="ucd-client-region"><?= htmlspecialchars($uc['client']['region']) ?></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- METRICS -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="ucd-metrics" data-animate>
        <div class="ucd-metrics-grid">
          <?php foreach ($uc['metrics'] as $m): ?>
          <div class="ucd-metric-card">
            <div class="ucd-metric-val"><?= htmlspecialchars($m['val']) ?></div>
            <div class="ucd-metric-label"><?= htmlspecialchars($m['label']) ?></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- BODY -->
    <section class="ucd-body">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="ucd-content-grid">

          <!-- Article -->
          <article class="ucd-article" data-animate>
            <h2>The Challenge</h2>
            <p><?= htmlspecialchars($uc['challenge']) ?></p>

            <hr class="ucd-section-break">

            <h2>The Solution</h2>
            <p><?= htmlspecialchars($uc['solution']) ?></p>

            <hr class="ucd-section-break">

            <h2>Key Results</h2>
            <ul>
              <?php foreach ($uc['results'] as $r): ?>
              <li>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <?= htmlspecialchars($r) ?>
              </li>
              <?php endforeach; ?>
            </ul>
          </article>

          <!-- Sidebar -->
          <aside class="ucd-sidebar" data-animate="right">
            <div class="ucd-sidebar-card">
              <div class="ucd-sidebar-title">Technologies</div>
              <div class="ucd-tags">
                <?php foreach ($uc['tags'] as $tag): ?>
                <span class="ucd-tag"><?= htmlspecialchars($tag) ?></span>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="ucd-sidebar-card">
              <div class="ucd-sidebar-title">Products Used</div>
              <div class="ucd-related-list">
                <?php foreach ($uc['products'] as $prod): ?>
                <a href="<?= $base ?>product.php" class="ucd-related-item">
                  <div class="ucd-related-icon" style="background:rgba(77,184,205,0.1)">
                    <svg class="text-pacific" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                  </div>
                  <?= htmlspecialchars($prod) ?>
                </a>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="ucd-sidebar-card" style="background:linear-gradient(135deg, rgba(77,184,205,0.06), rgba(118,108,255,0.04)); border-color:rgba(77,184,205,0.15)">
              <div class="ucd-sidebar-title">Have a similar challenge?</div>
              <p class="text-sm text-gray-400 mb-4" style="line-height:1.7">Let us show you how Bankerise maps to your specific goals.</p>
              <a href="<?= $base ?>contact.php" class="btn-primary w-full justify-center text-sm !py-3">
                Request a Demo
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
              </a>
            </div>
          </aside>

        </div>
      </div>
    </section>

    <!-- OTHER CASES -->
    <section class="ucd-other-cases">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="ucd-other-header" data-animate>
          <p class="eyebrow">MORE USE CASES</p>
          <h2>Explore Other Success Stories</h2>
          <p>See how other financial institutions are transforming with Bankerise.</p>
        </div>
        <div class="ucd-other-grid" data-animate>
          <?php foreach ($otherCases as $k => $c): ?>
          <a href="?case=<?= $k ?>" class="ucd-other-card" style="--accent:<?= $c['accent'] ?>">
            <div class="ucd-other-card-title"><?= htmlspecialchars($c['title']) ?></div>
            <div class="ucd-other-card-excerpt"><?= htmlspecialchars($c['subtitle']) ?></div>
            <div class="ucd-other-card-meta">
              <span class="ucd-other-card-region"><?= htmlspecialchars($c['client']['region']) ?></span>
              <span class="ucd-other-card-arrow"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg></span>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="ucd-cta noise-overlay">
      <div class="mesh-gradient opacity-20"><div class="blob blob-1"></div><div class="blob blob-2"></div></div>
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10" data-animate>
        <h2>Ready to write your own success story?</h2>
        <p>Schedule a personalized demo and discover how Bankerise can transform your institution.</p>
        <div class="ucd-cta-actions">
          <a href="<?= $base ?>contact.php" class="btn-primary">Request a Demo <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg></a>
          <a href="<?= $base ?>use-cases.php" class="btn-ghost">View All Use Cases</a>
        </div>
      </div>
    </section>

  </main>
  <?php include '../includes/footer.php'; ?>
  <script src="<?= $base ?>assets/js/shared.js"></script>
</body>
</html>
