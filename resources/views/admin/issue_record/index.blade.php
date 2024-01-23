@extends('layouts.admin')

@section('content')
@can('issue_record_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.issue_record.create") }}">
                bbbb
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        Issue Record
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Item">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>Worker Name</th>
                        <th>Vendor Name</th>
                        <th>NFC Tag ID</th>
                        <th>Item Name</th>
                        <th>Issue Date</th>
                        <th>Is Expired</th>
                        <th>Expire Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($formattedIssueRecords as $key => $record)
                        <tr data-entry-id="{{ $key + 1 }}">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $record['worker_name'] }}</td>
                            <td>{{ $record['vendor_name'] }}</td>
                            <td>{{ $record['nfc_tag_id'] }}</td>
                            <td>{{ $record['item_name'] }}</td>
                            <td>{{ $record['issue_date'] }}</td>
                            <td>{{ $record['is_expired'] ? 'Yes' : 'No' }}</td>
                            <td>{{ $record['expire_date'] ?? 'Not specified' }}</td>
                            <td>
                                {{-- Add action buttons (view, edit, delete) here if needed --}}
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
        // Your existing script for DataTables
    });
</script>
@endsection