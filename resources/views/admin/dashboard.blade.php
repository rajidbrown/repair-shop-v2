{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
  {{-- Quick actions --}}
  <section class="mb-10">
    <h2 class="heading-brand mb-4">Admin Quick Access</h2>
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <a class="card text-center" href="{{ route('admin.customers') }}">View Customers</a>
        <a class="card text-center" href="{{ route('admin.appointments.upcoming') }}">Upcoming Appointments</a>
        <a class="card text-center" href="{{ route('admin.invoices') }}">View Invoices</a>
        <a class="card text-center" href="{{ route('admin.settings') }}">Settings</a>
    </div>
  </section>

  {{-- Registered Mechanics --}}
  <section class="mb-10">
    <h2 class="heading-brand mb-4">Registered Mechanics</h2>

    @if($mechanics->isNotEmpty())
      <div class="table-wrap">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Specialty</th>
              <th>Phone</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($mechanics as $m)
            <tr>
              <td>{{ $m->FirstName }} {{ $m->LastName }}</td>
              <td>{{ $m->Email ?? '-' }}</td>
              <td>{{ $m->Specialty ?? '-' }}</td>
              <td>{{ $m->Phone ?? '-' }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    @else
      <p class="muted">No mechanics registered yet.</p>
    @endif
  </section>

  {{-- Weekly Schedule --}}
  <section>
    <h2 class="heading-brand mb-4">Mechanic Weekly Schedule</h2>

    @if(!empty($schedule_grid))
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