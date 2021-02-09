@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Student Manager</h3>
  </div>
    <div class="box-body">


        @if(count($users) > 1)
         

         <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Matric No.</th>
                <th scope="col">Last Name</th>
                <th scope="col">First Name</th>
                <th scope="col">Middle Name</th>
                <th scope="col">#</th>
              </tr>
            </thead>
            
            
            <tbody>
            @foreach($users as $index =>$user)
              <tr>
                <th scope="row">{{$index+1}}</th>
                <td>{{$user->MatricNo}}</td>
                <td>{{$user->Surname}}</td>
                <td>{{$user->Firstname}}</td>
                <td>{{$user->Middlename}}</td>
                <td><a href ="studentmanager/{{$user->StudentID}}/edit"><i class="fa fa-lg fa-edit"></i></a></td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
          {{$users->links()}}

         

         

         @else

         no one

         @endif
          

    </div>

</div>
@endsection

