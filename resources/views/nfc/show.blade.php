<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NFC Item Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #3498db;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td {
            background-color: #ffffff;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>NFC Item Details</h1>
    <table>
        <tr>
            <th>Attribute</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>NFC Serial Number:</td>
            <td>{{ $nfcItem->nfc_serial_number }}</td>
        </tr>
        @if ($worker)
            <tr>
                <td>Worker Name:</td>
                <td>{{ $worker->name }}</td>
            </tr>
            <tr>
                <td>Issue Date:</td>
                <td>{{ $issueRecord->issue_date }}</td>
            </tr>
            <tr>
                <td>Expiry Date:</td>
                <td>{{ $issueRecord->expiry_date }}</td>
            </tr>
        @endif
    </table>
</div>
<script>
    var gatePassNumbers = @json($gatePassNumbers);
    document.getElementById('worker_id').value = gatePassNumbers.join(', ');
</script>

</body>
</html>
