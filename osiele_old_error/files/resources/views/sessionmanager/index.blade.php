@extends('adminlte::page')
@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Session Manager</h3>
    <div style="float:right;"><a href ="/sessionmanager/create" class="btn btn-primary"><i class="fa fa-lg fa-plus"></i> Add New</a></div>
  </div>
    <div class="box-body">


        @if(count($sessions) > 1)
         

         <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Session Year</th>
                <th scope="col">Current Session</th>
                
                <th scope="col">#</th>
              </tr>
            </thead>
            
            
            <tbody>
            @foreach($sessions as $index =>$session)
              <tr>
                <th scope="row">{{$index+1}}</th>
                <td>{{$session->SessionYear}}</td>
                <td>
                  @if($session->CurrentSession == 0)
                  No 
                  @elseif($session->CurrentSession == 1)
                  Yes
                  @endif
                </td>
                
                <td><a href ="sessionmanager/{{$session->SessionID}}/edit"><i class="fa fa-lg fa-edit"></i></a></td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
          {{--  {{$school->links()}}  --}}

         

         

         @else

         No Session, <a href="sessionmanager/create">Add New Session</a>

         @endif
          

    </div>

</div>
@endsection

