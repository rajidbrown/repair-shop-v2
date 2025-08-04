{{-- resources/views/offerings.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>What We Offer - Shaded Motorworks</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Bebas+Neue&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #0e0e0e;
      color: #eee;
    }

    header {
      background-color: #1a1a1a;
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 4px solid #f4511e;
    }

    header h1 {
      font-family: 'Bebas Neue', cursive;
      font-size: 2.4em;
      color: #ffcc00;
    }

    nav a {
      color: #ffcc00;
      text-decoration: none;
      margin-left: 20px;
      font-weight: bold;
    }

    nav a:hover {
      color: #f4511e;
    }

    main {
      padding: 40px 20px;
      max-width: 900px;
      margin: 0 auto;
    }

    h2 {
      font-family: 'Bebas Neue', cursive;
      font-size: 2.5em;
      color: #ffcc00;
      margin-bottom: 20px;
    }

    .offer-box {
      background-color: #1e1e1e;
      padding: 30px;
      border: 2px solid #f4511e;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
      line-height: 1.7;
    }

    footer {
      background-color: #1a1a1a;
      text-align: center;
      padding: 25px 10px;
      border-top: 4px solid #f4511e;
      font-size: 0.9em;
      color: #bbb;
      margin-top: 50px;
    }
  </style>
</head>
<body>
  <header>
    <h1>SHADED MOTORWORKS</h1>
    <nav>
      <a href="{{ route('home') }}">Home</a>
    </nav>
  </header>

  <main>
    <h2>What We Offer</h2>
    <div class="offer-box">
      <p>
        Our platform makes it easy for customers to manage everything related to their motorcycle — all in one place.
        After creating an account, you can register your bike, view past service history, and book appointments online.
      </p>
      <p>
        Mechanics have access to their daily schedules, detailed job notes, and diagnostic tasks. Everything is streamlined so the focus stays on performance and precision — not paperwork.
      </p>
      <p>
        Admins get full control over customer records, invoices, services offered, and internal scheduling tools.
        Our system is designed to reduce friction and boost transparency for everyone who keeps Shaded Motorworks rolling.
      </p>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 SHADED MOTORWORKS — Dallas, GA • (770) 555-9876</p>
  </footer>
</body>
</html>