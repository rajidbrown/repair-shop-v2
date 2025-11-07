@extends('layouts.customer')

@section('title', 'Diagnostics')

@section('content')
    <div class="container mx-auto mt-10 px-4">
        <h2 class="text-3xl font-bold text-yellow-400 text-center mb-8 border-b-2 border-orange-600 pb-2 font-heading">
            Diagnostic Results
        </h2>

        @if($diagnostics->isEmpty())
            <p class="text-center text-gray-400 text-lg">No diagnostics available yet. Once you've had services, your mechanic’s notes will appear here.</p>
        @else
            @foreach($diagnostics as $diag)
                <div class="bg-gray-800 border border-gray-600 rounded-lg p-6 mb-6">
                    <h3 class="text-2xl text-yellow-400 font-heading mb-2">
                        {{ $diag->Year }} {{ $diag->Make }} {{ $diag->Model }}
                    </h3>
                    <p class="text-sm text-gray-400 mb-1">
                        <strong>Service:</strong> {{ $diag->ServiceName }}
                    </p>
                    <p class="text-sm text-gray-400 mb-1">
                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($diag->AppointmentDateTime)->format('F j, Y \a\t g:i A') }}
                    </p>
                    <p class="text-sm text-gray-300 mt-4">
                        <strong class="text-orange-400">Issue Found:</strong> {{ $diag->IssueFound }}
                    </p>
                    <p class="text-sm text-gray-300 mt-1">
                        <strong class="text-orange-400">Recommendation:</strong> {{ $diag->Recommendation }}
                    </p>
                </div>
            @endforeach
        @endif
    </div>
@endsection