<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Customer') • Shaded Motorworks</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen bg-[var(--color-bg)] text-[var(--color-text)]">

<header class="brand-header flex justify-between items-center px-6 py-4 border-b-4 brand-border">
    <div class="flex items-center space-x-4">
        <button onclick="window.history.back()" class="btn-back">← Back</button>

        <a href="{{ route('customer.dashboard') }}" class="brand-title">
            SHADED MOTORWORKS
        </a>
    </div>

    <nav class="space-x-4 flex items-center">

        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="nav-link">Logout</button>
        </form>
    </nav>
</header>

<main class="page px-6 py-8">
    @yield('content')
</main>

<footer class="surface border-t-4 brand-border px-6 py-5 text-center muted">
    &copy; {{ date('Y') }} Shaded Motorworks — Customer
</footer>

{{-- 🔥 IMPORTANT: Scripts for each page load here --}}
@yield('scripts')

</body>
</html>