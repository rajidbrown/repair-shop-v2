<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mechanic To-Do List - Shaded Motorworks</title>
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
            padding: 20px 30px;
            border-bottom: 4px solid #f4511e;
            text-align: center;
        }

        header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.2em;
            letter-spacing: 1px;
            margin: 0;
        }

        nav {
            margin-top: 10px;
        }

        nav a {
            color: #ffcc00;
            text-decoration: none;
            margin: 0 12px;
            font-weight: bold;
            text-transform: uppercase;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #f4511e;
        }

        main {
            padding: 40px 20px;
            text-align: center;
        }

        section {
            background: #222;
            max-width: 1100px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.6);
            border: 2px solid #f4511e;
        }

        h2 {
            color: #ffcc00;
            font-size: 2em;
            font-family: 'Bebas Neue', sans-serif;
            text-transform: uppercase;
            margin-bottom: 25px;
            border-bottom: 2px solid #f4511e;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #2a2a2a;
            color: #ddd;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #444;
            text-align: left;
        }

        th {
            background-color: #3b4a5a;
            color: #ffcc00;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #333;
        }

        tr:hover {
            background-color: #444;
        }

        select, button {
            padding: 6px 10px;
            background: #1c1c1c;
            color: #ddd;
            border: 1px solid #888;
            border-radius: 6px;
        }

        button:hover {
            background-color: #f4511e;
            color: #fff;
        }

        .success-message {
            background-color: #2e7d32;
            color: #fff;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #1b5e20;
        }

        footer {
            margin-top: 60px;
            padding: 20px;
            background-color: #1a1a1a;
            color: #bbb;
            text-align: center;
            border-top: 4px solid #f4511e;
            font-size: 0.95em;
        }
    </style>
</head>
<body>
<header>
    <h1>Shaded Motorworks — Mechanic Portal</h1>
    <nav>
        <a href="{{ route('mechanic.dashboard') }}">Dashboard</a>
        <a href="{{ route('mechanic.todo') }}">To-Do List</a>
        <a href="#">My Customers</a>
        <a href="#">Update Info</a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" style="background:none;border:none;color:#ffcc00;cursor:pointer;">Logout</button>
        </form>
    </nav>
</header>

<main>
    <section>
        <h2>Today's Appointments</h2>

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        @if($appointments->isEmpty())
            <p>No appointments scheduled for today.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>Bike</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($appointments as $appt)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($appt->AppointmentDateTime)->format('M j, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($appt->AppointmentDateTime)->format('g:i A') }}</td>
                        <td>{{ $appt->FirstName }} {{ $appt->LastName }}</td>
                        <td>{{ $appt->ServiceName }}</td>
                        <td>{{ trim("{$appt->Year} {$appt->Make} {$appt->Model}") ?: 'N/A' }}</td>
                        <td>{{ $appt->Status ?? 'Not Started' }}</td>
                        <td>
                            <form method="POST" action="{{ route('mechanic.todo.update') }}">
                                @csrf
                                <input type="hidden" name="appointment_id" value="{{ $appt->AppointmentID }}">
                                <select name="status">
                                    <option value="Not Started" @selected($appt->Status === 'Not Started')>Not Started</option>
                                    <option value="Started" @selected($appt->Status === 'Started')>Started</option>
                                    <option value="Completed" @selected($appt->Status === 'Completed')>Completed</option>
                                </select>
                                <button type="submit">Update</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </section>
</main>

<footer>
    <p>&copy; 2025 Shaded Motorworks — Dallas, GA</p>
</footer>
</body>
</html>