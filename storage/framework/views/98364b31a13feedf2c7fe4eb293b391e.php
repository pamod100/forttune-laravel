<?php $__env->startSection('title', 'Order ' . $order->order_number); ?>
<?php $__env->startSection('page-title', 'Order ' . $order->order_number); ?>

<?php $__env->startSection('content'); ?>

  <div style="display:grid; grid-template-columns: 1.5fr 1fr; gap:1.5rem; align-items:start;">

    <div class="panel">
      <div class="panel-header"><h2>Order Items</h2></div>
      <div class="table-wrap">
        <table>
          <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th></tr></thead>
          <tbody>
            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($item->product_name); ?></td>
                <td>Rs <?php echo e(number_format($item->price)); ?></td>
                <td><?php echo e($item->qty); ?></td>
                <td><strong>Rs <?php echo e(number_format($item->price * $item->qty)); ?></strong></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
      <div class="panel-body" style="text-align:right; border-top:1px solid var(--grey-100);">
        <strong style="font-size:1.2rem;">Total: <?php echo e($order->formatted_total); ?></strong>
      </div>
    </div>

    <div>
      <div class="panel" style="margin-bottom:1.5rem;">
        <div class="panel-header"><h2>Customer Details</h2></div>
        <div class="panel-body">
          <p><strong>Name:</strong> <?php echo e($order->customer_name); ?></p>
          <p><strong>Phone:</strong> <?php echo e($order->customer_phone); ?></p>
          <p><strong>Email:</strong> <?php echo e($order->customer_email ?: '—'); ?></p>
          <p style="margin-top:0.75rem;"><strong>Delivery:</strong> <?php echo e($order->delivery_method === 'pickup' ? '🏪 Click & Collect' : '🚚 Island-Wide Delivery'); ?></p>
          <?php if($order->delivery_address): ?>
            <p><strong>Address:</strong> <?php echo e($order->delivery_address); ?></p>
          <?php endif; ?>
          <p><strong>Payment:</strong> <?php echo e(strtoupper($order->payment_method)); ?></p>
        </div>
      </div>

      <div class="panel">
        <div class="panel-header"><h2>Update Status</h2></div>
        <div class="panel-body">
          <form method="POST" action="<?php echo e(route('admin.orders.status', $order)); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group">
              <select name="status">
                <option value="pending" <?php echo e($order->status === 'pending' ? 'selected' : ''); ?>>Pending</option>
                <option value="confirmed" <?php echo e($order->status === 'confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                <option value="shipped" <?php echo e($order->status === 'shipped' ? 'selected' : ''); ?>>Shipped</option>
                <option value="completed" <?php echo e($order->status === 'completed' ? 'selected' : ''); ?>>Completed</option>
                <option value="cancelled" <?php echo e($order->status === 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;">Update Status</button>
          </form>
        </div>
      </div>
    </div>

  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pamod\Downloads\forttune-laravel\forttune-laravel\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>