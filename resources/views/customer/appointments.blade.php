<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>My Appointments - Shaded Motorworks</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Bebas+Neue&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #0e0e0e;
            color: #eee;
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

        main {
            padding: 40px 20px;
            max-width: 1000px;
            margin: auto;
        }

        .container {
            background-color: #1e1e1e;
            padding: 30px;
            border-radius: 10px;
            border: 2px solid #f4511e;
        }

        h2 {
            font-family: 'Bebas Neue', cursive;
            color: #ffcc00;
            font-size: 2em;
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #f4511e;
            padding-bottom: 10px;
        }

        p {
            text-align: center;
            font-size: 1.1em;
            color: #ccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
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

        form {
            margin: 0;
        }

        .delete-btn {
            background-color: #f4511e;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .delete-btn:hover {
            background-color: #c73a0f;
        }

        .message {
            text-align: center;
            margin-top: 15px;
            font-size: 1em;
        }

        .success {
            color: #2ecc71;
        }

        .error {
            color: #e74c3c;
        }

        footer {
            background-color: #1a1a1a;
            text-align: center;
            padding: 25px 10px;
            border-top: 4px solid #f4511e;
            font-size: 0.9em;
            color: #bbb;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <header>
        <h1>SHADED MOTORWORKS</h1>
        <nav>
            <a href="{{ route('customer.dashboard') }}">Dashboard</a>
            <a href="{{ route('customer.appointments.index') }}">My Appointments</a>
            <a href="{{ route('customer.appointments.book') }}">Book Appointment</a>
            <a href="{{ route('customer.update.info') }}">Update Info</a>
            <a href="{{ route('customer.logout') }}">Logout</a>
        </nav>
    </header>

    <main>
        <div class="container">
            <h2>Your Appointments</h2>

            @if(session('deleteSuccess'))
                <p class="message success">{{ session('deleteSuccess') }}</p>
            @elseif(session('deleteError'))
                <p class="message error">{{ session('deleteError') }}</p>
            @endif

            @if($appointments->isEmpty())
                <p>You don't have any appointments scheduled yet.</p>
            @else
                <p>You have <strong>{{ $appointments->count() }}</strong> appointment(s) scheduled.</p>
                <table>
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Service</th>
                            <th>Mechanic</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($appointment->AppointmentDateTime)->format('F j, Y, g:i A') }}</td>
                                <td>{{ $appointment->ServiceName }}</td>
                                <td>{{ $appointment->MechanicFirstName }} {{ $appointment->MechanicLastName }}</td>
                                <td>
                                    <form method="POST" action="{{ route('customer.appointments.destroy', $appointment->AppointmentID) }}" onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </main>

    <footer>
        <p>&copy; 2025 SHADED MOTORWORKS — Dallas, GA • (770) 555-9876</p>
    </footer>
</body>
</html>