@extends('layouts.admin')

@section('title', 'Order ' . $order->order_number)
@section('page-title', 'Order ' . $order->order_number)

@section('content')

  <div style="display:grid; grid-template-columns: 1.5fr 1fr; gap:1.5rem; align-items:start;">

    <div class="panel">
      <div class="panel-header"><h2>Order Items</h2></div>
      <div class="table-wrap">
        <table>
          <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th></tr></thead>
          <tbody>
            @foreach ($order->items as $item)
              <tr>
                <td>{{ $item->product_name }}</td>
                <td>Rs {{ number_format($item->price) }}</td>
                <td>{{ $item->qty }}</td>
                <td><strong>Rs {{ number_format($item->price * $item->qty) }}</strong></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="panel-body" style="text-align:right; border-top:1px solid var(--grey-100);">
        <strong style="font-size:1.2rem;">Total: {{ $order->formatted_total }}</strong>
      </div>
    </div>

    <div>
      <div class="panel" style="margin-bottom:1.5rem;">
        <div class="panel-header"><h2>Customer Details</h2></div>
        <div class="panel-body">
          <p><strong>Name:</strong> {{ $order->customer_name }}</p>
          <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
          <p><strong>Email:</strong> {{ $order->customer_email ?: '—' }}</p>
          <p style="margin-top:0.75rem;"><strong>Delivery:</strong> {{ $order->delivery_method === 'pickup' ? '🏪 Click & Collect' : '🚚 Island-Wide Delivery' }}</p>
          @if ($order->delivery_address)
            <p><strong>Address:</strong> {{ $order->delivery_address }}</p>
          @endif
          <p><strong>Payment:</strong> {{ strtoupper($order->payment_method) }}</p>
        </div>
      </div>

      <div class="panel">
        <div class="panel-header"><h2>Update Status</h2></div>
        <div class="panel-body">
          <form method="POST" action="{{ route('admin.orders.status', $order) }}">
            @csrf
            <div class="form-group">
              <select name="status">
                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;">Update Status</button>
          </form>
        </div>
      </div>
    </div>

  </div>

@endsection
