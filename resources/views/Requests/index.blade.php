@extends('layouts.master')

@section('content')

  <h3>All Requests</h3>
  <table class="table  table-responsive">
    <thead class="thead-inverse">
    <tr>

      <th>Department Name</th>
      <th>Teacher Name</th>
      <th>Semester</th>
      <th>Room No</th>
      <th>Slot</th>
      <th>Day</th>
      <th colspan="2" class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
      @foreach ($data as $x)
      
      <tr>
      <td>{{$x->dep_name}}</td>
      <td>{{$x->name}}</td>
      <td>{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}})</td>
      <td>{{$x->block_name}}-{{$x->room_no}}</td>
      <td>{{$x->slot_time}}(Slot {{$x->slot_no }} )</td>
      <td>{{$x->day}} </td>
      <td>
        @if($x->status != 'rejected')
        {!! Form::open(['action' => 'RequestController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','class' => 'form']) !!}
            <input type="hidden" name="t_course_id" value="{{$x->t_course_id}}">
            <input type="hidden" name="slot_id" value="{{$x->slot_id}}">
            <input type="hidden" name="day" value="{{$x->day}}">
            <input type="hidden" name="dep_id" value="{{$x->dep_id}}">
            <input type="hidden" name="sec_id" value="{{$x->sec_id}}">
            <input type="hidden" name="room_id" value="{{$x->room_id}}">
            <input type="hidden" name="makeup_request_id" value="{{$x->makeup_request_id}}">
        {{Form::submit('Accept',['class' => 'btn btn-primary fa fa-check text-success'])}}
        {!! Form::close() !!}
      </td>
      <td>
        {!!Form::open(['action' => ['RequestController@destroy',$x->makeup_request_id],'method' => 'POST', 'class' => 'd-inline'])!!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Reject',['class' => 'btn btn-danger'])}}
     {!! Form::close() !!}
     @endif
      </td>

    </tr>
      
      @endforeach

    </tbody>
  </table>



@endsection