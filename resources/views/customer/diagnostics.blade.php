@extends('layouts.customer')
@section('title', 'Diagnostics')

@section('content')
<main class="py-10 px-4 max-w-4xl mx-auto text-white">
    <section class="bg-[#1f1f1f] border-2 border-orange-600 rounded-xl p-6 shadow-lg">
        <h2 class="text-3xl font-bold text-yellow-400 mb-6 font-bebas border-b-2 border-orange-600 pb-2">
            Diagnostic Results
        </h2>

        @if($diagnostics->isEmpty())
            <p class="text-gray-300 text-center">
                No diagnostics available yet. Once you’ve had services, your mechanic’s notes will appear here.
            </p>
        @else
            @foreach($diagnostics as $diag)
                <div class="mb-6 bg-[#2a2a2a] border border-gray-700 p-6 rounded-lg shadow hover:shadow-md transition">
                    <div class="mb-2 text-sm text-gray-400">
                        <p><span class="text-yellow-400 font-semibold">Date:</span> {{ \Carbon\Carbon::parse($diag->AppointmentDateTime)->format('F j, Y, g:i A') }}</p>
                        <p><span class="text-yellow-400 font-semibold">Service:</span> {{ $diag->ServiceName }}</p>
                        <p><span class="text-yellow-400 font-semibold">Bike:</span> {{ $diag->Year }} {{ $diag->Make }} {{ $diag->Model }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold mb-1 text-orange-400">Issue Found</label>
                        <textarea rows="4" class="w-full p-2 rounded-md bg-[#1f1f1f] text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-orange-600" readonly>{{ $diag->IssueFound }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1 text-orange-400">Recommendation</label>
                        <textarea rows="3" class="w-full p-2 rounded-md bg-[#1f1f1f] text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-orange-600" readonly>{{ $diag->Recommendation }}</textarea>
                    </div>
                </div>
            @endforeach
        @endif
    </section>
</main>
@endsection