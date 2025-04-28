<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriSmart</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            background-color: #e8f5e9; /* lebih soft hijau */
        }

        .navbar {
            background: linear-gradient(to right, #388e3c, #66bb6a);
            padding: 15px 30px;
            color: white;
            font-size: 22px;
            font-weight: bold;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .btn-green {
            background-color: #43a047;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-green:hover {
            background-color: #2e7d32;
        }

        .btn-grey {
            background-color: #9e9e9e;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #c8e6c9;
            color: #2e7d32;
        }

        a {
            text-decoration: none;
            color: #2e7d32;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        h2 {
            color: #2e7d32;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #2e7d32;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #bdbdbd;
            border-radius: 6px;
            font-size: 16px;
        }

        button {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        AgriSmart
    </div>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
