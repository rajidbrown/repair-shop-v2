<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Shaded Motorworks</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        /* full CSS from your original file here */
    </style>
</head>
<body>

<header>
    <h1>ADMIN DASHBOARD</h1>
    <nav>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.schedule.create') }}">Create Schedule</a>
        <a href="{{ route('admin.mechanic.add') }}">Add Mechanic</a>
        <a href="{{ route('logout') }}">Logout</a>
    </nav>
</header>

<main>
<section>
    <h2>Admin Quick Access</h2>
    <div class="tile-grid">
        <a class="tile" href="{{ route('admin.customers') }}">View Customers</a>
        <a class="tile" href="{{ route('admin.appointments') }}">Upcoming Appointments</a>
        <a class="tile" href="{{ route('admin.invoices') }}">View Invoices</a>
        <a class="tile" href="{{ route('admin.settings') }}">Settings</a>
    </div>
</section>

<section>
    <h2>Registered Mechanics</h2>
    @if (!empty($mechanics))
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Specialty</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mechanics as $info)
                    <tr>
                        <td>{{ $info['name'] }}</td>
                        <td>{{ $info['email'] }}</td>
                        <td>{{ $info['specialty'] }}</td>
                        <td>{{ $info['phone'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No mechanics registered yet.</p>
    @endif
</section>

<section>
    <h2>Mechanic Weekly Schedule</h2>
    @if (!empty($schedule_grid))
        <table>
            <thead>
                <tr>
                    <th>Day</th>
                    @foreach ($mechanics as $info)
                        <th>{{ $info['name'] }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($schedule_grid as $day => $row)
                    <tr>
                        <td>{{ $day }}</td>
                        @foreach ($row as $shift)
                            <td>{{ $shift }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No schedule data available.</p>
    @endif
</section>
</main>

<footer>
    <p>&copy; 2025 Shaded Motorworks — Admin Portal</p>
</footer>

</body>
</html>