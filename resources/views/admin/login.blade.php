<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Admin Access — Tycoon Duro Inc.</title>
<meta name="robots" content="noindex, nofollow" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet" />
<link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}" />
<style>
  :root{--gold:#C9A227;--gold-bright:#E6C458;--navy-900:#060F26;--white:#fff;--ink-soft:rgba(255,255,255,.72);--ink-faint:rgba(255,255,255,.5);--line:rgba(201,162,39,.22);--line-soft:rgba(255,255,255,.08);--grad-gold:linear-gradient(135deg,#E6C458,#C9A227 45%,#A6851C);--fd:'Sora',sans-serif;--fb:'Plus Jakarta Sans',sans-serif;}
  *{margin:0;padding:0;box-sizing:border-box;}
  body{font-family:var(--fb);color:var(--white);min-height:100vh;display:grid;place-items:center;padding:24px;
    background:radial-gradient(900px 600px at 50% -10%,#12305c,transparent 55%),linear-gradient(180deg,#0A1F44,#060F26 60%,#04081A);}
  .lg{width:min(420px,100%);background:linear-gradient(180deg,rgba(16,41,79,.4),rgba(6,15,38,.5));border:1px solid var(--line);border-radius:24px;padding:44px 38px;text-align:center;box-shadow:0 50px 120px -40px rgba(0,0,0,.8);}
  .lg img{width:60px;height:60px;border-radius:14px;margin:0 auto 20px;box-shadow:0 12px 30px -10px rgba(201,162,39,.5);}
  .lg h1{font-family:var(--fd);font-size:1.5rem;font-weight:800;letter-spacing:-.01em;}
  .lg .eyebrow{font-family:var(--fd);font-size:.66rem;font-weight:700;letter-spacing:.2em;text-transform:uppercase;color:var(--gold-bright);margin-bottom:8px;}
  .lg p{color:var(--ink-faint);font-size:.9rem;margin:8px 0 26px;}
  .lg label{display:block;text-align:left;font-family:var(--fd);font-size:.66rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--ink-faint);margin:0 0 6px 2px;}
  .lg input{width:100%;padding:14px 16px;border-radius:12px;color:var(--white);background:rgba(255,255,255,.04);border:1px solid var(--line-soft);font-family:var(--fb);font-size:.95rem;margin-bottom:16px;transition:border-color .25s,box-shadow .25s;}
  .lg input:focus{outline:none;border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,162,39,.14);}
  .lg button{width:100%;padding:15px;border:none;border-radius:13px;cursor:pointer;color:var(--navy-900);font-family:var(--fd);font-weight:800;font-size:.98rem;background:var(--grad-gold);box-shadow:0 16px 36px -14px rgba(201,162,39,.6);transition:transform .3s,box-shadow .3s;}
  .lg button:hover{transform:translateY(-2px);box-shadow:0 22px 46px -14px rgba(201,162,39,.8);}
  .err{color:#f87171;font-size:.85rem;margin-bottom:14px;font-weight:600;}
  /* explains an automatic sign-out, so the redirect never reads as a glitch */
  .note{display:flex;gap:9px;align-items:flex-start;text-align:left;color:#E6C458;font-size:.83rem;
    line-height:1.45;font-weight:600;margin-bottom:16px;padding:11px 13px;border-radius:11px;
    background:rgba(201,162,39,.10);border:1px solid rgba(201,162,39,.30);}
  .note svg{width:15px;height:15px;flex-shrink:0;margin-top:1px;}
  .back{display:inline-block;margin-top:20px;color:var(--ink-faint);font-size:.82rem;}
  .back:hover{color:var(--gold-bright);}
  a{text-decoration:none;}
</style>
</head>
<body>
  <form class="lg" method="POST" action="{{ route('admin.login.post') }}">
    @csrf
    <img src="{{ asset('images/logo.jpg') }}" alt="Tycoon Duro Inc." />
    <div class="eyebrow">Tycoon Duro Inc.</div>
    <h1>Admin Access</h1>
    <p>Sign in to view leads, orders &amp; revenue.</p>
    @if (session('status'))
      <div class="note">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 8h.01M11 12h1v4h1"/></svg>
        <span>{{ session('status') }}</span>
      </div>
    @endif
    @if ($errors->any())
      <div class="err">{{ $errors->first() }}</div>
    @endif
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@tycoonduro.com" required autofocus />
    <label>Password</label>
    <input type="password" name="password" placeholder="••••••••" required />
    <button type="submit">Sign In</button>
    <a class="back" href="{{ url('/') }}">← Back to site</a>
  </form>
</body>
</html>
