@extends('layouts.master')

@section('content')

  <h3>All Rooms</h3>
  <table class="table  table-responsive">
    <thead class="thead-inverse">
    <tr>

      <th>Room Number</th>
      <th>Block Name</th>
      <th>Department</th>
      <th>Modify</th>
    </tr>
    </thead>
    <tbody>
      @foreach ($data['rooms'] as $room)
      
      <tr>
      <td>{{$room->room_no}}</td>
      <td>{{$room->block_name}}</td>
      <td>{{$room->dep_name}}</td>
      <td><i class="fa fa-edit text-primary" data-toggle="modal" data-target="#model{{$room->room_id}}"></i>   /  <i class="fa fa-trash text-danger" data-toggle="modal" data-target="#modeldel{{$room->room_id}}"></i>
        <div class="modal fade" id="model{{$room->room_id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">New Department</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {!! Form::open(['action' => ['RoomsController@update', $room->room_id], 'method' => 'POST']) !!}
            <div class="modal-body">
               <div class="form-group">
                    {{Form::label('room_no','Room No')}}
                    {{Form::text('room_no',$room->room_no, ['class' => 'form-control', 'placeholder' => 'Enter Room Name'])}}
                </div> 
                <div class="form-group">
                    {{Form::label('block_id','Block')}}
                    <select name="block_id" class="form-control">
                        @foreach ($data['blocks'] as $block)
                    <option <?php if($block->department_id == $room->block_id ) {
                      echo "selected";
                    } ?>value="{{$block->department_id}}">{{$block->dep_name}} (Block <b class="font-weight-bold">|</b>  {{$block->block_name}} )</option>
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
        <div class="modal fade" id="modeldel{{$room->room_id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
               <input type="hidden" name="id" value="{{$room->room_id}}">
              </div>
              </div>
              <div class="modal-footer">
                    {!!Form::open(['action' => ['RoomsController@destroy',$room->room_id],'method' => 'POST', 'class' => 'd-inline'])!!}
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
      <h5 class="modal-title">New Rooms</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>




    



    {!! Form::open(['action' => 'RoomsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','class' => 'form p-5']) !!}
      <div class="modal-body">
        <div class="form-group">
          {{Form::label('room_no','Room No')}}
          {{Form::text('room_no','', ['class' => 'form-control', 'placeholder' => 'Enter Room No'])}}
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