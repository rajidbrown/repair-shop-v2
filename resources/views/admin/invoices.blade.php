<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Invoices - Admin | Shaded Motorworks</title>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto&display=swap" rel="stylesheet">
  <style>
    body { background-color: #000; color: #fff; font-family: 'Roboto', sans-serif; margin: 0; }
    header {
      background-color: #1a1a1a;
      padding: 20px 40px;
      border-bottom: 4px solid #f4511e;
      color: #ffcc00;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    h1 { font-family: 'Bebas Neue', cursive; font-size: 2em; margin: 0; }
    main { max-width: 1000px; margin: 40px auto; padding: 20px; }
    h2 { text-align: center; font-family: 'Bebas Neue', cursive; font-size: 2.4em; color: #ffc107; }
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #111;
      color: #fff;
    }
    th, td {
      border: 1px solid #f4511e;
      padding: 12px;
      text-align: left;
    }
    th { background-color: #f4511e; }
    footer {
      text-align: center;
      padding: 20px;
      font-size: 14px;
      color: #aaa;
      border-top: 2px solid #ff4500;
      margin-top: 40px;
    }
  </style>
</head>
<body>
<header>
  <h1>SHADED MOTORWORKS</h1>
  <nav>
    <a href="{{ route('admin.dashboard') }}" style="color: #ffcc00; text-decoration: none; font-weight: bold;">Dashboard</a>
    <a href="{{ route('logout') }}" style="color: #ffcc00; text-decoration: none; margin-left: 20px; font-weight: bold;">Logout</a>
  </nav>
</header>

<main>
  <h2>All Invoices</h2>
  @if ($invoices->count())
    <table>
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
  @else
    <p>No invoices found.</p>
  @endif
</main>

<footer>&copy; 2025 Shaded Motorworks — All rights reserved</footer>
</body>
</html>