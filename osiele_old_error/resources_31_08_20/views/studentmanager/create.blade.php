
@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Student Manager</h3>
  </div>
    <div class="box-body">
        
        {!! Form::open(['action'=>'StudentManagerController@store', 'method' => 'POST']) !!}

        <div class="form-group">
                {{Form::label('surname', 'Last Name')}}
                {{Form::text('Surname', '', ['class' => 'form-control', 'placeholder'=>'Sur Name'])}}
        </div>

        <div class="form-group">
            {{Form::label('Middlename', 'Middle Name')}}
            {{Form::text('Middlename', '', ['class' => 'form-control', 'placeholder'=>'MiddleName'])}}
        </div>

        <div class="form-group">
            {{Form::label('Jambregno', 'Jamb Registration No.')}}
            {{Form::text('JambRegNo', '', ['class' => 'form-control', 'placeholder'=>'Jamb Reg No'])}}
        </div>

        <div class="form-group">
            {{Form::label('Scholl', 'School Name')}}
            {{Form::text('facultyName', '', ['class' => 'form-control', 'placeholder'=>'School'])}}
        </div>

        <div class="form-group">
            {{Form::label('SOR', 'State')}}
            {{Form::text('SOR', '', ['class' => 'form-control', 'placeholder'=>'State'])}}
        </div>

        <div class="form-group">
            {{Form::label('country', 'Country')}}
            {{Form::text('country', '', ['class' => 'form-control', 'placeholder'=>'Country'])}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    
        {!! Form::close() !!}


       
        

    </div>

</div>
@endsection