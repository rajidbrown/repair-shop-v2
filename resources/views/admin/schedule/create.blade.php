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

    @php
      // Build 30-minute options, 07:00–19:00
      $timeOptions = [];
      for ($h = 7; $h <= 19; $h++) {
        foreach ([0, 30] as $m) {
          $value = sprintf('%02d:%02d', $h, $m);               // 24h value
          $label = date('g:i A', strtotime($value));           // 12h label
          $timeOptions[$value] = $label;
        }
      }
    @endphp

    <form action="{{ route('admin.schedule.store') }}" method="POST" class="space-y-4">
      @csrf

      <div>
        <label for="mechanicID" class="label">Mechanic</label>
        <select id="mechanicID" name="mechanicID" class="select" required>
          <option value="">Select a Mechanic</option>
          @foreach($mechanics as $mechanic)
            <option value="{{ $mechanic->MechanicID }}" @selected(old('mechanicID') == $mechanic->MechanicID)>
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
            <option value="{{ $day }}" @selected(old('dayOfWeek') == $day)>{{ $day }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="startTime" class="label">Start Time</label>
        <select id="startTime" name="startTime" class="select" required>
          <option value="">Select start</option>
          @foreach($timeOptions as $val => $label)
            <option value="{{ $val }}" @selected(old('startTime') == $val)>{{ $label }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="endTime" class="label">End Time</label>
        <select id="endTime" name="endTime" class="select" required>
          <option value="">Select end</option>
          @foreach($timeOptions as $val => $label)
            <option value="{{ $val }}" @selected(old('endTime') == $val)>{{ $label }}</option>
          @endforeach
        </select>
      </div>

      <button type="submit" class="btn btn-primary w-full">Add to Schedule</button>
    </form>
  </section>
@endsection