
@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Student Manager</h3>
  </div>
    <div class="box-body">
      <table width="50%">
        <tr>
          <td>

        
         {!! Form::open(['action'=> ['CourseController@update', $subjects->Id], 'method' => 'POST']) !!} 
        
         <div class="form-group">
            {{Form::label('subject', 'Subject Name')}}
            {{Form::text('subjectname', $subjects->CourseTitle, ['class' => 'form-control', 'placeholder'=>'Subject Name'])}}
        </div>

        <div class="form-group">
                {{Form::label('subjectcode', 'Subject Code')}}
                {{Form::text('subjectcode', $subjects->CourseCode, ['class' => 'form-control', 'placeholder'=>'Course Code eg. ACC 101'])}}
        </div>

        <div class="form-group">
            {{Form::label('subjectstatus', 'Subject Status')}}
            {{Form::text('subjectstatus', $subjects->CourseStatus, ['class' => 'form-control', 'placeholder'=>'Subject Status eg. C'])}}
        </div>

        <div class="form-group">
                {{Form::label('subjectunit', 'Course Unit')}}
                {{Form::text('subjectunit', $subjects->CourseUnit, ['class' => 'form-control', 'placeholder'=>'Course Unit eg. 3'])}}
        </div>


        <div class="form-group">
                {{Form::label('subjectlevel', 'Course Level')}}
                {{Form::text('subjectlevel', $subjects->CourseLevel, ['class' => 'form-control', 'placeholder'=>'Course Level eg 300'])}}
        </div>
        {{ Form::hidden('_method', 'PUT') }}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        <a class="btn btn-secondary">Cancel</a>
    
        {!! Form::close() !!}


          </td>
        </tr>
      </table>
        

    </div>

</div>
@endsection