  <footer class="footer">
    <div class="container footer__inner">
      <div class="footer__brand">
        <img src="{{ asset('images/logo.png') }}" alt="Tycoon Duro Inc." class="footer__logo" />
        <p class="footer__tag">Strategic. Precise. Uncompromising.<br /><span class="text-gold">Trust the Horse.</span></p>
      </div>

      <div class="footer__col">
        <h5>Divisions</h5>
        <a href="{{ route('division.personal') }}">Personal Credit</a>
        <a href="{{ route('division.business') }}">Business Credit</a>
        <a href="{{ route('division.financial') }}">Financial Investments</a>
      </div>

      <div class="footer__col">
        <h5>Programs</h5>
        <a href="{{ route('home') }}#services">Tycoon Foundation&trade;</a>
        <a href="{{ route('home') }}#services">Tycoon Elite&trade;</a>
        <a href="{{ route('home') }}#services">Tycoon Capital&trade;</a>
      </div>

      <div class="footer__col">
        <h5>Contact</h5>
        <a href="mailto:Capital@tycoonduro.com">Capital@tycoonduro.com</a>
        <a href="tel:+18448003211">1 (844) 800-3211</a>
        <address>160 W Camino Real #444<br />Boca Raton, FL 33432</address>
      </div>

      <div class="footer__col">
        <h5>Legal</h5>
        <a href="{{ route('legal.terms') }}">Terms of Service</a>
        <a href="{{ route('legal.privacy') }}">Privacy Policy</a>
        <a href="{{ route('legal.disclaimer') }}">Disclaimer</a>
      </div>
    </div>

    <div class="container footer__bottom">
      <p>© <span id="year"></span> Tycoon Duro Inc. All rights reserved.</p>
      <nav class="footer__links">
        <a href="{{ route('legal.terms') }}">Terms</a>
        <a href="{{ route('legal.privacy') }}">Privacy</a>
        <a href="{{ route('legal.disclaimer') }}">Disclaimer</a>
      </nav>
      <p class="footer__legal">Veteran-Led · Legally Rigorous · Results-Oriented</p>
    </div>
  </footer>
