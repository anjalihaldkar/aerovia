// Aerovia Interactive & Animation System

document.addEventListener('DOMContentLoaded', () => {

  // --- Theme Toggle Logic ---
  const initTheme = () => {
    const themeToggleBtns = document.querySelectorAll('.theme-toggle-btn');

    const applyTheme = (theme) => {
      if (theme === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
        document.documentElement.classList.add('dark');
        document.documentElement.classList.remove('light');
        try {
          localStorage.setItem('theme', 'dark');
        } catch (e) { }
      } else {
        document.documentElement.setAttribute('data-theme', 'light');
        document.documentElement.classList.add('light');
        document.documentElement.classList.remove('dark');
        try {
          localStorage.setItem('theme', 'light');
        } catch (e) { }
      }

      // Update meta theme-color tag dynamically
      let metaThemeColor = document.querySelector('meta[name="theme-color"]');
      if (!metaThemeColor) {
        metaThemeColor = document.createElement('meta');
        metaThemeColor.name = 'theme-color';
        document.head.appendChild(metaThemeColor);
      }
      metaThemeColor.setAttribute('content', theme === 'dark' ? '#191026' : '#FFFFFF');

      // Update toggler icons
      themeToggleBtns.forEach(btn => {
        const icon = btn.querySelector('i');
        if (icon) {
          icon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        }
      });

      // Force repaint to resolve Safari layout and style recalculation issues with custom properties
      document.documentElement.offsetHeight;
    };

    themeToggleBtns.forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const currentTheme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        applyTheme(newTheme);
      });
    });

    // Detect initial theme
    let activeTheme = 'dark';
    try {
      const savedTheme = localStorage.getItem('theme');
      if (savedTheme) {
        activeTheme = savedTheme;
      } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
        activeTheme = 'light';
      }
    } catch (e) { }

    applyTheme(activeTheme);
  };

  initTheme();

  // 1. Hide Preloader on Window Load
  const preloader = document.getElementById('preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      setTimeout(() => {
        preloader.classList.add('fade-out');
      }, 350);
    });
    // Fallback timeout
    setTimeout(() => {
      preloader.classList.add('fade-out');
    }, 1200);
  }

  // 2. Sticky Navbar Background on Scroll
  const navbar = document.querySelector('.site-navbar');
  if (navbar) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 30) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
  }

  // 3. Multi-Layer High-Performance Parallax Effects
  const heroVideo = document.querySelector('.hero-video-bg');
  const heroImage = document.querySelector('.hero-image-bg');
  const storyImg = document.querySelector('.story-right-img');
  const ctaBanner = document.querySelector('.cta-parallax-banner');
  const ctaBg = document.querySelector('.cta-parallax-bg');

  let lastScrollY = window.scrollY;
  let ticking = false;

  const updateParallax = () => {
    if (heroVideo && lastScrollY < 900) {
      heroVideo.style.transform = `translate3d(0, ${lastScrollY * 0.35}px, 0)`;
    }
    if (heroImage && lastScrollY < 900) {
      heroImage.style.transform = `translate3d(0, ${lastScrollY * 0.3}px, 0)`;
    }

    if (storyImg) {
      const storyTop = storyImg.parentElement.offsetTop;
      if (lastScrollY > storyTop - window.innerHeight && lastScrollY < storyTop + storyImg.parentElement.offsetHeight) {
        const offset = (lastScrollY - (storyTop - window.innerHeight / 2)) * 0.05;
        storyImg.style.transform = `translate3d(0, ${-offset}px, 0)`;
      }
    }

    if (ctaBg && ctaBanner) {
      const ctaTop = ctaBanner.offsetTop;
      if (lastScrollY > ctaTop - window.innerHeight && lastScrollY < ctaTop + ctaBanner.offsetHeight) {
        const offset = (lastScrollY - (ctaTop - window.innerHeight)) * 0.15;
        ctaBg.style.transform = `translate3d(0, ${offset}px, 0)`;
      }
    }

    const homeBg1 = document.querySelector('.home-parallax-bg-1');
    if (homeBg1) {
      const parent = homeBg1.parentElement;
      const parentTop = parent.offsetTop;
      if (lastScrollY > parentTop - window.innerHeight && lastScrollY < parentTop + parent.offsetHeight) {
        const offset = (lastScrollY - (parentTop - window.innerHeight)) * 0.15;
        homeBg1.style.transform = `translate3d(0, ${offset}px, 0)`;
      }
    }

    const homeBg2 = document.querySelector('.home-parallax-bg-2');
    if (homeBg2) {
      const parent = homeBg2.parentElement;
      const parentTop = parent.offsetTop;
      if (lastScrollY > parentTop - window.innerHeight && lastScrollY < parentTop + parent.offsetHeight) {
        const offset = (lastScrollY - (parentTop - window.innerHeight)) * 0.15;
        homeBg2.style.transform = `translate3d(0, ${offset}px, 0)`;
      }
    }

    ticking = false;
  };

  const onScroll = () => {
    lastScrollY = window.scrollY;
    if (!ticking) {
      window.requestAnimationFrame(updateParallax);
      ticking = true;
    }
  };

  if (window.innerWidth > 768) {
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // 4. Animated Stats Counter Effect
  const statNumbers = document.querySelectorAll('.stat-number');
  if (statNumbers.length > 0) {
    const animateStatNumber = (el) => {
      const target = parseInt(el.getAttribute('data-target') || '40', 10);
      const suffix = el.getAttribute('data-suffix') || '+';
      let current = 0;
      const duration = 1600; // ms
      const step = Math.max(1, Math.floor(target / (duration / 20)));

      const timer = setInterval(() => {
        current += step;
        if (current >= target) {
          el.textContent = target + suffix;
          clearInterval(timer);
        } else {
          el.textContent = current + suffix;
        }
      }, 20);
    };

    if ('IntersectionObserver' in window) {
      const statsObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            animateStatNumber(entry.target);
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.4 });

      statNumbers.forEach(num => statsObserver.observe(num));
    } else {
      statNumbers.forEach(num => animateStatNumber(num));
    }
  }

  // 5. Scroll Reveal Card Animations
  const animatableCards = document.querySelectorAll('.animate-card, .plan-card, .masonry-card, .accordion-item');

  if ('IntersectionObserver' in window) {
    const cardObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.15,
      rootMargin: '0px 0px -40px 0px'
    });

    animatableCards.forEach(card => {
      card.classList.add('animate-card');
      cardObserver.observe(card);
    });
  } else {
    animatableCards.forEach(card => card.classList.add('visible'));
  }

  // 6. Back To Top Arrow Click Event & Visibility on Scroll
  const backToTopBtn = document.querySelectorAll('.back-to-top-btn');
  backToTopBtn.forEach(btn => {
    btn.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  });

  const handleBackToTopScroll = () => {
    backToTopBtn.forEach(btn => {
      if (window.scrollY > 300) {
        btn.classList.add('visible');
      } else {
        btn.classList.remove('visible');
      }
    });
  };
  window.addEventListener('scroll', handleBackToTopScroll);
  handleBackToTopScroll(); // run once on load

  // 7. Mobile Menu & Drawer Close Event
  const mobileToggle = document.querySelector('.mobile-toggle-btn');
  const drawerCloseBtn = document.querySelector('.drawer-close-btn');
  const navLinks = document.querySelector('.nav-links');

  if (mobileToggle && navLinks) {
    mobileToggle.addEventListener('click', () => {
      navLinks.classList.toggle('active');
    });
  }

  if (drawerCloseBtn && navLinks) {
    drawerCloseBtn.addEventListener('click', () => {
      navLinks.classList.remove('active');
    });
  }

  // 8. FAQ Accordion Toggle
  const accordionHeaders = document.querySelectorAll('.accordion-header');
  accordionHeaders.forEach(header => {
    header.addEventListener('click', () => {
      const item = header.parentElement;
      const isActive = item.classList.contains('active');

      item.classList.toggle('active');
      const icon = header.querySelector('i');
      if (icon) {
        if (isActive) {
          icon.className = 'fas fa-chevron-down';
        } else {
          icon.className = 'fas fa-chevron-up';
        }
      }
    });
  });

  // 9. Filter Tabs
  const tabBtns = document.querySelectorAll('.tab-btn');
  tabBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      tabBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    });
  });

  // 10. Custom Dropdowns Handling
  const dropdowns = document.querySelectorAll('.custom-dropdown');
  dropdowns.forEach(dropdown => {
    const trigger = dropdown.querySelector('.custom-dropdown-trigger');
    const menu = dropdown.querySelector('.custom-dropdown-menu');
    const selectedText = dropdown.querySelector('.custom-dropdown-selected');
    const hiddenInput = dropdown.querySelector('input[type="hidden"]');
    const items = dropdown.querySelectorAll('.custom-dropdown-item');

    if (!trigger || !menu || !selectedText || !items.length) return;

    const searchInput = dropdown.querySelector('.dropdown-search-input');
    if (searchInput) {
      // Prevent closing menu when clicking search input
      searchInput.addEventListener('click', (e) => {
        e.stopPropagation();
      });

      // Filter items on input
      searchInput.addEventListener('input', (e) => {
        const query = e.target.value.toLowerCase().trim();
        items.forEach(item => {
          const value = item.getAttribute('data-value');
          if (value === "") {
            // Keep placeholder item hidden when searching, visible when search is empty
            item.style.display = query ? 'none' : 'block';
            return;
          }
          const text = item.textContent.toLowerCase();
          if (text.includes(query)) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      });
    }

    // Toggle open
    trigger.addEventListener('click', (e) => {
      e.stopPropagation();

      // Close all other dropdowns
      dropdowns.forEach(other => {
        if (other !== dropdown) {
          other.classList.remove('open');
          const otherField = other.closest('.search-field');
          if (otherField) otherField.classList.remove('active-dropdown');
        }
      });

      const isOpen = dropdown.classList.toggle('open');
      const parentField = dropdown.closest('.search-field');
      if (parentField) {
        if (isOpen) {
          parentField.classList.add('active-dropdown');
          if (searchInput) {
            searchInput.value = '';
            items.forEach(item => item.style.display = 'block');
            setTimeout(() => searchInput.focus(), 50);
          }
        } else {
          parentField.classList.remove('active-dropdown');
        }
      }
    });

    // Select item
    items.forEach(item => {
      item.addEventListener('click', (e) => {
        e.stopPropagation();

        // Clear active classes
        items.forEach(i => i.classList.remove('active'));
        item.classList.add('active');

        const value = item.getAttribute('data-value');
        const text = item.textContent;

        // Update trigger text & value
        selectedText.textContent = text;
        if (hiddenInput) {
          hiddenInput.value = value;
          hiddenInput.dispatchEvent(new Event('change'));
        }

        // Style placeholder if empty value
        if (value === "") {
          selectedText.classList.add('placeholder');
        } else {
          selectedText.classList.remove('placeholder');
        }

        // Close menu
        dropdown.classList.remove('open');
        const parentField = dropdown.closest('.search-field');
        if (parentField) parentField.classList.remove('active-dropdown');

        if (searchInput) {
          searchInput.value = '';
          items.forEach(item => item.style.display = 'block');
        }
      });
    });
  });

  // Close dropdowns when clicking outside
  document.addEventListener('click', () => {
    dropdowns.forEach(dropdown => {
      dropdown.classList.remove('open');
      const parentField = dropdown.closest('.search-field');
      if (parentField) parentField.classList.remove('active-dropdown');

      const searchInput = dropdown.querySelector('.dropdown-search-input');
      const items = dropdown.querySelectorAll('.custom-dropdown-item');
      if (searchInput) {
        searchInput.value = '';
        items.forEach(item => item.style.display = 'block');
      }
    });
  });

  // --- Dynamic User Settings Application ---
  applyCustomUserSettings();

  function applyCustomUserSettings() {
    // 1. Load Contact & Social Settings
    const savedContact = JSON.parse(localStorage.getItem('aerovia_contact_settings'));
    if (savedContact) {
      updateContactTexts(savedContact);
      // updateSocialLinks(savedContact); // Disabled in favor of Laravel database storage
    }

    // 2. Load custom FAQs (Removed localstorage override to let Laravel handle it dynamically)

    // 3. Load custom Testimonials (Disabled in favor of database storage)
    /*
    const customTestimonials = JSON.parse(localStorage.getItem('aerovia_testimonials'));
    if (customTestimonials && customTestimonials.length > 0) {
      const testimonialTrack = Array.from(document.querySelectorAll('.infinite-slider-track')).find(track => track.querySelector('.testimonial-box'));
      if (testimonialTrack) {
        testimonialTrack.innerHTML = '';
        // Render twice for continuous loop
        const itemsToRender = [...customTestimonials, ...customTestimonials];
        itemsToRender.forEach(test => {
          const box = document.createElement('div');
          box.className = 'testimonial-box';
          box.innerHTML = `
            <p class="testimonial-text">"${test.text}"</p>
            <div class="testimonial-profile">
              <img loading="lazy" src="${test.avatar}" alt="${test.name}" class="testimonial-avatar-img" onerror="this.src='https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fm=webp&fit=crop&w=200&q=80'">
              <div class="testimonial-details">
                <h5>${test.name}</h5>
                <p>${test.role}</p>
              </div>
            </div>
          `;
          testimonialTrack.appendChild(box);
        });
      }
    }
    */

    // 4. Load custom Scenery & Landscapes
    const customScenery = JSON.parse(localStorage.getItem('aerovia_scenery'));
    if (customScenery && customScenery.length > 0) {
      const sceneryTrack = Array.from(document.querySelectorAll('.infinite-slider-track')).find(track => track.querySelector('.scenery-card'));
      if (sceneryTrack) {
        sceneryTrack.innerHTML = '';
        // Render twice for continuous loop
        const sceneryItemsToRender = [...customScenery, ...customScenery];
        sceneryItemsToRender.forEach(scenery => {
          const card = document.createElement('a');
          card.className = 'scenery-card';
          card.href = 'tour-description';
          card.innerHTML = `
            <img loading="lazy" src="${scenery.image}" alt="${scenery.title}" onerror="this.src='https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fm=webp&fit=crop&w=800&q=80'">
            <div class="scenery-card-content">
              <h4>${scenery.title}</h4>
              <p>${scenery.subtitle}</p>
            </div>
          `;
          sceneryTrack.appendChild(card);
        });
      }
    }
  }

  function updateSocialLinks(settings) {
    if (settings.fb) {
      document.querySelectorAll('a').forEach(a => {
        if (a.getAttribute('aria-label') === 'Facebook' || a.querySelector('.fa-facebook-f') || a.href.includes('facebook.com')) {
          a.href = settings.fb;
        }
      });
    }
    if (settings.linkedin) {
      document.querySelectorAll('a').forEach(a => {
        if (a.getAttribute('aria-label') === 'LinkedIn' || a.querySelector('.fa-linkedin-in') || a.href.includes('linkedin.com')) {
          a.href = settings.linkedin;
        }
      });
    }
    if (settings.instagram) {
      document.querySelectorAll('a').forEach(a => {
        if (a.getAttribute('aria-label') === 'Instagram' || a.querySelector('.fa-instagram') || a.href.includes('instagram.com')) {
          a.href = settings.instagram;
        }
      });
    }
    if (settings.whatsapp) {
      document.querySelectorAll('a').forEach(a => {
        if (a.getAttribute('aria-label') === 'WhatsApp' || a.querySelector('.fa-whatsapp') || a.href.includes('wa.me')) {
          a.href = `https://wa.me/${settings.whatsapp.replace(/\D/g, '')}`;
        }
      });
    }
  }

  function updateContactTexts(settings) {
    if (settings.phone) {
      document.querySelectorAll('a[href^="tel:"]').forEach(a => {
        a.href = `tel:${settings.phone.replace(/\s+/g, '')}`;
      });
      walkTextNodes(document.body, (node) => {
        if (node.nodeValue.includes('+91 62890 06014')) {
          node.nodeValue = node.nodeValue.replace('+91 62890 06014', settings.phone);
        }
      });
    }
    if (settings.email) {
      document.querySelectorAll('a[href^="mailto:"]').forEach(a => {
        a.href = `mailto:${settings.email}`;
      });
      walkTextNodes(document.body, (node) => {
        if (node.nodeValue.includes('traletravelsinc@gmail.com')) {
          node.nodeValue = node.nodeValue.replace('traletravelsinc@gmail.com', settings.email);
        }
      });
    }
    if (settings.address) {
      walkTextNodes(document.body, (node) => {
        if (node.nodeValue.includes('127A Park Street')) {
          if (node.nodeValue.includes('127A Park Street, Kolkata - 700016, West Bengal, India')) {
            node.nodeValue = node.nodeValue.replace('127A Park Street, Kolkata - 700016, West Bengal, India', settings.address);
          } else if (node.nodeValue.includes('127A Park Street, Kolkata - 700016')) {
            node.nodeValue = node.nodeValue.replace('127A Park Street, Kolkata - 700016', settings.address);
          } else {
            node.nodeValue = node.nodeValue.replace('127A Park Street', settings.address);
          }
        }
      });
    }
  }

  function walkTextNodes(node, callback) {
    if (node.nodeType === Node.TEXT_NODE) {
      callback(node);
    } else if (node.nodeType === Node.ELEMENT_NODE && node.tagName !== 'SCRIPT' && node.tagName !== 'STYLE') {
      for (let child of node.childNodes) {
        walkTextNodes(child, callback);
      }
    }
  }

});
