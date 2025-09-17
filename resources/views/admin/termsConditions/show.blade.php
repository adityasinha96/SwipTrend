@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.termsCondition.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.terms-conditions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.termsCondition.fields.id') }}
                        </th>
                        <td>
                            {{ $termsCondition->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.termsCondition.fields.title') }}
                        </th>
                        <td>
                            {{ $termsCondition->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.termsCondition.fields.description') }}
                        </th>
                        <td>
                            {!! $termsCondition->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.terms-conditions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection