@extends('layouts.customer')
@section('title', 'About Us')

@section('content')
    <h2 class="text-3xl font-bold mb-6 text-yellow-400">About Us</h2>
    <div class="bg-[var(--color-surface)] p-6 border-2 brand-border rounded-lg shadow-lg leading-relaxed">
        <p>
            Shaded Motorworks is a Georgia-based motorcycle shop that specializes in diagnostics, maintenance, custom builds, and complete engine rebuilds.
            We’re rider-owned and operated, with deep roots in the culture and community that surrounds the road.
        </p>
        <p class="mt-4">
            Whether you need help with your first bike or you're rebuilding a vintage classic, we’re here to help you stay on the road.
            We believe in transparency, craftsmanship, and giving riders full control of their service history.
        </p>
        <p class="mt-4">
            Our web portal allows customers to register their bikes, track maintenance records, and book diagnostic appointments. Mechanics receive real-time schedules and job details, while admins manage shop operations, services, and customer profiles — all in one place.
        </p>
    </div>
@endsection