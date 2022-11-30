@extends('layouts.master')
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous">
</script>
@section('content')

  <div class="row">
    <div class="col-md-1"></div>
        <div class="col-md-10">
          {!! Form::open(['action' => 'ExcelUploadController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','class' => 'form']) !!}
     
            <div class="form-group">
                {{Form::label('file','Upload Your File')}}
                {{Form::file('file')}}
                {{-- {{Form::file('file','', ['class' => 'form-control'])}} --}}
            </div>
        
            {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>

    <div class="col-md-1"></div>

  </div>
  <div class="row">
        <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
      @foreach ($data as $item)
        
                <tr>
                    <td>{{$item->file}}</td>
                    <td><a href="storage/files/{{$item->file}}" download><i class="fa fa-download" aria-hidden="true"></i></a></td>
                </tr>
      @endforeach
            </tbody>
        </table>       
    </div>
  

  

@endsection
