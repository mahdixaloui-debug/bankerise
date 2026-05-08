<?php
/**
 * Bankerise — Shared Footer Component
 * 
 * Requires $base to be set before including.
 * Typically set by head.php.
 */
$base = $base ?? ($isSubfolder ? '../' : '');
?>
  <footer class="bg-[#0A0C18] border-t border-white/5 pt-16 pb-8" role="contentinfo">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">

        <!-- Column 1: Brand -->
        <div>
          <a href="<?= $base ?>index.php" class="flex items-center mb-6">
            <img src="<?= $base ?>assets/images/brand/logo-white.svg" alt="Bankerise" class="h-7 site-logo" />
          </a>
          <p class="text-gray-500 text-sm leading-relaxed mb-6">Experience Banking beyond Transactions. A product by Proxym Group.</p>
          <div class="flex gap-4">
            <a href="#" class="text-gray-500 hover:text-pacific transition-colors" aria-label="LinkedIn">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
            </a>
            <a href="#" class="text-gray-500 hover:text-pacific transition-colors" aria-label="X (Twitter)">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            </a>
            <a href="#" class="text-gray-500 hover:text-pacific transition-colors" aria-label="GitHub">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
            </a>
          </div>
        </div>

        <!-- Column 2: Product & Solutions -->
        <div>
          <h4 class="text-white font-semibold text-sm mb-6">Product</h4>
          <ul class="space-y-3">
            <li><a href="<?= $base ?>product.php" class="text-gray-500 text-sm hover:text-pacific transition-colors">Platform Overview</a></li>
            <li><a href="<?= $base ?>use-cases.php" class="text-gray-500 text-sm hover:text-pacific transition-colors">Use Cases</a></li>
          </ul>
          <h4 class="text-white font-semibold text-sm mt-6 mb-4">Solutions</h4>
          <ul class="space-y-3">
            <li><a href="<?= $base ?>solutions/retail.php" class="text-gray-500 text-sm hover:text-pacific transition-colors">Retail Banking</a></li>
            <li><a href="<?= $base ?>solutions/corporate.php" class="text-gray-500 text-sm hover:text-pacific transition-colors">Corporate Banking</a></li>
            <li><a href="<?= $base ?>solutions/micro.php" class="text-gray-500 text-sm hover:text-pacific transition-colors">Microfinance</a></li>
          </ul>
        </div>

        <!-- Column 3: Partners -->
        <div>
          <h4 class="text-white font-semibold text-sm mb-6">Partners</h4>
          <ul class="space-y-3">
            <li><a href="<?= $base ?>partners.php" class="text-gray-500 text-sm hover:text-pacific transition-colors">Why Partner</a></li>
            <li><a href="<?= $base ?>partners/apply.php" class="text-gray-500 text-sm hover:text-pacific transition-colors">Apply Now</a></li>
            <li><a href="<?= $base ?>academy.php" class="text-gray-500 text-sm hover:text-pacific transition-colors">Academy</a></li>
          </ul>
        </div>

        <!-- Column 4: Company -->
        <div>
          <h4 class="text-white font-semibold text-sm mb-6">Company</h4>
          <ul class="space-y-3">
            <li><a href="<?= $base ?>about.php" class="text-gray-500 text-sm hover:text-pacific transition-colors">About Us</a></li>
            <li><a href="<?= $base ?>contact.php" class="text-gray-500 text-sm hover:text-pacific transition-colors">Contact</a></li>
            <li><a href="<?= $base ?>privacy.php" class="text-gray-500 text-sm hover:text-pacific transition-colors">Privacy Policy</a></li>
            <li><a href="<?= $base ?>terms.php" class="text-gray-500 text-sm hover:text-pacific transition-colors">Terms of Service</a></li>
          </ul>
        </div>
      </div>

      <!-- Bottom bar -->
      <div class="border-t border-white/5 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
        <p class="text-gray-600 text-sm">&copy; 2026 Bankerise&reg; by Proxym Group. All rights reserved.</p>
        <div class="flex gap-6">
          <a href="<?= $base ?>privacy.php" class="text-gray-600 text-sm hover:text-gray-400 transition-colors">Privacy</a>
          <a href="<?= $base ?>terms.php" class="text-gray-600 text-sm hover:text-gray-400 transition-colors">Terms</a>
          <a href="<?= $base ?>privacy.php#cookies" class="text-gray-600 text-sm hover:text-gray-400 transition-colors">Cookies</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Chatbot Component -->
  <?php $chatbotVer = @filemtime(__DIR__ . '/../assets/js/components/chatbot.js') ?: time(); ?>
  <link rel="stylesheet" href="<?= $base ?>assets/css/components/chatbot.css?v=<?= $chatbotVer ?>" />
  <?php include __DIR__ . '/chatbot.php'; ?>
  <script src="<?= $base ?>assets/js/components/chatbot.js?v=<?= $chatbotVer ?>" defer></script>

<?php if (isset($pageScripts) && is_array($pageScripts)): ?>
<?php foreach ($pageScripts as $script): ?>
  <script src="<?= $base . $script ?>" defer></script>
<?php endforeach; ?>
<?php endif; ?>
