@extends('layouts.master')
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous">
</script>
@section('content')
<?php
  $sem = array('select'=>'Select Semester','1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,'6'=>6,'7'=>7,'8'=>8);
  $data['dep']->prepend('Select Department','select');
?>
    @foreach ($data['teacherCourse'] as $x)
{!! Form::open(['action' => ['TeacherCoursesController@update', $x->teacher_course_id], 'method' => 'POST']) !!}
      <div class="modal-body">
       
          
          <div class="form-group">
          {{Form::label('department','Department')}}
          {{Form::select('department',$data['dep'],$x->dep_id,['class' => 'form-control','id' => 'depart'])}}
          </div>
          
          <?php
              $pid = '';
          ?>
          <div class="form-group" id="prg">
          <label>Programs </label>
          <select class="form-control" name="program" id="program">
            <option>Select Program</option>
            @foreach($data['prg'] as $p)
            @if($x->dep_id == $p->dep_id)
              <?php $pid = $p->program_id ?>
              <option <?php  if($pid == $x->prg_id)  echo "selected" ;?> value="{{$p->program_id}}">{{$p->prg_name}}</option>
            @endif
            @endforeach
            </select>
          </div>
          <div class="form-group">
          {{Form::label('semester','Semester')}}
          {{Form::select('semester',$sem,$x->semester,['class' => 'form-control','id' => 'sem'])}}
          </div>
          <div class="form-group" id="sec">
            <label>Sections</label>
            <select class="form-control" name="section" id="program">
            <option>Select Section</option>
            
            @foreach($data['sec'] as $s)
              @if($s->prg_id == $pid && $x->semester == $s->semester)
              <option <?php  if($s->section_id == $x->sec_id)  echo "selected" ;?> value="{{$s->section_id}}">{{$s->sec_name}}</option>
              @endif
            @endforeach
            </select>
          </div>
          <div class="form-group" id="course">
            <label>Course</label>
            <select class="form-control" name="courses" id="course">
            <option>Select Course</option>
            @foreach($data['course'] as $c)
              @if($c->prg_id == $pid && $x->course_id == $c->course_id)
              <option <?php  if($x->course_id == $c->course_id)  echo "selected" ;?> value="{{$c->course_id}}">{{$c->course_name}}</option>
              @endif
            @endforeach
            </select>
          </div> 
          <div class="form-group" id="tec">
            <label>Teacher</label>
            <select class="form-control" name="teacher" id="tec">
            <option>Select Teacher</option>
            @foreach($data['teacher'] as $t)
              @if($t->dep_id == $x->dep_id)
              <option <?php  if($t->teacher_id == $x->teacher_id)  echo "selected" ;?> value="{{$t->teacher_info_id}}">{{$t->name}}</option>
              @endif
            @endforeach
            </select>
          </div> 
        @endforeach
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Update',['class' => 'btn btn-warning'])}}
    {!! Form::close() !!}
    <script>
      jQuery(document).ready(function(){
       jQuery(document).on('change','#depart',function(){
         var id = this.value;
          jQuery.ajax({
           url: "{{ url('/teacherCourses/dep') }}",
           method: 'post',
           data: {
            id: id,
           },
           headers:{
             'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
           },
           success: function(response){
           jQuery('#prg').html(response);
           jQuery('#sec').html(' ');
           jQuery('#tec').html(' ');
           }});
          });

          jQuery(document).on('change','#program',function(){
           var id = jQuery('#sem').val('select');
            
            });
       jQuery(document).on('change','#sem',function(){
         var prg_id = jQuery('#program').val();
         var dep_id = jQuery('#depart').val();
         var sem_id = this.value;
         // alert(dep_id);
          jQuery.ajax({
           url: "{{ url('/teacherCourses/course') }}",
           method: 'post',
           data: {
            dep_id: dep_id,
            prg_id: prg_id,
            sem_id: sem_id,
           },
           headers:{
             'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
           },
           success: function(response){
           jQuery('#course').html(response);
           jQuery('#sec').html(' ');
           jQuery('#tec').html(' ');

           }});
          });
       });
   </script>
   
    
    @endsection