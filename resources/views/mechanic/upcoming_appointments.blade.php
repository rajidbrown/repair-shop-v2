@extends('layouts.mechanic')

@section('title', 'Upcoming Appointments')

@section('content')
<section class="py-10 px-4 max-w-3xl mx-auto text-white">
    <div class="bg-[#1f1f1f] border-2 border-orange-600 rounded-xl p-6 shadow-lg">
        <h1 class="text-3xl font-bold text-yellow-400 mb-6 font-bebas border-b-2 border-orange-600 pb-2">
            Upcoming Appointments
        </h1>

        @if($appointments->isEmpty())
            <p class="text-center text-gray-400">
                You don’t have any upcoming or in-progress appointments at the moment.
            </p>
        @else
            @foreach($appointments as $appt)
                <div class="bg-[#2a2a2a] border border-orange-600 rounded-lg p-4 mb-4 hover:bg-[#3a3a3a] transition">
                    <p><span class="text-yellow-400 font-semibold">Customer:</span> {{ $appt->FirstName }} {{ $appt->LastName }}</p>
                    <p><span class="text-yellow-400 font-semibold">Bike:</span> {{ $appt->Make }} {{ $appt->Model }} — {{ $appt->Mileage }} miles</p>
                    <p><span class="text-yellow-400 font-semibold">Service:</span> {{ $appt->ServiceName }}</p>
                    <p><span class="text-yellow-400 font-semibold">Appointment Time:</span> {{ \Carbon\Carbon::parse($appt->AppointmentDateTime)->format('F j, Y, g:i A') }}</p>
                </div>
            @endforeach
        @endif
    </div>
</section>
@endsection