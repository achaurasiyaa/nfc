<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign NFC Item</title>
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
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #3498db;
        }

        .success {
            color: #2ecc71;
            font-weight: bold;
        }

        .error {
            color: #e74c3c;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Assign NFC Item to Worker</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <form action="{{ route('issue.assignToWorker', $nfc_serial_number) }}" method="post">
        @csrf
        <button type="submit">Assign NFC Item</button>
    </form>
</div>

</body>
</html>
