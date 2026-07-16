<header class="nav" id="nav">
    <div class="container nav__inner">
      <a href="{{ route('home') }}" class="nav__brand" aria-label="Tycoon Duro Inc. home">
        <img src="{{ asset('images/logo.png') }}" alt="Tycoon Duro Inc." class="nav__logo" />
      </a>

      <div class="nav__backdrop" id="navBackdrop" aria-hidden="true"></div>

      <nav class="nav__links" id="navLinks" aria-label="Primary">
        <a href="{{ route('division.personal') }}">Personal Credit</a>
        <a href="{{ route('division.business') }}">Business Credit</a>
        <a href="{{ route('division.financial') }}">Financial Investments</a>
        <a href="https://calendly.com/capital-tycoonduro/30min" target="_blank" rel="noopener" class="nav__cta">Book a Strategy Call</a>
      </nav>

      <button class="nav__toggle" id="navToggle" aria-label="Open menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>
  </header>
