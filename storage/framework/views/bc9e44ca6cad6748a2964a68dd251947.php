<?php $__env->startSection('title', 'Products | Forttune Channels'); ?>

<?php $__env->startSection('content'); ?>

  <div class="page-header">
    <div class="container">
      <h1>All Products</h1>
      <p>Browse our complete range of IT hardware and technology solutions</p>
    </div>
  </div>

  <section class="products-page section">
    <div class="container products-layout">

      <aside class="sidebar">
        <div class="sidebar-section">
          <h3>Categories</h3>
          <ul class="sidebar-cats">
            <li><a href="<?php echo e(route('products.index')); ?>" class="<?php echo e(!request('cat') ? 'active' : ''); ?>">All Products</a></li>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><a href="<?php echo e(route('products.index', ['cat' => $cat->slug])); ?>" class="<?php echo e(request('cat') === $cat->slug ? 'active' : ''); ?>"><?php echo e($cat->name); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>

        <div class="sidebar-section">
          <h3>Price Range (LKR)</h3>
          <form method="GET" id="priceForm">
            <?php if(request('cat')): ?> <input type="hidden" name="cat" value="<?php echo e(request('cat')); ?>"> <?php endif; ?>
            <input type="range" min="0" max="600000" step="5000" value="<?php echo e(request('max_price', 600000)); ?>" id="priceRange" class="range-slider" name="max_price" onchange="document.getElementById('priceForm').submit()" />
            <div class="price-labels">
              <span>Rs 0</span>
              <span id="priceVal"><?php echo e(request('max_price', 600000) >= 600000 ? 'Rs 600,000+' : 'Rs ' . number_format(request('max_price'))); ?></span>
            </div>
          </form>
        </div>
      </aside>

      <div class="products-main">
        <div class="products-toolbar">
          <span class="result-count">Showing <?php echo e($products->total()); ?> product<?php echo e($products->total() !== 1 ? 's' : ''); ?></span>
          <form method="GET" id="sortForm">
            <?php if(request('cat')): ?> <input type="hidden" name="cat" value="<?php echo e(request('cat')); ?>"> <?php endif; ?>
            <?php if(request('max_price')): ?> <input type="hidden" name="max_price" value="<?php echo e(request('max_price')); ?>"> <?php endif; ?>
            <select class="sort-select" name="sort" onchange="document.getElementById('sortForm').submit()">
              <option value="default">Sort: Default</option>
              <option value="price-asc" <?php echo e(request('sort') === 'price-asc' ? 'selected' : ''); ?>>Price: Low to High</option>
              <option value="price-desc" <?php echo e(request('sort') === 'price-desc' ? 'selected' : ''); ?>>Price: High to Low</option>
              <option value="name-asc" <?php echo e(request('sort') === 'name-asc' ? 'selected' : ''); ?>>Name: A–Z</option>
            </select>
          </form>
        </div>

        <div class="product-grid products-full">
          <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="product-card">
              <?php if($product->stock_status === 'out_of_stock'): ?>
                <div class="product-badge" style="background:#DC2626;">Out of Stock</div>
              <?php elseif($product->is_featured): ?>
                <div class="product-badge">Featured</div>
              <?php endif; ?>
              <a href="<?php echo e(route('products.show', $product)); ?>" class="product-img">
                <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>" style="width:100%; height:100%; object-fit:cover;" />
              </a>
              <div class="product-body">
                <div class="product-brand"><?php echo e($product->brand); ?></div>
                <h3 class="product-name"><a href="<?php echo e(route('products.show', $product)); ?>"><?php echo e($product->name); ?></a></h3>
                <div class="product-specs">
                  <?php if($product->processor): ?><span><?php echo e($product->processor); ?></span><?php endif; ?>
                  <?php if($product->display): ?><span><?php echo e($product->display); ?></span><?php endif; ?>
                </div>
                <div class="product-footer">
                  <div class="product-price"><?php echo e($product->formatted_price); ?></div>
                  <button class="btn-cart" onclick="addToCart('<?php echo e(addslashes($product->name)); ?>', <?php echo e($product->price); ?>, <?php echo e($product->id); ?>)" <?php echo e($product->stock_status === 'out_of_stock' ? 'disabled' : ''); ?>>Add to Cart</button>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="grid-column:1/-1; text-align:center; color:var(--text-light); padding:3rem 0;">No products found. Try a different category or price range.</p>
          <?php endif; ?>
        </div>

        <div style="margin-top:2rem;">
          <?php echo e($products->links()); ?>

        </div>
      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pamod\Downloads\forttune-laravel\forttune-laravel\resources\views/frontend/products.blade.php ENDPATH**/ ?>