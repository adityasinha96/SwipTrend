@php
    $isEdit = ($mode ?? null) === 'edit';
    $action = $isEdit
        ? route('admin.highlights.update', $highlight->id)
        : route('admin.highlights.store');
@endphp

<form id="highlightForm" method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="form-group">
        <label class="required" for="service_name">{{ trans('cruds.highlight.fields.service_name') }}</label>
        <input class="form-control" type="text" name="service_name" id="service_name"
               value="{{ old('service_name', $highlight->service_name ?? '') }}" required>
        <span class="help-block">{{ trans('cruds.highlight.fields.service_name_helper') }}</span>
    </div>

    <div class="form-group">
        <label class="required" for="service_description">{{ trans('cruds.highlight.fields.service_description') }}</label>
        <input class="form-control" type="text" name="service_description" id="service_description"
               value="{{ old('service_description', $highlight->service_description ?? '') }}" required>
        <span class="help-block">{{ trans('cruds.highlight.fields.service_description_helper') }}</span>
    </div>

    <div class="form-group">
        <label class="required" for="image">{{ trans('cruds.highlight.fields.image') }}</label>
        <div class="needsclick dropzone" id="image-dropzone"></div>
        <span class="help-block">{{ trans('cruds.highlight.fields.image_helper') }}</span>
    </div>

    <div class="d-flex gap-2">
        <button class="btn btn-danger" type="submit">{{ trans('global.save') }}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    </div>
</form>


