@extends('layouts.master')

@section('content')
<?php
  $sem = array('select'=>'Select Semester','1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,'6'=>6,'7'=>7,'8'=>8);
  $programs['depart']->prepend('Select Department', 'select');
?>
    <h3>All Programs</h3>
    <table class="table  table-responsive">
      <thead class="thead-inverse">
        <tr>

          <th>Program Name</th>
          <th>Department Name</th>
          <th>No Of Semesters</th>
          <th>Modify</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($programs['programs'] as $program)
            
          <tr>
          <td>{{$program->prg_name}}</td>
          <td>{{$program->dep_name}}</td>
          <td>{{$program->no_of_semesters}}</td>
          <td><i class="fa fa-edit text-primary" data-toggle="modal" data-target="#model{{$program->program_id}}"></i>   /  <i class="fa fa-trash text-danger" data-toggle="modal" data-target="#modeldel{{$program->program_id}}"></i>
              <div class="modal fade" id="model{{$program->program_id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Update Program</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      {!! Form::open(['action' => ['ProgramsController@update', $program->program_id], 'method' => 'POST']) !!}
                      <div class="modal-body">
                <div class="form-group">
                  {{Form::label('prg_name','Program Name')}}
                  {{Form::text('prg_name',$program->prg_name, ['class' => 'form-control', 'placeholder' => 'Enter Program Name'])}}
                </div>
                <div class="form-group">
                  {{Form::label('no_of_semesters','No OF Semesters')}}
                  {{Form::select('no_of_semesters',$sem,$program->no_of_semesters, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('department_id','Department')}}
                    {{Form::select('department_id',$programs['depart'],$program->dep_id,['class' => 'form-control'])}}
                </div>
                {{Form::hidden('_method','PUT')}}
              {{Form::submit('Update',['class' => 'btn btn-warning'])}}
              {!! Form::close() !!}
                   </div>
                  </div>
                </div>
              </div>
                <div class="modal fade" id="modeldel{{$program->program_id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                             <input type="hidden" name="id" value="{{$program->program_id}}">
                            </div>
                          </div>
                          <div class="modal-footer">
                            {!!Form::open(['action' => ['ProgramsController@destroy',$program->program_id],'method' => 'POST', 'class' => 'd-inline'])!!}
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
            <h5 class="modal-title">New Program</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>

          {!! Form::open(['action' => 'ProgramsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','class' => 'form p-5']) !!}
          <div class="modal-body">
    <div class="form-group">
      {{Form::label('prg_name','Program Name')}}
      {{Form::text('prg_name','', ['class' => 'form-control', 'placeholder' => 'Enter Program Name'])}}
    </div>
    
    <div class="form-group">
        {{Form::label('no_of_semesters','No OF Semesters')}}
        {{Form::select('no_of_semesters',$sem,null, ['class' => 'form-control'])}}
      </div>
    <div class="form-group">
        {{Form::label('department_id','Department')}}
        {{Form::select('department_id',$programs['depart'],null,['class' => 'form-control'])}}
    </div>
  {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

        </div>
      </div>
    </div>


@endsection