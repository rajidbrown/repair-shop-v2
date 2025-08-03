<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Mechanic - Shaded Motorworks</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #0e0e0e;
            color: #eee;
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            margin: 0;
        }

        header {
            background-color: #1a1a1a;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 4px solid #f4511e;
        }

        header h1 {
            font-family: 'Bebas Neue', cursive;
            font-size: 2.4em;
            color: #ffcc00;
            text-transform: uppercase;
        }

        nav a {
            color: #ffcc00;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
        }

        nav a:hover {
            color: #f4511e;
        }

        form {
            background-color: #1e1e1e;
            padding: 30px;
            border-radius: 10px;
            max-width: 600px;
            margin: 40px auto;
            border: 2px solid #f4511e;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            background-color: #2a2a2a;
            color: #ddd;
            border: 2px solid #444;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #f4511e;
            color: #fff;
            padding: 12px 20px;
            margin-top: 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
        }

        input[type="submit"]:hover {
            background-color: #d1391b;
        }

        .error, .success {
            text-align: center;
            font-weight: bold;
            padding: 12px;
            margin: 20px auto 0;
            max-width: 600px;
            border-radius: 5px;
        }

        .error {
            background-color: #2a2a2a;
            border: 2px solid #e74c3c;
            color: #e74c3c;
        }

        .success {
            background-color: #2a2a2a;
            border: 2px solid #2ecc71;
            color: #2ecc71;
        }
    </style>
</head>
<body>
    <header>
        <h1>SHADED MOTORWORKS</h1>
        <nav>
            <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
            <a href="{{ url('/logout') }}">Logout</a>
        </nav>
    </header>

    {!! $message !!}

    <form method="POST" action="{{ route('admin.add_mechanic.submit') }}">
        @csrf

        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" required>

        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <label for="specialty">Specialty:</label>
        <input type="text" name="specialty">

        <label for="phoneNumber">Phone Number:</label>
        <input type="text" name="phoneNumber">

        <input type="submit" value="Add Mechanic">
    </form>
</body>
</html>