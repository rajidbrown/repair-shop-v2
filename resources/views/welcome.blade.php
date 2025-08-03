<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shaded Motorworks | Home</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Bebas+Neue&display=swap" rel="stylesheet">
  <style>
    /* ... your CSS remains unchanged ... */
  </style>
</head>
<body>
  <header>
    <h1>SHADED MOTORWORKS</h1>
    <nav>
      <a href="{{ route('register') }}">Register</a>
      <a href="{{ route('login.customer') }}">Customer Login</a>
      <a href="{{ route('login.mechanic') }}">Mechanic Login</a>
      <a href="{{ route('login.admin') }}">Admin Login</a>
    </nav>
  </header>

  <section class="hero">
    <h2>Service That Knows The Road!</h2>
    <p>From diagnostics to full rebuilds — log in to manage your bike, book services, and get back on the road.</p>
    <a href="{{ route('login.customer') }}">Book Your Appointment</a>
  </section>

  <section class="sections">
    <a href="{{ route('about') }}" class="tile-link">
      <div class="pane">
        <h3>About Us</h3>
        <p>Shaded Motorworks is a Georgia-based motorcycle shop offering diagnostics, maintenance, and rebuilds. We’re rider-owned and operated with a passion for the road.</p>
      </div>
    </a>

    <a href="{{ route('offerings') }}" class="tile-link">
      <div class="pane">
        <h3>What We Offer</h3>
        <p>Log in to manage your bike's history, schedule services, or update your contact details. Mechanics get daily schedules and diagnostic notes. Admins manage staff and availability.</p>
      </div>
    </a>

    <a href="{{ route('faq') }}" class="tile-link">
      <div class="pane">
        <h3>FAQs</h3>
        <p><strong>Do I need an account to book?</strong> Yes — it helps us track service history.<br>
        <strong>Can I add multiple bikes?</strong> Yes — add as many bikes as you like.<br>
        <strong>Do you offer rebuilds?</strong> Absolutely. Contact us for a quote.</p>
      </div>
    </a>
  </section>

  <footer>
    <p>&copy; 2025 SHADED MOTORWORKS — Dallas, GA • 470.927.4138</p>
  </footer>
</body>
</html>