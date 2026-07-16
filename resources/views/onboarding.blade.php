<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Secure Client Onboarding — Tycoon Duro Inc.</title>
  <meta name="robots" content="noindex, nofollow" />
  <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    :root{
      --gold:#C9A227;--gold-2:#E6C458;--gold-deep:#A6851C;--navy:#0A1F44;--navy-900:#060F26;
      --ink:#eaf0fb;--soft:rgba(234,240,251,.72);--faint:rgba(234,240,251,.5);
      --line:rgba(201,162,39,.2);--line-soft:rgba(255,255,255,.09);--card:rgba(16,41,79,.34);
      --grad-gold:linear-gradient(135deg,#E6C458,#C9A227 55%,#A6851C);--ease:cubic-bezier(.22,1,.36,1);
      --fd:'Sora',sans-serif;--fb:'Plus Jakarta Sans',sans-serif;--red:#ff8a7a;--ok:#6ee7a8;
    }
    *{margin:0;padding:0;box-sizing:border-box;}
    body{font-family:var(--fb);color:var(--ink);line-height:1.6;-webkit-font-smoothing:antialiased;
      background:radial-gradient(1000px 700px at 20% -5%,rgba(28,62,112,.55),transparent 60%),
      linear-gradient(160deg,#0B234C 0%,#081A3A 45%,#050B1F 100%);min-height:100vh;padding:40px 18px 80px;}
    a{color:var(--gold-2);text-decoration:none;}
    .wrap{max-width:760px;margin:0 auto;}
    .brand{display:flex;justify-content:center;margin-bottom:26px;}
    .brand img{height:66px;width:auto;filter:drop-shadow(0 6px 16px rgba(0,0,0,.45));}
    .head{text-align:center;margin-bottom:26px;}
    .eyebrow{font-family:var(--fd);font-size:.72rem;font-weight:700;letter-spacing:.2em;text-transform:uppercase;color:var(--gold-2);}
    .head h1{font-family:var(--fd);font-size:clamp(1.7rem,4vw,2.4rem);font-weight:800;letter-spacing:-.02em;margin:10px 0 8px;}
    .head p{color:var(--soft);max-width:520px;margin:0 auto;}
    .trust{display:flex;flex-wrap:wrap;justify-content:center;gap:10px;margin:20px 0 0;}
    .trust span{font-size:.8rem;color:var(--soft);background:rgba(255,255,255,.04);border:1px solid var(--line-soft);
      padding:7px 14px;border-radius:100px;}
    .banner{border-radius:14px;padding:16px 18px;margin-bottom:20px;font-size:.92rem;}
    .banner.ok{background:rgba(110,231,168,.1);border:1px solid rgba(110,231,168,.4);color:var(--ok);}
    .banner.err{background:rgba(255,138,122,.08);border:1px solid rgba(255,138,122,.35);color:var(--red);}
    .banner.err ul{margin:6px 0 0 18px;}
    form{display:block;}
    .card{background:var(--card);border:1px solid var(--line-soft);border-radius:20px;padding:26px;margin-bottom:18px;
      box-shadow:0 30px 70px -46px rgba(0,0,0,.7);}
    .card > h2{font-family:var(--fd);font-size:1.02rem;font-weight:700;color:var(--gold-2);margin-bottom:4px;}
    .card > .hint{font-size:.82rem;color:var(--faint);margin-bottom:18px;}
    .grid{display:grid;grid-template-columns:1fr 1fr;gap:14px 16px;}
    .col-2{grid-column:span 2;}
    @media(max-width:560px){.grid{grid-template-columns:1fr;}.col-2{grid-column:span 1;}}
    .fld{display:flex;flex-direction:column;gap:6px;}
    .fld label{font-size:.78rem;font-weight:600;color:var(--soft);}
    .fld label .req{color:var(--gold-2);}
    .fld input,.fld select{width:100%;padding:12px 14px;border-radius:11px;background:rgba(255,255,255,.03);
      border:1px solid var(--line-soft);color:var(--ink);font-family:var(--fb);font-size:.94rem;transition:border-color .25s,box-shadow .25s;}
    .fld input::placeholder{color:rgba(234,240,251,.34);}
    .fld input:focus,.fld select:focus{outline:none;border-color:var(--gold);box-shadow:0 0 0 4px rgba(201,162,39,.12);background:rgba(201,162,39,.05);}
    .fld select option{background:var(--navy-900);color:var(--ink);}
    .fld .fhint{font-size:.74rem;color:var(--faint);}
    .fld.bad input,.fld.bad select{border-color:var(--red);}
    .fld .ferr{font-size:.74rem;color:var(--red);}
    input[type=file]{padding:10px 12px;cursor:pointer;}
    input[type=file]::file-selector-button{font-family:var(--fd);font-weight:600;font-size:.8rem;margin-right:12px;
      padding:8px 14px;border-radius:8px;border:none;background:var(--grad-gold);color:var(--navy-900);cursor:pointer;}
    .submit{width:100%;margin-top:6px;padding:16px;border:none;border-radius:13px;background:var(--grad-gold);
      color:var(--navy-900);font-family:var(--fd);font-weight:800;font-size:1rem;letter-spacing:.01em;cursor:pointer;
      box-shadow:0 20px 44px -18px rgba(201,162,39,.7);transition:transform .3s var(--ease),box-shadow .3s;}
    .submit:hover{transform:translateY(-2px);box-shadow:0 26px 60px -18px rgba(201,162,39,.8);}
    .foot{text-align:center;color:var(--faint);font-size:.82rem;margin-top:16px;}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="brand"><a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" alt="Tycoon Duro Inc." /></a></div>

    <div class="head">
      <span class="eyebrow">🔒 Secure Client Onboarding</span>
      <h1>Secure Client Intake</h1>
      <p>Your information is encrypted and used only to work on your credit file.</p>
      <div class="trust">
        <span>🔒 Bank-grade encryption</span>
        <span>🛡️ Private &amp; secure</span>
        <span>📄 Documents stored privately</span>
      </div>
    </div>

    @if($errors->any())
      <div class="banner err">
        Please fix the following:
        <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
      </div>
    @endif

    <form method="POST" action="{{ route('onboarding.store') }}" enctype="multipart/form-data" novalidate>
      @csrf

      <!-- YOUR DETAILS -->
      <div class="card">
        <h2>Your Details</h2>
        <div class="grid">
          <div class="fld {{ $errors->has('first_name') ? 'bad' : '' }}">
            <label>First Name <span class="req">*</span></label>
            <input type="text" name="first_name" value="{{ old('first_name') }}" required />
            @error('first_name')<span class="ferr">{{ $message }}</span>@enderror
          </div>
          <div class="fld">
            <label>Middle Name <span class="fhint">(optional)</span></label>
            <input type="text" name="middle_name" value="{{ old('middle_name') }}" />
          </div>
          <div class="fld {{ $errors->has('last_name') ? 'bad' : '' }}">
            <label>Last Name <span class="req">*</span></label>
            <input type="text" name="last_name" value="{{ old('last_name') }}" required />
            @error('last_name')<span class="ferr">{{ $message }}</span>@enderror
          </div>
          <div class="fld">
            <label>Suffix <span class="fhint">(optional)</span></label>
            <select name="suffix">
              @foreach(['None','Jr.','Sr.','I','II','III','IV','V'] as $sfx)
                <option value="{{ $sfx }}" @selected(old('suffix')===$sfx)>{{ $sfx }}</option>
              @endforeach
            </select>
          </div>
          <div class="fld {{ $errors->has('email') ? 'bad' : '' }}">
            <label>Email Address <span class="req">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}" required />
            @error('email')<span class="ferr">{{ $message }}</span>@enderror
          </div>
          <div class="fld {{ $errors->has('phone') ? 'bad' : '' }}">
            <label>Phone <span class="req">*</span></label>
            <input type="tel" name="phone" value="{{ old('phone') }}" required />
            @error('phone')<span class="ferr">{{ $message }}</span>@enderror
          </div>
          <div class="fld {{ $errors->has('dob') ? 'bad' : '' }}">
            <label>Date of Birth <span class="req">*</span></label>
            <input type="date" name="dob" value="{{ old('dob') }}" required />
            @error('dob')<span class="ferr">{{ $message }}</span>@enderror
          </div>
          <div class="fld {{ $errors->has('ssn') ? 'bad' : '' }}">
            <label>Full SSN <span class="req">*</span></label>
            <input type="text" name="ssn" value="{{ old('ssn') }}" placeholder="XXX-XX-XXXX" inputmode="numeric" required />
            @error('ssn')<span class="ferr">{{ $message }}</span>@enderror
          </div>
        </div>
      </div>

      <!-- MAILING ADDRESS -->
      <div class="card">
        <h2>Mailing Address</h2>
        <div class="grid">
          <div class="fld col-2 {{ $errors->has('street') ? 'bad' : '' }}">
            <label>Street Address <span class="req">*</span></label>
            <input type="text" name="street" value="{{ old('street') }}" required />
            @error('street')<span class="ferr">{{ $message }}</span>@enderror
          </div>
          <div class="fld col-2">
            <label>Apt / Suite <span class="fhint">(optional)</span></label>
            <input type="text" name="apt" value="{{ old('apt') }}" />
          </div>
          <div class="fld {{ $errors->has('city') ? 'bad' : '' }}">
            <label>City <span class="req">*</span></label>
            <input type="text" name="city" value="{{ old('city') }}" required />
            @error('city')<span class="ferr">{{ $message }}</span>@enderror
          </div>
          <div class="fld {{ $errors->has('state') ? 'bad' : '' }}">
            <label>State <span class="req">*</span></label>
            <select name="state" required>
              <option value="" @selected(!old('state'))>Select…</option>
              @foreach(['AL','AK','AZ','AR','CA','CO','CT','DE','FL','GA','HI','ID','IL','IN','IA','KS','KY','LA','ME','MD','MA','MI','MN','MS','MO','MT','NE','NV','NH','NJ','NM','NY','NC','ND','OH','OK','OR','PA','RI','SC','SD','TN','TX','UT','VT','VA','WA','WV','WI','WY','DC'] as $st)
                <option value="{{ $st }}" @selected(old('state')===$st)>{{ $st }}</option>
              @endforeach
            </select>
            @error('state')<span class="ferr">{{ $message }}</span>@enderror
          </div>
          <div class="fld {{ $errors->has('zip') ? 'bad' : '' }}">
            <label>Zip Code <span class="req">*</span></label>
            <input type="text" name="zip" value="{{ old('zip') }}" inputmode="numeric" required />
            @error('zip')<span class="ferr">{{ $message }}</span>@enderror
          </div>
        </div>
      </div>

      <!-- DOCUMENTS -->
      <div class="card">
        <h2>Documents</h2>
        <p class="hint">PDF or image, up to 10 MB each.</p>
        <div class="grid">
          <div class="fld col-2 {{ $errors->has('drivers_license') ? 'bad' : '' }}">
            <label>Driver's License <span class="req">*</span></label>
            <input type="file" name="drivers_license" accept=".pdf,.jpg,.jpeg,.png,.webp" required />
            <span class="fhint">Government-issued photo ID.</span>
            @error('drivers_license')<span class="ferr">{{ $message }}</span>@enderror
          </div>
          <div class="fld col-2 {{ $errors->has('proof_address') ? 'bad' : '' }}">
            <label>Proof of Address <span class="req">*</span></label>
            <input type="file" name="proof_address" accept=".pdf,.jpg,.jpeg,.png,.webp" required />
            <span class="fhint">Utility bill, bank statement, or lease — up to 10 MB.</span>
            @error('proof_address')<span class="ferr">{{ $message }}</span>@enderror
          </div>
          <div class="fld col-2 {{ $errors->has('ssn_card') ? 'bad' : '' }}">
            <label>Social Security Card <span class="fhint">(optional)</span></label>
            <input type="file" name="ssn_card" accept=".pdf,.jpg,.jpeg,.png,.webp" />
            <span class="fhint">Providing this helps get stronger results on your file.</span>
            @error('ssn_card')<span class="ferr">{{ $message }}</span>@enderror
          </div>
        </div>
      </div>

      <!-- CREDIT MONITORING -->
      <div class="card">
        <h2>Credit Monitoring</h2>
        <p class="hint">So we can track and verify progress across the bureaus.</p>
        <div class="grid">
          <div class="fld col-2 {{ $errors->has('cm_provider') ? 'bad' : '' }}">
            <label>Credit Monitoring Provider <span class="req">*</span></label>
            <input type="text" name="cm_provider" value="{{ old('cm_provider') }}" placeholder="e.g. IdentityIQ, MyScoreIQ, SmartCredit" required />
            @error('cm_provider')<span class="ferr">{{ $message }}</span>@enderror
          </div>
          <div class="fld {{ $errors->has('cm_email') ? 'bad' : '' }}">
            <label>Credit Monitoring Email <span class="req">*</span></label>
            <input type="text" name="cm_email" value="{{ old('cm_email') }}" required />
            @error('cm_email')<span class="ferr">{{ $message }}</span>@enderror
          </div>
          <div class="fld {{ $errors->has('cm_password') ? 'bad' : '' }}">
            <label>Credit Monitoring Password <span class="req">*</span></label>
            <input type="text" name="cm_password" value="{{ old('cm_password') }}" required />
            @error('cm_password')<span class="ferr">{{ $message }}</span>@enderror
          </div>
          <div class="fld col-2">
            <label>Security Question Answer <span class="fhint">(optional)</span></label>
            <input type="text" name="cm_security_answer" value="{{ old('cm_security_answer') }}" />
          </div>
        </div>
      </div>

      <button type="submit" class="submit">Submit Securely</button>
      <p class="foot">🔒 Encrypted submission · Your documents are stored privately.<br />
        By submitting, you agree to our <a href="{{ route('legal.terms') }}" target="_blank" style="color:var(--gold-2)">Terms</a> &amp; <a href="{{ route('legal.privacy') }}" target="_blank" style="color:var(--gold-2)">Privacy Policy</a>.</p>
    </form>
  </div>
</body>
</html>
