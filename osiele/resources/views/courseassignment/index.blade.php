@extends('adminlte::page')


@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Course Assignment Manager</h3>
   
  </div>
  <div style="padding-left:10px; padding-right:10px;">
    <div style="float:right;"><a href ="/courseassignment/create" class="btn btn-primary"><i class="fa fa-lg fa-plus"></i>Add New</a></div>
    <div style="float:left;">
        <form action="{{url('courseassignment/search')}}" method="post" >
          {{ csrf_field() }}
            <table width="100%" border="0">
              <tr>
                <td nowrap>
                  <input type="text" name="search" id="search" class="form-control" placeholder="Search Course">
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
                          
        
@if(isset($courseview))
    @if (count($courseview) === 0)
    <div class="alert alert-danger">
        <strong>Course not assigned.</strong>
    </div>
    @elseif (count($courseview) >= 1)

        <table class="table table-striped" width="70%">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Course Code</th>
                    <th scope="col">Course Title</th>
                    <th scope="col">Lecturer</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                
                
                
                <tbody>
                @foreach($courseview as $index =>$course)
                  <tr style="text-transform:uppercase;">
                    <td scope="row">{{$index+1}}</td>
                    <td>{{$course->subjectcode}}</td>
                    <td>{{$course->subjectname}}</td>
                    <td>{{$course->surname}} {{$course->firstname}}</td>
                    <td>
                      <form action="{{url('courseassignment/showassign')}}" method="post">
                        {{csrf_field()}}
                        
                        <input type="hidden" name="id" value={{$course->subjectid}}>
                            <button class="btn btn-primary" type="submit" onclick="return confirm('Do you want to edit this course assignment?');"><i class="fa fa-lg fa-edit"></i></button>
                      </form></td>
                    <td>
                      {{-- <form action="{{url('courseassignment/deleteassignemt')}}" method="post">
                        {{csrf_field()}}
                        
                        <input type="hidden" name="id" value={{$course->lecturerprofileid}}>
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this course assignment?');"><i class="fa fa-lg fa-times"></i></button>
                      </form> --}}
                    </td>
                    
                  </tr>
                  @endforeach
                  
                </tbody>
              </table>
              {{$courseview->links()}}
  
    
    
@endif
@endif



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


