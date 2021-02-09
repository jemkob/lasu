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
    <h2 class="box-title">Download EMS (Departmental)</h2>
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
          <form action="{{url('lecturer/export')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            {{-- <div class="form-group">
              <label for="">Faculty</label>
              <select class="form-control" name="subject" id="subject">
                <option value="0" disable="true" selected="true">--- Select Course ---</option>
                  @foreach ($faculties as $key => $value)
                    <option value="{{$value->FacultyID}}">{{ $value->FacultyName }}</option>
                  @endforeach
              </select>
            </div> --}}

            <div class="form-group">
                <label for="">Course</label>
                <select class="form-control" name="subject" id="subject" required="required">
                  <option value="" disable="true" selected="true">--- Select Course ---</option>
                    @foreach ($subjects as $key => $value)
                      <option value="{{$value->subjectid}}">{{ $value->subjectcode }}</option>
                    @endforeach
                </select>
              </div>

            <button class="btn btn-success" name="scorelist" id="scorelist" type="submit">Download Excel Sheet</button>
            
            
          </form>
        </div>
        @endif
          
@else
<div class="alert alert-warning">Portal currently closed for this operation.</div>
@endif
    </div>

</div>
@endsection

