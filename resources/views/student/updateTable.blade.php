@extends('layouts.master')
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous">
</script>
@section('content')

  <div class="row">
    <div class="col-md-1"></div>
        <div class="col-md-10">
            {!! Form::open(['action' => ['studentsController@update', $x->student_info_id], 'method' => 'POST']) !!}

            <div class="form-group">
                {{Form::label('table','Table')}}
                {{Form::textarea('table','', ['id'=>'cktable','class' => 'form-control', 'placeholder' => 'Any thind you want to write'])}}
            </div>
        
            {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>

    <div class="col-md-1"></div>

  </div>
  

  

@endsection
