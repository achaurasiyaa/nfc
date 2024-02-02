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

        table {
            width: 80%;
            margin: 50px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            text-align: left; /* Align content to the left */
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        .highlight {
            color: #e74c3c;
            font-weight: bold;
        }
    </style>
</head>
<body>

<table>
    <tr>
        <th colspan="2">NFC Item Details</th>
    </tr>
    <tr>
        <td>NFC Serial Number</td>
        <td>{{ $nfcItem->nfc_serial_number }}</td>
    </tr>
    <tr>
        <td>Item ID</td>
        <td>{{ $nfcItem->item_id }}</td>
    </tr>
    <tr>
        <td>Item Name</td>
        <td>{{ $nfcItem->item->name }}</td>
    </tr>
    <tr>
        <td>Item Supplier</td>
        <td>{{ $nfcItem->item->supplier_name }}</td>
    </tr>
    {{-- <tr>
        <td>Worker Name</td>
        <td>{{ $worker->name }}</td>
    </tr>
    <tr>
        <td>worker Gate Pass Number</td>
        <td>{{ $worker->gate_pass_number }}</td>
    </tr>
    <tr>
        <td>Age</td>
        <td>{{ $nfcItem->item->ageing_in_days }}</td>
    </tr>
    <tr>
        <td>Ageing in Days</td>
        <td>33</td>
    </tr> --}}
</table>

<p class="highlight">This NFC is mapped with the item "{{ $nfcItem->item->name }}" (Item ID: {{ $nfcItem->item_id }}).</p>

</body>
</html>
