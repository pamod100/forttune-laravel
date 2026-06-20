// ============================================
// FORTTUNE CHANNELS — MAIN JS (Laravel frontend)
// ============================================

// === CART (localStorage) ===
function getCart() {
  try { return JSON.parse(localStorage.getItem('forttuneCart')) || []; }
  catch { return []; }
}
function saveCart(cart) {
  localStorage.setItem('forttuneCart', JSON.stringify(cart));
  updateCartCount();
}
function updateCartCount() {
  const cart = getCart();
  const total = cart.reduce((s, i) => s + i.qty, 0);
  document.querySelectorAll('#cartCount').forEach(el => el.textContent = total);
}

function addToCart(name, price, productId = null) {
  const cart = getCart();
  const existing = cart.find(i => i.name === name);
  if (existing) { existing.qty++; }
  else { cart.push({ name, price, qty: 1, product_id: productId }); }
  saveCart(cart);
  showToast(`✅ Added: ${name}`);
}

// === TOAST ===
function showToast(msg) {
  const t = document.getElementById('toast');
  if (!t) return;
  t.textContent = msg;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 2800);
}

// === HEADER SCROLL ===
const header = document.getElementById('header');
window.addEventListener('scroll', () => {
  if (header) {
    header.style.boxShadow = window.scrollY > 20
      ? '0 2px 20px rgba(10,22,40,0.12)'
      : '0 1px 8px rgba(10,22,40,0.07)';
  }
});

// === HAMBURGER ===
const hamburger = document.getElementById('hamburger');
const nav = document.getElementById('nav');
if (hamburger && nav) {
  hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('open');
    nav.classList.toggle('open');
    document.body.style.overflow = nav.classList.contains('open') ? 'hidden' : '';
  });
  nav.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => {
      hamburger.classList.remove('open');
      nav.classList.remove('open');
      document.body.style.overflow = '';
    });
  });
}

// === SEARCH TOGGLE ===
const searchToggle = document.getElementById('searchToggle');
const searchBar = document.getElementById('searchBar');
if (searchToggle && searchBar) {
  searchToggle.addEventListener('click', () => {
    searchBar.classList.toggle('open');
    if (searchBar.classList.contains('open')) {
      document.getElementById('searchInput')?.focus();
    }
  });
  document.getElementById('searchInput')?.addEventListener('keydown', e => {
    if (e.key === 'Enter') {
      const q = e.target.value.trim();
      if (q) window.location.href = `/products?search=${encodeURIComponent(q)}`;
    }
  });
}

// === ACCOUNT DROPDOWN ===
const accountToggle = document.getElementById('accountToggle');
const accountDropdown = document.getElementById('accountDropdown');
if (accountToggle && accountDropdown) {
  accountToggle.addEventListener('click', (e) => {
    e.stopPropagation();
    accountDropdown.classList.toggle('open');
  });
  document.addEventListener('click', () => accountDropdown.classList.remove('open'));
}

// === INIT ===
document.addEventListener('DOMContentLoaded', () => {
  updateCartCount();
});

// Expose globally
window.addToCart = addToCart;
window.getCart = getCart;
window.saveCart = saveCart;
window.showToast = showToast;
