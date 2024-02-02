@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            Non-Assigned Items
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NFC Serial Number</th>
                            <th>Item Name</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nonAssignedItems as $item)
                            <tr>
                                <td>{{ $item->item_id }}</td>
                                <td>{{ $item->nfc_serial_number }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <form action="{{ route('admin.assign_worker.assignItem', $item->nfc_serial_number) }}" method="POST">
                                        @csrf
                                        
                                        <select name="worker_id" id="worker_id" required>
                                            
                                        </select>
                                        <button type="submit" class="btn btn-success">Assign to Worker</button>
                                    </form>
                                    
                                    {{-- <form action="{{ route('admin.assign_worker.assignItem', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Assign to Worker</button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    // Add this script to handle Ajax and load workers dynamically
    $(document).ready(function () {
        $('#assignForm').submit(function (e) {
            e.preventDefault();

            // Get selected NFC serial number
            var nfcSerialNumber = "{{ $item->nfc_serial_number }}";

            // Get selected worker ID
            var workerId = $('#worker_id').val();

            
        });

    
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.workers.getWorkers') }}", // Use the updated route
                success: function (workers) {
                    // Populate the workers dropdown
                    workers.forEach(function (worker) {
                        $('#worker_id').append('<option value="' + worker.id + '">' + worker.name + '</option>');
                    });
                },
                error: function (error) {
                    // Handle error
                    console.log(error);
                }
            });
    });
</script>