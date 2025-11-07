@extends('layouts.customer')

@section('title', 'My Appointments')

@section('content')
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
@endsection