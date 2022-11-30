@extends('layouts.master')
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous">
</script>
@section('content')
<?php
  $gender = array('Male'=>'Male','Female'=>'Female');
  // $data['dep']->prepend('Select Department','select');
?>
  <h3>All Teachers</h3>
  <table class="table  table-responsive">
  <thead class="thead-inverse">
  <tr>

    <th>Name</th>
    <th>Cnic</th>
    <th>Email</th>
    <th>Department</th>
    <th>Modify</th>
  </tr>
  </thead>
  <tbody>
    @foreach ($data['teacher'] as $x)
    
    <tr>
    <td>{{$x->name}}</td>
    <td>{{$x->teacher_cnic}}</td>
    <td>{{$x->email}}</td>
    <td>{{$x->dep_name}}</td>
    <td><a href="/teacher/{{$x->teacher_info_id}}/edit"><i class="fa fa-edit text-primary" data-toggle="modal" data-target="#model{{$x->teacher_info_id}}"></i>  </a>  /  <i class="fa fa-trash text-danger" data-toggle="modal" data-target="#modeldel{{$x->teacher_info_id}}"></i>

    <div class="modal fade" id="modeldel{{$x->teacher_info_id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
        </div>
        </div>
        <div class="modal-footer">
        {!!Form::open(['action' => ['teacherInfoController@destroy',$x->teacher_info_id],'method' => 'POST', 'class' => 'd-inline'])!!}
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
    <h5 class="modal-title">New Teacher</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>

    {!! Form::open(['action' => 'teacherInfoController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','class' => 'form p-5']) !!}
    <div class="modal-body">
  <div class="form-group">
  {{Form::label('name','Name')}}
  {{Form::text('name','', ['class' => 'form-control', 'placeholder' => 'Enter  Name'])}}
  </div>
  <div class="form-group">
  {{Form::label('email','Email')}}
  {{Form::email('email','', ['class' => 'form-control', 'placeholder' => 'Enter  email'])}}
  </div>
  <div class="form-group">
  {{Form::label('cnic','CNIC')}}
  {{Form::text('cnic','', ['class' => 'form-control', 'placeholder' => 'Enter  cnic (with out dash)'])}}
  </div>
  <div class="form-group">
  {{Form::label('contact','Contact Number')}}
  {{Form::tel('contact','', ['class' => 'form-control', 'placeholder' => 'Enter  Number'])}}
  </div>
  
  <div class="form-group">
  {{Form::label('address','Address')}}
  {{Form::text('address','', ['class' => 'form-control', 'placeholder' => 'Enter  Address'])}}
  </div>
  
  
  <div class="form-group">
  {{Form::label('gender','Gender')}}
  {{Form::select('gender',$gender,null, ['class' => 'form-control'])}}
  </div>

  <div class="form-group">
  {{Form::label('department','Department')}}
  {{Form::select('department',$data['dep'],null,['class' => 'form-control','id' => 'depart'])}}
  </div>
  

  {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}
  </div>
  </div>
  </div>

 
{{-- <script>
   jQuery(document).ready(function(){
    jQuery(document).on('change','#depart',function(){
      var id = this.value;
       jQuery.ajax({
        url: "{{ url('/student/dep') }}",
        method: 'post',
        data: {
         id: id,
        },
        headers:{
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
        jQuery('#prg').html(response);
        jQuery('#sec').html();
        }});
       });
    jQuery(document).on('change','#sem',function(){
      var prg_id = jQuery('#program').val();
      var dep_id = jQuery('#depart').val();
      var sem_id = this.value;
      // alert(dep_id);
       jQuery.ajax({
        url: "{{ url('/student/sec') }}",
        method: 'post',
        data: {
         prg_id: prg_id,
         dep_id: dep_id,
         sem_id: sem_id,
        },
        headers:{
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
        jQuery('#sec').html(response);
        }});
       });
    });
</script> --}}


@endsection
