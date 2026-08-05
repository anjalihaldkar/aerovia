@extends('layouts.app')

@section('title', $tour->title . ' ' . $tour->duration . ' Luxury Expedition | Aerovia Expeditions')
@section('meta_description', 'Join Aerovia Expeditions for an exclusive ' . $tour->duration . ' luxury tour of ' . $tour->title . ' starting ' . date('d M Y', strtotime($tour->start_date)) . '. Flight inclusive.')

@section('content')
    @php
      $siteSettings = \App\Models\Setting::first();
      $whatsappNumber = preg_replace('/[^0-9]/', '', $siteSettings->whatsapp ?? '916289006014');
      $whatsappUrl = "https://wa.me/" . $whatsappNumber . "?text=" . urlencode("Hi Aerovia, I want to Reserve a seat for the " . $tour->title . " Tour");
    @endphp

    <!-- Hero Card Banner with Background Video & Parallax -->
    <div class="hero-card-banner">
      <img src="{{ (isset($tour->itinerary) && count($tour->itinerary) > 0 && !empty($tour->itinerary[0]['banner'])) ? $tour->itinerary[0]['banner'] : 'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fm=webp&fit=crop&w=1920&q=80' }}" class="hero-image-bg" alt="Hero Background">
      <div class="hero-img-overlay"></div>

      <!-- Hero Main Content -->
      <div class="hero-body">
        <div
          style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(229, 184, 66, 0.25); border: 1px solid var(--star-gold); padding: 0.4rem 1.25rem; border-radius: var(--radius-full); font-size: 0.9rem; font-weight: 600; color: #FFF; margin-bottom: 1rem;">
          <i class="fas fa-calendar-alt" style="color: var(--star-gold);"></i> {{ strtoupper(date('d M', strtotime($tour->start_date))) }} - {{ strtoupper(date('d M Y', strtotime($tour->end_date))) }}
        </div>
        <h1 class="hero-main-heading">{{ $tour->title }}</h1>
        <p class="hero-sub-text">{{ $tour->subtitle }}</p>

        <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
          <a href="{{ $whatsappUrl }}"
            target="_blank" class="btn btn-whatsapp-hero" style="padding: 0.85rem 2.25rem;"><i
              class="fab fa-whatsapp"></i> Reserve Now (via WhatsApp)</a>
          <a href="#itinerary-section" class="btn btn-pay-now" style="padding: 0.85rem 2.25rem;">View Day-by-Day Itinerary</a>
          <a href="#payment-section" class="btn btn-pay-now"> Pay Now</a>
        </div>
      </div>

      <!-- Hero Bottom Animated Stats Overlay Bar -->
      <div class="hero-stats-overlay">
        <div class="stats-container">
          <div class="stat-box">
            <h3>{{ $tour->duration }}</h3>
            <p>Tour Duration</p>
          </div>
          <div class="stat-box">
            <h3>{{ $tour->accommodation }}</h3>
            <p>Hotel Comfort</p>
          </div>
          <div class="stat-box">
            <h3>FREE eSIM</h3>
            <p>eSIM Card Included</p>
          </div>
        </div>
      </div>

    </div>

    <!-- Quick Tour Highlights Bar -->
    <section class="content-section" style="padding-top: 3rem; padding-bottom: 2rem;">
      <div class="highlights-bar">
        <div class="highlight-item"><i class="fas fa-plane-departure"></i> Flight Inclusive Package</div>
        <div class="highlight-item"><i class="fas fa-hotel"></i> Premium Accommodations</div>
        <div class="highlight-item"><i class="fas fa-utensils"></i> Curated Meals & Dinners</div>
        <div class="highlight-item"><i class="fas fa-wifi"></i> Complimentary Connectivity</div>
        <div class="highlight-item"><i class="fas fa-user-shield"></i> Professional Director</div>
      </div>
    </section>

    <!-- Pricing, Discounts & Payment Modes Section -->
    <section class="content-section" id="payment-section" style="padding-top: 1rem;">
      <h2 class="section-title">Tour Pricing & Special Discounts</h2>
      <p class="section-subtitle">Transparent pricing with flexible instalment plans available for all travelers.</p>

      <div class="pricing-overview-grid">
        <!-- Main Price Card -->
        <div class="price-box-card animate-card">
          <div class="price-box-header">
            <div>
              <span style="font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.9;">Sharing Occupancy</span>
              <div class="price-tag">₹ {{ number_format((float)$tour->price_sharing, 0) }} <span>/ person</span></div>
            </div>
            @if($tour->price_single)
              <div style="text-align: right;">
                <span style="font-size: 0.85rem; opacity: 0.85;">Single Supplement</span>
                <div style="font-size: 1.15rem; font-weight: 700; color: var(--star-gold);">+ ₹ {{ number_format((float)$tour->price_single, 0) }}</div>
              </div>
            @endif
          </div>

          <p style="font-size: 0.92rem; opacity: 0.95; line-height: 1.5;">
            Includes international flight tickets, premium hotel stays, fully guided tours, comfortable highway coaches, entry tickets, lunches & dinners, plus a complimentary connectivity pack!
          </p>

          <div class="discount-pills">
            @if($tour->discount_returning)
              <div class="discount-pill">
                <i class="fas fa-tags" style="color: var(--star-gold);"></i>
                {{ $tour->discount_returning }} for Returning Customers
              </div>
            @endif
            @if($tour->discount_early)
              <div class="discount-pill">
                <i class="fas fa-bolt" style="color: var(--star-gold);"></i>
                {{ $tour->discount_early }}
              </div>
            @endif
          </div>

          <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <a href="{{ $whatsappUrl }}"
              target="_blank" class="btn btn-whatsapp-hero" style="flex: 1;"><i class="fab fa-whatsapp"></i> Reserve Now on WhatsApp</a>
            <a href="{{ url('contact') }}" class="btn btn-outline" style="color: #FFF; border-color: rgba(255,255,255,0.4);"><i
                class="fas fa-envelope"></i> Contact Us</a>
          </div>
        </div>

        <!-- Bank & Transfer Details Box -->
        <div class="payment-modes-card animate-card">
          <h4 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--primary-plum);">Bank Transfer Details</h4>
          <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1rem;">Cheques payable to: <strong>DM Enterprises</strong></p>

          <table class="bank-detail-table">
            <tr>
              <td>Account Name:</td>
              <td>DM Enterprises</td>
            </tr>
            <tr>
              <td>Bank Name:</td>
              <td>HDFC Bank</td>
            </tr>
            <tr>
              <td>Branch:</td>
              <td>Parnashree Pally</td>
            </tr>
            <tr>
              <td>Account No:</td>
              <td>50200090161652</td>
            </tr>
            <tr>
              <td>IFSC Code:</td>
              <td>HDFC0006134</td>
            </tr>
            <tr>
              <td>UPI / VPA:</td>
              <td>9874386677@hdfcbank</td>
            </tr>
          </table>

          <div style="margin-top: 1.25rem; font-size: 0.82rem; color: var(--text-muted); text-align: center;">
            <i class="fas fa-shield-alt" style="color: var(--whatsapp-green);"></i> Instant digital receipt issued upon payment transfer.
          </div>
        </div>
      </div>

      <!-- Payment Schedule Grid -->
      @if($tour->inst_deposit)
        <h3 class="section-title" style="font-size: 1.6rem; text-align: left; margin-bottom: 1.5rem;">Instalment Payment Schedules</h3>

        <div class="payment-schedule-container">
          <!-- Sharing Schedule -->
          <div class="schedule-card animate-card">
            <h4>
              <span>Sharing Occupancy</span>
              <span style="font-size: 0.9rem;" class="schedule-total">₹ {{ number_format((float)$tour->price_sharing, 0) }} Total</span>
            </h4>
            <div class="schedule-step-list">
              <div class="schedule-step-item">
                <div>
                  <strong style="display: block;">Registration Booking Amount</strong>
                  <span class="due-date">Due upon seat reservation</span>
                </div>
                <span class="amount">₹ {{ number_format((float)$tour->inst_deposit, 0) }}</span>
              </div>
              @if($tour->inst_1)
                <div class="schedule-step-item">
                  <div>
                    <strong style="display: block;">1st Instalment</strong>
                    <span class="due-date">Details</span>
                  </div>
                  <span class="amount">{{ $tour->inst_1 }}</span>
                </div>
              @endif
              @if($tour->inst_2)
                <div class="schedule-step-item">
                  <div>
                    <strong style="display: block;">2nd Instalment</strong>
                    <span class="due-date">Details</span>
                  </div>
                  <span class="amount">{{ $tour->inst_2 }}</span>
                </div>
              @endif
              @if($tour->inst_final)
                <div class="schedule-step-item">
                  <div>
                    <strong style="display: block;">Final Instalment</strong>
                    <span class="due-date">Details</span>
                  </div>
                  <span class="amount">{{ $tour->inst_final }}</span>
                </div>
              @endif
            </div>
          </div>

          <!-- Single Occupancy Schedule -->
          @if($tour->price_single)
            <div class="schedule-card animate-card">
              <h4>
                <span>Single Occupancy</span>
                <span style="font-size: 0.9rem;" class="schedule-total">₹ {{ number_format((float)$tour->price_sharing + (float)$tour->price_single, 0) }} Total</span>
              </h4>
              <div class="schedule-step-list">
                <div class="schedule-step-item">
                  <div>
                    <strong style="display: block;">Registration Booking Amount</strong>
                    <span class="due-date">Due upon seat reservation</span>
                  </div>
                  <span class="amount">₹ {{ number_format((float)$tour->inst_deposit, 0) }}</span>
                </div>
                <div class="schedule-step-item">
                  <div>
                    <strong style="display: block;">Single Supplement Charge</strong>
                    <span class="due-date">Due during installments</span>
                  </div>
                  <span class="amount">+ ₹ {{ number_format((float)$tour->price_single, 0) }}</span>
                </div>
                <div class="schedule-step-item">
                  <div>
                    <strong style="display: block;">Installment Balances</strong>
                    <span class="due-date">Based on sharing rules</span>
                  </div>
                  <span class="amount">See sharing schedule</span>
                </div>
              </div>
            </div>
          @endif
        </div>
      @endif
    </section>

    <!-- Flight & Luggage Allowances Section -->
    @if(is_array($tour->flights) && count($tour->flights) > 0)
      <section class="content-section" style="background: var(--theme-light-bg-gray); border-radius: var(--radius-xl); padding: 4rem 3rem;">
        <h2 class="section-title">Flight Route & Baggage Allowances</h2>
        <p class="section-subtitle">Comfortable flight routing with checked baggage capacity included.</p>

        <div class="flight-luggage-grid">
          @foreach($tour->flights as $flight)
            <div class="flight-luggage-card animate-card">
              <i class="fas fa-plane-departure"></i>
              <h5>{{ $flight['route'] ?? 'Sector' }}</h5>
              <p>{{ $flight['code'] ?? '' }}<br>Check-in: <strong>{{ $flight['baggage'] ?? 'N/A' }}</strong> | Cabin: <strong>{{ $flight['cabin'] ?? 'N/A' }}</strong></p>
            </div>
          @endforeach
        </div>
      </section>
    @endif

    <!-- 2-Column Detailed Day-by-Day Itinerary Section -->
    <section class="content-section" id="itinerary-section">
      <h2 class="section-title">Day-by-Day Tour Itinerary</h2>
      <p class="section-subtitle">A side-by-side overview of our custom itinerary exploring {{ $tour->title }}.</p>

      <div class="timeline-container-2col">
        @if(is_array($tour->itinerary) && count($tour->itinerary) > 0)
          @foreach($tour->itinerary as $dayIndex => $day)
            <div class="timeline-day-card animate-card">
              <div class="timeline-day-header">
                <div class="timeline-day-title">
                  <span class="day-badge">Day {{ $dayIndex + 1 }}</span>
                  <span>{{ $day['title'] ?? 'Adventure Day' }}</span>
                </div>
              </div>
              <div class="timeline-day-body">
                @if(!empty($day['banner']))
                  <div style="width: 100%; border-radius: var(--radius-lg); overflow: hidden; margin-bottom: 1rem; height: 180px;">
                    <img src="{{ $day['banner'] }}" alt="{{ $day['title'] ?? 'Itinerary Day Banner' }}" style="width: 100%; height: 100%; object-fit: cover;">
                  </div>
                @endif
                <p>{{ $day['description'] ?? '' }}</p>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    </section>

    <!-- Visa Documents Checklist Section -->
    <section class="content-section">
      <h2 class="section-title">Visa Documents Required</h2>
      <p class="section-subtitle">Aerovia handles flight/hotel reservations and insurance. Travelers must provide the following:</p>

      <div class="visa-docs-grid">
        <div class="visa-doc-card animate-card">
          <h4><i class="fas fa-briefcase"></i> Salaried Individuals</h4>
          <ul class="visa-doc-list">
            <li><i class="fas fa-check-circle"></i> Passport bio pages (front, back & used pages, 6 months validity).</li>
            <li><i class="fas fa-check-circle"></i> 2 Passport photos (white background).</li>
            <li><i class="fas fa-check-circle"></i> 3 months bank savings statement (stamped & signed).</li>
            <li><i class="fas fa-check-circle"></i> 3 months payslips & 2 years ITR returns.</li>
            <li><i class="fas fa-check-circle"></i> Official leave letter with travel dates & position.</li>
            <li><i class="fas fa-check-circle"></i> Employment contract copy.</li>
          </ul>
        </div>

        <div class="visa-doc-card animate-card">
          <h4><i class="fas fa-store"></i> Business Owners</h4>
          <ul class="visa-doc-list">
            <li><i class="fas fa-check-circle"></i> Passport bio pages & passport photos.</li>
            <li><i class="fas fa-check-circle"></i> Trade Licence copy.</li>
            <li><i class="fas fa-check-circle"></i> GST Registration Certificate.</li>
            <li><i class="fas fa-check-circle"></i> 3 months bank statement (stamped & signed).</li>
            <li><i class="fas fa-check-circle"></i> 2 years Income Tax Returns (ITR).</li>
          </ul>
        </div>

        <div class="visa-doc-card animate-card">
          <h4><i class="fas fa-user-clock"></i> Retired Persons</h4>
          <ul class="visa-doc-list">
            <li><i class="fas fa-check-circle"></i> Passport bio pages & passport photos.</li>
            <li><i class="fas fa-check-circle"></i> Pension statements for last 3 months.</li>
            <li><i class="fas fa-check-circle"></i> Proof of regular income (property/business).</li>
            <li><i class="fas fa-check-circle"></i> 3 months bank statement (stamped & signed).</li>
          </ul>
        </div>
      </div>
    </section>

    <!-- Terms, Exclusions & Disclaimers Section -->
    <section class="content-section">
      <div class="terms-box-card animate-card">
        <h3><i class="fas fa-exclamation-triangle"></i> Tour Cost Exclusions & Important Terms</h3>
        <ul class="terms-list">
          @if($tour->exclusions)
            @foreach(explode("\n", str_replace("\r", "", $tour->exclusions)) as $exclusion)
              @if(trim($exclusion))
                <li><i class="fas fa-times-circle"></i> {{ trim($exclusion) }}</li>
              @endif
            @endforeach
          @endif
          <li><i class="fas fa-info-circle"></i> <strong>Itinerary Modifications:</strong> Day itinerary subject to last-minute adjustments due to local weather, traffic, strikes, or road conditions.</li>
          <li><i class="fas fa-hotel"></i> <strong>Check-in/Check-out:</strong> Standard hotel check-in at 14:00 hours / check-out at 12:00 hours. Early/late check-out subject to hotel availability.</li>
          <li><i class="fas fa-shield-alt"></i> <strong>Agent Capacity:</strong> Aerovia Expeditions acts in the capacity of an agent for independent suppliers (hotels, airlines, coaches).</li>
          @if($tour->director)
            <li><i class="fas fa-file-signature"></i> <strong>Passenger Agreement:</strong> All passengers traveling on the {{ $tour->title }} tour ({{ date('d M', strtotime($tour->start_date)) }} – {{ date('d M Y', strtotime($tour->end_date)) }}) agree to abide by the tour regulations led by Tour Director {{ $tour->director }}.</li>
          @endif
        </ul>
      </div>
    </section>

    <!-- Organizer Contact Card -->
    <section class="content-section" style="padding-bottom: 2rem;">
      <div class="organizer-contact-card animate-card">
        <div class="organizer-info">
          <h3>Aerovia Expeditions</h3>
          @if($tour->director)
            <p>Tour Director: {{ $tour->director }} | Trale Travels Legacy</p>
          @endif
        </div>

        <div class="organizer-contacts-flex">
          @if($siteSettings && $siteSettings->phone)
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings->phone) }}" class="contact-pill"><i class="fas fa-phone-alt"></i> {{ $siteSettings->phone }}</a>
          @endif
          @if($tour->director_phone)
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $tour->director_phone) }}" class="contact-pill"><i class="fas fa-phone-alt"></i> {{ $tour->director_phone }} (Director)</a>
          @endif
          @if($siteSettings && $siteSettings->email)
            <a href="mailto:{{ $siteSettings->email }}" class="contact-pill"><i class="fas fa-envelope"></i> {{ $siteSettings->email }}</a>
          @endif
          @if($siteSettings && $siteSettings->address)
            <div class="contact-pill"><i class="fas fa-map-marker-alt"></i> {{ $siteSettings->address }}</div>
          @endif
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
        <a href="{{ $whatsappUrl }}" target="_blank" class="btn btn-whatsapp-hero" style="position: relative; z-index: 2;"><i
            class="fab fa-whatsapp"></i> Reserve Now on WhatsApp</a>
      </div>
    </section>
@endsection
