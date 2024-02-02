@extends('layouts.admin')
@section('content')
{{-- @can('worker_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-6">
            <a class="btn btn-success" href="{{ route("admin.worker.create") }}">
               Worker Add
            </a>
        </div>
        <div class="col-lg-6">
            <a class="btn btn-success" href="{{ route("admin.worker.create") }}">
               Bulk Worker Add
            </a>
        </div>
    </div>
@endcan --}}

@can('worker_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-4">
            <a class="btn btn-success" href="{{ route("admin.worker.create") }}">
               Worker Add
            </a>
        </div>
        <div class="col-lg-4">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#bulkUploadModal">
               Bulk Worker Add
            </button>
        </div>
        <div class="col-lg-4">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#downloadCsvTemplate">
                Download Csv Template
            </button>
        </div>
    </div>
@endcan
<div class="row mb-3">
    <div class="col-lg-8">
        <form action="{{ route('admin.worker.index') }}" method="get" class="form-inline">
            <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Search by name or gate pass number">
            </div>
            <button type="submit" class="btn btn-primary ml-2">Search</button>
            <a href="{{ route('admin.worker.index') }}" class="btn btn-secondary ml-2">Clear</a>
        </form>
    </div>
    <div class="col-lg-4">
        <!-- Add a button to trigger bulk worker upload modal -->
        {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#bulkUploadModal">
            Bulk Worker Add
        </button> --}}
    </div>
</div>
<div class="card">
    <div class="card-header">
        Worker
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Item">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Id
                        </th>
                        <th>
                            Worker Name
                        </th>
                        
                        <th>
                            Get Pass Number
                        </th>
                        <th>
                            Vendor ID
                        </th>
                       
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($workers as $key => $item)
                        <tr data-entry-id="{{ $item->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $item->id ?? '' }}
                            </td>
                            <td>
                                {{ $item->name ?? '' }}
                            </td>
                            <td>
                                {{ $item->gate_pass_number  ?? '' }}
                            </td>
                            <td>
                                {{ $item->vendor_id ?? '' }}
                            </td>
                           
                            <td>
                                @can('worker_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.worker.show', $item->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('worker_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.worker.edit', $item->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('worker_delete')
                                    <form action="{{ route('admin.worker.destroy', $item->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
                        <!-- Add pagination links and current page number -->
                        <div class="d-flex justify-content-center">
                            {{ $workers->links('pagination::bootstrap-4') }}
                        </div>
                <p class="text-center">Displaying workers on page {{ $workers->currentPage() }}</p>
                

    </div>
</div>

<div class="modal fade" id="bulkUploadModal" tabindex="-1" role="dialog" aria-labelledby="bulkUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulkUploadModalLabel">Bulk Worker Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.worker.bulkUpload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="csv_file">CSV File:</label>
                        <input type="file" name="file" accept=".csv" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="downloadCsvTemplate" tabindex="-1" role="dialog" aria-labelledby="downloadCsvTemplateLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="downloadCsvTemplateLabel">Download CSV Template</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Click the button below to download the CSV template:</p>
                <a href="{{ route('admin.download.csv.template') }}" class="btn btn-primary">Download CSV Template</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('worker_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.worker.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-worker:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
