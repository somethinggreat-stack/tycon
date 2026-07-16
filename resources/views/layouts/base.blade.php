<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="lead-endpoint" content="{{ route('lead.store') }}" />
  <title>@yield('title', 'Tycoon Duro Inc. — Elite Wealth Strategy')</title>
  <meta name="description" content="@yield('description', 'Tycoon Duro Inc. — Elite credit mastery, business capital acquisition, and asset protection.')" />
  <meta name="theme-color" content="#0A1F44" />

  <meta property="og:title" content="@yield('title', 'Tycoon Duro Inc.')" />
  <meta property="og:type" content="website" />
  <meta property="og:image" content="{{ asset('images/logo.png') }}" />

  <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />
  <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="@versioned('css/styles.css')" />
</head>
<body>

  <div class="cursor-glow" id="cursorGlow" aria-hidden="true"></div>
  <div class="scroll-progress" id="scrollProgress"></div>

  @include('partials.nav')

  @yield('content')

  @include('partials.footer')

  <button class="to-top" id="toTop" aria-label="Back to top">
    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
  </button>

  <a href="https://calendly.com/capital-tycoonduro/30min" target="_blank" rel="noopener" class="floating-cta" aria-label="Book a strategy call">
    <span>Book a Call</span>
    <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
  </a>

  <script src="@versioned('js/script.js')"></script>
</body>
</html>
