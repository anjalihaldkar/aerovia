@extends('layouts.admin')

@section('page_title', 'General Settings')
@section('page_subtitle', 'Modify public contact info, social links, and update site-wide Frequently Asked Questions')

@section('header_actions')
  <button class="btn btn-primary" onclick="saveGeneralSettings()"><i class="fas fa-save"></i> Save Settings</button>
@endsection

@section('content')
      <div class="flex-col">
        @if ($errors->any())
          <div class="alert alert-danger" style="background-color: rgba(239, 68, 68, 0.2); border: 1px solid rgb(239, 68, 68); color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; font-size: 0.9rem;">
            <ul style="margin: 0; padding-left: 1.5rem;">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form id="settings-form" action="{{ route('admin.settings.store') }}" method="POST">
          @csrf
          
          <!-- Company Contact Details -->
          <div class="form-panel">
            <h3 class="form-section-title"><i class="fas fa-address-book"></i> Company Contact Info</h3>
            <div class="form-grid-2">
              
              <div class="form-group">
                <label class="field-label">Mobile / Phone Number</label>
                <input type="tel" id="setting-phone" name="phone" class="field-input" placeholder="e.g. +91 62890 06014" value="{{ $settings->phone ?? '' }}" required pattern="^\+?[0-9\s\-]{10,20}$" title="Please enter a valid phone number (minimum 10 digits).">
              </div>

              <div class="form-group">
                <label class="field-label">Email Address</label>
                <input type="email" id="setting-email" name="email" class="field-input" placeholder="e.g. info@aeroviaexpeditions.com" value="{{ $settings->email ?? '' }}" required>
              </div>

              <div class="form-group form-group-full">
                <label class="field-label">Office Address</label>
                <input type="text" id="setting-address" name="address" class="field-input" placeholder="e.g. 127A Park Street, Kolkata - 700016" value="{{ $settings->address ?? '' }}" required minlength="10" title="Please enter a complete office address (minimum 10 characters).">
              </div>

            </div>
          </div>

          <!-- Social Media Integration -->
          <div class="form-panel">
            <h3 class="form-section-title"><i class="fas fa-share-alt"></i> Social Media & WhatsApp Links</h3>
            <div class="form-grid-2">
              
              <div class="form-group">
                <label class="field-label">Facebook Profile Link</label>
                <div class="social-input-wrapper">
                  <i class="fab fa-facebook-f social-brand-icon"></i>
                  <input type="text" id="setting-fb" name="fb" class="field-input" placeholder="https://www.facebook.com/username" value="{{ $settings->fb ?? '' }}">
                </div>
              </div>

              <div class="form-group">
                <label class="field-label">LinkedIn Page Link</label>
                <div class="social-input-wrapper">
                  <i class="fab fa-linkedin-in social-brand-icon"></i>
                  <input type="text" id="setting-linkedin" name="linkedin" class="field-input" placeholder="https://www.linkedin.com/company/username" value="{{ $settings->linkedin ?? '' }}">
                </div>
              </div>

              <div class="form-group">
                <label class="field-label">Instagram Username Link</label>
                <div class="social-input-wrapper">
                  <i class="fab fa-instagram social-brand-icon"></i>
                  <input type="text" id="setting-instagram" name="instagram" class="field-input" placeholder="https://www.instagram.com/username" value="{{ $settings->instagram ?? '' }}">
                </div>
              </div>

              <div class="form-group">
                <label class="field-label">WhatsApp Number (For Click-to-Chat - digits only, country code included)</label>
                <div class="social-input-wrapper">
                  <i class="fab fa-whatsapp social-brand-icon"></i>
                  <input type="text" id="setting-whatsapp" name="whatsapp" class="field-input" placeholder="e.g. 916289006014" value="{{ $settings->whatsapp ?? '' }}">
                </div>
              </div>

            </div>
          </div>

          <!-- FAQ Update Section -->
          <div class="form-panel">
            <div class="editor-card-header">
              <h3 class="form-section-title" style="border: none; margin: 0; padding: 0;"><i class="fas fa-question-circle"></i> Frequently Asked Questions (FAQ)</h3>
              <button type="button" class="btn-add-item" onclick="addNewFaqItem()" style="margin: 0;"><i class="fas fa-plus"></i> Add New FAQ</button>
            </div>
            
            <div id="faq-editor-container" class="dynamic-list-container" style="margin-top: 1.5rem;">
              @foreach($faqs as $index => $faq)
                <div class="editor-card-item faq-item-box">
                  <div class="editor-card-header">
                    <span class="editor-card-title">FAQ Item</span>
                    <button type="button" class="btn-remove-item" onclick="this.closest('.faq-item-box').remove()"><i class="fas fa-trash-alt"></i> Remove</button>
                  </div>
                  <div class="form-group form-group-full" style="margin-bottom: 0.75rem;">
                    <label class="field-label">Question</label>
                    <input type="text" name="faqs[{{ $index }}][question]" class="field-input faq-question-input" placeholder="Enter FAQ Question..." value="{{ $faq->question }}" required>
                  </div>
                  <div class="form-group form-group-full" style="margin-bottom: 0;">
                    <label class="field-label">Answer</label>
                    <textarea name="faqs[{{ $index }}][answer]" class="field-input faq-answer-input" style="height: 75px;" placeholder="Enter FAQ Answer..." required>{{ $faq->answer }}</textarea>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

        </form>
      </div>

  <!-- Success Modal -->
  @if(session('success'))
  <div class="modal-overlay" id="success-modal" style="display: flex;">
    <div class="modal-card">
      <div class="modal-icon">
        <i class="fas fa-check"></i>
      </div>
      <h3>Settings Saved Successfully!</h3>
      <p id="publish-modal-desc">{{ session('success') }}</p>
      <button class="btn btn-primary btn-centered" onclick="closeModal()">Close</button>
    </div>
  </div>
  @else
  <div class="modal-overlay" id="success-modal">
    <div class="modal-card">
      <div class="modal-icon">
        <i class="fas fa-check"></i>
      </div>
      <h3>Settings Saved Successfully!</h3>
      <p id="publish-modal-desc">Your contact details, social links, and updated FAQs are saved and live on the main website.</p>
      <button class="btn btn-primary btn-centered" onclick="closeModal()">Close</button>
    </div>
  </div>
  @endif
@endsection
