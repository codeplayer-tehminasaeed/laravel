@extends('layouts.master')
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous">
</script>
@section('content')
{!! Form::open(['action' => 'timetableController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','class' => 'form p-5']) !!}

  <h3>Timetable<span class="pull-right "> {{Form::submit('Genrate Timetable',['class' => 'btn btn-primary'])}}</span> </h3>
 
  {!! Form::close() !!}

  
  <table class="table  table-responsive">
    <thead class="thead-inverse">
    <tr>

      <th>Section Name</th>
      <th>Semester</th>
      <th>Program</th>
      <th>Department</th>
      <th>Modify</th>
    </tr>
    </thead>
    <tbody>
      @foreach ($sections as $section)
      
      <tr>
      <td>{{$section->sec_name}}</td>
      
      <td>{{$section->semester}}</td>
      <td>{{$section->prg_name}}</td>
      <td>{{$section->dep_name}}</td>
      <td><a href="/timetable/{{$section->section_id}}"><i class="fa fa-eye text-primary" ></i></a>   /  
        <i class="fa fa-trash text-danger" data-toggle="modal" data-target="#modeldel{{$section->section_id}}"></i>
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
                 <input type="hidden" name="id" value="{{$section->section_id}}">
                </div>
                </div>
                <div class="modal-footer">
                      {!!Form::open(['action' => ['timetableController@destroy',$section->section_id],'method' => 'POST', 'class' => 'd-inline'])!!}
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
        {{$sections->links()}}
  



@endsection
