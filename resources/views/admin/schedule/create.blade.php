<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Weekly Schedule - Shaded Motorworks</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #0e0e0e;
            color: #ddd;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #1a1a1a;
            color: #ffcc00;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 4px solid #f4511e;
        }

        header h1 {
            font-family: 'Bebas Neue', cursive;
            font-size: 2.2em;
            margin: 0;
        }

        nav a {
            color: #ffcc00;
            text-decoration: none;
            font-weight: bold;
            margin-left: 20px;
        }

        nav a:hover {
            color: #f4511e;
        }

        main {
            padding: 50px 20px;
            text-align: center;
        }

        section {
            background-color: #1f1f1f;
            max-width: 700px;
            margin: 0 auto;
            padding: 30px 40px;
            border-radius: 12px;
            border: 2px solid #f4511e;
        }

        h2 {
            font-family: 'Bebas Neue', cursive;
            font-size: 2.2em;
            color: #ffcc00;
            margin-bottom: 30px;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 6px;
            font-weight: bold;
        }

        select, input[type="time"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #555;
            background-color: #2a2a2a;
            color: #ddd;
        }

        button {
            padding: 12px 20px;
            background-color: #f4511e;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            width: 100%;
        }

        button:hover {
            background-color: #d1391b;
        }

        .error { color: #ff4d4d; font-weight: bold; margin-bottom: 15px; }
        .success { color: #00ff99; font-weight: bold; margin-bottom: 15px; }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #1a1a1a;
            color: #aaa;
            border-top: 4px solid #f4511e;
            margin-top: 60px;
            font-size: 0.95em;
        }
    </style>
</head>
<body>
<header>
    <h1>SHADED MOTORWORKS</h1>
    <nav>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.schedule.form') }}">Create Schedule</a>
        <a href="{{ route('admin.add_mechanic.form') }}">Add Mechanic</a>
        <a href="#">Logout</a>
    </nav>
</header>

<main>
    <section>
        <h2>Create Weekly Schedule</h2>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @elseif(session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif

        <form action="{{ route('admin.schedule.store') }}" method="POST">
            @csrf
            <label for="mechanicID">Mechanic:</label>
            <select id="mechanicID" name="mechanicID" required>
                <option value="">Select a Mechanic</option>
                @foreach($mechanics as $mechanic)
                    <option value="{{ $mechanic->MechanicID }}">
                        {{ $mechanic->FirstName }} {{ $mechanic->LastName }}
                    </option>
                @endforeach
            </select>

            <label for="dayOfWeek">Day of the Week:</label>
            <select id="dayOfWeek" name="dayOfWeek" required>
                <option value="">Select a day</option>
                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                    <option value="{{ $day }}">{{ $day }}</option>
                @endforeach
            </select>

            <label for="startTime">Start Time:</label>
            <input type="time" id="startTime" name="startTime" required>

            <label for="endTime">End Time:</label>
            <input type="time" id="endTime" name="endTime" required>

            <button type="submit">Add to Schedule</button>
        </form>
    </section>
</main>

<footer>
    <p>&copy; 2025 Shaded Motorworks — Built for speed & precision.</p>
</footer>
</body>
</html>