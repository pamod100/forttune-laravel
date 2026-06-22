<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title><?php echo $__env->yieldContent('title', 'Admin Panel'); ?> | Forttune</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>" />
  <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

  <div class="admin-layout">

   <!-- SIDEBAR -->
<aside class="admin-sidebar">
  <div class="admin-logo">
    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Forttune" class="admin-logo-img">
    <span class="admin-tag">Admin Panel</span>
  </div>

      <nav class="admin-nav">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
          <span class="nav-icon">📊</span> Dashboard
        </a>
        <a href="<?php echo e(route('admin.products.index')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.products.*') ? 'active' : ''); ?>">
          <span class="nav-icon">📦</span> Products
        </a>
        <a href="<?php echo e(route('admin.categories.index')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.categories.*') ? 'active' : ''); ?>">
          <span class="nav-icon">🗂️</span> Categories
        </a>
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.orders.*') ? 'active' : ''); ?>">
          <span class="nav-icon">🧾</span> Orders
        </a>
        <a href="<?php echo e(route('home')); ?>" class="admin-nav-link" target="_blank">
          <span class="nav-icon">🌐</span> View Website
        </a>
        <a href="<?php echo e(route('admin.testimonials.index')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.testimonials.*') ? 'active' : ''); ?>">
  <span class="nav-icon">⭐</span> Testimonials
</a>
      </nav>

      <div class="admin-user">
        <div class="admin-user-avatar"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?></div>
        <div>
          <div class="admin-user-name"><?php echo e(auth()->user()->name); ?></div>
          <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="admin-logout-btn">Log Out</button>
          </form>
        </div>
      </div>
    </aside>

    <!-- MAIN -->
    <main class="admin-main">
      <header class="admin-topbar">
        <h1><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h1>
      </header>

      <div class="admin-content">
        <?php if(session('success')): ?>
          <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
          <div class="alert alert-error">
            <ul>
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
      </div>
    </main>

  </div>

  <script src="<?php echo e(asset('js/admin.js')); ?>"></script>
  <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\pamod\Downloads\forttune-laravel\forttune-laravel\resources\views/layouts/admin.blade.php ENDPATH**/ ?>