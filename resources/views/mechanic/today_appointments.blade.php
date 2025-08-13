@extends('layouts.mechanic')

@section('title', "Today's Appointments")

@section('content')
<main class="py-10 px-4 max-w-5xl mx-auto text-white">
    <section class="bg-[#1f1f1f] p-6 md:p-8 rounded-xl border-2 border-orange-600 shadow-lg">
        <h2 class="text-3xl font-bold text-yellow-400 mb-6 font-bebas border-b-2 border-orange-600 pb-2">
            Today's Appointments
        </h2>

        @if($appointments->isEmpty())
            <p class="text-center text-gray-300">No appointments scheduled for today.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse bg-[#2a2a2a]">
                    <thead>
                        <tr class="bg-[#3b4a5a] uppercase text-yellow-400">
                            <th class="p-3 text-left">Time</th>
                            <th class="p-3 text-left">Customer</th>
                            <th class="p-3 text-left">Service</th>
                            <th class="p-3 text-left">Bike</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $a)
                            <tr class="border-t border-gray-700 hover:bg-[#3a3a3a]">
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($a->AppointmentDateTime)->format('g:i A') }}
                                </td>
                                <td class="p-3">
                                    {{ $a->CustomerFirstName }} {{ $a->CustomerLastName }}
                                </td>
                                <td class="p-3">
                                    {{ $a->ServiceName }}
                                </td>
                                <td class="p-3">
                                    @php
                                        $bike = trim(($a->Year ? $a->Year.' ' : '').($a->Make ?? '').' '.($a->Model ?? ''));
                                    @endphp
                                    {{ $bike !== '' ? $bike : 'N/A' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
</main>
@endsection