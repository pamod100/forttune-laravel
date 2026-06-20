@extends('layouts.admin')

@section('title', 'Orders')
@section('page-title', 'Manage Orders')

@section('content')

  <div class="panel">
    <div class="panel-header">
      <h2>All Orders ({{ $orders->total() }})</h2>
      <form method="GET" class="filter-bar">
        <select name="status" onchange="this.form.submit()">
          <option value="">All Statuses</option>
          <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
          <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
          <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Shipped</option>
          <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
          <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
      </form>
    </div>

    <div class="table-wrap">
      <table>
        <thead>
          <tr><th>Order #</th><th>Customer</th><th>Phone</th><th>Delivery</th><th>Total</th><th>Status</th><th>Date</th><th></th></tr>
        </thead>
        <tbody>
          @forelse ($orders as $order)
            <tr>
              <td><strong>{{ $order->order_number }}</strong></td>
              <td>{{ $order->customer_name }}</td>
              <td>{{ $order->customer_phone }}</td>
              <td>{{ $order->delivery_method === 'pickup' ? '🏪 Pickup' : '🚚 Delivery' }}</td>
              <td><strong>{{ $order->formatted_total }}</strong></td>
              <td>
                <span class="badge {{ $order->status === 'pending' ? 'badge-orange' : ($order->status === 'cancelled' ? 'badge-red' : 'badge-green') }}">
                  {{ ucfirst($order->status) }}
                </span>
              </td>
              <td>{{ $order->created_at->format('d M, H:i') }}</td>
              <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline btn-sm">View</a></td>
            </tr>
          @empty
            <tr><td colspan="8" style="text-align:center; padding:2rem; color:var(--text-light);">No orders yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="pagination-wrap">{{ $orders->links() }}</div>
  </div>

@endsection
