<?php
/**
 * Document Download Generator — Bankerise Partner Portal
 * Generates professional HTML documents for download
 */

$docs = [
  'sales-deck' => [
    'title' => 'Bankerise Sales Deck 2026',
    'filename' => 'Bankerise_Sales_Deck_2026.html',
    'sections' => [
      ['heading'=>'Executive Summary','body'=>'Bankerise is a modular, cloud-native digital banking platform purpose-built for financial institutions across emerging markets. Our end-to-end suite covers retail banking, corporate banking, microfinance, and agency banking — all delivered through a single, API-first architecture. With 50+ live deployments across MENA, Sub-Saharan Africa, and Central Asia, Bankerise powers digital transformation at scale.'],
      ['heading'=>'Market Opportunity','body'=>'The global digital banking platform market is projected to reach $13.9B by 2028 (CAGR 11.3%). In emerging markets alone, 1.4 billion adults remain unbanked — representing a $380B revenue opportunity for institutions that can deliver accessible, mobile-first financial services. Bankerise positions partners to capture this demand with pre-built, regulator-ready modules.'],
      ['heading'=>'Platform Modules','items'=>['Retail Banking Suite — Onboarding, accounts, cards, payments, lending','Corporate Banking Suite — Cash management, trade finance, treasury','Microfinance Engine — Group lending, savings circles, field agent tools','Agency Banking — Branchless banking via agent networks','Payment Hub — Real-time payments, bulk transfers, QR payments','Lending Engine — Credit scoring, loan origination, collections']],
      ['heading'=>'ROI Projections','body'=>'Typical client results within 12 months of deployment:','items'=>['60% reduction in customer onboarding time','45% lower operational costs through process automation','3.2x increase in digital transaction volume','28% growth in new customer acquisition','€2.1M average annual savings per institution']],
      ['heading'=>'Case Study: Gulf Digital Solutions','body'=>'Gulf Digital Solutions deployed Bankerise Retail + Payment Hub across 3 markets in 14 weeks. Results: 340,000 new digital accounts in 6 months, 89% mobile adoption rate, and €4.2M in new transaction revenue. Their CTO noted: "Bankerise gave us a 2-year head start over building in-house."'],
      ['heading'=>'Partnership Value Proposition','items'=>['18–25% recurring commission on all referred deals','Dedicated partner success manager','Co-branded marketing materials and lead generation support','Priority access to product roadmap and beta features','Quarterly business reviews with executive leadership']],
      ['heading'=>'Next Steps','body'=>'1. Schedule a platform demo with your prospect → 2. Bankerise pre-sales team joins for technical deep-dive → 3. Co-develop a tailored proposal → 4. Support through procurement and legal review → 5. Managed onboarding and go-live support. Average sales cycle: 8–14 weeks.'],
    ]
  ],
  'platform-overview' => [
    'title' => 'Platform Overview — Product Datasheet',
    'filename' => 'Bankerise_Platform_Overview.html',
    'sections' => [
      ['heading'=>'Architecture Overview','body'=>'Bankerise is built on a microservices architecture deployed on Kubernetes, supporting multi-tenant and single-tenant configurations. The platform uses event-driven communication (Apache Kafka), with PostgreSQL for transactional data and Redis for caching. All services expose RESTful APIs documented via OpenAPI 3.0 specifications.'],
      ['heading'=>'Core Modules','items'=>['Digital Onboarding — eKYC, biometric verification, document OCR, video KYC','Account Management — Multi-currency accounts, sub-accounts, joint accounts','Card Management — Virtual/physical card issuance, PIN management, 3DS','Payments — P2P, P2M, bill payments, scheduled transfers, standing orders','Lending — Credit scoring engine, loan origination, disbursement, collections','Savings — Goal-based savings, fixed deposits, recurring deposits']],
      ['heading'=>'Integration Layer','body'=>'The Bankerise Integration Hub provides 200+ pre-built connectors including: core banking systems (Temenos, Finastra, Flexcube), payment networks (SWIFT, SEPA, local ACH), identity providers (Jumio, Onfido, Smile Identity), credit bureaus, and mobile money platforms (M-Pesa, Orange Money, Wave).'],
      ['heading'=>'Security & Compliance','items'=>['ISO 27001 certified infrastructure','PCI-DSS Level 1 compliant card processing','GDPR and local data protection compliance','SOC 2 Type II audited annually','End-to-end encryption (AES-256 at rest, TLS 1.3 in transit)','Role-based access control with MFA enforcement']],
      ['heading'=>'Deployment Options','body'=>'Bankerise supports flexible deployment: SaaS (multi-tenant cloud), Dedicated Cloud (single-tenant on AWS/Azure/GCP), Hybrid (cloud control plane + on-premise data), and On-Premise (air-gapped environments for regulated markets). Typical deployment timeline: 8–16 weeks depending on customization scope.'],
      ['heading'=>'Performance & Scale','items'=>['99.99% uptime SLA with active-active redundancy','< 200ms API response time (P95)','10,000+ transactions per second capacity','Auto-scaling infrastructure handling 5M+ end users','Real-time analytics processing 1B+ events daily']],
    ]
  ],
  'api-guide' => [
    'title' => 'API Integration Guide — Technical Reference',
    'filename' => 'Bankerise_API_Integration_Guide.html',
    'sections' => [
      ['heading'=>'Authentication','body'=>'All API requests require OAuth 2.0 Bearer tokens. Use the /auth/token endpoint with your client_id and client_secret to obtain an access token (expires in 3600s). Refresh tokens are valid for 30 days. Rate limits: 1000 req/min for standard tier, 5000 req/min for premium partners.'],
      ['heading'=>'Base URLs','items'=>['Production: https://api.bankerise.com/v2','Sandbox: https://sandbox-api.bankerise.com/v2','Webhook callbacks: https://your-domain.com/webhooks/bankerise']],
      ['heading'=>'Core Endpoints','items'=>['POST /customers — Create customer profile with KYC data','GET /customers/{id}/accounts — List all accounts for a customer','POST /accounts/{id}/transactions — Initiate a transaction','GET /transactions/{id}/status — Check transaction status','POST /loans/applications — Submit loan application','GET /loans/{id}/schedule — Retrieve repayment schedule','POST /cards/virtual — Issue a virtual card','PUT /cards/{id}/controls — Update card spending controls']],
      ['heading'=>'Webhooks','body'=>'Register webhook endpoints to receive real-time notifications for: transaction.completed, transaction.failed, customer.kyc_verified, loan.approved, loan.disbursed, card.activated, account.balance_threshold. Webhook payloads are signed with HMAC-SHA256 using your webhook secret. Retry policy: 3 attempts with exponential backoff (1min, 5min, 30min).'],
      ['heading'=>'Error Handling','items'=>['400 — Bad Request: Invalid parameters (check "errors" array in response)','401 — Unauthorized: Invalid or expired token','403 — Forbidden: Insufficient permissions for this resource','404 — Not Found: Resource does not exist','409 — Conflict: Duplicate or state conflict','429 — Rate Limited: Retry after "Retry-After" header seconds','500 — Internal Error: Contact support with request_id from response']],
      ['heading'=>'SDKs & Libraries','body'=>'Official SDKs available for: Node.js (npm install @bankerise/sdk), Python (pip install bankerise), Java (Maven Central: com.bankerise:sdk), PHP (composer require bankerise/sdk). All SDKs include TypeScript definitions, automatic retry logic, and built-in request signing.'],
    ]
  ],
  'onboarding-kit' => [
    'title' => 'Partner Onboarding Kit',
    'filename' => 'Bankerise_Partner_Onboarding_Kit.html',
    'sections' => [
      ['heading'=>'Welcome to the Bankerise Partner Program','body'=>'Congratulations on joining the Bankerise Partner Network. This onboarding kit will guide you through everything you need to become a high-performing partner — from understanding our platform to closing your first deal. Our partner success team is with you every step of the way.'],
      ['heading'=>'Onboarding Timeline','items'=>['Week 1 — Account setup, portal access, NDA signing','Week 2 — Platform fundamentals training (3 sessions × 90 min)','Week 3 — Sales methodology workshop + demo environment access','Week 4 — First pipeline review with your Partner Success Manager','Month 2 — Advanced technical training + co-selling practice','Month 3 — Certification exam + first joint prospect engagement']],
      ['heading'=>'Training Modules','items'=>['Module 1: Bankerise Platform Deep Dive (2 hours)','Module 2: Target Market & Ideal Customer Profile (1.5 hours)','Module 3: Sales Playbook — Discovery to Close (2 hours)','Module 4: Demo Mastery — Running a Compelling Demo (1.5 hours)','Module 5: Competitive Positioning & Objection Handling (1 hour)','Module 6: Technical Pre-Sales & Solution Architecture (2 hours)']],
      ['heading'=>'Commission Structure','items'=>['Bronze Tier (0–3 deals): 18% of first-year contract value','Silver Tier (4–8 deals): 20% + quarterly performance bonus','Gold Tier (9–15 deals): 22% + co-marketing fund allocation','Platinum Tier (16+ deals): 25% + revenue share on renewals','Accelerator Bonus: 5% extra on deals closed within 60 days of lead registration']],
      ['heading'=>'Key Contacts','items'=>['Partner Success Manager — Your primary point of contact for strategy and pipeline reviews','Pre-Sales Engineering — Technical support for demos, POCs, and architecture discussions','Marketing Team — Co-branded content, event support, and campaign collaboration','Legal & Contracts — Partnership agreements, client MSAs, and compliance queries','Executive Sponsor — Quarterly business review and escalation path']],
      ['heading'=>'Checklist: Your First 30 Days','items'=>['☐ Complete partner portal registration and profile setup','☐ Sign Partner Agreement and NDA','☐ Attend all 3 platform fundamentals sessions','☐ Access and explore the sandbox demo environment','☐ Review the Sales Deck and ROI Calculator materials','☐ Identify 5 target prospects from your network','☐ Schedule first pipeline review with Partner Success Manager','☐ Register your first lead in the partner portal']],
    ]
  ],
  'partner-agreement' => [
    'title' => 'Partner Agreement Template',
    'filename' => 'Bankerise_Partner_Agreement_Template.html',
    'sections' => [
      ['heading'=>'1. Definitions & Interpretation','body'=>'This Partner Agreement ("Agreement") is entered into between Bankerise Technologies S.A. ("Company") and the Partner ("Partner") identified in the Partner Portal registration. "Referral" means a qualified lead submitted through official channels. "Commission" means the percentage-based fee payable to Partner upon successful deal closure. "Territory" means the geographic region assigned to Partner.'],
      ['heading'=>'2. Partner Obligations','items'=>['Actively promote Bankerise solutions within assigned Territory','Submit qualified leads exclusively through the Partner Portal','Maintain accurate pipeline data and provide monthly activity reports','Complete mandatory training and maintain active certification','Adhere to Bankerise brand guidelines in all marketing activities','Ensure compliance with local regulations and data protection laws']],
      ['heading'=>'3. Company Obligations','items'=>['Provide Partner with sales enablement materials and training','Assign a dedicated Partner Success Manager','Deliver pre-sales technical support for qualified opportunities','Process commission payments within 30 days of deal closure','Provide quarterly business reviews and pipeline analysis','Grant access to sandbox environments and demo instances']],
      ['heading'=>'4. Commission Schedule','body'=>'Commissions are calculated as a percentage of the first-year Annual Contract Value (ACV) of each closed deal. Standard rates: Bronze 18%, Silver 20%, Gold 22%, Platinum 25%. Commissions are payable upon client contract execution and first payment receipt. Renewal commissions (where applicable) are paid at 50% of the initial commission rate.'],
      ['heading'=>'5. Intellectual Property & Confidentiality','body'=>'All Bankerise trademarks, logos, product documentation, and proprietary information remain the exclusive property of the Company. Partner is granted a limited, non-exclusive, revocable license to use Bankerise marketing materials solely for authorized partner activities. Both parties agree to maintain confidentiality of all non-public information for a period of 3 years following Agreement termination.'],
      ['heading'=>'6. Term & Termination','body'=>'This Agreement is effective for an initial term of 12 months from the date of execution, with automatic renewal for successive 12-month periods unless terminated by either party with 90 days written notice. Either party may terminate immediately for material breach. Upon termination, Partner retains commission rights on deals closed prior to the termination date.'],
    ]
  ],
  'roi-calculator' => [
    'title' => 'ROI Calculator Deck',
    'filename' => 'Bankerise_ROI_Calculator_Deck.html',
    'sections' => [
      ['heading'=>'How to Use This Calculator','body'=>'This interactive ROI framework helps you demonstrate the financial impact of Bankerise to your prospects. Walk through each section with the client, input their current metrics, and show the projected improvements. The model is based on aggregated data from 50+ live Bankerise deployments across diverse markets.'],
      ['heading'=>'Cost Reduction Analysis','items'=>['Manual onboarding cost per customer: €45 → €8 with digital KYC (82% reduction)','Branch transaction cost: €2.50 → €0.12 via mobile/digital channels (95% reduction)','Loan processing cost: €180 → €35 with automated origination (81% reduction)','Customer service cost per interaction: €12 → €1.80 with AI chatbot (85% reduction)','Compliance/audit preparation time: 120 hours → 18 hours with automated reporting (85% reduction)']],
      ['heading'=>'Revenue Growth Projections','items'=>['New customer acquisition: +28% average increase via digital channels','Cross-sell conversion rate: 8% → 22% with AI-driven recommendations','Transaction volume growth: +320% within 12 months of digital launch','Loan portfolio expansion: +45% through automated credit decisioning','Fee income from digital services: €3.20 ARPU monthly uplift']],
      ['heading'=>'Implementation Investment','items'=>['Platform licensing: Tiered based on user volume and modules selected','Implementation services: Typically 15–20% of first-year license fee','Training & change management: Included in onboarding package','Annual maintenance & support: 18% of license fee (includes all updates)','Total cost of ownership: 40–60% lower than building equivalent in-house']],
      ['heading'=>'Payback Period Model','body'=>'Based on a mid-sized institution (500K customers, 3 modules): Initial investment of approximately €280,000 yields annual savings of €520,000 and incremental revenue of €380,000. Net benefit year 1: €620,000. Payback period: 5.4 months. 3-year ROI: 960%. These projections are conservative estimates — top-performing clients have achieved 2x these figures.'],
      ['heading'=>'Client Testimonial Benchmarks','items'=>['Algiers National Bank — "ROI exceeded projections by 140% in the first year"','Rabat MFI Network — "We onboarded 200,000 new micro-borrowers in 6 months"','Dubai FinBank — "Transaction costs dropped 93% after migrating to Bankerise"','Casablanca Finance — "The platform paid for itself in under 4 months"']],
    ]
  ],
];

$id = $_GET['doc'] ?? '';
if (!isset($docs[$id])) { http_response_code(404); echo 'Document not found.'; exit; }
$doc = $docs[$id];

// Build HTML document
$html = '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>' . htmlspecialchars($doc['title']) . '</title>';
$html .= '<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:Segoe UI,Helvetica,Arial,sans-serif;color:#1a1a2e;line-height:1.7;padding:48px;max-width:900px;margin:0 auto;background:#fff}
.header{text-align:center;padding:40px 0 32px;border-bottom:3px solid #4DB8CD;margin-bottom:40px}
.header h1{font-size:28px;color:#0D0F1C;margin-bottom:8px}
.header .sub{font-size:13px;color:#64748B;letter-spacing:0.05em;text-transform:uppercase}
.header .brand{font-size:14px;color:#4DB8CD;font-weight:700;margin-bottom:4px}
.section{margin-bottom:36px;page-break-inside:avoid}
.section h2{font-size:18px;color:#0D0F1C;border-left:4px solid #4DB8CD;padding-left:14px;margin-bottom:14px}
.section p{font-size:14px;color:#334155;margin-bottom:10px}
.section ul{list-style:none;padding:0}
.section ul li{font-size:13px;color:#475569;padding:8px 0 8px 24px;border-bottom:1px solid #f1f5f9;position:relative}
.section ul li::before{content:"▸";position:absolute;left:4px;color:#4DB8CD;font-weight:700}
.footer{margin-top:48px;padding-top:20px;border-top:2px solid #e2e8f0;text-align:center;font-size:11px;color:#94A3B8}
@media print{body{padding:24px}}</style></head><body>';
$html .= '<div class="header"><div class="brand">BANKERISE®</div><h1>' . htmlspecialchars($doc['title']) . '</h1>';
$html .= '<div class="sub">Confidential — Partner Use Only · ' . date('F Y') . '</div></div>';

foreach ($doc['sections'] as $s) {
    $html .= '<div class="section"><h2>' . htmlspecialchars($s['heading']) . '</h2>';
    if (!empty($s['body'])) $html .= '<p>' . htmlspecialchars($s['body']) . '</p>';
    if (!empty($s['items'])) {
        $html .= '<ul>';
        foreach ($s['items'] as $item) $html .= '<li>' . htmlspecialchars($item) . '</li>';
        $html .= '</ul>';
    }
    $html .= '</div>';
}

$html .= '<div class="footer">© ' . date('Y') . ' Bankerise Technologies S.A. — All Rights Reserved<br>This document is confidential and intended solely for authorized Bankerise partners.</div>';
$html .= '</body></html>';

header('Content-Type: text/html; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $doc['filename'] . '"');
header('Content-Length: ' . strlen($html));
echo $html;
