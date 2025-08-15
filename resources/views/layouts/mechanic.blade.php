<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Mechanic') • Shaded Motorworks</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-[var(--color-bg)] text-[var(--color-text)]">
<header class="brand-header flex justify-between items-center">
    <div class="flex items-center space-x-4">
        <!-- Back Button -->
        <button onclick="window.history.back()" class="btn-back">← Back</button>

        <!-- Brand Title as Home Link -->
        <a href="{{ route('home') }}" class="brand-title">
            SHADED MOTORWORKS
        </a>
    </div>

    <!-- Navigation -->
    <nav class="space-x-4">
        <a class="nav-link" href="{{ route('mechanic.dashboard') }}">Dashboard</a>
        <a class="nav-link" href="{{ route('login.mechanic') }}">Logout</a>
    </nav>
</header>

<main class="page">
    @yield('content')
</main>

<footer class="surface border-t-4 brand-border px-6 py-5 text-center muted">
    &copy; {{ date('Y') }} Shaded Motorworks — Mechanic
</footer>
</body>
</html>