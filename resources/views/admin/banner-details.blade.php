@extends('layouts.admin')

@section('page_title', 'Banner & Media Details')
@section('page_subtitle', 'Choose local media files to update banners and videos across all pages')

@section('header_actions')
  <button class="btn btn-primary" onclick="const f = document.getElementById('banner-details-form'); if(f && f.reportValidity()) f.submit();"><i class="fas fa-save"></i> Save Banners</button>
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
        
        @if(session('success'))
          <div class="alert" style="background: rgba(0, 255, 0, 0.1); color: #00ff00; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
          </div>
        @endif
        <form id="banner-details-form" method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
          @csrf
          
          <!-- Home Page Banners -->
          <div class="form-panel">
            <h3 class="form-section-title"><i class="fas fa-home"></i> Home Page Hero Media</h3>
            <div class="form-grid-2">
              
              <!-- Video File -->
              <div class="form-group form-group-full">
                <label class="field-label">Homepage Background Video</label>
                <div class="media-upload-row">
                  <div class="upload-dropzone" onclick="document.getElementById('banner-home-video-file').click()">
                    <i class="fas fa-video"></i>
                    <span>Click to Choose Video File</span>
                    <input type="file" id="banner-home-video-file" name="home_video" class="file-input-hidden" accept="video/*" onchange="previewMedia(this, 'preview-home-video')">
                  </div>
                  <div class="preview-container">
                    <video class="preview-media" id="preview-home-video" autoplay muted loop>
                      <source src="{{ isset($settings['home_video']) ? asset('storage/' . $settings['home_video']) : '' }}" type="video/mp4">
                    </video>
                    <div class="preview-label-tag">Video</div>
                  </div>
                </div>
              </div>

              <!-- Poster File -->
              <div class="form-group form-group-full">
                <label class="field-label">Video Snapshot Poster</label>
                <div class="media-upload-row">
                  <div class="upload-dropzone" onclick="document.getElementById('banner-home-poster-file').click()">
                    <i class="fas fa-image"></i>
                    <span>Click to Choose Poster Image</span>
                    <input type="file" id="banner-home-poster-file" name="home_poster" class="file-input-hidden" accept="image/*" onchange="previewMedia(this, 'preview-home-poster')">
                  </div>
                  <div class="preview-container">
                    <img class="preview-media" id="preview-home-poster" src="{{ isset($settings['home_poster']) ? asset('storage/' . $settings['home_poster']) : '' }}" alt="Video Poster">
                    <div class="preview-label-tag">Poster</div>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <!-- Public Subpages Banners -->
          <div class="form-panel media-panel">
            <h3 class="form-section-title"><i class="fas fa-images"></i> Subpages Banner Images</h3>
            <div class="form-grid-2">
              
              <!-- About Us Page Banner -->
              <div class="form-group">
                <label class="field-label">About Us Page Banner</label>
                <div class="media-upload-row">
                  <div class="upload-dropzone" onclick="document.getElementById('banner-about-file').click()">
                    <i class="fas fa-image"></i>
                    <span>Choose About Banner</span>
                    <input type="file" id="banner-about-file" name="about_banner" class="file-input-hidden" accept="image/*" onchange="previewMedia(this, 'preview-about')">
                  </div>
                  <div class="preview-container">
                    <img class="preview-media" id="preview-about" src="{{ isset($settings['about_banner']) ? asset('storage/' . $settings['about_banner']) : '' }}" alt="About Banner">
                    <div class="preview-label-tag">About</div>
                  </div>
                </div>
              </div>

              <!-- World Class Services Page Banner -->
              <div class="form-group">
                <label class="field-label">World Class Services Page Banner</label>
                <div class="media-upload-row">
                  <div class="upload-dropzone" onclick="document.getElementById('banner-services-file').click()">
                    <i class="fas fa-image"></i>
                    <span>Choose Services Banner</span>
                    <input type="file" id="banner-services-file" name="services_banner" class="file-input-hidden" accept="image/*" onchange="previewMedia(this, 'preview-services')">
                  </div>
                  <div class="preview-container">
                    <img class="preview-media" id="preview-services" src="{{ isset($settings['services_banner']) ? asset('storage/' . $settings['services_banner']) : '' }}" alt="Services Banner">
                    <div class="preview-label-tag">Services</div>
                  </div>
                </div>
              </div>

              <!-- Tours Catalog Page Banner -->
              <div class="form-group">
                <label class="field-label">Tours Catalog Page Banner</label>
                <div class="media-upload-row">
                  <div class="upload-dropzone" onclick="document.getElementById('banner-tours-file').click()">
                    <i class="fas fa-image"></i>
                    <span>Choose Tours Banner</span>
                    <input type="file" id="banner-tours-file" name="tours_banner" class="file-input-hidden" accept="image/*" onchange="previewMedia(this, 'preview-tours')">
                  </div>
                  <div class="preview-container">
                    <img class="preview-media" id="preview-tours" src="{{ isset($settings['tours_banner']) ? asset('storage/' . $settings['tours_banner']) : '' }}" alt="Tours Banner">
                    <div class="preview-label-tag">Tours</div>
                  </div>
                </div>
              </div>

              <!-- Contact Us Page Banner -->
              <div class="form-group">
                <label class="field-label">Contact Us Page Banner</label>
                <div class="media-upload-row">
                  <div class="upload-dropzone" onclick="document.getElementById('banner-contact-file').click()">
                    <i class="fas fa-image"></i>
                    <span>Choose Contact Banner</span>
                    <input type="file" id="banner-contact-file" name="contact_banner" class="file-input-hidden" accept="image/*" onchange="previewMedia(this, 'preview-contact')">
                  </div>
                  <div class="preview-container">
                    <img class="preview-media" id="preview-contact" src="{{ isset($settings['contact_banner']) ? asset('storage/' . $settings['contact_banner']) : '' }}" alt="Contact Banner">
                    <div class="preview-label-tag">Contact</div>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <!-- Scenery & Landscapes Banners -->
          <div class="form-panel">
            <div class="editor-card-header">
              <h3 class="form-section-title" style="border: none; margin: 0; padding: 0;"><i class="fas fa-mountain"></i> Scenery & Landscapes Section Images</h3>
              <button type="button" class="btn-add-item" onclick="addNewSceneryItem()" style="margin: 0;"><i class="fas fa-plus"></i> Add Scenery Slide</button>
            </div>
            <p style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.5rem; margin-bottom: 1.5rem;">
              These custom landscape images will show in the infinite marquee slider on the home page.
            </p>
            <div id="scenery-editor-container" class="scenery-editor-grid">
              <!-- Dynamically populated via JS -->
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
      <h3>Assets Updated Successfully!</h3>
      <p id="publish-modal-desc">The chosen header banner images and background video files have been simulated as uploaded and saved successfully.</p>
      <button class="btn btn-primary btn-centered" onclick="closeModal()">Close Panel</button>
    </div>
  </div>

@endsection

@section('scripts')
<script>
  function previewMedia(input, previewId) {
    if (input.files && input.files[0]) {
      const file = input.files[0];
      const isVideo = previewId.includes('video');
      
      if (isVideo) {
        if (!file.type.startsWith('video/')) {
          alert('Error: Please select a valid video file.');
          input.value = '';
          return;
        }
        if (file.size > 20 * 1024 * 1024) {
          alert('Error: Video file size cannot exceed 20MB.');
          input.value = '';
          return;
        }
      } else {
        if (!file.type.startsWith('image/')) {
          alert('Error: Please select a valid image file.');
          input.value = '';
          return;
        }
        if (file.size > 2 * 1024 * 1024) {
          alert('Error: Image file size cannot exceed 2MB.');
          input.value = '';
          return;
        }
      }

      const url = URL.createObjectURL(file);
      const preview = document.getElementById(previewId);
      if (preview.tagName.toLowerCase() === 'video') {
        preview.querySelector('source').src = url;
        preview.load();
      } else {
        preview.src = url;
      }
    }
  }

  // Pre-load Scenery Array from DB
  document.addEventListener('DOMContentLoaded', () => {
      const serverSceneryList = {!! json_encode($sceneryList ?? []) !!};
      if (serverSceneryList.length > 0) {
          sceneryList = [];
          const container = document.getElementById('scenery-editor-container');
          if (container) container.innerHTML = '';
          
          serverSceneryList.forEach(item => {
              // Check if image is an external URL or an internal uploaded path
              let imageUrl = item.image;
              if (imageUrl && !imageUrl.startsWith('http')) {
                  imageUrl = "{{ asset('storage') }}/" + imageUrl;
              }
              addNewSceneryItem(item.title, item.subtitle, imageUrl, item.image);
          });
      }
  });
</script>
