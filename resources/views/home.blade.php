@extends('layouts.app')

@section('content')
    <!-- Hero Card Banner with Background Video -->
    <div class="hero-card-banner">
      <video autoplay loop muted playsinline class="hero-video-bg" poster="{{ asset('assets/images/video-snapshot.jpg') }}">
        <source src="{{ asset('assets/videos/Sunset-Banner.mov') }}" type="video/quicktime">
        <source src="{{ asset('assets/videos/Sunset-Banner.mov') }}" type="video/mp4">
      </video>
      <div class="hero-overlay"></div>

      <!-- Hero Main Content -->
      <div class="hero-body">
        <h1 class="hero-main-heading">Discover the<br>Golden Hour with us</h1>
        <p class="hero-sub-text">To design transformative journeys that turn the world's most extraordinary places into
          lifelong memories.</p>
        <a href="{{ url('tours') }}" class="btn btn-plum" style="padding: 0.85rem 2.25rem;">Explore with us</a>
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

    <!-- Exploring Aerovia's Breathtaking Scenery Infinite Marquee Section -->
    <section class="content-section">
      <h2 class="section-title">Exploring Aerovia's breathtaking<br>scenery & landscapes</h2>
      <p class="section-subtitle">Discover Aerovia's Wonders Effortlessly. Your shortcut<br>to one-click adventures!</p>

      <div class="infinite-slider-wrapper">
        <div class="infinite-slider-track">
          <!-- Card 1: Poland & Czechia -->
          <a href="{{ url('tour-description') }}" class="scenery-card">
            <img loading="lazy"
              src="https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fm=webp&fit=crop&w=800&q=80"
              alt="Poland & Czechia Expedition">
            <div class="scenery-card-content">
              <h4>Poland & Czechia</h4>
              <p>10D/11N Expedition • Oct 15</p>
            </div>
          </a>

          <!-- Card 2: Bali -->
          <a href="{{ url('tour-description') }}" class="scenery-card">
            <img loading="lazy"
              src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fm=webp&fit=crop&w=800&q=80"
              alt="Bali Retreat">
            <div class="scenery-card-content">
              <h4>Ubud, Bali</h4>
              <p>Cliffside Temples & Sunsets</p>
            </div>
          </a>

          <!-- Card 3: Norway -->
          <a href="{{ url('tour-description') }}" class="scenery-card">
            <img loading="lazy"
              src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fm=webp&fit=crop&w=800&q=80"
              alt="Norway Fjords">
            <div class="scenery-card-content">
              <h4>Norway Fjords</h4>
              <p>Fjord Cruise & Aurora</p>
            </div>
          </a>

          <!-- Card 4: Switzerland -->
          <a href="{{ url('tour-description') }}" class="scenery-card">
            <img loading="lazy"
              src="https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?auto=format&fm=webp&fit=crop&w=800&q=80"
              alt="Swiss Alps">
            <div class="scenery-card-content">
              <h4>Swiss Alps</h4>
              <p>Mount Titlis & Lucerne</p>
            </div>
          </a>

          <!-- Card 5: Japan -->
          <a href="{{ url('tour-description') }}" class="scenery-card">
            <img loading="lazy"
              src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fm=webp&fit=crop&w=800&q=80"
              alt="Japan">
            <div class="scenery-card-content">
              <h4>Japan Kyoto</h4>
              <p>Cherry Blossom Trail</p>
            </div>
          </a>

          <!-- Card 6: Cambodia -->
          <a href="{{ url('tour-description') }}" class="scenery-card">
            <img loading="lazy"
              src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fm=webp&fit=crop&w=800&q=80"
              alt="Angkor Wat">
            <div class="scenery-card-content">
              <h4>Angkor Wat</h4>
              <p>Ancient Heritage Trail</p>
            </div>
          </a>

          <!-- Clones for Infinite Loop -->
          <a href="{{ url('tour-description') }}" class="scenery-card">
            <img loading="lazy"
              src="https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fm=webp&fit=crop&w=800&q=80"
              alt="Poland & Czechia">
            <div class="scenery-card-content">
              <h4>Poland & Czechia</h4>
              <p>10D/11N Expedition • Oct 15</p>
            </div>
          </a>

          <a href="{{ url('tour-description') }}" class="scenery-card">
            <img loading="lazy"
              src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fm=webp&fit=crop&w=800&q=80"
              alt="Bali">
            <div class="scenery-card-content">
              <h4>Ubud, Bali</h4>
              <p>Cliffside Temples & Sunsets</p>
            </div>
          </a>
        </div>
      </div>
    </section>

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

          <a href="{{ url('about') }}" class="btn btn-plum">Discover Our Journey</a>
        </div>

        <div class="story-right">
          <img loading="lazy"
            src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fm=webp&fit=crop&w=1000&q=80"
            alt="Angkor Wat Temple" class="story-right-img">
        </div>
      </div>
    </section>

    <!-- Parallax Break Section 1 -->
    <section class="home-parallax-section"
      style="position: relative; overflow: hidden; height: 320px; border-radius: var(--radius-xl); margin-bottom: 4rem; display: flex; align-items: center; justify-content: center; color: #FFFFFF;">
      <div class="home-parallax-bg-1 parallax-bg"
        style="background-image: url('{{ asset('assets/images/home-parallax-1.webp') }}'); position: absolute; inset: 0; background-size: cover; background-position: center; z-index: 0; height: 130%;">
      </div>
      <div
        style="position: relative; z-index: 2; text-align: center; padding: 2.5rem 1.5rem; background: rgba(23, 11, 61, 0.55); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-radius: var(--radius-lg); border: 1px solid rgba(255,255,255,0.08); max-width: 650px; margin: 0 1rem; box-shadow: var(--theme-shadow-md);">
        <h3 style="font-family: var(--font-display-serif); font-size: 2.2rem; margin-bottom: 0.5rem; color: #FFFFFF;">
          Wanderlust Awaits</h3>
        <p style="font-size: 0.95rem; opacity: 0.95; line-height: 1.5;">"To travel is to live, to explore is to find
          ourselves in the beauty of the unknown." Discover the horizon with Aerovia's custom-tailored guidance.</p>
      </div>
    </section>

    <!-- Flexible Travel Plans Section (Linked to Tour Description) -->
    <section class="content-section">
      <h2 class="section-title">Flexible Travel Plans for Every Explorer</h2>
      <p class="section-subtitle">Set your travel goals, optimize your itinerary, and explore the world with ease. Our
        smart concierge team helps you plan the perfect adventure.</p>

      <div class="plans-grid">
        @foreach($tours as $tour)
          <a href="{{ route('tours.show', $tour->id) }}" class="plan-card animate-card">
            <div class="plan-card-img">
              <img loading="lazy"
                src="{{ (isset($tour->itinerary) && count($tour->itinerary) > 0 && !empty($tour->itinerary[0]['banner'])) ? $tour->itinerary[0]['banner'] : 'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fm=webp&fit=crop&w=800&q=80' }}"
                alt="{{ $tour->title }}">
            </div>
            <div class="plan-card-body">
              <h4 class="plan-card-title">{{ $tour->title }}</h4>
              <p class="plan-card-subtitle">{{ $tour->subtitle }}</p>
              <div class="plan-card-footer">
                <span class="plan-price">₹ {{ number_format((float)$tour->price_sharing, 0) }}</span>
                <span class="plan-rating"><i class="fas fa-star" style="color: var(--star-gold);"></i> 5.0</span>
              </div>
            </div>
          </a>
        @endforeach
      </div>

      <div style="text-align: center;">
        <a href="{{ url('tours') }}" class="btn btn-plum" style="padding: 0.75rem 2rem;">Explore all tours</a>
      </div>
    </section>

    <!-- Parallax Break Section 2 -->
    <section class="home-parallax-section"
      style="position: relative; overflow: hidden; height: 320px; border-radius: var(--radius-xl); margin-bottom: 4rem; display: flex; align-items: center; justify-content: center; color: #FFFFFF;">
      <div class="home-parallax-bg-2 parallax-bg"
        style="background-image: url('{{ asset('assets/images/home-parallax-2.webp') }}'); position: absolute; inset: 0; background-size: cover; background-position: center; z-index: 0; height: 130%;">
      </div>
      <div
        style="position: relative; z-index: 2; text-align: center; padding: 2.5rem 1.5rem; background: rgba(23, 11, 61, 0.55); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-radius: var(--radius-lg); border: 1px solid rgba(255,255,255,0.08); max-width: 650px; margin: 0 1rem; box-shadow: var(--theme-shadow-md);">
        <h3 style="font-family: var(--font-display-serif); font-size: 2.2rem; margin-bottom: 0.5rem; color: #FFFFFF;">
          Tailored Journeys</h3>
        <p style="font-size: 0.95rem; opacity: 0.95; line-height: 1.5;">Handcrafted itineraries designed by seasoned
          travel designers with over 40 years of trusted legacy and happy wanderers worldwide.</p>
      </div>
    </section>

    <!-- Testimonials Infinite Marquee Slider Section -->
    <section class="content-section">
      <h2 class="section-title">Hear What Travelers Say About Their<br>Aerovia Adventure!</h2>

      <div class="infinite-slider-wrapper" style="margin-top: 3rem;">
        <div class="infinite-slider-track">
          @foreach($testimonials as $test)
            <div class="testimonial-box">
              <p class="testimonial-text">"{{ $test->text }}"</p>
              <div class="testimonial-profile">
                @if($test->avatar)
                  <img loading="lazy" src="{{ $test->avatar }}" alt="{{ $test->name }}" class="testimonial-avatar-img">
                @endif
                <div class="testimonial-details">
                  <h5>{{ $test->name }}</h5>
                  <p>{{ $test->role }}</p>
                </div>
              </div>
            </div>
          @endforeach
          {{-- Render twice for continuous loop --}}
          @foreach($testimonials as $test)
            <div class="testimonial-box">
              <p class="testimonial-text">"{{ $test->text }}"</p>
              <div class="testimonial-profile">
                @if($test->avatar)
                  <img loading="lazy" src="{{ $test->avatar }}" alt="{{ $test->name }}" class="testimonial-avatar-img">
                @endif
                <div class="testimonial-details">
                  <h5>{{ $test->name }}</h5>
                  <p>{{ $test->role }}</p>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- 10 Tour-Relevant FAQs in 2-Column Grid -->
    <section class="content-section">
      <h2 class="section-title">Frequently Asked Questions</h2>
      <p class="section-subtitle">Everything you need to know about booking, customizing, and enjoying your Aerovia
        tour.</p>

      <div class="accordion-grid-2col">
        <div class="accordion-item active">
          <div class="accordion-header">
            <span>What is included in an Aerovia tour package?</span>
            <i class="fas fa-chevron-up"></i>
          </div>
          <div class="accordion-body">
            Our packages include luxury accommodations, private airport transfers, curated guided tours, entry tickets,
            daily breakfast, and 24/7 concierge assistance.
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">
            <span>Can I customize a pre-designed itinerary?</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="accordion-body">
            Absolutely! Every tour package can be tailored to match your specific dates, preferred pace, dietary needs,
            and hotel upgrades.
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">
            <span>How does the 'Pay Now' online payment system work?</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="accordion-body">
            Our secure checkout allows instant credit/debit card, Apple Pay, and wire transfer payments with immediate
            digital confirmation and itinerary delivery.
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">
            <span>What is Aerovia's trip cancellation & refund policy?</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="accordion-body">
            Full refunds are issued for cancellations made 30 days prior to departure. Flexible rescheduling options are
            available for unforeseen events.
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">
            <span>Do you assist with international travel visas?</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="accordion-body">
            Yes, our dedicated visa concierges assist with e-visa applications, invitation letters, document
            preparation, and embassy appointments worldwide.
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">
            <span>Are flights included in the package cost?</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="accordion-body">
            We offer both land-only packages and full flight-inclusive options through our airline partner network at
            competitive rates.
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">
            <span>What size are your group tours?</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="accordion-body">
            We specialize in small-group expeditions (maximum 12–16 travelers) and 100% private tours to guarantee an
            intimate, premium experience.
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">
            <span>Is travel insurance required for booking?</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="accordion-body">
            While optional, we strongly recommend comprehensive travel insurance. We partner with leading global
            insurers to provide instant coverage.
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">
            <span>What support is available during our trip?</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="accordion-body">
            You will have a dedicated local travel manager and a 24/7 WhatsApp concierge helpline for immediate
            assistance on the ground.
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">
            <span>Do you offer corporate or family group discounts?</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="accordion-body">
            Yes! Groups of 6 or more receive tier-based discounts, complimentary room upgrades, and custom private
            banquet events.
          </div>
        </div>
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
