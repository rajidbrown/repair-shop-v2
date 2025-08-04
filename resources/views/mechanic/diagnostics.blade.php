<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Diagnostics - Shaded Motorworks</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #1c1c1c;
            color: #ddd;
            font-family: 'Roboto', sans-serif;
            margin: 0;
        }

        header {
            background-color: #333;
            padding: 20px 40px;
            text-align: center;
            border-bottom: 2px solid #f4511e;
        }

        header h1 {
            font-family: 'Bebas Neue', cursive;
            color: #ffcc00;
            margin: 0;
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
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background: #2a2a2a;
            border: 2px solid #f4511e;
            border-radius: 12px;
        }

        h2 {
            text-align: center;
            font-family: 'Bebas Neue', cursive;
            color: #ffcc00;
            margin-bottom: 30px;
        }

        form {
            background: #1f1f1f;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid #ffcc00;
            border-radius: 6px;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: 600;
        }

        textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            margin-top: 6px;
            border-radius: 6px;
            border: 1px solid #555;
            background-color: #333;
            color: #ddd;
        }

        button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #f4511e;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #d1391b;
        }

        .message {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            color: #00ff99;
        }

        .error {
            color: #ff4d4d;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #2a2a2a;
            color: #aaa;
            border-top: 2px solid #f4511e;
        }

        .service-name {
            font-style: italic;
            color: #ffa500;
            margin-bottom: 6px;
        }
    </style>
</head>
<body>
<header>
    <h1>Shaded Motorworks</h1>
    <nav>
        <a href="{{ route('mechanic.dashboard') }}">Dashboard</a>
        <a href="{{ route('mechanic.diagnostics') }}">Diagnostics</a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</header>

<main>
    <h2>Diagnostics Log</h2>

    @if(session('success'))
        <p class="message">{{ session('success') }}</p>
    @elseif(session('error'))
        <p class="message error">{{ session('error') }}</p>
    @endif

    @if($appointments->isEmpty())
        <p>No bikes assigned currently.</p>
    @else
        @foreach ($appointments as $appt)
            <form method="POST" action="{{ route('mechanic.diagnostics.submit') }}">
                @csrf
                <input type="hidden" name="appointment_id" value="{{ $appt->AppointmentID }}">
                <strong>Date:</strong> {{ \Carbon\Carbon::parse($appt->AppointmentDateTime)->format('F j, Y, g:i A') }}<br>
                <strong>Customer:</strong> {{ $appt->FirstName }} {{ $appt->LastName }}<br>
                <strong>Bike:</strong> {{ $appt->Year }} {{ $appt->Make }} {{ $appt->Model }}<br>
                <div class="service-name">Service: {{ $appt->ServiceName }}</div>

                <label for="diagnostics_{{ $appt->AppointmentID }}">Diagnostics:</label>
                <textarea name="diagnostics" id="diagnostics_{{ $appt->AppointmentID }}">{{ $appt->Diagnostics ?? ($diagnosticTemplates[$appt->ServiceName] ?? '') }}</textarea>

                <label for="recommendation_{{ $appt->AppointmentID }}">Recommendation:</label>
                <textarea name="recommendation" id="recommendation_{{ $appt->AppointmentID }}"></textarea>

                <button type="submit">Save</button>
            </form>
        @endforeach
    @endif
</main>

<footer>
    <p>&copy; 2025 Shaded Motorworks</p>
</footer>
</body>
</html>