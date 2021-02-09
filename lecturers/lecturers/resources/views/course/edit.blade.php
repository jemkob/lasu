
@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Student Manager</h3>
  </div>
    <div class="box-body">
        
        {{--  {!! Form::open(['action'=> ['CourseController@update', $subjects->id], 'method' => 'POST']) !!}  --}}
        
        {!! Form::model($subjects, array('route' => array('course.update', $subjects->id), 'method' => 'PUT')) !!}

        <div class="form-group">
                {{Form::label('subject', 'Subject Name')}}
                {{Form::text('subjectname', $subjects->SubjectName, ['class' => 'form-control', 'placeholder'=>'Subject Name'])}}
            </div>
    
            <div class="form-group">
                    {{Form::label('subjectcode', 'Subject Code')}}
                    {{Form::text('subjectcode', $subjects->SubjectCode, ['class' => 'form-control', 'placeholder'=>'Subject Code'])}}
            </div>
    
            <div class="form-group">
                {{Form::label('subjectvalue', 'Subject Value')}}
                {{Form::text('subjectvalue', $subjects->SubjectValue, ['class' => 'form-control', 'placeholder'=>'Subject Value'])}}
            </div>
    
            <div class="form-group">
                    {{Form::label('subjectunit', 'Subject Unit')}}
                    {{Form::text('subjectunit', $subjects->SubjectUnit, ['class' => 'form-control', 'placeholder'=>'subjectunit'])}}
            </div>
    
            <div class="form-group">
                {{Form::label('semester', 'Semester')}}
                {{Form::text('facultyname', $subjects->Semester, ['class' => 'form-control', 'placeholder'=>'Semester'])}}
            </div>
    
            <div class="form-group">
                    {{Form::label('subjectlevel', 'Subject Level')}}
                    {{Form::text('subjectlevel', $subjects->SubjectLevel, ['class' => 'form-control', 'placeholder'=>'Subject Level'])}}
            </div>
        
        @method('PUT')
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    
        {!! Form::close() !!}


       
        

    </div>

</div>
@endsection