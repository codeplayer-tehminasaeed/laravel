@extends('layouts.master')
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous">
</script>
@section('content')

  <h3>Request Status</h3>
  <table class="table  table-responsive">
      <thead class="thead-inverse">
      <tr>
  
        <th>Lecture For Shifting</th>
        <th>Teacher Name</th>
        <th>Shift in Day</th>
        <th>Shift in Slot</th>
        <th>Status</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($data as $x)
        
        <tr>
          
        <td>{{$x->course_name}} {{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}})---{{$x->day}}--(slot-{{$x->slot_no}})</td>
        <td>{{$x->name}}</td>
        <td>{{$x->shift_day}}</td>
        <td>{{$x->shift_slot_no}}</td>
        <td>{{$x->status}}</td>
        
        
      </tr>
        
        @endforeach
  
      </tbody>
    </table>
@endsection
