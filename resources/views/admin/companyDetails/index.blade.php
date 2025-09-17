@extends('layouts.admin')
@section('content')
@can('company_detail_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.company-details.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.companyDetail.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.companyDetail.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-CompanyDetail">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.companyDetail.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.companyDetail.fields.company_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.companyDetail.fields.gst_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.companyDetail.fields.company_phone_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.companyDetail.fields.other_phone_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.companyDetail.fields.google_map_link') }}
                    </th>
                    <th>
                        {{ trans('cruds.companyDetail.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.companyDetail.fields.other_email') }}
                    </th>
                    <th>
                        {{ trans('cruds.companyDetail.fields.office_address') }}
                    </th>
                    <th>
                        {{ trans('cruds.companyDetail.fields.company_facebook_link') }}
                    </th>
                    <th>
                        {{ trans('cruds.companyDetail.fields.comapnay_instagram_link') }}
                    </th>
                    <th>
                        {{ trans('cruds.companyDetail.fields.company_linkedin_link') }}
                    </th>
                    <th>
                        {{ trans('cruds.companyDetail.fields.company_youtube_link') }}
                    </th>
                    <th>
                        {{ trans('cruds.companyDetail.fields.company_x_link') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('company_detail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.company-details.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.company-details.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'company_name', name: 'company_name' },
{ data: 'gst_number', name: 'gst_number' },
{ data: 'company_phone_number', name: 'company_phone_number' },
{ data: 'other_phone_number', name: 'other_phone_number' },
{ data: 'google_map_link', name: 'google_map_link' },
{ data: 'email', name: 'email' },
{ data: 'other_email', name: 'other_email' },
{ data: 'office_address', name: 'office_address' },
{ data: 'company_facebook_link', name: 'company_facebook_link' },
{ data: 'comapnay_instagram_link', name: 'comapnay_instagram_link' },
{ data: 'company_linkedin_link', name: 'company_linkedin_link' },
{ data: 'company_youtube_link', name: 'company_youtube_link' },
{ data: 'company_x_link', name: 'company_x_link' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-CompanyDetail').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection