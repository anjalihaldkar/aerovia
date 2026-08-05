@extends('layouts.app')

@section('title', 'Tours & Packages - Aerovia Expeditions | Explore Destinations')
@section('meta_description', 'Browse our curated collection of luxury tours and holiday packages. Find destination itineraries tailored to your unique interests and travel style.')

@section('content')
    <!-- Hero Card Banner with Background Video -->
    <div class="hero-card-banner">
      <img src="{{ asset('assets/images/tours-hero.webp') }}" class="hero-image-bg" alt="Hero Background">
      <div class="hero-img-overlay"></div>

      <!-- Hero Main Content -->
      <div class="hero-body" style="padding-bottom: 2rem;">
        <h1 class="hero-main-heading">Uncover Destinations<br>That Match You</h1>
        <p class="hero-sub-text">From hidden alpine retreats to iconic cultural landmarks, every recommendation is
          thoughtfully tailored by Aerovia.</p>

        <!-- Floating Search Bar -->
        <div class="search-floating-bar">
          <div class="search-field">
            <i class="fas fa-map-marker-alt" style="color: var(--text-muted);"></i>
            <div class="custom-dropdown" id="location-dropdown">
              <div class="custom-dropdown-trigger">
                <span class="custom-dropdown-selected" data-placeholder="Pick a location to explore . . .">Pick a
                  location to explore . . .</span>
                <i class="fas fa-chevron-down custom-dropdown-arrow"></i>
              </div>
              <div class="custom-dropdown-menu">
                <div class="dropdown-search-wrapper">
                  <i class="fas fa-search dropdown-search-icon"></i>
                  <input type="text" class="dropdown-search-input" placeholder="Search location...">
                </div>
                <div class="custom-dropdown-item active" data-value="">Pick a location to explore . . .</div>
                <div class="custom-dropdown-item" data-value="poland">Poland & Czechia</div>
                <div class="custom-dropdown-item" data-value="bali">Ubud, Bali</div>
                <div class="custom-dropdown-item" data-value="norway">Norway Fjords</div>
                <div class="custom-dropdown-item" data-value="switzerland">Swiss Alps</div>
              </div>
              <input type="hidden" name="location" id="location-input" value="">
            </div>
          </div>
          <div class="search-divider"></div>
          <div class="search-field">
            <i class="fas fa-compass" style="color: var(--text-muted);"></i>
            <div class="custom-dropdown" id="category-dropdown">
              <div class="custom-dropdown-trigger">
                <span class="custom-dropdown-selected" data-placeholder="What kind of places do you like?">What kind of
                  places do you like?</span>
                <i class="fas fa-chevron-down custom-dropdown-arrow"></i>
              </div>
              <div class="custom-dropdown-menu">
                <div class="dropdown-search-wrapper">
                  <i class="fas fa-search dropdown-search-icon"></i>
                  <input type="text" class="dropdown-search-input" placeholder="Search category...">
                </div>
                <div class="custom-dropdown-item active" data-value="">What kind of places do you like?</div>
                <div class="custom-dropdown-item" data-value="nature">Nature & Adventure</div>
                <div class="custom-dropdown-item" data-value="culture">Cultural Landmarks</div>
                <div class="custom-dropdown-item" data-value="relaxation">Beach & Relaxation</div>
              </div>
              <input type="hidden" name="category" id="category-input" value="">
            </div>
          </div>
          <button class="btn-search-icon" aria-label="Search">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>

      <!-- Hero Bottom Animated Stats Overlay Bar -->
      <div class="hero-stats-overlay">
        <div class="stats-container">
          <div class="stat-box">
            <h3 class="stat-number" data-target="40" data-suffix="+">0+</h3>
            <p>Destinations</p>
          </div>
          <div class="stat-box">
            <h3 class="stat-number" data-target="100" data-suffix="%">0%</h3>
            <p>Tailored Plans</p>
          </div>
          <div class="stat-box">
            <h3 class="stat-number" data-target="15" data-suffix="k+">0k+</h3>
            <p>Happy Travelers</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content: Discover Places -->
    <section class="content-section">
      <h2 class="section-title">Discover places you're going to love</h2>
      <p class="section-subtitle">From European heritage expeditions to tropical island getaways, explore our handpicked
        packages.</p>

      <!-- Filter Tabs -->
      <div class="filter-tabs">
        <button class="tab-btn active">All Tours</button>
        <button class="tab-btn">European Expeditions</button>
        <button class="tab-btn">Tropical Escapes</button>
        <button class="tab-btn">Cultural Heritage</button>
        <button class="tab-btn">Alpine Adventures</button>
      </div>

      <!-- Tours 3-column Grid -->
      <div class="tours-grid">
        @foreach($tours as $tour)
          <div class="tour-card animate-card" style="{{ $loop->first ? 'border: 2px solid var(--secondary-plum);' : '' }}">
            <div class="tour-card-img" style="position: relative;">
              @if($loop->first)
                <span
                  style="position: absolute; top: 15px; left: 15px; background: var(--btn-gradient); color: #FFF; padding: 0.35rem 0.85rem; border-radius: var(--radius-full); font-size: 0.8rem; font-weight: 700; z-index: 2;">FEATURED
                  • {{ strtoupper(date('d M Y', strtotime($tour->start_date))) }}</span>
              @else
                <span
                  style="position: absolute; top: 15px; left: 15px; background: rgba(0, 0, 0, 0.6); color: #FFF; padding: 0.35rem 0.85rem; border-radius: var(--radius-full); font-size: 0.8rem; font-weight: 700; z-index: 2;">
                  {{ strtoupper(date('d M Y', strtotime($tour->start_date))) }}</span>
              @endif
              <img loading="lazy" src="{{ (isset($tour->itinerary) && count($tour->itinerary) > 0 && !empty($tour->itinerary[0]['banner'])) ? $tour->itinerary[0]['banner'] : 'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fm=webp&fit=crop&w=800&q=80' }}"
                alt="{{ $tour->title }}">
            </div>
            <div class="tour-card-body">
              <div class="tour-card-header">
                <h4>{{ $tour->title }} {{ $tour->duration }}</h4>
                <span style="font-weight: 600; font-size: 0.9rem;"><i class="fas fa-star"
                    style="color: var(--star-gold);"></i> 5.0</span>
              </div>
              <p class="tour-card-desc">{{ $tour->subtitle }}</p>
              <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 1rem;">
                <span class="tour-price">₹ {{ number_format((float)$tour->price_sharing, 0) }}</span>
                <a href="{{ route('tours.show', $tour->id) }}" class="btn {{ $loop->first ? 'btn-plum' : 'btn-outline' }}"
                  style="padding: 0.5rem 1.25rem; font-size: 0.85rem;">View Details <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        @endforeach
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
