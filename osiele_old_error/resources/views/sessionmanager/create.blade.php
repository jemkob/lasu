
@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Session Manager | Add New Session</h3>
  </div>
    <div class="box-body">
        <hr>
        {!! Form::open(['action'=>'SessionController@store', 'method' => 'POST']) !!}

        <div class="form-group">
             <label for="">Session</label>
            <select name="session" class="form-control" id="" required="required">
                <option value="" disable="true" selected="true">-- Select Session --</option>
                <option value="2018/2019">2018/2019</option>
                <option value="2019/2020">2019/2020</option>
                <option value="2020/2021">2020/2021</option>
                <option value="2021/2022">2021/2022</option>
            </select>
        </div>
        <div class="form-group">
             <label for="">Current Session?</label>
                <select name="currentsession" class="form-control" id="" required="required">
                        <option value="0" disable="true" selected="true">-- Select Session Status--</option>
                        <option value="1">Yes</option>
                        <option value="2">No</option>
                </select>
            </div>
        
        {{Form::submit('Create New Session', ['class'=>'btn btn-primary'])}}
    
        {!! Form::close() !!}

    </div>

</div>
@endsection