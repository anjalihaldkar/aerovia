<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title', 'Aerovia Expeditions - Discover the Golden Hour With Us')</title>
  <meta name="description"
    content="@yield('meta_description', 'Discover premium luxury expeditions and custom travel experiences with Aerovia Expeditions. Design your dream journey to the world\'s most extraordinary places today.')">
  <meta name="keywords"
    content="travel agency, luxury expeditions, custom tours, vacation planning, travel agency Kolkata, flight inclusive tours, Aerovia Expeditions">

  <!-- Canonical URL -->
  <link rel="canonical" href="{{ url()->current() }}">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="@yield('title', 'Aerovia Expeditions - Discover the Golden Hour With Us')">
  <meta property="og:description"
    content="@yield('meta_description', 'Discover premium luxury expeditions and custom travel experiences with Aerovia Expeditions. Design your dream journey to the world\'s most extraordinary places today.')">
  <meta property="og:image" content="{{ asset('assets/images/logo/aerovia-logo.jpg') }}">

  <!-- Twitter Cards -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="{{ url()->current() }}">
  <meta name="twitter:title" content="@yield('title', 'Aerovia Expeditions - Discover the Golden Hour With Us')">
  <meta name="twitter:description"
    content="@yield('meta_description', 'Discover premium luxury expeditions and custom travel experiences with Aerovia Expeditions. Design your dream journey to the world\'s most extraordinary places today.')">
  <meta name="twitter:image" content="{{ asset('assets/images/logo/aerovia-logo.jpg') }}">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicon Links -->
  <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.ico') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('assets/images/logo/aerovia-logo-128.png') }}" type="image/png">

  <!-- CSS Stylesheet -->
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Dynamic Theme Color Meta -->
  <meta name="theme-color" content="#191026">

  <!-- Theme Initialization -->
  <script src="{{ asset('assets/js/theme-init.js') }}"></script>

  @stack('head')
</head>

<body>

  <!-- Floating WhatsApp Button -->
  <a href="https://wa.me/{{ $settings->whatsapp ?? '916289006014' }}" class="floating-whatsapp" target="_blank"
    rel="noopener noreferrer" aria-label="Contact on WhatsApp">
    <i class="fab fa-whatsapp"></i>
  </a>

  <!-- Preloader Screen with Glowing Badge -->
  <div id="preloader">
    <div class="preloader-content">
      <div class="preloader-logo-badge">
        <img src="{{ asset('assets/images/logo/aerovia-logo-256.png') }}" alt="Aerovia Expeditions">
      </div>
      <div class="spinner"></div>
    </div>
  </div>

  <!-- Site Sticky / Overlay Navigation Bar -->
  <header class="site-navbar">
    <div class="page-wrapper">
      <div class="navbar-container">
        <a href="{{ url('/') }}" class="brand-logo-container">
          <img src="{{ asset('assets/images/logo/aerovia-logo-256.png') }}" alt="Aerovia Logo" class="brand-logo-img">
        </a>

        <!-- Snapshot-Style Mobile Navigation Side Drawer -->
        <nav class="nav-links">
          <div class="drawer-mobile-header">
            <img src="{{ asset('assets/images/logo/aerovia-logo-256.png') }}" alt="Aerovia Logo" class="brand-logo-img">
            <button class="drawer-close-btn" aria-label="Close menu"><i class="fas fa-times"></i></button>
          </div>

          <div class="drawer-mobile-items">
            <a href="{{ url('/') }}" class="nav-item {{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="{{ url('about') }}" class="nav-item {{ request()->is('about') ? 'active' : '' }}">About us</a>
            <a href="{{ url('services') }}"
              class="nav-item {{ request()->is('services') ? 'active' : '' }}">Services</a>
            <a href="{{ url('tours') }}" class="nav-item {{ request()->is('tours') ? 'active' : '' }}">Tours &
              Packages</a>
            <a href="{{ url('contact') }}" class="nav-item {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
          </div>

          <div class="drawer-mobile-footer">
            <h5>Contact Info</h5>
            <p><i class="fas fa-envelope"></i> traletravelsinc@gmail.com</p>
            <p><i class="fas fa-phone-alt"></i> +91 62890 06014</p>

            <div class="nav-links-socials">
              <a href="{{ $settings->fb ?? '#' }}" class="nav-drawer-social-btn" aria-label="Facebook"
                target="_blank"><i class="fab fa-facebook-f"></i></a>
              <a href="{{ $settings->instagram ?? '#' }}" class="nav-drawer-social-btn" aria-label="Instagram"
                target="_blank"><i class="fab fa-instagram"></i></a>
              <a href="{{ $settings->linkedin ?? '#' }}" class="nav-drawer-social-btn" aria-label="LinkedIn"
                target="_blank"><i class="fab fa-linkedin-in"></i></a>
              <a href="https://wa.me/{{ $settings->whatsapp ?? '916289006014' }}" target="_blank"
                class="nav-drawer-social-btn" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
            </div>
          </div>
        </nav>

        <div class="navbar-actions">
          <button id="theme-toggle" class="theme-toggle-btn" aria-label="Toggle theme">
            <i class="fas fa-moon"></i>
          </button>
          <a href="{{ url('contact') }}" class="btn btn-plum">Contact Us</a>
        </div>

        <button class="mobile-toggle-btn" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </div>
  </header>

  <!-- Outer Page Wrapper for Framing & Side Margins -->
  <div class="page-wrapper">

    @yield('content')

    <!-- Footer Card with Go To Top Button -->
    <footer class="footer-card">
      <div class="footer-top-row">
        <div class="footer-brand">
          <div class="footer-brand-logo">
            <img src="{{ asset('assets/images/logo/aerovia-logo-256.png') }}" alt="Aerovia Logo">
          </div>
          <p>Built on a legacy of trust and committed to turning your aspirations into journeys that shape your future.
          </p>
        </div>

        <div class="footer-nav-links">
          <a href="{{ url('/') }}">Home</a>
          <a href="{{ url('about') }}">About us</a>
          <a href="{{ url('services') }}">Services</a>
          <a href="{{ url('tours') }}">Tours & Packages</a>
          <a href="{{ url('contact') }}">Contact</a>
        </div>

        <div class="footer-socials">
          <h5>Socials</h5>
          <div style="display: flex; align-items: center; gap: 1.25rem;">
            <div class="social-icons-flex">
              <a href="{{ $settings->fb ?? '#' }}" class="social-circle" aria-label="Facebook" target="_blank"><i
                  class="fab fa-facebook-f"></i></a>
              <a href="{{ $settings->linkedin ?? '#' }}" class="social-circle" aria-label="LinkedIn" target="_blank"><i
                  class="fab fa-linkedin-in"></i></a>
              <a href="{{ $settings->instagram ?? '#' }}" class="social-circle" aria-label="Instagram"
                target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
            <!-- Go To Top Arrow Button -->
            <button class="back-to-top-btn" aria-label="Go to Top" title="Go to Top">
              <i class="fas fa-arrow-up"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="footer-bottom-row">
        <p>&copy; 2026 Aerovia Expeditions. All rights reserved.</p>
        <div class="footer-legal-links">
          <a href="#">Terms</a>
          <a href="#">Privacy</a>
          <a href="#">Cookies</a>
        </div>
      </div>
    </footer>

  </div>

  <script src="{{ asset('assets/js/script.js') }}"></script>
  @stack('scripts')
</body>

</html>