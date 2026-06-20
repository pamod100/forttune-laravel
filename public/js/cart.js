// ============================================
// FORTTUNE — CART PAGE JS
// ============================================

document.addEventListener('DOMContentLoaded', () => {
  renderCart();

  // Hide address field when pickup selected
  document.querySelectorAll('input[name="delivery"]').forEach(radio => {
    radio.addEventListener('change', () => {
      const addressGroup = document.getElementById('addressGroup');
      if (addressGroup) {
        addressGroup.style.display = radio.value === 'pickup' ? 'none' : 'flex';
      }
    });
  });
});

function renderCart() {
  const cart = getCart();
  const listEl = document.getElementById('cartItemsList');
  const emptyEl = document.getElementById('cartEmpty');
  const summaryLines = document.getElementById('summaryLines');
  const summaryTotal = document.getElementById('summaryTotal');
  const checkoutSection = document.getElementById('checkoutSection');

  if (!listEl) return;

  if (cart.length === 0) {
    listEl.innerHTML = '';
    if (emptyEl) emptyEl.style.display = 'block';
    if (checkoutSection) checkoutSection.style.display = 'none';
    if (summaryLines) summaryLines.innerHTML = '<p style="font-size:.85rem;color:var(--text-light)">No items yet.</p>';
    if (summaryTotal) summaryTotal.textContent = 'Rs 0';
    return;
  }

  if (emptyEl) emptyEl.style.display = 'none';

  // Render items
  listEl.innerHTML = cart.map((item, idx) => `
    <div class="cart-item">
      <div class="cart-item-icon">${getCategoryIcon(item.name)}</div>
      <div class="cart-item-name">${item.name}</div>
      <div style="display:flex;align-items:center;gap:.75rem;flex-shrink:0;">
        <div style="display:flex;align-items:center;gap:.35rem;">
          <button onclick="changeQty(${idx},-1)" style="background:var(--grey-100);border:none;border-radius:6px;width:26px;height:26px;font-size:1rem;cursor:pointer;">−</button>
          <span style="font-size:.9rem;font-weight:600;min-width:20px;text-align:center;">${item.qty}</span>
          <button onclick="changeQty(${idx},1)" style="background:var(--grey-100);border:none;border-radius:6px;width:26px;height:26px;font-size:1rem;cursor:pointer;">+</button>
        </div>
        <div class="cart-item-price">Rs ${(item.price * item.qty).toLocaleString()}</div>
        <button class="cart-item-remove" onclick="removeItem(${idx})">✕</button>
      </div>
    </div>
  `).join('');

  // Summary
  const total = cart.reduce((s, i) => s + i.price * i.qty, 0);
  if (summaryLines) {
    summaryLines.innerHTML = cart.map(i =>
      `<div class="summary-line"><span>${i.name} ×${i.qty}</span><span>Rs ${(i.price * i.qty).toLocaleString()}</span></div>`
    ).join('');
  }
  if (summaryTotal) summaryTotal.textContent = `Rs ${total.toLocaleString()}`;
}

function getCategoryIcon(name) {
  const n = name.toLowerCase();
  if (n.includes('laptop') || n.includes('notebook') || n.includes('elitebook') || n.includes('probook') || n.includes('inspiron') || n.includes('vivobook') || n.includes('ryzen') || n.includes('aspire')) return '💻';
  if (n.includes('monitor') || n.includes('display')) return '📺';
  if (n.includes('printer') || n.includes('scanner')) return '🖨️';
  if (n.includes('ssd') || n.includes('hdd') || n.includes('storage') || n.includes('ram')) return '💾';
  if (n.includes('switch') || n.includes('router') || n.includes('d-link') || n.includes('network')) return '📡';
  if (n.includes('camera') || n.includes('tiandy') || n.includes('cctv')) return '📷';
  if (n.includes('keyboard') || n.includes('mouse')) return '⌨️';
  return '📦';
}

function changeQty(idx, delta) {
  const cart = getCart();
  if (!cart[idx]) return;
  cart[idx].qty += delta;
  if (cart[idx].qty <= 0) cart.splice(idx, 1);
  saveCart(cart);
  renderCart();
}

function removeItem(idx) {
  const cart = getCart();
  const name = cart[idx]?.name;
  cart.splice(idx, 1);
  saveCart(cart);
  renderCart();
  if (name) showToast(`Removed: ${name}`);
}

// NOTE: placeOrder() is defined in cart.blade.php — it POSTs to the real
// Laravel backend (/checkout/place-order) instead of just clearing localStorage.

window.changeQty = changeQty;
window.removeItem = removeItem;
