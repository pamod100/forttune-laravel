<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Forttune Channels Pvt Ltd — Sri Lanka\'s trusted IT & computer hardware distributor.'); ?>" />
  <title><?php echo $__env->yieldContent('title', 'Forttune | Technology Provider'); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>" />
  <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

  

  <!-- HEADER -->
  <header class="header" id="header">
    <div class="container header-inner">
      <a href="<?php echo e(route('home')); ?>" class="logo">
  <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Forttune Channels Pvt Ltd" class="logo-img">
</a>

      <nav class="nav" id="nav">
        <a href="<?php echo e(route('home')); ?>" class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">Home</a>
        <a href="<?php echo e(route('products.index')); ?>" class="nav-link <?php echo e(request()->routeIs('products.*') ? 'active' : ''); ?>">Products</a>
        <a href="<?php echo e(route('home')); ?>#brands" class="nav-link">Brands</a>
       <a href="<?php echo e(route('services')); ?>" class="nav-link <?php echo e(request()->routeIs('services') ? 'active' : ''); ?>">Services</a>
        <a href="<?php echo e(route('home')); ?>#contact" class="nav-link">Contact</a>
      </nav>

      <div class="header-actions">
        <button class="search-btn" id="searchToggle" aria-label="Search">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        </button>

        <!-- ACCOUNT -->
        <?php if(auth()->guard()->check()): ?>
          <div class="account-menu">
            <button class="account-btn" id="accountToggle">
              <?php if(auth()->user()->avatar): ?>
                <img src="<?php echo e(auth()->user()->avatar); ?>" class="account-avatar-img" alt="" />
              <?php else: ?>
                <span class="account-avatar"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?></span>
              <?php endif; ?>
            </button>
            <div class="account-dropdown" id="accountDropdown">
              <div class="account-dropdown-name"><?php echo e(auth()->user()->name); ?></div>
              <?php if(auth()->user()->isAdmin()): ?>
                <a href="<?php echo e(route('admin.dashboard')); ?>">⚙️ Admin Panel</a>
              <?php endif; ?>
              <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit">🚪 Log Out</button>
              </form>
            </div>
          </div>
        <?php else: ?>
          <a href="<?php echo e(route('login')); ?>" class="account-btn" title="Log In">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          </a>
        <?php endif; ?>

        <a href="<?php echo e(route('cart')); ?>" class="cart-btn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
          <span class="cart-count" id="cartCount">0</span>
        </a>
        <button class="hamburger" id="hamburger" aria-label="Menu"><span></span><span></span><span></span></button>
      </div>
    </div>

    <div class="search-bar" id="searchBar">
      <div class="container">
        <input type="text" placeholder="Search laptops, printers, networking gear…" class="search-input" id="searchInput" />
        <button class="search-submit">Search</button>
      </div>
    </div>
  </header>

  <?php echo $__env->yieldContent('content'); ?>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container footer-inner">
      <div class="footer-brand">
        <span class="logo-fort">FORT</span><span class="logo-tune">TUNE</span>
        <p>Sri Lanka's premier IT &amp; computer hardware distributor. Connecting multi-brands with hundreds of channel partners.</p>
        <div class="social-links">
          <a href="https://www.facebook.com/profile.php?id=100063397380014" target="_blank">Facebook</a>
          <a href="https://www.instagram.com/forttunec/" target="_blank">Instagram</a>
          <a href="https://www.linkedin.com/company/forttune-channels-pvt-ltd" target="_blank">LinkedIn</a>
        </div>
      </div>
      <div class="footer-col">
        <h4>Products</h4>
        <?php $__currentLoopData = \App\Models\Category::take(6)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a href="<?php echo e(route('products.index', ['cat' => $cat->slug])); ?>"><?php echo e($cat->name); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <div class="footer-col">
        <h4>Company</h4>
        <a href="<?php echo e(route('home')); ?>#contact">About Us</a>
        <a href="#">Careers</a>
        <a href="#">Dealer Network</a>
        <a href="#">Downloads</a>
      </div>
      <div class="footer-col">
        <h4>Contact</h4>
        <p>No. 312, Galle Road,<br/>Mount Lavinia, Sri Lanka</p>
        <p>General: +94 112 638 538<br/>Hotline: +94 725 516 516</p>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <span>© <?php echo e(date('Y')); ?> Forttune Channels (Pvt) Ltd. All rights reserved.</span>
        <span><a href="#">Privacy Policy</a> &nbsp;|&nbsp; <a href="#">Terms &amp; Conditions</a></span>
      </div>
    </div>
  </footer>

  <!-- WHATSAPP FLOATING BUTTON -->
  <a href="https://wa.me/<?php echo e(config('app.whatsapp_number', '94725516516')); ?>?text=Hi%20Forttune%2C%20I%27d%20like%20to%20ask%20about%20a%20product."
     class="whatsapp-float" target="_blank" rel="noopener" aria-label="Chat with us on WhatsApp">
    <svg width="28" height="28" viewBox="0 0 32 32" fill="currentColor"><path d="M16.001 3C9.106 3 3.5 8.605 3.5 15.5c0 2.394.668 4.63 1.829 6.537L3 29l7.16-2.276A12.43 12.43 0 0 0 16 28c6.895 0 12.5-5.605 12.5-12.5S22.896 3 16.001 3zm0 22.7a10.16 10.16 0 0 1-5.18-1.42l-.371-.22-3.85 1.224 1.246-3.75-.243-.385a10.19 10.19 0 0 1-1.6-5.45c0-5.633 4.583-10.2 10.198-10.2 5.633 0 10.2 4.583 10.2 10.2s-4.567 10.001-10.4 10.001zm5.582-7.64c-.305-.153-1.81-.892-2.09-.995-.28-.102-.484-.153-.687.153-.204.306-.79.995-.969 1.2-.178.205-.357.23-.662.077-.305-.153-1.29-.475-2.456-1.514-.908-.81-1.52-1.81-1.699-2.116-.178-.306-.019-.471.134-.624.137-.137.305-.357.458-.535.153-.179.204-.306.306-.51.102-.205.05-.384-.026-.537-.077-.153-.687-1.657-.942-2.27-.248-.595-.5-.514-.687-.524-.178-.009-.382-.011-.585-.011s-.535.077-.815.384c-.28.306-1.068 1.043-1.068 2.546s1.093 2.953 1.246 3.158c.153.205 2.151 3.284 5.21 4.605.728.314 1.296.502 1.739.642.73.232 1.394.2 1.92.121.586-.087 1.81-.74 2.065-1.455.255-.715.255-1.327.178-1.455-.076-.128-.28-.205-.585-.358z"/></svg>
  </a>

  <div class="toast" id="toast"></div>

  <script src="<?php echo e(asset('js/main.js')); ?>"></script>
  <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\pamod\Downloads\forttune-laravel\forttune-laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>