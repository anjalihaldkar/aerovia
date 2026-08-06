// Aerovia Admin Panel - Dashboard & Tour Manager Logic

document.addEventListener('DOMContentLoaded', () => {
  // Authentication is now handled by Laravel on the backend.
  const authOverlay = document.getElementById('auth-check-overlay');
  
  // Just fade out the overlay
  setTimeout(() => {
    if (authOverlay) {
      authOverlay.style.opacity = '0';
      setTimeout(() => authOverlay.style.display = 'none', 300);
    }
  }, 400);

  // 2. Initialize View Tours search filters if we are on index.html
  const tableSearch = document.getElementById('table-search-input');
  if (tableSearch) {
    tableSearch.addEventListener('input', () => {
      const query = tableSearch.value.toLowerCase().trim();
      const rows = document.querySelectorAll('table.admin-table tbody tr');

      rows.forEach(row => {
        const titleText = row.querySelector('.tour-name-cell').textContent.toLowerCase();
        const routeText = row.querySelector('.tour-route-cell').textContent.toLowerCase();
        if (titleText.includes(query) || routeText.includes(query)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  }

  // 3. Initialize status switches click listeners
  const statusBadges = document.querySelectorAll('.status-badge');
  statusBadges.forEach(badge => {
    badge.addEventListener('click', () => {
      if (badge.classList.contains('status-active')) {
        badge.classList.remove('status-active');
        badge.classList.add('status-inactive');
        badge.innerHTML = '<i class="fas fa-circle"></i> Inactive';
      } else {
        badge.classList.remove('status-inactive');
        badge.classList.add('status-active');
        badge.innerHTML = '<i class="fas fa-circle"></i> Active';
      }
    });
  });

  // 4. Initialize dynamic itinerary constructor default day if editor form exists
  const dynamicContainer = document.getElementById('dynamic-itinerary-container');
  if (dynamicContainer && dynamicContainer.children.length === 0) {
    addNewItineraryDay();
  }

  // 5. Initialize banner details upload previews if we are on banner-details.html
  const fileInputs = [
    { inputId: 'banner-home-video-file', type: 'video', previewId: 'preview-home-video' },
    { inputId: 'banner-home-poster-file', type: 'image', previewId: 'preview-home-poster' },
    { inputId: 'banner-about-file', type: 'image', previewId: 'preview-about' },
    { inputId: 'banner-services-file', type: 'image', previewId: 'preview-services' },
    { inputId: 'banner-tours-file', type: 'image', previewId: 'preview-tours' },
    { inputId: 'banner-contact-file', type: 'image', previewId: 'preview-contact' }
  ];

  fileInputs.forEach(item => {
    const input = document.getElementById(item.inputId);
    if (input) {
      input.addEventListener('change', () => {
        const file = input.files[0];
        const preview = document.getElementById(item.previewId);
        if (file && preview) {
          const url = URL.createObjectURL(file);
          if (item.type === 'image') {
            preview.src = url;
            preview.style.display = 'block';
          } else if (item.type === 'video') {
            const source = preview.querySelector('source');
            if (source) source.src = url;
            preview.load();
            preview.style.display = 'block';
          }
        }
      });
    }
  });

  // 6. Load Settings Page data (Disabled in favor of Laravel server-side rendering)
  // if (document.getElementById('settings-form')) {
  //   loadGeneralSettings();
  // }

  // 7. Load Testimonials Manager data (Disabled in favor of Laravel server-side rendering)
  // if (document.getElementById('testimonials-list-container')) {
  //   loadTestimonials();
  // }

  // 8. Load Scenery Banners data if we are on banner-details.html
  if (document.getElementById('scenery-editor-container')) {
    loadSceneryItems();
  }
});

// Sidenavbar Toggle Layout (Desktop Collapsing and Mobile sliding drawer)
function toggleSidebarLayout() {
  const sidebar = document.getElementById('dashboard-sidebar');
  const width = window.innerWidth;

  if (width > 768) {
    // Desktop collapsing toggle
    document.body.classList.toggle('sidebar-collapsed');
  } else {
    // Mobile sliding drawer toggle
    if (sidebar) sidebar.classList.toggle('mobile-open');
  }
}

// Close sidebar on mobile when window sizes changes to desktop
window.addEventListener('resize', () => {
  const sidebar = document.getElementById('dashboard-sidebar');
  if (sidebar && window.innerWidth > 768) {
    sidebar.classList.remove('mobile-open');
  }
});

// Logout Function
function performLogout() {
  localStorage.removeItem('aerovia_admin_logged');
  window.location.href = 'login.html';
}

// Switch Tabs in Tour Editor Form
function switchTab(index) {
  const tabs = document.querySelectorAll('.tab-btn');
  const contents = document.querySelectorAll('.tab-content');

  tabs.forEach((tab, i) => {
    if (i === index) {
      tab.classList.add('active');
      contents[i].classList.add('active');
    } else {
      tab.classList.remove('active');
      contents[i].classList.remove('active');
    }
  });
}

// Dynamic Itinerary Day Constructor (Add Day)
let dayCount = 0;
function addNewItineraryDay(titleVal = '', bannerVal = '', descVal = '') {
  const container = document.getElementById('dynamic-itinerary-container');
  if (!container) return;

  // Recount current elements first
  const existingBoxes = container.querySelectorAll('.itinerary-day-box');
  dayCount = existingBoxes.length + 1;

  const dayBox = document.createElement('div');
  dayBox.className = 'itinerary-day-box';
  dayBox.id = `itinerary-day-${dayCount}`;
  dayBox.innerHTML = `
    <div class="day-box-header">
      <span class="day-box-title">Itinerary Day ${dayCount}</span>
      <button type="button" class="remove-day-btn" onclick="removeItineraryDay(${dayCount})"><i class="fas fa-trash-alt"></i> Remove</button>
    </div>
    <div class="form-grid-2">
      <div class="form-group form-group-full">
        <label class="field-label">Day Title (e.g. Thu, Oct 15 — Flight Departure)</label>
        <input type="text" name="itinerary[title][]" class="field-input day-title-input" placeholder="Day Title & Theme" value="${titleVal}">
      </div>
      <div class="form-group form-group-full">
        <label class="field-label">Flight/Transit Banner (Optional)</label>
        <input type="text" name="itinerary[banner][]" class="field-input day-banner-input" placeholder="e.g. LOT LO72 | Depart Delhi 08:00..." value="${bannerVal}">
      </div>
      <div class="form-group form-group-full">
        <label class="field-label">Day Description & Excursions</label>
        <textarea name="itinerary[description][]" class="field-input day-desc-input" placeholder="Outline activities, visits, and hotels...">${descVal}</textarea>
      </div>
    </div>
  `;
  container.appendChild(dayBox);
}

// Remove Itinerary Day
function removeItineraryDay(id) {
  const element = document.getElementById(`itinerary-day-${id}`);
  if (element) {
    element.remove();
    // Renumber remaining days in list
    const container = document.getElementById('dynamic-itinerary-container');
    if (container) {
      const dayBoxes = container.querySelectorAll('.itinerary-day-box');
      let currentDayIndex = 0;
      dayBoxes.forEach(box => {
        currentDayIndex++;
        box.id = `itinerary-day-${currentDayIndex}`;
        box.querySelector('.day-box-title').textContent = `Itinerary Day ${currentDayIndex}`;
        const removeBtn = box.querySelector('.remove-day-btn');
        removeBtn.setAttribute('onclick', `removeItineraryDay(${currentDayIndex})`);
      });
    }
  }
}

// Auto-fill Sample Data in Editor Form
function loadSampleData() {
  const title = document.getElementById('tour-title');
  if (!title) return; // Exit if not on add-tour form

  title.value = "Poland & Czechia Expedition";
  document.getElementById('tour-subtitle').value = "Warsaw • Krakow • Czestochowa • Wadowice • Wieliczka Salt Mine • Zakopane • Prague • Charles Bridge & Vltava River Cruise";
  document.getElementById('tour-duration').value = "10D / 11N";
  document.getElementById('tour-accommodation').value = "4 & 5 ★ Luxury Hotels";
  document.getElementById('tour-start-date').value = "15 OCT 2026";
  document.getElementById('tour-end-date').value = "25 OCT 2026";

  document.getElementById('price-sharing').value = "349999";
  document.getElementById('price-single').value = "42000";
  document.getElementById('discount-returning').value = "19999";
  document.getElementById('discount-early').value = "9999";

  document.getElementById('inst-deposit').value = "50000";
  document.getElementById('inst-1').value = "90000";
  document.getElementById('inst-2').value = "90000";
  document.getElementById('inst-final').value = "69999";

  document.getElementById('flight1-route').value = "Kolkata to Delhi";
  document.getElementById('flight1-code').value = "IndiGo 6E5190";
  document.getElementById('flight1-baggage').value = "15 kg";
  document.getElementById('flight1-cabin').value = "7 kg";

  document.getElementById('flight2-route').value = "Delhi to Warsaw";
  document.getElementById('flight2-code').value = "Polish Airlines LOT LO72";
  document.getElementById('flight2-baggage').value = "23 kg";
  document.getElementById('flight2-cabin').value = "8 kg";

  document.getElementById('flight3-route').value = "Prague to Delhi";
  document.getElementById('flight3-code').value = "Air Arabia (via Sharjah)";
  document.getElementById('flight3-baggage').value = "23 kg";
  document.getElementById('flight3-cabin').value = "7 kg";

  document.getElementById('tour-inclusions').value = "International LOT & IndiGo return flight ticket.\nChecked baggage allowances up to 23 kg.\nEurope eSIM connection with unlimited local coverage.\nDedicated Tour Director support.";
  document.getElementById('tour-exclusions').value = "Visa application processing fee increments.\nPersonal items such as safe deposits, shopping, laundry.\nStandard travel health insurance coverage policies.";

  document.getElementById('tour-director').value = "Mr. Dale Mogose";
  document.getElementById('tour-director-phone').value = "+91 62890 06014";

  // Clear dynamic itinerary
  const container = document.getElementById('dynamic-itinerary-container');
  if (container) {
    container.innerHTML = '';
    // Add standard days
    addNewItineraryDay("Thu, Oct 15 — Flight Departure", "IndiGo 6E5190 | Depart Kolkata 22:30", "Meet at airport for connection to New Delhi.");
    addNewItineraryDay("Fri, Oct 16 — Delhi to Warsaw & Chopin Concert", "LOT Polish Airlines LO72 | Depart Delhi 08:00", "Arrival at Warsaw. Transfer to standard 4★ hotel. Evening Chopin concert.");
    addNewItineraryDay("Sat, Oct 17 — Warsaw City Tour & Krakow", "", "Guided city drive of Warsaw including Chopin Monument and Old Town Palace grounds.");
  }
}

// Publish Tour Logic
function publishTour() {
  const title = document.getElementById('tour-title');
  if (!title) return;

  const titleVal = title.value.trim();
  if (!titleVal) {
    alert("Please enter at least a Tour Title before saving.");
    switchTab(0);
    title.focus();
    return;
  }

  // Show success modal
  const modalDesc = document.getElementById('publish-modal-desc');
  const successModal = document.getElementById('success-modal');
  if (modalDesc) modalDesc.innerHTML = `Your new tour package <strong>"${titleVal}"</strong> details have been simulated as saved successfully.`;
  if (successModal) successModal.style.display = 'flex';
}

// Close Modal Success
function closeModal() {
  const successModal = document.getElementById('success-modal');
  if (successModal) {
    successModal.style.display = 'none';
  }
}

// Delete Tour Row from Datatable
function deleteTourRow(btn) {
  if (confirm("Are you sure you want to delete this tour package? This action cannot be undone.")) {
    const row = btn.closest('tr');
    if (row) {
      row.style.animation = 'slideOut 0.3s ease forwards';
      setTimeout(() => {
        row.remove();
        updateRowCounter();
      }, 300);
    }
  }
}

// Renumber entries showing count
function updateRowCounter() {
  const rows = document.querySelectorAll('table.admin-table tbody tr');
  const countSpan = document.getElementById('tours-count-display');
  if (countSpan) {
    countSpan.textContent = `Showing ${rows.length} total entries`;
  }
}

// Simulated Edit Action
function editTourAction(tourName) {
  alert(`Simulation: Loading "${tourName}" details into the editor form...`);
  window.location.href = 'add-tour.html';
}


// ==========================================
// AEROVIA SETTINGS AND FAQ LOGIC
// ==========================================

const defaultContact = {
  phone: "+91 62890 06014",
  email: "traletravelsinc@gmail.com",
  address: "127A Park Street, Kolkata - 700016, West Bengal, India",
  fb: "https://www.facebook.com/aeroviaexpeditions",
  linkedin: "https://www.linkedin.com/company/aeroviaexpeditions",
  instagram: "https://www.instagram.com/aeroviaexpeditions",
  whatsapp: "916289006014"
};

const defaultFaqs = [
  { question: "What is included in an Aerovia tour package?", answer: "Our packages include luxury accommodations, private airport transfers, curated guided tours, entry tickets, daily breakfast, and 24/7 concierge assistance." },
  { question: "Can I customize a pre-designed itinerary?", answer: "Absolutely! Every tour package can be tailored to match your specific dates, preferred pace, dietary needs, and hotel upgrades." },
  { question: "How does the 'Pay Now' online payment system work?", answer: "Our secure checkout allows instant credit/debit card, Apple Pay, and wire transfer payments with immediate digital confirmation and itinerary delivery." },
  { question: "What is Aerovia's trip cancellation & refund policy?", answer: "Full refunds are issued for cancellations made 30 days prior to departure. Flexible rescheduling options are available for unforeseen events." },
  { question: "Do you assist with international travel visas?", answer: "Yes, our dedicated visa concierges assist with e-visa applications, invitation letters, document preparation, and embassy appointments worldwide." },
  { question: "Are flights included in the package cost?", answer: "We offer both land-only packages and full flight-inclusive options through our airline partner network at competitive rates." },
  { question: "What size are your group tours?", answer: "We specialize in small-group expeditions (maximum 12–16 travelers) and 100% private tours to guarantee an intimate, premium experience." },
  { question: "Is travel insurance required for booking?", answer: "While optional, we strongly recommend comprehensive travel insurance. We partner with leading global insurers to provide instant coverage." },
  { question: "What support is available during our trip?", answer: "You will have a dedicated local travel manager and a 24/7 WhatsApp concierge helpline for immediate assistance on the ground." },
  { question: "Do you offer corporate or family group discounts?", answer: "Yes, we offer tailored rates and customized perks for corporate groups, custom family gatherings, and groups booking 8 or more guests." }
];

// General settings loader not needed as Laravel renders them directly

function addNewFaqItem(questionVal = '', answerVal = '') {
  const container = document.getElementById('faq-editor-container');
  if (!container) return;

  const index = container.querySelectorAll('.faq-item-box').length;

  const faqBox = document.createElement('div');
  faqBox.className = 'editor-card-item faq-item-box';
  faqBox.innerHTML = `
    <div class="editor-card-header">
      <span class="editor-card-title">FAQ Item</span>
      <button type="button" class="btn-remove-item" onclick="this.closest('.faq-item-box').remove()"><i class="fas fa-trash-alt"></i> Remove</button>
    </div>
    <div class="form-group form-group-full" style="margin-bottom: 0.75rem;">
      <label class="field-label">Question</label>
      <input type="text" name="faqs[${index}][question]" class="field-input faq-question-input" placeholder="Enter FAQ Question..." value="${questionVal}" required>
    </div>
    <div class="form-group form-group-full" style="margin-bottom: 0;">
      <label class="field-label">Answer</label>
      <textarea name="faqs[${index}][answer]" class="field-input faq-answer-input" style="height: 75px;" placeholder="Enter FAQ Answer..." required>${answerVal}</textarea>
    </div>
  `;
  container.appendChild(faqBox);
}

function saveGeneralSettings() {
  const form = document.getElementById('settings-form');
  if (form) {
    // Re-index all FAQ inputs dynamically so array keys are contiguous
    const faqBoxes = form.querySelectorAll('.faq-item-box');
    faqBoxes.forEach((box, idx) => {
      const qInput = box.querySelector('.faq-question-input');
      const aInput = box.querySelector('.faq-answer-input');
      if (qInput) qInput.setAttribute('name', `faqs[${idx}][question]`);
      if (aInput) aInput.setAttribute('name', `faqs[${idx}][answer]`);
    });

    if (form.reportValidity()) {
      form.submit();
    }
  }
}


// ==========================================
// AEROVIA TESTIMONIALS MANAGER LOGIC
// ==========================================

const defaultTestimonials = [
  {
    name: "Sarah Connor",
    role: "Frequent Explorer",
    text: "Aerovia made our trip to Poland & Czechia completely effortless! The custom itinerary was flawless and the tour guide care was exceptional.",
    avatar: "https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fm=webp&fit=crop&w=200&q=80"
  },
  {
    name: "Michael Vance",
    role: "Corporate Traveler",
    text: "Our family tour in Norway was unforgettable. Everything from private fjord cruises to luxury lodging was arranged with deep personal care.",
    avatar: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fm=webp&fit=crop&w=200&q=80"
  },
  {
    name: "David Miller",
    role: "Verified Guest",
    text: "Aerovia's 40+ years heritage shines through in every detail. Their team handled our Schengen visa and flight bookings without a hitch.",
    avatar: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fm=webp&fit=crop&w=200&q=80"
  }
];

// AEROVIA TESTIMONIALS MANAGER LOGIC (Laravel native forms and redirect model)
function updateAvatarPreview(url) {
  const preview = document.getElementById('new-test-avatar-preview');
  if (preview) {
    preview.src = url || '';
    preview.style.display = url ? 'block' : 'none';
  }
}

function handleAvatarFileSelect(input) {
  const file = input.files[0];
  const label = document.getElementById('file-chosen-label');
  if (file) {
    if (label) label.textContent = file.name;
    const url = URL.createObjectURL(file);
    document.getElementById('new-test-avatar-url').value = url;
    updateAvatarPreview(url);
  }
}

function handleAvatarFileSelectForIndex(input, index) {
  const file = input.files[0];
  if (file) {
    const url = URL.createObjectURL(file);
    const textInput = document.getElementById(`scenery-url-${index}`);
    if (textInput) textInput.value = url;
    const preview = document.getElementById(`scenery-preview-${index}`);
    if (preview) preview.src = url;
  }
}

function saveTestimonials() {
  const form = document.getElementById('new-testimonial-form');
  if (form) {
    const nameInput = document.getElementById('new-test-name');
    const textInput = document.getElementById('new-test-text');
    const roleInput = document.getElementById('new-test-role');
    const hasInput = (nameInput && nameInput.value.trim()) || 
                      (textInput && textInput.value.trim()) || 
                      (roleInput && roleInput.value.trim());

    if (hasInput) {
      if (form.reportValidity()) {
        form.submit();
      }
    } else {
      const successModal = document.getElementById('success-modal');
      if (successModal) successModal.style.display = 'flex';
    }
  }
}


// ==========================================
// AEROVIA MULTIPLE SCENERY BANNER LOGIC
// ==========================================

let sceneryList = [];

function loadSceneryItems() {
  sceneryList = window.serverSceneryList || [];
  renderSceneryItems();
}

function renderSceneryItems() {
  const container = document.getElementById('scenery-editor-container');
  if (!container) return;

  container.innerHTML = '';
  sceneryList.forEach((scenery, index) => {
    let previewImg = scenery.image || '';
    if (previewImg && !previewImg.startsWith('http') && !previewImg.startsWith('data:') && !previewImg.startsWith('blob:')) {
      previewImg = '/storage/' + previewImg;
    }
    const card = document.createElement('div');
    card.className = 'editor-card-item scenery-editor-box';
    card.id = `scenery-box-${index}`;
    card.innerHTML = `
      <div class="editor-card-header">
        <span class="editor-card-title">Scenery Card #${index + 1}</span>
        <button type="button" class="btn-remove-item" onclick="removeSceneryItem(${index})"><i class="fas fa-trash-alt"></i> Remove</button>
      </div>
      
      <div class="form-grid-2" style="gap: 0.75rem;">
        <div class="form-group form-group-full">
          <label class="field-label">Scenery Title</label>
          <input type="text" class="field-input scenery-title-input" name="scenery[${index}][title]" placeholder="e.g. Poland & Czechia" value="${scenery.title}">
        </div>
        <div class="form-group form-group-full">
          <label class="field-label">Scenery Subtitle / Route</label>
          <input type="text" class="field-input scenery-subtitle-input" name="scenery[${index}][subtitle]" placeholder="e.g. 10D/11N Expedition" value="${scenery.subtitle}">
        </div>
        <div class="form-group form-group-full">
          <label class="field-label">Scenery Image URL / Upload File</label>
          <div class="media-upload-row">
            <div class="upload-dropzone" style="padding: 0.75rem;" onclick="document.getElementById('scenery-file-input-${index}').click()">
              <i class="fas fa-image" style="font-size: 1.1rem;"></i>
              <span style="font-size: 0.75rem;">Choose File</span>
              <input type="file" id="scenery-file-input-${index}" name="scenery[${index}][file]" class="file-input-hidden" accept="image/*" onchange="handleSceneryFileSelect(this, ${index})">
            </div>
            <div class="preview-container" style="height: 75px; width: 120px; flex-shrink: 0;">
              <img class="preview-media" id="scenery-preview-${index}" src="${previewImg}" alt="Scenery Preview">
            </div>
          </div>
          <input type="text" id="scenery-url-${index}" name="scenery[${index}][image_url]" class="field-input scenery-image-url" style="margin-top: 0.5rem;" placeholder="Or paste image web URL..." value="${scenery.rawUrl || scenery.image}">
        </div>
      </div>
    `;
    container.appendChild(card);
  });
}

function handleSceneryFileSelect(input, index) {
  const file = input.files[0];
  if (file) {
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

    const url = URL.createObjectURL(file);
    const textInput = document.getElementById(`scenery-url-${index}`);
    if (textInput) textInput.value = url;
    const preview = document.getElementById(`scenery-preview-${index}`);
    if (preview) preview.src = url;
  }
}

function addNewSceneryItem(title = '', subtitle = '', image = '', rawUrl = '') {
  // Sync current DOM state first to avoid losing user inputs
  syncSceneryListFromDOM();

  sceneryList.push({
    title: title || 'New Location',
    subtitle: subtitle || 'Adventure Description',
    image: image || '',
    rawUrl: rawUrl
  });

  renderSceneryItems();
}

function removeSceneryItem(index) {
  syncSceneryListFromDOM();
  sceneryList.splice(index, 1);
  renderSceneryItems();
}

function syncSceneryListFromDOM() {
  const boxes = document.querySelectorAll('.scenery-editor-box');
  const list = [];
  boxes.forEach((box, index) => {
    const title = box.querySelector('.scenery-title-input').value.trim();
    const subtitle = box.querySelector('.scenery-subtitle-input').value.trim();
    const imageInput = box.querySelector('.scenery-image-url');
    const image = imageInput ? imageInput.value.trim() : '';
    const rawUrl = image;
    
    // Attempt to retain original URL if present (so we don't break existing db paths)
    const existingObj = sceneryList[index];
    const finalImage = (existingObj && existingObj.image && existingObj.rawUrl === rawUrl) ? existingObj.image : image;

    list.push({ title, subtitle, image: finalImage, rawUrl });
  });
  sceneryList = list;
}

// Save banner details action
function saveBannerAssets() {
  const form = document.getElementById('banner-details-form');
  if (form) {
    // Dynamically re-index all inputs inside scenery-editor-container first
    const sceneryBoxes = form.querySelectorAll('.scenery-editor-box');
    sceneryBoxes.forEach((box, idx) => {
      const titleInput = box.querySelector('.scenery-title-input');
      const subtitleInput = box.querySelector('.scenery-subtitle-input');
      const fileInput = box.querySelector('input[type="file"]');
      const urlInput = box.querySelector('.scenery-image-url');

      if (titleInput) titleInput.setAttribute('name', `scenery[${idx}][title]`);
      if (subtitleInput) subtitleInput.setAttribute('name', `scenery[${idx}][subtitle]`);
      if (fileInput) fileInput.setAttribute('name', `scenery[${idx}][file]`);
      if (urlInput) urlInput.setAttribute('name', `scenery[${idx}][image_url]`);
    });

    if (form.reportValidity()) {
      form.submit();
    }
  }
}
