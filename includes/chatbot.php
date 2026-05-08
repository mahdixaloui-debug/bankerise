<?php
/**
 * Bankerise - Simulated AI Chatbot Component
 * Included globally via footer.php
 */
?>

<!-- Chatbot Floating Trigger Button & Tooltip -->
<div class="chatbot-trigger-container">
  <div id="chatbotTooltip" class="chatbot-tooltip">
    <button type="button" class="chatbot-tooltip-close" id="chatbotTooltipClose" aria-label="Dismiss">&times;</button>
    <span class="chatbot-tooltip-text">Hello 👋 Need any help?</span>
  </div>
  <div id="chatbotTrigger" class="chatbot-trigger" role="button" aria-label="Open Chat Assistant">
    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="bot-svg-icon">
      <!-- Antenna -->
      <line x1="50" y1="18" x2="50" y2="30" stroke="currentColor" stroke-width="6" stroke-linecap="round"/>
      <circle cx="50" cy="12" r="6" fill="currentColor"/>
      <!-- Head / Speech Bubble -->
      <path d="M 15 55 C 15 30, 85 30, 85 55 C 85 75, 65 85, 50 85 C 45 85, 40 88, 32 95 L 32 82 C 20 78, 15 68, 15 55 Z" fill="currentColor"/>
      <!-- Visor -->
      <rect x="28" y="42" width="44" height="22" rx="11" fill="#0A0C18"/>
      <!-- Eyes -->
      <circle cx="40" cy="53" r="4.5" fill="#00ffff"/>
      <circle cx="60" cy="53" r="4.5" fill="#00ffff"/>
    </svg>
  </div>
</div>

<!-- Chatbot Window -->
<div id="chatbotWindow" class="chatbot-window shadow-2xl">
  <!-- Header -->
  <div class="chatbot-header">
    <div class="chatbot-avatar">
      <img src="<?= $base ?>assets/images/brand/icon-mark.svg" alt="Bankerise Logo" class="chatbot-header-logo" />
    </div>
    <div class="chatbot-header-info">
      <h3>Bankerise Bot</h3>
      <p><span class="status-dot"></span> Online & Ready</p>
    </div>
  </div>

  <!-- Messages Container -->
  <div id="chatbotMessages" class="chatbot-messages">
    <!-- Messages will be injected here via JS -->
    <div id="chatbotScrollAnchor"></div>
  </div>

  <!-- Quick Replies (dynamically populated) -->
  <div style="padding: 0 1.5rem 0.5rem 1.5rem;">
    <div id="quickReplies" class="quick-replies"></div>
  </div>

  <!-- Input Area -->
  <div class="chatbot-input">
    <input type="text" id="chatbotInput" placeholder="Ask about solutions, partners, or vision..." autocomplete="off" />
    <button id="chatbotSend" class="chatbot-send" aria-label="Send Message">
      <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path fill="currentColor" d="M3.4 20.4 21.5 12.8c.8-.3.8-1.4 0-1.7L3.4 3.6c-.7-.3-1.4.4-1.2 1.1L4 11c.1.3.3.5.6.6l7.8 1c.3 0 .3.5 0 .5l-7.8 1c-.3.1-.5.3-.6.6l-1.8 6.3c-.2.7.5 1.4 1.2 1.1z"/>
      </svg>
    </button>
  </div>
</div>
