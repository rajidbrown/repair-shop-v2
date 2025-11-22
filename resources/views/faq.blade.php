@extends('layouts.customer')
@section('title', 'FAQs')

@section('content')
    <h2 class="text-3xl font-bold mb-6 text-yellow-400 text-center">
        Frequently Asked Questions
    </h2>

    <div class="bg-[var(--color-surface)] p-6 border-2 brand-border rounded-lg shadow-lg space-y-8">
        <div class="faq">
            <h3 class="text-lg font-semibold text-[var(--color-accent)]">Do I need an account to book?</h3>
            <p class="text-gray-300">Yes — it helps us track service history and communicate effectively with you.</p>
        </div>

        <div class="faq">
            <h3 class="text-lg font-semibold text-[var(--color-accent)]">Can I add multiple bikes?</h3>
            <p class="text-gray-300">Absolutely! You can register and manage as many bikes as you'd like under one account.</p>
        </div>

        <div class="faq">
            <h3 class="text-lg font-semibold text-[var(--color-accent)]">Do you offer rebuilds?</h3>
            <p class="text-gray-300">
                Yes. We offer full engine and structural rebuilds. Contact us for a personalized quote based on your bike's needs.
            </p>
        </div>
    </div>
@endsection