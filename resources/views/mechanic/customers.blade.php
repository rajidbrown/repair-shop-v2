@extends('layouts.mechanic')

@section('title', 'My Customers')

@section('content')
<main class="py-12 px-4 max-w-5xl mx-auto text-white">
    <section class="bg-[#1f1f1f] p-8 rounded-xl border-2 border-orange-600 shadow-lg">
        <h2 class="text-3xl font-bold text-yellow-400 mb-6 font-bebas uppercase border-b-2 border-orange-600 pb-2">
            My Customers
        </h2>

        @if($customers->isEmpty())
            <p class="text-gray-300">No customers found who have booked appointments with you.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-700 bg-[#2a2a2a]">
                    <thead>
                        <tr class="bg-[#3b4a5a] text-yellow-400 uppercase text-sm">
                            <th class="p-3 text-left">Customer Name</th>
                            <th class="p-3 text-left">Bike</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $c)
                            <tr class="border-t border-gray-700 hover:bg-[#3a3a3a]">
                                <td class="p-3">
                                    {{ $c->FirstName }} {{ $c->LastName }}
                                </td>
                                <td class="p-3">
                                    @php
                                        $bike = trim(implode(' ', array_filter([$c->Year, $c->Make, $c->Model])));
                                    @endphp
                                    {{ $bike !== '' ? $bike : 'No Bike Info' }}
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