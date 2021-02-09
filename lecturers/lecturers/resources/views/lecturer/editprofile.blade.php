@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Edit Profile</h3>
  </div>
  <div class="box-body">
    @if(Auth::user()->Email =="" || Auth::user()->Email == NULL || Auth::user()->PhoneNumber =="" || Auth::user()->PhoneNumber == NULL)
    <div class="alert alert-warning">Update Your Email/Phone No. Information</div>
    @endif
    <div class="clearfix"></div>
  
          <form action="{{url('lecturer/editprofileaction')}}" method="post">
            {{csrf_field()}}
            <div class="row">
              <div class="col-sm-4">    
                  <div class="form-group">
                    <label for="">Surname</label>
                    <input type="surname" class="form-control" name="surname" id="surname" value="{{Auth::user()->Surname}}" disabled>
                    <label for="">First Name</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" value="{{Auth::user()->Firstname}}" disabled>
                    <label for="">Username</label>
                  <input type="username" class="form-control" name="username" id="username" value="{{Auth::user()->UserName}}" disabled>
                    {{-- <label for="">Middle Name</label>
                    <input type="text" class="form-control" name="middlename" id="middlename" value="{{Auth::user()->Middlename}}"> --}}
                  </div>
              </div>

              <div class="col-sm-4">    
                <div class="form-group">
                  
                  <label for="">Phone Number</label>
                  <input type="text" class="form-control" name="phone" id="phone" value="{{Auth::user()->PhoneNumber}}" placeholder="eg. 08012345678">
                  <label for="">Email</label>
                  <input type="email" class="form-control" name="email" id="email" value="{{Auth::user()->Email}}" placeholder="yourname@email.com" required="required">
                  
                </div>
            </div>
    
                  
                  <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Update Profile</button>
                </div>
              
            </div>
          </form>
        
  </div>

</div>
@endsection

