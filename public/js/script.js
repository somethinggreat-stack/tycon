/* =========================================================
   TYCOON DURO INC. — Interactions
   ========================================================= */
(function () {
  'use strict';

  /* ---------- Lead submit helper (Laravel backend, mailto fallback) ---------- */
  function metaContent(name) {
    var m = document.querySelector('meta[name="' + name + '"]');
    return m ? m.getAttribute('content') : null;
  }
  // Returns true if a backend POST was attempted; calls cb(ok, data).
  function submitLead(payload, cb) {
    var url = metaContent('lead-endpoint');
    if (!url || typeof fetch === 'undefined') { cb(false); return false; }
    fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': metaContent('csrf-token') || ''
      },
      body: JSON.stringify(payload)
    })
      .then(function (r) { return r.ok ? r.json() : Promise.reject(r); })
      .then(function (d) { cb(true, d); })
      .catch(function () { cb(false); });
    return true;
  }

  /* ---------- Year ---------- */
  var yr = document.getElementById('year');
  if (yr) yr.textContent = new Date().getFullYear();

  /* ---------- Nav scroll state + progress + floating CTA ---------- */
  var nav = document.getElementById('nav');
  var progress = document.getElementById('scrollProgress');
  var floating = document.querySelector('.floating-cta');

  function onScroll() {
    var y = window.scrollY || window.pageYOffset;
    var h = document.documentElement.scrollHeight - window.innerHeight;
    if (nav) nav.classList.toggle('scrolled', y > 40);
    if (progress) progress.style.width = (h > 0 ? (y / h) * 100 : 0) + '%';
    if (floating) floating.classList.toggle('show', y > 700);
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  /* ---------- Mobile menu ---------- */
  var toggle = document.getElementById('navToggle');
  var links = document.getElementById('navLinks');
  function closeMenu() {
    if (!links) return;
    links.classList.remove('open');
    toggle.classList.remove('active');
    toggle.setAttribute('aria-expanded', 'false');
  }
  if (toggle && links) {
    toggle.addEventListener('click', function () {
      var open = links.classList.toggle('open');
      toggle.classList.toggle('active', open);
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    links.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', closeMenu);
    });
  }

  /* ---------- Reveal on scroll ---------- */
  var reveals = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) {
          var delay = e.target.getAttribute('data-delay') || 0;
          setTimeout(function () { e.target.classList.add('in'); }, delay);
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
    reveals.forEach(function (el) { io.observe(el); });
  } else {
    reveals.forEach(function (el) { el.classList.add('in'); });
  }

  /* ---------- Count-up stats ---------- */
  var counted = false;
  function animateCounts() {
    if (counted) return;
    var nums = document.querySelectorAll('.stat__num');
    if (!nums.length) return;
    var section = nums[0].closest('.stats');
    var rect = section.getBoundingClientRect();
    if (rect.top < window.innerHeight - 80) {
      counted = true;
      nums.forEach(function (n) {
        var target = parseFloat(n.getAttribute('data-count')) || 0;
        var prefix = n.getAttribute('data-prefix') || '';
        var suffix = n.getAttribute('data-suffix') || '';
        var dur = 1600, start = null;
        function tick(ts) {
          if (!start) start = ts;
          var p = Math.min((ts - start) / dur, 1);
          var eased = 1 - Math.pow(1 - p, 3);
          n.textContent = prefix + Math.round(target * eased) + suffix;
          if (p < 1) requestAnimationFrame(tick);
        }
        requestAnimationFrame(tick);
      });
    }
  }
  window.addEventListener('scroll', animateCounts, { passive: true });
  animateCounts();

  /* ---------- Hero credit-score gauge ---------- */
  (function () {
    var num = document.getElementById('scoreNum');
    var fill = document.querySelector('.gauge-fill');
    if (!num) return;
    var from = 560, to = 812, dur = 1900, GAUGE_LEN = 258;
    var frac = (to - 300) / (850 - 300);           // 300–850 score range
    function run() {
      if (fill) fill.style.strokeDashoffset = GAUGE_LEN * (1 - frac);
      var start = null;
      function tick(ts) {
        if (!start) start = ts;
        var p = Math.min((ts - start) / dur, 1);
        var eased = 1 - Math.pow(1 - p, 3);
        num.textContent = Math.round(from + (to - from) * eased);
        if (p < 1) requestAnimationFrame(tick);
      }
      requestAnimationFrame(tick);
    }
    setTimeout(run, 900);
  })();

  /* ---------- Divisions interactive hub ---------- */
  (function () {
    var hub = document.querySelector('.hub');
    if (!hub) return;
    function select(target) {
      hub.querySelectorAll('.hnode').forEach(function (n) { n.classList.toggle('is-active', n.getAttribute('data-target') === target); });
      hub.querySelectorAll('.hdot').forEach(function (d) { d.classList.toggle('is-active', d.getAttribute('data-target') === target); });
      hub.querySelectorAll('.hpanel').forEach(function (p) { p.classList.toggle('is-active', p.getAttribute('data-panel') === target); });
    }
    // ordered list of panels, e.g. ['pc','bc','fi']
    var order = Array.prototype.map.call(
      hub.querySelectorAll('.hpanel'),
      function (p) { return p.getAttribute('data-panel'); }
    );
    var idx = 0;
    var timer = null;

    function goNext() {
      idx = (idx + 1) % order.length;
      select(order[idx]);
    }
    function start() {
      stop();
      if (order.length > 1) timer = setInterval(goNext, 3000);
    }
    function stop() {
      if (timer) { clearInterval(timer); timer = null; }
    }

    hub.querySelectorAll('[data-target]').forEach(function (el) {
      el.addEventListener('click', function () {
        var target = el.getAttribute('data-target');
        idx = Math.max(0, order.indexOf(target));
        select(target);
        start(); // restart the 3s clock from the card the user picked
      });
    });

    // pause while the visitor is reading, resume when they leave
    hub.addEventListener('mouseenter', stop);
    hub.addEventListener('mouseleave', start);

    start();
  })();

  /* ---------- Timeline scroll-fill ---------- */
  var timeline = document.querySelector('.timeline');
  var tlFill = document.getElementById('tlFill');
  function fillTimeline() {
    if (!timeline || !tlFill) return;
    var r = timeline.getBoundingClientRect();
    var vh = window.innerHeight;
    var start = vh * 0.75;              // begin filling when top passes 75% of viewport
    var total = r.height + start - vh * 0.35;
    var progressed = start - r.top;
    var pct = Math.max(0, Math.min(1, progressed / total));
    tlFill.style.height = (pct * 100) + '%';
  }
  window.addEventListener('scroll', fillTimeline, { passive: true });
  window.addEventListener('resize', fillTimeline);
  fillTimeline();

  /* ---------- Cursor glow (desktop, fine pointer only) ---------- */
  var glow = document.getElementById('cursorGlow');
  if (glow && window.matchMedia('(pointer:fine)').matches) {
    var gx = 0, gy = 0, cx = 0, cy = 0;
    window.addEventListener('mousemove', function (e) {
      gx = e.clientX; gy = e.clientY; glow.style.opacity = '1';
    });
    (function render() {
      cx += (gx - cx) * 0.12; cy += (gy - cy) * 0.12;
      glow.style.transform = 'translate(' + cx + 'px,' + cy + 'px) translate(-50%,-50%)';
      requestAnimationFrame(render);
    })();
  }

  /* ---------- Hero parallax on portal ---------- */
  var figure = document.querySelector('.hero__portal');
  if (figure && window.matchMedia('(pointer:fine)').matches) {
    var hero = document.querySelector('.hero');
    var pFloat = [
      { el: figure.querySelector('.score-card'), d: 30 },
      { el: figure.querySelector('.approved-chip'), d: 24 },
      { el: figure.querySelector('.hero__portal-ring'), d: 12 }
    ];
    hero.addEventListener('mousemove', function (e) {
      var r = hero.getBoundingClientRect();
      var dx = (e.clientX - r.left) / r.width - 0.5;
      var dy = (e.clientY - r.top) / r.height - 0.5;
      pFloat.forEach(function (p) {
        if (p.el) p.el.style.transform = 'translate(' + dx * p.d + 'px,' + dy * p.d + 'px)';
      });
    });
    hero.addEventListener('mouseleave', function () {
      pFloat.forEach(function (p) { if (p.el) p.el.style.transform = ''; });
    });
  }

  /* ---------- Back to top ---------- */
  var toTop = document.getElementById('toTop');
  if (toTop) {
    window.addEventListener('scroll', function () {
      toTop.classList.toggle('show', (window.scrollY || 0) > 900);
    }, { passive: true });
    toTop.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* ---------- Magnetic gold buttons (desktop) ---------- */
  if (window.matchMedia('(pointer:fine)').matches) {
    document.querySelectorAll('.btn--gold, .nav__cta, .floating-cta').forEach(function (el) {
      el.addEventListener('mousemove', function (e) {
        var r = el.getBoundingClientRect();
        var mx = e.clientX - r.left - r.width / 2;
        var my = e.clientY - r.top - r.height / 2;
        el.style.transform = 'translate(' + mx * 0.18 + 'px,' + my * 0.28 + 'px)';
      });
      el.addEventListener('mouseleave', function () { el.style.transform = ''; });
    });
  }

  /* ---------- Premium welcome popup ---------- */
  (function () {
    var modal = document.getElementById('welcomeModal');
    if (!modal) return;
    var openTimer;
    function openModal() {
      modal.classList.add('open');
      modal.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
    }
    function closeModal() {
      modal.classList.remove('open');
      modal.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }
    // show once per browser session, ~4.5s after load
    try {
      if (!sessionStorage.getItem('tdModalSeen')) {
        openTimer = setTimeout(function () {
          openModal();
          sessionStorage.setItem('tdModalSeen', '1');
        }, 4500);
      }
    } catch (e) {
      openTimer = setTimeout(openModal, 4500);
    }
    // close triggers
    modal.querySelectorAll('[data-close]').forEach(function (el) {
      el.addEventListener('click', closeModal);
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && modal.classList.contains('open')) closeModal();
    });
    // let any element opt-in to open it (e.g., future buttons)
    document.querySelectorAll('[data-open-modal]').forEach(function (el) {
      el.addEventListener('click', function (e) { e.preventDefault(); clearTimeout(openTimer); openModal(); });
    });

    /* ----- Multi-step quiz ----- */
    var quiz = document.getElementById('quiz');
    if (quiz) {
      var stepEls = quiz.querySelectorAll('.quiz__step');
      var quizLabel = document.getElementById('quizLabel');
      var quizBar = document.getElementById('quizBar');
      var quizBack = document.getElementById('quizBack');
      var quizChips = document.getElementById('quizChips');
      var quizForm = document.getElementById('quizForm');
      var quizNote = document.getElementById('quizNote');
      var TOTAL = 5, current = 1, answers = [];
      var labels = [
        'Step 1 of 5 · Free Analysis', 'Step 2 of 5 · Free Analysis',
        'Step 3 of 5 · Free Analysis', 'Step 4 of 5 · Free Analysis', 'Step 5 of 5 · Almost Done'
      ];
      function esc(s) { return String(s).replace(/[&<>"]/g, function (c) { return { '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;' }[c]; }); }
      function renderChips() {
        quizChips.innerHTML = answers.filter(Boolean).map(function (a) {
          return '<span>' + a.emoji + ' ' + esc(a.label) + '</span>';
        }).join('');
      }
      function goTo(n) {
        current = n;
        stepEls.forEach(function (s) { s.classList.toggle('is-active', parseInt(s.getAttribute('data-step'), 10) === n); });
        quizLabel.textContent = labels[n - 1];
        quizBar.style.width = (n / TOTAL * 100) + '%';
        quizBack.hidden = (n === 1);
        if (n === TOTAL) renderChips();
      }
      quiz.querySelectorAll('.quiz__opt').forEach(function (opt) {
        opt.addEventListener('click', function () {
          var idx = parseInt(opt.closest('.quiz__step').getAttribute('data-step'), 10);
          answers[idx - 1] = { emoji: opt.getAttribute('data-emoji'), label: opt.getAttribute('data-label') };
          goTo(Math.min(idx + 1, TOTAL));
        });
      });
      quizBack.addEventListener('click', function () { if (current > 1) goTo(current - 1); });

      if (quizForm) {
        quizForm.addEventListener('submit', function (e) {
          e.preventDefault();
          var name = (document.getElementById('qName').value || '').trim();
          var email = (document.getElementById('qEmail').value || '').trim();
          var phone = (document.getElementById('qPhone').value || '').trim();
          if (!name || !phone || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            quizNote.textContent = 'Please complete your name, valid email, and phone.';
            return;
          }
          quizNote.textContent = 'Perfect — preparing your free analysis…';
          var qLabels = ['Biggest challenge', 'Score range', 'Negative items', 'Main goal'];
          var profile = {};
          answers.filter(Boolean).forEach(function (a, i) { profile[qLabels[i] || ('q' + i)] = a.label; });

          var sent = submitLead(
            { name: name, email: email, phone: phone, source: 'quiz', interest: profile['Main goal'] || '', profile: profile },
            function (ok, d) {
              if (ok) {
                quizNote.textContent = (d && d.message) || 'Thank you — your free analysis is on the way!';
                setTimeout(closeModal, 1800);
              } else {
                mailtoFallback();
              }
            }
          );
          function mailtoFallback() {
            var lines = answers.filter(Boolean).map(function (a, i) { return (qLabels[i] || 'Answer') + ': ' + a.label; });
            var subject = encodeURIComponent('Free Credit Analysis Request — ' + name);
            var body = encodeURIComponent('Name: ' + name + '\nEmail: ' + email + '\nPhone: ' + phone + '\n\n--- Credit Profile ---\n' + lines.join('\n'));
            window.location.href = 'mailto:Capital@tycoonduro.com?subject=' + subject + '&body=' + body;
            setTimeout(closeModal, 1400);
          }
          if (!sent) mailtoFallback();
        });
      }
    }
  })();

  /* ---------- Contact form (front-end demo handler) ---------- */
  var form = document.getElementById('contactForm');
  var note = document.getElementById('formNote');
  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var name = form.name.value.trim();
      var email = form.email.value.trim();
      var interest = form.interest.value;
      var phone = form.phone ? form.phone.value.trim() : '';
      var source = form.getAttribute('data-source') || 'contact';
      if (!name || !email || !interest) {
        note.textContent = 'Please complete your name, email, and focus area.';
        note.style.color = '#E6C458';
        return;
      }
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        note.textContent = 'Please enter a valid email address.';
        return;
      }
      var msg = form.message.value.trim();
      note.style.color = '#C9A227';
      note.textContent = 'Sending your request…';

      function mailtoFallback() {
        var subject = encodeURIComponent('Strategy Call Request — ' + name);
        var body = encodeURIComponent('Name: ' + name + '\nEmail: ' + email + '\nPhone: ' + phone + '\nFocus: ' + interest + '\n\n' + msg);
        note.textContent = 'Opening your email to send securely…';
        window.location.href = 'mailto:Capital@tycoonduro.com?subject=' + subject + '&body=' + body;
        form.reset();
      }

      var sent = submitLead(
        { name: name, email: email, phone: phone, source: source, interest: interest, message: msg },
        function (ok, d) {
          if (ok) {
            note.textContent = (d && d.message) || 'Thank you — our team will reach out shortly.';
            form.reset();
          } else {
            mailtoFallback();
          }
        }
      );
      if (!sent) mailtoFallback();
    });
  }

  /* ---------- Premium multi-step lead form (division pages) ---------- */
  document.querySelectorAll('[data-leadform]').forEach(function (lf) {
    var steps = lf.querySelectorAll('.quiz__step');
    var bar = lf.querySelector('.leadform__bar');
    var label = lf.querySelector('.leadform__label');
    var back = lf.querySelector('.leadform__back');
    var interest = lf.querySelector('input[name="interest"]');
    var chip = lf.querySelector('[data-leadchip]');
    var total = steps.length;

    function go(n) {
      steps.forEach(function (s) { s.classList.toggle('is-active', Number(s.getAttribute('data-step')) === n); });
      if (bar) bar.style.width = Math.round((n / total) * 100) + '%';
      if (label) label.textContent = 'Step ' + n + ' of ' + total + (n === 1 ? ' · Your Goal' : ' · Your Details');
      if (back) back.hidden = n === 1;
      var active = lf.querySelector('.quiz__step.is-active input');
      if (n > 1 && active) { try { active.focus(); } catch (e) {} }
    }

    lf.querySelectorAll('.leadform__opt').forEach(function (opt) {
      opt.addEventListener('click', function () {
        var val = opt.getAttribute('data-value');
        if (interest) interest.value = val;
        if (chip) chip.textContent = val;
        go(2);
      });
    });
    if (back) back.addEventListener('click', function () { go(1); });
  });

  /* ---------- FAQ accordion ---------- */
  var faqItems = document.querySelectorAll('.faq__item');
  faqItems.forEach(function (item) {
    var btn = item.querySelector('.faq__q');
    if (!btn) return;
    btn.addEventListener('click', function () {
      var isOpen = item.classList.contains('open');
      // close all, then open the clicked one (single-open accordion)
      faqItems.forEach(function (other) {
        other.classList.remove('open');
        var b = other.querySelector('.faq__q');
        if (b) b.setAttribute('aria-expanded', 'false');
      });
      if (!isOpen) {
        item.classList.add('open');
        btn.setAttribute('aria-expanded', 'true');
      }
    });
  });
})();
