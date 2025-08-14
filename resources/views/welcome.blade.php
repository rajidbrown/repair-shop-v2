{{-- resources/views/welcome.blade.php --}}
@extends('layouts.customer')
@section('title', 'Home')

@section('content')
  <section class="page">
    {{-- Hero --}}
    <div class="card mb-8">
      <div class="card-header">
        <h1 class="heading-brand">Serviceee wowwwww That Knows The Road!</h1>
      </div>
      <p class="muted">
        From diagnostics to full rebuilds — log in to manage your bike, book services, and get back on the road.
      </p>
      <div class="mt-4">
        <a href="{{ route('login.customer') }}" class="btn btn-primary">Book Your Appointment</a>
      </div>
    </div>

    {{-- Three tiles --}}
    <div class="grid gap-6 md:grid-cols-3">
      <a href="{{ route('about') }}" class="block">
        <div class="card h-full">
          <h3 class="heading-brand mb-2">About Us</h3>
          <p class="muted">
            Shaded Motorworks is a Georgia‑based motorcycle shop offering diagnostics, maintenance, and rebuilds.
            We’re rider‑owned and operated with a passion for the road.
          </p>
        </div>
      </a>

      <a href="{{ route('offerings') }}" class="block">
        <div class="card h-full">
          <h3 class="heading-brand mb-2">What We Offer</h3>
          <p class="muted">
            Log in to manage your bike’s history, schedule services, or update your contact details.
            Mechanics get daily schedules and diagnostic notes. Admins manage staff and availability.
          </p>
        </div>
      </a>

      <a href="{{ route('faq') }}" class="block">
        <div class="card h-full">
          <h3 class="heading-brand mb-2">FAQs</h3>
          <p class="muted">
            <strong>Do I need an account to book?</strong> Yes — it helps us track service history.<br>
            <strong>Can I add multiple bikes?</strong> Yes — add as many bikes as you like.<br>
            <strong>Do you offer rebuilds?</strong> Absolutely. Contact us for a quote.
          </p>
        </div>
      </a>
    </div>

    <p class="muted mt-10 text-sm">&copy; {{ date('Y') }} SHADED MOTORWORKS — Dallas, GA • 470.927.4138</p>
  </section>
@endsection