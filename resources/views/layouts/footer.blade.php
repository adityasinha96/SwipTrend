<!-- Footer -->
<footer id="contact" class="footer modern-footer">
  <div class="container py-6">
    <div class="row g-4 align-items-start">
      <!-- Brand / Summary -->
      <div class="col-lg-4">
        <div class="d-flex align-items-center gap-2 mb-2">
          <i class="bi bi-snow2 fs-4 text-info"></i>
          <h5 class="fw-800 mb-0">
            {{ $companyDetail?->company_name ?? 'Swipetrend Private Limited' }}
          </h5>
        </div>

        <p class="small text-footer-muted mb-3">
          Residential & commercial Hitachi air conditioning — VRF, ductable, cassette, split & window ACs,
          chillers and controls. Timely installation & clean workmanship in Patna and nearby areas.
        </p>

        <div class="d-flex flex-wrap gap-2 mb-3">
          @if(isset($locations) && $locations->count())
            @foreach($locations as $loc)
              @php
                $parts = array_filter([$loc->city, $loc->state]); // prefer city + state
                $label = count($parts) ? implode(', ', $parts) : trim(($loc->state ?: '') . ($loc->country ? (count($parts) ? ', ' : '') . $loc->country : ''));
                $label = $label ?: ($loc->country ?? 'Location');
              @endphp
              <span class="chip">
                <i class="bi bi-geo-alt me-1"></i> {{ $label }}
              </span>
            @endforeach
          @else
            {{-- Fallback when there are no locations yet --}}
            <span class="chip">
              <i class="bi bi-geo-alt me-1"></i> Patna & Nearby
            </span>
          @endif

          {{-- Keep GST chip as-is --}}
          @if(!empty($companyDetail?->gst_number))
            <span class="chip">
              <i class="bi bi-shield-check me-1"></i>
              GST: {{ $companyDetail->gst_number }}
            </span>
          @endif
        </div>

        <div class="d-flex gap-3 fs-5">
          @if(!empty($companyDetail?->company_facebook_link))
            <a class="social" href="{{ $companyDetail->company_facebook_link }}" target="_blank" rel="noopener" aria-label="Facebook">
              <i class="bi bi-facebook"></i>
            </a>
          @endif
          @if(!empty($companyDetail?->comapnay_instagram_link))
            <a class="social" href="{{ $companyDetail->comapnay_instagram_link }}" target="_blank" rel="noopener" aria-label="Instagram">
              <i class="bi bi-instagram"></i>
            </a>
          @endif
          @if(!empty($companyDetail?->company_linkedin_link))
            <a class="social" href="{{ $companyDetail->company_linkedin_link }}" target="_blank" rel="noopener" aria-label="LinkedIn">
              <i class="bi bi-linkedin"></i>
            </a>
          @endif
          @if(!empty($companyDetail?->company_youtube_link))
            <a class="social" href="{{ $companyDetail->company_youtube_link }}" target="_blank" rel="noopener" aria-label="YouTube">
              <i class="bi bi-youtube"></i>
            </a>
          @endif
          @if(!empty($companyDetail?->company_x_link))
            <a class="social" href="{{ $companyDetail->company_x_link }}" target="_blank" rel="noopener" aria-label="X">
              <i class="bi bi-twitter-x"></i>
            </a>
          @endif
        </div>
      </div>

      <!-- Links -->
      <div class="col-6 col-lg-2">
        <h6 class="fw-600 text-white-50">Company</h6>
        <ul class="list-unstyled small mb-0">
          <li><a class="footer-link" href="{{ route('about') }}">About</a></li>
          <li><a class="footer-link" href="{{ route('services') }}">Services</a></li>
          <li><a class="footer-link" href="{{ route('catalogue') }}">Catalogue</a></li>
          <li><a class="footer-link" href="{{ route('contact') }}">Get a Quote</a></li>
        </ul>
      </div>

      <div class="col-6 col-lg-2">
        <h6 class="fw-600 text-white-50">Services</h6>
        <ul class="list-unstyled small mb-0">
          <li>Split / Window AC</li>
          <li>VRF Systems</li>
          <li>Ductable & Cassette</li>
          <li>Chillers & Controls</li>
        </ul>
      </div>

      <!-- Contact / Quick CTA -->
      <div class="col-lg-4">
        <h6 class="fw-600 text-white-50">Contact</h6>

        @php
          $phonePrimary = $companyDetail?->company_phone_number;
          $phoneOther   = $companyDetail?->other_phone_number;
          $emailPrimary = $companyDetail?->email;
          $emailOther   = $companyDetail?->other_email;

          $telPrimary = $phonePrimary ? preg_replace('/\D+/', '', $phonePrimary) : null;
          $telOther   = $phoneOther ? preg_replace('/\D+/', '', $phoneOther) : null;
        @endphp

        <div class="d-grid gap-2 mb-3">
          @if($phonePrimary)
            <a class="btn btn-outline-light btn-sm justify-content-start d-flex align-items-center"
               href="tel:{{ $telPrimary }}"><i class="bi bi-telephone me-2"></i> {{ $phonePrimary }}</a>
          @endif
          @if($phoneOther)
            <a class="btn btn-outline-light btn-sm justify-content-start d-flex align-items-center"
               href="tel:{{ $telOther }}"><i class="bi bi-telephone me-2"></i> {{ $phoneOther }}</a>
          @endif

          @if($emailPrimary)
            <a class="btn btn-outline-light btn-sm justify-content-start d-flex align-items-center"
               href="mailto:{{ $emailPrimary }}"><i class="bi bi-envelope me-2"></i> {{ $emailPrimary }}</a>
          @endif
          @if($emailOther)
            <a class="btn btn-outline-light btn-sm justify-content-start d-flex align-items-center"
               href="mailto:{{ $emailOther }}"><i class="bi bi-envelope me-2"></i> {{ $emailOther }}</a>
          @endif
        </div>

        <div class="address rounded-4 p-3">
          <div class="small text-white-50 mb-2">Office Address</div>
          <p class="mb-0 text-white-75 small">
            {{ $companyDetail?->office_address ?? 'Patna, Bihar' }}
          </p>

          @if(!empty($companyDetail?->google_map_link))
            <div class="mt-2">
              <a class="btn btn-sm btn-outline-light" target="_blank" rel="noopener"
                 href="{{ $companyDetail->google_map_link }}">
                <i class="bi bi-geo-alt me-1"></i> Get Directions
              </a>
            </div>
          @endif
        </div>
      </div>

    </div>

    <hr class="footer-hr my-4" />

    <div class="d-flex flex-column flex-md-row justify-content-between small text-white-50">
      <div>
        © <span id="y">{{ now()->year }}</span>
        {{ $companyDetail?->company_name ?? 'Swipetrend Pvt Ltd' }}. All rights reserved.
      </div>
      <div class="d-flex gap-3">
        <a class="footer-link" href="{{ route('privacy-policy') }}">Privacy Policy</a>
        <a class="footer-link" href="{{ route('terms') }}">Terms & Conditions</a>
      </div>
    </div>
  </div>

  <!-- decorative lights -->
  <span class="dot dot-1" aria-hidden="true"></span>
  <span class="dot dot-2" aria-hidden="true"></span>
</footer>
