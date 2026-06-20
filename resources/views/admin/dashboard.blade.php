@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')

  <div class="stats-grid">
    <div class="stat-card">
      <div class="stat-label">Total Products</div>
      <div class="stat-value">{{ $stats['total_products'] }}</div>
    </div>
    <div class="stat-card accent-green">
      <div class="stat-label">Active Products</div>
      <div class="stat-value">{{ $stats['active_products'] }}</div>
    </div>
    <div class="stat-card accent-red">
      <div class="stat-label">Out of Stock</div>
      <div class="stat-value">{{ $stats['out_of_stock'] }}</div>
    </div>
    <div class="stat-card accent-blue">
      <div class="stat-label">Total Orders</div>
      <div class="stat-value">{{ $stats['total_orders'] }}</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Pending Orders</div>
      <div class="stat-value">{{ $stats['pending_orders'] }}</div>
    </div>
    <div class="stat-card accent-green">
      <div class="stat-label">Total Revenue</div>
      <div class="stat-value">Rs {{ number_format($stats['revenue']) }}</div>
    </div>
  </div>

  <div style="display:grid; grid-template-columns: 1.4fr 1fr; gap:1.5rem;">

    <!-- RECENT ORDERS -->
    <div class="panel">
      <div class="panel-header">
        <h2>Recent Orders</h2>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline btn-sm">View All</a>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr><th>Order #</th><th>Customer</th><th>Total</th><th>Status</th></tr>
          </thead>
          <tbody>
            @forelse ($recentOrders as $order)
              <tr onclick="window.location='{{ route('admin.orders.show', $order) }}'" style="cursor:pointer;">
                <td><strong>{{ $order->order_number }}</strong></td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->formatted_total }}</td>
                <td>
                  <span class="badge {{ $order->status === 'pending' ? 'badge-orange' : ($order->status === 'cancelled' ? 'badge-red' : 'badge-green') }}">
                    {{ ucfirst($order->status) }}
                  </span>
                </td>
              </tr>
            @empty
              <tr><td colspan="4" style="text-align:center; color:var(--text-light);">No orders yet.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- LOW STOCK -->
    <div class="panel">
      <div class="panel-header">
        <h2>Low Stock Alert</h2>
      </div>
      <div class="table-wrap">
        <table>
          <thead><tr><th>Product</th><th>Qty</th></tr></thead>
          <tbody>
            @forelse ($lowStock as $product)
              <tr>
                <td>{{ Str::limit($product->name, 28) }}</td>
                <td><span class="badge badge-red">{{ $product->stock_qty }} left</span></td>
              </tr>
            @empty
              <tr><td colspan="2" style="text-align:center; color:var(--text-light);">All stocked up 👍</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <div style="margin-top:1.5rem;">
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add New Product</a>
  </div>

@endsection
