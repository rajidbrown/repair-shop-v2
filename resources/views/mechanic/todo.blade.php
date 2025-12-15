@extends('layouts.mechanic')

@section('title', 'Mechanic To-Do List - Shaded Motorworks')

@section('content')
<main class="py-10 px-4 max-w-7xl mx-auto text-white">

<section class="bg-[#1f1f1f] p-6 rounded-xl border-2 border-orange-600 shadow-lg">
    <h2 class="text-3xl font-bold text-yellow-400 mb-6 text-center border-b-2 border-orange-600 pb-2">
        Today's To-Do List
    </h2>

    @if(session('success'))
        <div class="bg-green-700 text-white px-4 py-3 rounded-md mb-6 text-center font-semibold">
            {{ session('success') }}
        </div>
    @endif

    @if($appointments->isEmpty())
        <p class="text-center text-gray-300">No appointments to display.</p>
    @else
    <div class="overflow-x-auto">
        <table class="w-full bg-[#2a2a2a] border-collapse">
            <thead>
                <tr class="bg-[#3b4a5a] text-yellow-400 uppercase text-sm">
                    <th class="p-3 text-left">Date</th>
                    <th class="p-3 text-left">Time</th>
                    <th class="p-3 text-left">Customer</th>
                    <th class="p-3 text-left">Service</th>
                    <th class="p-3 text-left">Bike</th>
                    <th class="p-3 text-left">Action</th>
                </tr>
            </thead>

            <tbody>
            @foreach($appointments as $appt)
                <tr class="border-t border-gray-700 align-top">
                    <td class="p-3">
                        {{ \Carbon\Carbon::parse($appt->AppointmentDateTime)->format('M j, Y') }}
                    </td>

                    <td class="p-3">
                        {{ \Carbon\Carbon::parse($appt->AppointmentDateTime)->format('g:i A') }}
                    </td>

                    <td class="p-3">
                        {{ $appt->FirstName }} {{ $appt->LastName }}
                    </td>

                    <td class="p-3">
                        {{ $appt->ServiceName }}
                    </td>

                    <td class="p-3">
                        {{ trim("{$appt->Year} {$appt->Make} {$appt->Model}") ?: 'N/A' }}
                    </td>

                    <td class="p-3">
                        <form method="POST" action="{{ route('mechanic.todo.update') }}">
                            @csrf

                            <input type="hidden" name="appointment_id" value="{{ $appt->AppointmentID }}">

                            <select name="status"
                                onchange="toggleNotes(this)"
                                class="bg-[#1c1c1c] text-white border border-gray-500 rounded px-2 py-1 mb-2 w-full">
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

                            <textarea
                                name="notes"
                                class="notes-field bg-[#1c1c1c] text-white border border-gray-500 rounded p-2 w-full text-sm mb-2"
                                placeholder="Completion notes for customer..."
                                style="{{ $appt->Status === 'Completed' ? '' : 'display:none;' }}"
                            >{{ $appt->Notes }}</textarea>

                            <button type="submit"
                                class="bg-orange-600 text-white px-3 py-1 rounded hover:bg-orange-700 w-full">
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

<script>
function toggleNotes(select) {
    const textarea = select.closest('form').querySelector('.notes-field');
    textarea.style.display = select.value === 'Completed' ? 'block' : 'none';
}
</script>

</main>
@endsection
