@extends('layouts.app')

@section('title', 'Forttune | Technology Provider')

@section('content')

  <!-- HERO -->
  <section class="hero">
    <div class="hero-slides">
      <div class="hero-slide active" style="--bg: linear-gradient(135deg, #0A1628 0%, #0D2347 60%, #0A1628 100%);">
        <div class="container hero-content">
          <div class="hero-text">
            <span class="hero-eyebrow">Sri Lanka's Trusted IT Distributor</span>
            <h1 class="hero-title">Power Your<br/><span class="hero-accent">Business</span><br/>With Premium Tech</h1>
            <p class="hero-desc">Laptops, Desktops, Servers, Printers & Networking solutions — all under one roof. Serving 500+ channel partners island-wide.</p>
            <div class="hero-cta">
              <a href="{{ route('products.index') }}" class="btn btn-primary">Browse Products</a>
              <a href="{{ route('home') }}#contact" class="btn btn-outline">Get a Quote</a>
            </div>
          </div>
          
        </div>
      </div>
    </div>

    <div class="hero-stats">
      <div class="container hero-stats-inner">
        <div class="stat"><span class="stat-num">500+</span><span class="stat-label">Channel Partners</span></div>
        <div class="stat"><span class="stat-num">15+</span><span class="stat-label">Years Experience</span></div>
        <div class="stat"><span class="stat-num">50+</span><span class="stat-label">Brands Stocked</span></div>
        <div class="stat"><span class="stat-num">Island</span><span class="stat-label">Wide Delivery</span></div>
      </div>
    </div>
  </section>

  <!-- CATEGORIES (from database) -->
  <section class="categories section">
    <div class="container">
      <div class="section-header">
        <span class="section-eyebrow">Shop by Category</span>
        <h2 class="section-title">Everything Tech, One Destination</h2>
      </div>
      <div class="cat-grid">
        @forelse ($categories as $cat)
          <a href="{{ route('products.index', ['cat' => $cat->slug]) }}" class="cat-card">
            <div class="cat-icon">{{ $cat->icon ?: '📦' }}</div>
            <div class="cat-name">{{ $cat->name }}</div>
            <div class="cat-count">{{ $cat->products_count }} products</div>
            <div class="cat-arrow">→</div>
          </a>
        @empty
          <p style="color:var(--text-light);">No categories added yet. Add some from the admin panel.</p>
        @endforelse
      </div>
    </div>
  </section>

  <!-- FEATURED PRODUCTS (from database) -->
  <section class="featured section bg-light">
    <div class="container">
      <div class="section-header">
        <span class="section-eyebrow">Featured Products</span>
        <h2 class="section-title">Top Picks This Week</h2>
        <a href="{{ route('products.index') }}" class="section-link">View All Products →</a>
      </div>

      <div class="product-grid">
        @forelse ($featuredProducts as $product)
          <div class="product-card">
            @if ($product->stock_status === 'out_of_stock')
              <div class="product-badge" style="background:#DC2626;">Out of Stock</div>
            @endif
            <a href="{{ route('products.show', $product) }}" class="product-img">
              <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width:100%; height:100%; object-fit:cover;" />
            </a>
            <div class="product-body">
              <div class="product-brand">{{ $product->brand }}</div>
              <h3 class="product-name"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h3>
              <div class="product-specs">
                @if ($product->processor)<span>{{ $product->processor }}</span>@endif
                @if ($product->ram)<span>{{ $product->ram }}</span>@endif
              </div>
              <div class="product-footer">
                <div class="product-price">{{ $product->formatted_price }}</div>
                <button class="btn-cart" onclick="addToCart('{{ addslashes($product->name) }}', {{ $product->price }}, {{ $product->id }})" {{ $product->stock_status === 'out_of_stock' ? 'disabled' : '' }}>Add to Cart</button>
              </div>
            </div>
          </div>
        @empty
          <p style="color:var(--text-light); grid-column: 1/-1; text-align:center; padding:2rem;">No featured products yet. Mark some products as "Featured" in the admin panel.</p>
        @endforelse
      </div>
    </div>
  </section>

  <!-- BRANDS -->
  <section class="brands section" id="brands">
    <div class="container">
      <div class="section-header">
        <span class="section-eyebrow">Our Brands</span>
        <h2 class="section-title">Authorized Distributor For</h2>
      </div>
      <div class="brands-strip">
        @foreach (['HP','Dell','Lenovo','Asus','Acer','MSI','Brother','D-Link','Transcend','Lexar','Tiandy','ViewSonic'] as $brand)
          <div class="brand-logo">{{ $brand }}</div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- SERVICES -->
  <section class="services section bg-dark" id="services">
    <div class="container">
      <div class="section-header light">
        <span class="section-eyebrow">What We Offer</span>
        <h2 class="section-title">More Than Just Products</h2>
      </div>
      <div class="services-grid">
        <div class="service-card"><div class="service-icon">🚚</div><h3>Island-Wide Delivery</h3><p>Fast, reliable delivery to any address across Sri Lanka.</p></div>
        <div class="service-card"><div class="service-icon">🛡️</div><h3>Genuine Warranty</h3><p>All products come with manufacturer warranty.</p></div>
        <div class="service-card"><div class="service-icon">🏪</div><h3>Click &amp; Collect</h3><p>Order online, pick up from our Mount Lavinia store.</p></div>
        <div class="service-card"><div class="service-icon">🤝</div><h3>Dealer Network</h3><p>Join our 500+ channel partner network for wholesale pricing.</p></div>
      </div>
    </div>
  </section>

  <!-- CONTACT STRIP -->
  <section class="contact-strip section" id="contact">
    <div class="container">
      <div class="contact-strip-inner">
        <div class="contact-item"><div class="contact-icon">📍</div><div><div class="contact-label">Visit Us</div><div class="contact-value">No. 312, Galle Road, Mount Lavinia</div></div></div>
        <div class="contact-item"><div class="contact-icon">📞</div><div><div class="contact-label">Hotline / WhatsApp</div><div class="contact-value"><a href="tel:+94725516516">+94 725 516 516</a></div></div></div>
        <div class="contact-item"><div class="contact-icon">✉️</div><div><div class="contact-label">Email</div><div class="contact-value"><a href="mailto:info@forttune.lk">info@forttune.lk</a></div></div></div>
      </div>
    </div>
  </section>

@endsection

@push('scripts')
<script>
  document.querySelectorAll('.product-name a, .product-img').forEach(el => {
    el.addEventListener('click', e => e.stopPropagation());
  });
</script>
@endpush
