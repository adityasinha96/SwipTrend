@extends('web_master')
@section('main')

  <!-- Subhero -->
  <section class="subhero">
    <div class="container position-relative">
      <nav aria-label="breadcrumb" class="small mb-2">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item">
            <a class="link-light text-decoration-none" href="{{ route('home') }}">Home</a>
          </li>
          <li class="breadcrumb-item text-white-50 active" aria-current="page">Terms & Conditions</li>
        </ol>
      </nav>

      {{-- Title from DB (fallback to static) --}}
      <h1 class="display-6 fw-800 text-white mb-1">
        {{ $terms?->title ?? 'Terms & Conditions' }}
      </h1>

      {{-- Last updated from DB (fallback to '-') --}}
      @php
        $updatedAt = $terms?->updated_at ?? $terms?->created_at;
      @endphp
      <p class="text-white-75 mb-0">
        Last updated: {{ $updatedAt ? $updatedAt->format('d M Y') : '-' }}
      </p>
    </div>
    <img class="subhero-img d-none d-lg-block" src="{{ asset('frontend/assets/img/Controls & BMS.png') }}" alt="" aria-hidden="true">
    <div class="subhero-overlay"></div>
  </section>

  <!-- Content -->
  <section class="section">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-10">
          @if($terms)
            {{-- Render CKEditor HTML safely (admin-controlled content) --}}
            {!! $terms->description !!}
          @else
            <p class="text-body-secondary">Our terms & conditions will be published soon.</p>
          @endif
        </div>
      </div>
    </div>
  </section>

@endsection
