@extends('adminlte::page')





@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Suspension Cases | Effect Suspension</h3>
  </div>
    <div class="box-body">
  <div class="row">
    <div class="col-sm-4">
      <form action="{{url('suspension/suspend')}}" method="post">
        {{csrf_field()}}
              <div class="form-group">
                <label for="">Probation</label>
                <select class="form-control" name="semester" id="semester" required="required">
                  <option value="" disable="true" selected="true">-- Select Semester--</option>
                    <option value="1">1st Semester</option>
                    <option value="2">2nd Semester</option>
                </select>
              </div>

              <div class="form-group">
                <label for="">Session</label>
                <select class="form-control" name="session" id="session" required="required">
                  <option value="0" disable="true" selected="true">-- Select Session --</option>
                    @foreach ($sessions as $key => $value)
                      <option value="{{$value->SessionID}}">{{ $value->SessionYear }}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="">Matric No.</label>
                <input type="text" class="form-control" name="matricno" id="matricno" required="required">
              </div>
              <div class="col-md-6">
                <button class="btn btn-primary" type="submit">Effect suspension</button>
            </div>
      </form>
    </div>
  </div>
          

        {{-- {!! Form::close() !!} --}}


    </div>

</div>

@endsection