<?php
$pageTitle = 'Contact — Bankerise®';
$pageDescription = 'Contact Bankerise — Request a demo, ask about partnerships, or get technical support for the leading digital banking platform.';
include 'includes/head.php';
?>
</head>
<body class="font-montserrat bg-dark text-white">
  <?php include 'includes/navbar.php'; ?>

  <main id="main-content">

    <!-- HERO -->
    <section class="relative pt-24 pb-20 lg:pt-32 lg:pb-28 overflow-hidden noise-overlay">
      <!-- Background Image -->
      <img src="assets/images/contact-hero.jpg" alt="Contact Bankerise" class="absolute inset-0 w-full h-full object-cover opacity-30 mix-blend-luminosity">
      <div class="absolute inset-0 bg-gradient-to-b from-dark/80 via-dark/50 to-dark"></div>

      <div class="mesh-gradient opacity-50"><div class="blob blob-1"></div><div class="blob blob-2"></div><div class="blob blob-3"></div></div>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <p class="eyebrow" data-animate>GET IN TOUCH</p>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mb-6" data-animate data-animate-delay="1">Let's Talk</h1>
        <p class="text-lg text-gray-300 max-w-2xl mx-auto" data-animate data-animate-delay="2">Whether you're a financial institution exploring digital transformation or a partner looking to grow — we'd love to hear from you.</p>
      </div>
    </section>

    <!-- CONTACT FORM + INFO -->
    <section class="py-12 lg:py-20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12">

          <!-- Form -->
          <div class="lg:col-span-7" data-animate>
            <form id="contact-form" class="glass-card p-8 sm:p-10" novalidate>
              <h2 class="text-2xl font-bold mb-8">Send us a message</h2>

              <!-- I am a... -->
              <div class="mb-8">
                <p class="text-sm font-medium text-gray-300 mb-3">I am a...</p>
                <div class="flex flex-wrap gap-3">
                  <label class="cursor-pointer">
                    <input type="radio" name="contact-type" value="bank" class="sr-only peer" checked>
                    <span class="block px-5 py-2.5 rounded-full text-sm border border-white/10 peer-checked:bg-pacific/15 peer-checked:border-pacific/30 peer-checked:text-pacific transition-all">Bank / Financial Institution</span>
                  </label>
                  <label class="cursor-pointer">
                    <input type="radio" name="contact-type" value="partner" class="sr-only peer">
                    <span class="block px-5 py-2.5 rounded-full text-sm border border-white/10 peer-checked:bg-pacific/15 peer-checked:border-pacific/30 peer-checked:text-pacific transition-all">Partner / Integrator</span>
                  </label>
                  <label class="cursor-pointer">
                    <input type="radio" name="contact-type" value="other" class="sr-only peer">
                    <span class="block px-5 py-2.5 rounded-full text-sm border border-white/10 peer-checked:bg-pacific/15 peer-checked:border-pacific/30 peer-checked:text-pacific transition-all">Other</span>
                  </label>
                </div>
              </div>

              <div class="grid sm:grid-cols-2 gap-6 mb-6">
                <div>
                  <label for="full-name" class="block text-sm font-medium text-gray-300 mb-2">Full Name *</label>
                  <input type="text" id="full-name" name="full-name" class="form-input" placeholder="John Doe" data-validate="required">
                  <p class="form-error">This field is required</p>
                </div>
                <div>
                  <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Work Email *</label>
                  <input type="email" id="email" name="email" class="form-input" placeholder="john@company.com" data-validate="email">
                  <p class="form-error">Please enter a valid email</p>
                </div>
              </div>

              <div class="grid sm:grid-cols-2 gap-6 mb-6">
                <div>
                  <label for="company" class="block text-sm font-medium text-gray-300 mb-2">Company Name *</label>
                  <input type="text" id="company" name="company" class="form-input" placeholder="Your Company" data-validate="required">
                  <p class="form-error">This field is required</p>
                </div>
                <div>
                  <label for="country" class="block text-sm font-medium text-gray-300 mb-2">Country</label>
                  <select id="country" name="country" class="form-select">
                    <option value="">Select country</option>
                    <option>Algeria</option><option>Bahrain</option><option>Cameroon</option><option>Cote d'Ivoire</option>
                    <option>Egypt</option><option>France</option><option>Germany</option><option>Ghana</option>
                    <option>India</option><option>Iraq</option><option>Jordan</option><option>Kazakhstan</option>
                    <option>Kenya</option><option>Kuwait</option><option>Lebanon</option><option>Libya</option>
                    <option>Mali</option><option>Mauritania</option><option>Morocco</option><option>Nigeria</option>
                    <option>Oman</option><option>Pakistan</option><option>Qatar</option><option>Saudi Arabia</option>
                    <option>Senegal</option><option>South Africa</option><option>Tunisia</option><option>Turkey</option>
                    <option>UAE</option><option>Uganda</option><option>United Kingdom</option><option>United States</option>
                    <option>Uzbekistan</option><option>Other</option>
                  </select>
                </div>
              </div>

              <div class="mb-6">
                <label for="subject" class="block text-sm font-medium text-gray-300 mb-2">Subject *</label>
                <select id="subject" name="subject" class="form-select" data-validate="select">
                  <option value="">Select a subject</option>
                  <option>Request a Demo</option>
                  <option>Partnership Inquiry</option>
                  <option>Technical Support</option>
                  <option>General Inquiry</option>
                  <option>Other</option>
                </select>
                <p class="form-error">Please select a subject</p>
              </div>

              <div class="mb-8">
                <label for="message" class="block text-sm font-medium text-gray-300 mb-2">Message *</label>
                <textarea id="message" name="message" rows="5" class="form-input resize-none" placeholder="Tell us about your needs..." data-validate="required"></textarea>
                <p class="form-error">This field is required</p>
              </div>

              <button type="submit" class="btn-primary w-full justify-center text-base" style="opacity:0.5;pointer-events:none">
                Send Message
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
              </button>
            </form>
          </div>

          <!-- Info sidebar -->
          <div class="lg:col-span-5 space-y-6" data-animate data-animate-delay="2">
            <div class="glass-card p-8">
              <h3 class="text-lg font-bold mb-6">Contact Information</h3>
              <div class="space-y-5">
                <div class="flex items-start gap-4">
                  <div class="w-10 h-10 rounded-xl bg-pacific/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-pacific" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-300">Email</p>
                    <p class="text-white">contact@bankerise.com</p>
                  </div>
                </div>
                <div class="flex items-start gap-4">
                  <div class="w-10 h-10 rounded-xl bg-pacific/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-pacific" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-300">Phone</p>
                    <p class="text-white">+216 71 000 000</p>
                  </div>
                </div>
                <div class="flex items-start gap-4">
                  <div class="w-10 h-10 rounded-xl bg-pacific/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-pacific" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-300">Office</p>
                    <p class="text-white">Proxym Group</p>
                    <p class="text-sm text-gray-400">Technopole de Sousse, Tunisia</p>
                  </div>
                </div>
              </div>

              <div class="border-t border-white/10 mt-6 pt-6">
                <p class="text-sm font-medium text-gray-300 mb-3">Follow us</p>
                <div class="flex gap-4">
                  <a href="#" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-gray-400 hover:text-pacific hover:bg-pacific/10 transition-all" aria-label="LinkedIn">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                  </a>
                  <a href="#" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-gray-400 hover:text-pacific hover:bg-pacific/10 transition-all" aria-label="X (Twitter)">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                  </a>
                </div>
              </div>
            </div>

            <!-- Office / Map image -->
            <div class="rounded-2xl overflow-hidden border border-white/10" style="height: 300px;">
              <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3236.002821360699!2d10.5898322!3d35.8306915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12fd8b1faaf31e5f%3A0xc023fce2f570773d!2sProxym!5e0!3m2!1sen!2stn!4v1700000000000!5m2!1sen!2stn" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
              </iframe>
            </div>

            <div class="glass-card p-6 text-center">
              <p class="text-sm text-gray-400">We typically respond within <span class="text-pacific font-semibold">24 hours</span></p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section class="py-20 lg:py-28 bg-dark2" id="faq-section">
      <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-animate>
          <p class="eyebrow">FREQUENTLY ASKED QUESTIONS</p>
          <h2 class="text-3xl sm:text-4xl font-bold">Common questions</h2>
        </div>

        <div data-animate>
          <div class="accordion-item">
            <button class="accordion-trigger">
              What types of financial institutions can use Bankerise?
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="accordion-content">
              <p class="text-gray-400 leading-relaxed">Bankerise serves a wide range of financial institutions including retail banks, microfinance institutions, cooperative banks, Islamic banks, neobanks, and fintech companies. Our modular platform adapts to the specific needs and regulatory requirements of each segment.</p>
            </div>
          </div>

          <div class="accordion-item">
            <button class="accordion-trigger">
              How long does implementation typically take?
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="accordion-content">
              <p class="text-gray-400 leading-relaxed">Implementation timelines range from 8 to 16 weeks depending on the scope of modules deployed and integration complexity. Our standard onboarding module can be live in as little as 6 weeks, while a full platform deployment typically takes 12-16 weeks.</p>
            </div>
          </div>

          <div class="accordion-item">
            <button class="accordion-trigger">
              Is Bankerise compliant with local regulations?
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="accordion-content">
              <p class="text-gray-400 leading-relaxed">Yes. Bankerise is built with compliance at its core. We support regional regulatory frameworks across Africa, Middle East, Central Asia, and Europe including GDPR, PSD2, and local central bank requirements. Our compliance module is configurable to meet specific jurisdictional needs.</p>
            </div>
          </div>

          <div class="accordion-item">
            <button class="accordion-trigger">
              Can Bankerise integrate with our existing core banking system?
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="accordion-content">
              <p class="text-gray-400 leading-relaxed">Absolutely. Bankerise is built API-first with an open integration architecture. We have pre-built connectors for major core banking systems and payment gateways, and our REST APIs and webhook system enable custom integrations with virtually any system.</p>
            </div>
          </div>

          <div class="accordion-item">
            <button class="accordion-trigger">
              What support do you offer after go-live?
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="accordion-content">
              <p class="text-gray-400 leading-relaxed">We provide 24/7 technical support, a dedicated Customer Success Manager, regular platform updates, and ongoing training. Our SLA guarantees 99.99% uptime with proactive monitoring and incident response.</p>
            </div>
          </div>

          <div class="accordion-item">
            <button class="accordion-trigger">
              How does the partner program work?
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="accordion-content">
              <p class="text-gray-400 leading-relaxed">Our partner program offers three tiers — Referral, Implementation, and Technology Partner — each with competitive commission structures, enablement resources, co-marketing support, and a dedicated partner manager. <a href="partners.php" class="text-pacific hover:underline">Learn more about becoming a partner</a>.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>

  <?php include 'includes/footer.php'; ?>
  <script src="assets/js/shared.js"></script>
  <script src="assets/js/forms.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      initFormValidation('#contact-form', function(form) {
        var contactType = form.querySelector('input[name="contact-type"]:checked');
        var payload = {
          full_name: form.querySelector('#full-name').value,
          email: form.querySelector('#email').value,
          company: form.querySelector('#company').value,
          country: form.querySelector('#country').value,
          contact_type: contactType ? contactType.value : '',
          subject: form.querySelector('#subject').value,
          message: form.querySelector('#message').value
        };
        fetch('/bankerise/api/contacts.php', {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},
          body: JSON.stringify(payload)
        })
        .then(function(r){ return r.json(); })
        .then(function(data){
          if(data.success){
            showFormSuccess('Message Sent!', 'Thank you for reaching out. Our team will get back to you within 24 hours.');
            form.reset();
            form.querySelector('[type="submit"]').style.opacity = '0.5';
            form.querySelector('[type="submit"]').style.pointerEvents = 'none';
          } else {
            alert(data.error || 'Failed to send message.');
          }
        })
        .catch(function(){ alert('Network error. Please try again.'); });
      });
      initAccordion('#faq-section');
    });
  </script>
</body>
</html>
