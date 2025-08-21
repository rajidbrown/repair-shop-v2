{{-- resources/views/admin/add_mechanic.blade.php --}}
@extends('layouts.admin')
@section('title', 'Add Mechanic')

@section('content')
  <section class="page max-w-2xl mx-auto">
    <h2 class="heading-brand mb-4">Add Mechanic</h2>

    {{-- Flash messages --}}
    @if (session('success'))
      <div class="alert">{{ session('success') }}</div>
    @endif
    @if (session('error'))
      <div class="alert alert-error">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
      <div class="alert alert-error">
        <ul class="list-disc pl-6">
          @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="card">
      <form method="POST" action="{{ route('admin.add_mechanic.store') }}" class="space-y-4">
        @csrf

        <div>
          <label class="label" for="firstName">First Name</label>
          <input class="input" id="firstName" name="firstName" type="text" value="{{ old('firstName') }}" required>
        </div>

        <div>
          <label class="label" for="lastName">Last Name</label>
          <input class="input" id="lastName" name="lastName" type="text" value="{{ old('lastName') }}" required>
        </div>

        <div>
          <label class="label" for="email">Email</label>
          <input class="input" id="email" name="email" type="email" value="{{ old('email') }}" required>
        </div>

        <div>
          <label class="label" for="password">Password</label>
          <input class="input" id="password" name="password" type="password" required>
        </div>

        <div>
          <label class="label" for="specialty">Specialty</label>
          <input class="input" id="specialty" name="specialty" type="text" value="{{ old('specialty') }}">
        </div>

        <div>
          <label class="label" for="phoneNumber">Phone Number</label>
          <input class="input" id="phoneNumber" name="phoneNumber" type="text" value="{{ old('phoneNumber') }}">
        </div>

        <div class="pt-2">
          <button type="submit" class="btn btn-primary">Add Mechanic</button>
        </div>
      </form>
    </div>
  </section>
@endsection