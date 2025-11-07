@extends('layouts.customer')

@section('title', 'Update Your Information')

@section('content')
<main class="max-w-2xl mx-auto px-6 py-12">
    <section class="bg-gray-900 border border-orange-600 rounded-xl p-8 shadow-md">
        <h2 class="text-3xl font-heading text-yellow-400 mb-6 border-b border-orange-600 pb-2">
            Update Your Information
        </h2>

        @if (session('success'))
            <div class="bg-green-700 text-white px-4 py-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-700 text-white px-4 py-2 mb-4 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('customer.update_info.submit') }}" class="space-y-5">
            @csrf

            <div>
                <label for="firstName" class="block text-sm font-bold mb-1">First Name</label>
                <input type="text" name="firstName" id="firstName" class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-600 rounded"
                       value="{{ old('firstName', $customer->FirstName ?? '') }}" required>
            </div>

            <div>
                <label for="lastName" class="block text-sm font-bold mb-1">Last Name</label>
                <input type="text" name="lastName" id="lastName" class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-600 rounded"
                       value="{{ old('lastName', $customer->LastName ?? '') }}" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-bold mb-1">Email</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-600 rounded"
                       value="{{ old('email', $customer->Email ?? '') }}" required>
            </div>

            <div>
                <label for="phoneNumber" class="block text-sm font-bold mb-1">Phone Number</label>
                <input type="text" name="phoneNumber" id="phoneNumber" class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-600 rounded"
                       value="{{ old('phoneNumber', $customer->PhoneNumber ?? '') }}">
            </div>

            <div>
                <label for="address" class="block text-sm font-bold mb-1">Address</label>
                <textarea name="address" id="address" rows="3" class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-600 rounded">{{ old('address', $customer->Address ?? '') }}</textarea>
            </div>

            <div class="pt-4">
                <button type="submit" class="bg-orange-600 hover:bg-orange-500 text-white font-bold px-6 py-2 rounded">
                    Update Information
                </button>
            </div>
        </form>
    </section>
</main>
@endsection