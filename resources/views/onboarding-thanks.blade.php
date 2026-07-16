<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Thank You — Secure Intake Received | Tycoon Duro Inc.</title>
  <meta name="robots" content="noindex, nofollow" />
  <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    :root{
      --gold:#C9A227;--gold-2:#E6C458;--navy-900:#060F26;
      --ink:#eaf0fb;--soft:rgba(234,240,251,.74);--faint:rgba(234,240,251,.5);
      --line:rgba(201,162,39,.2);--line-soft:rgba(255,255,255,.09);
      --grad-gold:linear-gradient(135deg,#E6C458,#C9A227 55%,#A6851C);--ease:cubic-bezier(.22,1,.36,1);
      --fd:'Sora',sans-serif;--fb:'Plus Jakarta Sans',sans-serif;--ok:#6ee7a8;
    }
    *{margin:0;padding:0;box-sizing:border-box;}
    body{font-family:var(--fb);color:var(--ink);line-height:1.6;-webkit-font-smoothing:antialiased;
      background:radial-gradient(1000px 700px at 50% -10%,rgba(28,62,112,.55),transparent 60%),
      linear-gradient(160deg,#0B234C 0%,#081A3A 45%,#050B1F 100%);min-height:100vh;
      display:flex;align-items:center;justify-content:center;padding:40px 18px;text-align:center;}
    a{text-decoration:none;}
    .wrap{max-width:560px;}
    .brand img{height:64px;width:auto;filter:drop-shadow(0 6px 16px rgba(0,0,0,.45));margin-bottom:30px;}
    .badge{width:92px;height:92px;border-radius:50%;margin:0 auto 26px;display:grid;place-items:center;
      background:radial-gradient(circle at 50% 35%,rgba(110,231,168,.22),rgba(6,15,38,.4));
      border:1px solid rgba(110,231,168,.5);box-shadow:0 20px 50px -20px rgba(110,231,168,.5);}
    .badge svg{width:44px;height:44px;stroke:var(--ok);}
    .eyebrow{font-family:var(--fd);font-size:.72rem;font-weight:700;letter-spacing:.2em;text-transform:uppercase;color:var(--gold-2);}
    h1{font-family:var(--fd);font-size:clamp(2rem,5vw,2.9rem);font-weight:800;letter-spacing:-.02em;margin:12px 0 14px;}
    .lead{color:var(--soft);font-size:1.06rem;max-width:460px;margin:0 auto;}
    .card{margin-top:30px;background:rgba(16,41,79,.34);border:1px solid var(--line-soft);border-radius:18px;
      padding:22px 24px;text-align:left;}
    .card h2{font-family:var(--fd);font-size:.7rem;letter-spacing:.16em;text-transform:uppercase;color:var(--gold-2);margin-bottom:12px;}
    .step{display:flex;gap:12px;align-items:flex-start;padding:9px 0;color:var(--soft);font-size:.95rem;}
    .step i{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(201,162,39,.14);border:1px solid var(--line);
      display:grid;place-items:center;font-family:var(--fd);font-weight:700;font-size:.72rem;color:var(--gold-2);font-style:normal;}
    .btn{display:inline-flex;align-items:center;gap:9px;margin-top:30px;padding:15px 28px;border-radius:12px;
      background:var(--grad-gold);color:var(--navy-900);font-family:var(--fd);font-weight:800;font-size:.98rem;
      box-shadow:0 20px 44px -18px rgba(201,162,39,.7);transition:transform .3s var(--ease);}
    .btn:hover{transform:translateY(-2px);}
    .foot{color:var(--faint);font-size:.82rem;margin-top:22px;}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="brand"><img src="{{ asset('images/logo.png') }}" alt="Tycoon Duro Inc." /></div>

    <div class="badge">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
    </div>

    <span class="eyebrow">🔒 Secure Intake Received</span>
    <h1>Thank You.</h1>
    <p class="lead">Your information was submitted securely and encrypted. Our team will review your file and begin working on it right away.</p>

    <div class="card">
      <h2>What happens next</h2>
      <div class="step"><i>1</i><span>Our specialists review your documents and credit profile.</span></div>
      <div class="step"><i>2</i><span>We build your strategy and start your first round of work.</span></div>
      <div class="step"><i>3</i><span>You'll hear from us shortly with your personalized plan.</span></div>
    </div>

    <a href="{{ url('/') }}" class="btn">
      Back to Home
      <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
    </a>

    <p class="foot">🔒 Trust the Horse. · Tycoon Duro Inc.</p>
  </div>
</body>
</html>
