<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shaded Motorworks - Mechanic Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600&family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #111;
            color: #ddd;
        }

        header {
            background-color: #1a1a1a;
            color: #ffcc00;
            padding: 20px 40px;
            text-align: center;
            border-bottom: 4px solid #f4511e;
        }

        header h1 {
            margin: 0;
            font-size: 2.2em;
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 1px;
        }

        nav {
            margin-top: 10px;
        }

        nav a {
            color: #ffcc00;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }

        nav a:hover {
            color: #f4511e;
        }

        main {
            padding: 60px 20px;
            text-align: center;
        }

        section {
            background: #222;
            max-width: 500px;
            margin: 0 auto;
            padding: 35px;
            border-radius: 12px;
            border: 2px solid #f4511e;
            box-shadow: 0 0 10px #00000080;
        }

        h2 {
            color: #ffcc00;
            font-size: 1.8em;
            font-family: 'Bebas Neue', sans-serif;
            text-transform: uppercase;
            border-bottom: 2px solid #f4511e;
            padding-bottom: 8px;
            margin-bottom: 20px;
        }

        .error {
            color: #ff4d4d;
            font-weight: bold;
            margin-top: 15px;
        }

        form {
            text-align: left;
            margin-top: 20px;
        }

        form div {
            margin-bottom: 18px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            background-color: #333;
            border: 2px solid #555;
            border-radius: 6px;
            color: #ddd;
        }

        button {
            background-color: #f4511e;
            color: #fff;
            padding: 12px;
            font-weight: bold;
            width: 100%;
            border: none;
            border-radius: 8px;
            text-transform: uppercase;
            cursor: pointer;
        }

        button:hover {
            background-color: #d1391b;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #1a1a1a;
            color: #bbb;
            border-top: 4px solid #f4511e;
            margin-top: 60px;
            font-size: 0.95em;
        }
    </style>
</head>
<body>
    <header>
        <h1>Shaded Motorworks</h1>
        <nav>
            <a href="{{ route('home') }}">Home</a>
        </nav>
    </header>

    <main>
        <section>
            <h2>Mechanic Login</h2>

            @if ($errors->has('login_error'))
                <p class="error">{{ $errors->first('login_error') }}</p>
            @endif

            <form action="{{ route('mechanic.login.submit') }}" method="POST">
                @csrf
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required value="{{ old('email') }}">
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Shaded Motorworks — All rights reserved</p>
    </footer>
</body>
</html>