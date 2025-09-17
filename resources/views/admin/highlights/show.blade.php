@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.highlight.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.highlights.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.highlight.fields.id') }}
                        </th>
                        <td>
                            {{ $highlight->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.highlight.fields.service_name') }}
                        </th>
                        <td>
                            {{ $highlight->service_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.highlight.fields.service_description') }}
                        </th>
                        <td>
                            {{ $highlight->service_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.highlight.fields.image') }}
                        </th>
                        <td>
                            @if($highlight->image)
                                <a href="{{ $highlight->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $highlight->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.highlights.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection