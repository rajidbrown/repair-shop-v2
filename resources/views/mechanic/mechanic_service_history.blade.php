@extends('layouts.app')

@section('title', 'Service History - Shaded Motorworks')

@section('content')
<style>
    body {
        background-color: #1c1c1c;
        color: #ddd;
        font-family: 'Roboto', sans-serif;
        margin: 0;
    }

    main {
        max-width: 800px;
        margin: 40px auto;
        padding: 30px;
        background: #2a2a2a;
        border: 2px solid #f4511e;
        border-radius: 12px;
    }

    h2 {
        text-align: center;
        font-family: 'Bebas Neue', cursive;
        color: #ffcc00;
        margin-bottom: 30px;
    }

    .record {
        background: #1f1f1f;
        margin-bottom: 20px;
        padding: 15px;
        border-left: 4px solid #ffcc00;
        border-radius: 6px;
    }

    .record strong {
        color: #fff;
    }

    .record em {
        color: #ccc;
    }

    .success-message {
        background-color: #2e7d32;
        color: #fff;
        padding: 12px;
        border-radius: 6px;
        margin-bottom: 20px;
        text-align: center;
        font-weight: bold;
        border: 1px solid #1b5e20;
    }
</style>

<main>
    <h2>Completed Appointments</h2>

    @if (session('status_updated'))
        <div class="success-message">
            Appointment status updated successfully!
        </div>
    @endif

    @if ($history->isEmpty())
        <p>No completed services found.</p>
    @else
        @foreach ($history as $item)
            <div class="record">
                <strong>Date:</strong> {{ 