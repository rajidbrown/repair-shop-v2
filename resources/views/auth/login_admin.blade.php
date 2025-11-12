{{-- resources/views/auth/login_admin.blade.php --}}
@extends('layouts.admin')
@section('title', 'Admin Login')

@section('content')
<section class="page">
  <div class="card max-w-lg mx-auto">
    <div class="card-header">
      <h1 class="heading-brand">Admin Login</h1>
    </div>

    @if(session('error'))
      <div class="alert alert-error">
        {{ session('error') }}
      </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
      @csrf

      <div>
        <label for="username" class="label">Username</label>
        <input id="username" name="username" type="text" class="input" required value="{{ old('username') }}">
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