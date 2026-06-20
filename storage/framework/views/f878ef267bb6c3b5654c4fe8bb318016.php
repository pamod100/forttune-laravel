<?php $__env->startSection('title', 'Edit Product'); ?>
<?php $__env->startSection('page-title', 'Edit Product'); ?>

<?php $__env->startSection('content'); ?>

  <div class="panel">
    <div class="panel-header">
      <h2>Editing: <?php echo e($product->name); ?></h2>
      <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-outline btn-sm">← Back to Products</a>
    </div>

    <div class="panel-body">
      <form method="POST" action="<?php echo e(route('admin.products.update', $product)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- IMAGE UPLOAD -->
        <div class="form-group full">
          <label>Product Photo</label>
          <span class="hint">Upload a new photo to replace the current one, or leave blank to keep it.</span>
          <label class="image-upload-box" for="imageInput">
            <span id="uploadText">📷 Click to change photo</span>
            <input type="file" name="image" id="imageInput" accept="image/*" onchange="previewImage(event)" />
            <img id="imagePreview" src="<?php echo e($product->image_url); ?>" style="display:<?php echo e($product->image ? 'block' : 'none'); ?>;" />
          </label>
        </div>

        <div class="form-grid">

          <div class="form-group">
            <label>Product Name *</label>
            <input type="text" name="name" value="<?php echo e(old('name', $product->name)); ?>" required />
          </div>

          <div class="form-group">
            <label>Brand</label>
            <input type="text" name="brand" value="<?php echo e(old('brand', $product->brand)); ?>" />
          </div>

          <div class="form-group">
            <label>Category</label>
            <select name="category_id">
              <option value="">Select category</option>
              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($cat->id); ?>" <?php echo e(old('category_id', $product->category_id) == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <div class="form-group">
            <label>Price (LKR) *</label>
            <input type="number" name="price" value="<?php echo e(old('price', $product->price)); ?>" step="0.01" min="0" required />
          </div>

          <div class="form-group">
            <label>Processor</label>
            <input type="text" name="processor" value="<?php echo e(old('processor', $product->processor)); ?>" />
          </div>

          <div class="form-group">
            <label>RAM</label>
            <input type="text" name="ram" value="<?php echo e(old('ram', $product->ram)); ?>" />
          </div>

          <div class="form-group">
            <label>Storage</label>
            <input type="text" name="storage" value="<?php echo e(old('storage', $product->storage)); ?>" />
          </div>

          <div class="form-group">
            <label>Display</label>
            <input type="text" name="display" value="<?php echo e(old('display', $product->display)); ?>" />
          </div>

          <div class="form-group">
            <label>Warranty</label>
            <input type="text" name="warranty" value="<?php echo e(old('warranty', $product->warranty)); ?>" />
          </div>

          <div class="form-group">
            <label>Stock Status *</label>
            <select name="stock_status" required>
              <option value="in_stock" <?php echo e($product->stock_status === 'in_stock' ? 'selected' : ''); ?>>In Stock</option>
              <option value="out_of_stock" <?php echo e($product->stock_status === 'out_of_stock' ? 'selected' : ''); ?>>Out of Stock</option>
              <option value="pre_order" <?php echo e($product->stock_status === 'pre_order' ? 'selected' : ''); ?>>Pre-Order</option>
            </select>
          </div>

          <div class="form-group">
            <label>Stock Quantity *</label>
            <input type="number" name="stock_qty" value="<?php echo e(old('stock_qty', $product->stock_qty)); ?>" min="0" required />
          </div>

          <div class="form-group full">
            <label>Description</label>
            <textarea name="description" rows="4"><?php echo e(old('description', $product->description)); ?></textarea>
          </div>

          <div class="form-group">
            <label class="checkbox-row"><input type="checkbox" name="is_featured" value="1" <?php echo e(old('is_featured', $product->is_featured) ? 'checked' : ''); ?> /> Show on homepage (Featured)</label>
          </div>

          <div class="form-group">
            <label class="checkbox-row"><input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $product->is_active) ? 'checked' : ''); ?> /> Active (visible on website)</label>
          </div>

        </div>

        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Update Product</button>
          <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-outline">Cancel</a>
        </div>
      </form>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
  function previewImage(event) {
    const file = event.target.files[0];
    if (!file) return;
    const preview = document.getElementById('imagePreview');
    const text = document.getElementById('uploadText');
    preview.src = URL.createObjectURL(file);
    preview.style.display = 'block';
    text.textContent = file.name;
  }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pamod\Downloads\forttune-laravel\forttune-laravel\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>