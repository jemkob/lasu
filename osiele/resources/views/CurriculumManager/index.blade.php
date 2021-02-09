@extends('adminlte::page')





@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Curriculum Manager</h3>
    <div style="float:right;"><a href ="/CurriculumManager/create" class="btn btn-primary"><i class="fa fa-lg fa-plus"></i> Add New</a></div>
  </div>
    <div class="box-body">
            <div class="row">
                    <div class="col-sm-4">
                      <form action="{{url('CurriculumManager/search')}}" method="get">
                        {{csrf_field()}}
                              

                                  <div class="form-group">
                                        <label for="">Schools</label>
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
                
                              {{-- <div class="form-group">
                                <label for="">Semester</label>
                                <select class="form-control" name="semester" id="semester">
                                  <option value="0" disable="true" selected="true">-- Select Semester --</option>
                                  <option value="1">1st Semester</option> 
                                  <option value="2">2nd Semester</option>
                                </select>
                              </div> --}}
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
                
                              
                              <div class="col-md-6">
                                <button class="btn btn-primary" type="submit">View Curriculum</button>
                            </div>
                      </form>
                    </div>
                  </div>
                          
        
@if(isset($curriculumsview))
    @if (count($curriculumsview) === 0)
    <div class="alert alert-danger">
        <strong>No curriculum was found</strong>
    </div>
    @elseif (count($curriculumsview) >= 1)

        <table class="table table-striped" width="70%">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Course Code</th>
                    <th scope="col">Course Status</th>
                    <th scope="col">Course Unit</th>
                    <th scope="col">Course Title</th>
                    <th scope="col">CAT Percentage</th>
                    <th scope="col">Exam Percentage</th>
                    <th scope="col">Pass Mark</th>
                    
                    <th scope="col">#</th>
                  </tr>
                </thead>
                
                
                
                <tbody>
                @foreach($curriculumsview as $index =>$curriculum)
                  <tr>
                    <td scope="row">{{$index+1}}</td>
                    <td>{{$curriculum->subjectcode}}</td>
                    <td>{{$curriculum->subjectunit}}</td>
                    <td>{{$curriculum->subjectvalue}}</td>
                    <td>{{$curriculum->subjectname}}</td>
                    <td>30</td>
                    <td>60</td>
                    <td>40</td>
                    <td nowrap>
                     
                      <form name="form1" method="get" action="{{url('CurriculumManager/deletecourse')}}">
                        {{csrf_field()}} 
                       
                        <a class="btn btn-primary" href ="/CurriculumManager/{{$curriculum->AllCombinedID}}/edit"><i class="fa fa-lg fa-edit"></i>Edit</a>
                      <input name="subcurricullum" type="hidden" id="subcurricullum" value="{{$curriculum->AllCombinedID}}">
                      <input name="subjectid" type="hidden" id="subjectid" value="{{$curriculum->SubjectID}}">
                      <input class="btn btn-danger" type="submit" name="button" id="button" value="Delete" onclick="return confirm('Are you sure you want to delete the select course(s)? You cannot undo this action');">
                      </form>
                    </td>
                  </tr>
                  @endforeach
                  
                </tbody>
              </table>
              {{-- {{$curriculumsview->links()}} --}}
  
    
    
@endif
@endif



    </div>

</div>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> --}}
  
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


