@extends('layouts.admin')

@section('content')

{{-- Page Header --}}
<div class="page-header">
  <div class="page-title">
    <h2>{{ trans('global.show') }} {{ trans('cruds.permission.title') }}</h2>
    <p class="page-sub">ID #{{ $permission->id }}</p>
  </div>

  <div class="page-actions">
    <a href="{{ route('admin.permissions.index') }}" class="btn btn-ghost">
      <i class="fas fa-arrow-left mr-1"></i>{{ trans('global.back_to_list') }}
    </a>

    @can('permission_edit')
      <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-brand">
        <i class="far fa-edit mr-1"></i>{{ trans('global.edit') }}
      </a>
    @endcan

    @can('permission_delete')
      <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-ghost-danger">
          <i class="far fa-trash-alt mr-1"></i>{{ trans('global.delete') }}
        </button>
      </form>
    @endcan
  </div>
</div>

{{-- Details Card --}}
<div class="card table-card">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-modern table-show align-middle">
        <tbody>
          <tr>
            <th>{{ trans('cruds.permission.fields.id') }}</th>
            <td>{{ $permission->id }}</td>
          </tr>
          <tr>
            <th>{{ trans('cruds.permission.fields.title') }}</th>
            <td>{{ $permission->title }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="show-actions">
      <a href="{{ route('admin.permissions.index') }}" class="btn btn-ghost">
        <i class="fas fa-arrow-left mr-1"></i>{{ trans('global.back_to_list') }}
      </a>
    </div>
  </div>
</div>

@endsection
