@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h1 class="box-title">Staff Manager</h1>
  </div>
  <div style="padding-left:10px; padding-right:10px;">
      <div style="float:right;"><a href ="/staffmanager/create" class="btn btn-primary"><i class="fa fa-lg fa-plus"></i> Add New</a></div>
      <div style="float:left;">
          <form action="{{url('staffmanager/search')}}" method="post" >
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
     

        @if(count($staffs) > 1)
         

         <table class="table table-striped" width="70%">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Surname</th>
                <th scope="col">Last Name</th>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
                <th scope="col">HOD</th>
                
                <th scope="col">#</th>
              </tr>
            </thead>
            
            
            <tbody>
            @foreach($staffs as $index =>$staff)
              <tr>
                <th scope="row">{{($staffs->currentPage()-1) * 50 + ($index+1)}}</th>
                <td>{{$staff->Surname}}</td>
                <td>{{$staff->Firstname}}</td>
                
                <td>{{$staff->UserName}}</td>
                <td>*****</td>
                {{-- Check if lecturer is HOD or not --}}
                @if($staff->HOD == 1)
                <td>YES</td>
                @else
                <td>NO</td>
                @endif
                {{-- end HOD check --}}
                
                <td>
                  <a href ="/staffmanager/{{$staff->LecturerID}}/edit"><i class="fa fa-lg fa-edit"></i></a>
                 
                </td>
                <td>
                    {!! Form::open(['action'=> ['StaffController@destroy', $staff->LecturerID], 'method' => 'POST']) !!} 
                      
                      {{ Form::hidden('_method', 'PUT') }}
                          <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this student? You cannot undo this action');"><i class="fa fa-lg fa-times"></i></button>
                          {!! Form::close() !!}
                  </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
          {{$staffs->links()}}
          {{--  {{$school->links()}}  --}}
         @else
<p></p><p></p><p></p>
         <div class="alert alert-danger">
            <strong>No lecturer was found.</strong>
        </div>

         @endif
          

    </div>

</div>
@endsection

