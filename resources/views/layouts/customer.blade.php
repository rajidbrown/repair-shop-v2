<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Shaded Motorworks</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="bg-[#0e0e0e] text-white">
    <header class="bg-[#1a1a1a] border-b-4 border-orange-600 p-4 flex justify-between items-center">
        <h1 class="text-yellow-400 font-bebas text-2xl">SHADED MOTORWORKS</h1>
        <nav>
            <a href="{{ route('customer.dashboard') }}" class="text-yellow-400 hover:text-orange-500">Dashboard</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-[#1a1a1a] border-t-4 border-orange-600 p-4 text-center text-gray-400">
        &copy; {{ date('Y') }} Shaded Motorworks
    </footer>
</body>
</html>