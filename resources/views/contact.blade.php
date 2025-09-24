@extends('web_master')
@section('main')

  <!-- Sub-hero -->
  <section class="subhero">
    <div class="container position-relative">
      <nav aria-label="breadcrumb" class="small mb-2">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item">
            <a href="{{ route('home') }}" class="link-light text-decoration-none">Home</a>
          </li>
          <li class="breadcrumb-item text-white-50 active" aria-current="page">Contact</li>
        </ol>
      </nav>
      <h1 class="display-6 fw-800 text-white mb-1">Contact Us</h1>
      <p class="text-white-75 mb-0">We’re here to help—surveys, quotes, and support for your AC project.</p>
    </div>
    <img class="subhero-img d-none d-lg-block" src="{{ asset('frontend/assets/img/Controls & BMS.png') }}" alt="" aria-hidden="true">
    <div class="subhero-overlay"></div>
  </section>

  <!-- Contact content -->
  <section class="section">
    <div class="container">
      <div class="row g-4 align-items-start">

        <!-- Left: Info & Quick Actions -->
        <div class="col-lg-5">
          <div class="feature-card p-4 h-100">
            <h3 class="fw-800 mb-3">Get in touch</h3>

            <div class="d-grid gap-2 mb-3">
              @if(!empty($company?->company_phone_number))
                <a class="btn btn-outline-secondary d-flex align-items-center justify-content-start"
                   href="tel:{{ $company->company_phone_number }}">
                  <i class="bi bi-telephone me-2"></i> {{ $company->company_phone_number }}
                </a>
              @endif

              @if(!empty($company?->other_phone_number))
                <a class="btn btn-outline-secondary d-flex align-items-center justify-content-start"
                   href="tel:{{ $company->other_phone_number }}">
                  <i class="bi bi-telephone-plus me-2"></i> {{ $company->other_phone_number }}
                </a>
              @endif

              @if(!empty($company?->email))
                <a class="btn btn-outline-secondary d-flex align-items-center justify-content-start"
                   href="mailto:{{ $company->email }}">
                  <i class="bi bi-envelope me-2"></i> {{ $company->email }}
                </a>
              @endif

              @if(!empty($company?->other_email))
                <a class="btn btn-outline-secondary d-flex align-items-center justify-content-start"
                   href="mailto:{{ $company->other_email }}">
                  <i class="bi bi-envelope-open me-2"></i> {{ $company->other_email }}
                </a>
              @endif

              @if(!empty($mapLink))
                <a class="btn btn-outline-secondary d-flex align-items-center justify-content-start"
                   target="_blank" rel="noopener" href="{{ $mapLink }}">
                  <i class="bi bi-geo-alt me-2"></i> Get Directions
                </a>
              @endif
            </div>

            <div class="address rounded-4 p-3 mb-3">
              <div class="small text-body-secondary mb-1">Office Address</div>
              <p class="mb-0 small">
                {!! $company?->office_address ? nl2br(e($company->office_address)) : '—' !!}
              </p>
            </div>

            <ul class="list-unstyled small mb-0">
              <li class="mb-2">
                <i class="bi bi-clock-history me-2 text-primary"></i>
                Mon–Sat: 9:30 AM – 6:30 PM
              </li>
              <li class="mb-2">
                <i class="bi bi-geo me-2 text-primary"></i>
                Patna & nearby areas
              </li>
              @if(!empty($company?->gst_number))
                <li class="mb-2">
                  <i class="bi bi-shield-check me-2 text-primary"></i>
                  GST: {{ $company->gst_number }}
                </li>
              @endif
            </ul>

            @php
              $hasAnySocial = $company?->company_facebook_link || $company?->comapnay_instagram_link || $company?->company_linkedin_link || $company?->company_youtube_link || $company?->company_x_link;
            @endphp
            @if($hasAnySocial)
              <hr class="my-3">
              <div class="small text-body-secondary mb-2">Connect with us</div>
              <div class="d-flex flex-wrap gap-2">
                @if(!empty($company?->company_facebook_link))
                  <a class="btn btn-sm btn-outline-secondary" href="{{ $company->company_facebook_link }}" target="_blank" rel="noopener">
                    <i class="bi bi-facebook me-1"></i> Facebook
                  </a>
                @endif
                @if(!empty($company?->comapnay_instagram_link))
                  <a class="btn btn-sm btn-outline-secondary" href="{{ $company->comapnay_instagram_link }}" target="_blank" rel="noopener">
                    <i class="bi bi-instagram me-1"></i> Instagram
                  </a>
                @endif
                @if(!empty($company?->company_linkedin_link))
                  <a class="btn btn-sm btn-outline-secondary" href="{{ $company->company_linkedin_link }}" target="_blank" rel="noopener">
                    <i class="bi bi-linkedin me-1"></i> LinkedIn
                  </a>
                @endif
                @if(!empty($company?->company_youtube_link))
                  <a class="btn btn-sm btn-outline-secondary" href="{{ $company->company_youtube_link }}" target="_blank" rel="noopener">
                    <i class="bi bi-youtube me-1"></i> YouTube
                  </a>
                @endif
                @if(!empty($company?->company_x_link))
                  <a class="btn btn-sm btn-outline-secondary" href="{{ $company->company_x_link }}" target="_blank" rel="noopener">
                    <i class="bi bi-twitter-x me-1"></i> X
                  </a>
                @endif
              </div>
            @endif
          </div>
        </div>

        <!-- Right: Form (static for now) -->
        <div class="col-lg-7">
          <div class="card cta-form shadow-xl border-0">
            <div class="card-body p-4 p-lg-5">
              <h3 class="h4 mb-3"><i class="bi bi-send"></i> Send us a message</h3>
              <form class="row g-3" action="#" method="post">
                <div class="col-md-6">
                  <label class="form-label">Your Name</label>
                  <input class="form-control" name="name" placeholder="Enter your name" required />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Phone</label>
                  <input class="form-control" name="phone" placeholder="+91…" inputmode="tel" required />
                </div>
                <div class="col-12">
                  <label class="form-label">Email (optional)</label>
                  <input class="form-control" name="email" placeholder="you@example.com" inputmode="email" />
                </div>
                <div class="col-12">
                  <label class="form-label">Service Needed</label>
                  <select class="form-select" name="service" required>
                    <option value="" selected disabled>Select a service</option>
                    <option>Split AC Installation</option>
                    <option>VRF System Installation</option>
                    <option>Ductable / Cassette</option>
                    <option>Window AC Installation</option>
                    <option>Maintenance / AMC</option>
                  </select>
                </div>
                <div class="col-12">
                  <label class="form-label">Message</label>
                  <textarea class="form-control" name="message" rows="4" placeholder="Tell us about your requirement" required></textarea>
                </div>
                <div class="col-12 d-grid d-md-block">
                  <button class="btn btn-cta btn-lg px-4" type="submit">
                    <i class="bi bi-send me-2"></i> Submit
                  </button>
                </div>
                <div class="col-12">
                  <small class="text-body-secondary d-block">By submitting, you agree to be contacted by Swipetrend.</small>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Full-width Map -->
        <div class="col-12">
          <div class="map-card rounded-4 overflow-hidden shadow-sm">
            <iframe
              title="Office Map"
              class="map-embed"
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              src="{{ $mapEmbed ?? 'https://www.google.com/maps?q=Patna&output=embed' }}"
              style="width:100%; height:420px; border:0;">
            </iframe>
          </div>
        </div>

      </div>
    </div>
  </section>

@endsection
