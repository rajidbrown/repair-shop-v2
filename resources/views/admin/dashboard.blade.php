{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')
  {{-- Quick actions --}}
  <section class="mb-10">
    <h2 class="heading-brand mb-4">Admin Quick Access</h2>

    <div class="tiles">
      <a class="tile text-center" href="{{ route('admin.customers') }}">View Customers</a>
      <a class="tile text-center" href="{{ route('admin.appointments.upcoming') }}">Upcoming Appointments</a>
      <a class="tile text-center" href="{{ route('admin.invoices') }}">View Invoices</a>
      <a class="tile text-center" href="{{ route('admin.settings') }}">Settings</a>

      {{-- Actions --}}
      <a class="tile text-center" href="{{ route('admin.add_mechanic.form') }}">Add Mechanic</a>
      <a class="tile text-center" href="{{ route('admin.schedule.create') }}">Create Schedule</a>
      <a class="tile text-center" href="{{ route('admin.schedule.edit') }}">Manage Schedules</a>
    </div>
  </section>

  {{-- Registered Mechanics --}}
  <section class="mb-10">
    <h2 class="heading-brand mb-4">Registered Mechanics</h2>

    @if(isset($mechanics) && $mechanics->isNotEmpty())
      <div class="table-wrap">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Specialty</th>
              <th>Phone</th>
              <th class="text-right">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($mechanics as $m)
              <tr>
                <td>{{ $m->FirstName }} {{ $m->LastName }}</td>
                <td>{{ $m->Email ?? '-' }}</td>
                <td>{{ $m->Specialty ?? '-' }}</td>
                <td>{{ $m->PhoneNumber ?? '-' }}</td>
                <td class="text-right">
                  <a class="btn btn-sm" href="{{ route('admin.mechanics.edit', $m->MechanicID) }}">Edit</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <p class="muted">
        No mechanics registered yet.
        <a href="{{ route('admin.add_mechanic.form') }}" class="underline">Add one now</a>.
      </p>
    @endif
  </section>

  {{-- Weekly Schedule --}}
  <section>
    <h2 class="heading-brand mb-4">Mechanic Weekly Schedule</h2>

    @if(isset($schedule_grid) && !empty($schedule_grid) && isset($mechanics) && $mechanics->isNotEmpty())
      <div class="table-wrap">
        <table class="table">
          <thead>
            <tr>
              <th>Day</th>
              @foreach ($mechanics as $m)
                <th>{{ $m->FirstName }} {{ $m->LastName }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach ($schedule_grid as $day => $row)
              <tr>
                <td>{{ $day }}</td>
                @foreach ($mechanics as $m)
                  <td>{{ $row[$m->MechanicID] ?? '' }}</td>
                @endforeach
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <p class="muted">No schedule data available.</p>
    @endif
  </section>
@endsection