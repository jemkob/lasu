@extends('adminlte::page')


@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Activity Schedule Manager</h3>
   
  </div>
  <div style="padding-left:10px; padding-right:10px;">
    <div style="float:right;"><a href ="activityschedule/create" class="btn btn-success"><i class="fa fa-lg fa-plus"></i>Add New</a></div>
    <div style="float:left;"> </div>
  </div>
    <div class="box-body">
            <div class="row">
                    <div class="col-sm-4">
                      
                    </div>
                  </div>
                               

        

@if(isset($activityschedule))
    @if (count($activityschedule) === 0)
    <div class="alert alert-danger">
        <strong>No Activity Scheduled.</strong>
    </div>
    @elseif (count($activityschedule) > 0)

        <table class="table table-striped" width="70%">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Activity Description</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                
                
                
                <tbody>
                @foreach($activityschedule as $index =>$activity)
                  <tr style="text-transform:uppercase;">
                    <td scope="row">{{$index+1}}</td>
                    <td>{{$activity->ActivityDescription}}</td>
                    <td>{{$activity->StartDate}}</td>
                    <td>{{$activity->EndDate}}</td>
                    <td> </td>
                    <td><a href="{{url('activityschedule/delete').'?scheduleid='.$activity->activityscheduleId}}" class="btn btn-danger" onclick="return confirm('Do you want to delete this schedule?');"><i class="fa fa-lg fa-times"></i></a></td>
                    <td>
                        
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

