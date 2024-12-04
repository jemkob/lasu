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
                                    <option value="300">300</option>
                                    <option value="400">300+</option>
                                    <option value="500">300++</option>
                                    </select>
                                </td>
                                <td> 
                                    <select class="form-control" name="semester" id="semester" required="required" >
                                    <option value="" selected="true">-- Select Semester --</option>
                                    <option value="1">1st Semester</option>
                                    <option value="2">2nd Semester</option>
                                    </select>
                                    {{-- <input type="hidden" name="semester" value="2"> --}}
                                </td>
                                <td><input type="text" name="matricno" id="matricno" class="form-control" placeholder="Matric No." required></td>
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


                  {{-- compulsory --}}
                  <?php 
                  if(!empty($student->SubCourse)){
                    if($student->SubCourse=='beda'){
                    $compulsorycourses = collect($compulsorycourses)->where('subjectcodeco', 'not like', 'BES%');
                    $compulsorycourses->all();
                    } else {
                      $compulsorycourses = collect($compulsorycourses)->where('subjectcodeco', 'not like', 'BEA%');
                      $compulsorycourses->all();
                    }
                  }
                  ?>
                  {{-- {{count($deptsummary)}}<br>
                  {{count($prevsummary)}} --}}
                <div style="margin:35% 5px 20% 5px; text-transform:uppercase;">
                  <table>
                      <tr>
                                          <td width="134">MATRIC NO: </td>
                                          <td width="29">&nbsp;</td>
                                          <td width="527">{{$student->MatricNo}}</td>
                                          <td width="116">SESSION:</td>
                                          <td width="22">&nbsp;</td>
                                          <td width="331">{{$thesession->SessionYear}}</td>
                                          </tr>
                                          <tr>
                                              <td>NAME: </td>
                                              <td>&nbsp;</td>
                                              <td>{{$student->Surname}} {{$student->Firstname}} {{$student->Middlename}}</td>
                                              <td>SEMESTER:</td>
                                              <td>&nbsp;</td>
                                              <td>2</td>
                                          </tr>
                                          <tr>
                                              <td nowrap>SUBJECT COMB.:</td>
                                              <td>&nbsp;</td>
                                              <td>
                                                  @if(empty($student->SubCourse)){{$subcom->SubjectCombinName}}
                                                  @else 
                                                    @if($student->SubCourse == 'beda')
                                                    BED/BED - ACCOUNTING
                                                    @else
                                                    BED/BED - OFF. TECH. & MGT. EDU.(OTME)
                                                    @endif
                                                  @endif
                                                </td>
                                              <td>LEVEL:</td>
                                              <td>&nbsp;</td>
                                              <td>300 </td>
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
<table style="width: 100%; margin-top: 5px; border-top: 1.5px dotted #000; border-bottom: 1.5px dotted #000; font-size: 16px; font-family:Calibri, serif; text-transform:uppercase;">
                <tr style="border-top: 1.5px dotted #000;">
                    <td></td>
                    <td colspan="4" align="center">CUMMULATIVE</td> <td></td> <td></td>           
                </tr>
                <tr style="border-bottom: 1.5px dotted #000;">
                    
                  <td></td>
                    <td align="right">CTCP</td>
                    <td align="right">CTNU</td>
                    <td align="right">CTNUP</td>
                    <td align="right">CGPA</td>
                    <td style="padding: 0 0 0 20px;">GRADE</td>
                    <td align="center">Outstanding Subject(s)</td>
                </tr>
                <tr style="border-bottom: 1.5px dotted #000;">
                    <td style="height: 2.5px;"></td><td></td><td></td><td></td><td></td><td></td><td></td>
                  </tr>
                  <?php $ng =""; $allcurtcp = 0; $allcurcgpa=0; $allcuralltnups = 0; $allcurtnuaddup = 0;?>
                @foreach($deptsummary as $index=>$allsummary)
                <tr>
                    <td >{{$allsummary->dname}}</td>
                    {{-- <td >{{$allsummary->dcode}} </td> --}}
                
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
                    $cumtcp = $curtcp;
                    $cumtnu = $curtnuaddup;
                    $cumalltnup = $curalltnups;
                    $cumcgpa = 0;
                    if($cumtcp > 0 && $cumtnu > 0){
                    $cumcgpa = number_format($cumtcp/$cumtnu, 2);
                    }
                    $allcurtcp +=$curtcp;
                    $allcurtnuaddup +=$curtnuaddup;
                    $allcuralltnups +=$curalltnups; 
                    ?>

                    
                    <td style="padding: 10px 0 10px;" align="right">{{$cumtcp}}</td>
                    <td align="right">{{$cumtnu}}</td>
                    <td align="right">{{$cumalltnup}}</td>
                    <td align="right">{{$cumcgpa}}</td>
                    <td style="padding: 0 0 0 20px;" nowrap>@if($cumcgpa >= 4.5)
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
                      </td> <td align="center">
                        
                          <?php 
                                
                          $rescollection = collect($summary)->where('subjectvalueco', '!=', 'R')->where('subjectvalueco', '!=', 'E');
                          
                              $resfiltered = $rescollection->where('departmentid', $allsummary->deptid)->sortKeys()->uniqueStrict('subjectcodeco');
                              $resfiltered->values()->all();
                          // echo $resfiltered;
                          //check to see if any exam and ca sum is gt 39, if it is then remove from the list
                          $passed = collect($resfiltered);
                          $passed1 = $passed->reject(function ($value, $key) { return $value->examca > 39; });
                  
                          // $passed1->sortby('subjectcodeco');
                          $passed1->all(); 
                          
                          //outstanding start
                          $set1='';
                          $set2='';
                          $set1 = collect($compulsorycourses)->where('deptid', $allsummary->deptid); // Contents omitted for brevity
                          // $set1 = $set1->reject(function ($value, $key) { return $value->subjectvalueco = 'E'; });
                          $set2 = collect($resfiltered); // Contents omitted for brevity
                          // dump($set1);
                          // echo ' set 2 ';
                          // dump($set2);
                          // return ' and all';
                          $diff = array();
                          $set1->each(function($item, $key) use($set2, &$diff) {
                              $exists = $set2->where('subjectcodeco', $item->subjectcodeco)->first(); // Where clause omitted for brevity
                              if(!$exists) {
                                  array_push($diff, $item);
                              }
                          });
                          //outstanding ends
                          // echo $passed1;
                          // echo $resfiltered.' =====';
                          if($major !== $minor){
                            if($index < 2){
                            $themajormin = DB::table('minmax')
                            ->where('Code', $allsummary->dcode)->where('level', 300)->where('semester', 2)->first();
                            $mintnu = $themajormin->Minimum;
                              }elseif($index == 2){
                                $themajormin = DB::table('minmax')
                            ->where('Code', $major)->where('level', 300)->where('semester', 2)->first();
                            $mintnu = $themajormin->EduMin;
                              }elseif($index == 3){
                                $themajormin = DB::table('minmax')
                            ->where('Code', $major)->where('level', 300)->where('semester', 2)->first();
                            $mintnu = $themajormin->GseMin;
                              }elseif($index ==4){$mintnu=6;}

                          }else{
                            if($index < 1){
                          $themajormin = DB::table('minmax')
                          ->where('Code', $allsummary->dcode)->where('level', 300)->where('semester', 2)->first();
                          $mintnu = $themajormin->Minimum;
                            }elseif($index == 1){
                                $themajormin = DB::table('minmax')
                            ->where('Code', $major)->where('level', 300)->where('semester', 2)->first();
                            $mintnu = $themajormin->EduMin;
                              }elseif($index == 2){
                                $themajormin = DB::table('minmax')
                            ->where('Code', $major)->where('level', 300)->where('semester', 2)->first();
                            $mintnu = $themajormin->GseMin;
                              }elseif($index ==3){$mintnu=6;}
                          }
                          // dd($themajormin->Minimum);
                          

                          if(count($passed1) > 0 || ((isset($diff)) && !empty($diff)) || $cumalltnup < $mintnu) {
                              //sort resfiltered aka carryover
                             $ng = "Not Graduating";
                          $resfiltered = collect($passed1)->sortby('subjectcodeco')->where('examca', '<=', 39);
                          echo count($resfiltered);
                          } else {
                            echo 0;
                          }
                  
                          if((isset($diff)) && !empty($diff)) {
                          echo '<b>O/S:</b>';
                          echo count($diff);
                          dump($diff);
                          }
                          // dump($diff);
                          // dump($resfiltered);
                          // dd($ng);
                      ?>
                      </td>
</tr>
      @endforeach
      @if(!empty($ng))
<div style="
width: 900px;
height: 80px;
-ms-transform: rotate(170deg); /* IE 9 */
-webkit-transform: rotate(170deg); /* Safari 3-8 */
transform: rotate(330deg);
position: absolute;
size: 100px;
font-size: 100px;
color: red;

">{{$ng}} <div style="font-size:20px; text-align:center;">Incomplete Unit</div> </div>
@endif
      <tr style="border-bottom: 1.5px dotted #000;">
          <td style="padding: 10px 0 10px;">OVERALL PERFOMANCE</td>

          {{-- Prev Overal Summary --}}
      
          
      <?php
      
      
            
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
          $cumtcp = $curtcp;
          $cumtnu = $curtnuaddup;
          $cumalltnup = $curalltnups;
          $cumcgpa = 0;
          if($allcurtcp > 0 && $allcurtnuaddup > 0){
          $cumcgpa = number_format($allcurtcp/$allcurtnuaddup, 2);
          } 
          ?>

          
          <td align="right">{{$cumtcp}}</td>
          <td align="right">{{$cumtnu}}</td>
          <td align="right">{{$cumalltnup}}</td>
          <td align="right">{{$cumcgpa}}</td>
          <td style="padding: 0 0 0 20px;">
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
          <td align="center">
              <?php 
                                
              $rescollection = collect($summary)->where('subjectvalueco', '!=', 'R')->where('subjectvalueco', '!=', 'E');
              
                  $resfiltered = $rescollection->sortKeys()->uniqueStrict('subjectcodeco');
                  $resfiltered->values()->all();
              // echo $resfiltered;
              //check to see if any exam and ca sum is gt 39, if it is then remove from the list
              $passed = collect($resfiltered)->where('subjectvalueco', '!=', 'E');
              $passed1 = $passed->reject(function ($value, $key) { return $value->examca > 39; });
      
              // $passed1->sortby('subjectcodeco');
              $passed1->all(); 
              
              //outstanding start
              $set1='';
              $set2='';
              $set1 = collect($compulsorycourses); // Contents omitted for brevity
              // $set1 = $set1->reject(function ($value, $key) { return $value->subjectvalueco = 'E'; });
              $set2 = collect($resfiltered); // Contents omitted for brevity
              $diff = array();
              $set1->each(function($item, $key) use($set2, &$diff) {
                  $exists = $set2->where('subjectcodeco', $item->subjectcodeco)->first(); // Where clause omitted for brevity
                  if(!$exists) {
                      array_push($diff, $item);
                  }
              });
              //outstanding ends
              // echo $passed1;
              // echo $resfiltered.' =====';
              if(count($passed1) > 0 || ((isset($diff)) && !empty($diff))) {
                  //sort resfiltered aka carryover
              $resfiltered = collect($passed1)->sortby('subjectcodeco')->where('examca', '<=', 39);
              
              echo count($resfiltered)+count($diff);
                  
              } else {
                echo 0;
              }
      
              
          ?>
          </td>
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
        <td valign="top">ABBREVIATIONS USED<br />
          CTCP   = CUMMULATIVE TOTAL CREDIT POINTS <br />
        CTNU   = CUMMULATIVE TOTAL NUMBER OF UNITS <br />
        CGPA   = CUMMULATIVE GRADE POINT AVERAGE <br />
        CTNUP = CUMMULATIVE TOTAL NUMBER OF UNIT PASSED</td>
        <td><table width="100%" border="0">
          <tr>
        <td colspan="2" align="center">C.G.P.A.</td>
        <td width="25%">GRADE</td>
        <td width="20%">LETTER</td>
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
      <td align="center" style="text-transform:none;">This Statement of Result is issued in lieu of Certificate and valid for 3 months from the date of issuance.</td>
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

                  @else
                      <p>Statement of result unavailable for this student. </p>
                  @endif
                  @endif
    </div>

</div>


@endsection