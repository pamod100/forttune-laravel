<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $__env->yieldContent('title', 'Login'); ?> | Forttune Channels</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>" />
  <style>
    .auth-page { min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #0A1628 0%, #0D2347 100%); padding: 2rem; }
    .auth-card { background: #fff; border-radius: 16px; padding: 2.5rem; width: 100%; max-width: 420px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
    .auth-logo { text-align: center; margin-bottom: 1.75rem; }
    .auth-title { font-family: var(--font-display); font-size: 1.4rem; font-weight: 700; color: var(--navy); text-align: center; margin-bottom: 0.35rem; }
    .auth-subtitle { text-align: center; color: var(--text-light); font-size: 0.88rem; margin-bottom: 1.75rem; }
    .auth-form .form-group { margin-bottom: 1.1rem; }
    .auth-form label { display:block; font-size: 0.82rem; font-weight: 600; margin-bottom: 0.35rem; }
    .auth-form input { width: 100%; border: 1.5px solid var(--grey-200); border-radius: 8px; padding: 0.65rem 0.9rem; font-size: 0.9rem; outline: none; }
    .auth-form input:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(0,102,255,0.1); }
    .auth-row { display: flex; justify-content: space-between; align-items: center; font-size: 0.82rem; margin-bottom: 1.25rem; }
    .auth-row a { color: var(--blue); }
    .auth-divider { display: flex; align-items: center; gap: 0.75rem; margin: 1.5rem 0; color: var(--grey-400); font-size: 0.78rem; }
    .auth-divider::before, .auth-divider::after { content: ''; flex: 1; height: 1px; background: var(--grey-200); }
    .btn-google { width: 100%; display: flex; align-items: center; justify-content: center; gap: 0.6rem; background: #fff; border: 1.5px solid var(--grey-200); border-radius: 8px; padding: 0.65rem; font-weight: 600; font-size: 0.88rem; color: var(--text); transition: all 0.2s; }
    .btn-google:hover { border-color: var(--grey-400); background: var(--grey-50); }
    .auth-footer { text-align: center; margin-top: 1.5rem; font-size: 0.85rem; color: var(--text-light); }
    .auth-footer a { color: var(--blue); font-weight: 600; }
    .auth-alert { padding: 0.75rem 1rem; border-radius: 8px; font-size: 0.85rem; margin-bottom: 1.25rem; }
    .auth-alert.success { background: #ECFDF5; color: #047857; }
    .auth-alert.error { background: #FEF2F2; color: #B91C1C; }
  </style>
</head>
<body>
  <div class="auth-page">
    <div class="auth-card">
      <div class="auth-logo">
        <span class="logo-fort" style="font-family:var(--font-display); font-weight:700; font-size:1.5rem; color:var(--navy);">FORT</span><span class="logo-tune" style="font-family:var(--font-display); font-weight:700; font-size:1.5rem; color:var(--blue);">TUNE</span>
      </div>
      <?php echo $__env->yieldContent('content'); ?>
    </div>
  </div>
</body>
</html>
<?php /**PATH C:\Users\pamod\Downloads\forttune-laravel\forttune-laravel\resources\views/layouts/auth.blade.php ENDPATH**/ ?>