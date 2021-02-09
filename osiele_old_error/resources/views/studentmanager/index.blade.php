@extends('adminlte::page')

@section('content')
{{-- <script src="../js/angular.min.js"></script> --}}

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Student Manager</h3>
    
  </div>
  <div style="padding-left:10px; padding-right:10px;">
  <div style="float:right;"><a href ="studentmanager/create" class="btn btn-primary"><i class="fa fa-lg fa-plus"></i> Add New</a></div>
    <div style="float:left;">
      <form action="{{url('studentmanager/search')}}" method="post" >
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

      
        @if(count($users) > 0)
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
                <th scope="row">{{($users->currentPage()-1) * 100 + $index+1}}</th>
                <td>{{$user->MatricNo}}</td>
                <td>{{$user->Surname}}</td>
                <td>{{$user->Firstname}}</td>
                <td>{{$user->Middlename}}</td>
                <td><a href ="/studentmanager/{{$user->StudentID}}/edit"><i class="fa fa-lg fa-edit"></i></a></td>
                <td>
                  <form action="{{url('studentmanager/deletestudent')}}" method="post">
                    {{csrf_field()}}
                    
                    <input type="hidden" name="studentid" value={{$user->StudentID}}>
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this student? You cannot undo this action');"><i class="fa fa-lg fa-times"></i></button>
                  </form>
                </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
          {{$users->links()}}
         @else
         <hr>
         <br>
         <div class="alert-danger">
           <br>
         No Record Found
         <br>
         </div>
         @endif

      
          

    </div>

</div>
@endsection

