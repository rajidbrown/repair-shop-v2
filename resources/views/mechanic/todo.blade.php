@extends('layouts.mechanic')

@section('title', 'Mechanic To-Do List - Shaded Motorworks')

@section('content')
<main class="py-10 px-4 max-w-7xl mx-auto text-white">

    <!-- Header -->
    <section class="bg-[#1f1f1f] p-6 rounded-xl border-2 border-orange-600 shadow-lg">
        <h2 class="text-3xl font-bold text-yellow-400 mb-6 font-bebas border-b-2 border-orange-600 pb-2 text-center">
            Today's To-Do List
        </h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-700 text-white px-4 py-3 rounded-md mb-6 text-center font-semibold border border-green-900">
                {{ session('success') }}
            </div>
        @endif

        <!-- Empty State -->
        @if($appointments->isEmpty())
            <p class="text-center text-gray-300">No appointments to display.</p>
        @else

            <div class="overflow-x-auto">
                <table class="w-full border-collapse bg-[#2a2a2a]">
                    <thead>
                        <tr class="bg-[#3b4a5a] text-yellow-400 uppercase text-sm">
                            <th class="p-3 text-left">Date</th>
                            <th class="p-3 text-left">Time</th>
                            <th class="p-3 text-left">Customer</th>
                            <th class="p-3 text-left">Service</th>
                            <th class="p-3 text-left">Bike</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($appointments as $appt)
                            <tr class="border-t border-gray-700 hover:bg-[#3a3a3a] transition">

                                <!-- Date -->
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($appt->AppointmentDateTime)->format('M j, Y') }}
                                </td>

                                <!-- Time -->
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($appt->AppointmentDateTime)->format('g:i A') }}
                                </td>

                                <!-- Customer -->
                                <td class="p-3">
                                    {{ $appt->FirstName }} {{ $appt->LastName }}
                                </td>

                                <!-- Service -->
                                <td class="p-3">
                                    {{ $appt->ServiceName }}
                                </td>

                                <!-- Bike -->
                                <td class="p-3">
                                    {{ trim("{$appt->Year} {$appt->Make} {$appt->Model}") ?: 'N/A' }}
                                </td>

                                <!-- Status -->
                                <td class="p-3 font-semibold">
                                    @if($appt->Status === 'Started')
                                        <span class="text-blue-400">In Progress</span>
                                    @elseif($appt->Status === 'Completed')
                                        <span class="text-green-400">Completed</span>
                                    @else
                                        <span class="text-gray-300">Not Started</span>
                                    @endif
                                </td>

                                <!-- Action -->
                                <td class="p-3">
                                    <form method="POST" action="{{ route('mechanic.todo.update') }}" class="flex items-center gap-2">
                                        @csrf

                                        <input type="hidden" name="appointment_id" value="{{ $appt->AppointmentID }}">

                                        <select name="status"
                                            class="bg-[#1c1c1c] text-white border border-gray-500 rounded px-2 py-1 text-sm">
                                            <option value="Not Started" @selected($appt->Status === 'Not Started' || $appt->Status === null)>
                                                Not Started
                                            </option>
                                            <option value="Started" @selected($appt->Status === 'Started')>
                                                In Progress
                                            </option>
                                            <option value="Completed" @selected($appt->Status === 'Completed')>
                                                Completed
                                            </option>
                                        </select>

                                        <button type="submit"
                                            class="bg-orange-600 text-white px-3 py-1 rounded hover:bg-orange-700 transition font-semibold text-sm">
                                            Update
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        @endif
    </section>

</main>
@endsection