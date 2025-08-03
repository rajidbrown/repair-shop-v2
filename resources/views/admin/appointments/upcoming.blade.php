<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upcoming Appointments - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600&family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
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

        .nav-links {
            display: flex;
            gap: 15px;
        }

        .nav-links a {
            color: #ffcc00;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.95em;
            text-transform: uppercase;
        }

        .nav-links a:hover {
            color: #f4511e;
        }

        main {
            padding: 40px 20px;
            max-width: 1100px;
            margin: auto;
        }

        h2 {
            text-align: center;
            font-family: 'Bebas Neue', cursive;
            font-size: 2em;
            color: #ffcc00;
            margin-bottom: 30px;
        }

        .appointment-card {
            background-color: #1f1f1f;
            border: 2px solid #f4511e;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            transition: 0.3s;
        }

        .appointment-card:hover {
            background-color: #2a2a2a;
            box-shadow: 0 0 8px #f4511e88;
        }

        .info-label {
            color: #ffcc00;
            font-weight: bold;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #1a1a1a;
            border-top: 4px solid #f4511e;
            color: #bbb;
            font-size: 0.9em;
            margin-top: 40px;
        }
    </style>
</head>
<body>
<header>
    <h1>Upcoming Appointments</h1>
    <div class="nav-links">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ url('/logout') }}">Logout</a>
    </div>
</header>

<main>
    <h2>Appointments for the Next 7 Days</h2>

    @if($appointments->isEmpty())
        <p style="text-align:center;">No appointments scheduled in the next 7 days.</p>
    @else
        @foreach($appointments as $appt)
            <div class="appointment-card">
                <p><span class="info-label">Customer:</span> {{ $appt->CustomerFirst }} {{ $appt->CustomerLast }}</p>
                <p><span class="info-label">Bike:</span> {{ $appt->Make }} {{ $appt->Model }} — {{ $appt->Mileage }} miles</p>
                <p><span class="info-label">Service:</span> {{ $appt->ServiceName }}</p>
                <p><span class="info-label">Mechanic:</span> {{ $appt->MechFirst }} {{ $appt->MechLast }}</p>
                <p><span class="info-label">Appointment Time:</span> {{ $appt->AppointmentDateTime }}</p>
            </div>
        @endforeach
    @endif
</main>

<footer>
    &copy; 2025 Shaded Motorworks — Admin Panel
</footer>
</body>
</html>