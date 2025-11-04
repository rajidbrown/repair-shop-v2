{{-- resources/views/admin/appointments/upcoming.blade.php --}}
@extends('layouts.admin') {{-- Use the new shared layout --}}

@section('title', 'Upcoming Appointments')

@section('content')
  <section class="mb-10 max-w-4xl mx-auto">
    <h2 class="heading-brand text-center mb-6">Appointments for the Next 7 Days</h2>

    @if($appointments->isEmpty())
      <p class="muted text-center">No appointments scheduled in the next 7 days.</p>
    @else
      @foreach($appointments as $appt)
        <div class="surface border-2 brand-border rounded-xl p-5 mb-6 hover:bg-[var(--color-surface-hover)] transition-shadow shadow-sm">
          <p><span class="text-accent font-semibold">Customer:</span> {{ $appt->CustomerFirst }} {{ $appt->CustomerLast }}</p>
          <p><span class="text-accent font-semibold">Bike:</span> {{ $appt->Make }} {{ $appt->Model }} — {{ $appt->Mileage }} miles</p>
          <p><span class="text-accent font-semibold">Service:</span> {{ $appt->ServiceName }}</p>
          <p><span class="text-accent font-semibold">Mechanic:</span> {{ $appt->MechFirst }} {{ $appt->MechLast }}</p>
          <p><span class="text-accent font-semibold">Appointment Time:</span> {{ $appt->AppointmentDateTime }}</p>
        </div>
      @endforeach
    @endif
  </section>
@endsection