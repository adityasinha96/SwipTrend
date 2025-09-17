@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.quickServiceRequest.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.quick-service-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.quickServiceRequest.fields.id') }}
                        </th>
                        <td>
                            {{ $quickServiceRequest->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.quickServiceRequest.fields.full_name') }}
                        </th>
                        <td>
                            {{ $quickServiceRequest->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.quickServiceRequest.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $quickServiceRequest->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.quickServiceRequest.fields.city_area') }}
                        </th>
                        <td>
                            {{ $quickServiceRequest->city_area }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.quickServiceRequest.fields.service_needed') }}
                        </th>
                        <td>
                            {{ $quickServiceRequest->service_needed }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.quickServiceRequest.fields.message') }}
                        </th>
                        <td>
                            {{ $quickServiceRequest->message }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.quick-service-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection