<?php $__env->startSection('title', 'Orders'); ?>
<?php $__env->startSection('page-title', 'Manage Orders'); ?>

<?php $__env->startSection('content'); ?>

  <div class="panel">
    <div class="panel-header">
      <h2>All Orders (<?php echo e($orders->total()); ?>)</h2>
      <form method="GET" class="filter-bar">
        <select name="status" onchange="this.form.submit()">
          <option value="">All Statuses</option>
          <option value="pending" <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>Pending</option>
          <option value="confirmed" <?php echo e(request('status') === 'confirmed' ? 'selected' : ''); ?>>Confirmed</option>
          <option value="shipped" <?php echo e(request('status') === 'shipped' ? 'selected' : ''); ?>>Shipped</option>
          <option value="completed" <?php echo e(request('status') === 'completed' ? 'selected' : ''); ?>>Completed</option>
          <option value="cancelled" <?php echo e(request('status') === 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
        </select>
      </form>
    </div>

    <div class="table-wrap">
      <table>
        <thead>
          <tr><th>Order #</th><th>Customer</th><th>Phone</th><th>Delivery</th><th>Total</th><th>Status</th><th>Date</th><th></th></tr>
        </thead>
        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td><strong><?php echo e($order->order_number); ?></strong></td>
              <td><?php echo e($order->customer_name); ?></td>
              <td><?php echo e($order->customer_phone); ?></td>
              <td><?php echo e($order->delivery_method === 'pickup' ? '🏪 Pickup' : '🚚 Delivery'); ?></td>
              <td><strong><?php echo e($order->formatted_total); ?></strong></td>
              <td>
                <span class="badge <?php echo e($order->status === 'pending' ? 'badge-orange' : ($order->status === 'cancelled' ? 'badge-red' : 'badge-green')); ?>">
                  <?php echo e(ucfirst($order->status)); ?>

                </span>
              </td>
              <td><?php echo e($order->created_at->format('d M, H:i')); ?></td>
              <td><a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="btn btn-outline btn-sm">View</a></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="8" style="text-align:center; padding:2rem; color:var(--text-light);">No orders yet.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="pagination-wrap"><?php echo e($orders->links()); ?></div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pamod\Downloads\forttune-laravel\forttune-laravel\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>