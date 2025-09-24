@extends('layouts.admin')

@section('content')
@can('catalogue_category_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.catalogue-categories.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.catalogueCategory.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.catalogueCategory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-CatalogueCategory">
            <thead>
                <tr>
                    <th width="10">
                        {{-- placeholder for DT selection checkbox (kept for consistency with generator) --}}
                    </th>
                    <th>{{ trans('cruds.catalogueCategory.fields.category_icon') }}</th>
                    <th>{{ trans('cruds.catalogueCategory.fields.category_name') }}</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('styles')
    {{-- If Font Awesome is not already included in your admin layout, include it here. --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha512-SfZ6Pj9QWQ3lG7mHc0wz2k8t8bJj0g+Hk8E2mG3t1z7x6bXbY+o0qv2dQ8n0bXK1y4y1gQq2B9s9u7w9w4nU2Q=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('scripts')
@parent
<script>
$(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

@can('catalogue_category_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.catalogue-categories.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) { return entry.id });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}');
        return;
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }
        }).done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  // Helper to safely escape text (used if we decide to show the class string as a title)
  function escapeHtml(str) {
    return String(str || '').replace(/[&<>"'`=\/]/g, function (s) {
      return ({
        '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;','/':'&#x2F;','`':'&#x60;','=':'&#x3D;'
      })[s];
    });
  }

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.catalogue-categories.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder', searchable: false, sortable: false },

      // CATEGORY ICON (render the <i> tag; no need to change controller)
      {
        data: 'category_icon',
        name: 'category_icon',
        searchable: true,
        sortable: false,
        render: function (data, type, row) {
          if (!data) return '';
          // Show the icon; keep class name as title tooltip
          return '<i class="'+ escapeHtml(data) +' fa-lg" title="'+ escapeHtml(data) +'"></i>';
        }
      },

      { data: 'category_name', name: 'category_name' },

      { data: 'actions', name: 'actions', searchable: false, sortable: false }
    ],
    orderCellsTop: true,
    order: [[ 2, 'asc' ]], // sort by "Category Name" (index 2)
    pageLength: 100,
  };

  let table = $('.datatable-CatalogueCategory').DataTable(dtOverrideGlobals);

  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
  });
});
</script>
@endsection
