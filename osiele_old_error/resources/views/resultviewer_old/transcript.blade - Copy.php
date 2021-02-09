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
  
  </style>
<div class="box">
  <div class="box-header with-border noprint">
    <h3 class="box-title">Transcript</h3>
  </div>
    <div class="box-body">
            <div class="row noprint">
                    <div class="col-sm-8">
                      <form action="{{url('transcript')}}" method="post">
                        {{csrf_field()}}
                        <table>
                            <tr>
                                <td>Session</td><td>Matric No.</td>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control" name="sessions" id="sessions">
                                          <option value="0" disable="true" selected="true">-- Select Session --</option>
                                            @foreach ($sessions as $key => $value)
                                              <option value="{{$value->SessionID}}">{{ $value->SessionYear }}</option>
                                            @endforeach
                                    </select>
                                </td>
                                <td><input type="text" name="matricno" id="matricno" class="form-control" placeholder="Matric No."></td>
                                <td><button class="btn btn-primary" type="submit">Get Results</button></td>
                            </tr>
                        </table>
                       <div class="col-md-6">
                                
                            </div>
                      </form>
                    </div>
                  </div>
                  
                          
        
                  @if(isset($resultslip))
                  @if(count($resultslip) > 0)
                  
                   
                  <table width="100%" border="0">
                      <tr>
                        <th width="14%" rowspan="5" scope="col">&nbsp;</th>
                        <td width="46%" align="center" scope="col"><h3><strong>FEDERAL COLLEGE OF EDUCATION ABEOKUTA</strong></h3></td>
                        <th width="38%" scope="col">
                          <table width="100%">
                            <tr>
                            <th nowrap>Date:&nbsp;&nbsp; </th>
                            <th>{{date_format(now(),"d/m/Y")}}</th>
                            </tr>
                            <tr>
                              <th style="text-align:right">Time:&nbsp;&nbsp;</th>
                              <th>{{date_format(now(),"H:i:s")}}</th>
                              </tr>
                          </table>
                        </th>
                      </tr>
                      <tr>
                        <td align="center"><h4>RESULT SLIP</h4></td>
                        <th>&nbsp;</th>
                        <td width="2%">&nbsp;</td>
                      </tr>
                      <tr>
                      <td align="center"><h4><?php echo $resultslip[0]->Semester == 1 ? "1ST SEMESTER" : "2ND SEMESTER"; ?> {{$thesession->SessionYear}}</h4></td>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td></td>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                    <table cellspacing="10" style="text-transform:uppercase;">
                      <tr>
                      <th width="131">MATRIC NO </th>
                      <th width="18">&nbsp;</th>
                      <td width="496">{{$student->MatricNo}}</td>
                      </tr>
                      <tr>
                          <th>STUDENT NAME </th>
                          <th>&nbsp;</th>
                          <td>{{$student->Surname}} {{$student->Firstname}} {{$student->Middlename}}</td>
                      </tr>
                      <tr>
                          <th>SUB/COM</th>
                          <th>&nbsp;</th>
                          <td>{{$subcom->SubjectCombinName}}</td>
                      </tr>
                      <tr>
                          <th>LEVEL</th>
                          <th>&nbsp;</th>
                          <td>{{$resultslip[0]->Level}}</td>
                      </tr>
                      <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>
                  </table>
                    {{-- Header end --}}
                    <table style="width: 100%; margin-top: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; border-left: 1px solid #000; font-size: 12px;" border="0" cellspacing="0">
                            <tr>
                                <td class="topbottomborder">S/N</td>
                                <td class="topbottomborder">COURSE CODE</td>
                                <td class="topbottomborder">SCT</td>
                                <td class="topbottomborder">COURSE TITLE</td>
            
                                <td class="topbottomborder">UNITS</td>
                                                   <td class="topbottomborder">STATUS</td>
                                <td class="topbottomborder">GRADE</td>
                                <td class="topbottomborder">SCORE</td>
                                <td class="topbottomborder">ABS</td>
                            </tr>
                            @foreach($resultslip as $index=>$results)
                            <tr>
                                <td class="topbottomborder">{{$index+1}}</td>
                                <td class="topbottomborder">{{$results->SubjectCode}}</td>
                                <td class="topbottomborder">A</td>
                                <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; text-transform:uppercase" class="auto-style5">{{$results->SubjectName}}</td>
                                <td class="topbottomborder">{{$results->SubjectValue}}</td>
                                <td class="topbottomborder">{{$results->SubjectUnit}}</td>
            
                                <td class="topbottomborder">{{$results->CA+$results->EXAM}}</td>
                                <td class="topbottomborder">{{$results->CA+$results->EXAM}}</td>
                                <td class="topbottomborder"></td>
                            </tr>
                            @endforeach
                            
            
                        </table>
                    <p align="center">&nbsp;</p>
                      <p align="center"><strong>Summary</strong></p>
                      <table style="width: 100%; margin-top: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; border-left: 1px solid #000; font-size: 12px;" border="0" cellspacing="0">
                            <tr>
                                <td style="border-top: 1px solid #000; border-left: 1px solid #000; border-right:1px solid #000;" class="auto-style5">SUBJECT COMBINATION </td>
                                <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-left:1px solid #000;" class="auto-style5">CODE</td>
                                <td colspan="4" align="center" class="topbottomborder">PREVIOUS</td>
                                <td colspan="4" align="center" class="topbottomborder">CURRENT</td>   
                                <td colspan="4" align="center" class="topbottomborder">CUMMULATIVE</td>             
                            </tr>
                            <tr>
                               
                                <td style="border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style5"></td>
                                <td style="border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style5"></td>
                                <td class="topbottomborder">TCP</td>
                                <td class="topbottomborder">TNU</td>
                                <td class="topbottomborder">TNUP</td>
                                <td class="topbottomborder">GPA</td>
                                <td  class="auto-style5">TCP</td>
                                <td class="topbottomborder">TNU</td>
                                <td class="topbottomborder">TNUP</td>
                                <td class="topbottomborder">GPA</td>
                                <td class="topbottomborder">CTCP</td>
                                <td class="topbottomborder">CTNU</td>
                                <td class="topbottomborder">CTNUP</td>
                                <td class="topbottomborder">CGPA</td>
                            </tr>
                            
                            @foreach($deptsummary as $allsummary)
                            <tr>
                                <td class="topbottomborder">{{$allsummary->dname}}</td>
                                <td class="topbottomborder">{{$allsummary->dcode}} </td>
                
                
                                {{-- Prev Summary --}}
                            <?php
                            if ($allsummary->dcode =='TP') {
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
                                <td class="topbottomborder">{{$prevtcp}}</td>
                                <td class="topbottomborder">{{$prevtnuaddup}}</td>
                                <td class="topbottomborder">{{$prevalltnups}}</td>
                                <td class="topbottomborder">{{$prevcgpa}}</td> 

                              {{-- Current Summary --}}
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
                                <td class="topbottomborder">{{$curtcp}}</td>
                                <td class="topbottomborder">{{$curtnuaddup}}</td>
                                <td class="topbottomborder">{{$curalltnups}}</td>
                                <td class="topbottomborder">{{$curcgpa}}</td>
                                
                                <?php
                                $cumtcp = $curtcp + $prevtcp;
                                $cumtnu = $curtnuaddup + $prevtnuaddup;
                                $cumalltnup = $curalltnups + $prevalltnups;
                                $cumcgpa = 0;
                                if($cumtcp > 0 && $cumtnu > 0){
                                $cumcgpa = number_format($cumtcp/$cumtnu, 2);
                                } 
                                ?>

                                
                                <td class="topbottomborder">{{$cumtcp}}</td>
                                <td class="topbottomborder">{{$cumtnu}}</td>
                                <td class="topbottomborder">{{$cumalltnup}}</td>
                                <td class="topbottomborder">{{$cumcgpa}}</td> 
                            </tr>
                            @endforeach

                            <tr>
                                <td colspan="2" class="topbottomborder">OVERALL PERFOMANCE</td>

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
                                <td class="topbottomborder">{{$prevtcp}}</td>
                                <td class="topbottomborder">{{$prevtnuaddup}}</td>
                                <td class="topbottomborder">{{$prevalltnups}}</td>
                                <td class="topbottomborder">{{$prevcgpa}}</td> 

                                {{-- Current Summary --}}
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
                                <td class="topbottomborder">{{$curtcp}}</td>
                                <td class="topbottomborder">{{$curtnuaddup}}</td>
                                <td class="topbottomborder">{{$curalltnups}}</td>
                                <td class="topbottomborder">{{$curcgpa}}</td>

                                <?php
                                $cumtcp = $curtcp + $prevtcp;
                                $cumtnu = $curtnuaddup + $prevtnuaddup;
                                $cumalltnup = $curalltnups + $prevalltnups;
                                $cumcgpa = 0;
                                if($cumtcp > 0 && $cumtnu > 0){
                                $cumcgpa = number_format($cumtcp/$cumtnu, 2);
                                } 
                                ?>

                                
                                <td class="topbottomborder">{{$cumtcp}}</td>
                                <td class="topbottomborder">{{$cumtnu}}</td>
                                <td class="topbottomborder">{{$cumalltnup}}</td>
                                <td class="topbottomborder">{{$cumcgpa}}</td>
                                
                            </tr>
                           
                        </table>
                     

                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                  @else
                      <p>Student Transcript Not Found. </p>
                  @endif
                  @endif
    </div>

</div>


@endsection