
@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">SChool Manager</h3>
  </div>
    <div class="box-body">
        
        {!! Form::open(['action'=>'SchoolController@store', 'method' => 'POST']) !!}

        <div class="form-group">
            {{Form::label('Faculty', 'Faculty Name')}}
            {{Form::text('facultyname', '', ['class' => 'form-control', 'placeholder'=>'Faculty Name'])}}
        </div>

        <div class="form-group">
                {{Form::label('facultycode', 'Faculty Code')}}
                {{Form::text('facultycode', '', ['class' => 'form-control', 'placeholder'=>'Faculty Code'])}}
        </div>

        
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    
        {!! Form::close() !!}


       
        

    </div>

</div>
@endsection