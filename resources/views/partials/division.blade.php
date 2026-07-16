{{-- Full conversion landing page for a division. Expects a rich data set (see division views). --}}

<!-- ===== DIVISION HERO ===== -->
<section class="dhero" id="top">
  <div class="dhero__bg" aria-hidden="true">
    <div class="hero__grid"></div>
    <div class="hero__glow hero__glow--1"></div>
    <div class="hero__glow hero__glow--2"></div>
  </div>
  <div class="container dhero__inner">
    <div class="dhero__content reveal">
      <h1 class="dhero__title">{!! $heroTitle !!}</h1>
      <p class="dhero__sub">{{ $heroSub }}</p>
      <div class="dhero__actions">
        <a href="#lead" class="btn btn--gold">{{ $heroCta }}
          <svg viewBox="0 0 24 24" width="18" height="18"><path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <a href="#included" class="btn btn--ghost">What's Included</a>
      </div>
      <div class="dhero__stats">
        @foreach ($stats as $s)
          <div class="dhero__stat"><strong>{{ $s['num'] }}</strong><span>{{ $s['label'] }}</span></div>
        @endforeach
      </div>

      <ul class="dhero__points">
        @foreach ($heroPoints as $p)
          <li><i></i> {{ $p }}</li>
        @endforeach
      </ul>

      <div class="dhero__trust">
        <span class="dhero__stars">★★★★★</span>
        <span>Trusted by ambitious clients nationwide · Free, no-obligation consultation</span>
      </div>
    </div>

    <div class="dhero__visual reveal" data-delay="120">
      <figure class="dhero__figure">
        <img src="{{ asset('images/' . $image) }}" alt="{{ $imageAlt }}" class="dhero__img" loading="eager" />
        <span class="dhero__figure-ring" aria-hidden="true"></span>
        <div class="dhero__figure-shade" aria-hidden="true"></div>

        <div class="dhero__badge">
          <span class="dhero__badge-num">{{ $stats[0]['num'] }}</span>
          <span class="dhero__badge-label">{{ $stats[0]['label'] }}</span>
        </div>

        <div class="dhero__chips">
          @foreach (array_slice($chips, 0, 2) as $chip)
            <div class="dhero__chip">
              <span class="dhero__chip-ic">&check;</span>
              <span class="dhero__chip-body"><strong>{{ $chip['title'] }}</strong><em>{{ $chip['sub'] }}</em></span>
              <span class="dhero__chip-val">{{ $chip['val'] }}</span>
            </div>
          @endforeach
        </div>
      </figure>
    </div>
  </div>
</section>

<!-- ===== LEAD FORM (premium multi-step) ===== -->
<section class="cta dlead" id="lead">
  <div class="cta__bg" aria-hidden="true"><div class="cta__glow"></div></div>
  <div class="container dlead__inner reveal">
    <div class="section-head dlead__head">
      <span class="eyebrow eyebrow--center"><span class="eyebrow__dot"></span> Start Now · 100% Free</span>
      <h2 class="section-title">{{ $leadHeading }}</h2>
      <p class="section-lead">{{ $leadSub }}</p>
    </div>

    <div class="leadcard">
      <div class="leadform" data-leadform>
        <div class="leadform__head">
          <button class="quiz__back leadform__back" type="button" hidden>
            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
            Back
          </button>
          <span class="quiz__label leadform__label">Step 1 of 2 · Your Goal</span>
          <div class="quiz__bar"><span class="leadform__bar" style="width:50%"></span></div>
        </div>

        <form id="contactForm" data-source="{{ $current }}" novalidate>
          <input type="hidden" name="interest" value="{{ $interest }}" />

          <div class="quiz__step is-active" data-step="1">
            <h3 class="quiz__q">{{ $leadStepQ }}</h3>
            <div class="quiz__options">
              @foreach ($goals as $g)
                <button type="button" class="quiz__opt leadform__opt" data-value="{{ $g['label'] }}">
                  <span class="quiz__opt-emoji">{{ $g['emoji'] }}</span>
                  <span class="quiz__opt-text">{{ $g['label'] }}</span>
                  <span class="quiz__opt-go">→</span>
                </button>
              @endforeach
            </div>
          </div>

          <div class="quiz__step" data-step="2">
            <div class="quiz__summary">
              <span class="quiz__summary-label">Your Focus</span>
              <div class="quiz__chips"><span data-leadchip>{{ $interest }}</span></div>
            </div>
            <h3 class="quiz__q quiz__q--sm">Where should we send your plan?</h3>
            <div class="quiz__field"><span>👤</span><input type="text" id="name" name="name" placeholder="Full Name *" required /></div>
            <div class="quiz__field"><span>✉️</span><input type="email" id="email" name="email" placeholder="Email Address *" required /></div>
            <div class="quiz__field"><span>📱</span><input type="tel" id="phone" name="phone" placeholder="Phone Number" /></div>
            <div class="quiz__field quiz__field--area"><span>💬</span><textarea id="message" name="message" rows="2" placeholder="Anything we should know? (optional)"></textarea></div>
            <p class="cta__formnote" id="formNote"></p>
            <button type="submit" class="btn btn--gold btn--block">{{ $leadCta }} ✦</button>
            <p class="leadform__trust">🔒 Your information is private &amp; secure.</p>
          </div>
        </form>
      </div>
    </div>

    <div class="cta__direct dlead__chips">
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

<!-- ===== WHAT'S INCLUDED ===== -->
<section class="dsection dincludes" id="included">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow eyebrow--center"><span class="eyebrow__dot"></span> What's Included</span>
      <h2 class="section-title">{{ $includesTitle }}</h2>
      <p class="section-lead">{{ $includesSub }}</p>
    </div>
    <ul class="dcheck reveal">
      @foreach ($includes as $inc)
        <li><i></i> {{ $inc }}</li>
      @endforeach
    </ul>
  </div>
</section>

@if ($current === 'personal')
  @include('partials.bureaus')
@endif

<!-- ===== HOW IT WORKS ===== -->
<section class="dsection dsteps" style="background: linear-gradient(180deg, rgba(8,22,51,0.5), rgba(6,15,38,0.12));">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow eyebrow--center"><span class="eyebrow__dot"></span> The Process</span>
      <h2 class="section-title">How It Works</h2>
      <p class="section-lead">A clear, disciplined path from where you are to where you're going.</p>
    </div>
    <div class="dsteps__grid">
      @foreach ($steps as $i => $st)
        <div class="dstep reveal" data-delay="{{ $i * 90 }}">
          <span class="dstep__n">0{{ $i + 1 }}</span>
          <h3>{{ $st['title'] }}</h3>
          <p>{{ $st['desc'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ===== WHY TYCOON DURO ===== -->
<section class="dsection divwhy">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow eyebrow--center"><span class="eyebrow__dot"></span> Why Tycoon Duro</span>
      <h2 class="section-title">Elite Execution. <span class="text-gold">Every Time.</span></h2>
      <p class="section-lead">No generic repair. No basic advice. Only rigorous, done-for-you strategy engineered for lasting results.</p>
    </div>
    <div class="divwhy__grid">
      <div class="divwhy__card reveal">
        <span class="divwhy__ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v18M3 7h18M6 7l-3 6a4 4 0 0 0 6 0L6 7zm12 0l-3 6a4 4 0 0 0 6 0l-3-6z"/></svg></span>
        <h3>Legally Rigorous</h3>
        <p>Every move is built on the FCRA, FDCPA, and Metro 2 compliance standards — no shortcuts, no gimmicks.</p>
      </div>
      <div class="divwhy__card reveal" data-delay="90">
        <span class="divwhy__ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></span>
        <h3>Done-For-You</h3>
        <p>We handle the disputes, the letters, the strategy and the follow-up. You focus on your goals — we do the work.</p>
      </div>
      <div class="divwhy__card reveal" data-delay="180">
        <span class="divwhy__ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/></svg></span>
        <h3>Dedicated Specialist</h3>
        <p>A real strategist is assigned to your file — not a call center. You always know who is fighting for you.</p>
      </div>
      <div class="divwhy__card reveal" data-delay="270">
        <span class="divwhy__ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 3v5c0 4.4-3 8.3-7 9.5C8 18.3 5 14.4 5 11V6l7-3z"/><path d="m9 12 2 2 4-4"/></svg></span>
        <h3>Built to Last</h3>
        <p>We don't chase quick fixes that reappear. We architect results engineered to hold — and to compound.</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== IMPACT BAND ===== -->
<section class="impact">
  <div class="impact__bg" style="background-image:url('{{ asset('images/' . $image) }}')" aria-hidden="true"></div>
  <div class="impact__overlay" aria-hidden="true"></div>
  <div class="container impact__inner reveal">
    <div class="impact__head">
      <span class="eyebrow"><span class="eyebrow__dot"></span> Real, Measurable Impact</span>
      <h2 class="impact__title">Results that change the trajectory.</h2>
    </div>
    <div class="impact__grid">
      @foreach ($stats as $s)
        <div class="impact__stat"><strong>{{ $s['num'] }}</strong><span>{{ $s['label'] }}</span></div>
      @endforeach
      <div class="impact__stat"><strong>100%</strong><span>legal &amp; compliant</span></div>
    </div>
  </div>
</section>

<!-- ===== TESTIMONIAL ===== -->
<section class="dsection divquote">
  <div class="container">
    <figure class="divquote__card reveal">
      <div class="divquote__mark">&ldquo;</div>
      <blockquote>{{ $testimonial['quote'] }}</blockquote>
      <div class="divquote__stars">★★★★★</div>
      <figcaption><strong>{{ $testimonial['name'] }}</strong><span>{{ $testimonial['result'] }}</span></figcaption>
    </figure>
  </div>
</section>

<!-- ===== FAQ ===== -->
<section class="dsection cta faq">
  <div class="cta__bg" aria-hidden="true"><div class="cta__glow"></div></div>
  <div class="container faq__inner reveal">
    <div class="section-head">
      <span class="eyebrow eyebrow--center"><span class="eyebrow__dot"></span> Questions &amp; Answers</span>
      <h2 class="section-title">Frequently Asked Questions</h2>
    </div>
    <div class="faq__list">
      @foreach ($faq as $qa)
        <div class="faq__item">
          <button class="faq__q" type="button" aria-expanded="false">
            <span>{{ $qa['q'] }}</span>
            <i class="faq__icon" aria-hidden="true"></i>
          </button>
          <div class="faq__a"><p>{{ $qa['a'] }}</p></div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ===== FINAL CTA ===== -->
<section class="cta dfinal">
  <div class="cta__bg" aria-hidden="true"><div class="cta__glow"></div></div>
  <div class="container cta__inner reveal">
    <span class="eyebrow eyebrow--center"><span class="eyebrow__dot"></span> Your Move</span>
    <h2 class="cta__title">{{ $finalTitle }}</h2>
    <p class="cta__sub">{{ $finalSub }}</p>
    <div class="dhero__actions" style="justify-content:center;">
      <a href="https://calendly.com/capital-tycoonduro/30min" target="_blank" rel="noopener" class="btn btn--gold">Book My Strategy Call
        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
      <a href="{{ route('checkout') }}?plan={{ $plan }}" class="btn btn--ghost">Get Started Now</a>
    </div>
  </div>
</section>
