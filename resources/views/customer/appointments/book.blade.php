<!-- resources/views/customer/appointments/book.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment - Shaded Motorworks</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto&display=swap" rel="stylesheet">
    <style>
        body { background-color: #000; color: #fff; font-family: 'Roboto', sans-serif; margin: 0; }
        header {
            background-color: #1a1a1a;
            color: #ffcc00;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 4px solid #f4511e;
            flex-wrap: wrap;
        }
        header h1 {
            font-family: 'Bebas Neue', cursive;
            font-size: 2em;
            margin: 0;
        }
        nav { display: flex; gap: 16px; }
        nav a {
            color: #ffcc00;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 10px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }
        nav a:hover {
            background-color: #f4511e;
            color: #fff;
        }
        .page-title {
            text-align: center;
            font-family: 'Bebas Neue', cursive;
            font-size: 32px;
            color: #ffc107;
            margin: 30px 0 10px;
        }
        main { display: flex; justify-content: center; align-items: center; padding: 50px 20px; }
        .form-box {
            background: #111;
            padding: 30px;
            border: 2px solid #ff4500;
            border-radius: 12px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h2 {
            font-family: 'Bebas Neue', cursive;
            color: #ffc107;
            font-size: 24px;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            text-align: left;
        }
        select, input[type="date"] {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            background: #222;
            color: white;
        }
        select:invalid { background-color: #5a1c1c; }
        button {
            width: 100%;
            padding: 12px;
            margin-top: 25px;
            background: linear-gradient(to right, #f4511e, #ff6600);
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }
        .message { margin-top: 20px; font-weight: bold; color: #00ff99; }
        footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #aaa;
            border-top: 2px solid #ff4500;
        }
    </style>
</head>
<body>
<header>
    <h1>SHADED MOTORWORKS</h1>
    <nav>
        <a href="{{ route('customer.bike') }}">My Bike</a>
        <a href="{{ route('customer.appointment.book') }}">Book Appointment</a>
        <a href="{{ route('customer.appointment.view') }}">My Appointments</a>
        <a href="{{ route('customer.diagnostics') }}">Diagnostics</a>
        <a href="{{ route('customer.service_history') }}">Service History</a>
        <a href="{{ route('customer.invoices') }}">Invoices</a>
        <a href="{{ route('customer.info') }}">My Info</a>
        <a href="{{ route('customer.settings') }}">Settings</a>
        <a href="{{ route('logout') }}">Logout</a>
    </nav>
</header>
<h1 class="page-title">Booking</h1>
<main>
<form method="POST" class="form-box" action="{{ route('customer.appointment.book') }}">
    @csrf
    <h2>SCHEDULE A SERVICE</h2>
    @if(session('message'))
        <p class="message">{{ session('message') }}</p>
    @endif

    <label for="bike_id">Select Your Bike:</label>
    <select id="bike_id" name="bike_id" required>
        <option value="">-- Select a bike --</option>
        @foreach($bikes as $bike)
            <option value="{{ $bike->BikeID }}">
                {{ $bike->Year }} {{ $bike->Make }} {{ $bike->Model }}
            </option>
        @endforeach
    </select>

    <label for="serviceID">Service Type:</label>
    <select id="serviceID" name="serviceID" required>
        <option value="">-- Select a service --</option>
        @foreach($services as $service)
            <option value="{{ $service->ServiceID }}">{{ $service->ServiceName }}</option>
        @endforeach
    </select>

    <label for="appointmentDate">Date:</label>
    <input type="date" id="appointmentDate" name="appointmentDate" required>

    <label for="appointmentTime">Time:</label>
    <select id="appointmentTime" name="appointmentTime" required>
        <option value="">-- Select a time --</option>
    </select>

    <button type="submit">Book Appointment</button>
</form>
</main>
<footer>&copy; 2025 Shaded Motorworks — All rights reserved</footer>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const serviceSelect = document.getElementById('serviceID');
    const dateInput = document.getElementById('appointmentDate');
    const timeSelect = document.getElementById('appointmentTime');

    function updateTimes() {
        const serviceID = serviceSelect.value;
        const date = dateInput.value;

        if (!serviceID || !date) {
            timeSelect.innerHTML = '<option value="">-- Select a time --</option>';
            return;
        }

        fetch(`/get-available-times?serviceID=${serviceID}&date=${date}`)
            .then(res => res.json())
            .then(data => {
                timeSelect.innerHTML = '<option value="">-- Select a time --</option>';
                data.forEach(time => {
                    const option = document.createElement('option');
                    option.value = time;
                    option.textContent = time;
                    timeSelect.appendChild(option);
                });
            });
    }

    serviceSelect.addEventListener('change', updateTimes);
    dateInput.addEventListener('change', updateTimes);
});
</script>
</body>
</html>