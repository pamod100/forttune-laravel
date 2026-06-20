<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin Panel') | Forttune</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
  @stack('styles')
</head>
<body>

  <div class="admin-layout">

   <!-- SIDEBAR -->
<aside class="admin-sidebar">
  <div class="admin-logo">
    <img src="{{ asset('images/logo.png') }}" alt="Forttune" class="admin-logo-img">
    <span class="admin-tag">Admin Panel</span>
  </div>

      <nav class="admin-nav">
        <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <span class="nav-icon">📊</span> Dashboard
        </a>
        <a href="{{ route('admin.products.index') }}" class="admin-nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
          <span class="nav-icon">📦</span> Products
        </a>
        <a href="{{ route('admin.categories.index') }}" class="admin-nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
          <span class="nav-icon">🗂️</span> Categories
        </a>
        <a href="{{ route('admin.orders.index') }}" class="admin-nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
          <span class="nav-icon">🧾</span> Orders
        </a>
        <a href="{{ route('home') }}" class="admin-nav-link" target="_blank">
          <span class="nav-icon">🌐</span> View Website
        </a>
      </nav>

      <div class="admin-user">
        <div class="admin-user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        <div>
          <div class="admin-user-name">{{ auth()->user()->name }}</div>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="admin-logout-btn">Log Out</button>
          </form>
        </div>
      </div>
    </aside>

    <!-- MAIN -->
    <main class="admin-main">
      <header class="admin-topbar">
        <h1>@yield('page-title', 'Dashboard')</h1>
      </header>

      <div class="admin-content">
        @if (session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
          <div class="alert alert-error">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @yield('content')
      </div>
    </main>

  </div>

  <script src="{{ asset('js/admin.js') }}"></script>
  @stack('scripts')
</body>
</html>
