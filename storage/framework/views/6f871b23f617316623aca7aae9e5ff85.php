
<?php $__env->startSection('title', 'Testimonials'); ?>
<?php $__env->startSection('page-title', 'Manage Testimonials'); ?>
<?php $__env->startSection('content'); ?>

<div class="panel">
  <div class="panel-header"><h2>All Feedback (<?php echo e($testimonials->count()); ?>)</h2></div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Role</th>
          <th>Message</th>
          <th>Rating</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><strong><?php echo e($t->name); ?></strong></td>
          <td><?php echo e($t->role ?? '-'); ?></td>
          <td style="max-width:300px;"><?php echo e(Str::limit($t->message, 80)); ?></td>
          <td><?php echo e(str_repeat('★', $t->rating)); ?></td>
          <td>
            <?php if($t->approved): ?>
              <span style="color:green; font-weight:600;">✓ Approved</span>
            <?php else: ?>
              <span style="color:orange; font-weight:600;">⏳ Pending</span>
            <?php endif; ?>
          </td>
          <td style="display:flex; gap:0.5rem;">
            <?php if(!$t->approved): ?>
            <form method="POST" action="<?php echo e(route('admin.testimonials.approve', $t)); ?>">
              <?php echo csrf_field(); ?>
              <button type="submit" class="btn btn-sm" style="background:green; color:#fff;">Approve</button>
            </form>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('admin.testimonials.destroy', $t)); ?>" onsubmit="return confirm('Delete?')">
              <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="6" style="text-align:center;">No feedback yet.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pamod\Downloads\forttune-laravel\forttune-laravel\resources\views/admin/testimonials/index.blade.php ENDPATH**/ ?>