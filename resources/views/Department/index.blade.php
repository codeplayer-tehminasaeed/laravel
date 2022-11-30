@extends('layouts.master')

@section('content')

  <h3>All Departments</h3>
  <table class="table  table-responsive">
    <thead class="thead-inverse">
    <tr>

      <th>Department Name</th>
      <th>Block Name</th>
      <th>Modify</th>
    </tr>
    </thead>
    <tbody>
      @foreach ($departments as $department)
      
      <tr>
      <td>{{$department->dep_name}}</td>
      <td>{{$department->block_name}}</td>
      <td><i class="fa fa-edit text-primary" data-toggle="modal" data-target="#model{{$department->department_id}}"></i>   /  <i class="fa fa-trash text-danger" data-toggle="modal" data-target="#modeldel{{$department->department_id}}"></i>
        <div class="modal fade" id="model{{$department->department_id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">New Department</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {!! Form::open(['action' => ['DepartmentController@update', $department->department_id], 'method' => 'POST']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {{Form::label('dep_name','Department')}}
                    {{Form::text('dep_name',$department->dep_name, ['class' => 'form-control', 'placeholder' => 'Enter Department Name'])}}
                </div>
                 <div class="form-group">
                    {{Form::label('block_name','Block Name')}}
                    {{Form::text('block_name',$department->block_name, ['class' => 'form-control', 'placeholder' => 'Enter Block Name'])}}
                </div>
                    {{Form::hidden('_method','PUT')}}
                    {{Form::submit('Update',['class' => 'btn btn-warning'])}}
                    {!! Form::close() !!}           
          </div>
          </div>
        </div>
        </div>
        <div class="modal fade" id="modeldel{{$department->department_id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
               <input type="hidden" name="id" value="{{$department->department_id}}">
              </div>
              </div>
              <div class="modal-footer">
                    {!!Form::open(['action' => ['DepartmentController@destroy',$department->department_id],'method' => 'POST', 'class' => 'd-inline'])!!}
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
      <h5 class="modal-title">New Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>




    



    {!! Form::open(['action' => 'DepartmentController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','class' => 'form p-5']) !!}
      <div class="modal-body">
  <div class="form-group">
    {{Form::label('dep_name','Department')}}
    {{Form::text('dep_name','', ['class' => 'form-control', 'placeholder' => 'Enter Department Name'])}}
  </div>
  <div class="form-group">
    {{Form::label('block_name','Block Name')}}
    {{Form::text('block_name','', ['class' => 'form-control', 'placeholder' => 'Enter Block Name'])}}
  </div>
  {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

    </div>
    </div>
  </div>


@endsection