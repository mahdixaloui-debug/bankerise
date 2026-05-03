/* ============================================
   Bankerise — Form Validation
   ============================================ */

(function () {
  'use strict';

  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  var urlRegex = /^(https?:\/\/)?([\w-]+\.)+[\w-]{2,}(\/.*)?$/;
  var phoneRegex = /^[\+]?[\d\s\-\(\)]{7,}$/;

  var validators = {
    required: function (value) {
      return value.trim() !== '' ? '' : 'This field is required';
    },
    email: function (value) {
      if (!value.trim()) return 'Email is required';
      return emailRegex.test(value) ? '' : 'Please enter a valid email address';
    },
    url: function (value) {
      if (!value.trim()) return '';
      return urlRegex.test(value) ? '' : 'Please enter a valid URL';
    },
    phone: function (value) {
      if (!value.trim()) return '';
      return phoneRegex.test(value) ? '' : 'Please enter a valid phone number';
    },
    select: function (value) {
      return value && value !== '' ? '' : 'Please select an option';
    },
    checkbox: function (checked) {
      return checked ? '' : 'You must agree to continue';
    }
  };

  function showError(field, message) {
    field.classList.add('error');
    field.classList.remove('success');
    var errorEl = field.parentElement.querySelector('.form-error');
    if (errorEl) {
      errorEl.textContent = message;
      errorEl.classList.add('visible');
    }
  }

  function clearError(field) {
    field.classList.remove('error');
    var errorEl = field.parentElement.querySelector('.form-error');
    if (errorEl) {
      errorEl.classList.remove('visible');
    }
  }

  function markSuccess(field) {
    field.classList.remove('error');
    field.classList.add('success');
    var errorEl = field.parentElement.querySelector('.form-error');
    if (errorEl) {
      errorEl.classList.remove('visible');
    }
  }

  function validateField(field) {
    var rules = (field.getAttribute('data-validate') || '').split(',').map(function (r) { return r.trim(); });
    var value = field.type === 'checkbox' ? field.checked : field.value;

    for (var i = 0; i < rules.length; i++) {
      var rule = rules[i];
      if (validators[rule]) {
        var error = validators[rule](value);
        if (error) {
          showError(field, error);
          return false;
        }
      }
    }

    if (field.value && field.value.trim()) {
      markSuccess(field);
    } else {
      clearError(field);
    }
    return true;
  }

  window.initFormValidation = function (formSelector, onSuccess) {
    var form = document.querySelector(formSelector);
    if (!form) return;

    var fields = form.querySelectorAll('[data-validate]');

    // Real-time validation on blur
    fields.forEach(function (field) {
      field.addEventListener('blur', function () {
        validateField(field);
        updateSubmitButton(form);
      });
      field.addEventListener('input', function () {
        if (field.classList.contains('error')) {
          validateField(field);
        }
        updateSubmitButton(form);
      });
      if (field.type === 'checkbox') {
        field.addEventListener('change', function () {
          validateField(field);
          updateSubmitButton(form);
        });
      }
    });

    // Form submit
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var allValid = true;

      fields.forEach(function (field) {
        if (!validateField(field)) {
          allValid = false;
        }
      });

      if (allValid && typeof onSuccess === 'function') {
        onSuccess(form);
      }
    });
  };

  function updateSubmitButton(form) {
    var submitBtn = form.querySelector('[type="submit"]');
    if (!submitBtn) return;

    var fields = form.querySelectorAll('[data-validate]');
    var hasErrors = false;
    var allFilled = true;

    fields.forEach(function (field) {
      if (field.classList.contains('error')) hasErrors = true;
      var rules = (field.getAttribute('data-validate') || '').split(',');
      if (rules.includes('required') || rules.includes('email') || rules.includes('select')) {
        var val = field.type === 'checkbox' ? field.checked : field.value.trim();
        if (!val) allFilled = false;
      }
    });

    if (hasErrors || !allFilled) {
      submitBtn.style.opacity = '0.5';
      submitBtn.style.pointerEvents = 'none';
    } else {
      submitBtn.style.opacity = '1';
      submitBtn.style.pointerEvents = 'auto';
    }
  }

  // Show success modal
  window.showFormSuccess = function (title, message) {
    var modal = document.createElement('div');
    modal.className = 'success-modal';
    modal.innerHTML = '<div class="glass-card p-8 sm:p-12 max-w-md mx-4 text-center">' +
      '<div class="w-16 h-16 rounded-full bg-green-500/20 flex items-center justify-center mx-auto mb-6">' +
        '<svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>' +
      '</div>' +
      '<h3 class="text-2xl font-bold text-white mb-3">' + title + '</h3>' +
      '<p class="text-gray-400 mb-8">' + message + '</p>' +
      '<button class="btn-primary" onclick="this.closest(\'.success-modal\').remove()">Got it</button>' +
    '</div>';

    document.body.appendChild(modal);
    requestAnimationFrame(function () {
      modal.classList.add('visible');
    });

    modal.addEventListener('click', function (e) {
      if (e.target === modal) modal.remove();
    });
  };

})();
