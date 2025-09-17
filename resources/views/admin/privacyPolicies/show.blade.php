@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.privacyPolicy.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.privacy-policies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.privacyPolicy.fields.id') }}
                        </th>
                        <td>
                            {{ $privacyPolicy->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.privacyPolicy.fields.title') }}
                        </th>
                        <td>
                            {{ $privacyPolicy->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.privacyPolicy.fields.description') }}
                        </th>
                        <td>
                            {!! $privacyPolicy->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.privacy-policies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection