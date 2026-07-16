<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="lead-endpoint" content="{{ route('lead.store') }}" />
  <title>Tycoon Duro Inc. — God-Level Wealth Strategy | Trust the Horse</title>
  <meta name="description" content="Tycoon Duro Inc. — Elite credit mastery, business capital acquisition, and asset protection. Founded by Stanley Durosier. Strategic. Precise. God-Level. Trust the Horse." />
  <meta name="theme-color" content="#0A1F44" />

  <!-- Open Graph -->
  <meta property="og:title" content="Tycoon Duro Inc. — God-Level Wealth Strategy" />
  <meta property="og:description" content="Elite credit mastery, business capital, and protected wealth. Trust the Horse." />
  <meta property="og:type" content="website" />
  <meta property="og:image" content="{{ asset('images/logo.png') }}" />

  <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />
  <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}" />

  <!-- Fonts: Sora (display) + Plus Jakarta Sans (body) -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
</head>
<body>

  <!-- ===== CUSTOM CURSOR GLOW ===== -->
  <div class="cursor-glow" id="cursorGlow" aria-hidden="true"></div>

  <!-- ===== PROGRESS BAR ===== -->
  <div class="scroll-progress" id="scrollProgress"></div>

  <!-- ===== NAVIGATION ===== -->
  @include('partials.nav')

  <!-- ===== HERO (arched portrait) ===== -->
  <section class="hero" id="home">
    <div class="hero__bg" aria-hidden="true">
      <div class="hero__grid"></div>
      <div class="hero__bgimg">
        <img src="{{ asset('images/dashboard.png') }}" alt="" />
      </div>
      <div class="hero__glow hero__glow--1"></div>
      <div class="hero__glow hero__glow--2"></div>
      <div class="hero__particles">
        <span></span><span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span><span></span>
      </div>
    </div>

    <div class="container hero__inner">
      <div class="hero__content reveal">
        <span class="eyebrow"><span class="eyebrow__dot"></span> Elite Wealth Architecture</span>
        <h1 class="hero__title">
          Build Credit.<br />Secure Capital.<br />
          <span class="text-gold">Protect Your Empire.</span>
        </h1>
        <p class="hero__sub">
          Tycoon Duro Inc. delivers God-Level, legally rigorous strategy across personal credit,
          business capital, and financial investments — engineered for serious operators ready
          for substantial, protected results.
        </p>
        <div class="hero__actions">
          <a href="#services" class="btn btn--gold">
            Start Your Blueprint
            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
          <a href="https://calendly.com/capital-tycoonduro/30min" target="_blank" rel="noopener" class="btn btn--ghost">Book Strategy Call</a>
        </div>
      </div>

      <div class="hero__figure reveal" data-delay="140">
        <div class="hero__figframe">
          <div class="hero__figportrait">
            <img src="{{ asset('images/owner.jpeg') }}" alt="Stanley Durosier (Tycoon $tan), Founder &amp; Chief Strategist" class="hero__figimg" />
          </div>
          <div class="hero__figglow"></div>
          <div class="hero__figplate">
            <strong>Stanley Durosier (Tycoon $tan)</strong>
            <span>Founder &amp; Chief Strategist</span>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- ===== SERVICES / PROGRAMS ===== -->
  <section class="services" id="services">
    <div class="container">
      <div class="section-head reveal">
        <span class="eyebrow"><span class="eyebrow__dot"></span> Choose Your Path</span>
        <h2 class="section-title">Elite Programs</h2>
        <p class="section-lead">
          Every plan is built on proven methodology and engineered for measurable, lasting outcomes.
          No generic repair. No basic advice. Only elite execution.
        </p>
      </div>

      <div class="tiers">
        <!-- Program 01 -->
        <article class="tier reveal">
          <div class="tier__cap">
            <div class="tier__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 3v5c0 4.4-3 8.3-7 9.5C8 18.3 5 14.4 5 11V6l7-3z"/><path d="m9 12 2 2 4-4"/></svg>
            </div>
            <span class="tier__label">Program 01</span>
            <h3 class="tier__name">Strategic Credit Mastery</h3>
            <p class="tier__tag">Advanced restoration, executed with surgical precision.</p>
            <div class="tier__price">$500 <span>one-time</span></div>
          </div>
          <div class="tier__body">
            <ul class="tier__features">
              <li><i></i> Collections, charge-offs &amp; late payments challenged</li>
              <li><i></i> Hard inquiries removed &amp; personal info cleaned</li>
              <li><i></i> 3-bureau dispute letters — done for you</li>
              <li><i></i> Score optimization roadmap</li>
              <li><i></i> Live email &amp; SMS updates</li>
            </ul>
            <a href="{{ url('/checkout') }}?plan=credit" class="btn btn--ghost btn--block">Begin Credit Mastery</a>
          </div>
        </article>

        <!-- Flagship (center) -->
        <article class="tier tier--flagship reveal" data-delay="120">
          <span class="tier__ribbon">★ Flagship · Everything Included</span>
          <div class="tier__cap tier__cap--gold">
            <div class="tier__icon tier__icon--dark">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8l4 4 5-7 5 7 4-4-2 11H5L3 8z"/><path d="M5 20h14"/></svg>
            </div>
            <span class="tier__label">The Complete System</span>
            <h3 class="tier__name">God-Level Wealth Blueprint</h3>
            <p class="tier__tag">Credit, capital &amp; protection — engineered together.</p>
            <div class="tier__price">$1,000 <span>one-time</span></div>
          </div>
          <div class="tier__body">
            <ul class="tier__features">
              <li class="is-lead"><i></i> <strong>Everything in both plans — credit &amp; business</strong></li>
              <li><i></i> Bankruptcies, repos &amp; student loans challenged</li>
              <li><i></i> Done-for-you by a dedicated specialist</li>
              <li><i></i> Priority disputes — fastest turnaround</li>
              <li><i></i> Asset protection via LLCs &amp; living trusts</li>
              <li><i></i> Preferred funding partners &amp; credit lines</li>
            </ul>
            <a href="{{ url('/checkout') }}?plan=godlevel" class="btn btn--gold btn--block">Claim the Blueprint</a>
            <p class="tier__note">For serious operators ready for substantial, protected results.</p>
          </div>
        </article>

        <!-- Program 02 -->
        <article class="tier reveal" data-delay="240">
          <div class="tier__cap">
            <div class="tier__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 13l5-5 4 4 7-7M20 5v5h-5"/><path d="M4 20h16"/></svg>
            </div>
            <span class="tier__label">Program 02</span>
            <h3 class="tier__name">Business Capital Accelerator</h3>
            <p class="tier__tag">Complete business credit &amp; strategic funding.</p>
            <div class="tier__price">$750 <span>one-time</span></div>
          </div>
          <div class="tier__body">
            <ul class="tier__features">
              <li class="is-lead"><i></i> <strong>Everything in Strategic Credit Mastery, first</strong></li>
              <li><i></i> LLC structuring, EIN &amp; entity setup</li>
              <li><i></i> Business credit profile + Net-30 tradelines</li>
              <li><i></i> Dun &amp; Bradstreet &amp; bureau setup</li>
              <li><i></i> Access to high-value capital</li>
              <li><i></i> Dedicated funding strategy session</li>
            </ul>
            <a href="{{ url('/checkout') }}?plan=capital" class="btn btn--ghost btn--block">Accelerate My Capital</a>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- ===== RESULTS GALLERY ===== -->
  <section class="testi" id="results">
    <div class="container">
      <div class="section-head reveal">
        <span class="eyebrow eyebrow--center"><span class="eyebrow__dot"></span> The Latest Results</span>
        <h2 class="section-title">Results That Speak</h2>
        <p class="section-lead">Real, verified transformations — our most recent client wins.</p>
      </div>

      <div class="results__grid">
        <figure class="result reveal" data-delay="0">
          <span class="result__badge">Latest</span>
          <img src="{{ asset('images/result-1.png') }}" alt="Verified client credit result — three-bureau score increase" loading="lazy" />
        </figure>
        <figure class="result reveal" data-delay="80">
          <span class="result__badge">Latest</span>
          <img src="{{ asset('images/result-2.png') }}" alt="Verified client credit result — three-bureau score increase" loading="lazy" />
        </figure>
        <figure class="result reveal" data-delay="160">
          <span class="result__badge">Latest</span>
          <img src="{{ asset('images/result-3.png') }}" alt="Verified client credit result — three-bureau score increase" loading="lazy" />
        </figure>
        <figure class="result reveal" data-delay="240">
          <span class="result__badge">Latest</span>
          <img src="{{ asset('images/result-4.png') }}" alt="Verified client credit result — three-bureau score increase" loading="lazy" />
        </figure>
        <figure class="result reveal" data-delay="320">
          <span class="result__badge">Latest</span>
          <img src="{{ asset('images/result-5.png') }}" alt="Verified client credit result — three-bureau score increase" loading="lazy" />
        </figure>
        <figure class="result reveal" data-delay="400">
          <span class="result__badge">Latest</span>
          <img src="{{ asset('images/result-6.png') }}" alt="Verified client credit result — three-bureau score increase" loading="lazy" />
        </figure>
      </div>
    </div>
  </section>

  <!-- ===== WHAT WE REMOVE ===== -->
  <section class="remove" id="remove">
    <div class="remove__bg" aria-hidden="true"></div>
    <div class="container">
      <div class="section-head reveal">
        <span class="eyebrow eyebrow--center"><span class="eyebrow__dot"></span> Legal &amp; Precise Deletion</span>
        <h2 class="section-title">What We Remove</h2>
        <p class="section-lead">
          Inaccurate, unverifiable, and outdated negative items — challenged with comprehensive
          legal frameworks and professional documentation for lasting removal.
        </p>
      </div>

      <div class="remove__grid reveal">
        <div class="rem-item"><span class="rem-item__x">✕</span><span class="rem-item__name">Charge-Offs</span></div>
        <div class="rem-item"><span class="rem-item__x">✕</span><span class="rem-item__name">Collections</span></div>
        <div class="rem-item"><span class="rem-item__x">✕</span><span class="rem-item__name">Late Payments</span></div>
        <div class="rem-item"><span class="rem-item__x">✕</span><span class="rem-item__name">Repossessions</span></div>
        <div class="rem-item"><span class="rem-item__x">✕</span><span class="rem-item__name">Bankruptcies</span></div>
        <div class="rem-item"><span class="rem-item__x">✕</span><span class="rem-item__name">Foreclosures</span></div>
        <div class="rem-item"><span class="rem-item__x">✕</span><span class="rem-item__name">Hard Inquiries</span></div>
        <div class="rem-item"><span class="rem-item__x">✕</span><span class="rem-item__name">Judgments</span></div>
        <div class="rem-item"><span class="rem-item__x">✕</span><span class="rem-item__name">Tax Liens</span></div>
        <div class="rem-item"><span class="rem-item__x">✕</span><span class="rem-item__name">Medical Bills</span></div>
        <div class="rem-item"><span class="rem-item__x">✕</span><span class="rem-item__name">Student Loans</span></div>
        <div class="rem-item"><span class="rem-item__x">✕</span><span class="rem-item__name">Evictions</span></div>
        <div class="rem-item"><span class="rem-item__x">✕</span><span class="rem-item__name">Rental History</span></div>
        <div class="rem-item"><span class="rem-item__x">✕</span><span class="rem-item__name">Identity Theft Items</span></div>
      </div>

      <p class="remove__note reveal">
        Only inaccurate or unverifiable items qualify for dispute — every case is reviewed with legal rigor.
      </p>
    </div>
  </section>

  @include('partials.bureaus')

  <!-- ===== DIVISIONS (interactive hub) ===== -->
  <section class="hub" id="pillars">
    <div class="container">
      <div class="section-head reveal">
        <span class="eyebrow eyebrow--center"><span class="eyebrow__dot"></span> Three Divisions. One System.</span>
        <h2 class="section-title">Uniquely Built to <span class="text-gold">Protect &amp; Grow Wealth</span></h2>
        <p class="section-lead">Every result is powered by three connected divisions — select one to explore how it works.</p>
      </div>

      <!-- connected nodes -->
      <div class="hub__nodes reveal">
        <button class="hnode is-active" data-target="pc" type="button">
          <span class="hnode__ring">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20M6 15h4"/></svg>
          </span>
          <span class="hnode__label">Personal Credit</span>
        </button>
        <button class="hnode" data-target="bc" type="button">
          <span class="hnode__ring">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 21h18M5 21V7l7-4 7 4v14M9 9h.01M15 9h.01M9 13h.01M15 13h.01M9 17h.01M15 17h.01"/></svg>
          </span>
          <span class="hnode__label">Business Credit</span>
        </button>
        <button class="hnode" data-target="fi" type="button">
          <span class="hnode__ring">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 17l6-6 4 4 8-8M21 7v6M21 7h-6"/></svg>
          </span>
          <span class="hnode__label">Financial Investments</span>
        </button>
      </div>

      <!-- switching detail panels -->
      <div class="hub__stage reveal" data-delay="120">
        <!-- Personal Credit -->
        <article class="hpanel is-active" data-panel="pc">
          <div class="hpanel__text">
            <span class="hpanel__tag">Division 01 · Personal Credit</span>
            <h3 class="hpanel__title">Surgical Credit Restoration</h3>
            <p class="hpanel__desc">We remove the items dragging your score down — collections, charge-offs, late payments, and more — then rebuild your credit so lenders say yes.</p>
            <ul class="hpanel__list">
              <li>Remove collections &amp; charge-offs</li>
              <li>Delete late payments &amp; hard inquiries</li>
              <li>Raise your score &amp; keep it healthy</li>
            </ul>
            <a href="{{ route('division.personal') }}" class="hpanel__link">Restore my credit <span>→</span></a>
          </div>
          <div class="hpanel__visual">
            <span class="hpanel__watermark">01</span>
            <img src="{{ asset('images/hub-personal.jpg') }}" alt="Personal credit restoration" class="hpanel__img" loading="lazy" />
            <div class="hchip"><span class="hchip__ic">✓</span><span class="hchip__body"><strong>Charge-Offs &amp; Collections</strong><em>Disputed &amp; removed</em></span><span class="hchip__val">Removed</span></div>
            <div class="hchip"><span class="hchip__ic">✓</span><span class="hchip__body"><strong>Score Optimization</strong><em>Profile rebuilt</em></span><span class="hchip__val">+240 pts</span></div>
            <div class="hchip"><span class="hchip__ic">✓</span><span class="hchip__body"><strong>Credit Health</strong><em>Built to last</em></span><span class="hchip__val">Approval-Ready</span></div>
          </div>
        </article>

        <!-- Business Credit -->
        <article class="hpanel" data-panel="bc">
          <div class="hpanel__text">
            <span class="hpanel__tag">Division 02 · Business Credit</span>
            <h3 class="hpanel__title">Business Credit &amp; Strategic Funding</h3>
            <p class="hpanel__desc">Complete business credit architecture and strategic funding acquisition — including LLC structuring and access to high-value capital solutions that scale with your vision.</p>
            <ul class="hpanel__list">
              <li>LLC structuring &amp; entity setup</li>
              <li>Business credit profile building</li>
              <li>Strategic funding &amp; capital access</li>
            </ul>
            <a href="{{ route('division.business') }}" class="hpanel__link">Fund my business <span>→</span></a>
          </div>
          <div class="hpanel__visual">
            <span class="hpanel__watermark">02</span>
            <img src="{{ asset('images/hub-business.jpg') }}" alt="Business credit and funding" class="hpanel__img" loading="lazy" />
            <div class="hchip"><span class="hchip__ic">✓</span><span class="hchip__body"><strong>LLC &amp; Entity Structure</strong><em>Foundation set</em></span><span class="hchip__val">Established</span></div>
            <div class="hchip"><span class="hchip__ic">✓</span><span class="hchip__body"><strong>Business Credit Profile</strong><em>Vendor tradelines</em></span><span class="hchip__val">Built</span></div>
            <div class="hchip"><span class="hchip__ic">✓</span><span class="hchip__body"><strong>Capital Access</strong><em>High-value funding</em></span><span class="hchip__val">Unlocked</span></div>
          </div>
        </article>

        <!-- Financial Investments -->
        <article class="hpanel" data-panel="fi">
          <div class="hpanel__text">
            <span class="hpanel__tag">Division 03 · Financial Investments</span>
            <h3 class="hpanel__title">Asset Protection &amp; Wealth Growth</h3>
            <p class="hpanel__desc">Sophisticated asset protection through LLCs and revocable living trusts, paired with strategic planning that turns unlocked capital into protected, compounding wealth.</p>
            <ul class="hpanel__list">
              <li>Asset protection &amp; trust structuring</li>
              <li>Wealth preservation strategy</li>
              <li>Long-term growth &amp; positioning</li>
            </ul>
            <a href="{{ route('division.financial') }}" class="hpanel__link">Protect my wealth <span>→</span></a>
          </div>
          <div class="hpanel__visual">
            <span class="hpanel__watermark">03</span>
            <img src="{{ asset('images/hub-financial.jpg') }}" alt="Asset protection and wealth growth" class="hpanel__img" loading="lazy" />
            <div class="hchip"><span class="hchip__ic">✓</span><span class="hchip__body"><strong>Living Trust &amp; LLCs</strong><em>Structured &amp; filed</em></span><span class="hchip__val">Protected</span></div>
            <div class="hchip"><span class="hchip__ic">✓</span><span class="hchip__body"><strong>Asset Exposure</strong><em>Legally insulated</em></span><span class="hchip__val">Shielded</span></div>
            <div class="hchip"><span class="hchip__ic">✓</span><span class="hchip__body"><strong>Long-Term Growth</strong><em>Positioned to scale</em></span><span class="hchip__val">Compounding</span></div>
          </div>
        </article>
      </div>

      <div class="hub__dots">
        <button class="hdot is-active" data-target="pc" type="button" aria-label="Personal Credit"></button>
        <button class="hdot" data-target="bc" type="button" aria-label="Business Credit"></button>
        <button class="hdot" data-target="fi" type="button" aria-label="Financial Investments"></button>
      </div>
    </div>
  </section>

  <!-- ===== DIVISIONS DEEP-DIVE (image rows) ===== -->
  <section class="divrows" id="explore">
    <div class="container">
      <div class="section-head reveal">
        <span class="eyebrow eyebrow--center"><span class="eyebrow__dot"></span> Explore The System</span>
        <h2 class="section-title">Three Divisions. <span class="text-gold">One Path to Wealth.</span></h2>
        <p class="section-lead">Each division stands on its own — and together they form one complete system. See how each moves you forward.</p>
      </div>

      <div class="divrow reveal">
        <div class="divrow__media">
          <img src="{{ asset('images/div-personal.jpg') }}" alt="Personal credit restoration" loading="lazy" />
          <span class="divrow__tag">Division 01</span>
        </div>
        <div class="divrow__text">
          <span class="divrow__eyebrow">Personal Credit</span>
          <h3>Surgical Credit Restoration</h3>
          <p>We remove the items dragging your score down — collections, charge-offs, late payments, and inquiries — then rebuild a profile lenders say yes to.</p>
          <ul class="divrow__list">
            <li>Remove collections &amp; charge-offs</li>
            <li>Delete late payments &amp; hard inquiries</li>
            <li>Raise your score &amp; keep it healthy</li>
          </ul>
          <a href="{{ route('division.personal') }}" class="btn btn--gold">Explore Personal Credit
            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </div>
      </div>

      <div class="divrow divrow--rev reveal">
        <div class="divrow__media">
          <img src="{{ asset('images/div-business.jpg') }}" alt="Business credit and funding" loading="lazy" />
          <span class="divrow__tag">Division 02</span>
        </div>
        <div class="divrow__text">
          <span class="divrow__eyebrow">Business Credit</span>
          <h3>Business Credit &amp; Strategic Funding</h3>
          <p>Build a fundable business from the ground up — LLC structuring, vendor tradelines, and access to high-value capital that scales with your vision.</p>
          <ul class="divrow__list">
            <li>LLC structuring &amp; entity setup</li>
            <li>Business credit profile &amp; tradelines</li>
            <li>Strategic funding &amp; capital access</li>
          </ul>
          <a href="{{ route('division.business') }}" class="btn btn--gold">Explore Business Credit
            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </div>
      </div>

      <div class="divrow reveal">
        <div class="divrow__media">
          <img src="{{ asset('images/div-financial.jpg') }}" alt="Asset protection and wealth growth" loading="lazy" />
          <span class="divrow__tag">Division 03</span>
        </div>
        <div class="divrow__text">
          <span class="divrow__eyebrow">Financial Investments</span>
          <h3>Asset Protection &amp; Wealth Growth</h3>
          <p>Protect what you build with LLCs and living trusts, then turn unlocked capital into protected, compounding, generational wealth.</p>
          <ul class="divrow__list">
            <li>Asset protection &amp; trust structuring</li>
            <li>Wealth preservation strategy</li>
            <li>Long-term growth &amp; positioning</li>
          </ul>
          <a href="{{ route('division.financial') }}" class="btn btn--gold">Explore Financial Investments
            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== IMPACT STATS BAND ===== -->
  <section class="impact">
    <div class="impact__bg" style="background-image:url('{{ asset('images/band-city.jpg') }}')" aria-hidden="true"></div>
    <div class="impact__overlay" aria-hidden="true"></div>
    <div class="container impact__inner reveal">
      <div class="impact__head">
        <span class="eyebrow"><span class="eyebrow__dot"></span> Real, Measurable Impact</span>
        <h2 class="impact__title">Results that change the trajectory.</h2>
      </div>
      <div class="impact__grid">
        <div class="impact__stat"><strong>+240</strong><span>avg. points restored</span></div>
        <div class="impact__stat"><strong>1,200+</strong><span>negative items removed</span></div>
        <div class="impact__stat"><strong>$50K+</strong><span>funding potential unlocked</span></div>
        <div class="impact__stat"><strong>3-in-1</strong><span>credit · capital · protection</span></div>
      </div>
    </div>
  </section>

  <!-- ===== DIFFERENCE ===== -->
  <section class="difference" id="difference">
    <div class="difference__bg" aria-hidden="true"></div>
    <div class="container difference__inner">
      <div class="difference__text reveal">
        <span class="eyebrow"><span class="eyebrow__dot"></span> The God-Level Standard</span>
        <h2 class="section-title">Why Tycoon Duro Is Different</h2>
        <p class="difference__lead">
          Tycoon Duro Inc. operates at a God-Level standard of precision and strategic depth.
          We deliver customized, legally rigorous strategies that combine credit restoration,
          business capital acquisition, and asset protection into one seamless system.
        </p>
        <p class="difference__lead">
          We do not offer generic repair or basic advice. We provide elite-level execution and
          genuine strategic partnership — built for measurable, lasting outcomes.
        </p>
        <a href="#contact" class="btn btn--gold">Partner With Us</a>
      </div>

      <div class="difference__cards">
        <div class="diff-card reveal" data-delay="0">
          <span class="diff-card__num">01</span>
          <h4>Surgical Precision</h4>
          <p>Every strategy is customized, documented, and executed with legal rigor — never templated.</p>
        </div>
        <div class="diff-card reveal" data-delay="100">
          <span class="diff-card__num">02</span>
          <h4>One Seamless System</h4>
          <p>Credit, capital, and protection engineered together, not sold as disconnected fixes.</p>
        </div>
        <div class="diff-card reveal" data-delay="200">
          <span class="diff-card__num">03</span>
          <h4>Measurable Outcomes</h4>
          <p>Proven methodology designed for lasting, real-world results you can see and hold.</p>
        </div>
        <div class="diff-card reveal" data-delay="300">
          <span class="diff-card__num">04</span>
          <h4>Strategic Partnership</h4>
          <p>Elite execution paired with clarity, discipline, and intuitive guidance at every step.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== WHO WE HELP ===== -->
  <section class="whohelp" id="who">
    <div class="container">
      <div class="section-head reveal">
        <span class="eyebrow eyebrow--center"><span class="eyebrow__dot"></span> Who We Help</span>
        <h2 class="section-title">Built for People <span class="text-gold">Going Somewhere.</span></h2>
        <p class="section-lead">Whatever you're reaching for, our system is engineered to get you there — with credit, capital, and protection working together.</p>
      </div>

      <div class="whohelp__grid">
        <article class="whocard reveal">
          <div class="whocard__media">
            <img src="{{ asset('images/help-home.jpg') }}" alt="Future homeowners getting approved" loading="lazy" />
            <span class="whocard__badge">Personal Credit</span>
          </div>
          <div class="whocard__body">
            <h3>Future Homeowners</h3>
            <p>Clean up your report and raise your score so you qualify for the mortgage, rate, and home you actually want.</p>
          </div>
        </article>

        <article class="whocard reveal" data-delay="120">
          <div class="whocard__media">
            <img src="{{ asset('images/help-business.jpg') }}" alt="Entrepreneurs and business builders" loading="lazy" />
            <span class="whocard__badge">Business Credit</span>
          </div>
          <div class="whocard__body">
            <h3>Business Builders</h3>
            <p>Structure your entity, build business credit, and unlock the capital you need to launch and scale on your terms.</p>
          </div>
        </article>

        <article class="whocard reveal" data-delay="240">
          <div class="whocard__media">
            <img src="{{ asset('images/help-family.jpg') }}" alt="Families building generational wealth" loading="lazy" />
            <span class="whocard__badge">Financial Investments</span>
          </div>
          <div class="whocard__body">
            <h3>Families &amp; Legacy</h3>
            <p>Protect what you've built with trusts and LLCs, and position your wealth to grow and pass on for generations.</p>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- ===== PROCESS / METHODOLOGY ===== -->
  <section class="process" id="process">
    <div class="process__bg" aria-hidden="true">
      <div class="process__glow"></div>
    </div>
    <div class="container">
      <div class="section-head reveal">
        <span class="eyebrow eyebrow--center"><span class="eyebrow__dot"></span> The Methodology</span>
        <h2 class="section-title">From Barrier to <span class="text-gold">Blueprint</span></h2>
        <p class="section-lead">A disciplined, four-phase journey — engineered to move you from constraint to compounding, protected wealth.</p>
      </div>

      <div class="method">
        <article class="mcard reveal">
          <div class="mcard__head">
            <span class="mcard__num">01</span>
            <span class="mcard__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
            </span>
          </div>
          <span class="mcard__phase">Phase 01</span>
          <h4>Strategic Diagnosis</h4>
          <p>We audit your full financial picture — credit, entities, and exposure — to map the real barriers with precision.</p>
          <span class="mcard__bar"></span>
        </article>

        <article class="mcard reveal" data-delay="120">
          <div class="mcard__head">
            <span class="mcard__num">02</span>
            <span class="mcard__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M4 21V8l6-4 6 4M10 21v-5h4v5M13 4l7 4v13"/></svg>
            </span>
          </div>
          <span class="mcard__phase">Phase 02</span>
          <h4>Custom Architecture</h4>
          <p>A legally rigorous plan is engineered specifically for your goals, your timeline, and your ambition.</p>
          <span class="mcard__bar"></span>
        </article>

        <article class="mcard reveal" data-delay="240">
          <div class="mcard__head">
            <span class="mcard__num">03</span>
            <span class="mcard__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 4 14h7l-1 8 9-12h-7z"/></svg>
            </span>
          </div>
          <span class="mcard__phase">Phase 03</span>
          <h4>Elite Execution</h4>
          <p>We deploy the frameworks with surgical precision — restoring credit, structuring entities, and securing funding.</p>
          <span class="mcard__bar"></span>
        </article>

        <article class="mcard reveal" data-delay="360">
          <div class="mcard__head">
            <span class="mcard__num">04</span>
            <span class="mcard__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17l6-6 4 4 8-8M21 7v6M21 7h-6"/></svg>
            </span>
          </div>
          <span class="mcard__phase">Phase 04</span>
          <h4>Protected Growth</h4>
          <p>Capital is secured, assets are shielded, and your wealth is positioned to compound — for good.</p>
          <span class="mcard__bar"></span>
        </article>
      </div>
    </div>
  </section>

  <!-- ===== STRATEGY BAND ===== -->
  <section class="stratband" id="strategy">
    <div class="container stratband__inner reveal">
      <div class="stratband__media">
        <img src="{{ asset('images/strategy.jpg') }}" alt="A strategy session with the Tycoon Duro team" loading="lazy" />
        <div class="stratband__media-glow" aria-hidden="true"></div>
      </div>
      <div class="stratband__text">
        <span class="eyebrow"><span class="eyebrow__dot"></span> Your First Step</span>
        <h2 class="stratband__title">One call maps your <span class="text-gold">entire blueprint.</span></h2>
        <p>Book a free, no-pressure strategy call. We'll review where you stand across credit, capital, and protection — and show you the exact path forward, engineered for your goals.</p>
        <ul class="stratband__list">
          <li><i></i> A real specialist reviews your case</li>
          <li><i></i> Personalized plan across all three divisions</li>
          <li><i></i> No cost, no obligation</li>
        </ul>
        <a href="https://calendly.com/capital-tycoonduro/30min" target="_blank" rel="noopener" class="btn btn--gold">Book a Free Strategy Call
          <svg viewBox="0 0 24 24" width="18" height="18"><path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>
    </div>
  </section>

  <!-- ===== CTA / CONTACT ===== -->
  <section class="cta faq" id="contact">
    <div class="cta__bg" aria-hidden="true">
      <div class="cta__glow"></div>
    </div>
    <div class="container faq__inner reveal">
      <div class="section-head">
        <span class="eyebrow eyebrow--center"><span class="eyebrow__dot"></span> Questions &amp; Answers</span>
        <h2 class="section-title">Frequently Asked <span class="text-gold">Questions</span></h2>
        <p class="section-lead">Everything you need to know before you begin. Still have a question? Call or email our team anytime.</p>
      </div>

      <div class="faq__list">
        <div class="faq__item">
          <button class="faq__q" type="button" aria-expanded="false">
            <span>How long does credit restoration take?</span>
            <i class="faq__icon" aria-hidden="true"></i>
          </button>
          <div class="faq__a"><p>Fast. Most clients see their first deletions in just 4–7 days, with the majority of results completed within 10–14 days. Timelines vary by profile, but every round is engineered for the fastest possible, lasting impact — not quick fixes that reappear.</p></div>
        </div>
        <div class="faq__item">
          <button class="faq__q" type="button" aria-expanded="false">
            <span>Is this legal?</span>
            <i class="faq__icon" aria-hidden="true"></i>
          </button>
          <div class="faq__a"><p>Completely. Every dispute and strategy is built on established consumer-protection law — the FCRA, FDCPA, and Metro 2 compliance standards. No shortcuts, no gimmicks.</p></div>
        </div>
        <div class="faq__item">
          <button class="faq__q" type="button" aria-expanded="false">
            <span>What's included in the God-Level Wealth Blueprint?</span>
            <i class="faq__icon" aria-hidden="true"></i>
          </button>
          <div class="faq__a"><p>Everything — full credit restoration, complete business credit &amp; funding, and asset protection through LLCs and living trusts. It's our entire system, done for you, with a dedicated specialist on your case.</p></div>
        </div>
        <div class="faq__item">
          <button class="faq__q" type="button" aria-expanded="false">
            <span>Can you help me get business funding?</span>
            <i class="faq__icon" aria-hidden="true"></i>
          </button>
          <div class="faq__a"><p>Yes. We structure your LLC and entity, build a strong business credit profile with vendor tradelines, and connect you to high-value capital and preferred funding partners.</p></div>
        </div>
        <div class="faq__item">
          <button class="faq__q" type="button" aria-expanded="false">
            <span>Do you guarantee results?</span>
            <i class="faq__icon" aria-hidden="true"></i>
          </button>
          <div class="faq__a"><p>We guarantee elite execution and a proven, legally rigorous process. No ethical company can promise an exact score number — but our methodology is designed to remove what's hurting you and rebuild a profile that commands approval.</p></div>
        </div>
        <div class="faq__item">
          <button class="faq__q" type="button" aria-expanded="false">
            <span>How do I get started?</span>
            <i class="faq__icon" aria-hidden="true"></i>
          </button>
          <div class="faq__a"><p>Pick the program that fits your goals above, or reach out directly and we'll map your barriers and design your blueprint. Getting started takes minutes.</p></div>
        </div>
      </div>

      <div class="cta__direct faq__contact">
        <a href="mailto:Capital@tycoonduro.com" class="cta__chip">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
          Capital@tycoonduro.com
        </a>
        <a href="tel:+18448003211" class="cta__chip">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          1 (844) 800-3211
        </a>
      </div>
    </div>
  </section>

  <!-- ===== FOOTER ===== -->
  @include('partials.footer')

  <button class="to-top" id="toTop" aria-label="Back to top">
    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
  </button>

  <a href="https://calendly.com/capital-tycoonduro/30min" target="_blank" rel="noopener" class="floating-cta" aria-label="Book a strategy call">
    <span>Book a Call</span>
    <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
  </a>

  <!-- ===== PREMIUM POPUP ===== -->
  <div class="modal" id="welcomeModal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="modal__backdrop" data-close></div>
    <div class="modal__card" role="document">
      <button class="modal__close" data-close aria-label="Close">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
      </button>

      <!-- Left visual panel -->
      <aside class="modal__aside">
        <img src="{{ asset('images/owner.jpeg') }}" alt="Stanley Durosier, Founder" class="modal__photo" />
        <div class="modal__aside-overlay"></div>
        <div class="modal__aside-top">
          <div class="modal__emblem">
            <svg viewBox="0 0 120 120" fill="none" aria-hidden="true">
              <path d="M60 8 L104 32 V72 Q104 96 60 112 Q16 96 16 72 V32 Z" stroke="#E6C458" stroke-width="2.5"/>
              <path d="M38 78 L60 38 L82 78 M47 62 H73" stroke="#E6C458" stroke-width="3.6" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M60 38 L60 84 M60 38 L76 54 M60 38 L44 54" stroke="#E6C458" stroke-width="2.8" stroke-linecap="round"/>
            </svg>
          </div>
          <div class="modal__stars">★★★★★</div>
        </div>
        <div class="modal__aside-bottom">
          <div class="modal__stat"><strong>+240</strong><span>avg. points restored</span></div>
          <blockquote class="modal__quote">"We architect empires — and then we protect them."</blockquote>
          <div class="modal__person">
            <span class="modal__person-name">Stanley Durosier</span>
            <span class="modal__person-role">Founder &amp; Chief Strategist</span>
          </div>
        </div>
      </aside>

      <!-- Right quiz panel -->
      <div class="modal__body">
        <div class="quiz" id="quiz">
          <div class="quiz__head">
            <button class="quiz__back" id="quizBack" type="button" hidden>
              <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
              Back
            </button>
            <span class="quiz__label" id="quizLabel">Step 1 of 5 · Free Analysis</span>
            <div class="quiz__bar"><span id="quizBar"></span></div>
          </div>

          <div class="quiz__steps">
            <!-- Step 1 -->
            <div class="quiz__step is-active" data-step="1">
              <h3 class="quiz__q">What's your biggest credit challenge right now?</h3>
              <div class="quiz__options">
                <button type="button" class="quiz__opt" data-emoji="💳" data-label="Collections & Charge-Offs"><span class="quiz__opt-emoji">💳</span><span class="quiz__opt-text">Collections &amp; Charge-Offs</span><span class="quiz__opt-go">→</span></button>
                <button type="button" class="quiz__opt" data-emoji="⏰" data-label="Late Payments"><span class="quiz__opt-emoji">⏰</span><span class="quiz__opt-text">Late Payments</span><span class="quiz__opt-go">→</span></button>
                <button type="button" class="quiz__opt" data-emoji="🎓" data-label="Student Loans"><span class="quiz__opt-emoji">🎓</span><span class="quiz__opt-text">Student Loans</span><span class="quiz__opt-go">→</span></button>
                <button type="button" class="quiz__opt" data-emoji="⚖️" data-label="Bankruptcy or Foreclosure"><span class="quiz__opt-emoji">⚖️</span><span class="quiz__opt-text">Bankruptcy or Foreclosure</span><span class="quiz__opt-go">→</span></button>
                <button type="button" class="quiz__opt" data-emoji="🔍" data-label="Not Sure / Multiple Issues"><span class="quiz__opt-emoji">🔍</span><span class="quiz__opt-text">Not Sure / Multiple Issues</span><span class="quiz__opt-go">→</span></button>
              </div>
            </div>

            <!-- Step 2 -->
            <div class="quiz__step" data-step="2">
              <h3 class="quiz__q">What's your current credit score range?</h3>
              <div class="quiz__options">
                <button type="button" class="quiz__opt" data-emoji="🔴" data-label="Below 500 — Poor"><span class="quiz__opt-emoji">🔴</span><span class="quiz__opt-text">Below 500 — Poor</span><span class="quiz__opt-go">→</span></button>
                <button type="button" class="quiz__opt" data-emoji="🟠" data-label="500–579 — Very Poor"><span class="quiz__opt-emoji">🟠</span><span class="quiz__opt-text">500–579 — Very Poor</span><span class="quiz__opt-go">→</span></button>
                <button type="button" class="quiz__opt" data-emoji="🟡" data-label="580–669 — Fair"><span class="quiz__opt-emoji">🟡</span><span class="quiz__opt-text">580–669 — Fair</span><span class="quiz__opt-go">→</span></button>
                <button type="button" class="quiz__opt" data-emoji="🟢" data-label="670–739 — Good"><span class="quiz__opt-emoji">🟢</span><span class="quiz__opt-text">670–739 — Good</span><span class="quiz__opt-go">→</span></button>
                <button type="button" class="quiz__opt" data-emoji="❓" data-label="I Don't Know"><span class="quiz__opt-emoji">❓</span><span class="quiz__opt-text">I Don't Know</span><span class="quiz__opt-go">→</span></button>
              </div>
            </div>

            <!-- Step 3 -->
            <div class="quiz__step" data-step="3">
              <h3 class="quiz__q">How many negative items are on your credit report?</h3>
              <div class="quiz__options">
                <button type="button" class="quiz__opt" data-emoji="1️⃣" data-label="1–3 Items"><span class="quiz__opt-emoji">1️⃣</span><span class="quiz__opt-text">1–3 Items</span><span class="quiz__opt-go">→</span></button>
                <button type="button" class="quiz__opt" data-emoji="2️⃣" data-label="4–7 Items"><span class="quiz__opt-emoji">2️⃣</span><span class="quiz__opt-text">4–7 Items</span><span class="quiz__opt-go">→</span></button>
                <button type="button" class="quiz__opt" data-emoji="3️⃣" data-label="8–15 Items"><span class="quiz__opt-emoji">3️⃣</span><span class="quiz__opt-text">8–15 Items</span><span class="quiz__opt-go">→</span></button>
                <button type="button" class="quiz__opt" data-emoji="🔢" data-label="15+ Items"><span class="quiz__opt-emoji">🔢</span><span class="quiz__opt-text">15+ Items</span><span class="quiz__opt-go">→</span></button>
                <button type="button" class="quiz__opt" data-emoji="❓" data-label="I Don't Know"><span class="quiz__opt-emoji">❓</span><span class="quiz__opt-text">I Don't Know</span><span class="quiz__opt-go">→</span></button>
              </div>
            </div>

            <!-- Step 4 -->
            <div class="quiz__step" data-step="4">
              <h3 class="quiz__q">What's your main goal for improving your credit?</h3>
              <div class="quiz__options">
                <button type="button" class="quiz__opt" data-emoji="🏠" data-label="Buy a Home or Refinance"><span class="quiz__opt-emoji">🏠</span><span class="quiz__opt-text">Buy a Home or Refinance</span><span class="quiz__opt-go">→</span></button>
                <button type="button" class="quiz__opt" data-emoji="🚗" data-label="Get a Car Loan"><span class="quiz__opt-emoji">🚗</span><span class="quiz__opt-text">Get a Car Loan</span><span class="quiz__opt-go">→</span></button>
                <button type="button" class="quiz__opt" data-emoji="💼" data-label="Start or Grow My Business"><span class="quiz__opt-emoji">💼</span><span class="quiz__opt-text">Start or Grow My Business</span><span class="quiz__opt-go">→</span></button>
                <button type="button" class="quiz__opt" data-emoji="💰" data-label="Access Personal Funding"><span class="quiz__opt-emoji">💰</span><span class="quiz__opt-text">Access Personal Funding</span><span class="quiz__opt-go">→</span></button>
                <button type="button" class="quiz__opt" data-emoji="😌" data-label="Peace of Mind & Fresh Start"><span class="quiz__opt-emoji">😌</span><span class="quiz__opt-text">Peace of Mind &amp; Fresh Start</span><span class="quiz__opt-go">→</span></button>
              </div>
            </div>

            <!-- Step 5 -->
            <div class="quiz__step" data-step="5">
              <h3 class="quiz__q">Get Your <span class="text-gold">Free Credit Analysis</span></h3>
              <div class="quiz__summary">
                <span class="quiz__summary-label">Your Profile So Far</span>
                <div class="quiz__chips" id="quizChips"></div>
              </div>
              <form class="quiz__form" id="quizForm" novalidate>
                <div class="quiz__field"><span>👤</span><input type="text" id="qName" placeholder="Full Name *" required /></div>
                <div class="quiz__field"><span>✉️</span><input type="email" id="qEmail" placeholder="Email Address *" required /></div>
                <div class="quiz__field"><span>📱</span><input type="tel" id="qPhone" placeholder="Phone Number *" required /></div>
                <p class="quiz__note" id="quizNote"></p>
                <button type="submit" class="btn btn--gold btn--block quiz__submit">Get My Free Analysis ✦</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
