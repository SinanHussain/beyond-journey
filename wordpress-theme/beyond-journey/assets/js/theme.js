/* Beyond Journey: mobile menu, header shadow, scroll reveal, destination carousel, enquiry forms and popup. */
(function () {
  'use strict';

  var settings = window.bjTheme || {};

  /* ---------- Mobile menu ---------- */
  var menuBtn = document.getElementById('menu-btn');
  var mobileNav = document.getElementById('mobile-nav');

  function setMenu(open) {
    if (!menuBtn || !mobileNav) return;
    mobileNav.classList.toggle('hidden', !open);
    document.getElementById('icon-open').classList.toggle('hidden', open);
    document.getElementById('icon-close').classList.toggle('hidden', !open);
    menuBtn.setAttribute('aria-expanded', String(open));
    menuBtn.setAttribute('aria-label', open ? (settings.closeMenu || 'Close menu') : (settings.openMenu || 'Open menu'));
    document.body.style.overflow = open ? 'hidden' : '';
    syncHeader();
  }

  if (menuBtn && mobileNav) {
    menuBtn.addEventListener('click', function () { setMenu(mobileNav.classList.contains('hidden')); });
    mobileNav.addEventListener('click', function (e) {
      // Sub-list toggles (About, Services, Destinations) open in place
      var toggle = e.target.closest('.m-toggle');
      if (toggle) {
        var open = toggle.getAttribute('aria-expanded') !== 'true';
        toggle.setAttribute('aria-expanded', String(open));
        var list = document.getElementById(toggle.getAttribute('aria-controls'));
        if (list) list.hidden = !open;
        return;
      }
      if (e.target.closest('a')) setMenu(false);
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && !mobileNav.classList.contains('hidden')) setMenu(false);
    });
  }

  /*
   * The header sits over the banner photograph until the page moves, then becomes
   * a white floating bar (.bj-scrolled in theme.css): light wordmark and white links
   * at the top, dark logo and dark links once scrolled or while the phone menu is open.
   */
  var header = document.getElementById('site-header');
  var brandLight = document.getElementById('brand-logo-light');
  var brandDark = document.getElementById('brand-logo');

  function syncHeader() {
    if (!header) return;
    var on = window.scrollY > 20 || (mobileNav && !mobileNav.classList.contains('hidden'));
    header.classList.toggle('bj-scrolled', on);
    if (brandDark) brandDark.classList.toggle('opacity-0', !on);
    if (brandLight) brandLight.classList.toggle('opacity-0', on);
  }
  if (header) {
    window.addEventListener('scroll', syncHeader, { passive: true });
    syncHeader();
  }

  /* ---------- Scroll reveal (content stays visible without JavaScript) ---------- */
  var revealItems = document.querySelectorAll('.aos');
  if ('IntersectionObserver' in window && revealItems.length) {
    var revealObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        var el = entry.target;
        setTimeout(function () { el.classList.add('aos-visible'); }, Number(el.dataset.delay || 0));
        revealObserver.unobserve(el);
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });
    revealItems.forEach(function (el) {
      el.classList.add('aos-hidden');
      revealObserver.observe(el);
    });
  }

  /* ---------- Banner slideshow: the slides crossfade, CSS does the Ken Burns ---------- */
  function initHero(root) {
    var slides = Array.prototype.slice.call(root.querySelectorAll('[data-hero-slide]'));
    if (root.bjHeroTimer) clearInterval(root.bjHeroTimer);
    if (slides.length < 2) return;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    var index = 0;
    root.bjHeroTimer = setInterval(function () {
      index = (index + 1) % slides.length;
      slides.forEach(function (el, i) {
        el.dataset.active = String(i === index);
        el.setAttribute('aria-hidden', String(i !== index));
      });
    }, 6000);
  }

  function initHeroes(root) {
    var sections = [];
    root.querySelectorAll('[data-hero-slide]').forEach(function (slide) {
      var section = slide.closest('section') || slide.parentNode;
      if (section && sections.indexOf(section) === -1) sections.push(section);
    });
    sections.forEach(initHero);
  }
  initHeroes(document);

  /* ---------- Destination cards: a glow swells out from the card before it opens ---------- */
  document.addEventListener('click', function (e) {
    var link = e.target.closest ? e.target.closest('.bloom-card > a') : null;
    if (!link || e.metaKey || e.ctrlKey || e.shiftKey || e.button) return;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    var href = link.getAttribute('href');
    if (!href || link.target) return;
    e.preventDefault();

    var card = link.parentElement;
    var rect = link.getBoundingClientRect();
    link.style.setProperty('--bx', (e.clientX ? e.clientX - rect.left : rect.width / 2) + 'px');
    link.style.setProperty('--by', (e.clientY ? e.clientY - rect.top : rect.height / 2) + 'px');
    card.classList.remove('is-blooming');
    void card.offsetWidth;
    card.classList.add('is-blooming');
    setTimeout(function () { window.location.href = link.href; }, 450);
  });

  /* ---------- Flight route: rescale the path to the section it sits in ---------- */
  var FLIGHT_PTS = [['M', -20, 360], ['C', 20, 300], [120, 280], [260, 268], ['S', 440, 240], [560, 175],
    ['S', 760, 70], [900, 52], ['S', 1100, 30], [1150, 10], ['S', 1240, 5], [1270, 14]];

  function flightPath(w, h) {
    return FLIGHT_PTS.map(function (p) {
      var cmd = typeof p[0] === 'string' ? p[0] : '';
      var x = cmd ? p[1] : p[0];
      var y = cmd ? p[2] : p[1];
      return (cmd ? cmd + ' ' : '') + Math.round(x * w / 1200) + ' ' + Math.round(y * h / 330);
    }).join(' ');
  }

  function fitFlight(root) {
    (root || document).querySelectorAll('.flight-bg').forEach(function (svg) {
      var w = Math.round(svg.clientWidth);
      var h = Math.round(svg.clientHeight);
      if (!w || !h) return;
      var d = flightPath(w, h);
      svg.setAttribute('viewBox', '0 0 ' + w + ' ' + h);
      var route = svg.querySelector('.flight-route');
      var motion = svg.querySelector('animateMotion');
      if (route) route.setAttribute('d', d);
      if (motion) motion.setAttribute('path', d);
    });
  }
  fitFlight(document);
  window.addEventListener('resize', function () { fitFlight(document); });
  window.addEventListener('load', function () { fitFlight(document); });

  /* ---------- Destination carousel ---------- */
  function initCarousel(root) {
    var scroller = root.querySelector('.dest-scroller');
    if (!scroller || scroller.dataset.bjReady) return;
    scroller.dataset.bjReady = '1';
    var cards = Array.prototype.slice.call(scroller.querySelectorAll('[data-dest-card]'));
    var prev = root.querySelector('[data-carousel="prev"]');
    var next = root.querySelector('[data-carousel="next"]');
    var active = 0;
    var frame = 0;

    var syncCarousel = function () {
      // The card sitting flush against the gutter is the active one.
      var pad = parseFloat(getComputedStyle(scroller).paddingLeft) || 0;
      var edge = scroller.getBoundingClientRect().left + pad;
      var best = Infinity;
      cards.forEach(function (card, i) {
        var dist = Math.abs(card.getBoundingClientRect().left - edge);
        if (dist < best) { best = dist; active = i; }
      });
      cards.forEach(function (card, i) { card.dataset.active = String(i === active); });
    };

    var goTo = function (i) {
      var card = cards[Math.max(0, Math.min(i, cards.length - 1))];
      if (!card) return;
      var pad = parseFloat(getComputedStyle(scroller).paddingLeft) || 0;
      var delta = card.getBoundingClientRect().left - scroller.getBoundingClientRect().left - pad;
      scroller.scrollTo({ left: scroller.scrollLeft + delta, behavior: 'smooth' });
    };

    scroller.addEventListener('scroll', function () {
      cancelAnimationFrame(frame);
      frame = requestAnimationFrame(syncCarousel);
    }, { passive: true });
    window.addEventListener('resize', syncCarousel);

    /* Any direct input parks the auto-advance for a few seconds. */
    var holdUntil = 0;
    var hovering = false;
    var hold = function () { holdUntil = Date.now() + 7000; };
    ['pointerdown', 'touchstart', 'wheel', 'keydown', 'focusin'].forEach(function (evt) {
      scroller.addEventListener(evt, hold, { passive: true });
    });
    scroller.addEventListener('mouseenter', function () { hovering = true; });
    scroller.addEventListener('mouseleave', function () { hovering = false; });

    if (prev) prev.addEventListener('click', function () { hold(); goTo(active <= 0 ? cards.length - 1 : active - 1); });
    if (next) next.addEventListener('click', function () { hold(); goTo(active >= cards.length - 1 ? 0 : active + 1); });

    if (scroller.bjTimer) clearInterval(scroller.bjTimer);
    if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
      scroller.bjTimer = setInterval(function () {
        if (hovering || Date.now() < holdUntil) return;
        var atEnd = scroller.scrollLeft >= scroller.scrollWidth - scroller.clientWidth - 8;
        goTo(atEnd ? 0 : active + 1);
      }, 2800);
    }

    syncCarousel();
  }

  document.querySelectorAll('.dest-scroller').forEach(function (scroller) {
    initCarousel(scroller.closest('section') || document);
  });

  // Premium hotels: arrows scroll one card; at either end they wrap round
  function initHotels(root) {
    var track = root.querySelector('.hotels-track');
    if (!track || track.bjHotels) return;
    track.bjHotels = true;
    var step = function () { var card = track.querySelector('.hotel-card'); return (card ? card.getBoundingClientRect().width : track.clientWidth) + 16; };
    var prev = root.querySelector('[data-hotels="prev"]');
    var next = root.querySelector('[data-hotels="next"]');
    if (prev) prev.addEventListener('click', function () {
      track.scrollBy({ left: track.scrollLeft <= 4 ? track.scrollWidth : -step(), behavior: 'smooth' });
    });
    if (next) next.addEventListener('click', function () {
      var atEnd = track.scrollLeft >= track.scrollWidth - track.clientWidth - 4;
      track.scrollBy({ left: atEnd ? -track.scrollWidth : step(), behavior: 'smooth' });
    });
  }
  document.querySelectorAll('.hotels-track').forEach(function (track) {
    initHotels(track.closest('section') || document);
  });

  // Elementor editor: set the carousel up again whenever its widget is re-rendered.
  var hookElementor = function () {
    var hooks = window.elementorFrontend && window.elementorFrontend.hooks;
    if (!hooks || hookElementor.done) return;
    hookElementor.done = true;
    hooks.addAction('frontend/element_ready/bj-destinations.default', function ($scope) {
      if ($scope && $scope[0]) initCarousel($scope[0]);
    });
    hooks.addAction('frontend/element_ready/bj-hotels.default', function ($scope) {
      if ($scope && $scope[0]) initHotels($scope[0]);
    });
    ['bj-hero', 'bj-page-hero'].forEach(function (name) {
      hooks.addAction('frontend/element_ready/' + name + '.default', function ($scope) {
        if ($scope && $scope[0]) initHeroes($scope[0]);
      });
    });
  };
  hookElementor();
  if (window.jQuery) window.jQuery(window).on('elementor/frontend/init', hookElementor);
  window.addEventListener('elementor/frontend/init', hookElementor);

  /* ---------- Enquiry forms (contact section and popup) ---------- */
  function initEnquiryForm(form) {
    var errorBox = form.querySelector('[data-bj-error]');
    var button = form.querySelector('[type="submit"]');

    form.addEventListener('submit', function (e) {
      // Without fetch the form posts normally and the page reloads with the result.
      if (!window.fetch || !window.FormData || !settings.ajaxUrl) return;
      e.preventDefault();

      var page = form.querySelector('input[name="bj_page"]');
      if (page) page.value = window.location.href;
      if (errorBox) { errorBox.hidden = true; errorBox.textContent = ''; }
      if (button) button.disabled = true;

      fetch(settings.ajaxUrl, { method: 'POST', body: new FormData(form), credentials: 'same-origin' })
        .then(function (response) {
          return response.json().catch(function () { return { success: false }; });
        })
        .then(function (result) {
          if (!result || !result.success) {
            throw new Error(result && result.data && result.data.message ? result.data.message : '');
          }
          var hide = form.dataset.hide ? document.querySelector(form.dataset.hide) : form;
          var done = form.dataset.done ? document.querySelector(form.dataset.done) : null;
          if (hide) hide.classList.add('hidden');
          if (done) done.classList.remove('hidden');
          form.reset();
        })
        .catch(function (error) {
          if (!errorBox) return;
          errorBox.textContent = (error && error.message) || settings.errorText || 'Sorry, your enquiry could not be sent.';
          errorBox.hidden = false;
        })
        .then(function () {
          if (button) button.disabled = false;
        });
    });
  }
  document.querySelectorAll('form[data-bj-enquiry]').forEach(initEnquiryForm);

  /* ---------- Photos that move as the page scrolls (About photo, DMC traveller) ---------- */
  function initScrollMotion() {
    if (window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    var ticking = false;
    function update() {
      ticking = false;
      var vh = window.innerHeight;
      document.querySelectorAll('[data-motion]').forEach(function (el) {
        var r = el.getBoundingClientRect();
        if (r.bottom < -200 || r.top > vh + 200) return;
        var p = (vh - r.top) / (vh + r.height);
        el.style.setProperty('--p', Math.max(0, Math.min(1, p)).toFixed(3));
      });
    }
    function onScroll() { if (!ticking) { ticking = true; window.requestAnimationFrame(update); } }
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
    update();
    return update;
  }
  initScrollMotion();

  /* ---------- Construction-style reveal for photos (strips pull away left to right as they scroll into view) ---------- */
  function initBuild(root) {
    if (!('IntersectionObserver' in window)) return;
    if (window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    var targets = (root || document).querySelectorAll('.about-wave, .hotel-card-img, .dest-card .relative.overflow-hidden, .bloom-card .relative.overflow-hidden, .svc-card, .pkg-card, .pkg-tile-img');
    if (!targets.length) return;
    // Strips take the colour of whatever sits behind the photo, so it looks like it is being built in place
    function bgOf(el) {
      for (var n = el.parentElement; n && n !== document.documentElement; n = n.parentElement) {
        var c = getComputedStyle(n).backgroundColor;
        if (c && c !== 'transparent' && c.indexOf('rgba(0, 0, 0, 0)') !== 0) return c;
      }
      return '#ffffff';
    }
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-built');
        io.unobserve(entry.target);
      });
    }, { threshold: 0.2 });
    Array.prototype.forEach.call(targets, function (el) {
      if (el.querySelector(':scope > .build-strips')) return;
      if (getComputedStyle(el).position === 'static') el.style.position = 'relative';
      var strips = document.createElement('div');
      strips.className = 'build-strips';
      strips.setAttribute('aria-hidden', 'true');
      strips.style.setProperty('--build-bg', bgOf(el));
      for (var i = 0; i < 6; i++) {
        var s = document.createElement('i');
        s.style.setProperty('--i', i);
        strips.appendChild(s);
      }
      el.appendChild(strips);
      io.observe(el);
    });
  }
  initBuild(document);

  /* ---------- Packages page showcase ---------- */
  function initPackages(root) {
    var shows = (root || document).querySelectorAll('[data-pkg-show]');
    Array.prototype.forEach.call(shows, function (show) {
      if (show.getAttribute('data-ready')) return;
      show.setAttribute('data-ready', '1');
      var thumbs = show.querySelectorAll('.pkg-thumb');
      var layers = show.querySelectorAll('.pkg-show-layer');
      var dots = show.querySelectorAll('.pkg-rail-dot');
      var track = show.querySelector('.pkg-show-track');
      var fill = show.querySelector('.pkg-nav-fill');
      var copy = show.querySelector('.pkg-show-copy, .pkg-show-text');
      var btn = show.querySelector('.pkg-show-btn');
      var n = thumbs.length;
      var cur = 0;
      var timer = null;
      var scrollWait = null;
      var paused = false;
      if (!n) return;
      var each = function (list, fn) { Array.prototype.forEach.call(list, fn); };
      var set = function (key, value, html) {
        each(show.querySelectorAll('[data-f="' + key + '"]'), function (el) {
          if (html) el.innerHTML = value; else el.textContent = value;
        });
      };
  
      function go(i) {
        i = (i + n) % n;
        if (i === cur) return;
        cur = i;
        var t = thumbs[i];
        each(layers, function (l, j) { l.classList.toggle('is-on', j === i); });
        each(thumbs, function (b, j) { b.setAttribute('aria-pressed', j === i ? 'true' : 'false'); });
        each(dots, function (d, j) { d.setAttribute('aria-current', j === i ? 'true' : 'false'); });
        ['name', 'location', 'summary', 'duration', 'hotel', 'inclusions'].forEach(function (key) { set(key, t.getAttribute('data-' + key) || ''); });
        set('price', t.getAttribute('data-price') || '', true);
        set('prev', thumbs[(i - 1 + n) % n].getAttribute('data-short') || '');
        set('next', thumbs[(i + 1) % n].getAttribute('data-short') || '');
        set('index', (i < 9 ? '0' : '') + (i + 1));
        if (btn) btn.setAttribute('data-enquire', t.getAttribute('data-name') || '');
        var view = show.querySelector('.pkg-show-view');
        if (view) { var url = t.getAttribute('data-url') || ''; view.href = url || '#'; view.hidden = !url; }
        if (fill) fill.style.width = ((i + 1) / n * 100) + '%';
        // Replay the text entrance
        if (copy) {
          copy.classList.remove('pkg-swap');
          void copy.offsetWidth;
          copy.classList.add('pkg-swap');
        }
        // Bring the selected card to the front of the row once the cards have resized
        if (track) {
          clearTimeout(scrollWait);
          scrollWait = setTimeout(function () {
            track.scrollTo({ left: Math.max(0, t.offsetLeft - thumbs[0].offsetLeft), behavior: 'smooth' });
          }, 480);
        }
      }
  
      each(thumbs, function (b, j) { b.addEventListener('click', function () { go(j); restart(); }); });
      each(dots, function (d, j) { d.addEventListener('click', function () { go(j); restart(); }); });
      each(show.querySelectorAll('[data-pkg="prev"]'), function (b) { b.addEventListener('click', function () { go(cur - 1); restart(); }); });
      each(show.querySelectorAll('[data-pkg="next"]'), function (b) { b.addEventListener('click', function () { go(cur + 1); restart(); }); });
      show.addEventListener('keydown', function (e) {
        if (e.key === 'ArrowRight') { go(cur + 1); restart(); }
        if (e.key === 'ArrowLeft') { go(cur - 1); restart(); }
      });
  
      // Moves on by itself every few seconds; hovering or focusing the showcase holds it.
      var still = window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches;
      function restart() {
        if (timer) clearInterval(timer);
        if (still || n < 2) return;
        timer = setInterval(function () {
          if (!show.isConnected) { clearInterval(timer); return; }
          if (!paused && !document.hidden) go(cur + 1);
        }, 6500);
      }
      show.addEventListener('mouseenter', function () { paused = true; });
      show.addEventListener('mouseleave', function () { paused = false; });
      show.addEventListener('focusin', function () { paused = true; });
      show.addEventListener('focusout', function () { paused = false; });
      restart();
    });
  }
  initPackages(document);

  /* ---------- Packages page: country filter ---------- */
  document.querySelectorAll('[data-pkg-filter]').forEach(function (bar) {
    var grid = bar.parentNode.querySelector('[data-pkg-grid]');
    if (!grid) return;
    bar.addEventListener('click', function (e) {
      var btn = e.target.closest ? e.target.closest('[data-filter]') : null;
      if (!btn) return;
      var f = btn.getAttribute('data-filter');
      bar.querySelectorAll('[data-filter]').forEach(function (b) { b.setAttribute('aria-pressed', b === btn ? 'true' : 'false'); });
      grid.querySelectorAll('.pkg-tile').forEach(function (tile) {
        var show = f === 'all' || tile.getAttribute('data-country') === f;
        tile.hidden = !show;
        if (show) {
          tile.classList.remove('aos-hidden');
          tile.classList.add('aos-visible');
          var img = tile.querySelector('.pkg-tile-img');
          if (img) img.classList.add('is-built');
        }
      });
    });
  });

  /* ---------- Enquiry popup: shown once per session, shortly after the page opens ---------- */
  var modal = document.getElementById('enquiry-modal');
  if (modal) {
    var SESSION_KEY = 'bj-enquiry-seen';
    var dialog = document.getElementById('enquiry-dialog');
    var lastFocused = null;

    var openModal = function () {
      lastFocused = document.activeElement;
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      document.body.style.overflow = 'hidden';
      var first = document.getElementById('modal-name');
      if (first) first.focus();
    };

    var closeModal = function () {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      document.body.style.overflow = '';
      if (lastFocused && lastFocused.focus) lastFocused.focus();
    };

    ['enquiry-close', 'enquiry-backdrop', 'enquiry-continue'].forEach(function (id) {
      var el = document.getElementById(id);
      if (el) el.addEventListener('click', closeModal);
    });

    // "Enquire" buttons on the packages open the form with the package name filled in.
    document.addEventListener('click', function (e) {
      var btn = e.target.closest ? e.target.closest('[data-enquire]') : null;
      if (!btn) return;
      var body = document.getElementById('enquiry-body');
      var done = document.getElementById('enquiry-done-modal');
      if (done) done.classList.add('hidden');
      if (body) body.classList.remove('hidden');
      var dest = document.getElementById('modal-destination');
      if (dest) dest.value = btn.getAttribute('data-enquire') || '';
      openModal();
    });

    // The floating button opens the form again, with the thank-you panel reset.
    var floatBtn = document.getElementById('float-enquiry');
    if (floatBtn) {
      floatBtn.addEventListener('click', function () {
        var body = document.getElementById('enquiry-body');
        var done = document.getElementById('enquiry-done-modal');
        if (done) done.classList.add('hidden');
        if (body) body.classList.remove('hidden');
        openModal();
      });
    }

    document.addEventListener('keydown', function (e) {
      if (modal.classList.contains('hidden')) return;
      if (e.key === 'Escape') { closeModal(); return; }
      if (e.key !== 'Tab') return;
      var items = Array.prototype.filter.call(
        dialog.querySelectorAll('button, [href], input, select, textarea, [tabindex]'),
        function (el) { return el.tabIndex >= 0 && !el.disabled && el.offsetParent !== null; }
      );
      if (!items.length) return;
      var firstItem = items[0];
      var lastItem = items[items.length - 1];
      if (e.shiftKey && document.activeElement === firstItem) { e.preventDefault(); lastItem.focus(); }
      else if (!e.shiftKey && document.activeElement === lastItem) { e.preventDefault(); firstItem.focus(); }
    });

    var seen = false;
    try { seen = sessionStorage.getItem(SESSION_KEY) === '1'; } catch (err) { seen = false; }
    // Don't interrupt a visitor who has just sent the contact form.
    if (/[?&]bj_enquiry=/.test(window.location.search)) seen = true;

    if (settings.popup !== false && !seen) {
      setTimeout(function () {
        openModal();
        try { sessionStorage.setItem(SESSION_KEY, '1'); } catch (err) { /* storage unavailable */ }
      }, Number(settings.popupDelay) || 1800);
    }
  }
})();
