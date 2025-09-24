@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.catalogueCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.catalogue-categories.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- CATEGORY ICON (Font Awesome dropdown + preview) --}}
            @php
                // Add or remove icons as you like (using FA4-safe names)
                $faIcons = [
                    'fa fa-snowflake-o' => 'Snowflake (AC / Cooling)',
                    'fa fa-home'        => 'Home / Residential',
                    'fa fa-building'    => 'Building / Commercial',
                    'fa fa-cogs'        => 'Cogs / Engineering',
                    'fa fa-wrench'      => 'Wrench / Service',
                    'fa fa-plug'        => 'Plug / Electrical',
                    'fa fa-shield'      => 'Shield / Warranty',
                    'fa fa-map-marker'  => 'Map / Location',
                    'fa fa-clock-o'     => 'Clock / On-time',
                    'fa fa-clipboard'   => 'Clipboard / Docs',
                    'fa fa-leaf'        => 'Leaf / Efficiency',
                    'fa fa-industry'    => 'Industry / Factory',
                    'fa fa-certificate' => 'Certificate / Quality',
                    'fa fa-thermometer-empty' => 'Thermometer (Low)',
                    'fa fa-thermometer-half'  => 'Thermometer (Medium)',
                    'fa fa-thermometer-full'  => 'Thermometer (High)',
                    'fa fa-tachometer'   => 'Tachometer / Performance',
                    'fa fa-gears'        => 'Gears / Mechanism',
                    'fa fa-recycle'      => 'Recycle / Green',
                    'fa fa-filter'       => 'Filter / Purification',
                ];
                $oldIcon = old('category_icon');
            @endphp

            <div class="form-group">
                <label class="required" for="category_icon">
                    {{ trans('cruds.catalogueCategory.fields.category_icon') }}
                </label>

                <select
                    class="form-control select2 {{ $errors->has('category_icon') ? 'is-invalid' : '' }}"
                    name="category_icon"
                    id="category_icon"
                    required
                >
                    <option value="" disabled {{ $oldIcon ? '' : 'selected' }}>-- Select an icon --</option>
                    @foreach ($faIcons as $class => $label)
                        <option value="{{ $class }}" data-icon="{{ $class }}" {{ $oldIcon === $class ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>

                @if($errors->has('category_icon'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category_icon') }}
                    </div>
                @endif

                <span class="help-block">
                    {{ trans('cruds.catalogueCategory.fields.category_icon_helper') }}
                </span>

                <div class="mt-2">
                    <small class="text-muted">Preview:</small>
                    <i id="iconPreview" class="{{ $oldIcon }} fa-2x align-middle"></i>
                </div>
            </div>

            {{-- CATEGORY NAME --}}
            <div class="form-group">
                <label class="required" for="category_name">{{ trans('cruds.catalogueCategory.fields.category_name') }}</label>
                <input
                    class="form-control {{ $errors->has('category_name') ? 'is-invalid' : '' }}"
                    type="text"
                    name="category_name"
                    id="category_name"
                    value="{{ old('category_name', '') }}"
                    required
                >
                @if($errors->has('category_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.catalogueCategory.fields.category_name_helper') }}</span>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

{{-- If your admin layout supports these sections, they’ll be included in the right places --}}
@section('styles')
    {{-- Font Awesome 4.7 (needed for the fa- classes above).
         If your layout already includes FA, you can remove this line. --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha512-SfZ6Pj9QWQ3lG7mHc0wz2k8t8bJj0g+Hk8E2mG3t1z7x6bXbY+o0qv2dQ8n0bXK1y4y1gQq2B9s9u7w9w4nU2Q=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Select2 CSS --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
@endsection

@section('scripts')
@parent
    {{-- Select2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
      (function () {
        function formatIcon(state) {
          if (!state.id) return state.text;
          var cls = $(state.element).data('icon');
          return $('<span><i class="' + cls + ' mr-2" style="min-width:20px;display:inline-block;"></i> ' + state.text + '</span>');
        }

        var $sel = $('#category_icon');

        $sel.select2({
          width: '100%',
          templateResult: formatIcon,
          templateSelection: formatIcon,
          escapeMarkup: function (m) { return m; } // allow HTML rendering
        });

        function updateIconPreview() {
          var cls = $sel.val() || '';
          $('#iconPreview').attr('class', cls + ' fa-2x align-middle');
        }

        $sel.on('change', updateIconPreview);
        updateIconPreview(); // set initial preview
      })();
    </script>
@endsection
