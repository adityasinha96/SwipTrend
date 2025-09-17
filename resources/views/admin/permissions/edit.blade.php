@extends('layouts.admin')

@section('content')

{{-- Page Header --}}
<div class="page-header">
  <div class="page-title">
    <h2>{{ trans('global.edit') }} {{ trans('cruds.permission.title_singular') }}</h2>
    <p class="page-sub">ID #{{ $permission->id }}</p>
  </div>
  <div class="page-actions">
    <a href="{{ route('admin.permissions.index') }}" class="btn btn-ghost">
      <i class="fas fa-arrow-left mr-1"></i>{{ trans('global.back_to_list') }}
    </a>
  </div>
</div>

{{-- Form Card --}}
<div class="card form-card">
  <div class="card-body">
    <form method="POST" action="{{ route('admin.permissions.update', [$permission->id]) }}" enctype="multipart/form-data" id="permissionEditForm">
      @method('PUT')
      @csrf

      <div class="form-group">
        <label class="form-label required" for="title">{{ trans('cruds.permission.fields.title') }}</label>
        <input
          class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
          type="text"
          name="title"
          id="title"
          value="{{ old('title', $permission->title) }}"
          required
          autocomplete="off"
        >
        @if($errors->has('title'))
          <div class="invalid-feedback">
            {{ $errors->first('title') }}
          </div>
        @endif
        <span class="help-block">{{ trans('cruds.permission.fields.title_helper') }}</span>
      </div>

      <div class="form-actions">
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-ghost">
          <i class="fas fa-times mr-1"></i>{{ trans('global.cancel') }}
        </a>
        <button class="btn btn-brand" type="submit">
          <i class="fas fa-save mr-1"></i>{{ trans('global.save') }}
        </button>
      </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
@parent
<script>
  // Cmd/Ctrl + S to submit
  document.addEventListener('keydown', function(e){
    const isMac = navigator.platform.toUpperCase().indexOf('MAC')>=0;
    if ((isMac ? e.metaKey : e.ctrlKey) && e.key.toLowerCase() === 's') {
      e.preventDefault();
      const form = document.getElementById('permissionEditForm');
      if (form) form.submit();
    }
  });
</script>
@endsection
