<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #ffffff;
            color: #333;
            flex-direction: column;
            text-align: center;
        }
        h1 {
            font-size: 4em;
            margin-bottom: 20px;
            color: #2d57a8;
        }
        p {
            font-size: 1.5em;
            color: #777;
        }
        .illustration img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- SVG Illustration -->
        <div class="illustration">
            <img src="{{ asset('assets/404-computer.svg') }}" alt="404 Illustration">
        </div>
        <h1>404 Not Found</h1>
        <p>Whoops! That page doesn't exist.</p>
    </div>
</body>
</html>
