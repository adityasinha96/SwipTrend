@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.companyDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.company-details.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="company_name">{{ trans('cruds.companyDetail.fields.company_name') }}</label>
                <textarea class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" name="company_name" id="company_name" required>{{ old('company_name') }}</textarea>
                @if($errors->has('company_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyDetail.fields.company_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="gst_number">{{ trans('cruds.companyDetail.fields.gst_number') }}</label>
                <input class="form-control {{ $errors->has('gst_number') ? 'is-invalid' : '' }}" type="text" name="gst_number" id="gst_number" value="{{ old('gst_number', '') }}" required>
                @if($errors->has('gst_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gst_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyDetail.fields.gst_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="company_phone_number">{{ trans('cruds.companyDetail.fields.company_phone_number') }}</label>
                <input class="form-control {{ $errors->has('company_phone_number') ? 'is-invalid' : '' }}" type="text" name="company_phone_number" id="company_phone_number" value="{{ old('company_phone_number', '') }}" required>
                @if($errors->has('company_phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyDetail.fields.company_phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="other_phone_number">{{ trans('cruds.companyDetail.fields.other_phone_number') }}</label>
                <input class="form-control {{ $errors->has('other_phone_number') ? 'is-invalid' : '' }}" type="text" name="other_phone_number" id="other_phone_number" value="{{ old('other_phone_number', '') }}">
                @if($errors->has('other_phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('other_phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyDetail.fields.other_phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="google_map_link">{{ trans('cruds.companyDetail.fields.google_map_link') }}</label>
                <textarea class="form-control {{ $errors->has('google_map_link') ? 'is-invalid' : '' }}" name="google_map_link" id="google_map_link" required>{{ old('google_map_link') }}</textarea>
                @if($errors->has('google_map_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('google_map_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyDetail.fields.google_map_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.companyDetail.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyDetail.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="other_email">{{ trans('cruds.companyDetail.fields.other_email') }}</label>
                <input class="form-control {{ $errors->has('other_email') ? 'is-invalid' : '' }}" type="text" name="other_email" id="other_email" value="{{ old('other_email', '') }}">
                @if($errors->has('other_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('other_email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyDetail.fields.other_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="office_address">{{ trans('cruds.companyDetail.fields.office_address') }}</label>
                <textarea class="form-control {{ $errors->has('office_address') ? 'is-invalid' : '' }}" name="office_address" id="office_address" required>{{ old('office_address') }}</textarea>
                @if($errors->has('office_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('office_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyDetail.fields.office_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_facebook_link">{{ trans('cruds.companyDetail.fields.company_facebook_link') }}</label>
                <textarea class="form-control {{ $errors->has('company_facebook_link') ? 'is-invalid' : '' }}" name="company_facebook_link" id="company_facebook_link">{{ old('company_facebook_link') }}</textarea>
                @if($errors->has('company_facebook_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_facebook_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyDetail.fields.company_facebook_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comapnay_instagram_link">{{ trans('cruds.companyDetail.fields.comapnay_instagram_link') }}</label>
                <textarea class="form-control {{ $errors->has('comapnay_instagram_link') ? 'is-invalid' : '' }}" name="comapnay_instagram_link" id="comapnay_instagram_link">{{ old('comapnay_instagram_link') }}</textarea>
                @if($errors->has('comapnay_instagram_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comapnay_instagram_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyDetail.fields.comapnay_instagram_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_linkedin_link">{{ trans('cruds.companyDetail.fields.company_linkedin_link') }}</label>
                <textarea class="form-control {{ $errors->has('company_linkedin_link') ? 'is-invalid' : '' }}" name="company_linkedin_link" id="company_linkedin_link">{{ old('company_linkedin_link') }}</textarea>
                @if($errors->has('company_linkedin_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_linkedin_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyDetail.fields.company_linkedin_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_youtube_link">{{ trans('cruds.companyDetail.fields.company_youtube_link') }}</label>
                <textarea class="form-control {{ $errors->has('company_youtube_link') ? 'is-invalid' : '' }}" name="company_youtube_link" id="company_youtube_link">{{ old('company_youtube_link') }}</textarea>
                @if($errors->has('company_youtube_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_youtube_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyDetail.fields.company_youtube_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_x_link">{{ trans('cruds.companyDetail.fields.company_x_link') }}</label>
                <input class="form-control {{ $errors->has('company_x_link') ? 'is-invalid' : '' }}" type="text" name="company_x_link" id="company_x_link" value="{{ old('company_x_link', '') }}">
                @if($errors->has('company_x_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_x_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyDetail.fields.company_x_link_helper') }}</span>
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