
@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Staff Manager</h3>
  </div>
    <div class="box-body">
        
        {!! Form::open(['action'=> ['StaffController@update', $staffs->LecturerID], 'method' => 'POST']) !!} 

     <div class="row">
        <div class="col-6 col-sm-6">
        <form id="form1" name="form1" method="post" action="">
                <table width="573" border="0" class="table table-striped">
                  <tr>
                    <td><label>Surname</label></td>
                  <td><input type="text" name="surname" id="surname" class="form-control" placeholder="Surname" value="{{$staffs->Surname}}" /></td>
                  </tr>
                  <tr>
                    <td><label>First Name</label></td>
                    <td><input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" value="{{$staffs->Firstname}}"/></td>
                  </tr>
                  {{-- <tr>
                    <td><label>Middle Name</label>&nbsp;</td>
                    <td><input type="text" name="middlename" id="middlename" class="form-control" placeholder="Middle Name" value="{{$staffs->Middlename}}"/></td>
                  </tr> --}}
                  <tr>
                    <td><label>Username</label>&nbsp;</td>
                    <td><input type="text" name="username" id="username" class="form-control" placeholder="Username" value="{{$staffs->UserName}}"/></td>
                  </tr>
                  <tr>
                    <td><label>Password</label>&nbsp;</td>
                    <td><input type="password" name="password" id="password" class="form-control" placeholder="Password" value="{{$staffs->Password}}"/> <input type="checkbox" onclick="showpassword()">Show Password</td>
                    <script type="text/javascript">
                    function showpassword() {
                        var x = document.getElementById("password");
                        if (x.type === "password") {
                          x.type = "text";
                        } else {
                          x.type = "password";
                        }
                      }
                    </script>
                  </tr>
                  <tr>
                    <td><label>Email</label>&nbsp;</td>
                    <td><input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{$staffs->Email}}"   /></td>
                  </tr>
                  <tr>
                    <td><label>Phone Number</label>&nbsp;</td>
                    <td><input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone Number" value="{{$staffs->PhoneNumber}}"/></td>
                  </tr>
                  {{-- <tr>
                    <td><label for="">School</label></td>
                    <td>
                            <select class="form-control" name="faculties" id="faculties">
                              <option value="0" disable="true" selected="true">--- Select School ---</option>
                                @foreach ($faculties as $key => $value)
                                  <option value="{{$value->FacultyID}}">{{ $value->FacultyName }}</option>
                                @endforeach
                            </select>
                    </td>
                  </tr>
                  <tr>
                    <td><label>Department</label>&nbsp;</td>
                    <td>
                            <select class="form-control" name="departments" id="departments">
                                <option value="{{$staffs->DepartmentID}}" selected="true">{{$staffs->DepartmentName}}</option>
                                    <option value="0" disable="true">--- Select Department ---</option>
                                  </select>
                    </td>
                  </tr>
                  <tr>
                    <td><label for="">Rank</label></td>
                    <td>
                            <select class="form-control" name="rank" id="rank">
                                <option value="{{$staffs->StaffRankId}}" selected="true">{{ $staffs->Rank }}</option>
                              <option value="0" disable="true" >--- Select Rank ---</option>
                                @foreach ($rank as $key => $value)
                                  <option value="{{$value->StaffRankId}}">{{ $value->Rank }}</option>
                                @endforeach
                            </select>
                    </td>
                  </tr> --}}
                  
                  <tr>
                        <td></td>
                        <td>{{ Form::hidden('_method', 'PUT') }} {{Form::submit('Update Information', ['class'=>'btn btn-primary'])}}</td>
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
            $('#departments').append('<option value="{{$staffs->DepartmentID}}" selected="true">{{$staffs->DepartmentName}}</option>');

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