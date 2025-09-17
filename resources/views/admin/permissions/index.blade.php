@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="page-title">
    <h2>Permissions</h2>
    <p class="page-sub">Manage access control across your admin</p>
  </div>
  @can('permission_create')
  <div class="page-actions">
    <a class="btn btn-brand" href="{{ route('admin.permissions.create') }}">
      <i class="fas fa-plus mr-1"></i>
      <span>{{ trans('global.add') }} {{ trans('cruds.permission.title_singular') }}</span>
    </a>
  </div>
  @endcan
</div>

<div class="card table-card">
  <div class="card-body">
    <div class="table-responsive">
      <table id="permissionsTable" class="table table-modern table-striped datatable datatable-Permission align-middle">
        <thead>
          <tr>
            <th width="10"></th>
            <th>{{ trans('cruds.permission.fields.id') }}</th>
            <th>{{ trans('cruds.permission.fields.title') }}</th>
            <th class="text-right th-actions">&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          @foreach($permissions as $permission)
            <tr data-entry-id="{{ $permission->id }}">
              <td></td>
              <td>{{ $permission->id ?? '' }}</td>
              <td>{{ $permission->title ?? '' }}</td>
              <td class="text-right">
                <div class="actions-group">
                  @can('permission_show')
                    <a class="btn btn-sm btn-ghost" href="{{ route('admin.permissions.show', $permission->id) }}" title="{{ trans('global.view') }}">
                      <i class="far fa-eye"></i>
                    </a>
                  @endcan

                  @can('permission_edit')
                    <a class="btn btn-sm btn-ghost-info" href="{{ route('admin.permissions.edit', $permission->id) }}" title="{{ trans('global.edit') }}">
                      <i class="far fa-edit"></i>
                    </a>
                  @endcan

                  @can('permission_delete')
                    <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-sm btn-ghost-danger" title="{{ trans('global.delete') }}">
                        <i class="far fa-trash-alt"></i>
                      </button>
                    </form>
                  @endcan
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

@section('scripts')
@parent
<script>
$(function () {
  window._token = window._token || $('meta[name="csrf-token"]').attr('content');

  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);

  @can('permission_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.permissions.massDestroy') }}",
    className: 'btn btn-ghost-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
        return $(entry).data('entry-id')
      });

      if (!ids.length) {
        alert('{{ trans('global.datatables.zero_selected') }}');
        return;
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: { 'x-csrf-token': _token },
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }
        }).done(function () { location.reload() });
      }
    }
  }
  dtButtons.push(deleteButton);
  @endcan

  let table = $('#permissionsTable').DataTable({
    buttons: dtButtons,
    orderCellsTop: true,
    order: [[1, 'desc']],
    pageLength: 25,
    dom:
      "<'dt-toolbar row align-items-center'<'col-sm-6'l><'col-sm-6 text-sm-right'B>>" +
      "<'row'<'col-sm-12'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row align-items-center'<'col-sm-5'i><'col-sm-7'p>>",
    columnDefs: [
      { targets: 0, className: 'select-checkbox', orderable: false, searchable: false, width: 10 },
      { targets: -1, orderable: false, searchable: false }
    ],
    select: { style: 'multi+shift', selector: 'td:first-child' },
    language: {
      search: "",
      searchPlaceholder: "Search permissions…"
    }
  });

  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(){
    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
  });
});
</script>
@endsection
