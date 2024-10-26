<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f9f9f9;
            color: #333;
            text-align: center;
        }
        
        .container {
            padding: 20px;
            max-width: 600px;
            animation: fadeIn 1s ease-in-out;
        }
        
        h1 {
            font-size: 3em;
            color: #2d57a8;
            margin-bottom: 20px;
        }
        
        p {
            font-size: 1.25em;
            color: #777;
            margin-bottom: 30px;
        }
        
        .illustration img {
            max-width: 80%;
            height: auto;
            display: block;
            margin: 0 auto 20px;
            animation: fadeIn 1.5s ease-in-out;
        }

        /* Button styles */
        .btn-home {
            padding: 12px 24px;
            font-size: 1em;
            color: #fff;
            background-color: #2d57a8;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .btn-home:hover {
            background-color: #1b3a73;
        }
        
        /* Fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
        <a href="{{ route('publications.index') }}" class="btn-home">Go Home</a>
    </div>
</body>
</html>
