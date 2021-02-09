@extends('adminlte::page')

@section('content')
<?php
$lecturerpassword = Auth::user()->Password;
if($lecturerpassword == '12345'){
?>
<script type="text/javascript">
    function Redirect() {
       window.location= "lecturer/resetpassword";
    }
    setTimeout('Redirect()', 1);
</script>
<?php } ?>

<div class="box">
    <div class="box-header with-border">
      <h2 class="box-title">Welcome {{ Auth::user()->Surname }} {{ Auth::user()->Firstname }}</h2>
    </div>
    <div class="container">
        <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
  
              <div class="info-box-content">
                <span class="info-box-text">Total Course</span>
                <span class="info-box-number"><h3>{{count($subjects)}}</h3></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
  
              <div class="info-box-content">
                <span class="info-box-text">Total Students</span>
                <span class="info-box-number">
                    <?php $stotal = 0; foreach($studentlist as $istudent){ $stotal+= $istudent->total;}?>
                    <h3>{{$stotal}}</h3></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-md-5">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
  
              <div class="info-box-content">
                <span class="info-box-text">Courses</span>
                    <span class="info-box-number">
                        @if(count($subjects) > 1)
                        <?php $i = ""; ?>
                            @foreach($subjects as $subject)
                            <?php $i .= $subject->subjectcode.', '; ?>
                            
                            @endforeach
                            {{rtrim($i, ', ')}}
                        @else
                            @foreach($subjects as $subject)
                            {{$subject->subjectcode}}
                            @endforeach
                        @endif

                    </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        
        <div class="col-lg-6" style="font-size: 103px; background-color: #00a65a; font-family: Castellar;">
                <span class="info-box-text" style="margin-top: 10px; text-align: center; font-weight: bold;font-size: 30px;color: green; background-color: azure;">Total Course(s)</span>
        <p align="center">
            <span id="ContentPlaceHolder1_SubjectNo" style="font-size: 200px; font-family: Castellar; color:azure;">
                {{count($subjects)}}
            </span>
        </p>
            </div>
            <div class="col-lg-3">
                <table class="table table-striped">
                    <tr>
                        <th>Course Code</th><th>Total Student(s)</th>
                    </tr>
                    <?php $itotal = 0;?>
                    @foreach($studentlist as $istudent)
                    <?php $itotal += $istudent->total;?>
                    <tr>
                        <td>{{$istudent->subjectcode}}</td><td>{{$istudent->total}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td><strong>TOTAL</strong></td><td>{{$itotal}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

          
@endsection
