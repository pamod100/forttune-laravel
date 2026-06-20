<?php $__env->startSection('title', $product->name . ' | Forttune Channels'); ?>

<?php $__env->startSection('content'); ?>

  <div class="page-header">
    <div class="container">
      <h1><?php echo e($product->name); ?></h1>
      <p><?php echo e($product->category->name ?? 'Products'); ?></p>
    </div>
  </div>

  <section class="section">
    <div class="container" style="display:grid; grid-template-columns: 1fr 1fr; gap:3rem; align-items:start;">

      <div>
        <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>" style="width:100%; border-radius:14px; border:1px solid var(--grey-100);" />
      </div>

      <div>
        <div class="product-brand" style="font-size:0.85rem;"><?php echo e($product->brand); ?></div>
        <h2 style="font-family:var(--font-display); font-size:1.8rem; color:var(--navy); margin:0.5rem 0;"><?php echo e($product->name); ?></h2>
        <div style="font-size:1.8rem; font-weight:700; color:var(--blue); font-family:var(--font-display); margin-bottom:1rem;"><?php echo e($product->formatted_price); ?></div>

        <span class="badge <?php echo e($product->stock_status === 'in_stock' ? 'badge-green' : 'badge-red'); ?>" style="display:inline-block; padding:0.3rem 0.8rem; border-radius:99px; font-size:0.8rem; font-weight:600; margin-bottom:1.5rem;
          background:<?php echo e($product->stock_status === 'in_stock' ? '#ECFDF5' : '#FEF2F2'); ?>; color:<?php echo e($product->stock_status === 'in_stock' ? '#047857' : '#B91C1C'); ?>;">
          <?php echo e($product->stock_label); ?>

        </span>

        <?php if($product->description): ?>
          <p style="color:var(--text-light); line-height:1.7; margin-bottom:1.5rem;"><?php echo e($product->description); ?></p>
        <?php endif; ?>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:0.75rem; margin-bottom:2rem;">
          <?php if($product->processor): ?><div><strong>Processor:</strong><br/><span style="color:var(--text-light);"><?php echo e($product->processor); ?></span></div><?php endif; ?>
          <?php if($product->ram): ?><div><strong>RAM:</strong><br/><span style="color:var(--text-light);"><?php echo e($product->ram); ?></span></div><?php endif; ?>
          <?php if($product->storage): ?><div><strong>Storage:</strong><br/><span style="color:var(--text-light);"><?php echo e($product->storage); ?></span></div><?php endif; ?>
          <?php if($product->display): ?><div><strong>Display:</strong><br/><span style="color:var(--text-light);"><?php echo e($product->display); ?></span></div><?php endif; ?>
          <?php if($product->warranty): ?><div><strong>Warranty:</strong><br/><span style="color:var(--text-light);"><?php echo e($product->warranty); ?></span></div><?php endif; ?>
        </div>

        <button class="btn btn-primary" style="width:100%;" onclick="addToCart('<?php echo e(addslashes($product->name)); ?>', <?php echo e($product->price); ?>, <?php echo e($product->id); ?>)" <?php echo e($product->stock_status === 'out_of_stock' ? 'disabled' : ''); ?>>
          <?php echo e($product->stock_status === 'out_of_stock' ? 'Out of Stock' : 'Add to Cart'); ?>

        </button>
      </div>
    </div>

    <?php if($related->count()): ?>
      <div class="container" style="margin-top:3rem;">
        <h3 style="font-family:var(--font-display); margin-bottom:1.25rem;">You Might Also Like</h3>
        <div class="product-grid">
          <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="product-card">
              <a href="<?php echo e(route('products.show', $r)); ?>" class="product-img"><img src="<?php echo e($r->image_url); ?>" style="width:100%;height:100%;object-fit:cover;" /></a>
              <div class="product-body">
                <div class="product-brand"><?php echo e($r->brand); ?></div>
                <h3 class="product-name"><a href="<?php echo e(route('products.show', $r)); ?>"><?php echo e($r->name); ?></a></h3>
                <div class="product-footer">
                  <div class="product-price"><?php echo e($r->formatted_price); ?></div>
                  <button class="btn-cart" onclick="addToCart('<?php echo e(addslashes($r->name)); ?>', <?php echo e($r->price); ?>, <?php echo e($r->id); ?>)">Add to Cart</button>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    <?php endif; ?>
  </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pamod\Downloads\forttune-laravel\forttune-laravel\resources\views/frontend/product-detail.blade.php ENDPATH**/ ?>