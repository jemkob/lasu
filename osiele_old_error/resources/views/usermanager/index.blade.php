@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h1 class="box-title">User Manager</h1>
  </div>
  <div style="padding-left:10px; padding-right:10px;">
      <div style="float:right;"><a href ="usermanager/create" class="btn btn-primary"><i class="fa fa-lg fa-plus"></i> Add New</a></div>
      <div style="float:left;">
          <form action="{{url('usermanager/search')}}" method="post" >
            {{ csrf_field() }}
              <table width="100%" border="0">
                <tr>
                  <td nowrap>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search Lecturer">
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
         

         <table class="table table-striped" width="50%">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">IsApproved</th>
                <th scope="col">Role</th>
                
                <th scope="col">#</th>
              </tr>
            </thead>
            
            
            <tbody>
            @foreach($users as $index =>$user)
              <tr>
                <th scope="row">{{$index+1}}</th>
                <td>{{$user->Username}}</td>
                <td>{{$user->email}}</td>
                
                <td>True</td>
                <td>{{$user->RoleName}}</td>
                <td>
                  <a href ="usermanager/{{$user->AdminID}}/edit"><i class="fa fa-lg fa-edit"></i></a>
                 
                </td>
                <td>
                    
                  </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
         @else

         <div class="alert alert-danger">
            <strong>No user was found.</strong>
        </div>

         @endif
          

    </div>

</div>
@endsection

