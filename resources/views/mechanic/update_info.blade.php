@extends('layouts.app')

@section('title', 'Update Mechanic Info')

@section('content')
    <div class="container mt-5">
        <div class="card bg-dark text-light border-warning">
            <div class="card-header bg-dark border-warning">
                <h3 class="text-warning text-center" style="font-family: 'Bebas Neue', cursive;">Update Your Information</h3>
            </div>
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('mechanic.info.update') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" name="firstName" id="firstName" class="form-control bg-secondary text-light"
                               value="{{ old('firstName', $mechanic->FirstName ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" name="lastName" id="lastName" class="form-control bg-secondary text-light"
                               value="{{ old('lastName', $mechanic->LastName ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control bg-secondary text-light"
                               value="{{ old('email', $mechanic->Email ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="specialty" class="form-label">Specialty</label>
                        <input type="text" name="specialty" id="specialty" class="form-control bg-secondary text-light"
                               value="{{ old('specialty', $mechanic->Specialty ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="text" name="phoneNumber" id="phoneNumber" class="form-control bg-secondary text-light"
                               value="{{ old('phoneNumber', $mechanic->PhoneNumber ?? '') }}">
                    </div>

                    <button type="submit" class="btn btn-warning w-100 text-dark fw-bold text-uppercase">
                        Update Information
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection