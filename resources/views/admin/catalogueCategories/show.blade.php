@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.catalogueCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.catalogue-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.catalogueCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $catalogueCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.catalogueCategory.fields.category_icon') }}
                        </th>
                        <td>
                            {{ $catalogueCategory->category_icon }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.catalogueCategory.fields.category_name') }}
                        </th>
                        <td>
                            {{ $catalogueCategory->category_name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.catalogue-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection