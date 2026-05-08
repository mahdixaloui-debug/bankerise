<?php
$pageTitle = 'Apply to Partner — Bankerise®';
$pageDescription = 'Apply to become a Bankerise partner — Submit your application and join the leading digital banking partner ecosystem.';
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
        <p class="eyebrow" data-animate>PARTNER APPLICATION</p>
        <h1 class="text-4xl sm:text-5xl font-extrabold mb-6" data-animate data-animate-delay="1">Become a Bankerise Partner</h1>
        <p class="text-lg text-gray-400 max-w-2xl mx-auto" data-animate data-animate-delay="2">Fill out the form below and our partner team will review your application within 48 hours.</p>
      </div>
    </section>

    <!-- FORM + SIDEBAR -->
    <section class="py-12 lg:py-20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12">

          <!-- Form -->
          <div class="lg:col-span-7" data-animate>
            <form id="partner-form" class="glass-card p-8 sm:p-10" novalidate>

              <!-- Company Info -->
              <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
                <span class="w-8 h-8 rounded-full bg-pacific/20 flex items-center justify-center text-sm font-bold text-pacific">1</span>
                Company Information
              </h2>

              <div class="grid sm:grid-cols-2 gap-6 mb-6">
                <div>
                  <label for="company-name" class="block text-sm font-medium text-gray-300 mb-2">Company Name *</label>
                  <input type="text" id="company-name" class="form-input" placeholder="Your Company" data-validate="required">
                  <p class="form-error"></p>
                </div>
                <div>
                  <label for="website" class="block text-sm font-medium text-gray-300 mb-2">Website</label>
                  <input type="url" id="website" class="form-input" placeholder="https://yourcompany.com" data-validate="url">
                  <p class="form-error"></p>
                </div>
              </div>

              <div class="grid sm:grid-cols-2 gap-6 mb-6">
                <div>
                  <label for="country" class="block text-sm font-medium text-gray-300 mb-2">Country / Region *</label>
                  <select id="country" class="form-select" data-validate="select">
                    <option value="">Select country</option>
                    <option>Algeria</option><option>Bahrain</option><option>Cameroon</option><option>Egypt</option>
                    <option>France</option><option>Germany</option><option>Ghana</option><option>India</option>
                    <option>Iraq</option><option>Jordan</option><option>Kazakhstan</option><option>Kenya</option>
                    <option>Kuwait</option><option>Lebanon</option><option>Morocco</option><option>Nigeria</option>
                    <option>Pakistan</option><option>Qatar</option><option>Saudi Arabia</option><option>Senegal</option>
                    <option>South Africa</option><option>Tunisia</option><option>Turkey</option><option>UAE</option>
                    <option>United Kingdom</option><option>United States</option><option>Uzbekistan</option><option>Other</option>
                  </select>
                  <p class="form-error"></p>
                </div>
                <div>
                  <label for="company-size" class="block text-sm font-medium text-gray-300 mb-2">Company Size *</label>
                  <select id="company-size" class="form-select" data-validate="select">
                    <option value="">Select size</option>
                    <option>1–10 employees</option>
                    <option>11–50 employees</option>
                    <option>51–200 employees</option>
                    <option>201–500 employees</option>
                    <option>500+ employees</option>
                  </select>
                  <p class="form-error"></p>
                </div>
              </div>

              <div class="mb-8">
                <label for="partner-type" class="block text-sm font-medium text-gray-300 mb-2">Partner Type *</label>
                <select id="partner-type" class="form-select" data-validate="select">
                  <option value="">Select type</option>
                  <option>Referral Partner</option>
                  <option>Implementation Partner (Integrator)</option>
                  <option>Technology Partner</option>
                  <option>Consulting / Advisory</option>
                </select>
                <p class="form-error"></p>
              </div>

              <div class="border-t border-white/10 my-8"></div>

              <!-- Contact Info -->
              <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
                <span class="w-8 h-8 rounded-full bg-pacific/20 flex items-center justify-center text-sm font-bold text-pacific">2</span>
                Contact Information
              </h2>

              <div class="grid sm:grid-cols-2 gap-6 mb-6">
                <div>
                  <label for="contact-name" class="block text-sm font-medium text-gray-300 mb-2">Contact Name *</label>
                  <input type="text" id="contact-name" class="form-input" placeholder="Full name" data-validate="required">
                  <p class="form-error"></p>
                </div>
                <div>
                  <label for="contact-email" class="block text-sm font-medium text-gray-300 mb-2">Email *</label>
                  <input type="email" id="contact-email" class="form-input" placeholder="you@company.com" data-validate="email">
                  <p class="form-error"></p>
                </div>
              </div>

              <div class="mb-6">
                <label for="contact-phone" class="block text-sm font-medium text-gray-300 mb-2">Phone</label>
                <input type="tel" id="contact-phone" class="form-input" placeholder="+1 234 567 8900" data-validate="phone">
                <p class="form-error"></p>
              </div>

              <div class="mb-8">
                <label for="message" class="block text-sm font-medium text-gray-300 mb-2">Why do you want to partner with Bankerise?</label>
                <textarea id="message" rows="4" class="form-input resize-none" placeholder="Tell us about your business, target market, and why you're interested..."></textarea>
              </div>

              <div class="mb-8">
                <label class="flex items-start gap-3 cursor-pointer">
                  <input type="checkbox" id="terms" class="mt-1 w-4 h-4 rounded border-white/20 bg-white/5 text-pacific focus:ring-pacific" data-validate="checkbox">
                  <span class="text-sm text-gray-400">I agree to Bankerise's <a href="#" class="text-pacific hover:underline">Partner Program Terms</a> and <a href="#" class="text-pacific hover:underline">Privacy Policy</a>. *</span>
                </label>
                <p class="form-error ml-7"></p>
              </div>

              <button type="submit" class="btn-primary w-full justify-center text-base" style="opacity:0.5;pointer-events:none">
                Submit Application
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
              </button>
            </form>
          </div>

          <!-- Sidebar -->
          <div class="lg:col-span-5 space-y-6" data-animate data-animate-delay="2">
            <div class="glass-card p-8">
              <h3 class="text-lg font-bold mb-6">What you'll get</h3>
              <ul class="space-y-4">
                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-pacific flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                  <span class="text-gray-300 text-sm">Competitive commission structure with recurring revenue</span>
                </li>
                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-pacific flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                  <span class="text-gray-300 text-sm">Access to partner portal with deal registration</span>
                </li>
                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-pacific flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                  <span class="text-gray-300 text-sm">Sales playbooks and marketing materials</span>
                </li>
                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-pacific flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                  <span class="text-gray-300 text-sm">Technical training and professional certification</span>
                </li>
                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-pacific flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                  <span class="text-gray-300 text-sm">Sandbox environment for live demos</span>
                </li>
                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-pacific flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                  <span class="text-gray-300 text-sm">Dedicated partner manager</span>
                </li>
                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-pacific flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                  <span class="text-gray-300 text-sm">Co-marketing and lead sharing opportunities</span>
                </li>
              </ul>
            </div>

            <div class="glass-card p-8 text-center">
              <p class="text-3xl font-bold gradient-text mb-2">48h</p>
              <p class="text-gray-400 text-sm">Average application review time</p>
            </div>

            <div class="glass-card p-6">
              <p class="text-sm text-gray-400">Questions about the partner program?</p>
              <a href="mailto:partners@bankerise.com" class="text-pacific font-semibold text-sm hover:underline">partners@bankerise.com</a>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>

  <?php include '../includes/footer.php'; ?>
  <script src="../assets/js/shared.js"></script>
  <script src="../assets/js/forms.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      initFormValidation('#partner-form', function(form) {
        var payload = {
          company_name: form.querySelector('#company-name').value,
          website: form.querySelector('#website').value,
          country: form.querySelector('#country').value,
          company_size: form.querySelector('#company-size').value,
          partner_type: form.querySelector('#partner-type').value,
          contact_name: form.querySelector('#contact-name').value,
          contact_email: form.querySelector('#contact-email').value,
          contact_phone: form.querySelector('#contact-phone').value,
          message: form.querySelector('#message').value
        };
        fetch('/bankerise/api/applications.php', {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},
          body: JSON.stringify(payload)
        })
        .then(function(r){ return r.json(); })
        .then(function(data){
          if(data.success){
            showFormSuccess('Application Submitted!', 'Thank you for your interest in partnering with Bankerise. Our team will review your application and get back to you within 48 hours.');
            form.reset();
            form.querySelector('[type="submit"]').style.opacity = '0.5';
            form.querySelector('[type="submit"]').style.pointerEvents = 'none';
          } else {
            alert(data.error || 'Failed to submit application.');
          }
        })
        .catch(function(){ alert('Network error. Please try again.'); });
      });
    });
  </script>
</body>
</html>
