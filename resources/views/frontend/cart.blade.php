@extends('layouts.app')

@section('title', 'Cart & Checkout | Forttune Channels')

@section('content')

  <div class="page-header">
    <div class="container">
      <h1>Shopping Cart</h1>
      <p>Review your items and proceed to checkout</p>
    </div>
  </div>

  <section class="cart-page section">
    <div class="container cart-layout">

      <div class="cart-items-wrap">
        <h2>Your Items</h2>
        <div id="cartItemsList"></div>
        <div class="cart-empty" id="cartEmpty" style="display:none;">
          <span style="font-size:3rem;">🛒</span>
          <p>Your cart is empty.</p>
          <a href="{{ route('products.index') }}" class="btn btn-primary">Browse Products</a>
        </div>
      </div>

      <div class="order-summary">
        <h2>Order Summary</h2>
        <div class="summary-lines" id="summaryLines"></div>
        <div class="summary-total"><span>Total</span><span id="summaryTotal">Rs 0</span></div>

        <div class="delivery-options">
          <h3>Delivery Method</h3>
          <label class="delivery-option">
            <input type="radio" name="delivery" value="delivery" id="optDelivery" checked />
            <div class="delivery-option-body"><strong>🚚 Island-Wide Delivery</strong><span>2–4 business days</span></div>
          </label>
          <label class="delivery-option">
            <input type="radio" name="delivery" value="pickup" id="optPickup" />
            <div class="delivery-option-body"><strong>🏪 Click &amp; Collect</strong><span>Same day — Mount Lavinia store</span></div>
          </label>
        </div>

        <div class="checkout-form" id="checkoutSection">
          <h3>Your Details</h3>
          <div class="form-group">
            <label>Full Name *</label>
            <input type="text" id="oName" value="{{ auth()->user()->name ?? '' }}" placeholder="Full name" />
          </div>
          <div class="form-group">
            <label>Phone *</label>
            <input type="tel" id="oPhone" placeholder="+94 7XX XXX XXX" />
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" id="oEmail" value="{{ auth()->user()->email ?? '' }}" placeholder="your@email.com" />
          </div>
          <div class="form-group" id="addressGroup">
            <label>Delivery Address *</label>
            <textarea id="oAddress" rows="2" placeholder="No., Street, City"></textarea>
          </div>

          <h3>Payment Method</h3>
          <label class="payment-option"><input type="radio" name="payment" value="payhere" checked /><strong>💳 PayHere</strong> — Card / Mobile Wallet</label>
          <label class="payment-option"><input type="radio" name="payment" value="webxpay" /><strong>📱 WebXPay</strong> — Mobile Payments</label>
          <label class="payment-option"><input type="radio" name="payment" value="cod" /><strong>💵 Cash on Delivery</strong></label>

          <button class="btn btn-primary btn-full" onclick="placeOrder()" style="margin-top:1.5rem;">Place Order</button>
        </div>

        <div class="order-success" id="orderSuccess" style="display:none;">
          <div style="font-size:3rem;text-align:center;">✅</div>
          <h3 style="text-align:center;">Order Placed!</h3>
          <p style="text-align:center;" id="orderNumberText">Thank you!</p>
          <a href="{{ route('products.index') }}" class="btn btn-primary btn-full" style="margin-top:1rem;">Continue Shopping</a>
        </div>
      </div>

    </div>
  </section>

@endsection

@push('scripts')
<script src="{{ asset('js/cart.js') }}"></script>
<script>
  // Override placeOrder() to actually POST to Laravel backend
  function placeOrder() {
    const name = document.getElementById('oName').value.trim();
    const phone = document.getElementById('oPhone').value.trim();
    const email = document.getElementById('oEmail').value.trim();
    const delivery = document.querySelector('input[name="delivery"]:checked').value;
    const address = document.getElementById('oAddress').value.trim();
    const payment = document.querySelector('input[name="payment"]:checked').value;
    const cart = getCart();

    if (!name || !phone) { alert('Please enter your name and phone number.'); return; }
    if (delivery === 'delivery' && !address) { alert('Please enter your delivery address.'); return; }
    if (cart.length === 0) { alert('Your cart is empty.'); return; }

    const payload = {
      customer_name: name,
      customer_phone: phone,
      customer_email: email,
      delivery_method: delivery,
      delivery_address: address,
      payment_method: payment,
      items: cart.map(i => ({ name: i.name, price: i.price, qty: i.qty, product_id: i.product_id || null })),
    };

    fetch('{{ route("checkout.place") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      },
      body: JSON.stringify(payload),
    })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        saveCart([]);
        document.getElementById('checkoutSection').style.display = 'none';
        document.getElementById('orderNumberText').textContent = `Order #${data.order_number} — our team will confirm via phone within 2 hours.`;
        document.getElementById('orderSuccess').style.display = 'block';
      } else {
        alert('Something went wrong placing your order. Please try again.');
      }
    })
    .catch(() => alert('Could not connect to the server. Please check your connection and try again.'));
  }
  window.placeOrder = placeOrder;
</script>
@endpush
