@extends('adminlte::page')

@section('content')
<?php
$lecturerpassword = Auth::user()->Password;
if($lecturerpassword == '12345'){
?>
<script type="text/javascript">
    function Redirect() {
       window.location= "resetpassword";
    }
    setTimeout('Redirect()', 1);
</script>
<?php } ?>

<div class="box">
  <div class="box-header with-border">
    <h2 class="box-title">INSERT SCORE(S)</h2>
  </div>
    <div class="box-body">
{{-- Schedule activities --}}
<?php
$date = date('Y-m-d',time());//date variable
if(isset($activityschedule)){
$startdate = $activityschedule->StartDate;
$enddate = $activityschedule->EndDate;
} else {
$startdate = "";
$enddate = "";
}

$starttime = strtotime($startdate);
$endtime = strtotime($enddate);
$curtime = strtotime($date);
?>
@if($curtime >= $starttime && $endtime <= $curtime)
@if(isset($subjects))
      <div class="col-md-6">
          <form action="{{url('lecturer/scorestudent')}}" enctype="multipart/form-data" method="POST">
            {{csrf_field()}}

            <div class="form-group">
                <label for="">Course</label>
                <select class="form-control" name="subject" id="subject">
                  <option value="0" disable="true" selected="true">--- Select Course ---</option>
                    @foreach ($subjects as $key => $value)
                      <option value="{{$value->subjectid}}">{{ $value->subjectcode }}</option>
                    @endforeach
                </select>
              </div>

            <button class="btn btn-success" name="scorelist" id="scorelist" type="submit">Show Student(s)</button>
            
            
          </form>
        </div>
        @endif
@else
<div class="alert alert-warning">Portal currently closed for this operation.</div>
@endif   

    </div>

</div>
@endsection

