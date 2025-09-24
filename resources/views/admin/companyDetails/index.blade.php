@extends('layouts.admin')
@section('content')

@php
    // Hide the Create button if a record already exists
    $companyCount = \App\Models\CompanyDetail::count();
@endphp

@can('company_detail_create')
    @if ($companyCount === 0)
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.company-details.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.companyDetail.title_singular') }}
                </a>
            </div>
        </div>
    @endif
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.companyDetail.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">

        {{-- Readability + details styles --}}
        <style>
            .details-toggle {
                cursor: pointer;
                padding: .25rem .5rem;
                border: 1px solid rgba(0,0,0,.12);
                border-radius: .4rem;
                background: #f8f9fa;
                font-size: .8125rem;
            }
            .details-toggle:hover { background: #eef1f4; }
            .details-pane {
                background: #f8f9fa;
                border-radius: .5rem;
                padding: 1rem 1rem;
                border: 1px solid rgba(0,0,0,.06);
            }
            .details-pane .label {
                color: #6c757d; /* bootstrap secondary */
                min-width: 180px;
                display: inline-block;
            }
            .text-prewrap { white-space: pre-wrap; }
            .nowrap { white-space: nowrap; }
            .link-pill {
                display: inline-block;
                padding: .2rem .5rem;
                border: 1px solid rgba(0,0,0,.1);
                border-radius: .4rem;
                background: #fff;
                font-size: .8125rem;
                text-decoration: none;
                margin-right: .25rem;
                margin-bottom: .25rem;
            }
            .link-pill:hover { background: #eef1f4; text-decoration: none; }
        </style>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-CompanyDetail w-100">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th></th> {{-- Details toggle --}}
                        <th>{{ trans('cruds.companyDetail.fields.company_name') }}</th>
                        <th>{{ trans('cruds.companyDetail.fields.gst_number') }}</th>
                        <th>{{ trans('cruds.companyDetail.fields.company_phone_number') }}</th>
                        <th>{{ trans('cruds.companyDetail.fields.email') }}</th>
                        <th>&nbsp;</th> {{-- actions --}}
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script>
$(function () {

  // Small helpers
  function esc (s) { return $('<div>').text(s == null ? '' : s).html(); }
  function telLink(p) { return p ? `<a href="tel:${esc(p)}" class="nowrap">${esc(p)}</a>` : ''; }
  function mailLink(m){ return m ? `<a href="mailto:${esc(m)}">${esc(m)}</a>` : ''; }
  function linkPill(u, label){
      if(!u) return '';
      const safe = esc(u);
      return `<a href="${safe}" target="_blank" rel="noopener" class="link-pill">${label ? esc(label) : safe}</a>`;
  }

  // Build vertical “details” panel HTML
  function formatDetails(row) {
      const parts = [];

      // Phones
      const phones = [row.company_phone_number, row.other_phone_number].filter(Boolean).map(telLink).join(' &nbsp; ');
      // Emails
      const emails = [row.email, row.other_email].filter(Boolean).map(mailLink).join('<br>');

      // Social link pills
      const socials = [
          { val: row.company_facebook_link,  label: 'Facebook'  },
          { val: row.comapnay_instagram_link, label: 'Instagram' },
          { val: row.company_linkedin_link,  label: 'LinkedIn'  },
          { val: row.company_youtube_link,   label: 'YouTube'   },
          { val: row.company_x_link,         label: 'X / Twitter' }
      ].filter(x => !!x.val).map(x => linkPill(x.val, x.label)).join('');

      // Map link
      const mapLink = row.google_map_link ? linkPill(row.google_map_link, 'Google Maps') : '';

      parts.push(`
        <div class="details-pane">
          <div class="mb-2"><span class="label">Company Name:</span> <strong>${esc(row.company_name || '')}</strong></div>
          <div class="mb-2"><span class="label">GST Number:</span> ${esc(row.gst_number || '-')}</div>
          <div class="mb-2"><span class="label">Phone(s):</span> ${phones || '-'}</div>
          <div class="mb-2"><span class="label">Email(s):</span><div>${emails || '-'}</div></div>
          <div class="mb-2"><span class="label">Office Address:</span>
            <div class="text-prewrap">${esc(row.office_address || '-')}</div>
          </div>
          <div class="mb-2"><span class="label">Map:</span> ${mapLink || '-'}</div>
          <div class="mb-1"><span class="label">Socials:</span> ${socials || '-'}</div>
        </div>
      `);

      return parts.join('');
  }

  // Keep default buttons; no mass delete button added here
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);

  let table = $('.datatable-CompanyDetail').DataTable({
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.company-details.index') }}",
    // We still request all fields from the server so we can use them in the details pane,
    // but we only *display* a few columns in the main row.
    columns: [
      { data: 'placeholder', name: 'placeholder', orderable: false, searchable: false }, // 0
      {
        data: null,
        orderable: false,
        searchable: false,
        className: 'details-control',
        render: function() {
          return '<button type="button" class="details-toggle" aria-expanded="false">Details ▾</button>';
        }
      },                                                                                // 1 (toggle)
      { data: 'company_name', name: 'company_name' },                                   // 2
      { data: 'gst_number', name: 'gst_number' },                                       // 3
      { data: 'company_phone_number', name: 'company_phone_number', render: telLink },  // 4
      { data: 'email', name: 'email', render: mailLink },                               // 5
      { data: 'actions', name: '{{ trans('global.actions') }}', orderable: false, searchable: false } // 6
    ],
    // BUT we still need the extra fields in the row object.
    // Datatables sends them if the server includes them in JSON. Make sure your
    // DataTables server (controller) includes all the fields used below:
    // other_phone_number, other_email, office_address, google_map_link,
    // company_facebook_link, comapnay_instagram_link, company_linkedin_link,
    // company_youtube_link, company_x_link.
    orderCellsTop: true,
    order: [[ 2, 'asc' ]],
    pageLength: 25
  });

  // Toggle details pane
  $('.datatable-CompanyDetail tbody').on('click', 'td.details-control .details-toggle', function () {
      const btn = $(this);
      const tr = btn.closest('tr');
      const row = table.row(tr);

      if (row.child.isShown()) {
          // Close
          row.child.hide();
          btn.attr('aria-expanded', 'false').html('Details ▾');
          tr.removeClass('shown');
      } else {
          // Open
          row.child(formatDetails(row.data())).show();
          btn.attr('aria-expanded', 'true').html('Details ▴');
          tr.addClass('shown');
      }
  });

  // Ensure only View/Edit remain (no Delete)
  $('.datatable-CompanyDetail').on('draw.dt', function () {
    $(this).find('.btn-danger').remove();
    $(this).find('form:has(input[name="_method"][value="DELETE"])').remove();
  });

  // Keep columns tidy when switching tabs
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(){
      $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
  });
});
</script>
@endsection
