@extends('layouts.master')

@section('content')
<?php
 $sem = array('select'=>'Select Semester','1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,'6'=>6,'7'=>7,'8'=>8);
  $sections['programs']->prepend('Select Program', 'select');
?>
  <h3>All Sections</h3>
  <table class="table  table-responsive">
    <thead class="thead-inverse">
    <tr>

      <th>Section Name</th>
      <th>Semester</th>
      <th>Program</th>
      <th>Department</th>
      <th>Bach Name</th>
      <th>Modify</th>
    </tr>
    </thead>
    <tbody>
      @foreach ($sections['sections'] as $section)
      
      <tr>
      <td>{{$section->sec_name}}</td>
      
      <td>{{$section->semester}}</td>
      <td>{{$section->prg_name}}</td>
      <td>{{$section->dep_name}}</td>
      <td>{{$section->batch_name}}</td>
      <td><i class="fa fa-edit text-primary" data-toggle="modal" data-target="#model{{$section->section_id}}"></i>   /  <i class="fa fa-trash text-danger" data-toggle="modal" data-target="#modeldel{{$section->section_id}}"></i>
        <div class="modal fade" id="model{{$section->section_id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Update Program</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {!! Form::open(['action' => ['SectionController@update', $section->section_id], 'method' => 'POST']) !!}
            <div class="modal-body">

              <div class="form-group">
                {{Form::label('section_name','Section Name')}}
                {{Form::text('section_name',$section->sec_name, ['class' => 'form-control', 'placeholder' => 'Enter Section Name'])}}
              </div>
             
              <div class="form-group">
                {{Form::label('batch_name','Batch Name')}}
                {{Form::text('batch_name',$section->batch_name, ['class' => 'form-control', 'placeholder' => 'Enter Batch Name'])}}
              </div>
             
              
              <div class="form-group">
                {{Form::label('semester','Semester')}}
                {{Form::select('semester',$sem,$section->semester, ['class' => 'form-control'])}}
                </div>
              <div class="form-group">
                {{Form::label('program','Programs')}}
                {{Form::select('program',$sections['programs'],$section->prg_id,['class' => 'form-control'])}}
              </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Update',['class' => 'btn btn-warning'])}}
        {!! Form::close() !!}
           </div>
          </div>
        </div>
        </div>
        <div class="modal fade" id="modeldel{{$section->section_id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
               <input type="hidden" name="id" value="{{$section->program_id}}">
              </div>
              </div>
              <div class="modal-footer">
              {!!Form::open(['action' => ['SectionController@destroy',$section->section_id],'method' => 'POST', 'class' => 'd-inline'])!!}
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
      <h5 class="modal-title">New Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>

      {!! Form::open(['action' => 'SectionController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','class' => 'form p-5']) !!}
      <div class="modal-body">


  <div class="form-group">
    {{Form::label('section_name','Section Name')}}
    {{Form::text('section_name','', ['class' => 'form-control', 'placeholder' => 'Enter Section Name'])}}
  </div>
  
  
  <div class="form-group">
      {{Form::label('batch_name','Batch Name')}}
      {{Form::text('batch_name','', ['class' => 'form-control', 'placeholder' => 'Enter Batch Name'])}}
    </div>
   
  
  <div class="form-group">
    {{Form::label('semester','Semester')}}
    {{Form::select('semester',$sem,null, ['class' => 'form-control'])}}
    </div>
  <div class="form-group">
    {{Form::label('program','Programs')}}
    {{Form::select('program',$sections['programs'],null,['class' => 'form-control'])}}
  </div>
  {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

    </div>
    </div>
  </div>


@endsection