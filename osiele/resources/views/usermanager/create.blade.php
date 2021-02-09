
@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">User Manager</h3>
  </div>
    <div class="box-body">
        
        {!! Form::open(['action'=>'UserController@store', 'method' => 'POST']) !!}

     <div class="row">
        <div class="col-6 col-sm-6">
        <form id="form1" name="form1" method="post" action="">
                <table width="573" border="0" class="table table-striped">
                    <tr>
                        <td><label>Username</label></td>
                      <td><input type="text" name="username" id="username" class="form-control" placeholder="Surname" /></td>
                      </tr>
                      <tr>
                        <td><label>Password</label></td>
                        <td><input type="password" name="password" id="password" class="form-control" placeholder="First Name"/></td>
                      </tr>
                      
                      <tr>
                        <td><label>Email</label>&nbsp;</td>
                        <td><input type="text" name="email" id="email" class="form-control" placeholder="Email" /></td>
                      </tr>
                      <tr>
                        <td><label for="">Role</label></td>
                        <td>
                                <select class="form-control" name="role" id="role">
                                  <option value="0" disable="true" selected="true">--- Select Role ---</option>
                                    @foreach ($roles as $key => $value)
    
                                      <option value="{{$value->RoleID}}">{{ $value->RoleName }}</option>
                                    @endforeach
                                </select>
                        </td>
                      </tr>
                  
                  <tr>
                        <td></td>
                        <td>{{Form::submit('Add New User', ['class'=>'btn btn-primary'])}}</td>
                      </tr>
                </table>
              </form>
        </div>
        </div>
        
    
        {!! Form::close() !!}


       
        

    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
      <script type="text/javascript">
        $('#faculties').on('change', function(e){
          console.log(e);
          var faculty_id = e.target.value;
          $.get('/json-departments?faculty_id=' + faculty_id,function(data) {
            console.log(data);
            $('#departments').empty();
            $('#departments').append('<option value="0" disable="true" selected="true">--- Select Department ---</option>');

            $('#programmes').empty();
            $('#programmes').append('<option value="0" disable="true" selected="true">--- Select Programme ---</option>');

            $.each(data, function(index, departmentsObj){
              $('#departments').append('<option value="'+ departmentsObj.DepartmantID +'">'+ departmentsObj.DepartmentName +'</option>');
            })
          });
        });

        $('#departments').on('change', function(e){
          console.log(e);
          var department_id = e.target.value;
          $.get('/json-programmes?department_id=' + department_id,function(data) {
            console.log(data);
            $('#programmes').empty();
            $('#programmes').append('<option value="0" disable="true" selected="true">--- Select Programme ---</option>');

            $.each(data, function(index, programmesObj){
              $('#programmes').append('<option value="'+ programmesObj.SubjectCombinID +'">'+ programmesObj.SubjectCombinName +'</option>');
            })
          });
        });
   
      </script> 
@endsection