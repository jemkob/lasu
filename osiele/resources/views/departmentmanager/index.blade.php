@extends('adminlte::page')
@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Department Manager</h3>
    
  </div>
  <div style="padding-left:10px; padding-right:10px;">
      <div style="float:right;"><a href ="/departmentmanager/create" class="btn btn-primary"><i class="fa fa-lg fa-plus"></i> Add New</a></div>
      <div style="float:left;">
          <form action="{{url('departmentmanager/search')}}" method="post" >
            {{ csrf_field() }}
              <table width="100%" border="0">
                <tr>
                  <td nowrap>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search Department">
                  </td>
                  <td>
                    <button class="btn btn-success" type="submit">Search</button>
                </td>
                </tr>
              </table>
            </form>
            
          </div>
    </div>
    <div class="box-body">
            <div class="row">
                    <div class="col-sm-4">
                      
                    </div>
                  </div>
                          
        
@if(isset($departmentview))
    @if (count($departmentview) === 0)
    <div class="alert alert-danger">
        <strong>No department was found</strong>
    </div>
    @elseif (count($departmentview) >= 1)

        <table class="table table-striped" width="70%">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    
                    <th scope="col">School</th>
                    <th scope="col">Department Code</th>
                    <th scope="col">Department Name</th>
                    
                    <th scope="col">#</th>
                  </tr>
                </thead>
                
                
                
                <tbody>
                @foreach($departmentview as $index =>$department)
                  <tr>
                    <td scope="row">{{$index+1}}</td>
                    <td>{{$department->facultyname}}</td>
                    <td>{{$department->DepartmentCode}}</td>
                    <td>{{$department->DepartmentName}}</td>
                    
                    <td>
                        <a href ="departmentmanager/{{$department->DepartmentID}}/edit"><i class="fa fa-lg fa-edit"></i></a>
                       
                      </td>
                      <td>
                          {!! Form::open(['action'=> ['DepartmentController@destroy', $department->DepartmentID], 'method' => 'POST']) !!} 
                            
                            {{ Form::hidden('_method', 'PUT') }}
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this department? You cannot undo this action');"><i class="fa fa-lg fa-times"></i></button>
                                {!! Form::close() !!}
                        </td>
                  </tr>
                  @endforeach
                  
                </tbody>
              </table>
             Showing {{$departmentview->firstItem()}} to {{$departmentview->lastItem()}} of {{$departmentview->total()}}<br/><br/>
             {{$departmentview->links()}}
             
  
    
    
@endif
@endif



    </div>

</div>


@endsection


