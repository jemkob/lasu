
@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Student Manager</h3>
  </div>
    <div class="box-body">
        
        {!! Form::open(['action'=> ['StudentManagerController@update', $showstudent->id], 'method' => 'GET']) !!}

        <div class="form-group">
            {{Form::label('matricno', 'Matric No')}}
            {{Form::text('MatricNo', $showstudent->MatricNo, ['class' => 'form-control', 'placeholder'=>'Matric No'])}}
        </div>

        <div class="form-group">
                {{Form::label('surname', 'Last Name')}}
                {{Form::text('Surname', $showstudent->Surname, ['class' => 'form-control', 'placeholder'=>'Sur Name'])}}
        </div>

        <div class="form-group">
            {{Form::label('Middlename', 'Middle Name')}}
            {{Form::text('Middlename', $showstudent->Middlename, ['class' => 'form-control', 'placeholder'=>'MiddleName'])}}
        </div>

        <div class="form-group">
            {{Form::label('Jambregno', 'Jamb Registration No.')}}
            {{Form::text('JambRegNo', $showstudent->JambRegNo, ['class' => 'form-control', 'placeholder'=>'Jamb Reg No'])}}
        </div>

        <div class="form-group">
            {{Form::label('Faculty', 'Faculty Name')}}
            {{Form::text('facultyName', $showstudent->facultyName, ['class' => 'form-control', 'placeholder'=>'Faculty'])}}
        </div>

        <div class="form-group">
            {{Form::label('SOR', 'State')}}
            {{Form::text('SOR', $showstudent->SOR, ['class' => 'form-control', 'placeholder'=>'State'])}}
        </div>

        <div class="form-group">
            {{Form::label('country', 'Country')}}
            {{Form::text('country', $showstudent->Nationality, ['class' => 'form-control', 'placeholder'=>'Country'])}}
        </div>
        @method('PUT')
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    
        {!! Form::close() !!}


       
        

    </div>

</div>
@endsection