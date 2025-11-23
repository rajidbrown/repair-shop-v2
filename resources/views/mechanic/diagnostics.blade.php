@extends('layouts.mechanic')

@section('title', 'Diagnostics - Shaded Motorworks')

@section('content')
<main class="py-10 px-4 max-w-4xl mx-auto text-white">
    <section class="bg-[#1f1f1f] border-2 border-orange-600 rounded-xl p-6 shadow-lg">
        <h2 class="text-3xl font-bold text-yellow-400 mb-6 font-bebas border-b-2 border-orange-600 pb-2">
            Diagnostics Log
        </h2>

        @if(session('success'))
            <p class="text-green-500 mb-4 font-semibold">{{ session('success') }}</p>
        @elseif(session('error'))
            <p class="text-red-500 mb-4 font-semibold">{{ session('error') }}</p>
        @endif

        @if($appointments->isEmpty())
            <p class="text-gray-300">No bikes assigned currently.</p>
        @else
            @foreach ($appointments as $appt)
                <form method="POST" action="{{ route('mechanic.diagnostics.submit') }}" class="mb-8 bg-[#2a2a2a] border border-gray-700 p-6 rounded-lg shadow hover:shadow-md transition">
                    @csrf
                    <input type="hidden" name="appointment_id" value="{{ $appt->AppointmentID }}">

                    <div class="mb-4 text-sm leading-relaxed">
                        <p><span class="text-yellow-400 font-semibold">Date:</span> {{ \Carbon\Carbon::parse($appt->AppointmentDateTime)->format('F j, Y, g:i A') }}</p>
                        <p><span class="text-yellow-400 font-semibold">Customer:</span> {{ $appt->FirstName }} {{ $appt->LastName }}</p>
                        <p><span class="text-yellow-400 font-semibold">Bike:</span> {{ $appt->Year }} {{ $appt->Make }} {{ $appt->Model }}</p>
                        <p><span class="text-yellow-400 font-semibold">Service:</span> {{ $appt->ServiceName }}</p>
                    </div>

                    <div class="mb-4">
                        <label for="diagnostics_{{ $appt->AppointmentID }}" class="block text-sm font-semibold mb-1 text-yellow-300">Diagnostics</label>
                        <textarea name="diagnostics" id="diagnostics_{{ $appt->AppointmentID }}" rows="4" class="w-full p-2 rounded-md bg-[#1f1f1f] text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-orange-600">{{ old('diagnostics', $appt->Diagnostics ?? ($diagnosticTemplates[$appt->ServiceName] ?? '')) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="recommendation_{{ $appt->AppointmentID }}" class="block text-sm font-semibold mb-1 text-yellow-300">Recommendation</label>
                        <textarea name="recommendation" id="recommendation_{{ $appt->AppointmentID }}" rows="3" class="w-full p-2 rounded-md bg-[#1f1f1f] text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-orange-600">{{ old('recommendation', $appt->Recommendation ?? '') }}</textarea>
                    </div>

                    <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-4 rounded transition">
                        Save
                    </button>
                </form>
            @endforeach
        @endif
    </section>
</main>
@endsection