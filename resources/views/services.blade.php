@extends('layouts.app')

@section('title', 'Our Services - Aerovia Expeditions | Premium Travel Solutions')
@section('meta_description', 'Explore Aerovia Expeditions\' world-class travel services, including custom tour design, hotel bookings, flight arrangements, and dedicated tour directors.')

@section('content')
    <!-- Hero Card Banner with Background Video -->
    <div class="hero-card-banner">
      <img src="{{ asset('assets/images/services-hero.webp') }}" class="hero-image-bg" alt="Hero Background">
      <div class="hero-img-overlay"></div>

      <!-- Hero Main Content -->
      <div class="hero-body">
        <h1 class="hero-main-heading">World Class<br>Travel Services</h1>
        <p class="hero-sub-text">Designed to give you absolute peace of mind, from custom itinerary creation to
          dedicated 24/7 concierge assistance.</p>
        <a href="{{ url('tours') }}" class="btn btn-plum" style="padding: 0.85rem 2.25rem;">Explore Expeditions</a>
      </div>

      <!-- Hero Bottom Animated Stats Overlay Bar -->
      <div class="hero-stats-overlay">
        <div class="stats-container">
          <div class="stat-box">
            <h3 class="stat-number" data-target="24" data-suffix="/7">0/7</h3>
            <p>Concierge Care</p>
          </div>
          <div class="stat-box">
            <h3 class="stat-number" data-target="100" data-suffix="%">0%</h3>
            <p>Customized Plans</p>
          </div>
          <div class="stat-box">
            <h3 class="stat-number" data-target="50" data-suffix="+">0+</h3>
            <p>Airline Partners</p>
          </div>
        </div>
      </div>

    </div>

    <!-- Services Section -->
    <section class="content-section">
      <div class="services-header-split">
        <h2>We Always Provide The Best Service</h2>
        <div>
          <h5 class="services-sub-label" style="font-size: 1rem; margin-bottom: 0.25rem;">Our Services</h5>
          <p>Tailored travel planning, corporate retreats, and full concierge support for every explorer:</p>
        </div>
      </div>

      <div class="plans-grid">
        <div class="plan-card animate-card">
          <div class="plan-card-img">
            <img loading="lazy" src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fm=webp&fit=crop&w=800&q=80"
              alt="Custom Itinerary">
          </div>
          <div class="plan-card-body">
            <h4 class="plan-card-title">Custom Itinerary Design</h4>
            <p class="plan-card-subtitle">Tailored luxury travel plans for families, solo explorers, and couples.</p>
            <a href="{{ url('tour-description') }}" class="btn btn-outline" style="width: 100%; margin-top: 1rem;">Explore Plan
              <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i></a>
          </div>
        </div>

        <div class="plan-card animate-card">
          <div class="plan-card-img">
            <img loading="lazy" src="https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fm=webp&fit=crop&w=800&q=80"
              alt="Corporate Expeditions">
          </div>
          <div class="plan-card-body">
            <h4 class="plan-card-title">Corporate Expeditions</h4>
            <p class="plan-card-subtitle">Comprehensive group retreats & executive travel management worldwide.</p>
            <a href="{{ url('tour-description') }}" class="btn btn-plum" style="width: 100%; margin-top: 1rem;">Explore Plan <i
                class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i></a>
          </div>
        </div>

        <div class="plan-card animate-card">
          <div class="plan-card-img">
            <img loading="lazy" src="https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fm=webp&fit=crop&w=800&q=80"
              alt="VIP Concierge Care">
          </div>
          <div class="plan-card-body">
            <h4 class="plan-card-title">VIP Concierge & Visa Care</h4>
            <p class="plan-card-subtitle">24/7 dedicated support, Schengen visa assistance & priority bookings.</p>
            <a href="{{ url('tour-description') }}" class="btn btn-outline" style="width: 100%; margin-top: 1rem;">Explore Plan
              <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i></a>
          </div>
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
        <div class="cta-parallax-bg parallax-bg" style="background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1920&q=80&fm=webp'); position: absolute; inset: 0; background-size: cover; background-position: center; z-index: 0;"></div>
        <div class="cta-left" style="position: relative; z-index: 2;">
          <h3>Ready to Explore Aerovia?</h3>
          <p>Start your journey today with expert planning, seamless booking, and unforgettable experiences.</p>
        </div>
        <a href="https://wa.me/916289006014" target="_blank" class="btn btn-whatsapp-hero" style="position: relative; z-index: 2;"><i
            class="fab fa-whatsapp"></i> Reserve Now on WhatsApp</a>
      </div>
    </section>
@endsection
