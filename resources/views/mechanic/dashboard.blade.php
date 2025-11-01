@extends('layouts.dashboard')

@section('title', 'Mechanic Dashboard')

@section('content')
    <h2>Mechanic Dashboard</h2>

    <div class="tiles">
        <a class="tile" href="{{ route('mechanic.appointments.today') }}">Today's Appointments</a>
        <a class="tile" href="{{ route('mechanic.customers') }}">My Customers</a>
        <a class="tile" href="{{ route('mechanic.upcoming_appointments') }}">Future Appointments</a>
        <a class="tile" href="{{ route('mechanic.diagnostics') }}">Diagnostics</a>
        <a class="tile" href="{{ route('mechanic.service_history') }}">Service History</a>
        <a class="tile" href="{{ route('mechanic.todo') }}">To-Do List</a>
        <a class="tile" href="{{ route('mechanic.info.update') }}">Update Info</a>
    </div>
@endsection