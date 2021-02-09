@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Student Manager</h3>
  </div>
    <div class="box-body">


        @if(count($subjects) > 1)
         

         <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Subject Name</th>
                <th scope="col">Subject Code</th>
                <th scope="col">Subject Value</th>
                <th scope="col">Subject Unit</th>
                <th scope="col">Semester</th>
                <th scope="col">Subject Level</th>
                
                <th scope="col">#</th>
              </tr>
            </thead>
            
            
            <tbody>
            @foreach($subjects as $index =>$subject)
              <tr>
                <th scope="row">{{$index+1}}</th>
                <td>{{$subject->SubjectName}}</td>
                <td>{{$subject->SubjectCode}}</td>
                <td>{{$subject->SubjectValue}}</td>
                <td>{{$subject->SubjectUnit}}</td>
                <td>{{$subject->Semester}}</td>
                <td>{{$subject->SubjectLevel}}</td>
 
                <td><a href ="course/{{$subject->SubjectID}}/edit"><i class="fa fa-lg fa-edit"></i></a></td>
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

