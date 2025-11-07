@extends('layouts.customer')

@section('title', 'Book Appointment')

@section('content')
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
@endsection

@section('scripts')
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
@endsection