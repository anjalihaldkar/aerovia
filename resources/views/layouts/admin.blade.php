<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard - Aerovia Expeditions')</title>

  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Google Fonts -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&display=swap">

  <!-- Separate Admin Stylesheet -->
  <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>

<body class="admin-body">

  <!-- Simulated Auth Preloader -->
  <div id="auth-check-overlay">
    <div class="auth-spinner"></div>
    <span class="auth-text">Verifying Admin Session...</span>
  </div>

  <!-- Sidebar -->
  <aside class="sidebar" id="dashboard-sidebar">
    <div class="sidebar-header">
      <img src="{{ asset('assets/images/logo/aerovia-logo-256.png') }}" alt="Aerovia">
      <h2>Aerovia Control</h2>
    </div>

    <nav class="sidebar-menu">
      <div class="menu-group">
        <a href="{{ url('admin/dashboard') }}" class="menu-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"><i class="fas fa-tasks"></i> Tour Management</a>
        <div class="menu-sub-items">
          <a href="{{ route('tours.create') }}" class="menu-sub-link {{ request()->routeIs('tours.create') || request()->routeIs('tours.edit') ? 'active' : '' }}"><i class="fas fa-plus-circle"></i> Add Tour</a>
        </div>
      </div>
      <a href="{{ url('admin/banner-details') }}" class="menu-link {{ request()->is('admin/banner-details') ? 'active' : '' }}"><i class="fas fa-images"></i> Banner Details</a>
      <a href="{{ url('admin/testimonials') }}" class="menu-link {{ request()->is('admin/testimonials') ? 'active' : '' }}"><i class="fas fa-comment-dots"></i> Testimonials</a>
      <a href="{{ url('admin/settings') }}" class="menu-link {{ request()->is('admin/settings') ? 'active' : '' }}"><i class="fas fa-cog"></i> Settings</a>
      <a href="{{ route('admin.leads.index') }}" class="menu-link {{ request()->routeIs('admin.leads.index') ? 'active' : '' }}"><i class="fas fa-envelope-open-text"></i> Contact Leads</a>
      <a href="{{ url('tours') }}" class="menu-link" target="_blank"><i class="fas fa-globe"></i> View Live Site</a>
      <a href="{{ url('/') }}" class="menu-link"><i class="fas fa-arrow-left"></i> Main Site Home</a>
    </nav>

    <div class="sidebar-footer">
      <div class="admin-info">
        <i class="fas fa-user-shield"></i>
        <div>
          <div class="admin-name">Administrator</div>
          <div class="admin-status">Session Active</div>
        </div>
      </div>
      <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="logout-btn" title="Sign Out"><i class="fas fa-sign-out-alt"></i></button>
      </form>    </div>
  </aside>

  <!-- Main Content -->
  <main class="main-content">
    <header class="dashboard-header">
      <div class="flex-gap-lg">
        <!-- Side navbar toggle trigger -->
        <button class="sidebar-toggle-btn" onclick="toggleSidebarLayout()" aria-label="Toggle Sidenavbar">
          <i class="fas fa-bars"></i>
        </button>

        <div class="page-title">
          <h1>@yield('page_title', 'Dashboard')</h1>
          <p>@yield('page_subtitle', '')</p>
        </div>
      </div>

      <div class="dashboard-actions">
        @yield('header_actions')
      </div>
    </header>

    <div class="dashboard-body">
      @yield('content')
    </div>
  </main>

  <!-- Separate Admin Dashboard JavaScript -->
  <script src="{{ asset('assets/js/admin-dashboard.js') }}"></script>
</body>

</html>
