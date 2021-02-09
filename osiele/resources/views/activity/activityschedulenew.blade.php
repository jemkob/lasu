@extends('adminlte::page')
@section('content')


<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Add New Activity</h3>
  </div>
    <div class="box-body">
            <div class="row">
                    <div class="col-6 col-sm-6">
                      <form action="{{url('activityschedule/createnew')}}" method="get">
                        
                        {{csrf_field()}}
                        <table width="573" border="0" class="table table-striped">
                          <tr>
                            <td><label>Activity Code</label></td>
                          <td>
                            <select class="form-control" name="activityid" id="activity">
                                <option value="0" disable="true" selected="true">--- Select Activity ---</option>
                                  @foreach ($activity as $key => $value)
                                    <option value="{{$value->activityId}}">{{ $value->ActivityCode.' =>  '.$value->ActivityDescription }}</option>
                                  @endforeach
                              </select></td>
                          </tr>
                          <tr>
                            <td><label>Start Date</label>&nbsp;</td>
                            <td><input type="text" name="startdate" id="startdate" class="form-control" placeholder="mm/dd/yyyy"/></td>
                          </tr>
                          <tr>
                            <td><label>End Date</label>&nbsp;</td>
                            <td><input type="text" name="enddate" id="enddate" class="form-control" placeholder="mm/dd/yyyy"/></td>
                          </tr>
                              
                          <tr>
                            <td></td>
                            <td><input type="submit" name="button" id="button" value="Add New Activity"  class="btn btn-primary"></td>
                          </tr>
                            </table>
                          </form>
                          
                    </div>
                  </div>
                          
        


    </div>

</div>
<link rel="stylesheet" href="{{ asset('jscss/jquery-ui.css') }}">
<script src="{{ asset('jscss/jquery-1.12.4.js') }}"></script>
<script src="{{ asset('jscss/jquery-ui.js') }}"></script>
<script>
$( function() {
  $( "#startdate" ).datepicker();
  $( "#enddate" ).datepicker();
} );
</script>
@endsection


