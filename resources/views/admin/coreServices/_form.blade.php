{{-- resources/views/admin/coreServices/_form.blade.php --}}
@php
    /** @var \App\Models\CoreService|null $coreService */
    $__img = isset($coreService) ? $coreService->getMedia('image')->last() : null;
    $__brochure = isset($coreService) ? $coreService->getMedia('brochure')->last() : null;

    // Build a plain PHP array — no ternaries or function calls inside @json to avoid parser quirks
    $__cfg = [
        'storeMediaUrl' => route('admin.core-services.storeMedia'),
        'ckUploadUrl'   => route('admin.core-services.storeCKEditorImages'),
        'csrf'          => csrf_token(),
        'crudId'        => isset($coreService) ? (int) $coreService->id : 0,
        'hasExistingImage'     => (bool) $__img,
        'existingImage'        => null,
        'hasExistingBrochure'  => (bool) $__brochure,
        'existingBrochure'     => null,
    ];

    if ($__img) {
        $__cfg['existingImage'] = [
            'file_name' => $__img->file_name,
            'url'       => $__img->getUrl(),
            'preview'   => $__img->getUrl('preview'),
        ];
    }

    if ($__brochure) {
        $__cfg['existingBrochure'] = [
            'file_name' => $__brochure->file_name,
            'url'       => $__brochure->getUrl(),
        ];
    }
@endphp

<form id="coreServiceForm"
      method="POST"
      action="{{ isset($coreService)
                  ? route('admin.core-services.update', $coreService->id)
                  : route('admin.core-services.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if (isset($coreService))
        @method('PUT')
    @endif

    {{-- Service Name --}}
    <div class="form-group">
        <label class="required" for="service_name">{{ trans('cruds.coreService.fields.service_name') }}</label>
        <input class="form-control"
               type="text"
               name="service_name"
               id="service_name"
               value="{{ old('service_name', $coreService->service_name ?? '') }}"
               required>
        <div class="invalid-feedback d-none" data-error-for="service_name"></div>
        <span class="help-block">{{ trans('cruds.coreService.fields.service_name_helper') }}</span>
    </div>

    {{-- Description (CKEditor) --}}
    <div class="form-group">
        <label for="description">{{ trans('cruds.coreService.fields.description') }}</label>
        <textarea class="form-control ckeditor"
                  name="description"
                  id="description">{!! old('description', $coreService->description ?? '') !!}</textarea>
        <div class="invalid-feedback d-none" data-error-for="description"></div>
        <span class="help-block">{{ trans('cruds.coreService.fields.description_helper') }}</span>
    </div>

    {{-- Image (Spatie media: "image") --}}
    <div class="form-group">
        <label for="image">{{ __('Image') }}</label>
        <div class="needsclick dropzone" id="image-dropzone"></div>
        <div class="invalid-feedback d-none" data-error-for="image"></div>
        <span class="help-block">{{ __('Upload a featured image (max 10MB).') }}</span>
        @if ($__img)
            <small class="text-muted d-block mt-1">{{ __('Current:') }} {{ $__img->file_name }}</small>
        @endif
    </div>

    {{-- Brochure (Spatie media: "brochure") --}}
    <div class="form-group">
        <label for="brochure">{{ trans('cruds.coreService.fields.brochure') }}</label>
        <div class="needsclick dropzone" id="brochure-dropzone"></div>
        <div class="invalid-feedback d-none" data-error-for="brochure"></div>
        <span class="help-block">{{ trans('cruds.coreService.fields.brochure_helper') }}</span>
        @if ($__brochure)
            <small class="text-muted d-block mt-1">{{ __('Current:') }} {{ $__brochure->file_name }}</small>
        @endif
    </div>

    <div class="form-group mb-0">
        <button class="btn btn-danger" type="submit">
            {{ isset($coreService) ? trans('global.save') : trans('global.create') }}
        </button>
    </div>
</form>

{{-- JS config for the modal consumer (index.blade initializers) --}}
<script>
  // Use a single JSON emission — no Blade logic inside to avoid bracket/quote mismatches
  window.__coreServiceModalConfig = {!! json_encode($__cfg, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!};
</script>
