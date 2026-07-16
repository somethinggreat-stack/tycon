@extends('layouts.base')

@section('title', 'Disclaimer — Tycoon Duro Inc.')
@section('description', 'Important disclaimers regarding Tycoon Duro Inc. services and results.')

@section('content')
<section class="legal">
  <div class="container">
    <div class="legal__inner reveal">
      <span class="legal__eyebrow">Legal</span>
      <h1>Disclaimer</h1>
      <p class="legal__updated">Last updated: July 8, 2026</p>

      <p>The information and services provided by Tycoon Duro Inc. ("Tycoon Duro") are offered in good faith and for general informational and service purposes. Please read this Disclaimer carefully.</p>

      <h2>1. No Guarantee of Results</h2>
      <p>We do not promise or guarantee any specific credit score increase, deletion of any particular item, funding amount, or financial outcome. Every credit profile and situation is different, and results depend on factors outside our control, including the accuracy of your information and the responses of bureaus, creditors, and lenders. Testimonials and figures shown on our site reflect individual experiences and are <strong>not</strong> a promise of the results you will achieve.</p>

      <h2>2. Not Legal, Financial, or Tax Advice</h2>
      <p>Tycoon Duro is not a law firm, accounting firm, or licensed financial advisor, and nothing we provide constitutes legal, tax, or investment advice. Our services support you within established consumer-protection frameworks. For advice specific to your circumstances, consult a qualified attorney, accountant, or financial professional.</p>

      <h2>3. Your Consumer Rights</h2>
      <p>You have the right to dispute inaccurate information on your own credit reports directly with the credit bureaus at no cost, and to obtain your free annual credit reports. Our service provides professional strategy, documentation, and done-for-you execution — it does not grant you rights you do not already have under the law.</p>

      <h2>4. Only Inaccurate or Unverifiable Items</h2>
      <p>We challenge items that are inaccurate, outdated, or unverifiable. We do not remove accurate, timely, and verifiable information, and we do not encourage disputing accurate items.</p>

      <h2>5. Third-Party Services</h2>
      <p>Our Services may reference or rely on third parties (such as credit-monitoring providers, lenders, and processing partners). We are not responsible for the content, policies, or performance of third parties.</p>

      <h2>6. Limitation</h2>
      <p>To the fullest extent permitted by law, Tycoon Duro disclaims liability for any loss or damage arising from reliance on information or results discussed on this site. Your use of our Services is also governed by our <a href="{{ route('legal.terms') }}">Terms of Service</a> and <a href="{{ route('legal.privacy') }}">Privacy Policy</a>.</p>

      <h2>7. Contact Us</h2>
      <p>Questions about this Disclaimer? Contact us at <a href="mailto:Capital@tycoonduro.com">Capital@tycoonduro.com</a>, <a href="tel:+18448003211">1 (844) 800-3211</a>, or 160 W Camino Real #444, Boca Raton, FL 33432.</p>
    </div>
  </div>
</section>
@endsection
