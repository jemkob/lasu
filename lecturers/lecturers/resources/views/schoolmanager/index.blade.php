@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Student Manager</h3>
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
                <
                <td><a href ="schoolmanager/{{$faculty->FacultyID}}/edit"><i class="fa fa-lg fa-edit"></i></a></td>
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

