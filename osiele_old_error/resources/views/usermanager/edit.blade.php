
@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">User Manager</h3>
  </div>
    <div class="box-body">
        
        {!! Form::open(['action'=> ['UserController@update', $users->AdminID], 'method' => 'POST']) !!} 

     <div class="row">
        <div class="col-6 col-sm-6">
        <form id="form1" name="form1" method="post" action="">
                <table width="573" border="0" class="table table-striped">
                  <tr>
                    <td><label>Username</label></td>
                  <td><input type="text" name="username" id="username" class="form-control" placeholder="Surname" value="{{$users->Username}}" /></td>
                  </tr>
                  <tr>
                    <td><label>Password</label></td>
                    <td><input type="password" name="password" id="password" class="form-control" placeholder="First Name" value="{{$users->Password}}"/></td>
                  </tr>
                  
                  <tr>
                    <td><label>Email</label>&nbsp;</td>
                    <td><input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{$users->email}}"   /></td>
                  </tr>
                  <tr>
                    <td><label for="">Role</label></td>
                    <td>
                            <select class="form-control" name="role" id="role">
                              <option value="0" disable="true" selected="true">--- Select Role ---</option>
                                @foreach ($roles as $key => $value)

                                  <option value="{{$value->RoleID}}" {{ $value->RoleID == $users->role ? 'selected="true"' : "" }}>{{ $value->RoleName }}</option>
                                @endforeach
                            </select>
                    </td>
                  </tr>
                  
                  <tr>
                        <td></td>
                        <td>{{ Form::hidden('_method', 'PUT') }} {{Form::submit('Update User', ['class'=>'btn btn-primary'])}}</td>
                      </tr>
                </table>
              </form>
        </div>
        </div>
        
    
        {!! Form::close() !!}


       
        

    </div>

</div>

@endsection