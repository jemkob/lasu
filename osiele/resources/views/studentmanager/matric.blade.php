@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Student Manager</h3>
  </div>
    <div class="box-body">


        @if(count($newstudents) > 0)
         

         <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Student ID</th>
                <th scope="col">Matric No.</th>
                <th scope="col">Last Name</th>
                <th scope="col">First Name</th>
                <th scope="col">Middle Name</th>
                <th scope="col">School ID</th>
                <th scope="col">Major</th>
                <th scope="col">Minor</th>
                <th scope="col">Level</th>
              </tr>
            </thead>
            
            
            <tbody><?php $matric=0; $myear = substr($sessions->SessionYear, 2, 2);?>
            @foreach($newstudents as $index =>$user)
            <?php 
                $matric++; 
                $matricpad = str_pad($matric, 4, "0", STR_PAD_LEFT); 
                $imatric=$myear.'/'.$matricpad;
                ?>
              <tr>
                <th>{{$user->studentid}}</th>
              <td>{{$imatric}} New: <strong>{{$user->matricno}}</strong></td>
                <td>{{$user->surname}}</td>
                <td>{{$user->firstname}}</td>
                <td>{{$user->middlename}}</td>
                <td>{{$user->facultyid}}</td>
                <td>{{$user->major}}</td>
                <td>{{$user->minor}}</td>
                <td>{{$user->level}}</td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
          <p></p>
          
          <a href="matric/generate" class="btn btn-primary btn-lg">Generate Matric</a>
          {{-- {{$users->links()}} --}}
         @else

         No new student.

         @endif
          

    </div>

</div>
@endsection

