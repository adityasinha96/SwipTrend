@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.catalogueCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.catalogue-categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="category_icon">{{ trans('cruds.catalogueCategory.fields.category_icon') }}</label>
                <input class="form-control {{ $errors->has('category_icon') ? 'is-invalid' : '' }}" type="text" name="category_icon" id="category_icon" value="{{ old('category_icon', '') }}" required>
                @if($errors->has('category_icon'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category_icon') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.catalogueCategory.fields.category_icon_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="category_name">{{ trans('cruds.catalogueCategory.fields.category_name') }}</label>
                <input class="form-control {{ $errors->has('category_name') ? 'is-invalid' : '' }}" type="text" name="category_name" id="category_name" value="{{ old('category_name', '') }}" required>
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