{{-- resources/views/admin/coreServices/index.blade.php --}}
@extends('layouts.admin')

@php
    // Safely resolve route names (with/without "admin." prefix). Fallback to URL strings if not registered.
    $indexName       = \Route::has('core-services.index') ? 'core-services.index' : (\Route::has('admin.core-services.index') ? 'admin.core-services.index' : null);
    $createName      = \Route::has('core-services.create') ? 'core-services.create' : (\Route::has('admin.core-services.create') ? 'admin.core-services.create' : null);
    $massDestroyName = \Route::has('core-services.massDestroy') ? 'core-services.massDestroy' : (\Route::has('admin.core-services.massDestroy') ? 'admin.core-services.massDestroy' : null);
    $storeMediaName  = \Route::has('core-services.storeMedia') ? 'core-services.storeMedia' : (\Route::has('admin.core-services.storeMedia') ? 'admin.core-services.storeMedia' : null);
    $storeCKName     = \Route::has('core-services.storeCKEditorImages') ? 'core-services.storeCKEditorImages' : (\Route::has('admin.core-services.storeCKEditorImages') ? 'admin.core-services.storeCKEditorImages' : null);

    // Build final URLs, even if named route is missing
    $indexUrl       = $indexName       ? route($indexName)       : url('/admin/core-services');
    $createUrl      = $createName      ? route($createName)      : url('/admin/core-services/create');
    $massDestroyUrl = $massDestroyName ? route($massDestroyName) : url('/admin/core-services/destroy');
    $storeMediaUrl  = $storeMediaName  ? route($storeMediaName)  : url('/admin/core-services/media');
    $storeCKUrl     = $storeCKName     ? route($storeCKName)     : url('/admin/core-services/ckmedia');
@endphp

@section('content')
@can('core_service_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <button type="button" class="btn btn-brand" id="btnCoreServiceCreate">
                {{ trans('global.add') }} {{ trans('cruds.coreService.title_singular') }}
            </button>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.coreService.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-CoreService">
            <thead>
                <tr>
                    <th width="10"></th>
                    <th>{{ trans('cruds.coreService.fields.id') }}</th>
                    <th>{{ trans('cruds.coreService.fields.service_name') }}</th>
                    <th>{{ __('Image') }}</th>
                    <th>{{ trans('cruds.coreService.fields.brochure') }}</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="coreServiceModal" tabindex="-1" role="dialog" aria-labelledby="coreServiceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="coreServiceModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-3">
        <div class="text-center text-muted py-4" id="cs-modal-loading" style="display:none;">Loading…</div>
        <div id="cs-modal-body"></div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@parent

<script>
  // Expose URLs to JS
  window.csRoutes = {
    index:       @json($indexUrl),
    create:      @json($createUrl),
    massDestroy: @json($massDestroyUrl),
    storeMedia:  @json($storeMediaUrl),
    storeCK:     @json($storeCKUrl),
  };
</script>

<script>
$(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('core_service_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: window.csRoutes.massDestroy,
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) { return entry.id });

      if (ids.length === 0) { alert('{{ trans('global.datatables.zero_selected') }}'); return; }

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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: window.csRoutes.index,
    columns: [
      { data: 'placeholder', name: 'placeholder' },
      { data: 'id', name: 'id' },
      { data: 'service_name', name: 'service_name' },
      { data: 'image', name: 'image', sortable: false, searchable: false },
      { data: 'brochure', name: 'brochure', sortable: false, searchable: false },
      { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };

  let table = $('.datatable-CoreService').DataTable(dtOverrideGlobals);

  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
  });

  // ===== Modal + AJAX form handling =====
  var $modal   = $('#coreServiceModal');
  var $body    = $('#cs-modal-body');
  var $loading = $('#cs-modal-loading');

  // CREATE → open modal
  $('#btnCoreServiceCreate').on('click', function() {
    openCoreServiceModal(
      "{{ trans('global.create') }} {{ trans('cruds.coreService.title_singular') }}",
      window.csRoutes.create
    );
  });

  // EDIT → intercept edit link from actions column
  $(document).on('click', '.datatable-CoreService a[href*="/core-services/"][href$="/edit"]', function(e) {
    e.preventDefault();
    openCoreServiceModal(
      "{{ trans('global.edit') }} {{ trans('cruds.coreService.title_singular') }}",
      $(this).attr('href')
    );
  });

  function openCoreServiceModal(title, url) {
    $('#coreServiceModalLabel').text(title);
    $body.empty(); $loading.show(); $modal.modal('show');

    $.ajax({
      url: url,
      method: 'GET',
      headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'text/html, */*' }
    })
    .done(function (html) {
      $loading.hide();
      $body.html(html);
      // Provide endpoints to the partial (if it needs them)
      window.__coreServiceModalConfig = window.__coreServiceModalConfig || {};
      window.__coreServiceModalConfig.storeMediaUrl = window.csRoutes.storeMedia;
      window.__coreServiceModalConfig.ckUploadUrl   = window.csRoutes.storeCK;

      initEditorsAndDropzones();
      bindAjaxSubmit();
    })
    .fail(function (xhr) {
      $loading.hide();
      // Show real reason
      var detail = 'Status: ' + xhr.status + ' ' + xhr.statusText;
      var resp = xhr.responseText ? ('<pre class="small text-wrap" style="white-space:pre-wrap;max-height:200px;overflow:auto;">'+$('<div>').text(xhr.responseText).html()+'</pre>') : '';
      $body.html('<div class="alert alert-danger">Failed to load form.<br>'+ detail +'</div>'+ resp);
      console.error('Load form failed', {url, status:xhr.status, statusText:xhr.statusText, response:xhr.responseText});
    });

    $modal.off('hidden.bs.modal').on('hidden.bs.modal', function() {
      cleanupEditorsAndDropzones();
      $body.empty();
    });
  }

  // ===== CKEditor + Dropzone lifecycle (same as before) =====
  var ckInstances = [];

  function initEditorsAndDropzones() {
    ckInstances = [];
    $('#coreServiceForm .ckeditor').each(function(){
      var ta = this;
      ClassicEditor.create(ta, { extraPlugins: [SimpleUploadAdapter] })
        .then(function(inst){ ckInstances.push(inst); });
    });

    function SimpleUploadAdapter(editor) {
      editor.plugins.get('FileRepository').createUploadAdapter = function (loader) {
        return {
          upload: function () {
            return loader.file.then(function(file) {
              return new Promise(function(resolve, reject) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', window.__coreServiceModalConfig.ckUploadUrl, true);
                xhr.setRequestHeader('x-csrf-token', window.__coreServiceModalConfig.csrf || "{{ csrf_token() }}");
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;
                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }
                  $('#coreServiceForm').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');
                  resolve({ default: response.url });
                });

                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', window.__coreServiceModalConfig.crudId || 0);
                xhr.send(data);
              });
            })
          }
        }
      }
    }

    if (Dropzone.instances && Dropzone.instances.length) {
      Dropzone.instances.forEach(function(dz){ dz.destroy(); });
    }

    new Dropzone('#image-dropzone', {
      url: window.__coreServiceModalConfig.storeMediaUrl,
      maxFilesize: 10,
      acceptedFiles: 'image/*',
      maxFiles: 1,
      addRemoveLinks: true,
      headers: { 'X-CSRF-TOKEN': window.__coreServiceModalConfig.csrf || "{{ csrf_token() }}" },
      params: { size: 10 },
      success: function (file, response) {
        $('#coreServiceForm').find('input[name="image"]').remove();
        $('#coreServiceForm').append('<input type="hidden" name="image" value="' + response.name + '">');
      },
      removedfile: function (file) {
        if (file.previewElement) file.previewElement.remove();
        $('#coreServiceForm').find('input[name="image"]').remove();
        this.options.maxFiles = this.options.maxFiles + 1;
      }
    });

    new Dropzone('#brochure-dropzone', {
      url: window.__coreServiceModalConfig.storeMediaUrl,
      maxFilesize: 100,
      maxFiles: 1,
      addRemoveLinks: true,
      headers: { 'X-CSRF-TOKEN': window.__coreServiceModalConfig.csrf || "{{ csrf_token() }}" },
      params: { size: 100 },
      success: function (file, response) {
        $('#coreServiceForm').find('input[name="brochure"]').remove();
        $('#coreServiceForm').append('<input type="hidden" name="brochure" value="' + response.name + '">');
      },
      removedfile: function (file) {
        if (file.previewElement) file.previewElement.remove();
        $('#coreServiceForm').find('input[name="brochure"]').remove();
        this.options.maxFiles = this.options.maxFiles + 1;
      }
    });
  }

  function cleanupEditorsAndDropzones() {
    ckInstances.forEach(function(inst){ inst && inst.destroy && inst.destroy(); });
    ckInstances = [];
    if (Dropzone.instances && Dropzone.instances.length) {
      Dropzone.instances.forEach(function(dz){ dz.destroy(); });
    }
  }

  function bindAjaxSubmit() {
    $(document).off('submit', '#coreServiceForm').on('submit', '#coreServiceForm', function(e) {
      e.preventDefault();

      ckInstances.forEach(function(inst){
        var el = inst.sourceElement;
        if (el && el.id) $('#' + el.id).val(inst.getData());
      });

      var $form = $(this);
      var action = $form.attr('action');
      var method = $form.find('input[name="_method"]').val() || 'POST';
      var fd = new FormData(this);

      $form.find('.is-invalid').removeClass('is-invalid');
      $form.find('[data-error-for]').addClass('d-none').text('');

      $.ajax({
        url: action,
        type: method,
        data: fd,
        processData: false,
        contentType: false,
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        success: function() {
          $('#coreServiceModal').modal('hide');
          table.ajax.reload(null, false);
        },
        error: function(xhr) {
          if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
            var errs = xhr.responseJSON.errors;
            Object.keys(errs).forEach(function(name){
              var msg = errs[name][0];
              var $field = $form.find('[name="'+name+'"]');
              $field.addClass('is-invalid');
              $form.find('[data-error-for="'+name+'"]').removeClass('d-none').text(msg);
            });
            return;
          }

          let msg = 'Something went wrong. Please try again.';
          if (xhr.status === 419) msg = 'Session expired or CSRF mismatch. Refresh and try again.';
          else if (xhr.status === 403) msg = 'Forbidden (403). Check your permissions.';
          else if (xhr.status === 500 && xhr.responseJSON && xhr.responseJSON.error) msg = xhr.responseJSON.error;
          else if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;

          console.error('Create/Update failed', { status: xhr.status, response: xhr.responseText });
          alert(msg);
        }
      });
    });
  }
});
</script>
@endsection
