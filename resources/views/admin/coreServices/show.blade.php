@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.coreService.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.core-services.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.coreService.fields.id') }}
                        </th>
                        <td>
                            {{ $coreService->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coreService.fields.service_name') }}
                        </th>
                        <td>
                            {{ $coreService->service_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coreService.fields.description') }}
                        </th>
                        <td>
                            {!! $coreService->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coreService.fields.brochure') }}
                        </th>
                        <td>
                            @if($coreService->brochure)
                                <a href="{{ $coreService->brochure->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.core-services.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection