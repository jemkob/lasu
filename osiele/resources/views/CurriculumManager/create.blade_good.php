@extends('adminlte::page')





@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Curriculum Manager</h3>
  </div>
    <div class="box-body">
            <div class="row">
              <form action="" id="cc">
                    <div class="col-sm-4">
                      
                        
                        {{csrf_field()}}
                              

                                  <div class="form-group">
                                        <label for="">School</label>
                                        <select class="form-control" name="faculties" id="faculties">
                                          <option value="0" disable="true" selected="true">--- Select School ---</option>
                                            @foreach ($faculties as $key => $value)
                                              <option value="{{$value->FacultyID}}">{{ $value->FacultyName }}</option>
                                            @endforeach
                                        </select>
                                      </div>
                            
                                      <div class="form-group">
                                        <label for="">Departments</label>
                                        <select class="form-control" name="departments" id="departments">
                                          <option value="0" disable="true" selected="true">--- Select Department ---</option>
                                        </select>
                                      </div>
                          
                                      <div class="form-group">
                                          <label for="">Programmes</label>
                                          <select class="form-control" name="programmes" id="programmes">
                                            <option value="0" disable="true" selected="true">--- Select Programme ---</option>
                                          </select>
                                        </div>

                                  <div class="form-group">
                                        <label for="">Session</label>
                                        <select class="form-control" name="sessions" id="sessions">
                                          <option value="0" disable="true" selected="true">-- Select Session --</option>
                                            @foreach ($sessions as $key => $value)
                                              <option value="{{$value->SessionID}}">{{ $value->SessionYear }}</option>
                                            @endforeach
                                        </select>
                                      </div>
                
                              
                              <div class="form-group">
                                    <label for="">Level</label>
                                    <select class="form-control" name="level" id="level">
                                      <option value="0" disable="true" selected="true">-- Select Level --</option>
                                      <option value="100">100</option> 
                                      <option value="200">200</option>
                                      <option value="300">300</option>
                                      <option value="400">400</option>
                                      <option value="500">500</option>
                                    </select>
                                  </div>
                            
                              
                      
                    </div>
                    <div class="col-sm-12">
                                <table class="table table-striped" width="100%" id="courses">
                                  <tr>
                                    <td></td><td>Course Code</td><td>Title</td><td>Unit</td><td>Status</td>
                                  </tr>

                                </table>
                                  <a name="C4"></a>
                                  <a href='#C4' onclick="CheckAll()" class="btn btn-danger">Check All</a>
                                  <br><br>
                              </div>
                              
                              
                              <div class="col-md-6">
                                <input class="btn btn-primary" id='save' type="submit" value="Save New Curriculum">
                            </div>
                  </form>
                  </div>
    </div>

</div>
<script>
 
  function CheckAll() {
      var x = document.getElementsByName("course[]");
      var i;
      for (i = 0; i < x.length; i++) {
          if (x[i].type == "checkbox") {
              x[i].checked = true;
          }
      }
  }
  </script>

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

        

        $('#level').on('change', function(e){
          console.log(e);
          var department_id = e.target.value;
          var level = $( "#level" ).val();
          var combination = $( "#programmes" ).val();
          var session = $( "#sessions" ).val();
          console.log(combination);
          $.get('/curriculumcourses?level=' + level + '&combination='+combination+'&sessions='+session,function(data) {
            console.log(data);
           
            $('table#courses').empty();
            $.each(data, function(index, coursesObj){
              $('table#courses').append('<tr><td scope="col" width="5px"> <input type="checkbox" name="course[]" id="course" value="'+coursesObj.SubjectID+'"></td><td><label for="'+coursesObj.SubjectCode+'">'+coursesObj.SubjectCode+'</label></td><td>'+coursesObj.SubjectName+'</td> <td>'+coursesObj.SubjectValue+'</td><td>'+coursesObj.SubjectUnit+'</td></tr>');
            })
          });
        });

        // $('form').submit(function(e){
          $('#cc').on('submit', function(e) {
          console.log(e);

          
          var level = $( "#level" ).val();
          var programmes = $( "#programmes" ).val();
          var sessions = $( "#sessions" ).val();
          var faculties = $( "#faculties" ).val();
          var departments = $( "#departments" ).val();
          var semester = $( "#semester" ).val();
          var courses = [$( "#course" ).val()];
          var course = encodeURIComponent(JSON.stringify(courses));
         
         console.log(course);
          
          $.get('/addcur?level=' + level + '&programmes='+programmes+'&sessions='+sessions+'&faculties='+faculties+'&departments='+departments+'&semester='+semester+'&course='+course,function(data) {
            console.log(data);
           
            $('table#courses').empty();
            $.each(data, function(index, coursesObj){
              $('table#courses').append('<tr><td scope="col" width="5px"> '+coursesObj+'</td></tr>');
              
            })
          }); 
          return false;
        });
   
   
      </script> 
@endsection


