<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CRM Sample App - Melvic Gomez</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Nunito', sans-serif;
        }

        body {
            background-color: rgb(192, 47, 29);
            height: 100vh;
            margin: 0px;
            padding: 0px;
        }

        .welcome-wrapper {
            max-width: 600px;
            padding: 0px 10px;
        }

        .flex-wrapper {
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        h1,
        p {
            margin: 0px;
            text-align: center;
            color: white;
        }
    </style>
</head>

<body>
    <div class="flex-wrapper">
        <div class="welcome-wrapper">
            <h1>Welcome to CRM APP 1.0.0</h1>
            <p>Melvic Gomez made it with ❤ just for you.</p>
        </div>
    </div>
</body>

</html>