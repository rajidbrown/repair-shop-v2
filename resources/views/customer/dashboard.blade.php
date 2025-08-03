<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shaded Motorworks - Customer Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600&family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }

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
        }

        .logout-link:hover {
            color: #f4511e;
        }

        main {
            padding: 50px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        h2 {
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
        }

        .tile:hover {
            background-color: #2c2c2c;
            color: #f4511e;
            transform: scale(1.04);
            box-shadow: 0 0 8px #f4511e50;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #1a1a1a;
            border-top: 4px solid #f4511e;
            color: #bbb;
            font-size: 0.95em;
        }

        @media screen and (max-width: 768px) {
            .tiles { grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); }
            .tile { height: 150px; font-size: 1em; }
            header h1 { font-size: 1.5em; }
        }
    </style>
</head>
<body>
<header>
    <h1>Welcome, {{ $customer->FirstName }}!</h1>
    <a class="logout-link" href="{{ route('logout') }}">Logout</a>
</header>

<main>
    <h2>Customer Dashboard</h2>
    <div class="tiles">
        <a class="tile" href="{{ route('customer.bike') }}">My Bike</a>
        <a class="tile" href="{{ route('customer.book_appointment.form') }}">Book Appointment</a>
        <a class="tile" href="{{ route('customer.appointments') }}">My Appointments</a>
        <a class="tile" href="{{ route('customer.diagnostics') }}">Diagnostics</a>
        <a class="tile" href="{{ route('customer.service_history') }}">Service History</a>
        <a class="tile" href="{{ route('customer.invoices') }}">Invoices</a>
        <a class="tile" href="{{ route('customer.info') }}">Contact Info</a>
        <a class="tile" href="{{ route('customer.settings') }}">Settings</a>
    </div>
</main>

<footer>
    <p>&copy; 2025 Shaded Motorworks — Powered by Precision.</p>
</footer>
</body>
</html>