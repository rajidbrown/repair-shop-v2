{{-- resources/views/auth/login_mechanic.blade.php --}}
@extends('layouts.mechanic')
@section('title', 'Mechanic Login')

@section('content')
<section class="page">
  <div class="card max-w-lg mx-auto">
    <div class="card-header">
      <h1 class="heading-brand">Mechanic Login</h1>
    </div>

    @if ($errors->has('login_error'))
      <div class="alert alert-error">
        {{ $errors->first('login_error') }}
      </div>
    @endif

    <form method="POST" action="{{ route('mechanic.login.submit') }}" class="space-y-4">
      @csrf

      <div>
        <label for="email" class="label">Email</label>
        <input id="email" name="email" type="email" class="input" required value="{{ old('email') }}">
      </div>

      <div>
        <label for="password" class="label">Password</label>
        <input id="password" name="password" type="password" class="input" required>
      </div>

      <button type="submit" class="btn btn-primary w-full">Login</button>
    </form>
  </div>
</section>
@endsection