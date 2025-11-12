@extends('layouts.customer')
@section('title', 'Book Appointment')

@section('content')
<section class="card max-w-2xl mx-auto">
  <h2 class="heading-brand mb-4">Schedule a Service</h2>

  @if(session('message'))
    <div class="alert mb-4">{{ session('message') }}</div>
  @endif

  @if ($errors->any())
    <div class="alert alert-error mb-4">
      <div><strong>There were some problems with your input:</strong></div>
      <ul class="list-disc pl-6 mt-2">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('customer.appointment.book') }}" class="space-y-4">
    @csrf

    <!-- Bike Selection -->
    <div>
      <label for="bike_id" class="label">Select Your Bike</label>
      <select id="bike_id" name="bike_id" class="select" required>
        <option value="">-- Select a bike --</option>
        @foreach($bikes as $bike)
          <option value="{{ $bike->BikeID }}">
            {{ $bike->Year }} {{ $bike->Make }} {{ $bike->Model }}
          </option>
        @endforeach
      </select>
    </div>

    <!-- Service Selection -->
    <div>
      <label for="serviceID" class="label">Service Type</label>
      <select id="serviceID" name="serviceID" class="select" required>
        <option value="">-- Select a service --</option>
        @foreach($services as $service)
          <option value="{{ $service->ServiceID }}">{{ $service->ServiceName }}</option>
        @endforeach
      </select>
    </div>

    <!-- Date -->
    <div>
      <label for="appointmentDate" class="label">Date</label>
      <input type="date" id="appointmentDate" name="appointmentDate" class="input" required>
    </div>

    <!-- Time -->
    <div>
      <label for="appointmentTime" class="label">Time</label>
      <select id="appointmentTime" name="appointmentTime" class="select" required>
        <option value="">-- Select a time --</option>
      </select>
    </div>

    <!-- Submit -->
    <button type="submit" class="btn btn-primary w-full">Book Appointment</button>
  </form>
</section>
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