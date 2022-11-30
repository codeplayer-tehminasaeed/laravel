@extends('layouts.master')
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous">
</script>
@section('content')
<?php
  $sem = array('select'=>'Select Semester','1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,'6'=>6,'7'=>7,'8'=>8);
  $data['dep']->prepend('Select Department','select');
  $gender = array('Male'=>'Male','Female'=>'Female');
?>
    @foreach ($data['teacher'] as $x)
{!! Form::open(['action' => ['teacherInfoController@update', $x->teacher_info_id], 'method' => 'POST']) !!}
      <div class="modal-body">
        <div class="form-group">
          {{Form::label('name','Name')}}
          {{Form::text('name',$x->name, ['class' => 'form-control', 'placeholder' => 'Enter  Name'])}}
          </div>
          <div class="form-group">
          {{Form::label('email','Email')}}
          {{Form::email('email',$x->email, ['class' => 'form-control', 'placeholder' => 'Enter  email','disabled'])}}
          </div>
          <div class="form-group">
          {{Form::label('cnic','CNIC')}}
          {{Form::text('cnic',$x->teacher_cnic, ['class' => 'form-control', 'placeholder' => 'Enter  cnic','disabled'])}}
          </div>
           <div class="form-group">
          {{Form::label('contact','Contact Number')}}
          {{Form::text('contact',$x->contact, ['class' => 'form-control', 'placeholder' => 'Enter  Contact Number'])}}
          </div>
          <div class="form-group">
          {{Form::label('address','Address')}}
          {{Form::text('address',$x->address, ['class' => 'form-control', 'placeholder' => 'Enter  Address'])}}
          </div>
          
          
          <div class="form-group">
          {{Form::label('gender','Gender')}}
          {{Form::select('gender',$gender,$x->gender, ['class' => 'form-control'])}}
          </div>
        
          <div class="form-group">
          {{Form::label('department','Department')}}
          {{Form::select('department',$data['dep'],$x->dep_id,['class' => 'form-control','id' => 'depart'])}}
          </div>
          
        @endforeach
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Update',['class' => 'btn btn-warning'])}}
    {!! Form::close() !!}
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
     </script>
      --}}
    @endsection