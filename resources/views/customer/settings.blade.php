<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Shaded Motorworks</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600&family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #0e0e0e;
            color: #eee;
            font-family: 'Roboto', sans-serif;
            margin: 0;
        }

        header {
            background-color: #1a1a1a;
            color: #ffcc00;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 4px solid #f4511e;
        }

        header h1 {
            margin: 0;
            font-family: 'Bebas Neue', cursive;
            font-size: 2em;
        }

        .logout-link {
            color: #ffcc00;
            text-decoration: none;
            font-weight: bold;
        }

        .logout-link:hover {
            color: #f4511e;
        }

        main {
            padding: 60px 20px;
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        h2 {
            font-family: 'Bebas Neue', cursive;
            font-size: 2.2em;
            margin-bottom: 30px;
            color: #ffcc00;
        }

        .coming-soon {
            font-size: 1.1em;
            background-color: #1f1f1f;
            border: 2px dashed #f4511e;
            padding: 30px;
            border-radius: 12px;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #1a1a1a;
            border-top: 4px solid #f4511e;
            color: #bbb;
            font-size: 0.95em;
            margin-top: 60px;
        }
    </style>
</head>
<body>
<header>
    <h1>Settings</h1>
    <a class="logout-link" href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</header>

<main>
    <h2>Manage Your Account</h2>
    <div class="coming-soon">
        This page will soon let you:
        <ul style="text-align:left; margin-top:15px; line-height:1.7;">
            <li>Change your password</li>
            <li>Adjust notification preferences</li>
            <li>Request account deletion</li>
            <li>Contact support</li>
        </ul>
        Stay tuned!
    </div>
</main>

<footer>
    <p>&copy; 2025 Shaded Motorworks — Dallas, GA</p>
</footer>
</body>
</html>