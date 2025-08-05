<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Service History - Shaded Motorworks</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Bebas+Neue&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      background-color: #0e0e0e;
      color: #eee;
      font-family: 'Roboto', sans-serif;
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

    header h1 {
      font-family: 'Bebas Neue', cursive;
      font-size: 2em;
      margin: 0;
    }

    .nav a {
      color: #ffcc00;
      margin-left: 20px;
      font-weight: bold;
      text-decoration: none;
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
      font-size: 2.4em;
      color: #ffcc00;
      margin-bottom: 30px;
    }

    ul {
      list-style: none;
      padding: 0;
    }

    li {
      background-color: #1f1f1f;
      border: 2px solid #f4511e;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 12px;
    }

    li strong {
      color: #ffcc00;
    }

    li em {
      color: #ccc;
      display: block;
      margin-top: 8px;
    }

    footer {
      text-align: center;
      padding: 20px;
      background-color: #1a1a1a;
      border-top: 4px solid #f4511e;
      color: #bbb;
      font-size: 0.95em;
    }
  </style>
</head>
<body>
  <header>
    <h1>SHADED MOTORWORKS</h1>
    <div class="nav">
      <a href="{{ route('customer.dashboard') }}">Dashboard</a>
      <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" style="background:none;border:none;color:#ffcc00;cursor:pointer;font-weight:bold;">Logout</button>
      </form>
    </div>
  </header>

  <main>
    <h2>Service History</h2>
    @if ($history->isEmpty())
      <p style="text-align: center;">You don't have any completed services yet.</p>
    @else
      <ul>
        @foreach ($history as $item)
          <li>
            <strong>Date:</strong> {{ $item->AppointmentDateTime }} |
            <strong>Service:</strong> {{ $item->ServiceName }}
            <em>{{ $item->Notes ?? 'No notes' }}</em>
          </li>
        @endforeach
      </ul>
    @endif
  </main>

  <footer>
    <p>&copy; 2025 Shaded Motorworks — Dallas, GA • (770) 555-9876</p>
  </footer>
</body>
</html>