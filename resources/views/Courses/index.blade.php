@extends('layouts.master')

@section('content')
<?php
  $sem = array('select'=>'Select Semester','1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,'6'=>6,'7'=>7,'8'=>8);
  $credit = array('select'=>'Select Credit Hour','2'=>2,"3"=>3,"4"=>4);
  $lab = array('yes'=>'yes','no'=>'no');
  $courses['programs']->prepend('Select Program','select');
?>
  <h3>All Courses</h3>
  <table class="table  table-responsive">
    <thead class="thead-inverse">
    <tr>

      <th>Course Name</th>
      <th>Course Code</th>
      <th>Semester</th>
      <th>Credit Hours</th>
      <th>Lab</th>
      <th>Program</th>
      <th>Department</th>
      <th>Modify</th>
    </tr>
    </thead>
    <tbody>
      @foreach ($courses['courses'] as $course)
      
      <tr>
      <td>{{$course->course_name}}</td>
      <td>{{$course->course_code}}</td>
      <td>{{$course->semester}}</td>
      <td>{{$course->credit_hours}}</td>
      <td>{{$course->lab}}</td>
      <td>{{$course->prg_name}}</td>
      <td>{{$course->dep_name}}</td>
      <td><i class="fa fa-edit text-primary" data-toggle="modal" data-target="#model{{$course->course_id}}"></i>   /  <i class="fa fa-trash text-danger" data-toggle="modal" data-target="#modeldel{{$course->course_id}}"></i>
        <div class="modal fade" id="model{{$course->course_id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Update Program</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {!! Form::open(['action' => ['CoursesController@update', $course->course_id], 'method' => 'POST']) !!}
            <div class="modal-body">
              <div class="form-group">
                {{Form::label('course_name','Course Name')}}
                {{Form::text('course_name',$course->course_name, ['class' => 'form-control', 'placeholder' => 'Enter Course Name'])}}
              </div>
              <div class="form-group">
                {{Form::label('course_code','Course Code')}}
                {{Form::text('course_code',$course->course_code, ['class' => 'form-control', 'placeholder' => 'Enter Course Code'])}}
              </div>
              
              <div class="form-group">
                {{Form::label('semester','Semester')}}
                {{Form::select('semester',$sem,$course->semester, ['class' => 'form-control'])}}
                </div>
                 <div class="form-group">
                {{Form::label('credit_hours','Credit Hour')}}
                {{Form::select('credit_hours',$credit,$course->credit_hours, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                  {{Form::label('lab','lab')}}
                  {{Form::select('lab',$lab,$course->lab, ['class' => 'form-control'])}}
                </div>
              <div class="form-group">
                {{Form::label('program','Programs')}}
                {{Form::select('program',$courses['programs'],$course->prg_id,['class' => 'form-control'])}}
              </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Update',['class' => 'btn btn-warning'])}}
        {!! Form::close() !!}
           </div>
          </div>
        </div>
        </div>
        <div class="modal fade" id="modeldel{{$course->course_id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete Confirmation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <div class="modal-body">
               <div class="form-group">
              <p class="text-center">
                Are You Sure You Want To Delete??
              </p>
               <input type="hidden" name="id" value="{{$course->program_id}}">
              </div>
              </div>
              <div class="modal-footer">
              {!!Form::open(['action' => ['CoursesController@destroy',$course->course_id],'method' => 'POST', 'class' => 'd-inline'])!!}
              <button type="button" class="btn btn-secondary" data-dismiss="modal">No Cancel</button>
              {{Form::hidden('_method','DELETE')}}
              {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
              {!! Form::close() !!}
              </div>
            </div>
          </div>
          </div>
        
      </td>
      </tr>
      
      @endforeach

    </tbody>
  </table>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId">
    Add New
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title">New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>

      {!! Form::open(['action' => 'CoursesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','class' => 'form p-5']) !!}
      <div class="modal-body">
  <div class="form-group">
    {{Form::label('course_name','Course Name')}}
    {{Form::text('course_name','', ['class' => 'form-control', 'placeholder' => 'Enter Course Name'])}}
  </div>
  <div class="form-group">
    {{Form::label('course_code','Course Code')}}
    {{Form::text('course_code','', ['class' => 'form-control', 'placeholder' => 'Enter Course Code'])}}
  </div>
  
  <div class="form-group">
    {{Form::label('semester','Semester')}}
    {{Form::select('semester',$sem,null, ['class' => 'form-control'])}}
    </div>
  <div class="form-group">
    {{Form::label('credit_hours','Credit Hours')}}
    {{Form::select('credit_hours',$credit,null, ['class' => 'form-control'])}}
    </div>
  <div class="form-group">
    {{Form::label('lab','lab')}}
    {{Form::select('lab',$lab,null, ['class' => 'form-control'])}}
  </div>
  <div class="form-group">
    {{Form::label('program','Programs')}}
    {{Form::select('program',$courses['programs'],null,['class' => 'form-control'])}}
  </div>
  {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

    </div>
    </div>
  </div>


@endsection