@extends('adminlte::page')
@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Course Assignment</h3>
  </div>
    <div class="box-body">
            <div class="row">
                    <div class="col-sm-4">
                      <form action="{{url('courseassignment/assign')}}" method="post">
                        
                        {{csrf_field()}}
                            <table width="600" border="0">
                              <tr>
                                <td></td>
                                <td></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td><label for="select">Course</label></td>
                                <td><label for="select">Lecturer</label></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>
                                  <select class="form-control" name="subjectid" id="subjectid">
                                      <option value="0" disable="true" selected="true">--- Select Course ---</option>
                                        @foreach ($subjects as $key => $value)
                                          <option value="{{$value->SubjectID}}">{{ $value->SubjectCode }}</option>
                                        @endforeach
                                    </select>
                                  </td>
                                <td>
                                    <select class="form-control" name="lecturerid" id="lecturerid">
                                    <option value="0" disable="true" selected="true">--- Select Lecturer ---</option>
                                      @foreach ($lecturers as $key => $value)
                                        <option value="{{$value->LecturerID}}">{{ $value->Surname.' '.$value->Firstname }}</option>
                                      @endforeach
                                  </select>
                                </td>
                                <td><input type="submit" name="button" id="button" value="Assign Course"  class="btn btn-primary"></td>
                              </tr>
                            </table>
                          </form>
                          
                    </div>
                  </div>
                          
        


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


