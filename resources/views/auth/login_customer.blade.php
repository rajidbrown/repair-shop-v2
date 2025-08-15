{{-- resources/views/auth/login_customer.blade.php --}}
@extends('layouts.customer')
@section('title', 'Customer Login')

@section('content')
  <section class="page">
    <div class="card max-w-lg mx-auto">
      <div class="card-header">
        <h1 class="heading-brand">Customer Login</h1>
      </div>

      @if(session('error'))
        <p class="error mb-4">{{ session('error') }}</p>
      @endif

      <form method="POST" action="{{ route('customer.login.submit') }}" class="space-y-4">
        @csrf

        <div>
          <label for="email" class="label">Email</label>
          <input id="email" name="email" type="email" required class="input w-full">
        </div>

        <div>
          <label for="password" class="label">Password</label>
          <input id="password" name="password" type="password" required class="input w-full">
        </div>

        <button type="submit" class="btn btn-primary w-full">Login</button>
      </form>

      <p class="muted mt-4 text-center">
        Don’t have an account?
        <a href="{{ route('register') }}" class="link">Register here</a>
      </p>
    </div>
  </section>
@endsection