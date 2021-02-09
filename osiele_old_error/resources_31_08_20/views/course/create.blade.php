
@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">SChool Manager</h3>
  </div>
    <div class="box-body">
        
        {!! Form::open(['action'=>'CourseController@store', 'method' => 'POST']) !!}

        <div class="form-group">
            {{Form::label('subject', 'Subject Name')}}
            {{Form::text('subjectname', '', ['class' => 'form-control', 'placeholder'=>'Subject Name'])}}
        </div>

        <div class="form-group">
                {{Form::label('subjectcode', 'Subject Code')}}
                {{Form::text('subjectcode', '', ['class' => 'form-control', 'placeholder'=>'Subject Code'])}}
        </div>

        <div class="form-group">
            {{Form::label('subjectvalue', 'Subject Value')}}
            {{Form::text('subjectvalue', '', ['class' => 'form-control', 'placeholder'=>'Subject Value'])}}
        </div>

        <div class="form-group">
                {{Form::label('subjectunit', 'Subject Unit')}}
                {{Form::text('subjectunit', '', ['class' => 'form-control', 'placeholder'=>'subjectunit'])}}
        </div>

        <div class="form-group">
            {{Form::label('subjectsemester', 'Semester')}}
            {{Form::text('subjectsemester', '', ['class' => 'form-control', 'placeholder'=>'Semester'])}}
        </div>

        <div class="form-group">
                {{Form::label('subjectlevel', 'Subject Level')}}
                {{Form::text('subjectlevel', '', ['class' => 'form-control', 'placeholder'=>'Subject Level'])}}
        </div>
	
        {{ Form::hidden('active', '1') }}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    
        {!! Form::close() !!}


       
        

    </div>

</div>
@endsection