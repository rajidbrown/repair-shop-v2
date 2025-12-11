@extends('layouts.customer')

@section('title', 'Service History')

@section('content')
  <div class="max-w-4xl mx-auto px-6 mt-10 text-white">
    <h2 class="text-3xl font-heading text-yellow-400 text-center border-b-4 border-orange-600 pb-2 mb-8">
      Service History
    </h2>

    @if ($history->isEmpty())
      <p class="text-center text-gray-400 text-lg">You don't have any completed services yet.</p>
    @else
      <div class="space-y-6">
        @foreach ($history as $item)
          <div class="bg-[#2a2a2a] border-l-4 border-yellow-400 p-6 rounded-xl shadow hover:shadow-lg transition">
            
            <!-- DATE -->
            <p class="mb-1">
              <span class="text-yellow-400 font-semibold">Date:</span>
              {{ \Carbon\Carbon::parse($item->AppointmentDateTime)->format('F j, Y g:i A') }}
            </p>

            <!-- BIKE -->
            <p class="mb-1">
              <span class="text-yellow-400 font-semibold">Bike:</span>
              {{ $item->Make }} {{ $item->Model }} — {{ $item->Mileage }} miles
            </p>

            <!-- SERVICE -->
            <p class="mb-1">
              <span class="text-yellow-400 font-semibold">Service:</span>
              {{ $item->ServiceName }}
            </p>

            <!-- STATUS -->
            <p class="mb-1">
              <span class="text-yellow-400 font-semibold">Status:</span>
              <span class="italic text-white">{{ $item->Status }}</span>
            </p>

            <!-- NOTES -->
            <p class="mt-3">
              <span class="text-yellow-400 font-semibold">Notes:</span>
              @if (!empty($item->Notes))
                {{ $item->Notes }}
              @else
                <span class="text-gray-300 italic">No notes provided.</span>
              @endif
            </p>

          </div>
        @endforeach
      </div>
    @endif
  </div>
@endsection
