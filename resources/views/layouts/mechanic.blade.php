<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Customer Dashboard') • Shaded Motorworks</title>

    {{-- Load Vite assets --}}
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-black text-yellow-400">

<header class="flex justify-between items-center border-b-2 border-red-600 px-6 py-4">
    <h1 class="text-2xl font-bold">WELCOME, {{ Auth::guard('customer')->user()->FirstName ?? 'Customer' }}!</h1>
    <a href="{{ route('logout') }}" class="text-yellow-400 hover:underline">Logout</a>
</header>

<main class="p-6">
    @yield('content')
</main>

<footer class="border-t-2 border-red-600 px-6 py-4 text-center text-yellow-400">
    &copy; {{ date('Y') }} Shaded Motorworks — Powered by Precision.
</footer>

</body>
</html>