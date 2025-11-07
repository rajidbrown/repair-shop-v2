<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Dashboard') - Shaded Motorworks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600&family=Bebas+Neue&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #0e0e0e;
            color: #eee;
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
            letter-spacing: 1px;
        }

        .logout-link {
            color: #ffcc00;
            text-decoration: none;
            font-weight: bold;
            font-size: 1em;
            background: none;
            border: none;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .logout-link:hover {
            color: #f4511e;
        }

        main {
            padding: 50px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        h2,
        .heading-brand {
            text-align: center;
            color: #ffcc00;
            font-family: 'Bebas Neue', cursive;
            font-size: 2.2em;
            margin-bottom: 30px;
        }

        .tiles {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }

        .tile {
            background-color: #1f1f1f;
            border: 2px solid #f4511e;
            border-radius: 12px;
            height: 180px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.1em;
            font-weight: bold;
            color: #ffcc00;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 0 8px #f4511e50;
        }

        .tile:hover {
            background-color: #2c2c2c;
            color: #f4511e;
            transform: scale(1.04);
            box-shadow: 0 0 12px #f4511e70;
        }

        .table-wrap {
            overflow-x: auto;
            margin: 40px 0 60px 0;
        }

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: #1f1f1f;
            color: #eee;
            border-radius: 12px;
            border: 2px solid #f4511e;
            box-shadow: 0 0 8px #f4511e50;
            overflow: hidden;
        }

        .table th,
        .table td {
            padding: 14px 18px;
            text-align: left;
            border-bottom: 1px solid #333;
        }

        .table th {
            background-color: #1a1a1a;
            color: #ffcc00;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.95em;
            letter-spacing: 0.5px;
        }

        .table td {
            font-size: 0.95em;
        }

        .table tbody tr:hover {
            background-color: #2c2c2c;
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        .text-right {
            text-align: right;
        }

        .btn {
            background-color: #f4511e;
            color: #fff;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 0.95em;
            transition: all 0.3s ease;
            border: none;
        }

        .btn:hover {
            background-color: #ff6f3c;
            color: #000;
            transform: scale(1.05);
        }

        .btn-sm {
            padding: 4px 10px;
            font-size: 0.85em;
        }

        .muted {
            color: #aaa;
            font-size: 0.95em;
            text-align: center;
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

        @media screen and (max-width: 768px) {
            .tiles {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }

            .tile {
                height: 150px;
                font-size: 1em;
            }

            header h1 {
                font-size: 1.5em;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>
            Welcome, 
            {{ session('name') 
                ?? session('admin_username') 
                ?? session('customer_name') 
                ?? session('mechanic_name') 
                ?? 'User' 
            }}!
        </h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-link">Logout</button>
        </form>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Shaded Motorworks — All rights reserved</p>
    </footer>
</body>
</html>