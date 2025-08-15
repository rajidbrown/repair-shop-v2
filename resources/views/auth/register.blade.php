{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.customer')
@section('title', 'Register')

@section('content')
<section class="max-w-lg mx-auto bg-[#1e1e1e] p-8 rounded-lg border-2 border-yellow-400 shadow-lg">
    <h2 class="text-3xl font-bold text-yellow-400 font-bebas mb-6">Create an Account</h2>

    @if(session('success'))
        <p class="text-green-500 font-bold mb-4">{{ session('success') }}</p>
    @elseif($errors->any())
        <p class="text-red-500 font-bold mb-4">{{ $errors->first() }}</p>
    @endif

    <form action="{{ route('register.submit') }}" method="post" class="space-y-4">
        @csrf
        <div>
            <label for="firstName" class="block font-bold text-gray-300 mb-1">First Name:</label>
            <input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}" required class="w-full px-3 py-2 bg-gray-800 border-2 border-gray-600 rounded text-gray-200 focus:border-yellow-400 focus:outline-none">
        </div>

        <div>
            <label for="lastName" class="block font-bold text-gray-300 mb-1">Last Name:</label>
            <input type="text" id="lastName" name="lastName" value="{{ old('lastName') }}" required class="w-full px-3 py-2 bg-gray-800 border-2 border-gray-600 rounded text-gray-200 focus:border-yellow-400 focus:outline-none">
        </div>

        <div>
            <label for="email" class="block font-bold text-gray-300 mb-1">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-3 py-2 bg-gray-800 border-2 border-gray-600 rounded text-gray-200 focus:border-yellow-400 focus:outline-none">
        </div>

        <div>
            <label for="phoneNumber" class="block font-bold text-gray-300 mb-1">Phone Number:</label>
            <input type="text" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber') }}" class="w-full px-3 py-2 bg-gray-800 border-2 border-gray-600 rounded text-gray-200 focus:border-yellow-400 focus:outline-none">
        </div>

        <div>
            <label for="address" class="block font-bold text-gray-300 mb-1">Address:</label>
            <input type="text" id="address" name="address" value="{{ old('address') }}" class="w-full px-3 py-2 bg-gray-800 border-2 border-gray-600 rounded text-gray-200 focus:border-yellow-400 focus:outline-none">
        </div>

        <div>
            <label for="password" class="block font-bold text-gray-300 mb-1">Password:</label>
            <input type="password" id="password" name="password" required class="w-full px-3 py-2 bg-gray-800 border-2 border-gray-600 rounded text-gray-200 focus:border-yellow-400 focus:outline-none">
        </div>

        <div>
            <label for="confirmPassword" class="block font-bold text-gray-300 mb-1">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required class="w-full px-3 py-2 bg-gray-800 border-2 border-gray-600 rounded text-gray-200 focus:border-yellow-400 focus:outline-none">
        </div>

        <button type="submit" class="w-full bg-orange-600 hover:bg-orange-500 text-white font-bold py-3 rounded-lg uppercase">Register</button>
    </form>
</section>
@endsection