<?php
/**
 * Bankerise — Shared Navbar Component
 * 
 * Requires $base and $isSubfolder to be set before including.
 * Typically set by head.php.
 */
$base = $base ?? ($isSubfolder ? '../' : '');
$currentPage = basename($_SERVER['PHP_SELF']);
$isPartnersPage = ($currentPage === 'partners.php');
?>
  <a href="#main-content" class="skip-link">Skip to main content</a>
  <nav class="navbar-glass fixed top-0 left-0 w-full z-50" role="navigation" aria-label="Main navigation">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">

        <!-- Logo -->
        <a href="<?= $base ?>index.php" class="flex items-center group" aria-label="Bankerise Home">
          <img src="<?= $base ?>assets/images/brand/logo-colored.svg" alt="Bankerise" class="h-8 site-logo" />
        </a>

        <!-- Desktop Navigation -->
        <div class="hidden lg:flex items-center gap-1">

          <!-- Product Dropdown -->
          <div class="relative" data-dropdown>
            <button class="nav-link flex items-center gap-1 px-4 py-2 text-sm font-medium text-gray-400 hover:text-white transition-colors" aria-expanded="false" aria-haspopup="true">
              Product
              <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="nav-dropdown absolute top-full left-0 mt-2 w-64 glass-card p-3" role="menu">
              <a href="<?= $base ?>product.php" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-all" role="menuitem">
                <svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                Bankerise Products
              </a>
              <div class="border-t border-white/10 my-2"></div>
              <div class="relative" data-submenu>
                <a href="#" class="flex items-center justify-between gap-3 px-4 py-3 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-all" role="menuitem">
                  <span class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-aqua flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    Solutions
                  </span>
                  <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                <div class="nav-submenu absolute left-full top-0 ml-2 w-56 glass-card p-3" role="menu">
                  <a href="<?= $base ?>solutions/retail.php" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-all" role="menuitem">
                    <svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Retail Banking
                  </a>
                  <a href="<?= $base ?>solutions/corporate.php" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-all" role="menuitem">
                    <svg class="w-5 h-5 text-aqua flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Corporate Banking
                  </a>
                  <a href="<?= $base ?>solutions/micro.php" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-all" role="menuitem">
                    <svg class="w-5 h-5 text-[#4799D1] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Microfinance
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Use Cases -->
          <a href="<?= $base ?>use-cases.php" class="nav-link px-4 py-2 text-sm font-medium text-gray-400 hover:text-white transition-colors">Use Cases</a>

          <!-- Partners Dropdown -->
          <div class="relative" data-dropdown>
            <button class="nav-link flex items-center gap-1 px-4 py-2 text-sm font-medium text-gray-400 hover:text-white transition-colors" aria-expanded="false" aria-haspopup="true">
              Partners
              <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="nav-dropdown absolute top-full left-0 mt-2 w-64 glass-card p-3" role="menu">
              <a href="<?= $base ?>partners.php" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-all" role="menuitem">
                <svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Why Become a Partner
              </a>
              <a href="<?= $base ?>academy.php" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-all" role="menuitem">
                <svg class="w-5 h-5 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                Academy
              </a>
              <div class="border-t border-white/10 my-2"></div>
              <a href="<?= $base ?>partners/apply.php" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-pacific font-semibold hover:bg-pacific/10 transition-all" role="menuitem">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                Apply Now
              </a>
            </div>
          </div>

          <!-- About -->
          <a href="<?= $base ?>about.php" class="nav-link px-4 py-2 text-sm font-medium text-gray-400 hover:text-white transition-colors">About Us</a>

          <!-- Contact -->
          <a href="<?= $base ?>contact.php" class="nav-link px-4 py-2 text-sm font-medium text-gray-400 hover:text-white transition-colors">Contact</a>
        </div>

        <!-- Desktop CTA + Mobile Hamburger -->
        <div class="flex items-center gap-3">
          <a href="<?= $isPartnersPage ? $base.'partners/login.php' : $base.'partners.php' ?>" class="hidden lg:inline-flex items-center gap-2 text-sm font-semibold py-3 px-6 rounded-full border border-pacific/40 text-pacific hover:bg-pacific/10 transition-all">
            <?= $isPartnersPage ? 'Partner Area' : 'Become a Partner' ?>
          </a>
          <a href="<?= $base ?>contact.php" class="hidden lg:inline-flex btn-primary text-sm !py-3 !px-6">
            Request Demo
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
          </a>
          <button class="lg:hidden text-white p-2" id="mobile-menu-btn" aria-label="Open menu" aria-expanded="false">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu fixed inset-0 top-0 bg-dark z-50 lg:hidden" id="mobile-menu" aria-hidden="true">
      <div class="flex items-center justify-between h-20 px-4 sm:px-6">
        <a href="<?= $base ?>index.php" class="flex items-center">
          <img src="<?= $base ?>assets/images/brand/logo-colored.svg" alt="Bankerise" class="h-8 site-logo" />
        </a>
        <button class="text-white p-2" id="mobile-menu-close" aria-label="Close menu">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>
      <div class="px-4 sm:px-6 py-6 space-y-2 overflow-y-auto max-h-[calc(100vh-80px)]">
        <!-- Mobile: Product -->
        <div class="mobile-accordion">
          <button class="w-full flex items-center justify-between py-3 text-white font-semibold text-lg">
            Product
            <svg class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
          </button>
          <div class="mobile-accordion-content overflow-hidden max-h-0 transition-all duration-300">
            <div class="pl-4 pb-3 space-y-2">
              <a href="<?= $base ?>product.php" class="flex items-center gap-2 py-2 text-gray-400 hover:text-pacific transition-colors">
                <svg class="w-4 h-4 text-pacific flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                Bankerise Products
              </a>
              <div class="border-t border-white/10 my-2"></div>
              <p class="text-xs text-gray-600 uppercase tracking-wider font-semibold pt-1 flex items-center gap-2">
                <svg class="w-4 h-4 text-aqua flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                Solutions
              </p>
              <a href="<?= $base ?>solutions/retail.php" class="block py-2 pl-6 text-gray-400 hover:text-pacific transition-colors">Retail Banking</a>
              <a href="<?= $base ?>solutions/corporate.php" class="block py-2 pl-6 text-gray-400 hover:text-pacific transition-colors">Corporate Banking</a>
              <a href="<?= $base ?>solutions/micro.php" class="block py-2 pl-6 text-gray-400 hover:text-pacific transition-colors">Microfinance</a>
            </div>
          </div>
        </div>

        <a href="<?= $base ?>use-cases.php" class="block py-3 text-white font-semibold text-lg">Use Cases</a>

        <!-- Mobile: Partners -->
        <div class="mobile-accordion">
          <button class="w-full flex items-center justify-between py-3 text-white font-semibold text-lg">
            Partners
            <svg class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
          </button>
          <div class="mobile-accordion-content overflow-hidden max-h-0 transition-all duration-300">
            <div class="pl-4 pb-3 space-y-2">
              <a href="<?= $base ?>partners.php" class="block py-2 text-gray-400 hover:text-pacific transition-colors">Why Become a Partner</a>
              <a href="<?= $base ?>academy.php" class="block py-2 text-gray-400 hover:text-pacific transition-colors">Academy</a>

              <a href="<?= $base ?>partners/apply.php" class="block py-2 text-pacific font-semibold hover:text-white transition-colors">Apply Now &rarr;</a>
            </div>
          </div>
        </div>

        <a href="<?= $base ?>about.php" class="block py-3 text-white font-semibold text-lg">About Us</a>
        <a href="<?= $base ?>contact.php" class="block py-3 text-white font-semibold text-lg">Contact</a>

        <div class="pt-6 space-y-3">
          <a href="<?= $isPartnersPage ? $base.'partners/login.php' : $base.'partners.php' ?>" class="flex items-center justify-center gap-2 w-full py-3 rounded-full border border-pacific/40 text-pacific font-semibold text-base hover:bg-pacific/10 transition-all">
            <?= $isPartnersPage ? 'Partner Area' : 'Become a Partner' ?>
          </a>
          <a href="<?= $base ?>contact.php" class="btn-primary w-full justify-center text-base">
            Request Demo
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
          </a>
        </div>
      </div>
    </div>
  </nav>
