@extends('layouts.base')

@section('title', 'Financial Investments — Asset Protection & Wealth Growth | Tycoon Duro Inc.')
@section('description', 'Protect your assets with LLCs and living trusts, and turn capital into protected, compounding wealth through disciplined strategy.')

@section('content')
  @include('partials.division', [
    'current' => 'financial',
    'num'   => '03',
    'tag'   => 'Division 03 · Financial Investments',
    'plan'  => 'capital',
    'interest' => 'Financial Investments & Protection',
    'image' => 'div-financial.jpg',
    'imageAlt' => 'Financial growth and protected wealth',
    'leadStepQ' => 'What matters most to you?',
    'goals' => [
      ['emoji' => '🛡️', 'label' => 'Protect my assets'],
      ['emoji' => '🏦', 'label' => 'Set up a living trust'],
      ['emoji' => '📈', 'label' => 'Grow my wealth'],
      ['emoji' => '🔑', 'label' => 'Estate & succession'],
    ],

    'heroTitle' => 'Protect Your Assets.<br /><span class="text-gold">Grow Real Wealth.</span>',
    'heroSub'   => 'Sophisticated asset protection through LLCs and revocable living trusts, paired with strategy that turns unlocked capital into protected, compounding wealth.',
    'heroCta'   => 'Protect My Wealth',
    'heroPoints' => [
      'Free asset-protection review',
      'Trusts & LLCs structured and filed',
      'Wealth positioned to compound',
    ],
    'stats' => [
      ['num' => 'Trust', 'label' => 'living trust & LLCs'],
      ['num' => 'Shielded', 'label' => 'asset exposure'],
      ['num' => 'Long-Term', 'label' => 'compounding growth'],
    ],
    'chips' => [
      ['title' => 'Living Trust & LLCs', 'sub' => 'Structured & filed', 'val' => 'Protected'],
      ['title' => 'Asset Exposure', 'sub' => 'Legally insulated', 'val' => 'Shielded'],
      ['title' => 'Long-Term Growth', 'sub' => 'Positioned to scale', 'val' => 'Compounding'],
    ],

    'leadHeading' => 'Get your free protection review',
    'leadSub'     => "Tell us what you're building. We'll show you where you're exposed and how to structure protection and growth — at no cost.",
    'leadCta'     => 'Request My Review',

    'includesTitle' => 'Asset Protection & Wealth Growth',
    'includesSub'   => 'Structure that insulates what you have — and compounds what comes next.',
    'includes' => [
      'Revocable living trust structuring',
      'LLC & entity asset protection',
      'Legal insulation of key assets',
      'Estate & succession positioning',
      'Wealth preservation strategy',
      'Capital deployment planning',
      'Long-term growth positioning',
      'Risk & exposure review',
      'Ongoing strategic guidance',
      'Integrated with your credit & capital',
    ],

    'steps' => [
      ['title' => 'Protection Review', 'desc' => 'We map your assets and exposure, identifying exactly where you are vulnerable and what needs to be shielded.'],
      ['title' => 'Structure & File', 'desc' => 'We structure LLCs and a revocable living trust to legally insulate your assets and set up clean succession.'],
      ['title' => 'Grow & Preserve', 'desc' => 'With protection in place, we position capital for disciplined, long-term, compounding growth.'],
    ],

    'faq' => [
      ['q' => 'What does asset protection actually do?', 'a' => 'It legally separates your personal assets from liability using LLCs and trusts, so a lawsuit or claim against one area cannot easily reach everything you own.'],
      ['q' => 'What is a revocable living trust?', 'a' => 'A structure that holds your assets, keeps them out of probate, and lets you control how they pass on — while you retain full control during your lifetime.'],
      ['q' => 'Is this only for wealthy people?', 'a' => 'No. The earlier you structure protection, the more you preserve as you grow. It is about positioning, not just current net worth.'],
      ['q' => 'How does this connect to credit and funding?', 'a' => 'It is the final layer of the system — we protect the wealth your restored credit and business capital create. Structuring is scoped on your strategy call, alongside whichever program fits you.'],
    ],

    'testimonial' => [
      'quote'  => "They protected everything I'd built with the right trust and LLC structure, then positioned my wealth to grow. Total peace of mind.",
      'name'   => 'James & Ava P.',
      'result' => 'Assets protected · legacy secured',
    ],

    'finalTitle' => 'Ready to protect and grow?',
    'finalSub'   => "Book a free strategy call and we'll review your exposure and design your blueprint.",
  ])
@endsection
