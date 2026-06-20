@extends('layouts.admin')

@section('title', 'Products')
@section('page-title', 'Manage Products')

@section('content')

  <div class="panel">
    <div class="panel-header">
      <h2>All Products ({{ $products->total() }})</h2>
      <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add New Product</a>
    </div>

    <div class="panel-body" style="padding-bottom:0;">
      <form method="GET" class="filter-bar" style="margin-bottom:1.25rem;">
        <input type="text" name="search" placeholder="Search by product name…" value="{{ request('search') }}" />
        <select name="category" onchange="this.form.submit()">
          <option value="">All Categories</option>
          @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
          @endforeach
        </select>
        <button type="submit" class="btn btn-outline btn-sm">Filter</button>
      </form>
    </div>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
            <tr>
              <td><img src="{{ $product->image_url }}" class="table-thumb" alt="{{ $product->name }}" /></td>
              <td>
                <strong>{{ $product->name }}</strong><br/>
                <span style="color:var(--text-light); font-size:0.78rem;">{{ $product->brand }}</span>
              </td>
              <td>{{ $product->category->name ?? '—' }}</td>
              <td><strong>{{ $product->formatted_price }}</strong></td>
              <td>{{ $product->stock_qty }}</td>
              <td>
                <form method="POST" action="{{ route('admin.products.toggle-stock', $product) }}">
                  @csrf
                  <button type="submit" class="badge {{ $product->stock_status === 'in_stock' ? 'badge-green' : 'badge-red' }}" style="border:none; cursor:pointer;">
                    {{ $product->stock_label }}
                  </button>
                </form>
              </td>
              <td>
                <div style="display:flex; gap:0.5rem;">
                  <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline btn-sm">Edit</a>
                  <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Delete this product? This cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr><td colspan="7" style="text-align:center; padding:2rem; color:var(--text-light);">No products yet. Click "Add New Product" to get started.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="pagination-wrap">
      {{ $products->links() }}
    </div>
  </div>

@endsection
