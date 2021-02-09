@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Change Password</h3>
  </div>
  <div class="box-body">
  <div class="row">
        <div class="col-sm-4">
          <form action="{{url('lecturer/setpassword')}}" method="post">
            {{csrf_field()}}
                  
                  <div class="form-group">
                <label for="">Enter Old Password</label>
                <input type="password" class="form-control" name="oldpassword" id="oldpassword" required="required">
                <label for="">Enter New Password</label>
                <input type="password" class="form-control" name="newpassword" id="newpassword" required="required">
                <label for="">Confirm Password</label>
                <input type="password" class="form-control" name="newpassword2" id="newpassword2" required="required">
                  </div>
    
                  
                  <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Change Password</button>
                </div>
          </form>
        </div>
      </div>
  </div>

</div>
@endsection

