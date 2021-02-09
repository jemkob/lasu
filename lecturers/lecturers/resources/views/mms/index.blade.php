@extends('adminlte::page')





@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Result Manager</h3>
  </div>
    <div class="box-body">
            <div class="row">
                    <div class="col-sm-4">
                      <form action="{{url('mms/search')}}" method="post">
                        {{csrf_field()}}
                            <div class="form-group">
                            <label for="">Department</label>
                            <select class="form-control" disabled>
                                <option value="0" disable="true" selected="true">{{$department->DepartmentName}}</option>
                            </select>
                            </div>
                
                            <div class="form-group">
                                <label for="">Programmes</label>
                                <select class="form-control" name="programmes" id="programmes">
                                <option value="0" disable="true" selected="true">--- Select Programme ---</option>
                                @foreach ($programme as $key => $value)
                                <option value="{{$value->SubjectCombinID}}">{{ $value->SubjectCombinName }}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                    <label for="">Courses</label>
                                    <select class="form-control" name="courses" id="courses">
                                      <option value="0" disable="true" selected="true">--- Select Course ---</option>
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
                    <label for="">Semester</label>
                    <select class="form-control" name="semester" id="semester">
                        <option value="0" disable="true" selected="true">-- Select Semester --</option>
                        <option value="1">1st Semester</option> 
                        <option value="2">2nd Semester</option>
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
                              
                        <div class="col-md-6">
                            <button class="btn btn-primary" type="submit">Get Results</button>
                        </div>
                      </form>
                    </div>
                  </div>
                
                
                  <br>
                  <br>
                  @if(isset($results))
                     @if (count($results) === 0)
                     <div class="alert alert-info">
                      <strong>No result was found</strong>
                    </div>
                  @elseif (count($results) >= 1)
                  
                  <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-8">
                    <h2>{{$results[0]->subjectcode}}</h2>
                    <hr>
                    <table width="50%" border="1" class="table table-striped table-bordered table-hover col-md-8">
                        <tr>
                          <th scope="col">Matric No</th>
                          
                          <th scope="col">Exam Score</th>
                          <th scope="col">CA</th>
                          <th scope="col"><b>Total</b></th>
                          
                          
                        </tr>
                        @foreach($results as $result)
                        <tr>
                          <td>{{$result->matricno}}</td>
                          
                          <td>{{$result->exam}}</td>
                          <td>{{$result->ca}}</td>
                          @if(($result->exam + $result->ca)>= 40)
                          <td><b>{{$result->exam + $result->ca}}</b></td>
                          @else
                          <td class="alert alert-danger"><b>{{$result->exam + $result->ca}}</b></td>
                          @endif
                          
                          
                        </tr>
                        @endforeach
                      </table>
                    </div>
                  </div>
                      
                      
                  @endif
                  @endif
                  
        
                  
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
      <script type="text/javascript">
        

        $('#programmes').on('change', function(e){
          console.log(e);
          var programme_id = e.target.value;
          $.get('json-courses?programme_id=' + programme_id,function(data) {
            console.log(data);
            $('#courses').empty();
            $('#courses').append('<option value="0" disable="true" selected="true">--- Select Course ---</option>');

            $.each(data, function(index, coursesObj){
              $('#courses').append('<option value="'+ coursesObj.subjectid +'">'+ coursesObj.subjectname +'</option>');
            })
          });
        });
   
      </script>
    
@endsection