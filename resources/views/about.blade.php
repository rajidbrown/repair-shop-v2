@extends('layouts.guest')
@section('title', 'About Us')

@section('content')
    <h2 class="heading-brand text-3xl md:text-4xl mb-6">About Us</h2>  
    
    <!-- Foreword -->
    <div class="bg-[var(--color-surface)] p-6 border-2 brand-border rounded-lg shadow-lg leading-relaxed mb-6">
        <h3 class="text-xl font-semibold mb-3">Founder's Foreword</h3>
        <p>
            Shaded Motorworks began as my long-standing dream to own and operate my own motorcycle repair shop.  
            I wanted to build a place where riders could not only get their bikes serviced, but where the entire 
            experience felt transparent, fair, and easy to navigate.
        </p>
        <p class="mt-4">
            This website is an extension of that vision — a platform designed to give customers, mechanics, and 
            administrators clear access to information without confusion or gatekeeping. Whether you're checking 
            your service history or booking work for your bike, my goal is to make the process as straightforward 
            and rider-friendly as possible. <br/> - RJ Brown.
        </p>
    </div>

    <!-- About Shaded Motorworks -->
    <div class="bg-[var(--color-surface)] p-6 border-2 brand-border rounded-lg shadow-lg leading-relaxed">
        <h3 class="text-xl font-semibold mb-3">Who We Are</h3>
        <p>
            Shaded Motorworks is a Georgia-based motorcycle repair shop specializing in diagnostics, maintenance, 
            and repair for both road bikes and street bikes. We also offer tuning, fabrication, and custom work 
            upon request.
        </p>

        <p class="mt-4">
            We’re committed to fairness, transparency, and genuine craftsmanship. Our philosophy is simple: 
            treat riders with respect, keep them informed, and share knowledge whenever possible — using bikes 
            as the catalyst for building better community and better experiences.
        </p>

        <p class="mt-4">
            Through our online portal, customers can register their bikes, view service records, and book 
            appointments. Mechanics receive detailed job breakdowns and real-time schedules, while admins manage 
            shop operations seamlessly — all in one place.
        </p>
    </div>
@endsection