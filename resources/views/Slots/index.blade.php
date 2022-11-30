@extends('layouts.master')

@section('content')

  <h3>All Slots</h3>
  <table class="table  table-responsive">
    <thead class="thead-inverse">
    <tr>

      <th>Slot Number</th>
      <th>Slot Time</th>
      <th>Modify</th>
    </tr>
    </thead>
    <tbody>
      @foreach ($slots as $slot)
      
      <tr>
      <td>{{$slot->slot_no}}</td>
      <td>{{$slot->slot_time}}</td>
      <td><i class="fa fa-edit text-primary" data-toggle="modal" data-target="#model{{$slot->slot_id}}"></i>   /  <i class="fa fa-trash text-danger" data-toggle="modal" data-target="#modeldel{{$slot->slot_id}}"></i>
        <div class="modal fade" id="model{{$slot->slot_id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">New Slot</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {!! Form::open(['action' => ['SlotsController@update', $slot->slot_id], 'method' => 'POST']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {{Form::label('slot_no','Slot No')}}
                    {{Form::text('slot_no',$slot->slot_no, ['class' => 'form-control', 'placeholder' => 'Enter Slot Number'])}}
                </div>
                <div class="form-group">
                    {{Form::label('slot_time','Slot Time')}}
                    {{Form::text('slot_time',$slot->slot_time, ['class' => 'form-control', 'placeholder' => 'Enter Slot Number'])}}
                </div>
                    {{Form::hidden('_method','PUT')}}
                    {{Form::submit('Update',['class' => 'btn btn-warning'])}}
                    {!! Form::close() !!}           
          </div>
          </div>
        </div>
        </div>
        <div class="modal fade" id="modeldel{{$slot->slot_id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
               <input type="hidden" name="id" value="{{$slot->slot_id}}">
              </div>
              </div>
              <div class="modal-footer">
                    {!!Form::open(['action' => ['SlotsController@destroy',$slot->slot_id],'method' => 'POST', 'class' => 'd-inline'])!!}
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
      <h5 class="modal-title">New Slot</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>




    



    {!! Form::open(['action' => 'SlotsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','class' => 'form p-5']) !!}
      <div class="modal-body">
          <div class="form-group">
            {{Form::label('slot_no','Slot No')}}
            {{Form::text('slot_no','', ['class' => 'form-control', 'placeholder' => 'Enter Slot Number'])}}
          </div>
          <div class="form-group">
            {{Form::label('slot_time','Slot Time')}}
            {{Form::text('slot_time','', ['class' => 'form-control', 'placeholder' => 'Enter Slot Time'])}}
          </div>
  {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

    </div>
    </div>
  </div>


@endsection