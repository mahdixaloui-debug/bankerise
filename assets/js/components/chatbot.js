/**
 * assets/js/components/chatbot.js
 * Simulated AI Chatbot Logic for Bankerise
 */

document.addEventListener('DOMContentLoaded', () => {
  const chatbotTrigger = document.getElementById('chatbotTrigger');
  const chatbotWindow = document.getElementById('chatbotWindow');
  const chatbotMessages = document.getElementById('chatbotMessages');
  const chatbotInput = document.getElementById('chatbotInput');
  const chatbotSend = document.getElementById('chatbotSend');
  const quickRepliesContainer = document.getElementById('quickReplies');
  const chatbotTooltip = document.getElementById('chatbotTooltip');
  const chatbotTooltipClose = document.getElementById('chatbotTooltipClose');

  let isChatOpen = false;
  let hasGreeted = false;

  // Detect base path dynamically from the site logo link in the footer
  const baseEl = document.querySelector('footer a[href*="index.php"]');
  const chatBase = baseEl ? baseEl.getAttribute('href').replace('index.php', '') : '';

  // Bot Knowledge Base
  const botKnowledge = [
    {
      keywords: ['hello', 'hi', 'hey', 'start'],
      response: "Hello! I am Bankerise AI. I can assist you with information regarding our **Partners Program**, our **Solutions**, or Bankerise's **Vision & Mission**. How can I help?"
    },
    {
      keywords: ['partner', 'why', 'benefit', 'apply', 'agency', 'integrator'],
      response: "Our **Partner Program** is designed for agencies and system integrators. We offer tiered commission structures, a dedicated Developer Sandbox, co-marketing opportunities, and comprehensive technical enablement. You can <a href='" + chatBase + "partners/apply.php' style='color:#00d2ff; text-decoration:underline;'>Apply Now</a>."
    },
    {
      keywords: ['solution', 'product', 'retail', 'corporate', 'microfinance'],
      response: "Bankerise provides core modules for **Retail Banking**, **Corporate Banking**, and **Microfinance**. Features include unified onboarding, bulk payments, multi-sig approvals, and rapid field-agent deployment. Check out our <a href='" + chatBase + "product.php' style='color:#00d2ff; text-decoration:underline;'>Solutions Page</a>."
    },
    {
      keywords: ['vision', 'mission', 'about', 'goal', 'bankerise'],
      response: "**Bankerise Vision & Mission:** Our mission is to democratize financial technology. We envision a world where 'Experience Banking beyond Transactions' is the standard, providing robust, omnichannel, and scalable fintech infrastructure for all."
    },
    {
      keywords: ['demo', 'contact', 'sales', 'book'],
      response: "I'd be happy to connect you with our experts! You can book a demo or speak with our sales team via our <a href='" + chatBase + "contact.php' style='color:#00d2ff; text-decoration:underline;'>Contact Page</a>."
    },
    {
      keywords: ['dashboard', 'portal', 'login', 'backoffice'],
      response: "If you are an existing partner, you can access your leads, commissions, and materials in the <a href='" + chatBase + "partners/dashboard.php' style='color:#00d2ff; text-decoration:underline;'>Partner Dashboard</a>."
    }
  ];

  const defaultResponse = "I'm not entirely sure about that, but our team at Proxym Group can definitely help. Would you like to <a href='" + chatBase + "contact.php' style='color:#00d2ff; text-decoration:underline;'>contact us</a> or read about our <a href='" + chatBase + "product.php' style='color:#00d2ff; text-decoration:underline;'>Solutions</a>?";

  // Quick Reply Options
  const quickReplies = [
    "Partners Program",
    "Banking Solutions",
    "Vision & Mission",
    "Book a Demo"
  ];

  // Show a small greeting tooltip every time the page loads.
  // DO NOT open the chat window — the user opens it themselves.
  if (chatbotTooltip) {
    setTimeout(() => {
      if (!isChatOpen) chatbotTooltip.classList.add('is-visible');
    }, 800);
  }

  function dismissTooltip() {
    if (chatbotTooltip) chatbotTooltip.classList.remove('is-visible');
  }

  if (chatbotTooltipClose) {
    chatbotTooltipClose.addEventListener('click', (e) => {
      e.stopPropagation();
      dismissTooltip();
    });
  }

  if (chatbotTooltip) {
    chatbotTooltip.addEventListener('click', (e) => {
      if (e.target === chatbotTooltipClose) return;
      toggleChat();
    });
  }

  // Toggle Chat Window function
  function toggleChat() {
    // Hide tooltip when interacted with
    dismissTooltip();

    isChatOpen = !isChatOpen;
    if (isChatOpen) {
      chatbotTrigger.classList.add('is-open');
      chatbotWindow.classList.add('is-active');
      if (!hasGreeted) {
        setTimeout(() => addBotMessage(botKnowledge[0].response, true), 300);
        hasGreeted = true;
      }
      setTimeout(() => chatbotInput.focus(), 400);
    } else {
      chatbotTrigger.classList.remove('is-open');
      chatbotWindow.classList.remove('is-active');
    }
  }

  // Bind click event
  chatbotTrigger.addEventListener('click', toggleChat);

  // Handle Send Button
  chatbotSend.addEventListener('click', handleUserInput);

  // Handle Enter Key
  chatbotInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
      handleUserInput();
    }
  });

  // Disable send button when input is empty
  function updateSendState() {
    chatbotSend.disabled = chatbotInput.value.trim() === '';
  }
  chatbotInput.addEventListener('input', updateSendState);
  updateSendState();

  function handleUserInput() {
    const text = chatbotInput.value.trim();
    if (text === '') return;

    // Add User Message
    addUserMessage(text);
    chatbotInput.value = '';
    updateSendState();

    // Remove existing quick replies
    quickRepliesContainer.innerHTML = '';

    // Show Typing Indicator
    showTypingIndicator();

    // Process Response (Simulate network delay)
    setTimeout(() => {
      removeTypingIndicator();
      const response = generateBotResponse(text);
      addBotMessage(response, false);
    }, 1000 + Math.random() * 1000);
  }

  function generateBotResponse(input) {
    const lowerInput = input.toLowerCase();
    
    // Check knowledge base
    for (const item of botKnowledge) {
      if (item.keywords.some(keyword => lowerInput.includes(keyword))) {
        return item.response;
      }
    }
    
    return defaultResponse;
  }

  function formatTime() {
    const now = new Date();
    let hours = now.getHours();
    let minutes = now.getMinutes();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    return `${hours}:${minutes} ${ampm}`;
  }

  function addUserMessage(text) {
    const msgDiv = document.createElement('div');
    msgDiv.className = 'message message-user';
    msgDiv.innerHTML = `
      <div class="message-content">${escapeHTML(text)}</div>
      <span class="message-time">${formatTime()}</span>
    `;
    chatbotMessages.insertBefore(msgDiv, document.getElementById('chatbotScrollAnchor'));
    scrollToBottom();
  }

  function addBotMessage(text, showQuickReplies = false) {
    const msgDiv = document.createElement('div');
    msgDiv.className = 'message message-bot';
    
    // Render markdown-like bold for simple formatting
    const formattedText = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
    
    msgDiv.innerHTML = `
      <div class="message-content">${formattedText}</div>
      <span class="message-time">${formatTime()}</span>
    `;
    chatbotMessages.insertBefore(msgDiv, document.getElementById('chatbotScrollAnchor'));
    
    if (showQuickReplies) {
      renderQuickReplies();
    }
    
    scrollToBottom();
  }

  function renderQuickReplies() {
    quickRepliesContainer.innerHTML = '';
    quickReplies.forEach(reply => {
      const btn = document.createElement('button');
      btn.className = 'quick-reply-btn';
      btn.textContent = reply;
      btn.addEventListener('click', () => {
        chatbotInput.value = reply;
        handleUserInput();
      });
      quickRepliesContainer.appendChild(btn);
    });
  }

  function showTypingIndicator() {
    const id = 'typing-' + Date.now();
    const typingDiv = document.createElement('div');
    typingDiv.className = 'message message-bot typing-container';
    typingDiv.id = id;
    typingDiv.innerHTML = `
      <div class="typing-indicator">
        <div class="typing-dot"></div>
        <div class="typing-dot"></div>
        <div class="typing-dot"></div>
      </div>
    `;
    chatbotMessages.insertBefore(typingDiv, document.getElementById('chatbotScrollAnchor'));
    scrollToBottom();
  }

  function removeTypingIndicator() {
    const typingElements = document.querySelectorAll('.typing-container');
    typingElements.forEach(el => el.remove());
  }

  function scrollToBottom() {
    const anchor = document.getElementById('chatbotScrollAnchor');
    anchor.scrollIntoView({ behavior: 'smooth' });
  }

  function escapeHTML(str) {
    return str.replace(/[&<>'"]/g, 
      tag => ({
          '&': '&amp;',
          '<': '&lt;',
          '>': '&gt;',
          "'": '&#39;',
          '"': '&quot;'
        }[tag] || tag)
    );
  }
});
