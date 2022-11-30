@extends('layouts.master')

@section('content')

  <h3>All Slots</h3>
  <table class="table  table-responsive">
    <thead class="thead-inverse">
    <tr>

      <th>Lecture For Shifting</th>
      <th>Teacher Name</th>
      <th>Shift in Day</th>
      <th>Shift in Slot</th>
      <th>Modify</th>
    </tr>
    </thead>
    <tbody>
      @foreach ($data as $x)
      
      <tr>
        
      <td>{{$x->course_name}} {{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}})---{{$x->day}}--(slot-{{$x->slot_no}})</td>
      <td>{{$x->name}}</td>
      <td>{{$x->shift_day}}</td>
      <td>{{$x->shift_slot_no}}</td>
      @if($x->status == 'pending')
      <td>
        
        {!! Form::open(['action' => 'shiftLecController@shift', 'method' => 'POST', 'enctype' => 'multipart/form-data','class' => 'form p-5']) !!}
        
          <input type="hidden" name="shift_day" value="{{$x->shift_day}}">
          <input type="hidden" name="shift_slot_id" value="{{$x->shift_slot_id}}">
          <input type="hidden" name="timetable_id" value="{{$x->timetable_id}}">
          <input type="hidden" name="sec_id" value="{{$x->sec_id}}">
          <input type="hidden" name="shift_id" value="{{$x->shift_lec_id}}">

          {{Form::submit('Accept',['class' => 'btn btn-primary'])}}
          {!! Form::close() !!}
      </td>
      @endif
    </tr>
      
      @endforeach

    </tbody>
  </table>
  

@endsection