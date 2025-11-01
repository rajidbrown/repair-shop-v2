@extends('layouts.mechanic')

@section('title', 'Update My Info')

@section('content')
<main class="max-w-2xl mx-auto mt-10 text-white">
    <h2 class="text-3xl font-bebas text-yellow-400 mb-6 border-b-2 border-orange-600 pb-2">
        Update My Info
    </h2>

    @if (session('error'))
        <div class="bg-red-700 text-white px-4 py-3 rounded mb-4 border border-red-900 font-semibold">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-700 text-white px-4 py-3 rounded mb-4 border border-green-900 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('mechanic.info.update') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block mb-1 font-semibold text-sm text-gray-300">First Name</label>
            <input type="text" name="firstName" value="{{ old('firstName', $mechanic->FirstName) }}"
                   class="w-full bg-[#1f1f1f] border border-gray-600 rounded px-4 py-2 text-white" />
            @error('firstName')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold text-sm text-gray-300">Last Name</label>
            <input type="text" name="lastName" value="{{ old('lastName', $mechanic->LastName) }}"
                   class="w-full bg-[#1f1f1f] border border-gray-600 rounded px-4 py-2 text-white" />
            @error('lastName')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold text-sm text-gray-300">Email</label>
            <input type="email" name="email" value="{{ old('email', $mechanic->Email) }}"
                   class="w-full bg-[#1f1f1f] border border-gray-600 rounded px-4 py-2 text-white" />
            @error('email')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold text-sm text-gray-300">Phone Number</label>
            <input type="text" name="phoneNumber" value="{{ old('phoneNumber', $mechanic->PhoneNumber) }}"
                   class="w-full bg-[#1f1f1f] border border-gray-600 rounded px-4 py-2 text-white" />
            @error('phoneNumber')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold text-sm text-gray-300">Specialty</label>
            <input type="text" name="specialty" value="{{ old('specialty', $mechanic->Specialty) }}"
                   class="w-full bg-[#1f1f1f] border border-gray-600 rounded px-4 py-2 text-white" />
            @error('specialty')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold text-sm text-gray-300">
                New Password
                <span class="text-xs text-gray-400">(leave blank to keep current password)</span>
            </label>
            <input type="password" name="password"
                   class="w-full bg-[#1f1f1f] border border-gray-600 rounded px-4 py-2 text-white" />
            @error('password')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="bg-orange-600 hover:bg-orange-700 transition text-white font-semibold px-6 py-2 rounded">
            Save Changes
        </button>
    </form>
</main>
@endsection