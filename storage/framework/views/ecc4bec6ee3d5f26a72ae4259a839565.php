<?php $__env->startSection('title', 'Categories'); ?>
<?php $__env->startSection('page-title', 'Manage Categories'); ?>

<?php $__env->startSection('content'); ?>

  <div style="display:grid; grid-template-columns: 1fr 1.6fr; gap:1.5rem; align-items:start;">

    <!-- ADD CATEGORY -->
    <div class="panel">
      <div class="panel-header"><h2>Add Category</h2></div>
      <div class="panel-body">
        <form method="POST" action="<?php echo e(route('admin.categories.store')); ?>">
          <?php echo csrf_field(); ?>
          <div class="form-group">
            <label>Category Name *</label>
            <input type="text" name="name" placeholder="e.g. Laptops & Notebooks" required />
          </div>
          <div class="form-group">
            <label>Icon (emoji)</label>
            <input type="text" name="icon" placeholder="💻" maxlength="10" />
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%;">Add Category</button>
        </form>
      </div>
    </div>

    <!-- LIST -->
    <div class="panel">
      <div class="panel-header"><h2>All Categories (<?php echo e($categories->count()); ?>)</h2></div>
      <div class="table-wrap">
        <table>
          <thead><tr><th>Icon</th><th>Name</th><th>Products</th><th>Actions</th></tr></thead>
          <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr>
                <td style="font-size:1.3rem;"><?php echo e($cat->icon ?: '📦'); ?></td>
                <td><strong><?php echo e($cat->name); ?></strong></td>
                <td><?php echo e($cat->products_count); ?></td>
                <td>
                  <form method="POST" action="<?php echo e(route('admin.categories.destroy', $cat)); ?>" onsubmit="return confirm('Delete this category? Products in it will become uncategorized.');" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr><td colspan="4" style="text-align:center; color:var(--text-light);">No categories yet.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pamod\Downloads\forttune-laravel\forttune-laravel\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>