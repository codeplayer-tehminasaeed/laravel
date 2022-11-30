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
  <h3>Assign Courses</h3>
  <table class="table  table-responsive">
  <thead class="thead-inverse">
  <tr>

    <th>Teacher Name</th>
    <th>Department</th>
    <th>Course</th>
    <th>Lecture Type</th>
    <th>Modify</th>
  </tr>
  </thead>
  <tbody>
    @foreach ($data['teacherCourse'] as $x)
    
    <tr>
    <td>
      @if($x->lec_type == 'lab')
        @foreach ($data['labTec'] as $item)
          @if($item->teacher_course_id == $x->teacher_course_id)
            {{$item->name}}
          @endif
        @endforeach
      @else
        {{$x->name}}
      @endif  
    </td>
    <td>{{$x->dep_name}}</td>
    <td>{{$x->course_name}} ( {{$x->prg_name }}  {{$x->semester}}-{{$x->sec_name }} )</td>
    <td>{{$x->lec_type}}</td>
    
    <td>
      @if($x->lec_type == 'regular')
      {{-- <a href="/teacherCourses/{{$x->teacher_course_id}}/edit"><i class="fa fa-edit text-primary" data-toggle="modal" data-target="#model{{$x->teacher_course_id}}"></i>  </a>  / --}}
        <i class="fa fa-trash text-danger" data-toggle="modal" data-target="#modeldel{{$x->teacher_course_id}}"></i>

    <div class="modal fade" id="modeldel{{$x->teacher_course_id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
        {!!Form::open(['action' => ['TeacherCoursesController@destroy',$x->teacher_course_id],'method' => 'POST', 'class' => 'd-inline'])!!}
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No Cancel</button>
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
        {!! Form::close() !!}
        </div>
      </div>
      </div>
      </div>
    @endif
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
    <h5 class="modal-title">Assign Course</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>

    {!! Form::open(['action' => 'TeacherCoursesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','class' => 'form p-5']) !!}
      <div class="modal-body">

    
          <div class="form-group">
            {{Form::label('department','Department')}}
            {{Form::select('department',$data['dep'],null,['class' => 'form-control','id' => 'depart'])}}
          </div>
          <div class="form-group" id="prg">
          
          </div>
          
          <div class="form-group">
            {{Form::label('semester','Semester')}}
            {{Form::select('semester',$sem,null,['class' => 'form-control','id' => 'sem'])}}
          </div>

          <div class="form-group" id="course">
          
          </div>

          <div class="form-group" id="teachers">
          
          </div>
          <div class="form-group" id="lab">
          
          </div>


          {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
          {!! Form::close() !!}
      </div>
    </div>
  </div>

 
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
        jQuery('#sec').html();
        }});
       });
       
    
    jQuery(document).on('change','#cou',function(){
      var id = this.value;

       jQuery.ajax({
        url: "{{ url('/teacherCourses/checklab') }}",
        method: 'post',
        data: {
         id: id,
        },
        headers:{
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
          // console.log(response);
        jQuery('#lab').html(response);
        
        }});
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

        }});
       });
    });
</script>


@endsection
