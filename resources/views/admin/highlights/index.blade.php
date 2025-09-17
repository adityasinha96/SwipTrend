@extends('layouts.admin')
@section('content')
@can('highlight_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            {{-- Add button opens modal --}}
            <button id="btnAddHighlight"
                    class="btn btn-success"
                    data-url="{{ route('admin.highlights.create') }}"
                    {{ ($currentCount ?? 0) >= 4 ? 'disabled' : '' }}>
                {{ trans('global.add') }} {{ trans('cruds.highlight.title_singular') }}
            </button>

            @if(($currentCount ?? 0) >= 4)
                <small id="maxHighlightsHint" class="text-danger ml-2 align-middle">Max 4 highlights reached.</small>
            @else
                <small id="maxHighlightsHint" class="text-danger ml-2 align-middle" style="display:none;">Max 4 highlights reached.</small>
            @endif
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.highlight.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Highlight">
            <thead>
                <tr>
                    <th width="10"></th>
                    <th>{{ trans('cruds.highlight.fields.id') }}</th>
                    <th>{{ trans('cruds.highlight.fields.service_name') }}</th>
                    <th>{{ trans('cruds.highlight.fields.service_description') }}</th>
                    <th>{{ trans('cruds.highlight.fields.image') }}</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="highlightModal" tabindex="-1" role="dialog" aria-labelledby="highlightModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="highlightModalLabel">Highlight</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-3" id="highlightModalBody">
        {{-- loaded via AJAX --}}
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@parent
<script>
$(function () {
  // ---------------------------------------------------------
  // DataTable
  // ---------------------------------------------------------
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  @can('highlight_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
      text: deleteButtonTrans,
      url: "{{ route('admin.highlights.massDestroy') }}",
      className: 'btn-danger',
      action: function (e, dt, node, config) {
          let ids = $.map(dt.rows({ selected: true }).data(), entry => entry.id);
          if (!ids.length) { alert('{{ trans('global.datatables.zero_selected') }}'); return; }
          if (confirm('{{ trans('global.areYouSure') }}')) {
              $.ajax({ headers: {'x-csrf-token': _token}, method: 'POST', url: config.url, data: { ids: ids, _method: 'DELETE' }})
                .done(function () { dt.ajax.reload(null, false); })
                .always(function () { updateAddButtonStateFromTable(); });
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
    ajax: "{{ route('admin.highlights.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
      { data: 'id', name: 'id' },
      { data: 'service_name', name: 'service_name' },
      { data: 'service_description', name: 'service_description' },
      { data: 'image', name: 'image', sortable: false, searchable: false },
      { data: 'actions', name: '{{ trans('global.actions') }}', sortable: false, searchable: false }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Highlight').DataTable(dtOverrideGlobals);

  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(){
      $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
  });

  table.on('xhr.dt draw.dt', function () {
      updateAddButtonStateFromTable();
  });

  // ---------------------------------------------------------
  // Modal + AJAX form load/submit
  // ---------------------------------------------------------
  const $btnAdd = $('#btnAddHighlight');
  const $hint = $('#maxHighlightsHint');

  function openModalWith(url, title) {
      $('#highlightModalLabel').text(title || 'Highlight');
      $('#highlightModalBody').html('<div class="p-4 text-center">Loading...</div>');
      $('#highlightModal').modal('show');
      $.get(url, function (html) {
          $('#highlightModalBody').html(html);
          setupHighlightDropzone(); // init Dropzone on injected form (with existing image for edit)
      }).fail(function () {
          $('#highlightModalBody').html('<div class="alert alert-danger">Failed to load form.</div>');
      });
  }

  // Add
  $btnAdd.on('click', function () {
      if ($btnAdd.is(':disabled')) {
          alert("Can't add more than 4 highlights.");
          return;
      }
      openModalWith($(this).data('url'), 'Add Highlight');
  });

  // Intercept "Edit" links from action column and open in modal
  $(document).on('click', '.btn.btn-xs.btn-info', function (e) {
      e.preventDefault();
      const url = $(this).attr('href');
      openModalWith(url, 'Edit Highlight');
  });

  // Delegate AJAX submit for the loaded form
  $(document).on('submit', '#highlightForm', function (e) {
      e.preventDefault();
      const form = this;
      const action = $(form).attr('action');
      const formData = new FormData(form);

      $.ajax({
          url: action,
          // IMPORTANT: always POST, rely on hidden _method=PUT for edits
          method: 'POST',
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
          data: formData,
          processData: false,
          contentType: false,
          success: function () {
              $('#highlightModal').modal('hide');
              table.ajax.reload(null, false);
          },
          error: function (xhr) {
              let msg = 'Something went wrong.';
              if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.message) {
                  msg = xhr.responseJSON.message;
              } else if (xhr.status === 419) {
                  msg = 'Session expired. Please refresh the page.';
              }
              alert(msg);
          },
          complete: function () {
              setTimeout(updateAddButtonStateFromTable, 250);
          }
      });
  });

  // Reset modal body when closed
  $('#highlightModal').on('hidden.bs.modal', function () {
      $('#highlightModalBody').html('');
  });

  // ---------------------------------------------------------
  // Dropzone (init after form is injected) + preload existing
  // ---------------------------------------------------------
  function setupHighlightDropzone() {
      if (typeof Dropzone === 'undefined') {
          console.error('Dropzone not loaded on this page.');
          return;
      }
      Dropzone.autoDiscover = false;

      const el = document.getElementById('image-dropzone');
      if (!el) return;

      // Destroy previous instance if any
      if (el.dropzone) { try { el.dropzone.destroy(); } catch (e) {} }

      const dz = new Dropzone(el, {
          url: "{{ route('admin.highlights.storeMedia') }}",
          paramName: 'file',
          maxFilesize: 10, // MB
          acceptedFiles: '.jpeg,.jpg,.png,.gif',
          maxFiles: 1,
          addRemoveLinks: true,
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          params: { size: 10, width: 4096, height: 4096 },
          success: function (file, response) {
              $('#highlightForm').find('input[name="image"]').remove();
              $('#highlightForm').append('<input type="hidden" name="image" value="'+ response.name +'">');
          },
          removedfile: function (file) {
              if (file.previewElement) file.previewElement.remove();
              $('#highlightForm').find('input[name="image"]').remove();
              dz.options.maxFiles = 1;
          },
          error: function (file, response) {
              const message = $.type(response) === 'string' ? response : (response.errors?.file || 'Upload error');
              if (file.previewElement) {
                  file.previewElement.classList.add('dz-error');
                  const nodes = file.previewElement.querySelectorAll('[data-dz-errormessage]') || [];
                  nodes.forEach(n => n.textContent = message);
              }
          }
      });

      // ---- Preload existing file for EDIT ----
      // The form partial sets data-existing on #image-dropzone with: {file_name, preview, size}
      let existing = null;
      try {
          const raw = el.getAttribute('data-existing');
          existing = raw ? JSON.parse(raw) : null;
      } catch (e) { existing = null; }

      if (existing && existing.file_name && existing.preview) {
          const mockFile = { name: existing.file_name, size: existing.size || 12345 };
          dz.emit('addedfile', mockFile);
          dz.emit('thumbnail', mockFile, existing.preview);
          dz.emit('complete', mockFile);
          // Keep current image if user doesn’t upload a new one
          $('#highlightForm').find('input[name="image"]').remove();
          $('#highlightForm').append('<input type="hidden" name="image" value="'+ existing.file_name +'">');
          dz.options.maxFiles = dz.options.maxFiles - 1;
      }
  }

  // ---------------------------------------------------------
  // Helpers
  // ---------------------------------------------------------
  function updateAddButtonStateFromTable() {
      try {
          const info = table.page.info();
          const total = info ? info.recordsTotal : table.rows().count();
          const limitReached = (total >= 4);

          $btnAdd.prop('disabled', limitReached);
          if ($hint.length) { limitReached ? $hint.show() : $hint.hide(); }
      } catch (e) {}
  }

  // Initial state check
  updateAddButtonStateFromTable();
});
</script>
@endsection
