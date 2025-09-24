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
          <li class="breadcrumb-item text-white-50 active" aria-current="page">Catalogue</li>
        </ol>
      </nav>
      <h1 class="display-6 fw-800 text-white mb-1">Hitachi Product Range</h1>
      <p class="text-white-75 mb-0">Room ACs • Light Commercial • VRF</p>
    </div>
    <img class="subhero-img d-none d-lg-block"
         src="{{ asset('frontend/assets/img/Light Commercial Range (2024)-sq.png') }}"
         alt="" aria-hidden="true">
    <div class="subhero-overlay"></div>
  </section>

  <!-- Filters -->
  <section class="py-4 bg-white border-bottom">
    <div class="container">
      <div class="row g-2 align-items-center">
        <div class="col-lg-8">
          <div class="d-flex flex-wrap gap-2">
            @foreach($categories as $cat)
              @php
                $slug = \Illuminate\Support\Str::slug($cat->category_name);
                $icon = trim((string) $cat->category_icon);
                // decide whether it's a FA icon or Bootstrap Icon based on class prefix
                $isFa = $icon && (str_starts_with($icon, 'fa') || str_contains($icon, ' fa-'));
                $isBi = $icon && (str_starts_with($icon, 'bi ') || str_contains($icon, ' bi-'));
              @endphp
              <a class="btn btn-outline-secondary btn-sm" href="#{{ $slug }}">
                @if($isFa)
                  <i class="{{ $icon }} me-1"></i>
                @elseif($isBi)
                  <i class="{{ $icon }} me-1"></i>
                @elseif($icon)
                  <i class="{{ $icon }} me-1"></i>
                @else
                  <i class="bi bi-tag me-1"></i>
                @endif
                {{ $cat->category_name }}
              </a>
            @endforeach
            <a class="btn btn-outline-secondary btn-sm" href="#all">
              <i class="bi bi-grid-3x3-gap-fill me-1"></i> All
            </a>
          </div>
        </div>
        <div class="col-lg-4">
          <form class="input-group input-group-sm">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="search" class="form-control"
                   placeholder="Search catalogue (e.g., VRF, cassette, frostwash)"
                   aria-label="Search">
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Catalogue Grid -->
  <section class="section" id="all">
    <div class="container">
      <div class="row g-4">

        @forelse($categories as $cat)
          @php $slug = \Illuminate\Support\Str::slug($cat->category_name); @endphp

          @if($cat->cataloguDatas->isEmpty())
            {{-- Keep an anchor so filter buttons still jump somewhere --}}
            <div class="col-12" id="{{ $slug }}" style="display:none;"></div>
          @endif

          @foreach($cat->cataloguDatas as $loopIndex => $item)
            @php
              $img = $item->image?->url ?? asset('frontend/assets/img/placeholder-4x3.png');
              $pdf = $item->upload_brochure?->getUrl();
              $tag = $cat->category_name;
              $title = $item->name;
              $desc = $item->description ?: '';
              $downloadName = \Illuminate\Support\Str::slug($title).'.pdf';
              $colId = $loopIndex === 0 ? $slug : null; // attach category anchor to first card only
            @endphp

            <div class="col-md-6 col-lg-4" @if($colId) id="{{ $colId }}" @endif>
              <div class="catalog-card h-100 overflow-hidden">
                <div class="catalog-thumb">
                  <img class="w-100" alt="{{ $title }}" src="{{ $img }}">
                  <span class="catalog-tag">{{ $tag }}</span>
                </div>
                <div class="p-3">
                  <h5 class="mb-1">{{ $title }}</h5>
                  @if($desc)
                    <p class="small text-body-secondary mb-3">{!! $desc !!}</p>
                  @endif

                  <div class="d-flex gap-2">
                    @if($pdf)
                      <a class="btn btn-sm btn-primary"
                         href="{{ $pdf }}"
                         data-bs-toggle="modal"
                         data-bs-target="#pdfModal"
                         data-pdf="{{ $pdf }}"
                         data-title="{{ $title }}">
                        <i class="bi bi-eye me-1"></i> Preview
                      </a>
                      <a class="btn btn-sm btn-outline-secondary"
                         href="{{ $pdf }}"
                         download="{{ $downloadName }}">
                        <i class="bi bi-download me-1"></i> Export
                      </a>
                    @else
                      <a class="btn btn-sm btn-secondary disabled" href="#"
                         tabindex="-1" aria-disabled="true">
                        <i class="bi bi-eye me-1"></i> No Brochure
                      </a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        @empty
          <div class="col-12">
            <div class="alert alert-info mb-0">No catalogue items found.</div>
          </div>
        @endforelse

      </div>

      <!-- Assistance -->
      <div class="text-center mt-5">
        <p class="text-body-secondary mb-3">Need help choosing the right AC?</p>
        <a class="btn btn-primary" href="{{ route('home') }}#enquire">
          <i class="bi bi-send me-2"></i>Request Full Catalogue & Quote
        </a>
      </div>
    </div>
  </section>

  {{-- PDF Preview Modal (if your layout doesn’t already include one) --}}
  @once
  <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="pdfModalLabel">Preview</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
        </div>
        <div class="modal-body p-0">
          <iframe id="pdfFrame" src="" style="width:100%;height:80vh;border:0;"></iframe>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('shown.bs.modal', function (e) {
      if (e.target.id !== 'pdfModal') return;
      const trigger = e.relatedTarget;
      if (!trigger) return;
      const url = trigger.getAttribute('data-pdf');
      const title = trigger.getAttribute('data-title') || 'Preview';
      document.getElementById('pdfFrame').src = url;
      document.getElementById('pdfModalLabel').textContent = title;
    });
    document.addEventListener('hidden.bs.modal', function (e) {
      if (e.target.id !== 'pdfModal') return;
      document.getElementById('pdfFrame').src = '';
    });
  </script>
  @endonce

@endsection
