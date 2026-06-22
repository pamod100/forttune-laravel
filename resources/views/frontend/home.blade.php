@extends('layouts.app')

@section('title', 'Forttune | Technology Provider')

@section('content')

 <!-- HERO with auto-sliding photo background -->
<section class="hero hero-with-slider" id="autoSlider">

  <!-- Sliding background images -->
  <div class="hero-slider-bg">
    <div class="auto-slide active">
      <img src="{{ asset('images/slider/slide1.jpg') }}" alt="Slide 1">
    </div>
    <div class="auto-slide">
      <img src="{{ asset('images/slider/slide2.jpg') }}" alt="Slide 2">
    </div>
    <div class="auto-slide">
      <img src="{{ asset('images/slider/slide3.jpg') }}" alt="Slide 3">
    </div>
    <div class="auto-slide">
      <img src="{{ asset('images/slider/slide4.jpg') }}" alt="Slide 4">
    </div>
  </div>

  <!-- Dark overlay so text stays readable -->
  <div class="hero-overlay"></div>

  <!-- Your existing hero text, now sitting ON TOP of the slider -->
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

  <!-- Dot navigation -->
  <div class="auto-slider-dots">
    <button class="auto-dot active" data-index="0"></button>
    <button class="auto-dot" data-index="1"></button>
    <button class="auto-dot" data-index="2"></button>
    <button class="auto-dot" data-index="3"></button>
  </div>

  <!-- Stats bar stays at the bottom of the hero, like before -->
  <div class="hero-stats">
    <div class="container hero-stats-inner">
      <div class="stat"><span class="stat-num">500+</span><span class="stat-label">Channel Partners</span></div>
      <div class="stat"><span class="stat-num">15+</span><span class="stat-label">Years Experience</span></div>
      <div class="stat"><span class="stat-num">50+</span><span class="stat-label">Brands Stocked</span></div>
      <div class="stat"><span class="stat-num">Island</span><span class="stat-label">Wide Delivery</span></div>
    </div>
  </div>

</section>

<!-- CATEGORIES -->
<section class="categories section">
  <div class="container">
    <div class="section-header">
      <span class="section-eyebrow">Shop by Category</span>
      <h2 class="section-title">Everything Tech, One Destination</h2>
    </div>
    <div class="cat-grid">
      @forelse ($categories as $cat)
        <a href="{{ route('products.index', ['cat' => $cat->slug]) }}" class="cat-card">
          <div class="cat-img-wrap">
            @if($cat->image)
              <img src="{{ asset('storage/'.$cat->image) }}" alt="{{ $cat->name }}" class="cat-img">
            @else
              <div class="cat-icon-fallback">{{ $cat->icon ?: '📦' }}</div>
            @endif
          </div>
          <div class="cat-info">
            <div class="cat-name">{{ $cat->name }}</div>
            <div class="cat-count">{{ $cat->products_count }} products</div>
          </div>
          <div class="cat-arrow">→</div>
        </a>
      @empty
        <p>No categories yet.</p>
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
  </div>
  <div class="brands-carousel-wrap">
    <div class="brands-carousel" id="brandsCarousel">
      @foreach ([
        ['name'=>'HP','logo'=>'https://logo.clearbit.com/hp.com'],
        ['name'=>'Dell','logo'=>'https://logo.clearbit.com/dell.com'],
        ['name'=>'Lenovo','logo'=>'https://logo.clearbit.com/lenovo.com'],
        ['name'=>'Asus','logo'=>'https://logo.clearbit.com/asus.com'],
        ['name'=>'Acer','logo'=>'https://logo.clearbit.com/acer.com'],
        ['name'=>'MSI','logo'=>'https://logo.clearbit.com/msi.com'],
        ['name'=>'Brother','logo'=>'https://logo.clearbit.com/brother.com'],
        ['name'=>'D-Link','logo'=>'https://logo.clearbit.com/dlink.com'],
        ['name'=>'Transcend','logo'=>'https://logo.clearbit.com/transcend-info.com'],
        ['name'=>'Lexar','logo'=>'https://logo.clearbit.com/lexar.com'],
        ['name'=>'ViewSonic','logo'=>'https://logo.clearbit.com/viewsonic.com'],
        ['name'=>'Tiandy','logo'=>'https://logo.clearbit.com/tiandy.com'],
      ] as $brand)
        <div class="brand-card">
          <img src="{{ $brand['logo'] }}" alt="{{ $brand['name'] }}" class="brand-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
          <span class="brand-name-fallback" style="display:none;">{{ $brand['name'] }}</span>
          <p class="brand-label">{{ $brand['name'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="testimonials section" id="services">
  <div class="container">
 
    {{-- Section Header --}}
    <div class="section-header">
      <span class="section-eyebrow">What Customers Say</span>
      <h2 class="section-title">Trusted by Businesses Across Sri Lanka</h2>
    </div>
 
    @if($testimonials->count() > 0)
 
      {{-- Google-style Overall Rating Bar --}}
      @php
        $avgRating = round($testimonials->avg('rating'), 1);
        $totalReviews = $testimonials->count();
        // Count per star
        $starCounts = [];
        for ($s = 5; $s >= 1; $s--) {
          $starCounts[$s] = $testimonials->where('rating', $s)->count();
        }
      @endphp
 
      <div class="gr-summary-card">
        {{-- Left: Big Score --}}
        <div class="gr-score-block">
          <div class="gr-score-number">{{ number_format($avgRating, 1) }}</div>
          <div class="gr-score-stars">
            @for($i = 1; $i <= 5; $i++)
              <svg class="gr-star {{ $i <= round($avgRating) ? 'filled' : 'empty' }}" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 1l2.39 4.84 5.34.78-3.87 3.77.91 5.32L10 13.27l-4.77 2.51.91-5.32L2.27 6.62l5.34-.78z"/>
              </svg>
            @endfor
          </div>
          <div class="gr-score-total">{{ $totalReviews }} review{{ $totalReviews > 1 ? 's' : '' }}</div>
        </div>
 
        {{-- Divider --}}
        <div class="gr-divider"></div>
 
        {{-- Right: Star breakdown bars --}}
        <div class="gr-bars-block">
          @for($s = 5; $s >= 1; $s--)
            @php $pct = $totalReviews > 0 ? ($starCounts[$s] / $totalReviews) * 100 : 0; @endphp
            <div class="gr-bar-row">
              <span class="gr-bar-label">{{ $s }}</span>
              <svg class="gr-bar-star" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 1l2.39 4.84 5.34.78-3.87 3.77.91 5.32L10 13.27l-4.77 2.51.91-5.32L2.27 6.62l5.34-.78z"/>
              </svg>
              <div class="gr-bar-track">
                <div class="gr-bar-fill" style="width: {{ $pct }}%;"></div>
              </div>
              <span class="gr-bar-count">{{ $starCounts[$s] }}</span>
            </div>
          @endfor
        </div>
      </div>
 
      {{-- Review Cards Grid --}}
      <div class="gr-reviews-grid">
        @foreach($testimonials as $t)
          @php
            $initials = collect(explode(' ', trim($t->name)))
              ->map(fn($w) => strtoupper(substr($w, 0, 1)))
              ->take(2)
              ->join('');
            // Pick a color based on first letter
            $colors = ['#4285F4','#EA4335','#34A853','#FBBC05','#7B61FF','#00ACC1'];
            $colorIndex = (ord($initials[0]) - 65) % count($colors);
            $avatarColor = $colors[$colorIndex];
          @endphp
          <div class="gr-card">
            {{-- Card Header --}}
            <div class="gr-card-header">
              <div class="gr-avatar" style="background: {{ $avatarColor }};">{{ $initials }}</div>
              <div class="gr-card-meta">
                <div class="gr-card-name">{{ $t->name }}</div>
                @if($t->role)
                  <div class="gr-card-role">{{ $t->role }}</div>
                @endif
              </div>
              {{-- Google G icon --}}
              <div class="gr-google-icon">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                  <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                  <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                  <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
              </div>
            </div>
 
            {{-- Stars + Date --}}
            <div class="gr-card-stars-row">
              <div class="gr-card-stars">
                @for($i = 1; $i <= 5; $i++)
                  <svg class="gr-star sm {{ $i <= $t->rating ? 'filled' : 'empty' }}" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 1l2.39 4.84 5.34.78-3.87 3.77.91 5.32L10 13.27l-4.77 2.51.91-5.32L2.27 6.62l5.34-.78z"/>
                  </svg>
                @endfor
              </div>
              <span class="gr-card-date">{{ $t->created_at->diffForHumans() }}</span>
            </div>
 
            {{-- Review Text --}}
            <p class="gr-card-text">{{ $t->message }}</p>
          </div>
        @endforeach
      </div>
 
    @else
      <p style="text-align:center; color:#888; padding: 2rem 0;">No reviews yet.</p>
    @endif
 
    <div style="text-align:center; margin-top:2.5rem;">
      <a href="{{ route('services') }}" class="btn-view-services">View Our Services →</a>
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
@push('scripts')
<script>
  (function () {
    const slides = document.querySelectorAll('.auto-slide');
    const dots = document.querySelectorAll('.auto-dot');
    let current = 0;

    function goTo(i) {
      slides[current].classList.remove('active');
      dots[current].classList.remove('active');
      current = (i + slides.length) % slides.length;
      slides[current].classList.add('active');
      dots[current].classList.add('active');
    }

    dots.forEach((dot, i) => dot.addEventListener('click', () => goTo(i)));

    if (slides.length > 1) {
      setInterval(() => goTo(current + 1), 4000); // changes every 4 seconds
    }
  })();
</script>

<script>
// Duplicate cards for infinite scroll effect
const carousel = document.getElementById('brandsCarousel');
if (carousel) {
  carousel.innerHTML += carousel.innerHTML;
}
</script>
@endpush