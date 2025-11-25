@extends('layouts.customer')

@section('title', 'Edit Bike')

@section('content')
<main class="py-12 px-4 max-w-xl mx-auto text-white">
    <section class="bg-[#1c1c1c] p-8 rounded-xl border-2 border-orange-600 shadow-lg">
        <h2 class="text-center text-3xl font-bold text-yellow-400 mb-6 font-bebas">Edit Bike Info</h2>

        @if (session('success'))
            <div class="bg-green-800 text-green-300 border border-green-500 p-3 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-800 text-red-300 border border-red-500 p-3 rounded mb-4 text-center">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('customer.bikes.update', $bike->BikeID) }}">
            @csrf

            <div class="mb-4">
                <label for="year" class="block font-semibold mb-1">Year:</label>
                <input type="number" id="year" name="year" required
                       value="{{ old('year', $bike->Year) }}"
                       class="w-full p-3 bg-[#2a2a2a] border border-gray-600 rounded text-white focus:outline-none focus:border-orange-500">
            </div>

            <div class="mb-4">
                <label for="make" class="block font-semibold mb-1">Make:</label>
                <input type="text" id="make" name="make" required
                       value="{{ old('make', $bike->Make) }}"
                       class="w-full p-3 bg-[#2a2a2a] border border-gray-600 rounded text-white focus:outline-none focus:border-orange-500">
            </div>

            <div class="mb-4">
                <label for="model" class="block font-semibold mb-1">Model:</label>
                <input type="text" id="model" name="model" required
                       value="{{ old('model', $bike->Model) }}"
                       class="w-full p-3 bg-[#2a2a2a] border border-gray-600 rounded text-white focus:outline-none focus:border-orange-500">
            </div>

            <div class="mb-6">
                <label for="mileage" class="block font-semibold mb-1">Mileage:</label>
                <input type="text" id="mileage" name="mileage" required
                       value="{{ old('mileage', $bike->Mileage) }}"
                       class="w-full p-3 bg-[#2a2a2a] border border-gray-600 rounded text-white focus:outline-none focus:border-orange-500">
            </div>

            <button type="submit"
                    class="w-full py-3 bg-orange-600 hover:bg-orange-700 rounded text-white font-bold uppercase transition">
                Update Bike Info
            </button>
        </form>
    </section>
</main>
@endsection