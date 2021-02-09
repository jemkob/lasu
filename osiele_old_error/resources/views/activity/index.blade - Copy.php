@extends('adminlte::page')





@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Curriculum Manager</h3>
  </div>
    <div class="box-body">
            <div class="row">
                    <div class="col-sm-4">
                      <form action="{{url('CurriculumManager/search')}}" method="post">
                        {{csrf_field()}}
                              <div class="form-group">
                                <label for="">Faculty</label>
                                <select class="form-control" name="faculty" id="faculty">
                                  <option value="0" disable="true" selected="true">-- Select Faculty --</option>
                                    @foreach ($faculties as $faculty)
                                      <option value="{{$faculty->FacultyID}}"> {{$faculty->FacultyName}}</option>
                                    @endforeach
                                </select>
                              </div>

                              <div class="form-group">
                                    <label for="">Department</label>
                                    <select class="form-control" name="department" id="department">
                                      <option value="0" disable="true" selected="true">-- Select Department --</option>
                                        @foreach ($departments as $department)
                                          <option value="{{$department->DepartmantID}}">{{ $department->DepartmentName }}</option>
                                        @endforeach
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label for="">Programme(Subject Combination)</label>
                                    <select class="form-control" name="programme" id="programme">
                                      <option value="0" disable="true" selected="true">-- Select Programme --</option>
                                        @foreach ($programmes as $programme)
                                          <option value="{{$programme->SubjectCombinID}}">{{ $programme->SubjectCombinName }}</option>
                                        @endforeach
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
                                <button class="btn btn-primary" type="submit">View Curriculum</button>
                            </div>
                      </form>
                    </div>
                  </div>
                          
        @if(isset($curriculums))
        @if(count($curriculums) > 1)
        <table class="table table-striped" width="70%">
                <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Course Code</th>
                          <th scope="col">Course Status</th>
                          
                          <th scope="col">Course Title</th>
                          <th scope="col">CAT Percentage</th>
                          <th scope="col">Exam Percentage</th>
                          <th scope="col">Pass Mark</th>
                          
                          <th scope="col">#</th>
                        </tr>
                      </thead>
           
           
           
           <tbody>
           @foreach($curriculums as $index =>$curriculum)
           <tr>
                <td scope="row">{{$index+1}}</td>
                <td>{{$curriculum->subjectcode}}</td>
                <td>{{$curriculum->subjectunit}}</td>
                <td>{{$curriculum->subjectname}}</td>
                <td>30</td>
                <td>60</td>
                <td>40</td>
                <td></td>
              </tr>
             @endforeach
             
           </tbody>
         </table>
         {{$curriculums->links()}}
         @else

         No Session, <a href="sessionmanager/create">Add New Session</a>

         @endif
         @endif

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
                    <td>{{$curriculum->subjectname}}</td>
                    <td>30</td>
                    <td>60</td>
                    <td>40</td>
                    <td></td>
                  </tr>
                  @endforeach
                  
                </tbody>
              </table>
              {{$curriculumsview->links()}}
  
    
    
@endif
@endif
    </div>

</div>


@endsection


