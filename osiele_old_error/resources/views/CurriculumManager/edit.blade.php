
@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Curriculum Manager</h3>
  </div>
    <div class="box-body">
      <table width="50%">
        <tr>
          <td>

        
         {!! Form::open(['action'=> ['CurriculumController@update', $subjects->AllCombinedID], 'method' => 'POST']) !!} 
        
         <div class="form-group">
            {{Form::label('subject', 'Subject Name')}}
            {{Form::text('subjectname', $subjects->SubjectName, ['class' => 'form-control', 'placeholder'=>'Subject Name'])}}
        </div>
      <input type="hidden" name="session" value="{{$subjects->sessionid}}">
      <input type="hidden" name="subjectid" value="{{$subjects->SubjectID}}">
      <input type="hidden" name="subjectcombineid" value="{{$subjects->SubjectCombineID}}">
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
            {{Form::text('semester', $subjects->Semester, ['class' => 'form-control', 'placeholder'=>'Semester'])}}
        </div>

        <div class="form-group">
                {{Form::label('subjectlevel', 'Subject Level')}}
                {{Form::text('subjectlevel', $subjects->SubjectLevel, ['class' => 'form-control', 'placeholder'=>'Subject Level'])}}
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