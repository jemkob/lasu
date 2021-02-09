
@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Session Manager</h3>
  </div>
    <div class="box-body">
        
            {!! Form::open(['action'=> ['SessionController@update', $sessions->SessionID], 'method' => 'POST']) !!} 
        
            {{-- {!! Form::model($subjects, array('route' => array('course.update', $subjects->id), 'method' => 'PUT')) !!} --}}
    
            <div class="form-group">
                    {{Form::label('sessionyear', 'Session Year')}}
                    {{Form::text('sessionyear', $sessions->SessionYear, ['class' => 'form-control', 'placeholder'=>'Session Year'])}}
                </div>
        
                <div class="form-group">
                        {{Form::label('currentsession', 'Current Session')}}
                        
                        
                        {{ Form::select('currentsession', [
                                            '0' => 'No',
                                            '1' => 'Yes'], null, ['class' => 'form-control']
                                            ) }}
                </div>
        
                
                {{ Form::hidden('_method', 'PUT') }}
            {{-- @method('PUT') --}}
            {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
            <a class="btn btn-secondary" href="{{ route('sessionmanager.index') }}">Cancel</a>
        
            {!! Form::close() !!}


       
        

    </div>

</div>
@endsection