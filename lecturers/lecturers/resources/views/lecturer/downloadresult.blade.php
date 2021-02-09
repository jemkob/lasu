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
    <h2 class="box-title">Download Uploaded Results</h2>
  </div>
    <div class="box-body">

@if(isset($subjects))
      <div class="col-md-6">
          <form action="{{url('lecturer/downloadPDF')}}" enctype="multipart/form-data" method="POST">
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
                <label for="">School</label>
                <select class="form-control" name="faculty" id="faculty" required="required">
                  <option value="0" disable="true" selected="true">All Schools</option>
                    @foreach ($faculties as $key => $value)
                      <option value="{{$value->FacultyID}}">{{ $value->FacultyName }}</option>
                    @endforeach
                </select>
              </div>
              
              <div class="form-group">
                <label for="">Course</label>
                <select class="form-control" name="subject" id="subject" required="required">
                  <option value="" disable="true" selected="true">--- Select Course ---</option>
                    @foreach ($subjects as $key => $value)
                      <option value="{{$value->subjectid}}">{{ $value->subjectcode }}</option>
                    @endforeach
                </select>
              </div>

            <button class="btn btn-success" name="scorelist" id="scorelist" type="submit">Download Result</button>
            
            
          </form>
        </div>
        @endif
          

    </div>

</div>
@endsection

