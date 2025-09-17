@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.quickServiceRequest.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.quick-service-requests.update", [$quickServiceRequest->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="full_name">{{ trans('cruds.quickServiceRequest.fields.full_name') }}</label>
                <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', $quickServiceRequest->full_name) }}" required>
                @if($errors->has('full_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('full_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.quickServiceRequest.fields.full_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_number">{{ trans('cruds.quickServiceRequest.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $quickServiceRequest->phone_number) }}" required>
                @if($errors->has('phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.quickServiceRequest.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city_area">{{ trans('cruds.quickServiceRequest.fields.city_area') }}</label>
                <input class="form-control {{ $errors->has('city_area') ? 'is-invalid' : '' }}" type="text" name="city_area" id="city_area" value="{{ old('city_area', $quickServiceRequest->city_area) }}" required>
                @if($errors->has('city_area'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city_area') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.quickServiceRequest.fields.city_area_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="service_needed">{{ trans('cruds.quickServiceRequest.fields.service_needed') }}</label>
                <input class="form-control {{ $errors->has('service_needed') ? 'is-invalid' : '' }}" type="text" name="service_needed" id="service_needed" value="{{ old('service_needed', $quickServiceRequest->service_needed) }}" required>
                @if($errors->has('service_needed'))
                    <div class="invalid-feedback">
                        {{ $errors->first('service_needed') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.quickServiceRequest.fields.service_needed_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="message">{{ trans('cruds.quickServiceRequest.fields.message') }}</label>
                <textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" name="message" id="message">{{ old('message', $quickServiceRequest->message) }}</textarea>
                @if($errors->has('message'))
                    <div class="invalid-feedback">
                        {{ $errors->first('message') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.quickServiceRequest.fields.message_helper') }}</span>
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