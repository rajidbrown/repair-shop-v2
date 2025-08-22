{{-- resources/views/admin/mechanics/edit.blade.php --}}
@extends('layouts.admin')
@section('title', 'Edit Mechanic')

@section('content')
  <h2 class="heading-brand mb-4">Edit Mechanic</h2>

  @if (session('error'))
    <p class="text-red-500 mb-4">{{ session('error') }}</p>
  @endif

  <form action="{{ route('admin.mechanics.update', $mechanic->MechanicID) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
      <label class="block">First Name</label>
      <input type="text" name="firstName" value="{{ old('firstName', $mechanic->FirstName) }}" class="input">
      @error('firstName') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block">Last Name</label>
      <input type="text" name="lastName" value="{{ old('lastName', $mechanic->LastName) }}" class="input">
      @error('lastName') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block">Email</label>
      <input type="email" name="email" value="{{ old('email', $mechanic->Email) }}" class="input">
      @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block">Phone</label>
      <input type="text" name="phoneNumber" value="{{ old('phoneNumber', $mechanic->PhoneNumber) }}" class="input">
      @error('phoneNumber') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block">Specialty</label>
      <input type="text" name="specialty" value="{{ old('specialty', $mechanic->Specialty) }}" class="input">
      @error('specialty') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block">New Password <span class="text-xs text-gray-400">(leave blank to keep)</span></label>
      <input type="password" name="password" class="input">
      @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="btn btn-brand">Save Changes</button>
  </form>
@endsection