@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.companyDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.company-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.companyDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $companyDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyDetail.fields.company_name') }}
                        </th>
                        <td>
                            {{ $companyDetail->company_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyDetail.fields.gst_number') }}
                        </th>
                        <td>
                            {{ $companyDetail->gst_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyDetail.fields.company_phone_number') }}
                        </th>
                        <td>
                            {{ $companyDetail->company_phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyDetail.fields.other_phone_number') }}
                        </th>
                        <td>
                            {{ $companyDetail->other_phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyDetail.fields.google_map_link') }}
                        </th>
                        <td>
                            {{ $companyDetail->google_map_link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyDetail.fields.email') }}
                        </th>
                        <td>
                            {{ $companyDetail->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyDetail.fields.other_email') }}
                        </th>
                        <td>
                            {{ $companyDetail->other_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyDetail.fields.office_address') }}
                        </th>
                        <td>
                            {{ $companyDetail->office_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyDetail.fields.company_facebook_link') }}
                        </th>
                        <td>
                            {{ $companyDetail->company_facebook_link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyDetail.fields.comapnay_instagram_link') }}
                        </th>
                        <td>
                            {{ $companyDetail->comapnay_instagram_link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyDetail.fields.company_linkedin_link') }}
                        </th>
                        <td>
                            {{ $companyDetail->company_linkedin_link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyDetail.fields.company_youtube_link') }}
                        </th>
                        <td>
                            {{ $companyDetail->company_youtube_link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companyDetail.fields.company_x_link') }}
                        </th>
                        <td>
                            {{ $companyDetail->company_x_link }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.company-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection