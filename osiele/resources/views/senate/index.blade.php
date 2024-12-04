@extends('adminlte::page')





@section('content')
<style>
.zero{
  color:red; background-color:sandybrown;
}
</style>
<style type="text/css">
  
  
  @media print
  {
  .noprint {display:none;}
  }
  
  @media screen
  {
  
  }
 
  </style>
<div class="box">
  <div class="box-header with-border noprint">
    <h3 class="box-title">Academic Standing</h3>
  </div>
    <div class="box-body">
      {{-- {!! Form::open(array('route' => 'resultviewer.index', 'class'=>'form navbar-form navbar-right searchform')) !!} --}}
      {{-- {!! Form::open(['route' => 'resultviewer/search', 'method' => 'POST']) !!}
      {!! Form::text('search', null,
                             array('required',
                                  'class'=>'form-control',
                                  'placeholder'=>'Search for a tutorial...')) !!}
       {!! Form::submit('Search',
                                  array('class'=>'btn btn-default')) !!}
   {!! Form::close() !!} --}}

   {{-- <form action="{{url('resultviewer/search')}}" method="post" class="form navbar-form navbar-right searchform">
    <div class="col-md-6">
      {{csrf_field()}}
      <input type="text" name="search" id="search"/>
    </div>
    <div class="col-md-6">
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
  </form> --}}

  {{-- {!! Form::open(['route' => 'resultviewer/search', 'method' => 'POST']) !!} --}}
  <div class="row noprint">
    <div class="col-sm-4">
      <form action="{{url('senate/result')}}" method="post">
        {{csrf_field()}}
              

              <div class="form-group">
                <label for="">Matric No.</label>
                <input type="text" class="form-control" name="matricno" id="matricno">
              </div>
              <div class="col-md-6">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
      </form>
    </div>
  </div>
          

        {{-- {!! Form::close() !!} --}}

@if(isset($results))
   @if (count($results) === 0)
   <div class="alert alert-info">
    <strong>No result was found</strong>
  </div>
@elseif (count($results) >= 1)
<table width="100%" border="0">
  <tr>
    <td align="center" scope="col"><h2><strong>LAGOS STATE UNIVERSITY, OJO, ABEOKUTA CAMPUS</strong></h2>
      <h3>SANDWICH DEGREE PROGRAMME</h3>
    </td>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td align="center"><h4>FACULTY OF EDUCATION</h4></td>
    <th>&nbsp;</th>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="1" cellpadding="1" cellspacing="1">
      <tr>
        
        <td  scope="col">&nbsp;</td>
        <td  scope="col"><strong>SURNAME</strong></td>
        <td  scope="col"><strong>{{$student->Surname}}</strong></td>
        <td  scope="col"><strong>OTHER NAMES</strong></td>        
        <td  scope="col"><strong>{{$student->Firstname. ' '.$student->Middlename}}</strong></td>
        <td  scope="col"><strong>MATRIC NO:</strong></td>
        <td  scope="col"><strong>{{$student->MatricNo}}</strong></td>
        <td  scope="col"><strong>COURSE:</strong></td>
        <td  scope="col"><strong>{{$student->departmentname}} </strong></td>
        
        </tr>
    </table>
    </td>
    <th>&nbsp;</th>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-12">
  
  {{-- <table width="100%" border="1" class="table table-striped table-bordered table-hover col-md-8"> --}}
    <table width="100%" border="3" class="table table-striped table-bordered">
       
       <tr>
        @foreach($levels as $level)
          <th scope="col">MOD {{str_replace(0,"",$level->level)}} YEAR {{$level->sessionyear}} </th>
        @endforeach
      </tr>
     
      <tr>
        @foreach($levels as $level)
          <td>
            <table width="100%" border="3" class="">
              <tr>
                <th>CODE</th>
                <th>UNIT</th>
                <th>TS</th>
                <th>GP</th>
                <th>PT</th>
              </tr>

              @foreach($results->where('Level', $level->level)->where('sessionid', $level->sessionid) as $result)
                <?php 
                $total = $result->CA + $result->EXAM;
                if ($total >= 70)  {$gp = 5;}
                  elseif ($total >= 60 && $total <= 69)  {$gp=4;}
                  elseif ($total >= 50 && $total <= 59)  {$gp = 3;}
                  elseif ($total >= 45 && $total <= 49)  {$gp = 2;}
                  elseif ($total >= 40 && $total <= 44)  {$gp = 1;}
                  elseif ($total < 40)  {$gp = 0;}

                  
                  ?>
              <tr>
                <td>{{$result->CourseCode}}</td>
                <td>{{$result->CourseUnit.''.$result->CourseStatus}}</td>
                <td>{{$result->CA + $result->EXAM}}</td>
                <td @if($gp == 0) class="zero" @endif>{{$gp}}</td>
                <td @if($gp == 0) class="zero" @endif>{{$gp * $result->CourseUnit}}</td>
              </tr>
              @endforeach
            </table>
          </td>
        @endforeach
        
        
      </tr>
      <tr>
        @foreach($levels as $level)
          <th scope="col">  </th>
        @endforeach
      </tr>

      <tr>
        @php 
        $cumcreditpoint = 0;
        $cumunits = 0;
        $cumunitpassed = 0;
        @endphp
        @foreach($levels as $level)

              @php
              $totalcp = 0;
              $creditpoint=0;
              $unitpassed=0;
              @endphp

              @foreach($results->where('Level', $level->level)->where('sessionid', $level->sessionid) as $result)
                <?php 
                $total = $result->CA + $result->EXAM;
                if ($total >= 70)  {$gp = 5;}
                  elseif ($total >= 60 && $total <= 69)  {$gp=4;}
                  elseif ($total >= 50 && $total <= 59)  {$gp = 3;}
                  elseif ($total >= 45 && $total <= 49)  {$gp = 2;}
                  elseif ($total >= 40 && $total <= 44)  {$gp = 1;}
                  elseif ($total < 40)  {$gp = 0;}

                  $creditpoint += $gp * $result->CourseUnit;
                  
                  $totalcp +=$creditpoint;
                  
                  if($gp > 0){
                    $unitpassed +=$result->CourseUnit; 
                  }
                  ?>
              @endforeach
              @php
               $units = $results->where('Level', $level->level)->where('sessionid', $level->sessionid)->sum('CourseUnit'); 
              @endphp
          <td>
          <table border="1" width="100%">
            <tr><th width="85%" nowrap align="left">TOTAL CREDIT POINT:</th><td> {{$creditpoint}}</td></tr>
            <tr><th width="85%" nowrap align="left">TOTAL NO. OF UNITS:</th><td> {{$units}}</td></tr>
            <tr><th width="85%" nowrap align="left">MODULAR GPA:</th><td> {{number_format($creditpoint/$results->where('Level', $level->level)->where('sessionid', $level->sessionid)->sum('CourseUnit'),2)}}</td></tr>
            <tr><th width="85%" nowrap align="left">UNITS PASSED:</th><td> {{$cumunitpassed +=$unitpassed}}</td></tr>
            <tr><th width="85%" nowrap align="left">CUM. CREDIT POINTS:</th><td>{{$cumcreditpoint+=$creditpoint}} </td> </tr>
            <tr><th width="85%" nowrap align="left">CUM. TOTAL UNITS:</th><td>{{$cumunits+=$units}}</td></tr>
            <tr><th width="85%" nowrap align="left">CUM. G.P.A:</th><td>{{number_format($cumcreditpoint/$cumunits,2)}} </td></tr>
            <tr><th width="85%" nowrap align="left">REMARKS:</th><td>@if($cumcreditpoint/$cumunits < 1) @else GS @endif </td></tr>
          </table>
        </td>
        @endforeach
      </tr>
    </table>
    @php
      
      $gp = number_format($cumcreditpoint/$cumunits,2);  
    @endphp
    <table class="table table-bordered ">
      <tr><td class="h3">CTCP = {{$cumcreditpoint}}</td><td class="h3">CTNU = {{$cumunits}}</td><td class="h3">TNUP = {{$cumunitpassed}} </td><td class="h3">CGPA = {{number_format($cumcreditpoint/$cumunits,2)}}</td><td class="h3">CLASS =  
      @php
           if($gp >= 4.50){
          echo '1st Class';
        }elseif($gp >= 3.50 && $gp <= 4.49){
          echo '2nd Class Upper';
        }elseif($gp >= 2.40 && $gp <= 3.49){
          echo '2nd Class Lower';
        }elseif($gp >= 1.50 && $gp <= 2.39){
          echo '3rd Class';
        }elseif($gp >= 1.00 && $gp <= 1.50){
          echo 'Pass';
        }else{
          echo 'Failed';
        }
      @endphp
      </td></tr>
    </table>
  </div>
</div>
    
    
@endif
@endif

    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script type="text/javascript">
      $('#sessions').on('change', function(e){
        console.log(e);
        var sessionid = e.target.value;
        $.get('/json-results?sessionid=' + sessionid,function(data) {
          console.log(data);
          $('#semester').empty();
          $('#semester').append('<option value="1" selected="true">1st Semester</option> <option value="2">2nd Semester</option> ');

          $.each(data, function(index, departmentsObj){
            $('#departments').append('<option value="'+ departmentsObj.DepartmentID +'">'+ departmentsObj.DepartmentName +'</option>');
          })
        });
      });

      


    </script>
@endsection


