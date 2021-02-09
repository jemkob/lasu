@extends('adminlte::page')
@section('content')
<style type="text/css">
  @media print
  {
  .noprint {display:none;}
  }
  
  @media screen
  {
  
  }
  .topbottomborder 
  {
    border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;
}
.table {font-size: 14px; font-family:Calibri, serif; text-transform:uppercase;}
  
  </style>
<div class="box">
  <div class="box-header with-border noprint">
    <h3 class="box-title">Statement Of Result</h3>
  </div>
    <div class="box-body">
            <div class="row noprint">
                    <div class="col-sm-8">
                      <form action="{{url('resultstmt')}}" method="post">
                        {{csrf_field()}}
                        <table>
                            <tr>
                                <td>Session</td><td>Level</td><td>Semester</td><td>Matric No.</td>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control" name="sessions" id="sessions" required="required">
                                          <option value="" disable="true" selected="true">-- Select Session --</option>
                                            @foreach ($sessions as $key => $value)
                                              <option value="{{$value->SessionID}}">{{ $value->SessionYear }}</option>
                                            @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="level" id="level" required="required">
                                    <option value="" disable="true" selected="true">-- Select Level --</option>
                                    <option value="100">100</option> 
                                    <option value="200">200</option>
                                    <option value="300">300</option>
                                    <option value="400">300+</option>
                                    <option value="500">300++</option>
                                    </select>
                                </td>
                                <td> 
                                    <select class="form-control" name="semester" id="semester" required="required">
                                    <option value="" disable="true" selected="true">-- Select Semester --</option>
                                    <option value="1">1st Semester</option> 
                                    <option value="2">2nd Semester</option>
                                    </select>
                                </td>
                                <td><input type="text" name="matricno" id="matricno" class="form-control" placeholder="Matric No." required="required"></td>
                                <td><button class="btn btn-primary" type="submit">Get Statement of Results</button></td>
                            </tr>
                        </table>
                       <div class="col-md-6">
                                
                            </div>
                      </form>
                    </div>
                  </div>
                  
                          
        
                  @if(isset($resultslip))
                  @if(count($resultslip) > 0)
                  {{-- {{count($deptsummary)}}<br>
                  {{count($prevsummary)}} --}}
                <div style="margin:25% 5px 25% 5px; text-transform:uppercase;">
                  <table>
                      <tr>
                                          <th width="134">MATRIC NO </th>
                                          <th width="29">&nbsp;</th>
                                          <td width="527">{{$student->MatricNo}}</td>
                                          <th width="116">SESSION</th>
                                          <td width="22">&nbsp;</td>
                                          <td width="331">{{$thesession->SessionYear}}</td>
                                          </tr>
                                          <tr>
                                              <th>NAME </th>
                                              <th>&nbsp;</th>
                                              <td>{{$student->Surname}} {{$student->Firstname}} {{$student->Middlename}}</td>
                                              <th>SEMESTER</th>
                                              <td>&nbsp;</td>
                                              <td>{{$resultslip[0]->Semester}}</td>
                                          </tr>
                                          <tr>
                                              <th nowrap>SUBJECT COMB.</th>
                                              <th>&nbsp;</th>
                                              <td>{{$subcom->SubjectCombinName}}</td>
                                              <th>LEVEL</th>
                                              <td>&nbsp;</td>
                                              <td>{{$resultslip[0]->Level}} </td>
                                          </tr>
                                          <tr>
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                          </tr>
                                      </table>
                                      {{-- Header end --}}
                                      
<br>
<br>

{{-- {{$summary}} <br> {{$deptsummary}} --}}
<table style="width: 100%; margin-top: 5px; border-top: 1.5px dotted #000; border-bottom: 1.5px dotted #000; font-size: 14px; font-family:Calibri, serif; text-transform:uppercase;">
                <tr style="border-top: 1.5px dotted #000;">
                    <td></td>
                    <td colspan="6">CUMMULATIVE</td>             
                </tr>
                <tr style="border-bottom: 1.5px dotted #000;">
                    
                  <td></td>
                    <td>CTCP</td>
                    <td  >CTNU</td>
                    <td  >CTNUP</td>
                    <td  >CGPA</td>
                    <td>GRADE</td>
                    <td>Outstanding Subject(s)</td>
                </tr>
                <tr style="border-bottom: 1.5px dotted #000;">
                    <td style="height: 2.5px;"></td><td></td><td></td><td></td><td></td><td></td><td></td>
                  </tr>
                @foreach($deptsummary as $allsummary)
                <tr>
                    <td >{{$allsummary->dname}}</td>
                    {{-- <td >{{$allsummary->dcode}} </td> --}}
    
    
                    {{-- Prev Summary --}}
                <?php
                if ($allsummary->dcode =='DEW') {
                    $prevtcp = 0;
                    $prevtnu = 0;
                    $prevtnup = 0;
                    $prevcgpa = 0;
                    $prevalltnups = 0;
                    $prevtnuaddup = 0;

                  } else {
                if (!isset($prevsummary)) {
                    $prevtcp = 0;
                    $prevtnu = 0;
                    $prevtnup = 0;
                    $prevcgpa = 0;
                    $prevalltnups = 0;
                    $prevtnuaddup = 0;

                } else {
                  //last department
                  $thesummary = collect($prevsummary);
                  $resfiltered = $thesummary->where('deptname', $allsummary->dname);
                  $resfiltered->all();
                  $allcalc= 0;
                  $prevalltnups=0;
                    
                    foreach($resfiltered as $resfilt){
                      $calculate=$resfilt->ca+$resfilt->exam;
                      $gettnup = $resfilt->tnu;
                    
                    if ($calculate >= 70)  {$calculates = 5*$resfilt->tnu;}
                    elseif ($calculate >= 60 && $calculate <= 69)  {$calculates = 4*$resfilt->tnu; $gettnup = $resfilt->tnu;}
                    elseif ($calculate >= 50 && $calculate <= 59)  {$calculates = 3*$resfilt->tnu; $gettnup = $resfilt->tnu;}
                    elseif ($calculate >= 45 && $calculate <= 49)  {$calculates = 2*$resfilt->tnu; $gettnup = $resfilt->tnu;}
                    elseif ($calculate >= 40 && $calculate <= 44)  {$calculates = 1*$resfilt->tnu; $gettnup = $resfilt->tnu;}
                    elseif ($calculate <= 39)  {$calculates = 0*$resfilt->tnu; $gettnup = 0;}
                    //endif
                    $allcalc +=$calculates;

                    $prevalltnups +=$gettnup; 
                    
                    $prevtcp = $allcalc;
                  }
                  $prevcgpa = 0;
                  $prevtnuaddup = collect($prevdeptresults)->where('deptname', $allsummary->dname)->sum('sum2');
                  
                  if($allcalc > 0 && $prevalltnups > 0){
                    $prevcgpa = number_format($allcalc/$prevtnuaddup, 2);
                  } else {
                    $prevcgpa = 0;
                  }
                }
              }
                    ?>
                    
                <?php
                /* if ($allsummary->dcode !='TP') {
                      

                    } else { */
                      $curtcp = 0;
                      $curcgpa = 0;
                      $curalltnups = 0;
                      $curtnuaddup = 0;
                  $thesummary = collect($summary);
                  if ($resultslip[0]->Level == 300 && $resultslip[0]->Semester==1) {
                $resfiltered = $thesummary->where('deptname', 'TP');
                } else {
                  //$resfiltered = $thesummary;
                  $resfiltered = $thesummary->where('deptname', $allsummary->dname);
                }
                  //$resfiltered = $thesummary->where('deptname', $allsummary->dname);
                  $resfiltered->all();
                  $allcalc= 0;
                  $curalltnups=0;
                    
                    foreach($resfiltered as $resfilt){
                      $calculate=$resfilt->examca;
                      $gettnup = $resfilt->tnu;
                    
                    if ($calculate >= 70)  {$calculates = 5*$resfilt->tnu;}
                    elseif ($calculate >= 60 && $calculate <= 69)  {$calculates = 4*$resfilt->tnu; $gettnup = $resfilt->tnu;}
                    elseif ($calculate >= 50 && $calculate <= 59)  {$calculates = 3*$resfilt->tnu; $gettnup = $resfilt->tnu;}
                    elseif ($calculate >= 45 && $calculate <= 49)  {$calculates = 2*$resfilt->tnu; $gettnup = $resfilt->tnu;}
                    elseif ($calculate >= 40 && $calculate <= 44)  {$calculates = 1*$resfilt->tnu; $gettnup = $resfilt->tnu;}
                    elseif ($calculate <= 39)  {$calculates = 0*$resfilt->tnu; $gettnup = 0;}
                    //endif
                    $allcalc +=$calculates;

                    $curalltnups +=$gettnup; 
                    
                    $curtcp = $allcalc;
                  }
                  $curcgpa = 0;
                  $curtnuaddup = collect($deptresults)->where('deptname', $allsummary->dname)->sum('sum2');
                  
                  if($allcalc > 0 && $curtnuaddup > 0){
                    $curcgpa = number_format($allcalc/$curtnuaddup, 2);
                  } else {
                    $curcgpa = 0;
                  }
                // }  
                      ?>             
                    
                    
                    <?php
                    $cumtcp = $curtcp + $prevtcp;
                    $cumtnu = $curtnuaddup + $prevtnuaddup;
                    $cumalltnup = $curalltnups + $prevalltnups;
                    $cumcgpa = 0;
                    if($cumtcp > 0 && $cumtnu > 0){
                    $cumcgpa = number_format($cumtcp/$cumtnu, 2);
                    } 
                    ?>

                    
                    <td >{{$cumtcp}}</td>
                    <td >{{$cumtnu}}</td>
                    <td >{{$cumalltnup}}</td>
                    <td >{{$cumcgpa}}</td>
                    <td>@if($cumcgpa >= 4.5)
                        distinction 
                        @elseif($cumcgpa >= 3.5 && $cumcgpa <= 4.49)
                        credit 
                        @elseif($cumcgpa >= 2.4 && $cumcgpa <= 3.49)
                        merit 
                        @elseif($cumcgpa >= 1.5 && $cumcgpa <= 2.39)
                        pass 
                        @elseif($cumcgpa >= 1.0 && $cumcgpa <= 1.49)
                        low pass 
                        @elseif($cumcgpa < 1.0)
                        FAILED 
                        @endif
                      </td> <td>0</td>
</tr>
      @endforeach

      <tr style="border-bottom: 1.5px dotted #000;">
          <td colspan="1" >OVERALL PERFOMANCE</td>

          {{-- Prev Overal Summary --}}
      <?php
      /* if ($allsummary->dcode =='TP') {
          $prevtcp = 0;
          $prevtnu = 0;
          $prevtnup = 0;
          $prevcgpa = 0;
          $prevalltnups = 0;
          $prevtnuaddup = 0;

        } else { */
      if (!isset($prevsummary)) {
          $prevtcp = 0;
          $prevtnu = 0;
          $prevtnup = 0;
          $prevcgpa = 0;
          $prevalltnups = 0;
          $prevtnuaddup = 0;

      } else {
        $thesummary = collect($prevsummary);
        $resfiltered = $thesummary;
        $resfiltered->all();
        $allcalc= 0;
        $prevalltnups=0;
          
          foreach($resfiltered as $resfilt){
            $calculate=$resfilt->ca+$resfilt->exam;
            $gettnup = $resfilt->tnu;
          
          if ($calculate >= 70)  {$calculates = 5*$resfilt->tnu;}
          elseif ($calculate >= 60 && $calculate <= 69)  {$calculates = 4*$resfilt->tnu; $gettnup = $resfilt->tnu;}
          elseif ($calculate >= 50 && $calculate <= 59)  {$calculates = 3*$resfilt->tnu; $gettnup = $resfilt->tnu;}
          elseif ($calculate >= 45 && $calculate <= 49)  {$calculates = 2*$resfilt->tnu; $gettnup = $resfilt->tnu;}
          elseif ($calculate >= 40 && $calculate <= 44)  {$calculates = 1*$resfilt->tnu; $gettnup = $resfilt->tnu;}
          elseif ($calculate <= 39)  {$calculates = 0*$resfilt->tnu; $gettnup = 0;}
          //endif
          $allcalc +=$calculates;

          $prevalltnups +=$gettnup; 
          
          $prevtcp = $allcalc;
        }
        $prevcgpa = 0;
        $prevtnuaddup = collect($prevdeptresults)->sum('sum2');
        
        if($allcalc > 0 && $prevalltnups > 0){
          $prevcgpa = number_format($allcalc/$prevtnuaddup, 2);
        } else {
          $prevcgpa = 0;
        }
      }
    // }
          ?>
          
      <?php
      
      // if ($resultslip[0]->Level == 300 && $resultslip[0]->Semester==1 && $summary[0]->deptname !='TP') {
      //       $curtcp = 0;
      //       $curcgpa = 0;
      //       $curalltnups = 0;
      //       $curtnuaddup = 0;

      //     } else {
            
      $thesummary = collect($summary);
      if ($resultslip[0]->Level == 300 && $resultslip[0]->Semester==1) {
      $resfiltered = $thesummary->where('deptname', 'TP');
      } else {
        $resfiltered = $thesummary;
      }
      $resfiltered->all();
      $allcalc= 0;
      $curalltnups=0;
        
        foreach($resfiltered as $resfilt){
          $calculate=$resfilt->ca+$resfilt->exam;
          $gettnup = $resfilt->tnu;
        
        if ($calculate >= 70)  {$calculates = 5*$resfilt->tnu;}
        elseif ($calculate >= 60 && $calculate <= 69)  {$calculates = 4*$resfilt->tnu; $gettnup = $resfilt->tnu;}
        elseif ($calculate >= 50 && $calculate <= 59)  {$calculates = 3*$resfilt->tnu; $gettnup = $resfilt->tnu;}
        elseif ($calculate >= 45 && $calculate <= 49)  {$calculates = 2*$resfilt->tnu; $gettnup = $resfilt->tnu;}
        elseif ($calculate >= 40 && $calculate <= 44)  {$calculates = 1*$resfilt->tnu; $gettnup = $resfilt->tnu;}
        elseif ($calculate <= 39)  {$calculates = 0*$resfilt->tnu; $gettnup = 0;}
        //endif
        $allcalc +=$calculates;

        $curalltnups +=$gettnup; 
        
        $curtcp = $allcalc;
      }
      $curcgpa = 0;
      $curtnuaddup = collect($deptresults)->sum('sum2');
      
      if($allcalc > 0 && $curalltnups > 0){
        $curcgpa = number_format($allcalc/$curtnuaddup, 2);
      } else {
        $curcgpa = 0;
      }
    // }
    /* if ($resultslip[0]->Level == 300 && $resultslip[0]->Semester==1 && $summary[0]->deptname !='TP') {
            $curtcp = 0;
            $curcgpa = 0;
            $curalltnups = 0;
            $curtnuaddup = 0;

          } */
        ?> 
          

          <?php
          $cumtcp = $curtcp + $prevtcp;
          $cumtnu = $curtnuaddup + $prevtnuaddup;
          $cumalltnup = $curalltnups + $prevalltnups;
          $cumcgpa = 0;
          if($cumtcp > 0 && $cumtnu > 0){
          $cumcgpa = number_format($cumtcp/$cumtnu, 2);
          } 
          ?>

          
          <td>{{$cumtcp}}</td>
          <td>{{$cumtnu}}</td>
          <td>{{$cumalltnup}}</td>
          <td>{{$cumcgpa}}</td>
          <td>
              @if($cumcgpa >= 4.5)
              distinction 
              @elseif($cumcgpa >= 3.5 && $cumcgpa <= 4.49)
              credit 
              @elseif($cumcgpa >= 2.4 && $cumcgpa <= 3.49)
              merit 
              @elseif($cumcgpa >= 1.5 && $cumcgpa <= 2.39)
              pass 
              @elseif($cumcgpa >= 1.0 && $cumcgpa <= 1.49)
              low pass 
              @elseif($cumcgpa < 1.0)
              FAILED 
              @endif
          </td>
          <td>0</td>
  </tr>
  <tr style="border-bottom: 1.5px dotted #000; height: 2.5px;">
    <td style="height: 2.5px;"></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
                                             
                  </table>
  <br>
  <br>
  <br>
  <table width="100%" border="0">
      <tr>
        <td valign="top"><strong>ABBREVIATIONS USED</strong><br />
          CTCP   = CUMMULATIVE TOTAL CREDIT POINTS <br />
        CTNU   = CUMMULATIVE TOTAL NUMBER OF UNITS <br />
        CGPA   = CUMMULATIVE GRADE POINT AVERAGE <br />
        CTNUP = CUMMULATIVE TOTAL NUMBER OF UNIT PASSED</td>
        <td><table width="100%" border="0">
          <tr>
        <td colspan="2" align="center"><strong>C.G.P.A.</strong></td>
        <td width="25%"><strong>GRADE</strong></td>
        <td width="20%"><strong>LETTER</strong></td>
        </tr>
      <tr>
        <td width="19%">4.50</td>
        <td width="15%">5.00</td>
        <td>DISTINCTION</td>
        <td>A</td>
        </tr>
      <tr>
        <td>3.50</td>
        <td>4.49</td>
        <td>CREDIT</td>
        <td>B</td>
        </tr>
      <tr>
        <td>2.40</td>
        <td>3.49</td>
        <td>MERIT</td>
        <td>C</td>
        </tr>
      <tr>
        <td>1.50</td>
        <td>2.39</td>
        <td>PASS</td>
        <td>D</td>
        </tr>
      <tr>
        <td>1.00</td>
        <td>1.49</td>
        <td>LOW PASS</td>
        <td>E</td>
        </tr>
      <tr>
        <td>0.00</td>
        <td>0.99</td>
        <td>FAILED</td>
        <td>F</td>
        </tr>
    </table></td>
      </tr>
    </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="100%" border="0">
    <tr>
      <td align="center">This statement of result is issued in lieu of certificate and valid for 3 months from the date of issuance.</td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="100%" border="0">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center">___________________________<br />
      REGISTRAR</td>
      <td>&nbsp;</td>
      <td align="center">___________________________<br />
      DATE</td>
    </tr>
  </table>
                </div>
  
                     

                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                  @else
                      <p>Statement of result unavailable for this student. </p>
                  @endif
                  @endif
    </div>

</div>


@endsection