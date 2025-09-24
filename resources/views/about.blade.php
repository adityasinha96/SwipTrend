@extends('web_master')
@section('main')

      <!-- Sub-hero / breadcrumb -->
  <section class="subhero">
    <div class="container position-relative">
      <nav aria-label="breadcrumb" class="small mb-2">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="index.html" class="link-light text-decoration-none">Home</a></li>
          <li class="breadcrumb-item text-white-50 active" aria-current="page">About</li>
        </ol>
      </nav>
      <h1 class="display-6 fw-800 text-white mb-1">About Swipetrend</h1>
      <p class="text-white-75 mb-0">Hitachi air‑conditioning specialists for homes, businesses, and large projects across Patna.</p>
    </div>
    <img class="subhero-img d-none d-lg-block" src="{{asset('frontend/assets/img/about.png')}}" alt="" aria-hidden="true">
    <div class="subhero-overlay"></div>
  </section>

  <!-- Who we are -->
  <section class="section">
    <div class="container">
      <div class="row g-4 align-items-center">
        <div class="col-lg-6 order-lg-2">
          <img src="{{asset('frontend/assets/img/about.png')}}" class="img-fluid rounded-4 shadow-lg" alt="Swipetrend team installing AC">
        </div>
        <div class="col-lg-6">
          <span class="eyebrow">Who we are</span>
          <h2 class="fw-800">Your local Hitachi air‑conditioning partner</h2>
          <p class="text-body-secondary">
            Swipetrend Private Limited delivers end‑to‑end HVAC solutions — from residential split and window ACs to complex VRF, ductable and cassette systems for commercial spaces. We operate across Patna and nearby areas with a focus on clean execution, safety and timely delivery.
          </p>
          <ul class="list-unstyled mb-4">
            <li class="mb-2"><i class="bi bi-check2-circle text-primary me-2"></i> Site survey, heat‑load assessment & design inputs</li>
            <li class="mb-2"><i class="bi bi-check2-circle text-primary me-2"></i> Professional installation & commissioning</li>
            <li class="mb-2"><i class="bi bi-check2-circle text-primary me-2"></i> After‑sales support, AMC & rapid response</li>
          </ul>
          <div class="d-flex gap-3">
            <div class="stat">
              <div class="h3 fw-800 mb-0">250+</div>
              <div class="small text-body-secondary">Projects delivered</div>
            </div>
            <div class="stat">
              <div class="h3 fw-800 mb-0">10+ yrs</div>
              <div class="small text-body-secondary">Team experience</div>
            </div>
            <div class="stat">
              <div class="h3 fw-800 mb-0">5★</div>
              <div class="small text-body-secondary">Customer rating</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- What we install (icons) -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="text-center mb-4">
        <span class="eyebrow">Expertise</span>
        <h3 class="fw-800">What we install</h3>
      </div>
      <div class="row g-4 text-center">
        <div class="col-6 col-md-3"><div class="feature-card h-100"><i class="bi bi-snow feature-icon"></i><h6 class="mt-2">Split & Window</h6></div></div>
        <div class="col-6 col-md-3"><div class="feature-card h-100"><i class="bi bi-diagram-2 feature-icon"></i><h6 class="mt-2">VRF Systems</h6></div></div>
        <div class="col-6 col-md-3"><div class="feature-card h-100"><i class="bi bi-fan feature-icon"></i><h6 class="mt-2">Ductable & Cassette</h6></div></div>
        <div class="col-6 col-md-3"><div class="feature-card h-100"><i class="bi bi-cpu feature-icon"></i><h6 class="mt-2">Controls & BMS</h6></div></div>
      </div>
    </div>
  </section>

  <!-- Process -->
  <section class="section">
    <div class="container">
      <div class="text-center mb-5">
        <span class="eyebrow">How we work</span>
        <h3 class="fw-800">Our 4‑step process</h3>
      </div>
      <div class="row g-4">
        <div class="col-md-6 col-lg-3">
          <div class="service-card h-100">
            <i class="bi bi-geo-alt service-icon"></i>
            <h5>1. Site Survey</h5>
            <p class="small text-body-secondary mb-0">On‑site inspection, sizing & duct routing suggestions.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="service-card h-100">
            <i class="bi bi-sliders2 service-icon"></i>
            <h5>2. Proposal</h5>
            <p class="small text-body-secondary mb-0">Clear bill of materials, timelines & commercial terms.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="service-card h-100">
            <i class="bi bi-tools service-icon"></i>
            <h5>3. Installation</h5>
            <p class="small text-body-secondary mb-0">Clean, safe execution by trained professionals.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="service-card h-100">
            <i class="bi bi-shield-check service-icon"></i>
            <h5>4. Handover & Support</h5>
            <p class="small text-body-secondary mb-0">Testing, commissioning & after‑sales assistance.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Creds / Badges -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row g-4 align-items-center">
        <div class="col-lg-7">
          <h3 class="fw-800 mb-3">Why customers choose us</h3>
          <ul class="list-unstyled">
            <li class="mb-2"><i class="bi bi-award-fill text-primary me-2"></i> Trusted Hitachi portfolio & genuine spares</li>
            <li class="mb-2"><i class="bi bi-thermometer-sun text-primary me-2"></i> High‑ambient designs for Bihar climate</li>
            <li class="mb-2"><i class="bi bi-clock-history text-primary me-2"></i> On‑time delivery with neat finishing</li>
            <li class="mb-2"><i class="bi bi-headset text-primary me-2"></i> Friendly support & AMC options</li>
          </ul>
        </div>
        <div class="col-lg-5">
          <div class="d-flex flex-wrap gap-2">
            <span class="badge badge-glass"><i class="bi bi-stopwatch me-1"></i> Response &lt; 1 hr*</span>
            <span class="badge badge-glass"><i class="bi bi-geo-fill me-1"></i> Patna & nearby</span>
            <span class="badge badge-glass"><i class="bi bi-clipboard-check me-1"></i> Safety first</span>
            <span class="badge badge-glass"><i class="bi bi-wrench-adjustable-circle me-1"></i> Trained team</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA strip -->
  <section class="section section-cta cta">
    <div class="container">
      <div class="row g-4 align-items-center">
        <div class="col-lg-8">
          <h2 class="text-white fw-800 mb-1">Let’s plan your AC project</h2>
          <p class="text-white-75 mb-0">Share your requirement — we’ll suggest the right Hitachi solution.</p>
        </div>
        <div class="col-lg-4 text-lg-end">
          <a class="btn btn-cta btn-lg" href="{{('/')}}#enquire"><i class="bi bi-send me-2"></i>Get a Quote</a>
        </div>
      </div>
    </div>
  </section>

@endsection