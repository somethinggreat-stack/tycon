<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Secure Checkout — Tycoon Duro Inc.</title>
<meta name="robots" content="noindex, nofollow" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="order-endpoint" content="{{ route('order.store') }}" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />
<style>
  :root{
    --navy:#0A1F44; --navy-900:#060F26; --navy-800:#0A1F44; --navy-700:#10294F;
    --gold:#C9A227; --gold-bright:#E6C458; --gold-deep:#A6851C;
    --white:#fff; --ink-soft:rgba(255,255,255,0.74); --ink-faint:rgba(255,255,255,0.5);
    --line:rgba(201,162,39,0.22); --line-soft:rgba(255,255,255,0.08);
    --card:rgba(16,41,79,0.34); --ok:#4ade80; --err:#f87171;
    --grad-gold:linear-gradient(135deg,#E6C458 0%,#C9A227 45%,#A6851C 100%);
    --ease:cubic-bezier(0.22,1,0.36,1);
    --fd:'Sora',sans-serif; --fb:'Plus Jakarta Sans',sans-serif;
  }
  *{margin:0;padding:0;box-sizing:border-box;-webkit-tap-highlight-color:transparent;}
  body{font-family:var(--fb);color:var(--white);line-height:1.55;-webkit-font-smoothing:antialiased;overflow-x:hidden;
    background:radial-gradient(1100px 700px at 50% -10%,#12305c 0%,transparent 55%),linear-gradient(180deg,#0A1F44,#060F26 60%,#04081A);
    background-attachment:fixed;min-height:100vh;}
  a{color:inherit;text-decoration:none;}
  img{display:block;max-width:100%;}
  ::selection{background:var(--gold);color:var(--navy-900);}
  .wrap{max-width:1140px;margin:0 auto;padding:0 clamp(1rem,3vw,2rem);}

  /* nav */
  .cnav{position:sticky;top:0;z-index:20;background:rgba(6,15,38,0.85);backdrop-filter:blur(16px);border-bottom:1px solid var(--line-soft);}
  .cnav-in{display:flex;align-items:center;justify-content:space-between;padding:0.75rem clamp(1rem,3vw,2rem);max-width:1140px;margin:0 auto;}
  .cnav-brand{display:flex;align-items:center;gap:0.7rem;}
  .cnav-logo{height:52px;width:auto;display:block;filter:drop-shadow(0 6px 16px rgba(0,0,0,0.45));}
  .cnav-brand b{display:none;}
  .cnav-secure{display:inline-flex;align-items:center;gap:0.45rem;font-size:0.76rem;font-weight:700;color:var(--ok);background:rgba(74,222,128,0.1);border:1px solid rgba(74,222,128,0.25);padding:0.4rem 0.85rem;border-radius:100px;}
  .cnav-secure svg{width:15px;height:15px;}

  /* hero */
  .chero{text-align:center;padding:clamp(2rem,5vw,3.4rem) 0 clamp(1.3rem,3vw,2rem);}
  .chero-badges{display:flex;flex-wrap:wrap;justify-content:center;gap:0.5rem;margin-bottom:1.3rem;}
  .cbadge{font-size:0.64rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--gold-bright);
    background:rgba(201,162,39,0.08);border:1px solid var(--line);padding:0.4rem 0.85rem;border-radius:100px;}
  .chero h1{font-family:var(--fd);font-size:clamp(1.9rem,5.2vw,3rem);font-weight:800;letter-spacing:-0.02em;line-height:1.08;}
  .chero h1 span{background:var(--grad-gold);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;}
  .chero-sub{margin:0.9rem auto 0;max-width:40rem;color:var(--ink-soft);font-size:1.02rem;}
  .score{display:inline-flex;align-items:center;gap:1.1rem;margin-top:1.6rem;padding:0.7rem 1.5rem;background:var(--card);border:1px solid var(--line);border-radius:16px;}
  .score b{font-family:var(--fd);font-size:1.7rem;font-weight:800;}
  .score .s-old{color:var(--ink-faint);text-decoration:line-through;}
  .score .s-arrow{color:var(--gold);font-size:1.2rem;}
  .score .s-new{background:var(--grad-gold);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;}
  .score small{display:block;font-size:0.58rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--ink-faint);text-align:left;}

  /* grid */
  .grid{display:grid;grid-template-columns:1fr 390px;gap:1.5rem;align-items:start;padding-bottom:3.5rem;}
  .block{background:var(--card);border:1px solid var(--line-soft);border-radius:20px;padding:clamp(1.2rem,2.5vw,1.8rem);margin-bottom:1.3rem;backdrop-filter:blur(6px);}
  .block-head{display:flex;align-items:center;gap:0.6rem;margin-bottom:1.3rem;}
  .block-head .bh-n{display:grid;place-items:center;width:28px;height:28px;border-radius:9px;font-family:var(--fd);font-size:0.8rem;font-weight:800;color:var(--navy-900);background:var(--grad-gold);}
  .block-head h2{font-family:var(--fd);font-size:0.72rem;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:var(--ink-faint);}

  .frow{display:grid;grid-template-columns:1fr 1fr;gap:0.9rem;}
  .field{margin-bottom:0.9rem;}
  .field.full{grid-column:1 / -1;}
  .field label{display:block;font-size:0.68rem;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;color:var(--ink-faint);margin-bottom:0.4rem;}
  .field label i{color:var(--gold-bright);font-style:normal;}
  .field input,.field select{width:100%;font-family:inherit;font-size:0.95rem;color:var(--white);padding:0.85rem 0.95rem;border-radius:12px;
    border:1.5px solid var(--line-soft);background:rgba(255,255,255,0.04);outline:none;transition:border-color 0.25s,box-shadow 0.25s,background 0.25s;}
  .field input::placeholder{color:rgba(255,255,255,0.32);}
  .field select{color:var(--ink-soft);}
  .field select option{background:var(--navy-800);color:var(--white);}
  .field input:focus,.field select:focus{border-color:var(--gold);background:rgba(201,162,39,0.06);box-shadow:0 0 0 3px rgba(201,162,39,0.14);}

  .pay-prog{display:flex;align-items:center;gap:0.8rem;margin-bottom:1.2rem;}
  .pay-prog .bar{flex:1;height:7px;border-radius:7px;background:rgba(255,255,255,0.08);overflow:hidden;}
  .pay-prog .bar i{display:block;height:100%;width:0;border-radius:7px;background:var(--grad-gold);box-shadow:0 0 12px rgba(201,162,39,0.6);transition:width 0.4s var(--ease);}
  .pay-prog span{font-size:0.72rem;font-weight:700;color:var(--gold-bright);white-space:nowrap;}

  .card-box{border:1.5px solid var(--line-soft);border-radius:14px;padding:1rem;background:rgba(255,255,255,0.02);}
  .card-box-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:0.85rem;}
  .card-box-top .cb-lock{display:inline-flex;align-items:center;gap:0.4rem;font-size:0.72rem;font-weight:700;color:var(--ok);}
  .card-box-top .cb-lock svg{width:13px;height:13px;}
  .card-brands{display:flex;gap:0.3rem;}
  .card-brands span{font-size:0.55rem;font-weight:800;color:#fff;padding:0.2rem 0.35rem;border-radius:4px;letter-spacing:0.03em;}
  .cb-visa{background:#1a1f71}.cb-mc{background:#eb001b}.cb-amex{background:#2e77bc}.cb-disc{background:#f68121}

  .trust-row{display:flex;flex-wrap:wrap;gap:0.5rem;margin-top:1rem;}
  .trust-chip{display:inline-flex;align-items:center;gap:0.4rem;font-size:0.7rem;font-weight:600;color:var(--ink-soft);background:rgba(255,255,255,0.03);border:1px solid var(--line-soft);padding:0.4rem 0.7rem;border-radius:8px;}
  .trust-chip svg{width:13px;height:13px;color:var(--ok);}

  .agree{display:flex;gap:0.7rem;align-items:flex-start;padding:0.7rem 0;font-size:0.86rem;color:var(--ink-soft);}
  .agree + .agree{border-top:1px solid var(--line-soft);}
  .agree input{margin-top:0.15rem;width:18px;height:18px;accent-color:var(--gold);flex-shrink:0;cursor:pointer;}
  .agree a{color:var(--gold-bright);font-weight:700;}
  .agree.highlight{background:rgba(201,162,39,0.07);border:1px solid var(--line);border-radius:12px;padding:0.85rem 1rem;}

  /* summary */
  .summary{position:sticky;top:84px;background:var(--card);border:1px solid var(--line);border-radius:22px;overflow:hidden;box-shadow:0 40px 90px -40px rgba(0,0,0,0.7);}
  .sum-head{padding:1.4rem 1.6rem;background:linear-gradient(135deg,#10294F,#060F26);position:relative;overflow:hidden;border-bottom:1px solid var(--line);}
  .sum-head::after{content:"";position:absolute;right:-30%;top:-60%;width:250px;height:250px;background:radial-gradient(circle,rgba(201,162,39,0.35),transparent 62%);}
  .sum-flag{position:relative;z-index:1;display:inline-block;font-family:var(--fd);font-size:0.6rem;font-weight:800;letter-spacing:0.14em;text-transform:uppercase;color:var(--navy-900);background:var(--grad-gold);padding:0.32rem 0.75rem;border-radius:100px;margin-bottom:0.7rem;}
  .sum-head h3{position:relative;z-index:1;font-family:var(--fd);font-size:1.3rem;font-weight:800;}
  .sum-head p{position:relative;z-index:1;font-size:0.82rem;color:var(--ink-soft);margin-top:0.25rem;}
  .sum-body{padding:1.4rem 1.6rem;}
  .sum-feat{list-style:none;display:flex;flex-direction:column;gap:0.65rem;margin-bottom:1.3rem;}
  .sum-feat li{display:flex;gap:0.6rem;font-size:0.86rem;color:var(--ink-soft);}
  .sum-feat li svg{width:17px;height:17px;flex-shrink:0;margin-top:1px;color:var(--gold-bright);}
  .sum-line{display:flex;justify-content:space-between;align-items:center;font-size:0.9rem;padding:0.5rem 0;color:var(--ink-faint);}
  .sum-line b{color:var(--white);font-weight:700;}
  .sum-line.free b{color:var(--ok);}
  .sum-total{display:flex;justify-content:space-between;align-items:flex-end;padding:1rem 0 0.4rem;border-top:2px solid var(--line);margin-top:0.5rem;}
  .sum-total span{font-family:var(--fd);font-size:0.7rem;font-weight:800;letter-spacing:0.1em;text-transform:uppercase;color:var(--ink-faint);}
  .sum-total b{font-family:var(--fd);font-size:2rem;font-weight:800;letter-spacing:-0.02em;background:var(--grad-gold);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;}
  .sum-note{font-size:0.72rem;color:var(--ink-faint);margin-bottom:1.2rem;}
  .checkout-btn{width:100%;padding:1.15rem;border:none;border-radius:15px;cursor:pointer;color:var(--navy-900);font-family:var(--fd);font-weight:800;font-size:1rem;background:var(--grad-gold);box-shadow:0 18px 40px -14px rgba(201,162,39,0.6);transition:transform 0.3s var(--ease),box-shadow 0.3s,opacity 0.3s;display:flex;align-items:center;justify-content:center;gap:0.5rem;}
  .checkout-btn:hover{transform:translateY(-2px);box-shadow:0 24px 50px -14px rgba(201,162,39,0.8);}
  .checkout-btn:disabled{opacity:0.65;cursor:progress;transform:none;}
  .checkout-btn svg{width:17px;height:17px;}
  .guarantee{display:flex;gap:0.6rem;align-items:flex-start;margin-top:1.1rem;padding-top:1.1rem;border-top:1px solid var(--line-soft);font-size:0.76rem;color:var(--ink-faint);}
  .guarantee svg{width:22px;height:22px;flex-shrink:0;color:var(--gold-bright);}

  .err{color:var(--err);font-size:0.82rem;margin-top:0.6rem;min-height:1em;text-align:center;font-weight:600;}
  .foot-secure{text-align:center;color:var(--ink-faint);font-size:0.76rem;padding:1.5rem 0 2.5rem;}
  .powered{display:inline-flex;align-items:center;gap:0.35rem;margin-top:0.5rem;font-size:0.68rem;color:var(--ink-faint);}

  .done{position:fixed;inset:0;z-index:50;display:none;place-items:center;padding:1.5rem;background:rgba(3,6,15,0.7);backdrop-filter:blur(10px);}
  .done.show{display:grid;}
  .done-card{max-width:430px;text-align:center;background:linear-gradient(180deg,#0c2350,#060f26);border:1px solid var(--line);border-radius:24px;padding:2.5rem 2rem;box-shadow:0 60px 120px -40px rgba(0,0,0,0.85);animation:pop 0.5s var(--ease);}
  @keyframes pop{from{opacity:0;transform:scale(0.9) translateY(16px);}to{opacity:1;transform:none;}}
  .done-ic{width:78px;height:78px;margin:0 auto 1.3rem;border-radius:50%;display:grid;place-items:center;font-size:2rem;color:var(--navy-900);background:var(--grad-gold);box-shadow:0 0 0 8px rgba(201,162,39,0.14);}
  .done-card h3{font-family:var(--fd);font-size:1.4rem;font-weight:800;margin-bottom:0.5rem;}
  .done-card p{font-size:0.92rem;color:var(--ink-soft);margin-bottom:1.4rem;}
  .done-card a{display:inline-block;padding:0.9rem 1.6rem;border-radius:12px;color:var(--navy-900);font-family:var(--fd);font-weight:700;background:var(--grad-gold);}

  @media (max-width:900px){.grid{grid-template-columns:1fr;}.summary{position:static;order:-1;}}
  @media (max-width:520px){.frow{grid-template-columns:1fr;}.chero h1{font-size:1.8rem;}.cnav-brand b{display:none;}}
</style>
</head>
<body>

<header class="cnav">
  <div class="cnav-in">
    <a href="{{ url('/') }}" class="cnav-brand"><img class="cnav-logo" src="{{ asset('images/logo.png') }}" alt="Tycoon Duro Inc." /></a>
    <span class="cnav-secure"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg> Encrypted &amp; Secure</span>
  </div>
</header>

<div class="wrap">
  <section class="chero">
    <div class="chero-badges">
      <span class="cbadge">👑 Founded by Stanley Durosier</span>
      <span class="cbadge">★ God-Level Standard</span>
      <span class="cbadge">🔒 Bank-Level Security</span>
    </div>
    <h1 id="heroTitle">Let's Get<br /><span>You Started.</span></h1>
    <p class="chero-sub" id="heroSub">You're a few details away from your blueprint. It takes about a minute — no hidden fees, ever.</p>
    <div class="score" id="scoreBox" hidden>
      <div><small>Where you are</small><b class="s-old">560</b></div>
      <span class="s-arrow">➜</span>
      <div><small>Where we're headed</small><b class="s-new">800+</b></div>
    </div>
  </section>

  <form class="grid" id="checkoutForm" novalidate>
    <main>
      <div class="block">
        <div class="block-head"><span class="bh-n">1</span><h2>Your Details</h2></div>
        <div class="frow">
          <div class="field"><label>First Name <i>*</i></label><input name="first" placeholder="Jane" autocomplete="given-name" required /></div>
          <div class="field"><label>Last Name <i>*</i></label><input name="last" placeholder="Doe" autocomplete="family-name" required /></div>
        </div>
        <div class="frow">
          <div class="field"><label>Email Address <i>*</i></label><input type="email" name="email" placeholder="jane@example.com" autocomplete="email" required /></div>
          <div class="field"><label>Phone Number <i>*</i></label><input type="tel" name="phone" placeholder="(844) 800-3211" autocomplete="tel" required /></div>
        </div>
        <div class="field full"><label>Street Address</label><input name="street" placeholder="123 Main Street" autocomplete="address-line1" /></div>
        <div class="frow">
          <div class="field"><label>City</label><input name="city" placeholder="Boca Raton" autocomplete="address-level2" /></div>
          <div class="field"><label>State</label><input name="state" placeholder="FL" autocomplete="address-level1" /></div>
        </div>
        <div class="field" style="max-width:200px"><label>ZIP Code</label><input name="zip" placeholder="33432" autocomplete="postal-code" /></div>
      </div>

      <div class="block">
        <div class="block-head"><span class="bh-n">2</span><h2>Payment Details</h2></div>
        <div class="pay-prog"><div class="bar"><i id="progBar"></i></div><span id="progTxt">0% complete</span></div>
        <div class="card-box">
          <div class="card-box-top">
            <span class="cb-lock"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg> Encrypted end-to-end</span>
            <div class="card-brands"><span class="cb-visa">VISA</span><span class="cb-mc">MC</span><span class="cb-amex">AMEX</span><span class="cb-disc">DISC</span></div>
          </div>
          <div class="field full"><label>Name On Card</label><input id="ccname" placeholder="As printed on your card" autocomplete="cc-name" /></div>
          <div class="field full"><label>Card Number</label><input id="ccnum" placeholder="•••• •••• •••• ••••" inputmode="numeric" autocomplete="cc-number" maxlength="19" /></div>
          <div class="frow">
            <div class="field"><label>Month</label><select id="ccmonth"><option value="">MM</option></select></div>
            <div class="field"><label>Year</label><select id="ccyear"><option value="">YYYY</option></select></div>
            <div class="field"><label>CVV</label><input id="cccvv" placeholder="•••" inputmode="numeric" autocomplete="cc-csc" maxlength="4" /></div>
          </div>
        </div>
        <div class="trust-row">
          <span class="trust-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg> PCI-DSS Compliant</span>
          <span class="trust-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg> 256-Bit SSL</span>
          <span class="trust-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg> Secure Processing</span>
        </div>
      </div>

      <div class="block">
        <div class="block-head"><span class="bh-n">3</span><h2>Quick Confirmations</h2></div>
        <label class="agree highlight"><input type="checkbox" name="a_review" /> <span>I've reviewed my plan and details and everything is correct.</span></label>
        <label class="agree"><input type="checkbox" name="a_terms" required /> <span>I agree to the <a href="{{ route('legal.terms') }}" target="_blank">Terms of Service</a> and authorize payment for the program I chose.</span></label>
        <label class="agree"><input type="checkbox" name="a_privacy" required /> <span>I agree to the <a href="{{ route('legal.privacy') }}" target="_blank">Privacy Policy</a> and consent to be contacted about my order.</span></label>
        <label class="agree"><input type="checkbox" name="a_marketing" /> <span>Send me Tycoon Duro's credit, funding &amp; wealth tips and member-only offers <em>(optional)</em>.</span></label>
      </div>
    </main>

    <aside>
      <div class="summary">
        <div class="sum-head">
          <span class="sum-flag" id="sumFlag">Your Program</span>
          <h3 id="sumName">Strategic Credit Mastery</h3>
          <p id="sumTag">Advanced restoration, executed with surgical precision.</p>
        </div>
        <div class="sum-body">
          <ul class="sum-feat" id="sumFeat"></ul>
          <div id="sumLines"></div>
          <div class="sum-total"><span>Due Today</span><b id="sumTotal">$500.00</b></div>
          <p class="sum-note" id="sumNote">One-time program payment. No hidden fees.</p>
          <button type="submit" class="checkout-btn" id="payBtn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            <span id="payBtnTxt">Complete My Order</span>
          </button>
          <div class="err" id="err"></div>
          <div class="guarantee">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2 4 5v6c0 5 3.4 8.5 8 10 4.6-1.5 8-5 8-10V5z"/><path d="M9 12l2 2 4-4"/></svg>
            <span>God-Level execution, backed by a real strategic partnership. Trust the Horse.</span>
          </div>
        </div>
      </div>
      <p class="foot-secure">Your information is encrypted and never sold.<br /><span class="powered">🔒 Secure payments · © 2026 Tycoon Duro Inc.</span></p>
    </aside>
  </form>
</div>

<div class="done" id="done">
  <div class="done-card">
    <div class="done-ic">✓</div>
    <h3 id="doneTitle">You're all set!</h3>
    <p id="doneMsg">Thank you! We've received your order and our team will reach out shortly to get you started.</p>
    <a href="{{ url('/') }}" id="doneBack">Back to site</a>
  </div>
</div>

<script>
  (function(){
    "use strict";
    var CHK = "✓";
    var PLANS = {
      credit: {
        flag:"Program 01", name:"Strategic Credit Mastery", tag:"Advanced restoration, executed with surgical precision.",
        feat:["Comprehensive legal dispute frameworks","Professional documentation & escalation","Lasting removal of inaccurate items","Score optimization roadmap"],
        lines:[["Strategic Credit Mastery","$500.00"]], total:"$500.00", amountNum:"500.00", note:"One-time program payment. No hidden fees.",
        hero:["Begin Your","Credit Mastery."], sub:"Advanced, surgical credit restoration — engineered for lasting removal and a profile that commands approval.", score:true
      },
      capital: {
        flag:"Program 02", name:"Business Capital Accelerator", tag:"Complete business credit & strategic funding.",
        feat:["LLC structuring & entity foundation","Business credit profile architecture","Access to high-value capital solutions","Strategic funding acquisition"],
        lines:[["Business Capital Accelerator","$750.00"]], total:"$750.00", amountNum:"750.00", note:"One-time program payment. No hidden fees.",
        hero:["Accelerate","Your Capital."], sub:"Business credit architecture and strategic funding — structured to scale with your vision.", score:false
      },
      godlevel: {
        flag:"★ Flagship", name:"God-Level Wealth Blueprint", tag:"The complete elite system — nothing left on the table.",
        feat:["Full Strategic Credit Mastery","Complete Business Funding Strategy","Asset protection via LLCs & living trusts","The full God-Level Funding Playbook","Strategic partnership & elite execution"],
        lines:[["God-Level Wealth Blueprint","$1,000.00"],["You save","$250.00"]], total:"$1,000.00", amountNum:"1000.00", note:"One-time payment for the complete system. Best value.",
        hero:["Claim The","God-Level Blueprint."], sub:"The complete elite system — credit, capital and protection, engineered together for substantial, protected results.", score:true
      }
    };
    function esc(s){ return String(s==null?"":s).replace(/[&<>"']/g,function(c){return {"&":"&amp;","<":"&lt;",">":"&gt;","\"":"&quot;","'":"&#39;"}[c];}); }
    var key = (new URLSearchParams(location.search).get("plan")||"credit").toLowerCase();
    var p = PLANS[key] || PLANS.credit;

    document.getElementById("sumFlag").textContent = p.flag;
    document.getElementById("sumName").textContent = p.name;
    document.getElementById("sumTag").textContent = p.tag;
    document.getElementById("sumTotal").textContent = p.total;
    document.getElementById("sumNote").textContent = p.note;
    document.getElementById("sumFeat").innerHTML = p.feat.map(function(f){
      return '<li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6 9 17l-5-5"/></svg><span>'+esc(f)+'</span></li>';
    }).join("");
    document.getElementById("sumLines").innerHTML = p.lines.map(function(l){
      var cls = /save/i.test(l[0]) ? " free" : "";
      return '<div class="sum-line'+cls+'"><span>'+esc(l[0])+'</span><b>'+esc(l[1])+'</b></div>';
    }).join("");
    document.getElementById("heroTitle").innerHTML = esc(p.hero[0])+"<br><span>"+esc(p.hero[1])+"</span>";
    document.getElementById("heroSub").textContent = p.sub;
    document.getElementById("scoreBox").hidden = !p.score;
    document.title = "Checkout — " + p.name + " | Tycoon Duro Inc.";

    var mSel = document.getElementById("ccmonth"), ySel = document.getElementById("ccyear");
    for (var m=1;m<=12;m++){ var o=document.createElement("option"); o.value=("0"+m).slice(-2); o.textContent=("0"+m).slice(-2); mSel.appendChild(o); }
    var yr = 2026; for (var y=yr;y<=yr+12;y++){ var o2=document.createElement("option"); o2.value=y; o2.textContent=y; ySel.appendChild(o2); }

    var form = document.getElementById("checkoutForm");
    var tracked = form.querySelectorAll("input, select");
    function updateProg(){
      var total=0, done=0;
      tracked.forEach(function(el){ if(el.type==="checkbox") return; total++; if(String(el.value).trim()) done++; });
      var pct = total ? Math.round(done/total*100) : 0;
      document.getElementById("progBar").style.width = pct+"%";
      document.getElementById("progTxt").textContent = pct+"% complete";
    }
    form.addEventListener("input", updateProg); updateProg();

    var ccnum = document.getElementById("ccnum");
    ccnum.addEventListener("input", function(){ var v = ccnum.value.replace(/\D/g,"").slice(0,16); ccnum.value = v.replace(/(.{4})/g,"$1 ").trim(); });

    var btn = document.getElementById("payBtn"), btnTxt = document.getElementById("payBtnTxt"), err = document.getElementById("err");

    function metaContent(name){ var m=document.querySelector('meta[name="'+name+'"]'); return m?m.getAttribute("content"):null; }
    function validate(){
      var first=form.first.value.trim(), last=form.last.value.trim(), email=form.email.value.trim(), phone=form.phone.value.trim();
      if(!first||!last||!email||!phone){ err.textContent="Please fill in your name, email and phone."; return null; }
      if(!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)){ err.textContent="Please enter a valid email address."; return null; }
      if(!form.a_terms.checked||!form.a_privacy.checked){ err.textContent="Please accept the Terms and Privacy Policy to continue."; return null; }
      err.textContent="";
      return { first:first, last:last, email:email, phone:phone,
        address:[form.street.value, form.city.value, form.state.value, form.zip.value].filter(Boolean).join(", ") };
    }
    function saveOrder(info){
      var url = metaContent("order-endpoint"); if(!url) return;
      var payload = { plan:p.name, amount:p.total, source:"checkout",
        name:(info.first+" "+info.last).trim(), email:info.email, phone:info.phone, address:info.address };
      try {
        fetch(url,{method:"POST",headers:{"Content-Type":"application/json","Accept":"application/json","X-CSRF-TOKEN":metaContent("csrf-token")||""},body:JSON.stringify(payload),keepalive:true}).catch(function(){});
      } catch(_){}
    }
    function success(info){
      document.getElementById("doneTitle").textContent = "You're all set, " + esc(info.first) + "!";
      document.getElementById("doneMsg").textContent = "Your " + p.name + " is reserved. We'll email " + esc(info.email) + " within 24 hours with a secure link to finish payment and get started. Trust the Horse.";
      document.getElementById("done").classList.add("show");
    }

    form.addEventListener("submit", function(e){
      e.preventDefault();
      var info = validate(); if(!info) return;
      btn.disabled = true; btnTxt.textContent = "Processing…";
      saveOrder(info);
      setTimeout(function(){ success(info); }, 500);
    });
  })();
</script>
</body>
</html>
