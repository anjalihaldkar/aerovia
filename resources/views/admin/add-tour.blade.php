@extends('layouts.admin')

@section('page_title', 'Publish New Tour Package')
@section('page_subtitle', 'Design and deploy premium itineraries to the main Aerovia portal')

@section('header_actions')
  <button class="btn btn-outline" onclick="loadSampleData()"><i class="fas fa-magic"></i> Auto-Fill Sample</button>
  <button class="btn btn-primary"
    onclick="const f = document.getElementById('add-tour-form'); if(f && f.reportValidity()) f.submit();"><i
      class="fas fa-paper-plane"></i> Publish Tour</button>
@endsection

@section('content')
  <!-- Form Section -->
  <div class="flex-col">
    @if ($errors->any())
      <div class="alert alert-danger"
        style="background-color: rgba(239, 68, 68, 0.2); border: 1px solid rgb(239, 68, 68); color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; font-size: 0.9rem;">
        <ul style="margin: 0; padding-left: 1.5rem;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <div class="tabs-bar">
      <button class="tab-btn active" onclick="switchTab(0)">1. General Info</button>
      <button class="tab-btn" onclick="switchTab(1)">2. Pricing & Payments</button>
      <button class="tab-btn" onclick="switchTab(2)">3. Flights & Logistics</button>
      <button class="tab-btn" onclick="switchTab(3)">4. Day-by-Day Itinerary</button>
      <button class="tab-btn" onclick="switchTab(4)">5. Terms & Docs</button>
    </div>

    <form id="add-tour-form" method="POST"
      action="{{ isset($tour) ? route('tours.update', $tour->id) : route('tours.store') }}">
      @csrf
      @if(isset($tour))
        @method('PUT')
      @endif
      <!-- TAB 1: General Info -->
      <div class="tab-content active" id="tab-0">
        <div class="form-panel">
          <h3 class="form-section-title"><i class="fas fa-info-circle"></i> Basic Tour Details</h3>

          <div class="form-grid-2">
            <div class="form-group form-group-full">
              <label class="field-label" for="tour-title">Tour Title</label>
              <input type="text" id="tour-title" name="title" value="{{ old('title', $tour->title ?? '') }}"
                class="field-input" placeholder="e.g. Poland & Czechia Expedition">
            </div>

            <div class="form-group form-group-full">
              <label class="field-label" for="tour-subtitle">Sub-text / Routing Overview</label>
              <textarea id="tour-subtitle" name="subtitle" class="field-input"
                placeholder="e.g. Warsaw • Krakow • Zakopane • Prague...">{{ old('subtitle', $tour->subtitle ?? '') }}</textarea>
            </div>

            <div class="form-group">
              <label class="field-label" for="tour-duration">Tour Duration</label>
              <input type="text" id="tour-duration" name="duration" value="{{ old('duration', $tour->duration ?? '') }}"
                class="field-input" placeholder="e.g. 10D / 11N">
            </div>

            <div class="form-group">
              <label class="field-label" for="tour-accommodation">Accommodation Type</label>
              <input type="text" id="tour-accommodation" name="accommodation"
                value="{{ old('accommodation', $tour->accommodation ?? '') }}" class="field-input"
                placeholder="e.g. 4 & 5 ★ Luxury Hotels">
            </div>

            <div class="form-group">
              <label class="field-label" for="tour-start-date">Start Date</label>
              <input type="date" id="tour-start-date" name="start_date"
                value="{{ old('start_date', isset($tour) && strtotime($tour->start_date) ? date('Y-m-d', strtotime($tour->start_date)) : '') }}"
                class="field-input" required>
            </div>

            <div class="form-group">
              <label class="field-label" for="tour-end-date">End Date</label>
              <input type="date" id="tour-end-date" name="end_date"
                value="{{ old('end_date', isset($tour) && strtotime($tour->end_date) ? date('Y-m-d', strtotime($tour->end_date)) : '') }}"
                class="field-input" required>
            </div>
          </div>
        </div>
      </div>

      <!-- TAB 2: Pricing & Payments -->
      <div class="tab-content" id="tab-1">
        <div class="form-panel">
          <h3 class="form-section-title"><i class="fas fa-tags"></i> Pricing & Supplement Details</h3>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="field-label" for="price-sharing">Sharing Occupancy Price</label>
              <div class="input-icon-wrapper">
                <input type="number" id="price-sharing" name="price_sharing"
                  value="{{ old('price_sharing', $tour->price_sharing ?? '') }}" class="field-input field-input-icon"
                  placeholder="e.g. 349999" min="0" required>
                <i class="fas fa-indian-rupee-sign"></i>
              </div>
            </div>

            <div class="form-group">
              <label class="field-label" for="price-single">Single Supplement Extra</label>
              <div class="input-icon-wrapper">
                <input type="number" id="price-single" name="price_single"
                  value="{{ old('price_single', $tour->price_single ?? '') }}" class="field-input field-input-icon"
                  placeholder="e.g. 42000" min="0">
                <i class="fas fa-plus"></i>
              </div>
            </div>

            <div class="form-group">
              <label class="field-label" for="discount-returning">Returning Customer Discount</label>
              <input type="text" id="discount-returning" name="discount_returning"
                value="{{ old('discount_returning', $tour->discount_returning ?? '') }}" class="field-input"
                placeholder="e.g. ₹ 19,999 OFF">
            </div>

            <div class="form-group">
              <label class="field-label" for="discount-early">Early Bird Discount</label>
              <input type="text" id="discount-early" name="discount_early"
                value="{{ old('discount_early', $tour->discount_early ?? '') }}" class="field-input"
                placeholder="e.g. ₹ 9,999 OFF (Before July 20th)">
            </div>

            <div class="form-group form-group-full">
              <h4 class="section-sub-title">Installments Schedule</h4>
              <div class="form-grid-2">
                <div class="form-group">
                  <label class="field-label">Booking Seat Deposit</label>
                  <input type="number" id="inst-deposit" name="inst_deposit"
                    value="{{ old('inst_deposit', $tour->inst_deposit ?? '') }}" class="field-input"
                    placeholder="e.g. 50000" min="0">
                </div>

                <div class="form-group">
                  <label class="field-label">1st Installment Details</label>
                  <input type="text" id="inst-1" name="inst_1" value="{{ old('inst_1', $tour->inst_1 ?? '') }}"
                    class="field-input" placeholder="e.g. ₹ 90,000 due Aug 3">
                </div>
                <div class="form-group">
                  <label class="field-label">2nd Installment Details</label>
                  <input type="text" id="inst-2" name="inst_2" value="{{ old('inst_2', $tour->inst_2 ?? '') }}"
                    class="field-input" placeholder="e.g. ₹ 90,000 due Sep 5">
                </div>
                <div class="form-group">
                  <label class="field-label">Final Payment Details</label>
                  <input type="text" id="inst-final" name="inst_final"
                    value="{{ old('inst_final', $tour->inst_final ?? '') }}" class="field-input"
                    placeholder="e.g. ₹ 69,999 due Oct 5">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- TAB 3: Flights & Logistics -->
      <div class="tab-content" id="tab-2">
        <div class="form-panel">
          <h3 class="form-section-title"><i class="fas fa-plane-departure"></i> Flight & Checked Luggage Routing</h3>

          <div id="flights-container">
            <!-- Flight 1 -->
            <div class="border-bottom-divider">
              <h4 class="section-sub-title">Sector 1 (e.g., Domestic Connection)</h4>
              <div class="form-grid-2">
                <div class="form-group">
                  <label class="field-label">Route Title</label>
                  <input type="text" id="flight1-route" name="flights[0][route]"
                    value="{{ old('flights[0][route]', $tour->flights[0]['route'] ?? '') }}" class="field-input"
                    placeholder="e.g. Kolkata to Delhi">
                </div>
                <div class="form-group">
                  <label class="field-label">Airline / Flight Code</label>
                  <input type="text" id="flight1-code" name="flights[0][code]"
                    value="{{ old('flights[0][code]', $tour->flights[0]['code'] ?? '') }}" class="field-input"
                    placeholder="e.g. IndiGo 6E5190">
                </div>
                <div class="form-group">
                  <label class="field-label">Checked Baggage Allowance</label>
                  <input type="text" id="flight1-baggage" name="flights[0][baggage]"
                    value="{{ old('flights[0][baggage]', $tour->flights[0]['baggage'] ?? '') }}" class="field-input"
                    placeholder="e.g. 15 kg">
                </div>
                <div class="form-group">
                  <label class="field-label">Cabin Hand Allowance</label>
                  <input type="text" id="flight1-cabin" name="flights[0][cabin]"
                    value="{{ old('flights[0][cabin]', $tour->flights[0]['cabin'] ?? '') }}" class="field-input"
                    placeholder="e.g. 7 kg">
                </div>
              </div>
            </div>

            <!-- Flight 2 -->
            <div class="border-bottom-divider">
              <h4 class="section-sub-title">Sector 2 (e.g., Main International Flight)</h4>
              <div class="form-grid-2">
                <div class="form-group">
                  <label class="field-label">Route Title</label>
                  <input type="text" id="flight2-route" name="flights[1][route]"
                    value="{{ old('flights[1][route]', $tour->flights[1]['route'] ?? '') }}" class="field-input"
                    placeholder="e.g. Delhi to Warsaw">
                </div>
                <div class="form-group">
                  <label class="field-label">Airline / Flight Code</label>
                  <input type="text" id="flight2-code" name="flights[1][code]"
                    value="{{ old('flights[1][code]', $tour->flights[1]['code'] ?? '') }}" class="field-input"
                    placeholder="e.g. Polish Airlines LOT LO72">
                </div>
                <div class="form-group">
                  <label class="field-label">Checked Baggage Allowance</label>
                  <input type="text" id="flight2-baggage" name="flights[1][baggage]"
                    value="{{ old('flights[1][baggage]', $tour->flights[1]['baggage'] ?? '') }}" class="field-input"
                    placeholder="e.g. 23 kg">
                </div>
                <div class="form-group">
                  <label class="field-label">Cabin Hand Allowance</label>
                  <input type="text" id="flight2-cabin" name="flights[1][cabin]"
                    value="{{ old('flights[1][cabin]', $tour->flights[1]['cabin'] ?? '') }}" class="field-input"
                    placeholder="e.g. 8 kg">
                </div>
              </div>
            </div>

            <!-- Flight 3 -->
            <div>
              <h4 class="section-sub-title">Sector 3 (e.g., Inbound Connection)</h4>
              <div class="form-grid-2">
                <div class="form-group">
                  <label class="field-label">Route Title</label>
                  <input type="text" id="flight3-route" name="flights[2][route]"
                    value="{{ old('flights[2][route]', $tour->flights[2]['route'] ?? '') }}" class="field-input"
                    placeholder="e.g. Prague to Delhi">
                </div>
                <div class="form-group">
                  <label class="field-label">Airline / Flight Code</label>
                  <input type="text" id="flight3-code" name="flights[2][code]"
                    value="{{ old('flights[2][code]', $tour->flights[2]['code'] ?? '') }}" class="field-input"
                    placeholder="e.g. Air Arabia (via Sharjah)">
                </div>
                <div class="form-group">
                  <label class="field-label">Checked Baggage Allowance</label>
                  <input type="text" id="flight3-baggage" name="flights[2][baggage]"
                    value="{{ old('flights[2][baggage]', $tour->flights[2]['baggage'] ?? '') }}" class="field-input"
                    placeholder="e.g. 23 kg">
                </div>
                <div class="form-group">
                  <label class="field-label">Cabin Hand Allowance</label>
                  <input type="text" id="flight3-cabin" name="flights[2][cabin]"
                    value="{{ old('flights[2][cabin]', $tour->flights[2]['cabin'] ?? '') }}" class="field-input"
                    placeholder="e.g. 7 kg">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- TAB 4: Day-by-Day Itinerary -->
      <div class="tab-content" id="tab-3">
        <div class="form-panel">
          <div class="table-toolbar">
            <h3 class="form-section-title title-no-border"><i class="fas fa-route"></i> Day-by-Day Constructor</h3>
            <button type="button" class="btn btn-outline" onclick="addNewItineraryDay()"><i class="fas fa-plus"></i> Add
              Day</button>
          </div>

          <div id="dynamic-itinerary-container">
            <!-- Dynamic itinerary day boxes will be injected here -->
          </div>
        </div>
      </div>

      <!-- TAB 5: Terms & Docs -->
      <div class="tab-content" id="tab-4">
        <div class="form-panel">
          <h3 class="form-section-title"><i class="fas fa-file-contract"></i> Inclusions, Exclusions & Documentation</h3>

          <div class="form-grid-2">
            <div class="form-group form-group-full">
              <label class="field-label" for="tour-inclusions">Tour Cost Inclusions (One item per line)</label>
              <textarea id="tour-inclusions" name="inclusions" class="field-input"
                placeholder="e.g. Return economy airfares&#10;Europe eSIM data&#10;4★ hotel accommodations...">{{ old('inclusions', $tour->inclusions ?? '') }}</textarea>
            </div>

            <div class="form-group form-group-full">
              <label class="field-label" for="tour-exclusions">Tour Cost Exclusions & Terms (One item per line)</label>
              <textarea id="tour-exclusions" name="exclusions" class="field-input"
                placeholder="e.g. Personal laundry shopping&#10;Standard hotel early check-in fees&#10;Itinerary modifications due to weather...">{{ old('exclusions', $tour->exclusions ?? '') }}</textarea>
            </div>

            <div class="form-group">
              <label class="field-label" for="tour-director">Tour Director Name</label>
              <input type="text" id="tour-director" name="director" value="{{ old('director', $tour->director ?? '') }}"
                class="field-input" placeholder="e.g. Mr. Dale Mogose">
            </div>

            <div class="form-group">
              <label class="field-label" for="tour-director-phone">Director Contact Number</label>
              <input type="text" id="tour-director-phone" name="director_phone"
                value="{{ old('director_phone', $tour->director_phone ?? '') }}" class="field-input"
                placeholder="e.g. +91 62890 06014">
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- Success Modal -->
  <div class="modal-overlay" id="success-modal">
    <div class="modal-card">
      <div class="modal-icon">
        <i class="fas fa-check"></i>
      </div>
      <h3>Tour Saved Successfully!</h3>
      <p id="publish-modal-desc">Your new tour package details have been simulated as saved successfully.</p>
      <button class="btn btn-primary btn-centered" onclick="closeModal()">Close Panel</button>
    </div>
  </div>

  @if(isset($tour) && is_array($tour->itinerary) && count($tour->itinerary) > 0)
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        // Clear dynamic itinerary first
        const container = document.getElementById('dynamic-itinerary-container');
        if (container) {
          container.innerHTML = '';
          @foreach($tour->itinerary as $day)
            addNewItineraryDay("{{ addslashes($day['title'] ?? '') }}", "{{ addslashes($day['banner'] ?? '') }}", "{{ str_replace(["\r", "\n"], ['', '\n'], addslashes($day['description'] ?? '')) }}");
          @endforeach
                                                                          }
      });
    </script>
  @endif
@endsection