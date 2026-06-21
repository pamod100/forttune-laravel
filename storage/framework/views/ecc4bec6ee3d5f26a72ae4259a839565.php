<?php $__env->startSection('title', 'Categories'); ?>
<?php $__env->startSection('page-title', 'Manage Categories'); ?>
<?php $__env->startSection('content'); ?>

<div style="display:grid; grid-template-columns: 1fr 1.6fr; gap:1.5rem; align-items:start;">

  <!-- ADD CATEGORY -->
  <div class="panel">
    <div class="panel-header"><h2>Add Category</h2></div>
    <div class="panel-body">
      <form method="POST" action="<?php echo e(route('admin.categories.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group">
          <label>Category Name *</label>
          <input type="text" name="name" placeholder="e.g. Laptops & Notebooks" required />
        </div>
        <div class="form-group">
          <label>Category Image *</label>
          <div class="cat-upload-box" id="uploadBox">
            <input type="file" name="image" id="catImage" accept="image/*" style="display:none;" onchange="previewCatImage(this)">
            <div id="uploadPlaceholder" onclick="document.getElementById('catImage').click()" style="cursor:pointer;">
              <div style="font-size:2rem;">📁</div>
              <div style="font-size:0.85rem; color:var(--grey-400); margin-top:0.3rem;">Click to upload image</div>
              <div style="font-size:0.75rem; color:var(--grey-300);">PNG, JPG recommended</div>
            </div>
            <img id="catPreview" src="" style="display:none; width:100%; height:120px; object-fit:cover; border-radius:8px;" onclick="document.getElementById('catImage').click()">
          </div>
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
        <thead><tr><th>Image</th><th>Name</th><th>Products</th><th>Actions</th></tr></thead>
        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td>
                <?php if($cat->image): ?>
                  <img src="<?php echo e(asset('storage/'.$cat->image)); ?>" style="width:48px; height:48px; object-fit:cover; border-radius:8px; border:1px solid var(--grey-100);">
                <?php else: ?>
                  <div style="width:48px; height:48px; background:var(--grey-50); border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:1.3rem;"><?php echo e($cat->icon ?: '📦'); ?></div>
                <?php endif; ?>
              </td>
              <td><strong><?php echo e($cat->name); ?></strong></td>
              <td><?php echo e($cat->products_count); ?></td>
              <td style="display:flex; gap:0.5rem; align-items:center;">
  <button onclick="openEdit(<?php echo e($cat->id); ?>, '<?php echo e($cat->name); ?>')" class="btn btn-sm" style="background:var(--blue); color:#fff;">Edit</button>
  <form method="POST" action="<?php echo e(route('admin.categories.destroy', $cat)); ?>" onsubmit="return confirm('Delete this category?');" style="display:inline;">
    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
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

<script>
function previewCatImage(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      document.getElementById('catPreview').src = e.target.result;
      document.getElementById('catPreview').style.display = 'block';
      document.getElementById('uploadPlaceholder').style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>



<!-- EDIT MODAL -->
<div id="editModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:999; align-items:center; justify-content:center;">
  <div style="background:#fff; border-radius:16px; padding:2rem; width:420px; max-width:90%;">
    <h3 style="margin-bottom:1.5rem;">Edit Category</h3>
    <form id="editForm" method="POST" enctype="multipart/form-data">
      <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
      <div class="form-group">
        <label>Category Name *</label>
        <input type="text" name="name" id="editName" required />
      </div>
      <div class="form-group">
        <label>Category Image</label>
        <div class="cat-upload-box">
          <input type="file" name="image" id="editImage" accept="image/*" style="display:none;" onchange="previewEditImage(this)">
          <div id="editPlaceholder" onclick="document.getElementById('editImage').click()" style="cursor:pointer;">
            <div style="font-size:2rem;">📁</div>
            <div style="font-size:0.85rem; color:var(--grey-400);">Click to upload new image</div>
          </div>
          <img id="editPreview" src="" style="display:none; width:100%; height:120px; object-fit:cover; border-radius:8px;" onclick="document.getElementById('editImage').click()">
        </div>
      </div>
      <div style="display:flex; gap:1rem; margin-top:1rem;">
        <button type="submit" class="btn btn-primary" style="flex:1;">Save Changes</button>
        <button type="button" onclick="closeEdit()" class="btn" style="flex:1; background:var(--grey-100);">Cancel</button>
      </div>
    </form>
  </div>
</div>

<script>
function openEdit(id, name) {
  document.getElementById('editName').value = name;
  document.getElementById('editForm').action = '/admin/categories/' + id;
  document.getElementById('editModal').style.display = 'flex';
}
function closeEdit() {
  document.getElementById('editModal').style.display = 'none';
}
function previewEditImage(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      document.getElementById('editPreview').src = e.target.result;
      document.getElementById('editPreview').style.display = 'block';
      document.getElementById('editPlaceholder').style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
  }
}
function previewCatImage(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      document.getElementById('catPreview').src = e.target.result;
      document.getElementById('catPreview').style.display = 'block';
      document.getElementById('uploadPlaceholder').style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pamod\Downloads\forttune-laravel\forttune-laravel\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>