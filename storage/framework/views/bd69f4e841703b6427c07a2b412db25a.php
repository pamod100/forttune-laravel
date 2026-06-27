<?php $__env->startSection('title', 'Products'); ?>
<?php $__env->startSection('page-title', 'Manage Products'); ?>

<?php $__env->startSection('content'); ?>

  <div class="panel">
    <div class="panel-header">
      <h2>All Products (<?php echo e($products->total()); ?>)</h2>
      <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">+ Add New Product</a>
    </div>

    <div class="panel-body" style="padding-bottom:0;">
      <form method="GET" class="filter-bar" style="margin-bottom:1.25rem;">
        <input type="text" name="search" placeholder="Search by product name…" value="<?php echo e(request('search')); ?>" />
        <select name="category" onchange="this.form.submit()">
          <option value="">All Categories</option>
          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($cat->id); ?>" <?php echo e(request('category') == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
          <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td><img src="<?php echo e($product->image_url); ?>" class="table-thumb" alt="<?php echo e($product->name); ?>" /></td>
              <td>
                <strong><?php echo e($product->name); ?></strong><br/>
                <span style="color:var(--text-light); font-size:0.78rem;"><?php echo e($product->brand); ?></span>
              </td>
              <td><?php echo e($product->category->name ?? '—'); ?></td>
              <td><strong><?php echo e($product->formatted_price); ?></strong></td>
              <td><?php echo e($product->stock_qty); ?></td>
              <td>
                <form method="POST" action="<?php echo e(route('admin.products.toggle-stock', $product)); ?>">
                  <?php echo csrf_field(); ?>
                  <button type="submit" class="badge <?php echo e($product->stock_status === 'in_stock' ? 'badge-green' : 'badge-red'); ?>" style="border:none; cursor:pointer;">
                    <?php echo e($product->stock_label); ?>

                  </button>
                </form>
              </td>
              <td>
                <div style="display:flex; gap:0.5rem;">
                  <a href="<?php echo e(route('admin.products.edit', $product)); ?>" class="btn btn-outline btn-sm">Edit</a>
                  <form method="POST" action="<?php echo e(route('admin.products.destroy', $product)); ?>" onsubmit="return confirm('Delete this product? This cannot be undone.');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="7" style="text-align:center; padding:2rem; color:var(--text-light);">No products yet. Click "Add New Product" to get started.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="pagination-wrap">
      <?php echo e($products->links()); ?>

    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pamod\Downloads\forttune-laravel\forttune-laravel\resources\views/admin/products/index.blade.php ENDPATH**/ ?>