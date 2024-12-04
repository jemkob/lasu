@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Course Manager</h3>
  </div>
  <div style="padding-left:10px; padding-right:10px;">
      <div style="float:right;"><a href ="course/create" class="btn btn-primary"><i class="fa fa-lg fa-plus"></i> Add New</a></div>
        <div style="float:left;">
          <form action="{{url('course/search')}}" method="post" >
            {{csrf_field()}}
              <table width="100%" border="0">
                <tr>
                  <td nowrap>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search">
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


        @if(count($subjects) > 0)
         

         <table class="table table-striped" style="text-transform:uppercase;">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th>Subject Name</th>
                <th nowrap>Course Code</th>
                <th nowrap>Course Status</th>
                <th nowrap>Course Unit</th>
                <th nowrap>Subject Level</th>
                
                <th scope="col">#</th>
              </tr>
            </thead>
            
            
            <tbody>
            @foreach($subjects as $index =>$subject)
              <tr>
                <th scope="row">{{$index+1}}</th>
                <td>{{$subject->CourseTitle}}</td>
                <td>{{$subject->CourseCode}}</td>
                <td>{{$subject->CourseStatus}}</td>
                <td>{{$subject->CourseUnit}}</td>
                <td>{{$subject->CourseLevel}}</td>
 
                <td><a href ="/course/{{$subject->Id}}/edit"><i class="fa fa-lg fa-edit"></i></a></td>
                <td>
                    
                    <form action="{{url('course/delete')}}" method="get">
                      {{csrf_field()}}
                      <input type="hidden" name="subjectid" value={{$subject->Id}}>
                      <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this course? You cannot undo this action');"><i class="fa fa-lg fa-times"></i></button>
                    </form>

<script>
function myFunction() {
    alert("You do not have permission to delete this course. Contact the super administrator.");
}
</script>
                </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
           {{$subjects->links()}} 

         

         

         @else

         no one

         @endif
          

    </div>

</div>
@endsection

