/**
 * Chritsch 2026 – App JS
 * Vanilla ES6+, no jQuery, no build step
 */

'use strict';

/* ==========================================================================
   Utils
   ========================================================================== */
const Utils = (() => {
  async function fetchJSON(url) {
    const res = await fetch(url);
    if (!res.ok) throw new Error(`HTTP ${res.status}`);
    return res.json();
  }

  function formatDateDE(isoDate) {
    if (!isoDate || isoDate === '0000-00-00') return '';
    const parts = isoDate.split('-');
    if (parts.length !== 3) return isoDate;
    return `${parts[2].padStart(2,'0')}.${parts[1].padStart(2,'0')}.${parts[0]}`;
  }

  function escapeHTML(str) {
    if (!str) return '';
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  function nl2br(str) {
    return escapeHTML(str).replace(/\n/g, '<br>');
  }

  return { fetchJSON, formatDateDE, escapeHTML, nl2br };
})();

/* ==========================================================================
   Nav – fixed transparent → solid, hamburger
   ========================================================================== */
const Nav = (() => {
  function init() {
    const nav    = document.querySelector('.main-nav');
    const toggle = document.querySelector('.nav-toggle');
    const menu   = document.querySelector('.nav-menu');

    if (!nav) return;

    // Platzhalter verhindert Sprung wenn Nav fixiert wird
    const placeholder = document.createElement('div');
    placeholder.className = 'nav-placeholder';
    nav.parentNode.insertBefore(placeholder, nav);

    // Einmalig die natürliche Position der Nav im Dokument merken
    const navOffsetTop = nav.offsetTop;

    const onScroll = () => {
      const shouldFix = window.scrollY >= navOffsetTop;
      nav.classList.toggle('is-scrolled', shouldFix);
      placeholder.style.display = shouldFix ? 'block' : 'none';
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // Hamburger toggle
    if (toggle && menu) {
      toggle.addEventListener('click', () => {
        menu.classList.toggle('is-open');
        toggle.setAttribute('aria-expanded', menu.classList.contains('is-open'));
      });
    }

    // Close on nav link click (mobile)
    document.querySelectorAll('.nav-menu a').forEach(link => {
      link.addEventListener('click', () => {
        menu && menu.classList.remove('is-open');
      });
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', e => {
        const id = anchor.getAttribute('href');
        if (id === '#') return;
        const target = document.querySelector(id);
        if (target) {
          e.preventDefault();
          const offset = parseInt(getComputedStyle(document.documentElement)
            .getPropertyValue('--nav-height')) || 72;
          const top = target.getBoundingClientRect().top + window.scrollY - offset;
          window.scrollTo({ top, behavior: 'smooth' });
        }
      });
    });
  }

  return { init };
})();

/* ==========================================================================
   Slider – fetch API, pointer-event swipe, autoplay
   ========================================================================== */
const Slider = (() => {
  let slides = [];
  let current = 0;
  let autoplayTimer = null;

  function init() {
    const container = document.getElementById('slider-container');
    if (!container) return;

    Utils.fetchJSON('api/slider.php')
      .then(json => {
        if (!json.success || !json.data || !json.data.length) {
          container.innerHTML = buildFallback();
          return;
        }
        buildSlider(container, json.data);
      })
      .catch(() => {
        container.innerHTML = buildFallback();
      });
  }

  function buildFallback() {
    return `<div class="slide is-active" style="background-image:url(images/features-bg.jpg)">
      <div class="slide-overlay">
        <div class="slide-caption">
          <img class="logo-hero" src="images/logo1.png" alt="Chritsch Logo">
          <h2>ABENTEUER <span>OUTDOOR</span></h2>
        </div>
      </div>
    </div>`;
  }

  function buildSlider(container, data) {
    const slidesHTML = data.map((item, i) =>
      `<div class="slide${i === 0 ? ' is-active' : ''}"
            style="background-image:url(images/slider/${Utils.escapeHTML(item.bilder)})"
            data-index="${i}">
        <div class="slide-overlay">
          <a class="slide-caption" href="#services">
            <img class="logo-hero" src="images/logo1.png" alt="Chritsch Logo">
            <h1>${Utils.escapeHTML(item.titel)}</h1>
            <h2>ABENTEUER <span>OUTDOOR</span></h2>
          </a>
        </div>
      </div>`
    ).join('');

    // Dots
    const dotsHTML = data.map((_, i) =>
      `<button class="slider-dot${i === 0 ? ' is-active' : ''}" data-index="${i}" aria-label="Slide ${i+1}"></button>`
    ).join('');

    container.innerHTML = slidesHTML;

    // Add dots
    const dotsContainer = document.querySelector('.slider-dots');
    if (dotsContainer) dotsContainer.innerHTML = dotsHTML;

    slides = container.querySelectorAll('.slide');
    current = 0;

    // Controls
    document.querySelector('.slider-control--prev')
      ?.addEventListener('click', () => moveTo(current - 1));
    document.querySelector('.slider-control--next')
      ?.addEventListener('click', () => moveTo(current + 1));

    // Dots
    document.querySelectorAll('.slider-dot').forEach(dot => {
      dot.addEventListener('click', () => moveTo(parseInt(dot.dataset.index)));
    });

    // Swipe
    let startX = 0;
    container.addEventListener('pointerdown', e => { startX = e.clientX; });
    container.addEventListener('pointerup', e => {
      const diff = startX - e.clientX;
      if (Math.abs(diff) > 50) moveTo(current + (diff > 0 ? 1 : -1));
    });

    startAutoplay();
  }

  function moveTo(idx) {
    if (!slides.length) return;
    const total = slides.length;
    const next = ((idx % total) + total) % total;

    slides[current].classList.remove('is-active');
    document.querySelectorAll('.slider-dot')[current]?.classList.remove('is-active');

    current = next;
    slides[current].classList.add('is-active');
    document.querySelectorAll('.slider-dot')[current]?.classList.add('is-active');

    resetAutoplay();
  }

  function startAutoplay() {
    autoplayTimer = setInterval(() => moveTo(current + 1), 5500);
  }

  function resetAutoplay() {
    clearInterval(autoplayTimer);
    startAutoplay();
  }

  return { init };
})();

/* ==========================================================================
   Reveal – IntersectionObserver (replaces WOW.js)
   ========================================================================== */
const Reveal = (() => {
  function init() {
    const elements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
    if (!elements.length) return;

    if (!('IntersectionObserver' in window)) {
      elements.forEach(el => el.classList.add('is-visible'));
      return;
    }

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    elements.forEach(el => observer.observe(el));
  }

  return { init };
})();

/* ==========================================================================
   Blog – fetch /api/blog.php with pagination
   ========================================================================== */
const Blog = (() => {
  let page = 1;
  const limit = 3;
  let totalPages = 1;
  let loading = false;

  function init() {
    const grid = document.getElementById('blog-grid');
    const loadMoreBtn = document.getElementById('btn-load-more');
    if (!grid) return;

    loadPage(grid, loadMoreBtn);

    loadMoreBtn?.addEventListener('click', () => {
      if (!loading && page <= totalPages) {
        loadPage(grid, loadMoreBtn);
      }
    });
  }

  async function loadPage(grid, btn) {
    if (loading) return;
    loading = true;
    if (btn) btn.disabled = true;

    try {
      const json = await Utils.fetchJSON(`api/blog.php?page=${page}&limit=${limit}`);
      if (!json.success) throw new Error('API error');

      totalPages = json.totalPages ?? 1;

      // Spinner beim ersten Load entfernen
      if (page === 1) grid.innerHTML = '';

      json.data.forEach((post, i) => {
        const card = createCard(post, i);
        grid.appendChild(card);
        // Trigger reveal after append
        requestAnimationFrame(() => card.classList.add('is-visible'));
      });

      page++;

      if (btn) {
        btn.disabled = false;
        btn.style.display = page > totalPages ? 'none' : '';
      }
    } catch(e) {
      if (btn) btn.disabled = false;
    }

    loading = false;
  }

  function createCard(post, i) {
    const card = document.createElement('div');
    card.className = 'blog-card reveal';
    card.style.transitionDelay = `${i * 0.1}s`;

    let mediaHTML;
    if (post.video) {
      mediaHTML = `<div class="blog-card__media">
        <iframe src="https://www.youtube.com/embed/${Utils.escapeHTML(post.video)}?rel=0&controls=0&showinfo=0" allowfullscreen loading="lazy"></iframe>
      </div>`;
    } else {
      mediaHTML = `<div class="blog-card__media">
        <img src="images/blog/${Utils.escapeHTML(post.bilder)}" alt="${Utils.escapeHTML(post.titel)}" loading="lazy">
      </div>`;
    }

    const galleryHTML = post.link
      ? `<a href="${Utils.escapeHTML(post.link)}" target="_blank" rel="noopener" class="blog-card__gallery-link">
           <i class="fa fa-camera"></i> Fotogalerie ansehen
         </a>`
      : '';

    card.innerHTML = `${mediaHTML}
      <div class="blog-card__body">
        <div class="blog-card__date">${Utils.escapeHTML(post.datum_de)}</div>
        <h3>${Utils.escapeHTML(post.titel)}</h3>
        <p>${Utils.escapeHTML((post.artikel || '').replace(/<[^>]*>/g,'').substring(0, 140))}${(post.artikel||'').length > 140 ? '…' : ''}</p>
        ${galleryHTML}
      </div>`;

    return card;
  }

  return { init };
})();

/* ==========================================================================
   Events – fetch /api/events.php
   ========================================================================== */
const Events = (() => {
  function init() {
    const grid = document.getElementById('events-grid');
    if (!grid) return;

    Utils.fetchJSON('api/events.php')
      .then(json => {
        if (!json.success) throw new Error('API error');

        grid.innerHTML = '';

        if (!json.data || json.data.length === 0) {
          // Hide calendar section and nav item
          document.getElementById('calendar')?.classList.add('is-hidden');
          document.getElementById('nav-calendar')?.classList.add('is-hidden');
          return;
        }

        json.data.forEach((event, i) => {
          const card = createCard(event, i);
          grid.appendChild(card);
          requestAnimationFrame(() => card.classList.add('is-visible'));
        });
      })
      .catch(() => {
        document.getElementById('calendar')?.classList.add('is-hidden');
        document.getElementById('nav-calendar')?.classList.add('is-hidden');
      });
  }

  function createCard(event, i) {
    const card = document.createElement('div');
    card.className = 'event-card reveal';
    card.style.transitionDelay = `${i * 0.08}s`;

    const nd = event.next_date;
    const dateHTML = nd
      ? `<div class="event-card__date">
           <div class="day">${Utils.escapeHTML(nd.tag || '')}</div>
           <div class="termin">${Utils.escapeHTML(nd.termin || '')}</div>
         </div>`
      : '';

    const treffpunktHTML = event.treffpunkt
      ? `<div class="treffpunkt"><i class="fa fa-map-marker"></i> ${Utils.escapeHTML(event.treffpunkt)}</div>`
      : '';

    let moreDatesHTML = '';
    if (event.all_dates && event.all_dates.length > 0) {
      const items = event.all_dates.map(d =>
        `<li>${Utils.escapeHTML(d.termin)}${d.tag ? ', ' + Utils.escapeHTML(d.tag) : ''}</li>`
      ).join('');
      moreDatesHTML = `<div class="event-card__more-dates">
        <strong>Weitere Termine:</strong>
        <ul>${items}</ul>
      </div>`;
    }

    card.innerHTML = `
      ${dateHTML}
      <div class="event-card__icon"><i class="${Utils.escapeHTML(event.icon || 'fa fa-calendar')}"></i></div>
      <h4>${Utils.escapeHTML(event.titel)}</h4>
      ${treffpunktHTML}
      <p>${Utils.escapeHTML((event.beschreibung||'').replace(/<[^>]*>/g,''))}</p>
      ${moreDatesHTML}
      <a href="anmeldeformular.php?id=${Utils.escapeHTML(String(event.id))}" target="_blank" class="btn btn-primary" style="text-align:center; display:block">
        Online anmelden
      </a>`;

    return card;
  }

  return { init };
})();

/* ==========================================================================
   Portfolio – fetch /api/portfolio.php + CSS filter (no Isotope)
   ========================================================================== */
const Portfolio = (() => {
  let allItems = [];
  let currentFilter = 'all';

  function init() {
    const grid = document.getElementById('portfolio-grid');
    if (!grid) return;

    currentFilter = 'all';

    Utils.fetchJSON('api/portfolio.php')
      .then(json => {
        if (!json.success) return;
        allItems = json.data;
        render(grid);
        setActiveFilter(currentFilter);
        applyFilter(currentFilter);
      });

    // Filter buttons
    document.querySelectorAll('.portfolio-filter-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const kat = btn.dataset.filter;
        currentFilter = kat;
        setActiveFilter(kat);
        applyFilter(kat);
      });
    });
  }

  function render(grid) {
    grid.innerHTML = '';
    allItems.forEach((item, i) => {
      const el = document.createElement('div');
      el.className = `portfolio-item reveal reveal-delay-${(i % 3) + 1}`;
      el.dataset.kategorie = item.kategorie || '';

      el.innerHTML = `
        <img src="images/portfolio/${Utils.escapeHTML(item.bilder)}" alt="${Utils.escapeHTML(item.titel)}" loading="lazy">
        <div class="portfolio-item__overlay">
          <h3>${Utils.escapeHTML(item.titel)}</h3>
          <p>${Utils.escapeHTML((item.beschreibung||'').replace(/<[^>]*>/g,''))}</p>
          <button class="btn btn-outline" onclick="ContactForm.prefill('${Utils.escapeHTML(item.titel).replace(/'/g,"\\'")}')">
            Anfrage senden
          </button>
        </div>`;

      grid.appendChild(el);
    });

    // Trigger reveal observer for new items
    Reveal.init();
  }

  function applyFilter(kat) {
    document.querySelectorAll('.portfolio-item').forEach(item => {
      item.classList.toggle('is-hidden',
        kat !== 'all' && item.dataset.kategorie !== kat
      );
    });
  }

  function setActiveFilter(kat) {
    document.querySelectorAll('.portfolio-filter-btn').forEach(btn => {
      btn.classList.toggle('is-active', btn.dataset.filter === kat);
    });
  }

  return { init };
})();

/* ==========================================================================
   ContactForm – JSON submit (no redirect)
   ========================================================================== */
const ContactForm = (() => {
  function init() {
    const form = document.getElementById('contact-form');
    if (!form) return;

    form.addEventListener('submit', async e => {
      e.preventDefault();
      const btn    = form.querySelector('[type="submit"]');
      const status = document.getElementById('form-status');

      if (status) { status.className = 'form-status'; status.textContent = ''; }
      btn.disabled = true;
      btn.textContent = 'Wird gesendet…';

      const data = {
        name:    form.querySelector('[name="name"]').value,
        email:   form.querySelector('[name="email"]').value,
        subject: form.querySelector('[name="subject"]').value,
        message: form.querySelector('[name="message"]').value,
      };

      try {
        const res = await fetch('api/contact.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(data),
        });
        const json = await res.json();

        if (json.success) {
          if (status) {
            status.className = 'form-status is-success';
            status.textContent = json.message || 'Danke! Deine Nachricht wurde gesendet.';
          }
          form.reset();
        } else {
          if (status) {
            status.className = 'form-status is-error';
            status.textContent = json.error || 'Ein Fehler ist aufgetreten.';
          }
        }
      } catch(err) {
        if (status) {
          status.className = 'form-status is-error';
          status.textContent = 'Verbindungsfehler. Bitte versuche es erneut.';
        }
      }

      btn.disabled = false;
      btn.textContent = 'Abschicken';
    });
  }

  function prefill(subject) {
    const subjectField = document.getElementById('betreff');
    if (subjectField) subjectField.value = 'Anfrage ' + subject;
    window.location.href = '#contact';
  }

  return { init, prefill };
})();

/* ==========================================================================
   Lightbox – vanilla, keyboard + click-outside to close
   ========================================================================== */
const Lightbox = (() => {
  let overlay, img, caption;

  function build() {
    overlay = document.createElement('div');
    overlay.id = 'lightbox';
    overlay.innerHTML = `
      <button class="lb-close" aria-label="Schließen">&times;</button>
      <div class="lb-img-wrap"><img class="lb-img" alt=""></div>
      <div class="lb-caption"></div>`;
    document.body.appendChild(overlay);

    img     = overlay.querySelector('.lb-img');
    caption = overlay.querySelector('.lb-caption');

    overlay.addEventListener('click', e => {
      if (e.target === overlay || e.target.classList.contains('lb-close')) close();
    });
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape') close();
    });
  }

  function open(src, alt) {
    if (!overlay) build();
    img.src = src;
    img.alt = alt || '';
    caption.textContent = alt || '';
    overlay.classList.add('is-open');
    document.body.style.overflow = 'hidden';
  }

  function close() {
    overlay.classList.remove('is-open');
    document.body.style.overflow = '';
  }

  function init() {
    // Lightbox-Trigger hier bei Bedarf ergänzen
  }

  return { init, open };
})();

/* ==========================================================================
   Bootstrap all modules on DOMContentLoaded
   ========================================================================== */
document.addEventListener('DOMContentLoaded', () => {
  Nav.init();
  Slider.init();
  Reveal.init();
  Blog.init();
  Events.init();
  Portfolio.init();
  ContactForm.init();
  Lightbox.init();

  document.querySelectorAll('.usp-card video.usp-card__bg').forEach(video => {
    const card = video.closest('.usp-card');
    card.addEventListener('mouseenter', () => video.play());
    card.addEventListener('mouseleave', () => { video.pause(); video.currentTime = 0; });
  });
});
