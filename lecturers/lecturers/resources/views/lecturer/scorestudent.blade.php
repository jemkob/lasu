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
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

<div class="box">
  <div class="box-header with-border">
    <h2 class="box-title">Score Student(s)</h2>
  </div>
    <div class="box-body">
        
        <form action="{{url('lecturer/insertscore')}}" method="POST">
            {{csrf_field()}}
        <table class="table table-hover table-striped">
            <tr>
                <th>MATRIC NO</th><th>CA</th><th>EXAM</th><th>TOTAL</th>
            </tr>
            @foreach($results as $res)
            <tr>
                <td><input type="text" name="matricno[]" id="" value="{{$res->matricno}}" class="form-control" readonly></td>
                <td><input type="number" name="ca[]" id="" value="{{$res->ca}}" class="form-control"></td>
                <td><input type="number" name="exam[]" id="" value="{{$res->exam}}" class="form-control"></td>
                <td><input type="number" name="" id="" value="{{$res->exam + $res->ca}}" class="form-control" readonly></td>

            </tr>
            @endforeach
        </table>
        <input type="hidden" value="{{$thesubject}}" name="subject">
        <input type="hidden" name="session" value="{{$sessions->SessionID}}">
        <button type="submit" class="btn-primary btn">Submit Score</button>
        </form>
          

    </div>

</div>
@endsection

