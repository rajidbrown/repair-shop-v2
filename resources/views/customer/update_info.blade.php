@extends('layouts.app')

@section('title', 'Update Your Information')

@section('content')
<main>
    <section>
        <h2>Update Your Information</h2>

        @if (session('success'))
            <div class="message success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="message error">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('customer.update_info.submit') }}">
            @csrf

            <div>
                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" id="firstName" value="{{ old('firstName', $customer->FirstName ?? '') }}" required>
            </div>

            <div>
                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" id="lastName" value="{{ old('lastName', $customer->LastName ?? '') }}" required>
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email', $customer->Email ?? '') }}" required>
            </div>

            <div>
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" name="phoneNumber" id="phoneNumber" value="{{ old('phoneNumber', $customer->PhoneNumber ?? '') }}">
            </div>

            <div>
                <label for="address">Address:</label>
                <textarea name="address" id="address">{{ old('address', $customer->Address ?? '') }}</textarea>
            </div>

            <button type="submit">Update Information</button>
        </form>
    </section>
</main>
@endsection