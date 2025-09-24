 <!-- Topbar -->
<div class="topbar py-1 d-none d-md-block">
  <div class="container d-flex justify-content-between small">
    <div>
      <i class="bi bi-geo-alt me-1"></i>
      {{ $companyDetail->office_address ?? 'Patna & nearby areas' }}
      <span class="mx-2">|</span>
      <i class="bi bi-shield-lock me-1"></i>
      GST: <strong>{{ $companyDetail->gst_number ?? '10ABICS7466A1ZL' }}</strong>
    </div>

    <div class="text-end">
      @php
        $phone = $companyDetail->company_phone_number ?? '+91-98357 43417';
        $email = $companyDetail->email ?? 'info@swipetrend.in';
      @endphp

      <a class="top-link" href="tel:{{ preg_replace('/\s+/', '', $phone) }}">
        <i class="bi bi-telephone me-1"></i> {{ $phone }}
      </a>
      <span class="mx-2">|</span>
      <a class="top-link" href="mailto:{{ $email }}">
        <i class="bi bi-envelope me-1"></i> {{ $email }}
      </a>
    </div>
  </div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top shadow-sm bg-white">
  <div class="container">
    <a class="navbar-brand fw-bold brand" href="{{ route('home') }}">
      @php
        // If you store logo path in DB (e.g. company_logo), otherwise fallback
        $logo = $companyDetail && isset($companyDetail->logo) ? asset($companyDetail->logo) : asset('frontend/assets/img/logo.png');
      @endphp
      <img src="{{ $logo }}" class="rounded me-2" alt="{{ $companyDetail->company_name ?? 'Logo' }}"/>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('catalogue') ? 'active' : '' }}" href="{{ route('catalogue') }}">Catalogue</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
        </li>
        <li class="nav-item ms-lg-3">
          <a class="btn btn-primary px-3" href="{{('/')}}#enquire">Get a Quote</a>
        </li>
      </ul>
    </div>

  </div>
</nav>
