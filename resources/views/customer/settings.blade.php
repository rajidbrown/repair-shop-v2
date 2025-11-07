@extends('layouts.customer')

@section('title', 'Settings')

@section('content')
  <div class="max-w-3xl mx-auto px-6 py-12 text-center">
    <h2 class="text-3xl font-heading text-yellow-400 mb-8 border-b-4 border-orange-600 pb-2">
      Manage Your Account
    </h2>

    <div class="bg-gray-900 border-2 border-dashed border-orange-600 rounded-xl p-8 text-gray-300">
      <p class="text-lg mb-4">This page will soon let you:</p>
      <ul class="text-left list-disc list-inside space-y-2 text-gray-400">
        <li>Change your password</li>
        <li>Adjust notification preferences</li>
        <li>Request account deletion</li>
        <li>Contact support</li>
      </ul>
      <p class="mt-6 italic text-sm text-gray-500">Stay tuned!</p>
    </div>
  </div>
@endsection