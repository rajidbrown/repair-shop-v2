{{-- resources/views/admin/schedule/create.blade.php --}}
@extends('layouts.admin')
@section('title', 'Create Schedule')

@section('content')
  <section class="card max-w-2xl mx-auto">
    <h2 class="heading-brand mb-4">Create Weekly Schedule</h2>

    {{-- flash messages --}}
    @if(session('success'))
      <div class="alert mb-4">{{ session('success') }}</div>
    @elseif(session('error'))
      <div class="alert alert-error mb-4">{{ session('error') }}</div>
    @endif

    {{-- validation errors --}}
    @if ($errors->any())
      <div class="alert alert-error mb-4">
        <div><strong>There were some problems with your input:</strong></div>
        <ul class="list-disc pl-6 mt-2">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.schedule.store') }}" method="POST" class="space-y-4">
      @csrf

      <div>
        <label for="mechanicID" class="label">Mechanic</label>
        <select id="mechanicID" name="mechanicID" class="select" required>
          <option value="">Select a Mechanic</option>
          @foreach($mechanics as $mechanic)
            <option value="{{ $mechanic->MechanicID }}">
              {{ $mechanic->FirstName }} {{ $mechanic->LastName }}
            </option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="dayOfWeek" class="label">Day of the Week</label>
        <select id="dayOfWeek" name="dayOfWeek" class="select" required>
          <option value="">Select a day</option>
          @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
            <option value="{{ $day }}">{{ $day }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="startTime" class="label">Start Time</label>
        <input type="time" id="startTime" name="startTime" class="input" required>
      </div>

      <div>
        <label for="endTime" class="label">End Time</label>
        <input type="time" id="endTime" name="endTime" class="input" required>
      </div>

      <button type="submit" class="btn btn-primary w-full">Add to Schedule</button>
    </form>
  </section>
@endsection