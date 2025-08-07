<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upcoming Appointments</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600&family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
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
    </style>
</head>
<body>
    <header>
        <h1>Upcoming Appointments</h1>
        <div class="nav-links">
            <a href="{{ route('mechanic.dashboard') }}">Home</a>
            <a class="logout-link" href="{{ route('logout') }}">Logout</a>
        </div>
    </header>

    <main>
        <h2>Your Upcoming Appointments</h2>

        @if($appointments->isEmpty())
            <p style="text-align:center;">You don’t have any upcoming or in-progress appointments at the moment.</p>
        @else
            @foreach($appointments as $appt)
                <div class="appointment-card">
                    <p><span class="info-label">Customer:</span> {{ $appt->FirstName }} {{ $appt->LastName }}</p>
                    <p><span class="info-label">Bike:</span> {{ $appt->Make }} {{ $appt->Model }} — {{ $appt->Mileage }} miles</p>
                    <p><span class="info-label">Service:</span> {{ $appt->ServiceName }}</p>
                    <p><span class="info-label">Appointment Time:</span> {{ $appt->AppointmentDateTime }}</p>
                </div>
            @endforeach
        @endif
    </main>

    <footer>
        &copy; 2025 Shaded Motorworks — All rights reserved
    </footer>
</body>
</html>