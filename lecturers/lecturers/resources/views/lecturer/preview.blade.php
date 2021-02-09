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
    <h3 class="box-title">Result Preview</h3>
  </div>
    <div class="box-body">
        <div class="col-md-6">
            <div class="row">
            <table class="table table-striped">
                <tr><td>#</td><td>Matric No</td><td>CA</td><td>EXAM</td><td>TOTAL</td></tr>
                @foreach($prev as $preview)
            <tr>
                <td><?php if($preview->CA < 1 || $preview->EXAM < 1) {?><i class="fa fa-fw fa-unlock" style="color:#f5150b; font-size: 25px;"></i> 
                <?php } else { ?> <i class="fa fa-fw fa-lock" style="color:#00a65a; font-size: 25px;"></i> <?php } ?></td>
                <td>{{$preview->MatricNo}}</td>
                <td>{{$preview->CA}}</td>
                <td>{{$preview->EXAM}}</td>
                <td>{{$preview->CA + $preview->EXAM}}</td></tr>
                @endforeach
            </table>
            <form action="{{url('lecturer/previewd')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                
                <input type="hidden" name="subject" value={{$prev[0]->SubjectID}}>
                <input type="hidden" name="session" value={{$prev[0]->SessionID}}>
                <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Cancel Result</button>
                </div>
              </form>
              <form action="{{url('lecturer/previewcontinue')}}" method="post">
                {{csrf_field()}}
                
                <input type="hidden" name="subject" value={{$prev[0]->SubjectID}}>
                <input type="hidden" name="session" value={{$prev[0]->SessionID}}>
                <div class="col-md-6">
                    <button class="btn btn-primary" type="submit" onclick="return confirm('Are you sure you want to upload these scores?');">Submit Score</button>
                </div>
              </form>
            </div>
          </div>  
          

    </div>

</div>
@endsection