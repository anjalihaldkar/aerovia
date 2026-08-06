@extends('layouts.app')

@section('title', 'Contact Us - Aerovia Expeditions | Book Your Next Adventure')
@section('meta_description', 'Get in touch with the travel specialists at Aerovia Expeditions. Contact us for inquiries, custom itinerary planning, bookings, and customer support.')

@section('content')
    <!-- Hero Card Banner with Background Video -->
    <div class="hero-card-banner">
      <img src="{{ asset('assets/images/contact-hero.webp') }}" class="hero-image-bg" alt="Hero Background">
      <div class="hero-img-overlay"></div>

      <!-- Hero Main Content -->
      <div class="hero-body">
        <h1 class="hero-main-heading">Get In Touch With<br>Aerovia Expeditions</h1>
        <p class="hero-sub-text">Have questions about our Poland & Czechia tour, custom travel itineraries, or visa
          support? Our team is here to assist you.</p>
        <a href="https://wa.me/916289006014" target="_blank" class="btn btn-whatsapp-hero"
          style="padding: 0.85rem 2.25rem;"><i class="fab fa-whatsapp"></i> Chat on WhatsApp</a>
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
            <p>Response Rate</p>
          </div>
          <div class="stat-box">
            <h3 class="stat-number" data-target="40" data-suffix="+">0+</h3>
            <p>Years of Heritage & Trust</p>
          </div>
        </div>
      </div>

    </div>

    <!-- Contact Form & Info Container Card -->
    <section class="content-section">
      <div class="contact-container-card animate-card">
        <!-- Contact Sidebar Info -->
        <div class="contact-sidebar">
          <div class="contact-sidebar-info">
            <h3>Contact Information</h3>
            <p>Reach out to us directly or fill out the inquiry form and our travel experts will respond within 24
              hours.</p>

            <div class="contact-details-list">
              <div class="contact-detail-item">
                <i class="fas fa-phone-alt"></i>
                <div>
                  <strong>Phone / WhatsApp:</strong>
                  <p style="margin-top: 2px;">+91 62890 06014 / +91 98743 86677</p>
                </div>
              </div>

              <div class="contact-detail-item">
                <i class="fas fa-envelope"></i>
                <div>
                  <strong>Email Address:</strong>
                  <p style="margin-top: 2px;">traletravelsinc@gmail.com</p>
                </div>
              </div>

              <div class="contact-detail-item">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                  <strong>Kolkata Headquarters:</strong>
                  <p style="margin-top: 2px;">127A Park Street, Kolkata - 700016, West Bengal, India</p>
                </div>
              </div>

              <div class="contact-detail-item">
                <i class="fas fa-user-shield"></i>
                <div>
                  <strong>Tour Director:</strong>
                  <p style="margin-top: 2px;">Mr. Dale Mogose (Trale Travels Legacy)</p>
                </div>
              </div>
            </div>
          </div>

          <div class="contact-socials">
            <a href="#" class="contact-social-btn" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="contact-social-btn" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            <a href="#" class="contact-social-btn" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="https://wa.me/916289006014" target="_blank" class="contact-social-btn" aria-label="WhatsApp"><i
                class="fab fa-whatsapp"></i></a>
          </div>
        </div>

        <!-- Contact Form Wrapper -->
        <div class="contact-form-wrapper">
          <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--primary-plum);">Send Us A
            Message</h3>
          <p style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 2rem;">Please fill out your details
            below:</p>

          @if(session('success'))
            <div class="alert alert-success" style="background-color: rgba(16, 185, 129, 0.15); border: 1px solid rgb(16, 185, 129); color: rgb(16, 185, 129); padding: 0.75rem 1rem; border-radius: 0.375rem; margin-bottom: 1.5rem; font-size: 0.85rem; font-weight: 500;">
              <i class="fas fa-check-circle" style="margin-right: 0.4rem;"></i> {{ session('success') }}
            </div>
          @endif

          @if($errors->any())
            <div class="alert alert-danger" style="background-color: rgba(239, 68, 68, 0.15); border: 1px solid rgb(239, 68, 68); color: rgb(239, 68, 68); padding: 0.75rem 1rem; border-radius: 0.375rem; margin-bottom: 1.5rem; font-size: 0.85rem; font-weight: 500;">
              <ul style="margin: 0; padding-left: 1.25rem;">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="form-grid">
              <div class="form-group">
                <label for="first-name">First Name</label>
                <input type="text" id="first-name" name="first_name" placeholder="John" required pattern="^[a-zA-Z\s]{2,50}$" title="First name must be 2-50 characters long and contain only letters and spaces.">
              </div>
              <div class="form-group">
                <label for="last-name">Last Name</label>
                <input type="text" id="last-name" name="last_name" placeholder="Doe" required pattern="^[a-zA-Z\s]{2,50}$" title="Last name must be 2-50 characters long and contain only letters and spaces.">
              </div>
            </div>

            <div class="form-grid">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="john@example.com" required>
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="+91 98765 43210" required pattern="^\+?[0-9\s\-]{10,20}$" title="Please enter a valid phone number (minimum 10 digits).">
              </div>
            </div>

            <div class="subject-options">
              <label>Select Subject</label>
              <div class="radio-group">
                <label class="radio-item"><input type="radio" name="subject" value="Tour Booking" checked> Tour Booking</label>
                <label class="radio-item"><input type="radio" name="subject" value="Visa Assistance"> Visa Assistance</label>
                <label class="radio-item"><input type="radio" name="subject" value="Custom Itinerary"> Custom Itinerary</label>
                <label class="radio-item"><input type="radio" name="subject" value="General Inquiry"> General Inquiry</label>
              </div>
            </div>

            <div class="form-group" style="margin-bottom: 2rem;">
              <label for="message">Message</label>
              <textarea id="message" name="message" rows="4" placeholder="Write your message here..." required minlength="10" title="Message must be at least 10 characters long."></textarea>
            </div>

            <button type="submit" class="btn btn-plum" style="width: 100%; padding: 0.85rem;">Send Message <i
                class="fas fa-paper-plane" style="margin-left: 0.5rem;"></i></button>
          </form>
        </div>
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
