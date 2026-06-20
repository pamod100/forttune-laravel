<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard Overview'); ?>

<?php $__env->startSection('content'); ?>

  <div class="stats-grid">
    <div class="stat-card">
      <div class="stat-label">Total Products</div>
      <div class="stat-value"><?php echo e($stats['total_products']); ?></div>
    </div>
    <div class="stat-card accent-green">
      <div class="stat-label">Active Products</div>
      <div class="stat-value"><?php echo e($stats['active_products']); ?></div>
    </div>
    <div class="stat-card accent-red">
      <div class="stat-label">Out of Stock</div>
      <div class="stat-value"><?php echo e($stats['out_of_stock']); ?></div>
    </div>
    <div class="stat-card accent-blue">
      <div class="stat-label">Total Orders</div>
      <div class="stat-value"><?php echo e($stats['total_orders']); ?></div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Pending Orders</div>
      <div class="stat-value"><?php echo e($stats['pending_orders']); ?></div>
    </div>
    <div class="stat-card accent-green">
      <div class="stat-label">Total Revenue</div>
      <div class="stat-value">Rs <?php echo e(number_format($stats['revenue'])); ?></div>
    </div>
  </div>

  <div style="display:grid; grid-template-columns: 1.4fr 1fr; gap:1.5rem;">

    <!-- RECENT ORDERS -->
    <div class="panel">
      <div class="panel-header">
        <h2>Recent Orders</h2>
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-outline btn-sm">View All</a>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr><th>Order #</th><th>Customer</th><th>Total</th><th>Status</th></tr>
          </thead>
          <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr onclick="window.location='<?php echo e(route('admin.orders.show', $order)); ?>'" style="cursor:pointer;">
                <td><strong><?php echo e($order->order_number); ?></strong></td>
                <td><?php echo e($order->customer_name); ?></td>
                <td><?php echo e($order->formatted_total); ?></td>
                <td>
                  <span class="badge <?php echo e($order->status === 'pending' ? 'badge-orange' : ($order->status === 'cancelled' ? 'badge-red' : 'badge-green')); ?>">
                    <?php echo e(ucfirst($order->status)); ?>

                  </span>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr><td colspan="4" style="text-align:center; color:var(--text-light);">No orders yet.</td></tr>
            <?php endif; ?>
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
            <?php $__empty_1 = true; $__currentLoopData = $lowStock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr>
                <td><?php echo e(Str::limit($product->name, 28)); ?></td>
                <td><span class="badge badge-red"><?php echo e($product->stock_qty); ?> left</span></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr><td colspan="2" style="text-align:center; color:var(--text-light);">All stocked up 👍</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <div style="margin-top:1.5rem;">
    <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">+ Add New Product</a>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pamod\Downloads\forttune-laravel\forttune-laravel\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>