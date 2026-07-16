@extends('layouts.base')

@section('title', 'Business Credit & Funding — Strategic Capital | Tycoon Duro Inc.')
@section('description', 'Build a fundable business credit profile and access high-value capital — LLC structuring, tradelines, and lender-ready strategy.')

@section('content')
  @include('partials.division', [
    'current' => 'business',
    'num'   => '02',
    'tag'   => 'Division 02 · Business Credit',
    'plan'  => 'capital',
    'interest' => 'Business Credit & Funding',
    'image' => 'div-business.jpg',
    'imageAlt' => 'A modern city skyline representing business growth',
    'leadStepQ' => 'What do you want to unlock first?',
    'goals' => [
      ['emoji' => '💼', 'label' => 'Get business funding'],
      ['emoji' => '🏗️', 'label' => 'Structure my LLC'],
      ['emoji' => '📊', 'label' => 'Build business credit'],
      ['emoji' => '💰', 'label' => 'Access credit lines'],
    ],

    'heroTitle' => 'Build Business Credit.<br /><span class="text-gold">Unlock Real Capital.</span>',
    'heroSub'   => 'A complete business credit architecture and funding strategy — LLC structuring, vendor tradelines, and access to high-value capital that scales with your vision.',
    'heroCta'   => 'Fund My Business',
    'heroPoints' => [
      'Free funding roadmap for your business',
      'Entity & credit built the right way',
      'Access to real, high-value capital',
    ],
    'stats' => [
      ['num' => '$50K+', 'label' => 'funding potential'],
      ['num' => 'Net-30', 'label' => 'tradelines built'],
      ['num' => '3-Bureau', 'label' => 'business credit profile'],
    ],
    'chips' => [
      ['title' => 'LLC & Entity Structure', 'sub' => 'Foundation set', 'val' => 'Established'],
      ['title' => 'Business Credit Profile', 'sub' => 'Vendor tradelines', 'val' => 'Built'],
      ['title' => 'Capital Access', 'sub' => 'High-value funding', 'val' => 'Unlocked'],
    ],

    'leadHeading' => 'Get your free funding roadmap',
    'leadSub'     => "Tell us about your business. We'll show you exactly how to become fundable and what capital you can realistically access — at no cost.",
    'leadCta'     => 'Request My Roadmap',

    'includesTitle' => 'Everything in Tycoon Capital™',
    'includesSub'   => 'From entity setup to lender-ready funding — the full architecture.',
    'includes' => [
      'LLC or Corporation formation with EIN registration',
      'Dun & Bradstreet and full business credit profile development',
      'Net-30 vendor accounts and commercial tradeline strategy',
      'SBA loan and business line of credit preparation',
      'Dedicated business advisory with funding roadmap and execution support',
      'Business credit profile architecture',
      'Lender-ready documentation prep',
      'Preferred funding partner connections',
    ],

    'steps' => [
      ['title' => 'Structure', 'desc' => 'We set up your LLC, EIN, and entity foundation the right way — so lenders and bureaus see a legitimate, fundable business.'],
      ['title' => 'Build Profile', 'desc' => 'We establish your business credit with vendor tradelines and D&B / bureau setup, building a strong, borrowable profile.'],
      ['title' => 'Secure Funding', 'desc' => 'With lender-ready documentation, we connect you to preferred partners and pursue high-value capital and credit lines.'],
    ],

    'faq' => [
      ['q' => 'Do I need good personal credit first?', 'a' => 'It helps, which is why we clean your personal report first. But we build a business credit profile that can stand on its own for many funding programs.'],
      ['q' => 'How much funding can I access?', 'a' => 'It depends on your profile, revenue, and time in business. We map a realistic, staged plan and grow your access as your profile strengthens.'],
      ['q' => 'How long until my business is fundable?', 'a' => 'Foundational tradelines report within weeks. A borrowable profile typically takes a few months of disciplined building — we guide every step.'],
      ['q' => 'Do you set up the LLC for me?', 'a' => 'We guide and structure your LLC, EIN, and entity setup so it is built correctly for credit and funding from day one.'],
    ],

    'testimonial' => [
      'quote'  => "Tycoon Duro structured my LLC, built my business credit, and got me access to real capital. We scaled in months, not years.",
      'name'   => 'Danielle R.',
      'result' => '$65K in funding secured',
    ],

    'finalTitle' => 'Ready to become fundable?',
    'finalSub'   => "Book a free strategy call and we'll map your path from structure to capital.",
  ])
@endsection
