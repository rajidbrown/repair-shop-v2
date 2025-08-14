<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Customer') • Shaded Motorworks</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-[var(--color-bg)] text-[var(--color-text)]">
<header class="brand-header">
    <h1 class="brand-title">SHADED MOTORWORKS</h1>
    <nav class="space-x-4">
        <a class="nav-link" href="{{ route('customer.dashboard') }}">Dashboard</a>
    </nav>
</header>

<main class="page">
    @yield('content')
</main>

<footer class="surface border-t-4 brand-border px-6 py-5 text-center muted">
    &copy; {{ date('Y') }} Shaded Motorworks
</footer>
</body>
</html>