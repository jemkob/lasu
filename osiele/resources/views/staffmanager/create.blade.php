
@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Staff Manager</h3>
  </div>
    <div class="box-body">
        
        {!! Form::open(['action'=>'StaffController@store', 'method' => 'POST']) !!}

     <div class="row">
        <div class="col-6 col-sm-6">
        <form id="form1" name="form1" method="post" action="">
                <table width="573" border="0" class="table table-striped">
                  <tr>
                    <td><label>Surname</label></td>
                    <td><input type="text" name="surname" id="surname" class="form-control" placeholder="Surname" /></td>
                  </tr>
                  <tr>
                    <td><label>First Name</label></td>
                    <td><input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" /></td>
                  </tr>
                  <tr>
                    <td><label>Middle Name</label>&nbsp;</td>
                    <td><input type="text" name="middlename" id="middlename" class="form-control" placeholder="Middle Name"/></td>
                  </tr>
                  <tr>
                    <td><label>Username</label>&nbsp;</td>
                    <td><input type="text" name="username" id="username" class="form-control" placeholder="Username" /></td>
                  </tr>
                  {{-- <tr>
                    <td><label>Password</label>&nbsp;</td>
                    <td><input type="text" name="password" id="password" class="form-control" placeholder="Password" /></td>
                  </tr>
                  <tr> --}}
                    <td><label>Email</label>&nbsp;</td>
                    <td><input type="text" name="email" id="email" class="form-control" placeholder="Email" /></td>
                  </tr>
                  <tr>
                    <td><label>Phone Number</label>&nbsp;</td>
                    <td><input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone Number"/></td>
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
                                    <option value="0" disable="true" selected="true">--- Select Department ---</option>
                                  </select>
                    </td>
                  </tr> --}}
                  {{-- <tr>
                    <td><label for="">Rank</label></td>
                    <td>
                            <select class="form-control" name="rank" id="rank">
                              <option value="0" disable="true" selected="true">--- Select Rank ---</option>
                                @foreach ($rank as $key => $value)
                                  <option value="{{$value->StaffRankId}}">{{ $value->Rank }}</option>
                                @endforeach
                            </select>
                    </td>
                  </tr> --}}
                  
                  <tr>
                        <td></td>
                        <td>{{Form::submit('Add New Lecturer', ['class'=>'btn btn-primary'])}}</td>
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