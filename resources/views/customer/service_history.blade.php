@extends('layouts.customer')

@section('title', 'Service History')

@section('content')

<div class="max-w-4xl mx-auto px-6 mt-10">

<h2 class="text-3xl font-heading text-yellow-400 text-center border-b-4 border-orange-600 pb-2 mb-8">
    Service History
</h2>

@if ($history->isEmpty())
    <p class="text-center text-gray-400 text-lg">
        You don't have any completed services yet.
    </p>
@else
    <ul class="space-y-6">
        @foreach ($history as $item)
            <li class="bg-gray-900 border-2 border-orange-600 rounded-xl p-6">

                <p class="text-gray-300 mb-1">
                    <strong class="text-yellow-400">Date:</strong>
                    {{ \Carbon\Carbon::parse($item->AppointmentDateTime)->format('F j, Y g:i A') }}
                </p>

                <p class="text-gray-300 mb-1">
                    <strong class="text-yellow-400">Bike:</strong>
                    {{ $item->Make }} {{ $item->Model }} — {{ $item->Mileage }} miles
                </p>

                <p class="text-gray-300 mb-1">
                    <strong class="text-yellow-400">Service:</strong>
                    {{ $item->ServiceName }}
                </p>

                <p class="text-gray-300">
                    <strong class="text-yellow-400">Status:</strong>
                    Completed
                </p>

            </li>
        @endforeach
    </ul>
@endif

</div>
@endsection
