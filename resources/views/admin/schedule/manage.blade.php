{{-- resources/views/admin/schedule/manage.blade.php --}}
@extends('layouts.admin')
@section('title', 'Manage Schedules')

@section('content')
<section class="card max-w-2xl mx-auto">
  <h2 class="heading-brand mb-4">Manage Schedules</h2>

  @if(session('success')) <div class="alert mb-4">{{ session('success') }}</div> @endif
  @if(session('error'))   <div class="alert alert-error mb-4">{{ session('error') }}</div> @endif

  @if ($errors->any())
    <div class="alert alert-error mb-4">
      <div><strong>There were some problems with your input:</strong></div>
      <ul class="list-disc pl-6 mt-2">
        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
      </ul>
    </div>
  @endif

  @php
    // 30-min options, 07:00–19:00
    $timeOptions = [];
    for ($h=7; $h<=19; $h++) {
      foreach ([0,30] as $m) {
        $v = sprintf('%02d:%02d',$h,$m);
        $timeOptions[$v] = date('g:i A', strtotime($v));
      }
    }
    $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
  @endphp

  <form method="POST" action="{{ route('admin.schedule.update') }}" class="space-y-4">
    @csrf @method('PUT')

    <div>
      <label class="label">Mechanic</label>
      <select name="mechanicID" class="select" required>
        <option value="">Select a Mechanic</option>
        @foreach($mechanics as $m)
          <option value="{{ $m->MechanicID }}">{{ $m->FirstName }} {{ $m->LastName }}</option>
        @endforeach
      </select>
    </div>

    <div>
      <label class="label">Day of the Week</label>
      <select name="dayOfWeek" class="select" required>
        <option value="">Select a day</option>
        @foreach($days as $d)
          <option value="{{ $d }}">{{ $d }}</option>
        @endforeach
      </select>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <label class="label">Start Time</label>
        <select name="startTime" class="select" id="start_time">
          <option value="">—</option>
          @foreach($timeOptions as $val => $label)
            <option value="{{ $val }}">{{ $label }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="label">End Time</label>
        <select name="endTime" class="select" id="end_time">
          <option value="">—</option>
          @foreach($timeOptions as $val => $label)
            <option value="{{ $val }}">{{ $label }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="flex items-center gap-4">
      <label class="inline-flex items-center gap-2">
        <input type="checkbox" name="overwrite" value="1" class="checkbox">
        <span>Overwrite existing shift(s) for this day</span>
      </label>

      <label class="inline-flex items-center gap-2">
        <input type="checkbox" name="is_off" value="1" class="checkbox" id="day_off_cb"
               onclick="document.getElementById('start_time').disabled=this.checked;
                        document.getElementById('end_time').disabled=this.checked;
                        if(this.checked){document.getElementById('start_time').value='';document.getElementById('end_time').value='';}">
        <span>Mark this day off (clear all)</span>
      </label>
    </div>

    <button class="btn btn-primary w-full">Save</button>
  </form>
</section>
@endsection