@extends('layouts.master')

@section('content')

  <h3>All Labs</h3>
  <table class="table  table-responsive">
    <thead class="thead-inverse">
    <tr>

      <th>Lab Number</th>
      <th>Block Name</th>
      <th>Department</th>
      <th>Modify</th>
    </tr>
    </thead>
    <tbody>
      @foreach ($data['labs'] as $x)
      
      <tr>
      <td>{{$x->lab_name}}</td>
      <td>{{$x->block_name}}</td>
      <td>{{$x->dep_name}}</td>
      <td><i class="fa fa-edit text-primary" data-toggle="modal" data-target="#model{{$x->lab_id}}"></i>   /  <i class="fa fa-trash text-danger" data-toggle="modal" data-target="#modeldel{{$x->lab_id}}"></i>
        <div class="modal fade" id="model{{$x->lab_id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">New Labs</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {!! Form::open(['action' => ['labController@update', $x->lab_id], 'method' => 'POST']) !!}
            <div class="modal-body">
               <div class="form-group">
                    {{Form::label('lab_name','Lab No')}}
                    {{Form::text('lab_name',$x->lab_name, ['class' => 'form-control', 'placeholder' => 'Enter Lab Name'])}}
                </div> 
                <div class="form-group">
                    {{Form::label('block_id','Block')}}
                    <select name="block_id" class="form-control">
                        @foreach ($data['blocks'] as $block)
                    <option <?php if($block->department_id == $x->block_id ) {
                      echo "selected";
                    } ?>  value="{{$block->department_id}}">{{$block->dep_name}} (Block <b class="font-weight-bold">|</b>  {{$block->block_name}} )</option>
                        @endforeach
                    </select>
                </div> 
                    {{Form::hidden('_method','PUT')}}
                    {{Form::submit('Update',['class' => 'btn btn-warning'])}}
                    {!! Form::close() !!}           
          </div>
          </div>
        </div>
        </div>
        <div class="modal fade" id="modeldel{{$x->lab_id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
               <input type="hidden" name="id" value="{{$x->lab_id}}">
              </div>
              </div>
              <div class="modal-footer">
                    {!!Form::open(['action' => ['labController@destroy',$x->lab_id],'method' => 'POST', 'class' => 'd-inline'])!!}
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
      <h5 class="modal-title">New Lab</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>




    



    {!! Form::open(['action' => 'labController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','class' => 'form p-5']) !!}
      <div class="modal-body">
        <div class="form-group">
          {{Form::label('lab_name','Lab No')}}
          {{Form::text('lab_name','', ['class' => 'form-control', 'placeholder' => 'Enter Lab No'])}}
        </div>

        <div class="form-group">
          {{Form::label('block_id','Block')}}
          <select class="form-control" name="block_id">
              @foreach ($data['blocks'] as $block)
          <option value="{{$block->department_id}}">{{$block->dep_name}} (Block <b class="font-weight-bold">|</b>  {{$block->block_name}} )</option>
              @endforeach
          </select>
      </div> 

        {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}

      </div>
    </div>
  </div>


@endsection