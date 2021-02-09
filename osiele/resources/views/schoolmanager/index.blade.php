@extends('adminlte::page')


@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">School Manager</h3>
    <div style="padding-left:10px; padding-right:10px;">
        <div style="float:right;"><a href ="/schoolmanager/create" class="btn btn-primary"><i class="fa fa-lg fa-plus"></i> Add New</a></div></div>
  </div>
    <div class="box-body">


        @if(count($school) > 1)
         

         <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Faculty Name</th>
                <th scope="col">Faculty Code</th>
                
                <th scope="col">#</th>
              </tr>
            </thead>
            
            
            <tbody>
            @foreach($school as $index =>$faculty)
              <tr>
                <th scope="row">{{$index+1}}</th>
                <td>{{$faculty->FacultyName}}</td>
                <td>{{$faculty->FacultyCode}}</td>
                
                <td><a href ="schoolmanager/{{$faculty->FacultyID}}/edit"><i class="fa fa-lg fa-edit"></i></a></td>
                <td>
                          <form action="{{url('schoolmanager/delete')}}" method="get">
                            {{csrf_field()}}
                            <input type="hidden" name="schoolid" value={{$faculty->FacultyID}}>
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this School? You cannot undo this action');"><i class="fa fa-lg fa-times"></i></button>
                          </form>
                  </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
          {{--  {{$school->links()}}  --}}

         

         

         @else

         no one

         @endif
          

    </div>

</div>
@endsection

