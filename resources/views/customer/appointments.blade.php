@extends('layouts.customer')
@section('title', 'My Appointments')

@section('content')
<section class="card max-w-4xl mx-auto">
  <h2 class="heading-brand mb-4">Your Appointments</h2>

  {{-- Success / Error Messages --}}
  @if(session('deleteSuccess'))
    <div class="alert mb-4">{{ session('deleteSuccess') }}</div>
  @elseif(session('deleteError'))
    <div class="alert alert-error mb-4">{{ session('deleteError') }}</div>
  @endif

  {{-- No Appointments --}}
  @if($appointments->isEmpty())
    <p class="text-center text-gray-300">You don’t have any appointments scheduled yet.</p>
  @else
    <p class="text-center text-gray-300 mb-4">
      You have <strong>{{ $appointments->count() }}</strong> appointment(s) scheduled.
    </p>

    {{-- Appointment Table --}}
    <div class="overflow-x-auto">
      <table class="w-full border-collapse bg-[#1f1f1f] border-2 border-orange-600 rounded-xl shadow-lg">
        <thead>
          <tr class="bg-[#3b4a5a] uppercase text-yellow-400">
            <th class="p-3 text-left">Date & Time</th>
            <th class="p-3 text-left">Service</th>
            <th class="p-3 text-left">Mechanic</th>
            <th class="p-3 text-left">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($appointments as $appointment)
            <tr class="border-t border-gray-700 hover:bg-[#2a2a2a] transition">
              <td class="p-3">
                {{ \Carbon\Carbon::parse($appointment->AppointmentDateTime)->format('F j, Y, g:i A') }}
              </td>
              <td class="p-3">{{ $appointment->ServiceName }}</td>
              <td class="p-3">
                {{ $appointment->MechanicFirstName }} {{ $appointment->MechanicLastName }}
              </td>
              <td class="p-3">
                <form method="POST"
                      action="{{ route('customer.appointments.destroy', $appointment->AppointmentID) }}"
                      onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</section>
@endsection