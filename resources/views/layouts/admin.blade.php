<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') • Shaded Motorworks</title>

    {{-- Vite: loads Tailwind + brand styles --}}
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-[var(--color-bg)] text-[var(--color-text)]">
   <header class="brand-header flex justify-between items-center">
    <div class="flex items-center space-x-4">
        <!-- Dashboard Button -->
        <a href="{{ route('admin.dashboard') }}" class="btn-back">
            Dashboard
        </a>

        <!-- Brand Title as Home Link -->
        <a href="{{ route('home') }}" class="brand-title">
            SHADED MOTORWORKS
        </a>
    </div>

    <!-- Navigation -->
    <nav class="space-x-4">
        <a class="nav-link" href="{{ route('login.admin') }}">Logout</a>
    </nav>
</header>


    <main class="page">
        @yield('content')
    </main>

    <footer class="surface border-t-4 brand-border px-6 py-5 text-center muted">
        &copy; {{ date('Y') }} Shaded Motorworks — Admin
    </footer>
</body>
</html>