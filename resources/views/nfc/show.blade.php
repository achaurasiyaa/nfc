{{-- @extends('layouts.admin')
@section('content') --}}

{{-- <h1>NFC Item Details</h1>
<p>NFC Serial Number: {{ $nfcItem->nfc_serial_number }}</p>
<p>Item ID: {{ $nfcItem->item_id }}</p>
<p>Item Name: {{ $nfcItem->item->name }}</p>
<p>Item supplier: {{ $nfcItem->item->supplier_name }}</p>
<p>age: {{$nfcItem->item->ageing_in_days}}</p>

<p>Ageing in Days: 33</p> --}}


{{-- @endsection --}}



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NFC Item Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            /* background-color: #fff; */
            background-color: #fff7b2;
            padding: 20px;
            /* border-radius: 8px; */
            border-radius: 96px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #3498db;
        }

        p {
            margin-bottom: 10px;
        }

        .highlight {
            color: #e74c3c;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>NFC Liked Item Details</h1>
    <p>NFC Serial Number: {{ $nfcItem->nfc_serial_number }}</p>
    <p>NFC Id: {{ $nfcItem->id }}</p>
    <p>Item ID: {{ $nfcItem->item_id }}</p>
    <p>Item Name: {{ $nfcItem->item->name }}</p>
    <p>Worker name: {{ $worker->name }}</p>
    <p>Worker Gate Pass Number: {{ $worker->gate_pass_number }}</p>
    <p>Vendor Name: {{ $vendor->name }}</p>
    <p>Item Supplier: {{ $nfcItem->item->supplier_name }}</p>
    <p>Ageing in Month: {{ $nfcItem->item->ageing_in_days }}</p>
    

    <p class="highlight">This NFC is mapped with the item "{{ $nfcItem->item->name }}" (Item ID: {{ $nfcItem->item_id }}).</p>
</div>

</body>
</html>
