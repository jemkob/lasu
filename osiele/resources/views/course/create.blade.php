
@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Course Manager</h3>
  </div>
    <div class="box-body row">
        <div class="col-lg-6">
        {!! Form::open(['action'=>'CourseController@store', 'method' => 'POST']) !!}

        <div class="form-group">
            {{Form::label('subject', 'Course Title')}}
            {{Form::text('subjectname', '', ['class' => 'form-control', 'placeholder'=>'eg. Child Psychology'])}}
        </div>

        <div class="form-group">
                {{Form::label('subjectcode', 'Course Code')}}
                {{Form::text('subjectcode', '', ['class' => 'form-control', 'placeholder'=>'Eg. EDU 123'])}}
        </div>

        <div class="form-group">
            {{Form::label('subjectunit', 'Course Unit')}}
            {{-- {{Form::text('subjectvalue', '', ['class' => 'form-control', 'placeholder'=>'Subject Value'])}} --}}
            <select name="subjectunit" id="subjectunit" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>
        </div>

        <div class="form-group">
                {{Form::label('subjectstatus', 'Course Status')}}
                {{-- {{Form::text('subjectunit', '', ['class' => 'form-control', 'placeholder'=>'subjectunit'])}} --}}
                <select name="subjectstatus" id="subjectstatus" class="form-control">
                    <option value="C">Compulsory (C)</option>
                    <option value="E">Elective (E)</option>
                </select>
        </div>

        <div class="form-group">
                {{Form::label('subjectlevel', 'Course Level')}}
                {{-- <input type="text" name="subjectlevel" id="subjectlevel" class="form-control"> --}}
                <select name="subjectlevel" id="subjectlevel" class="form-control">
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="300">300</option>
					<option value="400">400</option>
                    <option value="500">500</option>
                </select>
                {{-- {{Form::text('subjectlevel', '', ['class' => 'form-control', 'placeholder'=>'Subject Level'])}} --}}
        </div>
	
        {{ Form::hidden('active', '1') }}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    
        {!! Form::close() !!}


    </div>
        

    </div>

</div>
@endsection