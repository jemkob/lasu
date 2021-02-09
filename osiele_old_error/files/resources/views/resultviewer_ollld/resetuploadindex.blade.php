@extends('adminlte::page')





@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Reset Upload</h3>
  </div>
    <div class="box-body">
      
  <div class="row">
    <div class="col-sm-4">
      <form action="{{url('resetupload')}}" method="post">
        {{csrf_field()}}
              <div class="form-group">
                <label for="">Subject</label>
                <select class="form-control" name="subject" id="subject" required="required">
                  <option value="" disable="true" selected="true">-- Select Subject --</option>
                    @foreach ($courses as $key => $value)
                      <option value="{{$value->SubjectID}}">{{ $value->SubjectCode }}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <button class="btn btn-primary" type="submit">Reset Upload</button>
            </div>
      </form>
    </div>
  </div>
          



    </div>

</div>

@endsection


