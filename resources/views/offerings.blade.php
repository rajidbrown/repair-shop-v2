{{-- resources/views/offerings.blade.php --}}
@extends('layouts.guest')
@section('title', 'What We Offer')

@section('content')
<h2 class="heading-brand text-3xl md:text-4xl mb-6">What We Offer</h2>

<div class="bg-[var(--color-surface)] p-6 border-2 brand-border rounded-lg shadow-lg space-y-6 leading-relaxed">
    <p>
        At <span class="font-semibold text-[var(--color-accent)]">Shaded Motorworks</span>, we work on <strong>all kinds of motorcycles</strong> — cruisers, sport bikes, dual sports, dirt bikes, and vintage builds.
        Whether it’s routine maintenance or a long-term project, our team is equipped to handle it.
    </p>

    <p>
        Our services are designed to match what’s available in our system when you book an appointment. We focus on transparency, safety, and efficiency so you always know what’s happening with your bike.
    </p>
</div>

{{-- Services List --}}
<div class="space-y-6 mt-8">
    {{-- Engine & Transmission --}}
    <div class="bg-[var(--color-surface)] border-2 brand-border p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-semibold text-yellow-400 mb-2">Engine & Transmission</h3>
        <p class="text-gray-300 mb-1">
            Inspection and repair of engine, transmission, and drivetrain systems.
        </p>
        <p class="muted text-sm">
            <strong>Price:</strong> $150 · <strong>Estimated Time:</strong> 60 minutes
        </p>
    </div>

    {{-- Brakes & Suspension --}}
    <div class="bg-[var(--color-surface)] border-2 brand-border p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-semibold text-yellow-400 mb-2">Brakes & Suspension</h3>
        <p class="text-gray-300 mb-1">
            Brake pad replacement, rotor resurfacing, and suspension tuning.
        </p>
        <p class="muted text-sm">
            <strong>Price:</strong> $120 · <strong>Estimated Time:</strong> 45 minutes
        </p>
    </div>

    {{-- Electrical Systems --}}
    <div class="bg-[var(--color-surface)] border-2 brand-border p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-semibold text-yellow-400 mb-2">Electrical Systems</h3>
        <p class="text-gray-300 mb-1">
            Diagnosis and repair of electrical components, wiring issues, lighting, and battery performance.
        </p>
        <p class="muted text-sm">
            <strong>Price:</strong> $90 · <strong>Estimated Time:</strong> 30 minutes
        </p>
    </div>

    {{-- Final Safety Inspection --}}
    <div class="bg-[var(--color-surface)] border-2 brand-border p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-semibold text-yellow-400 mb-2">Final Safety Inspection</h3>
        <p class="text-gray-300 mb-1">
            Complete end-to-end safety check to confirm your bike is ready to ride after service. <i>*Included with any service performed at Shaded Motorworks.</i>
        </p>
        <p class="muted text-sm">
            <strong>Price:</strong> $60 · <strong>Estimated Time:</strong> 20 minutes
        </p>
    </div>
</div>
@endsection