@extends('layouts.app')

@section('title', 'Products | Forttune Channels')

@section('content')

  <div class="page-header">
    <div class="container">
      <h1>All Products</h1>
      <p>Browse our complete range of IT hardware and technology solutions</p>
    </div>
  </div>

  <section class="products-page section">
    <div class="container products-layout">

      <aside class="sidebar">
        <div class="sidebar-section">
          <h3>Categories</h3>
          <ul class="sidebar-cats">
            <li><a href="{{ route('products.index') }}" class="{{ !request('cat') ? 'active' : '' }}">All Products</a></li>
            @foreach ($categories as $cat)
              <li><a href="{{ route('products.index', ['cat' => $cat->slug]) }}" class="{{ request('cat') === $cat->slug ? 'active' : '' }}">{{ $cat->name }}</a></li>
            @endforeach
          </ul>
        </div>

        <div class="sidebar-section">
          <h3>Price Range (LKR)</h3>
          <form method="GET" id="priceForm">
            @if(request('cat')) <input type="hidden" name="cat" value="{{ request('cat') }}"> @endif
            <input type="range" min="0" max="600000" step="5000" value="{{ request('max_price', 600000) }}" id="priceRange" class="range-slider" name="max_price" onchange="document.getElementById('priceForm').submit()" />
            <div class="price-labels">
              <span>Rs 0</span>
              <span id="priceVal">{{ request('max_price', 600000) >= 600000 ? 'Rs 600,000+' : 'Rs ' . number_format(request('max_price')) }}</span>
            </div>
          </form>
        </div>
      </aside>

      <div class="products-main">
        <div class="products-toolbar">
          <span class="result-count">Showing {{ $products->total() }} product{{ $products->total() !== 1 ? 's' : '' }}</span>
          <form method="GET" id="sortForm">
            @if(request('cat')) <input type="hidden" name="cat" value="{{ request('cat') }}"> @endif
            @if(request('max_price')) <input type="hidden" name="max_price" value="{{ request('max_price') }}"> @endif
            <select class="sort-select" name="sort" onchange="document.getElementById('sortForm').submit()">
              <option value="default">Sort: Default</option>
              <option value="price-asc" {{ request('sort') === 'price-asc' ? 'selected' : '' }}>Price: Low to High</option>
              <option value="price-desc" {{ request('sort') === 'price-desc' ? 'selected' : '' }}>Price: High to Low</option>
              <option value="name-asc" {{ request('sort') === 'name-asc' ? 'selected' : '' }}>Name: A–Z</option>
            </select>
          </form>
        </div>

        <div class="product-grid products-full">
          @forelse ($products as $product)
            <div class="product-card">
              @if ($product->stock_status === 'out_of_stock')
                <div class="product-badge" style="background:#DC2626;">Out of Stock</div>
              @elseif ($product->is_featured)
                <div class="product-badge">Featured</div>
              @endif
              <a href="{{ route('products.show', $product) }}" class="product-img">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width:100%; height:100%; object-fit:cover;" />
              </a>
              <div class="product-body">
                <div class="product-brand">{{ $product->brand }}</div>
                <h3 class="product-name"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h3>
                <div class="product-specs">
                  @if ($product->processor)<span>{{ $product->processor }}</span>@endif
                  @if ($product->display)<span>{{ $product->display }}</span>@endif
                </div>
                <div class="product-footer">
                  <div class="product-price">{{ $product->formatted_price }}</div>
                  <button class="btn-cart" onclick="addToCart('{{ addslashes($product->name) }}', {{ $product->price }}, {{ $product->id }})" {{ $product->stock_status === 'out_of_stock' ? 'disabled' : '' }}>Add to Cart</button>
                </div>
              </div>
            </div>
          @empty
            <p style="grid-column:1/-1; text-align:center; color:var(--text-light); padding:3rem 0;">No products found. Try a different category or price range.</p>
          @endforelse
        </div>

        <div style="margin-top:2rem;">
          {{ $products->links() }}
        </div>
      </div>
    </div>
  </section>

@endsection
