/* ================================
   EMOCE ADMIN PANEL - CLEAN JS
   Sidebar + Theme only
   ================================ */

// DOM Elements
const body = document.body;
const sidebar = document.getElementById('sidebar');
const menuToggle = document.getElementById('menuToggle');
const sidebarClose = document.getElementById('sidebarClose');
const sidebarOverlay = document.getElementById('sidebarOverlay');
const themeToggle = document.getElementById('themeToggle');
const html = document.documentElement;

/* ================================
   SIDEBAR TOGGLE
   ================================ */

function openSidebarMobile() {
  sidebar.classList.add('active');
  sidebarOverlay?.classList.add('active');
  body.style.overflow = 'hidden';
}

function closeSidebarMobile() {
  sidebar.classList.remove('active');
  sidebarOverlay?.classList.remove('active');
  body.style.overflow = '';
}

// Toggle sidebar
menuToggle?.addEventListener('click', () => {
  if (window.innerWidth < 992) {
    openSidebarMobile();
  } else {
    body.classList.toggle('sidebar-collapsed');
    localStorage.setItem(
      'sidebarCollapsed',
      body.classList.contains('sidebar-collapsed')
    );
  }
});

// Close sidebar (mobile)
sidebarClose?.addEventListener('click', closeSidebarMobile);
sidebarOverlay?.addEventListener('click', closeSidebarMobile);

// Restore collapsed state (desktop only)
if (window.innerWidth >= 992) {
  if (localStorage.getItem('sidebarCollapsed') === 'true') {
    body.classList.add('sidebar-collapsed');
  }
}

// Reset mobile sidebar on resize
window.addEventListener('resize', () => {
  if (window.innerWidth >= 992) {
    closeSidebarMobile();
  }
});

/* ================================
   THEME TOGGLE
   ================================ */

function setTheme(theme) {
  html.setAttribute('data-bs-theme', theme);
  localStorage.setItem('theme', theme);

  const icon = themeToggle?.querySelector('i');
  if (!icon) return;

  icon.classList.toggle('bi-sun-fill', theme === 'dark');
  icon.classList.toggle('bi-moon-fill', theme !== 'dark');
}

// Init theme
(function initTheme() {
  const saved = localStorage.getItem('theme');
  const system = window.matchMedia('(prefers-color-scheme: dark)').matches
    ? 'dark'
    : 'light';

  setTheme(saved || system);
})();

// Toggle theme click
themeToggle?.addEventListener('click', () => {
  const current = html.getAttribute('data-bs-theme');
  setTheme(current === 'dark' ? 'light' : 'dark');
});

// System theme change (only if user didn’t choose manually)
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
  if (!localStorage.getItem('theme')) {
    setTheme(e.matches ? 'dark' : 'light');
  }
});

console.log('✓ Emoce Admin JS initialized (clean mode)');


// ========== NOTIFICATION & MESSAGE HANDLING ==========
function markAsRead(element) {
  element.classList.remove('unread');
  
  // Update badge count
  const badge = document.querySelector('.notification-badge');
  if (badge) {
    let count = parseInt(badge.textContent);
    if (count > 0) {
      count--;
      badge.textContent = count;
      if (count === 0) {
        badge.style.display = 'none';
      }
    }
  }
}

// Add click handlers to notification items
document.querySelectorAll('.notification-item, .message-item').forEach(item => {
  item.addEventListener('click', function(e) {
    if (this.classList.contains('unread')) {
      markAsRead(this);
    }
  });
});

// ========== SEARCH FUNCTIONALITY ==========
const searchInput = document.querySelector('.search-box input');
if (searchInput) {
  searchInput.addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    
    // Search through navigation items
    document.querySelectorAll('.nav-link').forEach(link => {
      const text = link.textContent.toLowerCase();
      const parent = link.closest('.nav-item');
      
      if (text.includes(searchTerm)) {
        parent.style.display = '';
      } else {
        parent.style.display = 'none';
      }
    });
    
    // If search is empty, show all items
    if (searchTerm === '') {
      document.querySelectorAll('.nav-item').forEach(item => {
        item.style.display = '';
      });
    }
  });
}

// ========== TOOLTIP INITIALIZATION ==========
// Initialize Bootstrap tooltips if any
const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
});

// ========== SMOOTH SCROLL ==========
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    const href = this.getAttribute('href');
    if (href !== '#' && href !== '') {
      e.preventDefault();
      const target = document.querySelector(href);
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    }
  });
});

// ========== UTILITY FUNCTIONS ==========

// Format date
function formatDate(date) {
  const options = { year: 'numeric', month: 'short', day: 'numeric' };
  return new Date(date).toLocaleDateString('en-US', options);
}

// Format time
function formatTime(date) {
  const options = { hour: '2-digit', minute: '2-digit' };
  return new Date(date).toLocaleTimeString('en-US', options);
}

// Format relative time
function getRelativeTime(date) {
  const now = new Date();
  const diff = now - new Date(date);
  const seconds = Math.floor(diff / 1000);
  const minutes = Math.floor(seconds / 60);
  const hours = Math.floor(minutes / 60);
  const days = Math.floor(hours / 24);
  
  if (seconds < 60) return 'Just now';
  if (minutes < 60) return `${minutes} min ago`;
  if (hours < 24) return `${hours} hour${hours > 1 ? 's' : ''} ago`;
  if (days < 7) return `${days} day${days > 1 ? 's' : ''} ago`;
  return formatDate(date);
}

// Show toast notification
function showToast(message, type = 'info') {
  const toastContainer = document.querySelector('.toast-container') || createToastContainer();
  
  const toast = document.createElement('div');
  toast.className = `toast align-items-center text-white bg-${type} border-0`;
  toast.setAttribute('role', 'alert');
  toast.setAttribute('aria-live', 'assertive');
  toast.setAttribute('aria-atomic', 'true');
  
  toast.innerHTML = `
    <div class="d-flex">
      <div class="toast-body">${message}</div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  `;
  
  toastContainer.appendChild(toast);
  const bsToast = new bootstrap.Toast(toast);
  bsToast.show();
  
  toast.addEventListener('hidden.bs.toast', () => {
    toast.remove();
  });
}

function createToastContainer() {
  const container = document.createElement('div');
  container.className = 'toast-container position-fixed top-0 end-0 p-3';
  container.style.zIndex = '9999';
  document.body.appendChild(container);
  return container;
}

// ========== PAGE LOADER ==========
function showPageLoader() {
  const loader = document.createElement('div');
  loader.id = 'pageLoader';
  loader.className = 'page-loader';
  loader.innerHTML = '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
  document.body.appendChild(loader);
}

function hidePageLoader() {
  const loader = document.getElementById('pageLoader');
  if (loader) {
    loader.remove();
  }
}

// ========== FORM VALIDATION HELPER ==========
function validateForm(formId) {
  const form = document.getElementById(formId);
  if (!form) return false;
  
  if (form.checkValidity() === false) {
    form.classList.add('was-validated');
    return false;
  }
  
  return true;
}

// ========== EXPORT FUNCTIONS ==========
window.emoceAdmin = {
  setTheme,
  showToast,
  formatDate,
  formatTime,
  getRelativeTime,
  validateForm,
  showPageLoader,
  hidePageLoader,
  toggleSidebar,
  closeSidebar
};

// ========== CONSOLE WELCOME MESSAGE ==========
console.log('%c Emoce Admin Panel ', 'background: #6366f1; color: white; font-size: 16px; padding: 10px; border-radius: 5px;');
console.log('%c Developed with ❤️ ', 'background: #22c55e; color: white; font-size: 12px; padding: 5px; border-radius: 3px;');