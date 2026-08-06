@extends('layouts.app')

@section('title', 'About Us - Aerovia Expeditions | Our Legacy & Vision')
@section('meta_description', 'Learn about Aerovia Expeditions\' history, our passion for genuine service, and our commitment to creating exceptional, transformative travel experiences.')

@section('content')
    <!-- Hero Card Banner with Background Video -->
    <div class="hero-card-banner">
      <img src="{{ asset('assets/images/about-hero.webp') }}" class="hero-image-bg" alt="Hero Background">
      <div class="hero-img-overlay"></div>

      <!-- Hero Main Content -->
      <div class="hero-body">
        <h1 class="hero-main-heading">Crafting Journeys,<br>Inspiring Memories</h1>
        <p class="hero-sub-text">Built on a legacy spanning over 40 years, Aerovia carries forward a tradition of
          helping travelers explore the world with confidence.</p>
        <a href="{{ url('tours') }}" class="btn btn-plum" style="padding: 0.85rem 2.25rem;">Discover Expeditions</a>
      </div>

      <!-- Hero Bottom Animated Stats Overlay Bar -->
      <div class="hero-stats-overlay">
        <div class="stats-container">
          <div class="stat-box">
            <h3 class="stat-number" data-target="40" data-suffix="+">0+</h3>
            <p>Years of Heritage & Trust</p>
          </div>
          <div class="stat-box">
            <h3 class="stat-number" data-target="15" data-suffix="k+">0k+</h3>
            <p>Happy Travelers</p>
          </div>
          <div class="stat-box">
            <h3 class="stat-number" data-target="100" data-suffix="%">0%</h3>
            <p>Personal Care</p>
          </div>
        </div>
      </div>

    </div>

    <!-- Our Story Section -->
    <section class="content-section">
      <div class="story-layout">
        <div class="story-left">
          <h2>Our Story</h2>
          <p class="story-intro">Built on a legacy spanning more than 40 years, Aerovia carries forward a tradition of
            helping people pursue opportunities, reunite with loved ones, and explore the world with confidence.</p>

          <div class="story-features">
            <div class="feature-block">
              <div class="feature-icon-circle"><i class="fas fa-map-marker-alt"></i></div>
              <div class="feature-info">
                <h4>A Legacy of Genuine Service</h4>
                <p>Founded by Peter Mogose and Leslie Pereira, the journey began with a commitment to guide every
                  traveller with honesty, care, and personal attention.</p>
              </div>
            </div>

            <div class="feature-block">
              <div class="feature-icon-circle"><i class="fas fa-briefcase"></i></div>
              <div class="feature-info">
                <h4>From Trale Travels to Aerovia</h4>
                <p>Established as Trale Travels in 1998, the company evolved into Aerovia—a new identity shaped by the
                  same trusted values and a broader vision.</p>
              </div>
            </div>

            <div class="feature-block">
              <div class="feature-icon-circle"><i class="fas fa-route"></i></div>
              <div class="feature-info">
                <h4>Continuing a Family Promise</h4>
                <p>Today, every student, family, professional, and traveller we assist continues the legacy Peter and
                  Leslie began decades ago.</p>
              </div>
            </div>
          </div>

          <a href="{{ url('tours') }}" class="btn btn-plum">Discover Our Expeditions</a>
        </div>

        <div class="story-right">
          <img loading="lazy"
            src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fm=webp&fit=crop&w=1000&q=80"
            alt="Angkor Wat Temple" class="story-right-img">
        </div>
      </div>
    </section>

    <!-- Company Profile Card -->
    <section class="content-section">
      <div class="company-profile-card animate-card">
        <div class="profile-img-container">
          <img loading="lazy"
            src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fm=webp&fit=crop&w=800&q=80"
            alt="Company Experience">
          <div class="badge-clients">
            <span>15K+</span>
            <small>Clients</small>
          </div>
          <div class="badge-experience">
            <i class="fas fa-ribbon" style="font-size: 1.5rem;"></i>
            <div>
              <h4>40+</h4>
              <p>Years of Heritage & Trust</p>
            </div>
          </div>
        </div>

        <div class="profile-details">
          <h3>About Us</h3>
          <h2>We are a trusted and reliable travel company dedicated to providing exceptional service to our clients.
          </h2>
          <p style="font-size: 0.9rem; color: rgba(255,255,255,0.9);">Our services include:</p>

          <ul class="profile-services-list">
            <li><i class="far fa-dot-circle"></i> Residential & Luxury Travel Planning</li>
            <li><i class="far fa-dot-circle"></i> Commercial & Group Expeditions</li>
            <li><i class="far fa-dot-circle"></i> Specialised Visa & Concierge Services</li>
          </ul>

          <p style="font-size: 0.88rem; color: rgba(255,255,255,0.85); margin-top: 1rem;">We use only the best planning
            strategies and techniques to ensure that your journey is safe, comfortable, and memorable.</p>
        </div>
      </div>
    </section>

    <!-- Our Visits Gallery Section -->
    <section class="content-section"
      style="background: var(--theme-light-bg-gray); border-radius: var(--radius-xl); padding: 4rem 3rem;">
      <h2 class="section-title">Our Global Expeditions</h2>
      <p class="section-subtitle">Moments captured from our international tours across Europe, Asia, and the Middle
        East.</p>

      <div class="visits-gallery">
        <div class="visit-item"><img loading="lazy"
            src="https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fm=webp&fit=crop&w=400&q=80"
            alt="Visit 1"></div>
        <div class="visit-item"><img loading="lazy"
            src="https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fm=webp&fit=crop&w=400&q=80"
            alt="Visit 2"></div>
        <div class="visit-item"><img loading="lazy"
            src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fm=webp&fit=crop&w=400&q=80"
            alt="Visit 3"></div>
        <div class="visit-item"><img loading="lazy"
            src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fm=webp&fit=crop&w=400&q=80"
            alt="Visit 4"></div>
        <div class="visit-item"><img loading="lazy"
            src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fm=webp&fit=crop&w=400&q=80"
            alt="Visit 5"></div>
      </div>
    </section>

    <!-- 10 Tour-Relevant FAQs in 2-Column Grid -->
    <section class="content-section">
      <h2 class="section-title">Frequently Asked Questions</h2>
      <p class="section-subtitle">Everything you need to know about booking, customizing, and enjoying your Aerovia
        tour.</p>

      <div class="accordion-grid-2col">
        @foreach($faqs as $faq)
          <div class="accordion-item{{ $loop->first ? ' active' : '' }}">
            <div class="accordion-header">
              <span>{{ $faq->question }}</span>
              <i class="fas fa-chevron-{{ $loop->first ? 'up' : 'down' }}"></i>
            </div>
            <div class="accordion-body">
              {{ $faq->answer }}
            </div>
          </div>
        @endforeach
      </div>
    </section>

    <!-- Parallax Call to Action Banner -->
    <section class="content-section" style="padding-bottom: 2rem;">
      <div class="cta-parallax-banner animate-card" style="position: relative; overflow: hidden;">
        <div class="cta-parallax-bg parallax-bg"
          style="background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1920&q=80&fm=webp'); position: absolute; inset: 0; background-size: cover; background-position: center; z-index: 0;">
        </div>
        <div class="cta-left" style="position: relative; z-index: 2;">
          <h3>Ready to Explore Aerovia?</h3>
          <p>Start your journey today with expert planning, seamless booking, and unforgettable experiences.</p>
        </div>
        <a href="https://wa.me/916289006014" target="_blank" class="btn btn-whatsapp-hero"
          style="position: relative; z-index: 2;"><i class="fab fa-whatsapp"></i> Reserve Now on WhatsApp</a>
      </div>
    </section>
@endsection
