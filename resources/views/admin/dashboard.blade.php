<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Command Center — Tycoon Duro Inc.</title>
<meta name="robots" content="noindex, nofollow" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
<link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}" />
<style>
  :root{
    --gold:#C9A227;--gold-2:#E6C458;--gold-deep:#A6851C;--navy:#0A1F44;--navy-900:#060F26;
    --bg:#f4f1ea;--paper:#ffffff;--paper-2:#faf8f3;--ink:#161a22;--ink-2:#3a3f4a;--dim:#7b8090;--muted:#9aa0b0;
    --line:#e9e4da;--line-2:#f0ece3;--ok:#1a9d63;--ok-soft:#e6f6ee;--red:#d64535;
    --grad-gold:linear-gradient(135deg,#E6C458,#C9A227 55%,#A6851C);
    --ease:cubic-bezier(.22,1,.36,1);--fd:'Sora',sans-serif;--fb:'Plus Jakarta Sans',sans-serif;
    --sh:0 2px 16px rgba(20,20,40,.05);--sh-lg:0 24px 60px -34px rgba(20,20,45,.3);
  }
  *{margin:0;padding:0;box-sizing:border-box;-webkit-tap-highlight-color:transparent;}
  /* author display beats the UA [hidden] rule — without this the idle modal never hides */
  [hidden]{display:none !important;}

  /* ===== IDLE TIMEOUT ===== */
  .idle{position:fixed;inset:0;z-index:9999;display:grid;place-items:center;padding:20px;
    background:rgba(10,20,45,.55);backdrop-filter:blur(6px);animation:idleIn .2s var(--ease);}
  @keyframes idleIn{from{opacity:0}to{opacity:1}}
  .idle-card{width:min(430px,100%);background:var(--paper);border:1px solid var(--line);border-radius:20px;
    padding:30px 28px 26px;text-align:center;box-shadow:var(--sh-lg);animation:idleUp .28s var(--ease);}
  @keyframes idleUp{from{opacity:0;transform:translateY(14px) scale(.97)}to{opacity:1;transform:none}}
  .idle-ic{width:60px;height:60px;margin:0 auto 16px;border-radius:50%;display:grid;place-items:center;
    color:var(--navy-900);background:var(--grad-gold);box-shadow:0 12px 28px -12px rgba(201,162,39,.7);}
  .idle-ic svg{width:28px;height:28px;}
  .idle-card h3{font-family:var(--fd);font-size:1.3rem;font-weight:800;margin-bottom:8px;}
  .idle-card p{color:var(--ink-2);font-size:.94rem;margin-bottom:18px;}
  .idle-card p b{font-family:var(--fd);font-size:1.05rem;color:var(--red);font-variant-numeric:tabular-nums;}
  .idle-bar{height:6px;border-radius:6px;background:var(--line-2);overflow:hidden;margin-bottom:20px;}
  .idle-bar i{display:block;height:100%;width:100%;border-radius:6px;background:var(--grad-gold);transition:width 1s linear;}
  .idle-actions{display:flex;gap:10px;}
  .idle-actions button{flex:1;padding:13px 16px;border-radius:12px;font-family:var(--fd);font-weight:700;
    font-size:.9rem;cursor:pointer;border:1px solid transparent;transition:all .2s var(--ease);}
  .idle-stay{background:var(--navy);color:#fff;}
  .idle-stay:hover{background:var(--navy-900);}
  .idle-out{background:transparent;color:var(--ink-2);border-color:var(--line);}
  .idle-out:hover{border-color:var(--red);color:var(--red);}
  @media (max-width:420px){.idle-actions{flex-direction:column}}
  body{font-family:var(--fb);background:var(--bg);color:var(--ink);-webkit-font-smoothing:antialiased;line-height:1.5;}
  a{text-decoration:none;color:inherit;}
  img{display:block;max-width:100%;}

  .layout{display:grid;grid-template-columns:250px 1fr;min-height:100vh;}

  /* ===== SIDEBAR ===== */
  .side{position:sticky;top:0;height:100vh;display:flex;flex-direction:column;background:linear-gradient(180deg,#0A1F44,#060F26);color:#fff;padding:20px 16px;}
  .side-top{display:flex;align-items:center;gap:11px;padding:8px 8px 18px;border-bottom:1px solid rgba(255,255,255,.08);margin-bottom:14px;}
  .side-top img{width:44px;height:44px;border-radius:50%;object-fit:cover;object-position:50% 20%;border:2px solid var(--gold);}
  .side-top b{font-family:var(--fd);font-size:.92rem;font-weight:700;display:block;line-height:1.2;}
  .side-top span{font-size:.6rem;letter-spacing:.18em;color:var(--gold-2);}
  .nav{display:flex;flex-direction:column;gap:2px;flex:1;overflow-y:auto;}
  .nav a{display:flex;align-items:center;gap:11px;padding:11px 13px;border-radius:11px;font-size:.9rem;font-weight:500;color:rgba(255,255,255,.72);transition:all .22s var(--ease);cursor:pointer;}
  .nav a svg{width:17px;height:17px;flex-shrink:0;opacity:.85;}
  .nav a:hover{background:rgba(255,255,255,.06);color:#fff;}
  .nav a.on{background:var(--grad-gold);color:var(--navy-900);font-weight:700;box-shadow:0 10px 24px -10px rgba(201,162,39,.6);}
  .nav a.on svg{opacity:1;}
  .nav .sep{height:1px;background:rgba(255,255,255,.07);margin:10px 6px;}
  .signout{margin-top:12px;}
  .signout button{width:100%;padding:12px;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.04);color:#fff;border-radius:12px;font-family:var(--fd);font-weight:600;font-size:.85rem;cursor:pointer;transition:all .25s;}
  .signout button:hover{background:rgba(255,255,255,.1);}

  /* ===== MAIN ===== */
  .main{padding:22px clamp(1rem,2.6vw,2.2rem);max-width:1320px;}
  .topsearch{display:flex;gap:10px;margin-bottom:20px;}
  .topsearch input{flex:1;padding:.95rem 1.1rem .95rem 2.6rem;border:1px solid var(--line);border-radius:14px;background:var(--paper) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='%239aa0b0' stroke-width='2'%3E%3Ccircle cx='11' cy='11' r='7'/%3E%3Cpath d='m21 21-4.3-4.3'/%3E%3C/svg%3E") no-repeat 1rem center;font-family:var(--fb);font-size:.92rem;color:var(--ink);box-shadow:var(--sh);}
  .topsearch input:focus{outline:none;border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,162,39,.14);}
  .topsearch button{padding:0 1.5rem;border:none;border-radius:14px;background:var(--navy);color:#fff;font-family:var(--fd);font-weight:700;font-size:.88rem;cursor:pointer;}

  /* welcome banner */
  .banner{position:relative;overflow:hidden;display:flex;align-items:center;gap:22px;padding:26px 30px;border-radius:22px;margin-bottom:22px;
    background:radial-gradient(120% 160% at 100% 0%,#2a1c3f 0%,#12234a 40%,#0A1F44 100%);color:#fff;box-shadow:var(--sh-lg);}
  .banner::after{content:"";position:absolute;right:-6%;top:-40%;width:340px;height:340px;border-radius:50%;background:radial-gradient(circle,rgba(201,162,39,.28),transparent 62%);}
  .banner-photo{position:relative;z-index:1;width:96px;height:96px;border-radius:50%;object-fit:cover;object-position:50% 18%;border:3px solid var(--gold);box-shadow:0 12px 30px -10px rgba(0,0,0,.5);flex-shrink:0;}
  .banner-text{position:relative;z-index:1;flex:1;}
  .banner-text .wb{font-family:var(--fd);font-size:.66rem;font-weight:700;letter-spacing:.16em;text-transform:uppercase;color:var(--gold-2);}
  .banner-text h1{font-family:var(--fd);font-size:1.9rem;font-weight:800;letter-spacing:-.02em;margin:4px 0 6px;}
  .banner-text h1 em{font-style:italic;font-weight:600;color:var(--gold-2);}
  .banner-text p{font-size:.9rem;color:rgba(255,255,255,.82);}
  .banner-text .dim{color:rgba(255,255,255,.55);font-size:.84rem;margin-top:3px;}
  .banner-stats{position:relative;z-index:1;display:flex;gap:12px;}
  .bstat{text-align:center;min-width:110px;padding:16px 18px;border-radius:16px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);}
  .bstat b{font-family:var(--fd);font-size:1.7rem;font-weight:800;display:block;}
  .bstat span{font-size:.58rem;letter-spacing:.14em;text-transform:uppercase;color:rgba(255,255,255,.6);}
  .bstat.gold{background:rgba(201,162,39,.14);border-color:rgba(201,162,39,.4);}
  .bstat.gold b{color:var(--gold-2);}

  /* stat card rows */
  .cards{display:grid;gap:16px;margin-bottom:16px;}
  .c6{grid-template-columns:repeat(6,1fr);}
  .c5{grid-template-columns:repeat(4,1fr);}
  .card{background:var(--paper);border:1px solid var(--line);border-radius:18px;padding:20px;box-shadow:var(--sh);transition:transform .3s var(--ease),box-shadow .3s;}
  .card:hover{transform:translateY(-3px);box-shadow:var(--sh-lg);}
  .card .lbl{font-family:var(--fd);font-size:.6rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--muted);}
  .card .val{font-family:var(--fd);font-size:1.85rem;font-weight:800;letter-spacing:-.02em;margin:10px 0 6px;}
  .card .val.green{color:var(--ok);}.card .val.red{color:var(--red);}.card .val.gold{color:var(--gold-deep);}
  .card .sub{font-size:.74rem;color:var(--dim);}
  .card .sub .up{color:var(--gold-deep);font-weight:700;}

  /* lists */
  .two{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:6px;}
  .list{background:var(--paper);border:1px solid var(--line);border-radius:18px;padding:22px 24px;box-shadow:var(--sh);}
  .list-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;}
  .list-head h3{font-family:var(--fd);font-size:1rem;font-weight:700;}
  .list-head a{font-size:.8rem;font-weight:600;color:var(--gold-deep);cursor:pointer;}
  .row{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:13px 0;border-top:1px solid var(--line-2);}
  .row:first-of-type{border-top:none;}
  .row .r-main b{display:block;font-weight:700;font-size:.92rem;color:var(--ink);}
  .row .r-main span{font-size:.78rem;color:var(--dim);}
  .row .r-side{text-align:right;white-space:nowrap;}
  .row .r-side b{font-family:var(--fd);font-weight:700;color:var(--gold-deep);font-size:.92rem;}
  .row .r-side span{display:block;font-size:.74rem;color:var(--muted);}
  .list .empty{padding:28px 0;text-align:center;color:var(--muted);font-size:.88rem;}

  /* full table views */
  .view{display:none;}
  .view.on{display:block;}
  .view-head{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:16px;}
  .view-head h2{font-family:var(--fd);font-size:1.4rem;font-weight:800;letter-spacing:-.01em;}
  .view-head p{color:var(--dim);font-size:.88rem;margin-top:2px;}
  .tablewrap{background:var(--paper);border:1px solid var(--line);border-radius:18px;overflow:hidden;box-shadow:var(--sh);}
  .scroll{overflow-x:auto;}
  table{width:100%;border-collapse:collapse;min-width:720px;}
  thead th{text-align:left;font-family:var(--fd);font-size:.62rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);padding:14px 18px;border-bottom:1px solid var(--line);background:var(--paper-2);white-space:nowrap;}
  tbody td{padding:14px 18px;border-bottom:1px solid var(--line-2);font-size:.88rem;color:var(--ink-2);vertical-align:top;}
  tbody tr:last-child td{border-bottom:none;}
  tbody tr:hover{background:var(--paper-2);}
  td .nm{color:var(--ink);font-weight:700;}
  .badge{display:inline-block;font-family:var(--fd);font-size:.6rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;padding:.28rem .6rem;border-radius:100px;white-space:nowrap;}
  .b-quiz{color:#7c3aed;background:#f1ebff;border:1px solid #e2d5ff;}
  .b-contact{color:#2563eb;background:#e8f0ff;border:1px solid #d3e2ff;}
  .b-personal{color:#2563eb;background:#e8f0ff;border:1px solid #d3e2ff;}
  .b-business{color:#0d9488;background:#e3f7f4;border:1px solid #c3ede7;}
  .b-financial{color:#c2410c;background:#fdeee3;border:1px solid #f6dcc7;}
  .b-gold{color:var(--gold-deep);background:#fbf3d9;border:1px solid #f2e4bd;}
  .b-ok{color:var(--ok);background:var(--ok-soft);border:1px solid #cdeede;}
  .chips{display:flex;flex-wrap:wrap;gap:5px;margin-top:4px;}
  .chips span{font-size:.72rem;color:var(--ink-2);background:var(--paper-2);border:1px solid var(--line);padding:2px 8px;border-radius:100px;}
  .muted{color:var(--muted);}
  .amount{font-family:var(--fd);font-weight:800;color:var(--gold-deep);}
  .empty{padding:3rem 1rem;text-align:center;color:var(--muted);}

  .mobtoggle{display:none;}
  @media (max-width:1080px){.c6{grid-template-columns:repeat(3,1fr);}.c5{grid-template-columns:repeat(2,1fr);}}
  @media (max-width:900px){
    .layout{grid-template-columns:1fr;}
    .side{position:fixed;z-index:40;width:250px;left:0;transform:translateX(-100%);transition:transform .4s var(--ease);}
    .side.open{transform:none;}
    .mobtoggle{display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:12px;background:var(--navy);color:#fff;border:none;cursor:pointer;position:fixed;top:14px;left:14px;z-index:50;}
    .main{padding-top:70px;}
    .banner{flex-direction:column;text-align:center;}
    .banner-stats{width:100%;justify-content:center;}
    .two{grid-template-columns:1fr;}
  }
  @media (max-width:620px){.c6,.c5{grid-template-columns:1fr 1fr;}.banner-text h1{font-size:1.5rem;}}
  @media (max-width:440px){.c6,.c5{grid-template-columns:1fr;}}
</style>
</head>
<body>
@php
  $fmt = fn($n) => '$'.number_format($n, 2);
  $srcLabel = fn($s) => [
      'quiz' => 'Popup Quiz', 'personal' => 'Personal Credit', 'business' => 'Business Credit',
      'financial' => 'Financial Investments', 'contact' => 'Contact Form',
  ][$s] ?? ($s ?: 'Website');
  $srcBadge = fn($s) => in_array($s, ['quiz','personal','business','financial']) ? 'b-'.$s : 'b-contact';
@endphp

<button class="mobtoggle" id="mobToggle" aria-label="Menu">☰</button>

<div class="layout">
  <!-- ===== SIDEBAR ===== -->
  <aside class="side" id="side">
    <div class="side-top">
      <img src="{{ asset('images/owner.jpeg') }}" alt="Stanley Durosier" />
      <div><b>Stanley Durosier</b><span>ADMIN · V1</span></div>
    </div>
    <nav class="nav" id="nav">
      <a class="on" data-view="dashboard"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg> Dashboard</a>
      <a data-view="leads"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> All Leads</a>
      <a data-view="quiz"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2 2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg> Popup Leads</a>
      <a data-view="personal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20M6 15h4"/></svg> Personal Credit Leads</a>
      <a data-view="business"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 21h18M5 21V7l7-4 7 4v14M9 9h.01M15 9h.01M9 13h.01M15 13h.01"/></svg> Business Credit Leads</a>
      <a data-view="financial"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 17l6-6 4 4 8-8M21 7v6M21 7h-6"/></svg> Financial Investments Leads</a>
      <div class="sep"></div>
      <a data-view="onboarded"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="m19 8 2 2 4-4"/></svg> Onboarded Clients</a>
      <a data-view="orders"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18M16 10a4 4 0 0 1-8 0"/></svg> Paid Clients</a>
      <div class="sep"></div>
      <a href="{{ url('/') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 17 17 7M7 7h10v10"/></svg> View site</a>
    </nav>
    <form class="signout" method="POST" action="{{ route('admin.logout') }}">@csrf<button type="submit">Sign out</button></form>
  </aside>

  <!-- ===== MAIN ===== -->
  <main class="main">
    <div class="topsearch">
      <input id="globalSearch" placeholder="Search across leads, orders, contact &amp; popup submissions…" />
      <button type="button" id="searchBtn">Search</button>
    </div>

    @if(session('status'))
      <div style="margin:0 0 16px;padding:13px 16px;border-radius:12px;background:#fdf6e3;border:1px solid #e6c458;color:#5a4a10;font-weight:600">
        {{ session('status') }}
      </div>
    @endif

    <!-- ===== DASHBOARD VIEW ===== -->
    <section class="view on" data-view="dashboard">
      <div class="banner">
        <img class="banner-photo" src="{{ asset('images/owner.jpeg') }}" alt="Stanley Durosier" />
        <div class="banner-text">
          <span class="wb">Welcome Back · {{ $now->format('l, M j, Y') }}</span>
          <h1>Stanley <em>Durosier.</em></h1>
          <p>Founder &amp; Chief Strategist · Tycoon Duro Inc.</p>
          <p class="dim">Everything that came through your forms — leads, orders, contact &amp; popup — lives below.</p>
        </div>
        <div class="banner-stats">
          <div class="bstat"><b>{{ $stats['total_submissions'] }}</b><span>Total Submissions</span></div>
          <div class="bstat gold"><b>{{ $stats['today_submissions'] }}</b><span>Today</span></div>
        </div>
      </div>

      <!-- money cards -->
      <div class="cards c6">
        <div class="card"><div class="lbl">Gross Lifetime</div><div class="val green">{{ $fmt($stats['revenue_lifetime']) }}</div><div class="sub">Reserved · before refunds</div></div>
        <div class="card"><div class="lbl">Refunded / Voided</div><div class="val red">$0.00</div><div class="sub">Lifetime</div></div>
        <div class="card"><div class="lbl">Today</div><div class="val">{{ $fmt($stats['revenue_today']) }}</div><div class="sub">Captured today</div></div>
        <div class="card"><div class="lbl">Month To Date</div><div class="val">{{ $fmt($stats['revenue_month']) }}</div><div class="sub">This month</div></div>
        <div class="card"><div class="lbl">Pipeline Value</div><div class="val gold">{{ $fmt($stats['revenue_lifetime']) }}</div><div class="sub">{{ $stats['orders_total'] }} orders reserved</div></div>
        <div class="card"><div class="lbl">Orders Captured</div><div class="val">{{ $stats['orders_total'] }}</div><div class="sub"><span class="up">+{{ $stats['orders_today'] }}</span> today</div></div>
      </div>

      <!-- category cards: one per form + onboarded -->
      <div class="cards c6">
        <div class="card" data-view="leads" style="cursor:pointer"><div class="lbl">Total Leads</div><div class="val">{{ $stats['leads_total'] }}</div><div class="sub">All 4 forms combined</div></div>
        <div class="card" data-view="quiz" style="cursor:pointer"><div class="lbl">Popup Leads</div><div class="val">{{ $stats['quiz']['total'] }}</div><div class="sub"><span class="up">+{{ $stats['quiz']['today'] }}</span> today · {{ $stats['quiz']['week'] }} wk</div></div>
        <div class="card" data-view="personal" style="cursor:pointer"><div class="lbl">Personal Credit</div><div class="val">{{ $stats['personal']['total'] }}</div><div class="sub"><span class="up">+{{ $stats['personal']['today'] }}</span> today · {{ $stats['personal']['week'] }} wk</div></div>
        <div class="card" data-view="business" style="cursor:pointer"><div class="lbl">Business Credit</div><div class="val">{{ $stats['business']['total'] }}</div><div class="sub"><span class="up">+{{ $stats['business']['today'] }}</span> today · {{ $stats['business']['week'] }} wk</div></div>
        <div class="card" data-view="financial" style="cursor:pointer"><div class="lbl">Financial Invest.</div><div class="val">{{ $stats['financial']['total'] }}</div><div class="sub"><span class="up">+{{ $stats['financial']['today'] }}</span> today · {{ $stats['financial']['week'] }} wk</div></div>
        <div class="card" data-view="onboarded" style="cursor:pointer"><div class="lbl">Onboarded Clients</div><div class="val gold">{{ $stats['onboarded_total'] }}</div><div class="sub"><span class="up">+{{ $stats['onboarded_today'] }}</span> today · {{ $stats['onboarded_week'] }} wk</div></div>
      </div>

      <!-- latest lists -->
      <div class="two">
        <div class="list">
          <div class="list-head"><h3>Latest Paying Customers</h3><a data-view="orders">View all →</a></div>
          @forelse($latestOrders as $o)
            <div class="row">
              <div class="r-main"><b>{{ $o->name ?: '—' }}</b><span>{{ $o->plan ?: 'Order' }}</span></div>
              <div class="r-side"><b>{{ $o->amount ?: '—' }}</b><span>{{ $o->created_at?->diffForHumans() }}</span></div>
            </div>
          @empty
            <div class="empty">No paying customers yet — checkout orders will appear here.</div>
          @endforelse
        </div>
        <div class="list">
          <div class="list-head"><h3>Latest Submissions</h3><a data-view="leads">View all →</a></div>
          @forelse($latestLeads as $l)
            <div class="row">
              <div class="r-main"><b>{{ $l->name ?: ($l->email ?: '—') }}</b><span>{{ $srcLabel($l->source) }}{{ $l->interest ? ' · '.$l->interest : '' }}</span></div>
              <div class="r-side"><span>{{ $l->created_at?->diffForHumans() }}</span></div>
            </div>
          @empty
            <div class="empty">No submissions yet — popup &amp; contact leads will appear here.</div>
          @endforelse
        </div>
      </div>
    </section>

    <!-- ===== LEADS TABLE VIEW (all / quiz / contact reuse this) ===== -->
    <section class="view" data-view="leads">
      <div class="view-head"><div><h2 id="leadsTitle">All Leads</h2><p id="leadsSub">Every popup &amp; contact submission.</p></div></div>
      <div class="tablewrap"><div class="scroll">
        <table id="leadsTable">
          <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Source</th><th>Details</th><th>Date</th></tr></thead>
          <tbody>
            @forelse($leads as $l)
              <tr data-source="{{ $l->source }}">
                <td><span class="nm">{{ $l->name ?: '—' }}</span></td>
                <td>{{ $l->email ?: '—' }}</td>
                <td>{{ $l->phone ?: '—' }}</td>
                <td><span class="badge {{ $srcBadge($l->source) }}">{{ $srcLabel($l->source) }}</span></td>
                <td>
                  @if($l->interest)<div>{{ $l->interest }}</div>@endif
                  @if(is_array($l->profile) && count($l->profile))<div class="chips">@foreach($l->profile as $v)<span>{{ $v }}</span>@endforeach</div>@endif
                  @if($l->message)<div class="muted" style="margin-top:4px">{{ \Illuminate\Support\Str::limit($l->message, 90) }}</div>@endif
                  @if(!$l->interest && !$l->message && !(is_array($l->profile) && count($l->profile)))<span class="muted">—</span>@endif
                </td>
                <td class="muted" style="white-space:nowrap">{{ $l->created_at?->format('M j, g:ia') }}</td>
              </tr>
            @empty
              <tr><td colspan="6"><div class="empty">No leads yet.</div></td></tr>
            @endforelse
          </tbody>
        </table>
      </div></div>
    </section>

    <!-- ===== ORDERS TABLE VIEW ===== -->
    <section class="view" data-view="orders">
      <div class="view-head"><div><h2>Paid Clients</h2><p>Everyone who checked out a program.</p></div></div>
      <div class="tablewrap"><div class="scroll">
        <table id="ordersTable">
          <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Plan</th><th>Amount</th><th>Status</th><th>Date</th></tr></thead>
          <tbody>
            @forelse($orders as $o)
              <tr>
                <td><span class="nm">{{ $o->name ?: '—' }}</span></td>
                <td>{{ $o->email ?: '—' }}</td>
                <td>{{ $o->phone ?: '—' }}</td>
                <td>{{ $o->plan ?: '—' }}</td>
                <td><span class="amount">{{ $o->amount ?: '—' }}</span></td>
                <td><span class="badge {{ $o->status === 'paid' ? 'b-ok' : 'b-gold' }}">{{ $o->status }}</span></td>
                <td class="muted" style="white-space:nowrap">{{ $o->created_at?->format('M j, g:ia') }}</td>
              </tr>
            @empty
              <tr><td colspan="7"><div class="empty">No orders yet.</div></td></tr>
            @endforelse
          </tbody>
        </table>
      </div></div>
    </section>

    <!-- ===== ONBOARDED CLIENTS TABLE VIEW ===== -->
    <section class="view" data-view="onboarded">
      <div class="view-head"><div><h2>Onboarded Clients</h2><p>Secure client intake submissions — documents &amp; credit-monitoring logins.</p></div></div>
      <div class="tablewrap"><div class="scroll">
        <table id="onboardTable">
          <thead><tr>
            <th>Client</th><th>Contact</th><th>DOB</th><th>SSN</th><th>Address</th>
            <th>Documents</th><th>Credit Monitoring</th><th>APEX</th><th>Date</th>
          </tr></thead>
          <tbody>
            @forelse($onboardings as $c)
              <tr>
                <td><span class="nm">{{ $c->fullName() ?: '—' }}</span></td>
                <td>{{ $c->email }}<div class="muted">{{ $c->phone ?: '—' }}</div></td>
                <td class="muted" style="white-space:nowrap">{{ optional($c->dob)->format('m/d/Y') ?: '—' }}</td>
                <td style="font-family:monospace">{{ $c->ssn ?: '—' }}</td>
                <td class="muted">{{ trim(collect([$c->street, $c->apt])->filter()->implode(', ')) ?: '—' }}<div>{{ trim(collect([$c->city, $c->state, $c->zip])->filter()->implode(', ')) }}</div></td>
                <td>
                  <div class="chips">
                    @if($c->dl_path)<a href="{{ route('admin.onboarding.doc', [$c->id, 'dl']) }}" target="_blank"><span>DL ↓</span></a>@endif
                    @if($c->ssn_card_path)<a href="{{ route('admin.onboarding.doc', [$c->id, 'ssncard']) }}" target="_blank"><span>SSN Card ↓</span></a>@endif
                    @if($c->proof_address_path)<a href="{{ route('admin.onboarding.doc', [$c->id, 'proof']) }}" target="_blank"><span>Proof ↓</span></a>@endif
                    @if(!$c->dl_path && !$c->ssn_card_path && !$c->proof_address_path)<span class="muted">—</span>@endif
                  </div>
                </td>
                <td>
                  @if($c->cm_provider || $c->cm_email)
                    <b>{{ $c->cm_provider ?: '—' }}</b>
                    <div class="muted">{{ $c->cm_email ?: '—' }}</div>
                    <div style="font-family:monospace">{{ $c->cm_password ?: '—' }}</div>
                    @if($c->cm_security_answer)<div class="muted">Q: {{ $c->cm_security_answer }}</div>@endif
                  @else <span class="muted">—</span> @endif
                </td>
                <td>
                  <span class="badge {{ $c->apex_synced ? 'b-ok' : 'b-gold' }}">{{ $c->apex_synced ? 'synced' : 'pending' }}</span>
                  @unless($c->apex_synced)
                    {{-- the reason was always recorded but never shown, so "pending" looked causeless --}}
                    @if($c->apex_note)
                      <div class="muted" style="margin-top:6px;max-width:230px;font-size:11px;line-height:1.4" title="{{ $c->apex_note }}">{{ $c->apex_note }}</div>
                    @endif
                    <form method="POST" action="{{ route('admin.onboarding.apex', $c->id) }}" style="margin-top:6px">
                      @csrf
                      <button type="submit" class="badge" style="cursor:pointer;border:0;font:inherit;font-size:11px">Retry APEX ↻</button>
                    </form>
                  @endunless
                </td>
                <td class="muted" style="white-space:nowrap">{{ $c->created_at?->format('M j, g:ia') }}</td>
              </tr>
            @empty
              <tr><td colspan="9"><div class="empty">No onboarded clients yet — <a href="{{ route('onboarding.show') }}" target="_blank" style="color:var(--gold-deep)">/onboarding</a> submissions appear here.</div></td></tr>
            @endforelse
          </tbody>
        </table>
      </div></div>
    </section>
  </main>
</div>

<script>
  (function(){
    var navLinks = document.querySelectorAll('.nav a[data-view]');
    var views = document.querySelectorAll('.view[data-view]');
    var leadsTitle = document.getElementById('leadsTitle');
    var leadsSub = document.getElementById('leadsSub');

    var LEAD_SOURCES = ['quiz','personal','business','financial'];
    var LEAD_LABELS = {
      quiz:      ['Popup Leads', 'Everyone who completed the popup quiz.'],
      personal:  ['Personal Credit Leads', 'Leads from the Personal Credit page form.'],
      business:  ['Business Credit Leads', 'Leads from the Business Credit page form.'],
      financial: ['Financial Investments Leads', 'Leads from the Financial Investments page form.'],
    };

    function show(view, source){
      navLinks.forEach(function(a){ a.classList.toggle('on', a.getAttribute('data-view') === view); });

      // the four lead sources all render in the shared leads table (filtered)
      var target = LEAD_SOURCES.indexOf(view) > -1 ? 'leads' : view;
      views.forEach(function(v){ v.classList.toggle('on', v.getAttribute('data-view') === target); });

      if (target === 'leads') {
        var rows = document.querySelectorAll('#leadsTable tbody tr[data-source]');
        rows.forEach(function(tr){
          tr.style.display = (!source || tr.getAttribute('data-source') === source) ? '' : 'none';
        });
        if (leadsTitle) {
          var lbl = source && LEAD_LABELS[source] ? LEAD_LABELS[source] : ['All Leads', 'Every submission across all four forms.'];
          leadsTitle.textContent = lbl[0];
          leadsSub.textContent = lbl[1];
        }
      }
      window.scrollTo({top:0,behavior:'smooth'});
    }

    document.querySelectorAll('[data-view]').forEach(function(el){
      if (el.tagName === 'SECTION') return;
      el.addEventListener('click', function(e){
        var v = el.getAttribute('data-view');
        var src = LEAD_SOURCES.indexOf(v) > -1 ? v : '';
        show(v, src);
        document.getElementById('side').classList.remove('open');
      });
    });

    // global search → jump to leads, filter across both tables
    function runSearch(q){
      q = q.toLowerCase().trim();
      if (!q) return;
      show('leads','');
      document.querySelectorAll('#leadsTable tbody tr').forEach(function(tr){
        if (tr.querySelector('.empty')) return;
        tr.style.display = tr.textContent.toLowerCase().indexOf(q) > -1 ? '' : 'none';
      });
    }
    document.getElementById('globalSearch').addEventListener('input', function(e){
      var q = e.target.value.toLowerCase().trim();
      var active = document.querySelector('.view.on');
      if (active && active.getAttribute('data-view') === 'dashboard') { if(q) runSearch(q); return; }
      var tbl = active.querySelector('table');
      if (!tbl) return;
      tbl.querySelectorAll('tbody tr').forEach(function(tr){
        if (tr.querySelector('.empty')) return;
        if (tr.style.display === 'none' && tr.getAttribute('data-source')) return;
        tr.style.display = tr.textContent.toLowerCase().indexOf(q) > -1 ? '' : 'none';
      });
    });
    document.getElementById('searchBtn').addEventListener('click', function(){ runSearch(document.getElementById('globalSearch').value); });

    // mobile sidebar
    var mt = document.getElementById('mobToggle');
    if (mt) mt.addEventListener('click', function(){ document.getElementById('side').classList.toggle('open'); });
  })();
</script>

<!-- ===== IDLE TIMEOUT ===== -->
<div class="idle" id="idleModal" role="dialog" aria-modal="true" aria-labelledby="idleTitle" hidden>
  <div class="idle-card">
    <div class="idle-ic" aria-hidden="true">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
    </div>
    <h3 id="idleTitle">Still there?</h3>
    <p>You've been inactive for {{ (int) config('tycoon.admin.idle_minutes', 10) }} minutes. For security you'll be signed out in <b id="idleCount">{{ (int) config('tycoon.admin.warn_seconds', 60) }}</b> seconds.</p>
    <div class="idle-bar"><i id="idleBar"></i></div>
    <div class="idle-actions">
      <button type="button" class="idle-stay" id="idleStay">Stay signed in</button>
      <button type="button" class="idle-out" id="idleOut">Sign out now</button>
    </div>
  </div>
</div>

<form id="idleLogout" method="POST" action="{{ route('admin.logout') }}" hidden>@csrf<input type="hidden" name="reason" value="idle" /></form>

<script>
  (function () {
    "use strict";
    var IDLE_MS   = {{ (int) config('tycoon.admin.idle_minutes', 10) }} * 60 * 1000;
    var WARN_SECS = {{ (int) config('tycoon.admin.warn_seconds', 60) }};
    var EXTEND_URL = "{{ route('admin.session.extend') }}";
    var LOGIN_URL  = "{{ route('admin.login') }}";

    var modal = document.getElementById('idleModal');
    var countEl = document.getElementById('idleCount');
    var barEl = document.getElementById('idleBar');
    var form = document.getElementById('idleLogout');
    var token = document.querySelector('#idleLogout input[name=_token]');

    // Timestamp-based rather than a rolling setTimeout: mousemove fires constantly
    // (resetting a timer each time is wasted work), and comparing wall-clock time
    // means a slept/suspended laptop is correctly treated as idle on wake.
    var lastActivity = Date.now(), warnStartedAt = 0, warning = false, tickTimer = null;

    function signOut() {
      clearInterval(tickTimer);
      form.submit();   // POST so the server clears the session properly
    }

    function showWarning() {
      warning = true;
      warnStartedAt = Date.now();
      countEl.textContent = WARN_SECS;
      barEl.style.width = '100%';
      modal.hidden = false;
      document.getElementById('idleStay').focus();

      tickTimer = setInterval(function () {
        var left = Math.ceil((WARN_SECS * 1000 - (Date.now() - warnStartedAt)) / 1000);
        countEl.textContent = left > 0 ? left : 0;
        barEl.style.width = Math.max(0, Math.min(100, (left / WARN_SECS) * 100)) + '%';
        if (left <= 0) signOut();
      }, 250);
    }

    function resetIdle() {
      if (warning) return;              // only the buttons dismiss the warning
      lastActivity = Date.now();
    }

    // single low-frequency watchdog instead of one timer per event
    setInterval(function () {
      if (!warning && (Date.now() - lastActivity) >= IDLE_MS) showWarning();
    }, 1000);

    function staySignedIn() {
      clearInterval(tickTimer);
      modal.hidden = true;
      warning = false;

      fetch(EXTEND_URL, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': token.value, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
        credentials: 'same-origin'
      }).then(function (r) {
        if (r.status === 401) { window.location.href = LOGIN_URL; return null; }
        return r.ok ? r.json() : null;
      }).then(function (data) {
        // rotate to the fresh CSRF token so later posts cannot 419
        if (data && data.csrf) {
          token.value = data.csrf;
          document.querySelectorAll('input[name=_token]').forEach(function (i) { i.value = data.csrf; });
          var meta = document.querySelector('meta[name=csrf-token]');
          if (meta) meta.setAttribute('content', data.csrf);
        }
      }).catch(function () { /* offline — the timer still protects the session */ });

      resetIdle();
    }

    document.getElementById('idleStay').addEventListener('click', staySignedIn);
    document.getElementById('idleOut').addEventListener('click', signOut);

    ['mousemove', 'mousedown', 'keydown', 'scroll', 'touchstart', 'click'].forEach(function (evt) {
      window.addEventListener(evt, resetIdle, { passive: true });
    });

    // Returning to the tab after the machine slept: the countdown may be stale,
    // so re-check with the server rather than trusting the local timer.
    document.addEventListener('visibilitychange', function () {
      if (document.visibilityState !== 'visible' || warning) return;
      fetch(EXTEND_URL, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': token.value, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
        credentials: 'same-origin'
      }).then(function (r) { if (r.status === 401) window.location.href = LOGIN_URL; })
        .catch(function () {});
    });

    resetIdle();
  })();
</script>
</body>
</html>
