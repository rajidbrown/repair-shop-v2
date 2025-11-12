@extends('layouts.customer')
@section('title', 'Your Invoices')

@section('content')
<section class="card max-w-4xl mx-auto">
  <h2 class="heading-brand mb-6">Your Invoices</h2>

  @if ($invoices->isEmpty())
    <p class="text-center text-gray-300">
      You don’t have any invoices yet.
    </p>
  @else
    <div class="space-y-6">
      @foreach ($invoices as $invoice)
        <div class="bg-[#1f1f1f] border-2 border-orange-600 rounded-xl p-6 shadow-lg hover:bg-[#2a2a2a] transition">
          <p class="text-gray-300 mb-2">
            <strong class="text-orange-400">Invoice ID:</strong> {{ $invoice->InvoiceID }}
          </p>
          <p class="text-gray-300 mb-2">
            <strong class="text-orange-400">Date Issued:</strong> {{ \Carbon\Carbon::parse($invoice->DateIssued)->format('F j, Y') }}
          </p>
          <p class="text-gray-300 mb-2">
            <strong class="text-orange-400">Total:</strong> ${{ number_format($invoice->TotalAmount, 2) }}
          </p>
          <p class="text-gray-300">
            <strong class="text-orange-400">Description:</strong> {{ $invoice->Description }}
          </p>
        </div>
      @endforeach
    </div>
  @endif
</section>
@endsection