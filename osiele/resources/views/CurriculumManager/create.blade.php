@extends('adminlte::page')





@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Curriculum Manager</h3>
  </div>
    <div class="box-body">
            <div class="row">
                    <div class="col-sm-4">
                      <form action="{{url('CurriculumManager/addcourse')}}" method="post">
                        
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
                                        <label for="">Session</label>
                                        <select class="form-control" name="sessions" id="sessions" required>
                                          <option value="0" disable="true" selected="true">-- Select Session --</option>
                                            @foreach ($sessions as $key => $value)
                                              @if($value->CurrentSession == 1)
                                                <option value="{{$value->SessionID}}">{{ $value->SessionYear }} (Current Session)</option>
                                              @else 
                                                <option value="{{$value->SessionID}}">{{ $value->SessionYear }}</option>
                                              @endif
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
                            
                              <div class="form-group">
                                    <label for="">Course</label>
                                    <select class="form-control" name="course" id="subjectid">
                                      <option value="0" disable="true" selected="true">-- Select Course--</option>
                                        @foreach ($subjects as $key => $value)
                                          <option value="{{$value->Id}}">{{ $value->CourseCode }}</option>
                                        @endforeach
                                    </select>
                              </div>
                              
                              <div class="col-md-6">
                                <button class="btn btn-primary" type="submit">Save New Curriculum</button>
                            </div>
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
              $('#departments').append('<option value="'+ departmentsObj.DepartmentID +'">'+ departmentsObj.DepartmentName +'</option>');
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


