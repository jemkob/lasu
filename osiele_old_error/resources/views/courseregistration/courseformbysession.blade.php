@extends('adminlte::page')
@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Course Registration Manager</h3>
    
  </div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-4">
          <form action="{{url('courseregistration/searchbysession')}}" method="get">
            
            {{csrf_field()}}
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
                        <label for="">Matric No</label>
                        <input type="text"  class="form-control" name="matricno" id="matricno">
                    </div>
                  
                  <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Show Registered Courses</button>
                </div>
          </form>
        </div>
      </div>
                          
        
@if(isset($courseview))
    @if (count($courseview) === 0)
    <div class="alert alert-danger">
        <strong>No Registered Course for this student.</strong>
    </div>
    @elseif (count($courseview) >= 1)

       

    <table class="table table-striped" style="text-transform:uppercase;" width="70%">
        <tr><td class="alert alert-success"><h3>{{$courseview[0]->surname.' '.$courseview[0]->firstname.' '.$courseview[0]->middlename}} ({{$courseview[0]->major.'/'.$courseview[0]->minor}}) {{$courseview[0]->matricno}} [{{$currentsession->SessionYear}}]</h3></td></tr>
      </table>
      <form name="form1" method="post" action="{{url('courseregistration/deletecourse')}}">
                        {{csrf_field()}}
          <table class="table table-striped" style="text-transform:uppercase;" width="70%">
                  <thead>
                    <tr>
                      <th></th>
                      <th scope="col">#</th>
                      
                      <th scope="col">Course Title</th>
                      <th scope="col">Course Code</th>
                      <th scope="col">Unit</th>
                      
                      <th scope="col">Value</th>
                      <th scope="col">CA</th>
                      <th scope="col">EXAM</th>
                      <th scope="col">TOTAL</th>
                      <th scope="col">&nbsp;</th>
                    </tr>
                  </thead>
                  
                  
                  
                  <tbody>
                    
                  @foreach($courseview as $index =>$course)
                    <tr>
                      <td><input type="checkbox" name="resultid[]" id="resultid[]" value="{{$course->resultid}}"></td>
                      <td scope="row">{{$index+1}}</td>
                      <td>{{$course->subjectname}}</td>
                      <td>{{$course->subjectcode}}</td>
                      <td>{{$course->subjectunit}}</td>
                      <td>{{$course->subjectvalue}}</td>
                      <td>{{$course->ca}}</td>
                      <td>{{$course->exam}}</td>
                      <td><strong>{{$course->ca+$course->exam}}</strong></td>
                      <td>
                        {{-- <input name="resultid" type="hidden" id="resultid" value="{{$course->resultid}}"> --}}
                        
                      </td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
                <span>
                    <input class="btn btn-danger" type="submit" name="button" id="button" value="Delete" onclick="return confirm('Are you sure you want to delete the select course(s)? You cannot undo this action');"></span>
                    </form>
                {{-- Add course to courseform --}}
                <form name="form2" method="post" action="{{url('courseregistration/addcourse')}}">
                  {{csrf_field()}}
                  <table width="400" border="0">
                    <tr>
                      <td>&nbsp;</td>
                      <td colspan="2"><h3>Add A Course</h3></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>
                        <select class="form-control" name="addsubject" id="addsubject">
                            <option value="0" disable="true" selected="true">-- Select Course To Add --</option>
                              @foreach ($subjects as $key => $value)
                                <option value="{{$value->SubjectID}}">{{ $value->SubjectCode.' -  '.$value->SubjectName }}</option>
                              @endforeach
                          </select>
                          <input type="hidden" name="details" id="details" value="{{$courseview[0]->resultid}}">
                          <input type="hidden" name="matric" id="matric" value="{{$courseview[0]->matricno}}">
                          <input type="hidden" name="studentid" id="studentid" value="{{$courseview[0]->studentid}}">
                          <input type="hidden" name="resultid" id="resultid" value="{{$courseview[0]->resultid}}">
                          <input type="hidden" name="cursession" id="cursession" value="{{$courseview[0]->sessionid}}">
                          <input type="hidden" name="resultlevel" id="resultlevel" value="{{$courseview[0]->resultlevel}}">
                        </td>
                          <td><input class="btn btn-warning" type="submit" name="subjectbutton" id="subjectbutton" value="Add To Course Form" onclick="return confirm('Are you sure you want to add a course for {{$courseview[0]->matricno}}? You cannot undo this action');">
                          </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                </form>
             {{-- Showing {{$departmentview->firstItem()}} to {{$departmentview->lastItem()}} of {{$departmentview->total()}}<br/><br/>
             {{$departmentview->links()}} --}}
             
@endif
@endif



    </div>

</div>


@endsection


