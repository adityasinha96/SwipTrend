@extends('web_master')
@section('main')   

<!-- Hero with form -->
<section id="home" class="hero d-flex align-items-center">
  <!-- Overlay should be the very first element inside hero -->
  <div class="hero-overlay"></div>

  <!-- Content -->
  <div class="container position-relative">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <span class="badge rounded-pill text-bg-light shadow-sm mb-3">
          Hitachi Residential & Commercial Specialists
        </span>
        <h1 class="display-5 fw-800 lh-tight text-white text-shadow">
          Premium Air Conditioning Solutions in <span class="grad-text">Patna</span>
        </h1>
        <p class="lead text-white-75 mt-3 text-shadow">
          Expert installation & service for VRF, ductable, cassette, split & window ACs —
          with timely delivery and reliable support.
        </p>
        <div class="d-flex gap-2 mt-3 flex-wrap">
          <a href="#catalogue" class="btn btn-lg btn-primary shadow-sm">
            <i class="bi bi-journal-richtext me-2"></i>View Catalogue
          </a>
          <a href="#services" class="btn btn-lg btn-outline-light">
            <i class="bi bi-tools me-2"></i>Our Services
          </a>
        </div>
        <div class="trust-logos mt-4">
          <div class="d-flex align-items-center gap-3 flex-wrap small text-white-75">
            <i class="bi bi-award-fill"></i> Authorized Hitachi portfolio •
            <i class="bi bi-thermometer-sun"></i> High-ambient designs •
            <i class="bi bi-shield-check"></i> Quality-first execution
          </div>
        </div>
      </div>

      <div class="col-lg-5 mt-5 mt-lg-0">
        <div class="card hero-form shadow-xl border-0">
          <div class="card-body p-4">
            <h2 class="h4 mb-3">
              <i class="bi bi-lightning-charge"></i> Quick Service Request
            </h2>
            <form>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Name</label>
                  <input type="text" class="form-control" placeholder="Your name" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Phone</label>
                  <input type="tel" class="form-control" placeholder="+91…" />
                </div>
                <div class="col-12">
                  <label class="form-label">Service Needed</label>
                  <select class="form-select">
                    <option>Split AC Installation</option>
                    <option>VRF System Installation</option>
                    <option>Ductable AC Installation</option>
                    <option>Window AC Installation</option>
                    <option>Maintenance / AMC</option>
                  </select>
                </div>
                <div class="col-12">
                  <label class="form-label">Message</label>
                  <textarea class="form-control" rows="3" placeholder="Tell us about your requirement"></textarea>
                </div>
                <div class="col-12">
                  <button class="btn btn-primary w-100" type="submit">Request Callback</button>
                </div>
              </div>
              <p class="form-hint small text-muted mt-2 mb-0">
                We respond within business hours. No spam—ever.
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Background image -->
  <img class="hero-image d-none d-lg-block" alt="AC Unit"
       src="https://images.unsplash.com/photo-1581093458791-9d09f1cbf3b3?q=80&w=1600&auto=format&fit=crop"/>
</section>


<!-- Highlights -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">

            @foreach($highlights as $item)
                <div class="col-6 col-lg-3">
                    <div class="feature-card h-100">
                        <img src="{{ $item->image?->url ?? asset('frontend/assets/img/placeholder.png') }}"
                             class="rounded-3 mb-3 w-100"
                             alt="{{ $item->service_name }}">
                        <h6>{{ $item->service_name }}</h6>
                        <p class="mb-0 small text-body-secondary">
                            {{ $item->service_description }}
                        </p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>

<!-- About -->
<section id="about" class="section pb-0">
<div class="container">
    <div class="row align-items-center g-4">
    <div class="col-lg-6">
        <img class="img-fluid rounded-4 shadow-lg" alt="Team installing AC"
            src="{{asset('frontend/assets/img/about.png')}}">
    </div>
    <div class="col-lg-6">
        <span class="eyebrow">About Swipetrend Private Limited</span>
        <h2 class="fw-800">Your local Hitachi air conditioning partner</h2>
        <p class="text-body-secondary">
        Based in Patna, Swipetrend provides end‑to‑end air conditioning solutions across residential and commercial spaces.
        Our professionals operate in Patna and nearby areas, delivering effective and timely installation with a quality-first approach.
        </p>
        <ul class="list-unstyled mb-4">
        <li class="d-flex align-items-start mb-2"><i class="bi bi-check2-circle me-2 text-primary"></i>Window, Split, Ductable & VRF installation</li>
        <li class="d-flex align-items-start mb-2"><i class="bi bi-check2-circle me-2 text-primary"></i>Chillers & air renovation services</li>
        <li class="d-flex align-items-start mb-2"><i class="bi bi-check2-circle me-2 text-primary"></i>Controls: airCloud Go/Pro, BMS integrations</li>
        </ul>
        <div class="d-flex gap-2">
        <a class="btn btn-primary" href="#enquire"><i class="bi bi-send me-2"></i>Enquire Now</a>
        <a class="btn btn-outline-secondary" href="#catalogue"><i class="bi bi-journal-text me-2"></i>View Catalogue</a>
        </div>
    </div>
    </div>
</div>
</section>

<!-- Services with dummy images -->
<section id="services" class="section">
<div class="container">
    <div class="text-center mb-5">
    <span class="eyebrow">What we do</span>
    <h2 class="fw-800">Professional Installation & Support</h2>
    <p class="text-body-secondary">Timely delivery • Clean execution • After‑sales assistance</p>
    </div>
    <div class="row g-4">
    <div class="col-md-6 col-lg-4">
        <div class="service-card h-100">
        <img src="{{asset('frontend/assets/img/Split AC Installation.png')}}" class="rounded-3 mb-3 w-100" alt="Split AC Installation" />
        <h5>Split AC Installation</h5>
        <p class="small text-body-secondary">Energy‑efficient comfort for homes & small offices.</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="service-card h-100">
        <img src="{{asset('frontend/assets/img/Window AC Installation.png')}}" class="rounded-3 mb-3 w-100" alt="Window AC Installation" />
        <h5>Window AC Installation</h5>
        <p class="small text-body-secondary">Fast, reliable installs with tidy finishing.</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="service-card h-100">
        <img src="{{asset('frontend/assets/img/VRF System Installation.png')}}" class="rounded-3 mb-3 w-100" alt="VRF System Installation" />
        <h5>VRF System Installation</h5>
        <p class="small text-body-secondary">High‑efficiency variable refrigerant flow projects.</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="service-card h-100">
        <img src="{{asset('frontend/assets/img/Ductable AC Installation.png')}}" class="rounded-3 mb-3 w-100" alt="Ductable AC Installation" />
        <h5>Ductable AC Installation</h5>
        <p class="small text-body-secondary">Uniform cooling for large halls & showrooms.</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="service-card h-100">
        <img src="{{asset('frontend/assets/img/Cassette AC Installation.png')}}" class="rounded-3 mb-3 w-100" alt="Cassette AC Installation" />
        <h5>Cassette AC Installation</h5>
        <p class="small text-body-secondary">Aesthetic in‑ceiling comfort for premium spaces.</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="service-card h-100">
        <img src="{{asset('frontend/assets/img/Controls & BMS.png')}}" class="rounded-3 mb-3 w-100" alt="Controls & BMS" />
        <h5>Controls & BMS</h5>
        <p class="small text-body-secondary">airCloud™ control, smart scheduling & integration.</p>
        </div>
    </div>
    </div>
</div>
</section>

<!-- Catalogue -->
<section id="catalogue" class="section bg-light">
<div class="container">
    <div class="text-center mb-5">
    <span class="eyebrow">Catalogue</span>
    <h2 class="fw-800">Hitachi Product Range</h2>
    <p class="text-body-secondary">Room ACs • Light Commercial • VRF</p>
    </div>

    <div class="row g-4">
    <div class="col-md-6 col-lg-4">
        <div class="catalog-card h-100">
        <img class="w-100 rounded-3" alt="Room AC Catalogue" 
                src="{{asset('frontend/assets/img/Room Air Conditioners (2024).png')}}">
        <div class="p-3">
            <h6 class="mb-1">Room Air Conditioners (2024)</h6>
            <p class="small text-body-secondary mb-3">Xpandable+, Long Air Throw, FrostWash & more.</p>
            <div class="d-flex gap-2">
            <a class="btn btn-sm btn-primary" href="{{asset('frontend/assets/pdf/room-ac.pdf')}}" target="_blank">View PDF</a>
            <a class="btn btn-sm btn-outline-secondary" href="{{asset('frontend/assets/pdf/room-ac.pdf')}}" download="Room-AC-2024.pdf">Export</a>
            </div>
        </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="catalog-card h-100">
        <img class="w-100 rounded-3" alt="Light Commercial Brochure" 
                src="{{asset('frontend/assets/img/Light Commercial Range (2024).png')}}">
        <div class="p-3">
            <h6 class="mb-1">Light Commercial Range (2024)</h6>
            <p class="small text-body-secondary mb-3">Ductable, Concealed, Flexi Split & Cassette ACs.</p>
            <div class="d-flex gap-2">
            <a class="btn btn-sm btn-primary" href="{{asset('frontend/assets/pdf/LCR.pdf')}}" target="_blank">View PDF</a>
            <a class="btn btn-sm btn-outline-secondary" href="{{asset('frontend/assets/pdf/LCR.pdf')}}" download="Light-Commercial-Range-2024.pdf">Export</a>
            </div>
        </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="catalog-card h-100">
        <img class="w-100 rounded-3" alt="VRF 365 Air Max" 
                src="{{asset('frontend/assets/img/VRF 365 AIR MAX.png')}}">
        <div class="p-3">
            <h6 class="mb-1">VRF 365 AIR MAX</h6>
            <p class="small text-body-secondary mb-3">High-ambient VRF with smart controls.</p>
            <div class="d-flex gap-2">
            <a class="btn btn-sm btn-primary" href="{{asset('frontend/assets/pdf/VRF.pdf')}}" target="_blank">View PDF</a>
            <a class="btn btn-sm btn-outline-secondary" href="{{asset('frontend/assets/pdf/VRF.pdf')}}" download="VRF-365-AIR-MAX.pdf">Export</a>
            </div>
        </div>
        </div>
    </div>
    </div>

    <div class="text-center mt-4">
    <a class="btn btn-outline-dark" href="#enquire"><i class="bi bi-download me-2"></i>Request Full Catalogue</a>
    </div>
</div>
</section>

<!-- CTA -->
<section id="enquire" class="section section-cta cta">
<!-- Decorative background image (optional, can remove) -->
<img class="cta-image d-none d-lg-block"
    src="https://images.unsplash.com/photo-1581093458364-3ee0b03f1a5b?q=80&w=1600&auto=format&fit=crop"
    alt="" aria-hidden="true" />

<div class="container position-relative">
<div class="row g-4 align-items-center">
    <!-- Copy -->
    <div class="col-lg-6">
    <span class="eyebrow text-white-50">Free consultation</span>
    <h2 class="display-6 fw-800 text-white mb-3">
        Planning a new <span class="grad-text">AC project</span>?
    </h2>
    <p class="text-white-75 mb-4">
        Tell us about your site and usage. We’ll recommend the right Hitachi solution with a fast, transparent quote.
    </p>
    <ul class="list-unstyled text-white-75 mb-4">
        <li class="d-flex align-items-start mb-2">
        <i class="bi bi-check2-circle me-2 text-white"></i> VRF, Ductable, Cassette, Split & Window
        </li>
        <li class="d-flex align-items-start mb-2">
        <i class="bi bi-check2-circle me-2 text-white"></i> Design assistance, installation & commissioning
        </li>
        <li class="d-flex align-items-start mb-2">
        <i class="bi bi-check2-circle me-2 text-white"></i> Patna & nearby areas · Timely delivery
        </li>
    </ul>
    <div class="d-flex flex-wrap gap-2">
        <span class="badge badge-glass"><i class="bi bi-stopwatch me-1"></i> Avg. response &lt; 1 hr*</span>
        <span class="badge badge-glass"><i class="bi bi-geo-alt me-1"></i> On‑site survey available</span>
    </div>
    </div>

    <!-- Form -->
    <div class="col-lg-6">
    <div class="card cta-form shadow-xl border-0">
        <div class="card-body p-4 p-lg-5">
        <h3 class="h4 mb-3"><i class="bi bi-lightning-charge"></i> Quick Service Request</h3>

        <form class="row g-3">
            <div class="col-md-6">
            <div class="input-group input-group-lg">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input class="form-control" placeholder="Your Name" />
            </div>
            </div>
            <div class="col-md-6">
            <div class="input-group input-group-lg">
                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                <input class="form-control" placeholder="Phone" />
            </div>
            </div>

            <div class="col-12">
            <div class="input-group input-group-lg">
                <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                <input class="form-control" placeholder="City / Area" />
            </div>
            </div>

            <div class="col-12">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-sliders2"></i></span>
                <select class="form-select form-select-lg">
                <option>Split AC Installation</option>
                <option>VRF System Installation</option>
                <option>Ductable / Cassette</option>
                <option>Window AC Installation</option>
                <option>Maintenance / AMC</option>
                </select>
            </div>
            </div>

            <div class="col-12">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-chat-left-dots"></i></span>
                <textarea class="form-control" rows="3" placeholder="Brief requirement"></textarea>
            </div>
            </div>

            <div class="col-12 d-grid">
            <button class="btn btn-cta btn-lg" type="button">
                <i class="bi bi-send me-2"></i> Submit Request
            </button>
            </div>
            <div class="col-12">
            <small class="text-body-secondary d-block">
                *During business hours. By submitting, you agree to be contacted by Swipetrend.
            </small>
            </div>
        </form>
        </div>
    </div>
    </div>
    <!-- /Form -->
</div>
</div>
</section>

@endsection