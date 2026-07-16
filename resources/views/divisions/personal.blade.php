@extends('layouts.base')

@section('title', 'Personal Credit Repair — Surgical Credit Restoration | Tycoon Duro Inc.')
@section('description', 'We remove collections, charge-offs, late payments and inquiries — then rebuild your credit so lenders say yes. Legally rigorous, done for you.')

@section('content')
  @include('partials.division', [
    'current' => 'personal',
    'num'   => '01',
    'tag'   => 'Division 01 · Personal Credit',
    'plan'  => 'credit',
    'interest' => 'Personal Credit',
    'image' => 'div-personal.jpg',
    'imageAlt' => 'A confident professional who took control of their credit',
    'leadStepQ' => "What's your #1 credit goal?",
    'goals' => [
      ['emoji' => '🏠', 'label' => 'Buy a home or refinance'],
      ['emoji' => '🚗', 'label' => 'Get approved for a car'],
      ['emoji' => '💳', 'label' => 'Remove collections & charge-offs'],
      ['emoji' => '📈', 'label' => 'Just raise my score'],
    ],

    'heroTitle' => 'Restore Your Credit.<br /><span class="text-gold">Command Approval.</span>',
    'heroSub'   => 'We surgically remove collections, charge-offs, late payments, and hard inquiries — then rebuild a profile lenders say yes to. Legally rigorous. Done for you.',
    'heroCta'   => 'Fix My Credit',
    'heroPoints' => [
      'Free, no-obligation credit analysis',
      'A dedicated specialist on your file',
      'Real results across all three bureaus',
    ],
    'stats' => [
      ['num' => '+240', 'label' => 'avg. points restored'],
      ['num' => '4–7', 'label' => 'days to first deletions'],
      ['num' => '3-Bureau', 'label' => 'disputes done for you'],
    ],
    'chips' => [
      ['title' => 'Charge-Offs & Collections', 'sub' => 'Disputed & removed', 'val' => 'Removed'],
      ['title' => 'Score Optimization', 'sub' => 'Profile rebuilt', 'val' => '+240 pts'],
      ['title' => 'Credit Health', 'sub' => 'Built to last', 'val' => 'Approval-Ready'],
    ],

    'leadHeading' => 'Get your free credit game plan',
    'leadSub'     => "Tell us where you're at. We'll map exactly what's hurting your score and how fast we can remove it — no cost, no obligation.",
    'leadCta'     => 'Send My Request',

    'includesTitle' => 'Everything in Strategic Credit Mastery',
    'includesSub'   => 'A complete, compliance-based restoration system — not generic repair.',
    'includes' => [
      'Late payments challenged',
      'Collections challenged',
      'Charge-offs challenged',
      'Hard inquiries challenged',
      'Personal information cleaned up',
      '3-bureau dispute letters done for you',
      'FCRA & FDCPA dispute strategy',
      'Debt validation to collection agencies',
      'Score optimization roadmap',
      'Credit-building guidance after disputes',
      'Email & SMS status updates',
      'Monthly progress reports',
    ],

    'steps' => [
      ['title' => 'Free Analysis', 'desc' => 'We review all three bureau reports and pinpoint every inaccurate, unverifiable item dragging your score down.'],
      ['title' => 'Strategic Disputes', 'desc' => 'We prepare and send FCRA/FDCPA-based dispute and validation letters on your behalf — round after round until items fall off.'],
      ['title' => 'Rebuild & Optimize', 'desc' => 'As negatives clear, we optimize utilization and build positive history so your score climbs and stays there.'],
    ],

    'pricing' => [
      'name' => 'Strategic Credit Mastery',
      'tag'  => 'Advanced restoration, executed with surgical precision.',
      'price'=> '$500',
      'cta'  => 'Begin Credit Mastery',
      'features' => [
        'Remove collections & charge-offs',
        'Delete late payments & hard inquiries',
        '3-bureau dispute letters done for you',
        'Score optimization roadmap',
        'Email & SMS status updates',
      ],
    ],

    'faq' => [
      ['q' => 'How long does credit restoration take?', 'a' => 'Most clients see their first deletions in just 4–7 days, with the majority of results completed within 10–14 days. Timelines can vary by profile, but our process is engineered for the fastest possible, lasting impact.'],
      ['q' => 'Is this legal?', 'a' => 'Completely. Every dispute is built on the FCRA, FDCPA, and Metro 2 compliance standards — no shortcuts, no gimmicks.'],
      ['q' => 'What can you remove?', 'a' => 'Collections, charge-offs, late payments, hard inquiries, and other inaccurate or unverifiable items across all three bureaus.'],
      ['q' => 'Do you guarantee a specific score?', 'a' => 'No ethical company can promise an exact number — but our process is designed to remove what is hurting you and rebuild a profile that commands approval.'],
    ],

    'testimonial' => [
      'quote'  => "They removed collections and charge-offs I'd been fighting for years. My score jumped over 200 points and I finally got approved for my first home.",
      'name'   => 'Marcus T.',
      'result' => '+217 points · mortgage approved',
    ],

    'finalTitle' => 'Ready to restore your credit?',
    'finalSub'   => "Book a free strategy call and we'll map your barriers and your blueprint — then get to work.",
  ])
@endsection
