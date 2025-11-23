{{-- resources/views/faqs.blade.php --}}
@extends('layouts.guest')
@section('title', 'FAQs')

@section('content')
<h2 class="heading-brand text-3xl md:text-4xl mb-6">Frequently Asked Questions</h2>

<div class="space-y-6">

    <div class="bg-[var(--color-surface)] p-6 border-2 brand-border rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold text-yellow-400 mb-2">Do I need an account to book an appointment?</h3>
        <p class="text-gray-300">
            Yes. Creating an account lets you manage your bikes, view past services, receive updates, 
            and book appointments with accurate information tied to your bike.
        </p>
    </div>

    <div class="bg-[var(--color-surface)] p-6 border-2 brand-border rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold text-yellow-400 mb-2">What kinds of bikes do you work on?</h3>
        <p class="text-gray-300">
            We service most road and street motorcycles — sportbikes, cruisers, standards, dual sports, 
            and older carbureted models. For specialty or uncommon builds, feel free to contact us first.
        </p>
    </div>

    <div class="bg-[var(--color-surface)] p-6 border-2 brand-border rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold text-yellow-400 mb-2">Can I add multiple bikes to my account?</h3>
        <p class="text-gray-300">
            Absolutely. You can register, track, and manage as many motorcycles as you own under one login.
        </p>
    </div>

    <div class="bg-[var(--color-surface)] p-6 border-2 brand-border rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold text-yellow-400 mb-2">How do diagnostics work?</h3>
        <p class="text-gray-300">
            When you book a diagnostic appointment, we inspect your bike, identify issues, and provide 
            a clear breakdown of recommended repairs. You'll see notes and updates right in your dashboard.
        </p>
    </div>

    <div class="bg-[var(--color-surface)] p-6 border-2 brand-border rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold text-yellow-400 mb-2">Do you offer rebuilds or custom work?</h3>
        <p class="text-gray-300">
            Yes. We handle full engine rebuilds, partial tear-downs, tuning, and fabrication requests. 
            Custom projects are priced individually based on labor and parts.
        </p>
    </div>

    <div class="bg-[var(--color-surface)] p-6 border-2 brand-border rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold text-yellow-400 mb-2">How will I know when my bike is ready?</h3>
        <p class="text-gray-300">
            You’ll receive updates through your dashboard and email as work progresses. 
            Once your bike is complete, we’ll notify you immediately with pick-up details.
        </p>
    </div>

    <div class="bg-[var(--color-surface)] p-6 border-2 brand-border rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold text-yellow-400 mb-2">What if I need to reschedule or cancel?</h3>
        <p class="text-gray-300">
            You can reschedule directly from your dashboard or contact us if something changes. 
            We just ask for reasonable notice so we can keep the schedule running smoothly.
        </p>
    </div>

</div>
@endsection