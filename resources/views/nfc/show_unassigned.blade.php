<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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

        .assign-button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-transform: uppercase;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Centering the table */
        .table-container {
            text-align: center;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>NFC Item Details</h1>
    <div class="table-container">
        <table>
            <tr>
                <th>Attribute</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>NFC Serial Number:</td>
                <td>{{ $nfcItem->nfc_serial_number }}</td>
            </tr>
        </table>
    </div>

    <form id="assignWorkerForm" action="{{ route('assign.worker', ['nfc_serial_number' => $nfcItem->nfc_serial_number]) }}" method="GET">
        @csrf
        <br>
        <label for="search">Search Gate:</label>
        <input type="text" id="search" name="search" placeholder="Search Gate Pass Number">
        <button class="assign-button" type="submit">Assign Worker</button>
    </form>

</div>
</body>
</html>
