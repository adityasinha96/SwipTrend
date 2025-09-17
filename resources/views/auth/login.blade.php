@extends('layouts.app')

@section('content')
<div class="auth-bg">
    <div class="auth-wrapper">
        <div class="card auth-card mx-auto">
            <div class="card-body">
                <h1 class="brand-title">
                    {{-- You can swap this with a logo <img> if you have one --}}
                    {{ trans('panel.site_title') }}
                </h1>
                <p class="brand-subtitle small-muted mb-3">{{ trans('global.login') }}</p>

                @if(session('message'))
                    <div class="alert alert-info" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

                    {{-- Forgot Password Modal --}}
                            <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-3 shadow">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title">Forgot Password</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center p-4">
                                    <p class="mb-0">Please contact <strong>Service Provider</strong> to reset your password.</p>
                                </div>
                                <div class="modal-footer border-0 justify-content-center">
                                    <button type="button" class="btn btn-brand px-4" data-dismiss="modal">OK</button>
                                </div>
                                </div>
                            </div>
                            </div>


                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label small-muted">{{ trans('global.login_email') }}</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                autocomplete="email"
                                autofocus
                                placeholder="you@company.com"
                                value="{{ old('email', null) }}"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                required
                            >
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="mb-2">
                        <label for="password" class="form-label small-muted">{{ trans('global.login_password') }}</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </span>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                placeholder="••••••••"
                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                required
                            >
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Remember + Forgot --}}
                    <div class="auth-actions">
                        <div class="form-check m-0">
                            <input class="form-check-input" name="remember" type="checkbox" id="remember">
                            <label class="form-check-label small-muted" for="remember">
                                {{ trans('global.remember_me') }}
                            </label>
                        </div>

                        <div class="auth-links">
                            @if(Route::has('password.request'))
                                <a id="forgot-link" href="#" role="button">
                                    {{ trans('global.forgot_password') }}
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-brand w-100">
                        {{ trans('global.login') }}
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var modalEl = document.getElementById('forgotPasswordModal');
    if (!modalEl) return;

    // If jQuery/BS4 present, append to body to avoid stacking-context traps
    if (window.$) {
      $('#forgotPasswordModal').appendTo('body');
    } else {
      // vanilla fallback
      document.body.appendChild(modalEl);
    }
  });
</script>
@endpush
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  var link = document.getElementById('forgot-link');
  if (!link) return;

  link.addEventListener('click', function (e) {
    e.preventDefault();

    var modalEl = document.getElementById('forgotPasswordModal');
    if (!modalEl) return;

    // Try Bootstrap 5 API
    try {
      if (window.bootstrap && bootstrap.Modal) {
        var m = bootstrap.Modal.getOrCreateInstance(modalEl);
        m.show();
        return;
      }
    } catch (_) {}

    // Fallback to Bootstrap 4 + jQuery
    if (window.$ && typeof $('#forgotPasswordModal').modal === 'function') {
      $('#forgotPasswordModal').modal('show');
      return;
    }

    // Last fallback (no Bootstrap JS found)
    alert('Please contact Service Provider to reset your password.');
  });
});
</script>
@endpush
@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var modalEl = document.getElementById('forgotPasswordModal');
    if (!modalEl) return;

    // Ensure modal is at <body> level (fixes z-index/stacking)
    if (window.$) {
      $('#forgotPasswordModal').appendTo('body');
    } else {
      document.body.appendChild(modalEl);
    }

    // Fallback: explicitly hide on OK/Cancel/Close clicks
    function hideModal() {
      if (window.$ && typeof $('#forgotPasswordModal').modal === 'function') {
        $('#forgotPasswordModal').modal('hide');
      } else if (window.bootstrap && bootstrap.Modal) {
        var inst = bootstrap.Modal.getOrCreateInstance(modalEl);
        inst.hide();
      }
    }

    // Delegate to catch dynamically moved elements
    document.addEventListener('click', function(e){
      // match OK, Cancel, header X, or any element with data-dismiss="modal"
      if (
        e.target.closest('#forgotPasswordModal .btn-brand') ||      // OK
        e.target.closest('#forgotPasswordModal .btn-cancel') ||     // (if you add a cancel class)
        e.target.closest('#forgotPasswordModal .close') ||          // header X
        e.target.closest('#forgotPasswordModal [data-dismiss="modal"]') // any BS4 dismiss
      ) {
        e.preventDefault();
        hideModal();
      }
    }, true);
  });
</script>
@endpush



@endsection
