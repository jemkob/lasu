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
<!DOCTYPE html>
<html lang="en">


  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Portal</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    {{-- <link rel="stylesheet" href="{{url()}}/vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> --}}

    

    <!-- Google Font -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> --}}
</head>
<body>
<div style="text-align:center">
  <div style="text-align:center">
<h2 class="box-title">{{$subjectcodename}} {{$thesession}}  UPLOADED RESULTS</h2>
</div>
<div style="padding-bottom:10px;">Date Uploaded: {{$prevdownload[0]->created_at}}</div><br>
<div style="padding-bottom:10px;">Date printed: {{date_format(now(),"d/m/Y H:i:s")}}</div><br>

    <div class="box-body">




    @if(isset($prevdownload))
      <div >
            <table class="table table-striped" width="70%">
                    <tr>
                      <td><strong>S/N</strong></td>
                      <td><strong>Matric No</strong></td>
                      <td><strong>CA</strong></td>
                      <td><strong>EXAM</strong></td>
                      <td><strong>TOTAL</strong></td>
                    </tr>
                    @foreach($prevdownload as $key=>$value)
                    <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$value->MatricNo}}</td>
                          <td>{{$value->CA}}</td>
                          <td>{{$value->EXAM}}</td>
                          <td>{{$value->CA + $value->EXAM}}</td>
                      </tr>
                    @endforeach
                </table>
        </div>
        @endif
          

    </div>

</div>
</body>
</html>

