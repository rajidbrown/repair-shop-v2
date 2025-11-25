@extends('layouts.customer')

@section('title', 'My Bikes')

@section('content')
<main class="py-12 px-4 max-w-3xl mx-auto text-white">
    <section class="bg-[#1c1c1c] p-8 rounded-xl border-2 border-orange-600 shadow-lg">
        <h2 class="text-center text-3xl font-bold text-yellow-400 mb-6 font-bebas">My Bikes</h2>

        @if (session('success'))
            <div class="bg-green-800 text-green-300 border border-green-500 p-3 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if($bikes->isEmpty())
            <p class="text-center text-gray-300">You don’t have any bikes added yet.</p>
            <div class="text-center mt-4">
                <a href="{{ route('customer.bikes.create') }}" class="inline-block px-6 py-2 bg-orange-600 hover:bg-orange-700 rounded text-white font-bold uppercase transition">
                    Add Your First Bike
                </a>
            </div>
        @else
            <table class="w-full table-auto border-collapse border border-gray-700 mt-4 text-left">
                <thead>
                    <tr class="bg-gray-800">
                        <th class="border border-gray-600 px-4 py-2">Year</th>
                        <th class="border border-gray-600 px-4 py-2">Make</th>
                        <th class="border border-gray-600 px-4 py-2">Model</th>
                        <th class="border border-gray-600 px-4 py-2">Mileage</th>
                        <th class="border border-gray-600 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bikes as $bike)
                        <tr class="hover:bg-gray-700">
                            <td class="border border-gray-600 px-4 py-2">{{ $bike->Year }}</td>
                            <td class="border border-gray-600 px-4 py-2">{{ $bike->Make }}</td>
                            <td class="border border-gray-600 px-4 py-2">{{ $bike->Model }}</td>
                            <td class="border border-gray-600 px-4 py-2">{{ $bike->Mileage }}</td>
                            <td class="border border-gray-600 px-4 py-2">
                                <a href="{{ route('customer.bikes.edit', $bike->BikeID) }}" 
                                   class="px-4 py-1 bg-yellow-500 hover:bg-yellow-600 text-black font-semibold rounded">
                                   Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-center mt-6">
                <a href="{{ route('customer.bikes.create') }}" class="inline-block px-6 py-2 bg-orange-600 hover:bg-orange-700 rounded text-white font-bold uppercase transition">
                    Add New Bike
                </a>
            </div>
        @endif
    </section>
</main>
@endsection