@extends('layouts.customer')
@section('title', 'Diagnostics')

@section('content')
<section class="card max-w-4xl mx-auto">
  <h2 class="heading-brand mb-6">Diagnostic Results</h2>

  @if($diagnostics->isEmpty())
    <p class="text-center text-gray-300">
      No diagnostics available yet. Once you’ve had services, your mechanic’s notes will appear here.
    </p>
  @else
    <div class="space-y-6">
      @foreach($diagnostics as $diag)
        <div class="bg-[#1f1f1f] border-2 border-orange-600 rounded-xl p-6 shadow-lg hover:bg-[#2a2a2a] transition">
          <h3 class="text-2xl text-yellow-400 font-heading mb-2">
            {{ $diag->Year }} {{ $diag->Make }} {{ $diag->Model }}
          </h3>
          <p class="text-sm text-gray-400 mb-1">
            <strong>Service:</strong> {{ $diag->ServiceName }}
          </p>
          <p class="text-sm text-gray-400 mb-4">
            <strong>Date:</strong> {{ \Carbon\Carbon::parse($diag->AppointmentDateTime)->format('F j, Y \a\t g:i A') }}
          </p>
          <p class="text-sm text-gray-300 mb-1">
            <strong class="text-orange-400">Issue Found:</strong> {{ $diag->IssueFound }}
          </p>
          <p class="text-sm text-gray-300">
            <strong class="text-orange-400">Recommendation:</strong> {{ $diag->Recommendation }}
          </p>
        </div>
      @endforeach
    </div>
  @endif
</section>
@endsection