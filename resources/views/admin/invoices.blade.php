@extends('layouts.admin')

@section('title', 'All Invoices')

@section('content')
<section class="page max-w-5xl mx-auto">
  <h2 class="heading-brand text-center mb-8">All Invoices</h2>

  @if ($invoices->count())
    <div class="table-wrap mb-10">
      <table class="table">
        <thead>
          <tr>
            <th>Invoice ID</th>
            <th>Customer</th>
            <th>Date Issued</th>
            <th>Total</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($invoices as $invoice)
            <tr>
              <td>{{ $invoice->InvoiceID }}</td>
              <td>{{ $invoice->FirstName }} {{ $invoice->LastName }}</td>
              <td>{{ \Carbon\Carbon::parse($invoice->DateIssued)->format('F j, Y') }}</td>
              <td>${{ number_format($invoice->TotalAmount, 2) }}</td>
              <td>{{ $invoice->Description }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @else
    <p class="muted text-center">No invoices found.</p>
  @endif
</section>
@endsection