@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cataloguData.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.catalogu-datas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cataloguData.fields.id') }}
                        </th>
                        <td>
                            {{ $cataloguData->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cataloguData.fields.catalogue_category') }}
                        </th>
                        <td>
                            {{ $cataloguData->catalogue_category->category_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cataloguData.fields.name') }}
                        </th>
                        <td>
                            {{ $cataloguData->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cataloguData.fields.description') }}
                        </th>
                        <td>
                            {!! $cataloguData->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cataloguData.fields.upload_brochure') }}
                        </th>
                        <td>
                            @if($cataloguData->upload_brochure)
                                <a href="{{ $cataloguData->upload_brochure->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cataloguData.fields.image') }}
                        </th>
                        <td>
                            @if($cataloguData->image)
                                <a href="{{ $cataloguData->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $cataloguData->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.catalogu-datas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection