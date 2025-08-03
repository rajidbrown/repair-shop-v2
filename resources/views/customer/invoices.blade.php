<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Your Invoices - Shaded Motorworks</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Bebas+Neue&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #0e0e0e;
      color: #eee;
      font-family: 'Roboto', sans-serif;
      margin: 0;
    }
    header {
      background-color: #1a1a1a;
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 4px solid #f4511e;
      color: #ffcc00;
    }
    .nav a {
      margin-left: 20px;
      color: #ffcc00;
      text-decoration: none;
      font-weight: bold;
    }
    .nav a:hover {
      color: #f4511e;
    }
    main {
      max-width: 1000px;
      margin: 50px auto;
      padding: 20px;
    }
    h2 {
      text-align: center;
      font-family: 'Bebas Neue', cursive;
      color: #ffcc00;
      font-size: 2.4em;
      margin-bottom: 30px;
    }
    .invoice-box {
      background-color: #1f1f1f;
      border: 2px solid #f4511e;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 10px;
    }
    .invoice-box p {
      margin: 5px 0;
    }
    footer {
      text-align: center;
      padding: 20px;
      background-color: #1a1a1a;
      color: #bbb;
      font-size: 0.9em;
      border-top: 4px solid #f4511e;
    }
  </style>
</head>
<body>
  <header>
    <h1>SHADED MOTORWORKS</h1>
    <div class="nav">
      <a href="{{ route('customer.dashboard') }}">Dashboard</a>
      <a href="{{ route('logout') }}">Logout</a>
    </div>
  </header>

  <main>
    <h2>Your Invoices</h2>

    @if ($invoices->isEmpty())
      <p style="text-align: center;">You don’t have any invoices yet.</p>
    @else
      @foreach ($invoices as $invoice)
        <div class="invoice-box">
          <p><strong>Invoice ID:</strong> {{ $invoice->InvoiceID }}</p>
          <p><strong>Date Issued:</strong> {{ $invoice->DateIssued }}</p>
          <p><strong>Total:</strong> ${{ number_format($invoice->TotalAmount, 2) }}</p>
          <p><strong>Description:</strong> {{ $invoice->Description }}</p>
        </div>
      @endforeach
    @endif
  </main>

  <footer>
    <p>&copy; 2025 SHADED MOTORWORKS — Dallas, GA • (770) 555-9876</p>
  </footer>
</body>
</html>