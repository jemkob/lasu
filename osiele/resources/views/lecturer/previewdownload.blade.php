
<!DOCTYPE html>
<html lang="en">


  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Portal</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="http://portal.devel/vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://portal.devel/vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="http://portal.devel/vendor/adminlte/vendor/Ionicons/css/ionicons.min.css">

            <!-- Select2 -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="http://portal.devel/vendor/adminlte/dist/css/AdminLTE.min.css">

            <!-- DataTables -->
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    
        <link rel="stylesheet"
          href="http://portal.devel/vendor/adminlte/dist/css/skins/skin-red.min.css ">
        
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
<div class="box">
  <div class="box-header with-border">
    <h2 class="box-title">View Students</h2>
  </div>
    <div class="box-body">


<div class="col-md-12"></div>

    @if(isset($prevdownload))
      <div class="col-md-6">
          <table class="table table-striped" width="70%">
              <tr>
                <th>S/N<th
                <th>MATRIC NO</th>
                <th>CA</th>
                <th>EXAM</th>
                <th>TOTAL</th>
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

