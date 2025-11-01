@extends('layouts.mechanic')

@section('title', 'Service History - Shaded Motorworks')

@section('content')
<main class="py-10 px-4 max-w-4xl mx-auto text-white">
    <section class="bg-[#1f1f1f] p-6 rounded-xl border-2 border-orange-600 shadow-lg">
        <h2 class="text-3xl font-bold text-yellow-400 mb-6 font-bebas border-b-2 border-orange-600 pb-2 text-center">
            Completed Appointments
        </h2>

        @if (session('status_updated'))
            <div class="bg-green-700 text-white px-4 py-3 rounded-md mb-6 border border-green-900 text-center font-semibold">
                Appointment status updated successfully!
            </div>
        @endif

        @if ($history->isEmpty())
            <p class="text-gray-300">No completed services found.</p>
        @else
            <div class="space-y-6">
                @foreach ($history as $item)
                    <div class="bg-[#2a2a2a] border-l-4 border-yellow-400 p-4 rounded-md shadow hover:shadow-lg transition">
                        <p><span class="text-yellow-400 font-semibold">Date:</span> {{ \Carbon\Carbon::parse($item->AppointmentDateTime)->format('F j, Y, g:i A') }}</p>
                        <p><span class="text-yellow-400 font-semibold">Customer:</span> {{ $item->FirstName }} {{ $item->LastName }}</p>
                        <p><span class="text-yellow-400 font-semibold">Bike:</span> {{ $item->Make }} {{ $item->Model }} — {{ $item->Mileage }} miles</p>
                        <p><span class="text-yellow-400 font-semibold">Service:</span> {{ $item->ServiceName }}</p>
                        <p><span class="text-yellow-400 font-semibold">Status:</span> <span class="italic text-white">{{ $item->Status }}</span></p>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</main>
@endsection