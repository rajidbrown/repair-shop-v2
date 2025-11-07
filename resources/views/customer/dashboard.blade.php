@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    <h2 class="text-2xl text-center text-yellow-300 mb-6 font-bebas">Customer Dashboard</h2>

    <div class="tiles grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-4">
        <a class="tile" href="{{ route('customer.bike') }}">My Bike</a>
        <a class="tile" href="{{ route('customer.appointment.form') }}">Book Appointment</a>
        <a class="tile" href="{{ route('customer.appointments') }}">My Appointments</a>
        <a class="tile" href="{{ route('customer.diagnostics') }}">Diagnostics</a>
        <a class="tile" href="{{ route('customer.service_history') }}">Service History</a>
        <a class="tile" href="{{ route('customer.invoices') }}">Invoices</a>
        <a class="tile" href="{{ route('customer.update_info') }}">Contact Info</a>
        <a class="tile" href="{{ route('customer.settings') }}">Settings</a>
    </div>
@endsection