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
                            <th>Search Worker</th>
                            <th>Action</th>
                            <th>ffff    </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nonAssignedItems as $item)
                            <tr>
                                <td>{{ $item->item_id }}</td>
                                <td>{{ $item->nfc_serial_number }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <input type="text" class="searchWorkerInput" data-item-id="{{ $item->item_id }}" placeholder="Enter Gate Pass Number">
                                    <button class="searchWorkerBtn" data-item-id="{{ $item->item_id }}">Search</button>
                                </td>
                                <td class="selectedWorkerInfo" id="selectedWorkerInfo_{{ $item->item_id }}"></td>
                                <td>
                                    <button class="assignWorkerBtn" data-item-id="{{ $item->item_id }}" style="display:none;">Assign Worker</button>
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
    $(document).ready(function () {
        // On click event for search button
        $('.searchWorkerBtn').on('click', function () {
            var gatePassNumber = $(this).prev('.searchWorkerInput').val();
            var itemId = $(this).data('item-id');

            // Make Ajax request to get worker details by gate pass number
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.workers.getWorkerDetailsByGatePassNumber') }}",
                data: {
                    gate_pass_number: gatePassNumber
                },
                success: function (workerDetails) {
                    // Display worker details in the selectedWorkerInfo <td>
                        console.log(itemId)
                        console.log(workerDetails)
                        console.log('Name:', workerDetails.name);
console.log('Gate Pass Number:', workerDetails.gate_pass_number);

                    $('#selectedWorkerInfo_' + itemId).text('Name: ' + workerDetails.name + ', Gate Pass Number: ' + workerDetails.gate_pass_number);
                },
                error: function (error) {
                    // Handle error
                    console.log(error);
                }
            });
        });

        // ... rest of your JavaScript code ...

    });
</script>
