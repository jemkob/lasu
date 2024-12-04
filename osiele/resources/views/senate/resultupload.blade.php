@extends('adminlte::page')

@section('content')
<style>
  .progress {
      position: relative;
      height: 2px;
      display: block;
      width: 100%;
      background-color: white;
      border-radius: 2px;
      background-clip: padding-box;
      /*margin: 0.5rem 0 1rem 0;*/
      overflow: hidden;

    }
    .progress .indeterminate {
background-color:black; }
    .progress .indeterminate:before {
      content: '';
      position: absolute;
      background-color: #2C67B1;
      top: 0;
      left: 0;
      bottom: 0;
      will-change: left, right;
      -webkit-animation: indeterminate 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;
              animation: indeterminate 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite; }
    .progress .indeterminate:after {
      content: '';
      position: absolute;
      background-color: #2C67B1;
      top: 0;
      left: 0;
      bottom: 0;
      will-change: left, right;
      -webkit-animation: indeterminate-short 2.1s cubic-bezier(0.165, 0.84, 0.44, 1) infinite;
              animation: indeterminate-short 2.1s cubic-bezier(0.165, 0.84, 0.44, 1) infinite;
      -webkit-animation-delay: 1.15s;
              animation-delay: 1.15s; }

    @-webkit-keyframes indeterminate {
      0% {
        left: -35%;
        right: 100%; }
      60% {
        left: 100%;
        right: -90%; }
      100% {
        left: 100%;
        right: -90%; } }
    @keyframes indeterminate {
      0% {
        left: -35%;
        right: 100%; }
      60% {
        left: 100%;
        right: -90%; }
      100% {
        left: 100%;
        right: -90%; } }
    @-webkit-keyframes indeterminate-short {
      0% {
        left: -200%;
        right: 100%; }
      60% {
        left: 107%;
        right: -8%; }
      100% {
        left: 107%;
        right: -8%; } }
    @keyframes indeterminate-short {
      0% {
        left: -200%;
        right: 100%; }
      60% {
        left: 107%;
        right: -8%; }
      100% {
        left: 107%;
        right: -8%; } }
</style>
<script>
  document.onreadystatechange = function () {
            if (document.readyState === "complete") {
                console.log(document.readyState);
                document.getElementById("PreLoaderBar").style.display = "none";
            }
        }
</script>
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
function Validate()
{
     var resultfile =document.getElementById("resultfile").value;
     if(resultfile!='')
     {
           var checkimg = resultfile.toLowerCase();
          if (!checkimg.match(/(\.csv|\.xls|\.xlsx)$/)){ // validation of file extension using regular expression before file upload
              document.getElementById("resultfile").focus();
              document.getElementById("errorName5").innerHTML="Wrong file selected"; 
              return false;
           }
           document.getElementById("errorName5").innerHTML=""; 
        return true;
      }
}
</script>
@if(isset($asubject))
    <div class="alert alert-success">
        Result uploaded successfully!
    </div>


  <form action="{{url('lecturer/previewdownload')}}" method="GET">
    {{csrf_field()}}
  <input type="hidden" name="subject" value="{{$asubject}}">
  <button type="submit" class="btn-danger btn">Save A PDF Copy</button>
  </form>
<p></p>
<script>
$(window).load(function()
{
    $('#myModal').modal('show');
});
</script>


<div class="container">
  <!-- Trigger the modal with a button -->
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Successfully Uploaded</h4>
        </div>
        <div class="modal-body">
          <div class="alert alert-success">
            Result uploaded successfully!
        </div>
    
{{--     
      <form action="{{url('lecturer/previewdownload')}}" method="GET">
        {{csrf_field()}}
      <input type="hidden" name="subject" value="{{$asubject}}">
      <button type="submit" class="btn-danger btn">Save A PDF Copy</button>
      </form> --}}

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

@endif
{{-- <div class="progress" id="PreLoaderBar">
  <div class="indeterminate"></div>
</div> --}}
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Result Upload</h3>
  </div>
    <div class="box-body">
    
        <div class="col-md-6">
            <div class="row">
              <form action="{{url('uploadresultcourse')}}" method="post" enctype="multipart/form-data" onSubmit="return Validate()";>
                {{csrf_field()}}
                <div class="form-group">
                    <label for="">Course Assigned</label>
                    {{-- <select class="form-control subject" name="subject" id="subject" required="required">
                      <option value="" disable="true" selected="true">--- Select Course ---</option>
                        @foreach ($subjects as $key => $value)
                          <option value="{{$value->Id}}">{{ $value->CourseCode. ' => '. $value->CourseTitle}} </option>
                        @endforeach
                    </select> --}}
                  </div>
                <div class="col-md-6">
                    <span id="errorName5" style="color: red;"></span>
                  <input type="file" name="imported-file" id="resultfile" onchange="return Validate(); this.value=null;return false;" required="required"/>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Upload Score</button>
                </div>
              </form>
            </div>
    
    
          </div>  
        </div>

</div>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
// In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.subject').select2();
    });
</script>
@endsection

