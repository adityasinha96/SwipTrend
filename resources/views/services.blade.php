@extends('web_master') 

@php
    use Illuminate\Support\Str;
@endphp

@section('main')   
  <!-- Subhero -->
  <section class="subhero">
    <div class="container position-relative">
      <nav aria-label="breadcrumb" class="small mb-2">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item">
            <a href="{{ route('home') }}" class="link-light text-decoration-none">Home</a>
          </li>
          <li class="breadcrumb-item text-white-50 active" aria-current="page">Services</li>
        </ol>
      </nav>
      <h1 class="display-6 fw-800 text-white mb-1">Professional Installation & Support</h1>
      <p class="text-white-75 mb-0">Split • Window • VRF • Ductable • Cassette • Controls &amp; BMS</p>
    </div>

    {{-- if this image lives in /public/assets/img/... --}}
    <img class="subhero-img d-none d-lg-block" src="{{ asset('assets/img/Ductable AC Installation-xl.png') }}" alt="" aria-hidden="true">
    <div class="subhero-overlay"></div>
  </section>

  <!-- Categories filter (anchor based, optional) -->
  <section class="py-4 border-bottom bg-white">
    <div class="container">
      <div class="d-flex flex-wrap gap-2">
        <a class="btn btn-outline-secondary btn-sm" href="#all"><i class="bi bi-grid-3x3-gap-fill me-1"></i> All</a>
        {{-- Keep these if you plan to add categories later --}}
        {{-- <a class="btn btn-outline-secondary btn-sm" href="#residential"><i class="bi bi-house-door me-1"></i> Residential</a>
        <a class="btn btn-outline-secondary btn-sm" href="#commercial"><i class="bi bi-buildings me-1"></i> Commercial</a>
        <a class="btn btn-outline-secondary btn-sm" href="#controls"><i class="bi bi-cpu me-1"></i> Controls & BMS</a> --}}
      </div>
    </div>
  </section>

  <!-- Services grid -->
  <section class="section" id="all">
    <div class="container">
      <div class="text-center mb-5">
        <span class="eyebrow">What we do</span>
        <h2 class="fw-800">Our Services</h2>
        <p class="text-body-secondary">Timely delivery • Clean execution • After-sales assistance</p>
      </div>

      <div class="row g-4">
        @forelse($services as $service)
          <div class="col-md-6 col-lg-4">
            <div class="service-card h-100">
              @if($service->image)
                <img
                  src="{{ $service->image->url }}"
                  class="rounded-3 mb-3 w-100"
                  alt="{{ $service->service_name }}">
              @endif

              <h5 class="mb-1">{{ $service->service_name }}</h5>

              @if($service->description)
                {{-- Show a short teaser; switch to {!! $service->description !!} if you want full HTML content --}}
                <p class="small text-body-secondary mb-2">
                  {!! Str::limit(strip_tags($service->description), 140) !!}
                </p>
              @endif

              <div class="d-flex gap-2">
                <a class="btn btn-sm btn-primary" href="{{ url('/#enquire') }}">Get a Quote</a>
                @if($service->brochure)
                  <a class="btn btn-sm btn-outline-secondary"
                     href="{{ $service->brochure->getUrl() }}"
                     target="_blank" rel="noopener">
                    Brochure
                  </a>
                @endif
              </div>
            </div>
          </div>
        @empty
          <div class="col-12">
            <div class="alert alert-info mb-0">No services are available yet.</div>
          </div>
        @endforelse
      </div>

      <!-- Benefits strip -->
      <div class="row g-4 mt-1">
        <div class="col-md-6 col-lg-3">
          <div class="feature-card h-100 text-center py-4">
            <i class="bi bi-clipboard-check feature-icon"></i>
            <h6 class="mt-2 mb-1">Neat Execution</h6>
            <p class="small text-body-secondary mb-0">Clean routing, sealed joints, tested systems.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="feature-card h-100 text-center py-4">
            <i class="bi bi-clock-history feature-icon"></i>
            <h6 class="mt-2 mb-1">On-time Delivery</h6>
            <p class="small text-body-secondary mb-0">Coordinated with your civil & electrical teams.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="feature-card h-100 text-center py-4">
            <i class="bi bi-shield-lock feature-icon"></i>
            <h6 class="mt-2 mb-1">Warranty & AMC</h6>
            <p class="small text-body-secondary mb-0">Genuine spares and responsive after-sales.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="feature-card h-100 text-center py-4">
            <i class="bi bi-geo-alt feature-icon"></i>
            <h6 class="mt-2 mb-1">Patna & Nearby</h6>
            <p class="small text-body-secondary mb-0">Local team with quick on-site support.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Sticky CTA -->
  <section class="section-cta cta cta-sticky">
    <div class="container d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
      <div>
        <h4 class="text-white fw-800 mb-1">Planning a new AC project?</h4>
        <p class="text-white-75 mb-0 small">Share your requirement — we’ll recommend the right Hitachi solution.</p>
      </div>
      <a class="btn btn-cta btn-lg" href="{{ url('/#enquire') }}"><i class="bi bi-send me-2"></i>Get a Quote</a>
    </div>
  </section>
@endsection
