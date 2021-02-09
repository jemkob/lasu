@extends('adminlte::page')


@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Activity Manager</h3>
   
  </div>
  <div style="padding-left:10px; padding-right:10px;">
    <div style="float:right;"><a href ="activity/create" class="btn btn-success"><i class="fa fa-lg fa-plus"></i>Add New</a></div>
    <div style="float:left;"> </div>
  </div>
    <div class="box-body">
            <div class="row">
                    <div class="col-sm-4">
                      
                    </div>
                  </div>


@if(isset($activities))
    @if (count($activities) === 0)
    <div class="alert alert-danger">
        <strong>No Activity.</strong>
    </div>
    @elseif (count($activities) > 0)

        <table class="table table-striped" width="70%">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Activity Code</th>
                    <th scope="col">Activity Description</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                
                
                
                <tbody>
                @foreach($activities as $index =>$activity)
                  <tr style="text-transform:uppercase;">
                    <td scope="row">{{$index+1}}</td>
                    <td>{{$activity->ActivityCode}}</td>
                    <td>{{$activity->ActivityDescription}}</td>
                    <td>
                      <form action="{{url('activity/edit')}}" method="post">
                        {{csrf_field()}}
                        
                        <input type="hidden" name="id" value=>
                        <a href="activity/{{$activity->activityId}}/edit" class="btn btn-primary" onclick="return confirm('You are about to edit this activity, continue?');"><i class="fa fa-lg fa-edit"></i></a>
                      </form></td>
                    <td>
                    </td>
                    <td>
                        <a href="{{url('activity/delete').'?activityid='.$activity->activityId}}" class="btn btn-danger" onclick="return confirm('Do you want to delete this activity?');"><i class="fa fa-lg fa-times"></i></a>
                    </td>
                    
                  </tr>
                  @endforeach
                  
                </tbody>
              </table>
  
    
    
@endif
@endif

    </div>

</div>
@endsection

