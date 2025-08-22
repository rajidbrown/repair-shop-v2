@extends('layouts.admin')
@section('title', 'Manage Schedule')

@section('content')
<section class="card max-w-3xl mx-auto">
  <h2 class="heading-brand mb-2">Edit Schedule — {{ $mechanic->FirstName }} {{ $mechanic->LastName }}</h2>

  @if(session('success')) <div class="alert mb-4">{{ session('success') }}</div> @endif
  @if(session('error'))   <div class="alert alert-error mb-4">{{ session('error') }}</div> @endif

  @php
    // Build 30-min options (7:00–19:00). Adjust as needed.
    $opts = [];
    for ($h=7; $h<=19; $h++) {
      foreach ([0,30] as $m) {
        $v = sprintf('%02d:%02d',$h,$m);
        $opts[$v] = date('g:i A', strtotime($v));
      }
    }
    $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
  @endphp

  <form method="POST" action="{{ route('admin.mechanics.schedule.update', $mechanic->MechanicID) }}" class="space-y-4">
    @csrf @method('PUT')

    <div class="table-wrap">
      <table class="table">
        <thead>
          <tr>
            <th>Day</th>
            <th>Start</th>
            <th>End</th>
            <th>Off</th>
          </tr>
        </thead>
        <tbody>
        @foreach($days as $d)
          @php($s = $prefill[$d]['start'] ?? null)
          @php($e = $prefill[$d]['end'] ?? null)
          <tr>
            <td>{{ $d }}</td>
            <td>
              <select name="times[{{ $d }}][start]" class="select">
                <option value="">—</option>
                @foreach($opts as $val=>$label)
                  <option value="{{ $val }}" @selected($s===$val)>{{ $label }}</option>
                @endforeach
              </select>
            </td>
            <td>
              <select name="times[{{ $d }}][end]" class="select">
                <option value="">—</option>
                @foreach($opts as $val=>$label)
                  <option value="{{ $val }}" @selected($e===$val)>{{ $label }}</option>
                @endforeach
              </select>
            </td>
            <td>
              <input type="checkbox" class="checkbox"
                     onclick="
                       const row=this.closest('tr');
                       row.querySelectorAll('select').forEach(s=>s.value='');
                     ">
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>

    <button class="btn btn-primary w-full">Save Schedule</button>
  </form>
</section>
@endsection