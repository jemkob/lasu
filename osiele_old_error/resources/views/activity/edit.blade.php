@extends('adminlte::page')
@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Edit Activity</h3>
  </div>
    <div class="box-body">
            <div class="row">
                    <div class="col-6 col-sm-6">
                      <form action="{{url('activity/update')}}" method="get">
                        
                        {{csrf_field()}}
                        <table width="573" border="0" class="table table-striped">
                          <tr>
                            <td><label>Activity Code</label></td>
                          <td><input type="text" name="activitycode" id="activitycode" class="form-control" value="{{$activity->ActivityCode}}"/></td>
                          </tr>
                          <tr>
                            <td><label>Activity Description</label>&nbsp;</td>
                            <td><input type="text" name="activitydesc" id="activitydesc" class="form-control" value="{{$activity->ActivityDescription}}" /></td>
                          </tr>
                              <input type="hidden" name="activityid" value="{{$activity->activityId}}">
                          <tr>
                            <td></td>
                            <td><input type="submit" name="button" id="button" value="Update Activity"  class="btn btn-primary"></td>
                          </tr>
                            </table>
                          </form>
                          
                    </div>
                  </div>
                          
        


    </div>

</div>

@endsection