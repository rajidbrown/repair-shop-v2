@extends('layouts.customer')

@section('title', 'Your Invoices')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 px-6">
        <h2 class="text-3xl font-heading text-yellow-400 text-center border-b-4 border-orange-600 pb-2 mb-8">
            Your Invoices
        </h2>

        @if ($invoices->isEmpty())
            <p class="text-center text-gray-400 text-lg">You don’t have any invoices yet.</p>
        @else
            @foreach ($invoices as $invoice)
                <div class="bg-gray-900 border-2 border-orange-600 rounded-lg p-6 mb-6">
                    <p class="text-gray-300 mb-2"><strong class="text-orange-400">Invoice ID:</strong> {{ $invoice->InvoiceID }}</p>
                    <p class="text-gray-300 mb-2"><strong class="text-orange-400">Date Issued:</strong> {{ \Carbon\Carbon::parse($invoice->DateIssued)->format('F j, Y') }}</p>
                    <p class="text-gray-300 mb-2"><strong class="text-orange-400">Total:</strong> ${{ number_format($invoice->TotalAmount, 2) }}</p>
                    <p class="text-gray-300"><strong class="text-orange-400">Description:</strong> {{ $invoice->Description }}</p>
                </div>
            @endforeach
        @endif
    </div>
@endsection