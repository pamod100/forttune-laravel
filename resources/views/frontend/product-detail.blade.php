@extends('layouts.app')

@section('title', $product->name . ' | Forttune Channels')

@section('content')

  <div class="page-header">
    <div class="container">
      <h1>{{ $product->name }}</h1>
      <p>{{ $product->category->name ?? 'Products' }}</p>
    </div>
  </div>

  <section class="section">
    <div class="container" style="display:grid; grid-template-columns: 1fr 1fr; gap:3rem; align-items:start;">

      <div>
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width:100%; border-radius:14px; border:1px solid var(--grey-100);" />
      </div>

      <div>
        <div class="product-brand" style="font-size:0.85rem;">{{ $product->brand }}</div>
        <h2 style="font-family:var(--font-display); font-size:1.8rem; color:var(--navy); margin:0.5rem 0;">{{ $product->name }}</h2>
        <div style="font-size:1.8rem; font-weight:700; color:var(--blue); font-family:var(--font-display); margin-bottom:1rem;">{{ $product->formatted_price }}</div>

        <span class="badge {{ $product->stock_status === 'in_stock' ? 'badge-green' : 'badge-red' }}" style="display:inline-block; padding:0.3rem 0.8rem; border-radius:99px; font-size:0.8rem; font-weight:600; margin-bottom:1.5rem;
          background:{{ $product->stock_status === 'in_stock' ? '#ECFDF5' : '#FEF2F2' }}; color:{{ $product->stock_status === 'in_stock' ? '#047857' : '#B91C1C' }};">
          {{ $product->stock_label }}
        </span>

        @if ($product->description)
          <p style="color:var(--text-light); line-height:1.7; margin-bottom:1.5rem;">{{ $product->description }}</p>
        @endif

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:0.75rem; margin-bottom:2rem;">
          @if ($product->processor)<div><strong>Processor:</strong><br/><span style="color:var(--text-light);">{{ $product->processor }}</span></div>@endif
          @if ($product->ram)<div><strong>RAM:</strong><br/><span style="color:var(--text-light);">{{ $product->ram }}</span></div>@endif
          @if ($product->storage)<div><strong>Storage:</strong><br/><span style="color:var(--text-light);">{{ $product->storage }}</span></div>@endif
          @if ($product->display)<div><strong>Display:</strong><br/><span style="color:var(--text-light);">{{ $product->display }}</span></div>@endif
          @if ($product->warranty)<div><strong>Warranty:</strong><br/><span style="color:var(--text-light);">{{ $product->warranty }}</span></div>@endif
        </div>

        <button class="btn btn-primary" style="width:100%;" onclick="addToCart('{{ addslashes($product->name) }}', {{ $product->price }}, {{ $product->id }})" {{ $product->stock_status === 'out_of_stock' ? 'disabled' : '' }}>
          {{ $product->stock_status === 'out_of_stock' ? 'Out of Stock' : 'Add to Cart' }}
        </button>
      </div>
    </div>

    @if ($related->count())
      <div class="container" style="margin-top:3rem;">
        <h3 style="font-family:var(--font-display); margin-bottom:1.25rem;">You Might Also Like</h3>
        <div class="product-grid">
          @foreach ($related as $r)
            <div class="product-card">
              <a href="{{ route('products.show', $r) }}" class="product-img"><img src="{{ $r->image_url }}" style="width:100%;height:100%;object-fit:cover;" /></a>
              <div class="product-body">
                <div class="product-brand">{{ $r->brand }}</div>
                <h3 class="product-name"><a href="{{ route('products.show', $r) }}">{{ $r->name }}</a></h3>
                <div class="product-footer">
                  <div class="product-price">{{ $r->formatted_price }}</div>
                  <button class="btn-cart" onclick="addToCart('{{ addslashes($r->name) }}', {{ $r->price }}, {{ $r->id }})">Add to Cart</button>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endif
  </section>

@endsection
