<?php
$pageTitle = 'Find a Partner — Bankerise®';
$pageDescription = 'Find a Bankerise partner near you — Search our global directory of certified implementation, technology, and referral partners.';
$isSubfolder = true;
include '../includes/head.php';
?>
</head>
<body class="font-montserrat bg-dark text-white">
  <?php include '../includes/navbar.php'; ?>

  <main id="main-content">

    <!-- HERO -->
    <section class="pt-32 pb-12 lg:pt-40 lg:pb-16 relative overflow-hidden noise-overlay">
      <div class="mesh-gradient"><div class="blob blob-1"></div><div class="blob blob-2"></div></div>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <p class="eyebrow" data-animate>PARTNER DIRECTORY</p>
        <h1 class="text-4xl sm:text-5xl font-extrabold mb-6" data-animate data-animate-delay="1">Find a Bankerise Partner</h1>
        <p class="text-lg text-gray-400 max-w-2xl mx-auto mb-10" data-animate data-animate-delay="2">Search our global network of certified partners to find the right fit for your market and requirements.</p>
        <!-- Search -->
        <div class="max-w-xl mx-auto" data-animate data-animate-delay="3">
          <div class="relative">
            <svg class="w-5 h-5 text-gray-500 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" id="partner-search" class="form-input !pl-12 !py-4 text-base" placeholder="Search by company name or country...">
          </div>
        </div>
      </div>
    </section>

    <!-- FILTERS + RESULTS -->
    <section class="py-12 lg:py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-4 gap-8">

          <!-- Filters sidebar -->
          <div class="lg:col-span-1" data-animate>
            <div class="glass-card p-6 sticky top-24">
              <h3 class="font-bold mb-4">Filters</h3>

              <div class="mb-6">
                <p class="text-sm font-medium text-gray-400 mb-3">Partner Type</p>
                <label class="flex items-center gap-3 mb-2 cursor-pointer"><input type="checkbox" class="partner-filter rounded border-white/20 bg-white/5 text-pacific focus:ring-pacific" data-filter-type="type" value="implementation" checked><span class="text-sm text-gray-300">Implementation</span></label>
                <label class="flex items-center gap-3 mb-2 cursor-pointer"><input type="checkbox" class="partner-filter rounded border-white/20 bg-white/5 text-pacific focus:ring-pacific" data-filter-type="type" value="technology" checked><span class="text-sm text-gray-300">Technology</span></label>
                <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="partner-filter rounded border-white/20 bg-white/5 text-pacific focus:ring-pacific" data-filter-type="type" value="referral" checked><span class="text-sm text-gray-300">Referral</span></label>
              </div>

              <div class="mb-6">
                <p class="text-sm font-medium text-gray-400 mb-3">Region</p>
                <label class="flex items-center gap-3 mb-2 cursor-pointer"><input type="checkbox" class="partner-filter rounded border-white/20 bg-white/5 text-pacific focus:ring-pacific" data-filter-type="region" value="north-africa" checked><span class="text-sm text-gray-300">North Africa</span></label>
                <label class="flex items-center gap-3 mb-2 cursor-pointer"><input type="checkbox" class="partner-filter rounded border-white/20 bg-white/5 text-pacific focus:ring-pacific" data-filter-type="region" value="middle-east" checked><span class="text-sm text-gray-300">Middle East</span></label>
                <label class="flex items-center gap-3 mb-2 cursor-pointer"><input type="checkbox" class="partner-filter rounded border-white/20 bg-white/5 text-pacific focus:ring-pacific" data-filter-type="region" value="sub-saharan" checked><span class="text-sm text-gray-300">Sub-Saharan Africa</span></label>
                <label class="flex items-center gap-3 mb-2 cursor-pointer"><input type="checkbox" class="partner-filter rounded border-white/20 bg-white/5 text-pacific focus:ring-pacific" data-filter-type="region" value="central-asia" checked><span class="text-sm text-gray-300">Central Asia</span></label>
                <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="partner-filter rounded border-white/20 bg-white/5 text-pacific focus:ring-pacific" data-filter-type="region" value="europe" checked><span class="text-sm text-gray-300">Europe</span></label>
              </div>

              <button id="reset-filters" class="text-pacific text-sm font-semibold hover:underline">Reset all filters</button>
            </div>
          </div>

          <!-- Results -->
          <div class="lg:col-span-3">
            <p class="text-sm text-gray-500 mb-6" id="result-count">Showing all partners</p>
            <div class="grid sm:grid-cols-2 gap-4" id="partner-grid">
              <!-- Partners injected by JS -->
            </div>
            <div id="no-results" class="text-center py-16 hidden">
              <svg class="w-16 h-16 text-gray-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
              <p class="text-gray-400 text-lg font-medium mb-2">No partners found</p>
              <p class="text-gray-600 text-sm">Try adjusting your search or filters</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="py-16 bg-dark2">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-animate>
        <h2 class="text-2xl font-bold mb-4">Don't see a partner in your region?</h2>
        <p class="text-gray-400 mb-6">Contact us directly and we'll help you find the right solution for your market.</p>
        <div class="flex flex-wrap justify-center gap-4">
          <a href="../contact.php" class="btn-primary">Contact Us <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg></a>
          <a href="apply.php" class="btn-ghost">Become a Partner</a>
        </div>
      </div>
    </section>

  </main>

  <?php include '../includes/footer.php'; ?>
  <script src="../assets/js/shared.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var partners = [
        { name: 'TechBridge Solutions', country: 'Tunisia', type: 'implementation', region: 'north-africa', specialties: ['Retail Banking', 'Microfinance'] },
        { name: 'Pacific Digital', country: 'UAE', type: 'implementation', region: 'middle-east', specialties: ['SME Banking', 'Lending'] },
        { name: 'Silk Road Tech', country: 'Kazakhstan', type: 'implementation', region: 'central-asia', specialties: ['Retail Banking', 'Islamic Banking'] },
        { name: 'Meridian Consulting', country: 'Morocco', type: 'referral', region: 'north-africa', specialties: ['Retail Banking'] },
        { name: 'Savanna Systems', country: 'Kenya', type: 'technology', region: 'sub-saharan', specialties: ['Mobile Banking', 'Agent Banking'] },
        { name: 'NileCode', country: 'Egypt', type: 'implementation', region: 'north-africa', specialties: ['Lending', 'Onboarding'] },
        { name: 'Gulf Innovations', country: 'Saudi Arabia', type: 'implementation', region: 'middle-east', specialties: ['Islamic Banking', 'Compliance'] },
        { name: 'Atlas Integrators', country: 'Nigeria', type: 'implementation', region: 'sub-saharan', specialties: ['Microfinance', 'Cooperative Banking'] },
        { name: 'EuroFintech Partners', country: 'France', type: 'referral', region: 'europe', specialties: ['Neo Banking', 'Open Banking'] },
        { name: 'Steppe Digital', country: 'Uzbekistan', type: 'technology', region: 'central-asia', specialties: ['Payments', 'Analytics'] },
        { name: 'Dakar Solutions', country: 'Senegal', type: 'implementation', region: 'sub-saharan', specialties: ['Microfinance', 'Mobile Money'] },
        { name: 'Ankara Systems', country: 'Turkey', type: 'technology', region: 'middle-east', specialties: ['Core Banking', 'API Integration'] },
      ];

      var grid = document.getElementById('partner-grid');
      var searchInput = document.getElementById('partner-search');
      var noResults = document.getElementById('no-results');
      var resultCount = document.getElementById('result-count');
      var typeColors = { implementation: 'pacific', technology: 'aqua', referral: 'bell' };

      function renderPartners(list) {
        grid.innerHTML = '';
        if (list.length === 0) {
          noResults.classList.remove('hidden');
          resultCount.textContent = 'No partners found';
          return;
        }
        noResults.classList.add('hidden');
        resultCount.textContent = 'Showing ' + list.length + ' partner' + (list.length !== 1 ? 's' : '');

        list.forEach(function(p) {
          var color = typeColors[p.type] || 'pacific';
          var card = document.createElement('div');
          card.className = 'glass-card p-6';
          card.innerHTML =
            '<div class="flex items-start justify-between mb-4">' +
              '<div class="w-12 h-12 rounded-xl bg-' + color + '/10 flex items-center justify-center flex-shrink-0">' +
                '<span class="text-lg font-bold text-' + color + '">' + p.name.charAt(0) + '</span>' +
              '</div>' +
              '<span class="text-xs font-semibold text-' + color + ' bg-' + color + '/10 px-3 py-1 rounded-full capitalize">' + p.type + '</span>' +
            '</div>' +
            '<h4 class="font-bold mb-1">' + p.name + '</h4>' +
            '<p class="text-gray-500 text-sm mb-3">' + p.country + '</p>' +
            '<div class="flex flex-wrap gap-2">' +
              p.specialties.map(function(s) { return '<span class="text-xs text-gray-400 bg-white/5 px-2 py-1 rounded">' + s + '</span>'; }).join('') +
            '</div>';
          grid.appendChild(card);
        });
      }

      function filterPartners() {
        var search = searchInput.value.toLowerCase();
        var checkedTypes = Array.from(document.querySelectorAll('.partner-filter[data-filter-type="type"]:checked')).map(function(c) { return c.value; });
        var checkedRegions = Array.from(document.querySelectorAll('.partner-filter[data-filter-type="region"]:checked')).map(function(c) { return c.value; });

        var filtered = partners.filter(function(p) {
          var matchesSearch = !search || p.name.toLowerCase().includes(search) || p.country.toLowerCase().includes(search);
          var matchesType = checkedTypes.includes(p.type);
          var matchesRegion = checkedRegions.includes(p.region);
          return matchesSearch && matchesType && matchesRegion;
        });

        renderPartners(filtered);
      }

      searchInput.addEventListener('input', filterPartners);
      document.querySelectorAll('.partner-filter').forEach(function(cb) {
        cb.addEventListener('change', filterPartners);
      });

      document.getElementById('reset-filters').addEventListener('click', function() {
        searchInput.value = '';
        document.querySelectorAll('.partner-filter').forEach(function(cb) { cb.checked = true; });
        filterPartners();
      });

      renderPartners(partners);
    });
  </script>
</body>
</html>
