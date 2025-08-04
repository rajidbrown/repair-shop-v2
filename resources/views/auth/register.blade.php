<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - Shaded Motorworks</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Bebas+Neue&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #0e0e0e;
      color: #eee;
      line-height: 1.6;
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
      text-align: center;
    }
    section {
      background: #1e1e1e;
      max-width: 500px;
      margin: 0 auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
      border: 2px solid #ffcc00;
    }
    h2 {
      font-family: 'Bebas Neue', cursive;
      color: #ffcc00;
      font-size: 2em;
      margin-bottom: 20px;
    }
    .error, .success {
      font-weight: bold;
      margin-bottom: 15px;
    }
    .error {
      color: #e74c3c;
    }
    .success {
      color: #2ecc71;
    }
    form div {
      margin-bottom: 15px;
      text-align: left;
    }
    label {
      font-weight: bold;
      color: #ddd;
      display: block;
      margin-bottom: 5px;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      background-color: #333;
      border: 2px solid #555;
      color: #ddd;
      border-radius: 6px;
    }
    input:focus {
      outline: none;
      border-color: #ffcc00;
    }
    button {
      background-color: #f4511e;
      color: #fff;
      padding: 12px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      text-transform: uppercase;
      width: 100%;
      transition: background 0.3s;
    }
    button:hover {
      background-color: #e03e0f;
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
    <section>
      <h2>Create an Account</h2>

      @if(session('success'))
        <p class="success">{{ session('success') }}</p>
      @elseif($errors->any())
        <p class="error">{{ $errors->first() }}</p>
      @endif

      <form action="{{ route('register.submit') }}" method="post">
        @csrf
        <div>
          <label for="firstName">First Name:</label>
          <input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}" required>
        </div>
        <div>
          <label for="lastName">Last Name:</label>
          <input type="text" id="lastName" name="lastName" value="{{ old('lastName') }}" required>
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
          <label for="phoneNumber">Phone Number:</label>
          <input type="text" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber') }}">
        </div>
        <div>
          <label for="address">Address:</label>
          <input type="text" id="address" name="address" value="{{ old('address') }}">
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div>
          <label for="confirmPassword">Confirm Password:</label>
          <input type="password" id="confirmPassword" name="confirmPassword" required>
        </div>
        <button type="submit">Register</button>
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 SHADED MOTORWORKS &mdash; Dallas, GA • (770) 555-9876</p>
  </footer>
</body>
</html>