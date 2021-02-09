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
<div class="box" style="text-transform:uppercase;">
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
                  
                          
        
                  @if(isset($transcript))
                  @if(count($transcript) > 0)
                  
                  
                   <?php 
                  // $all= collect($transcript)->groupby('Level')->all();
                   ?>
                   @foreach($tlevel as $levels)
                  <table width="100%" border="0">
                      <tr>
                        <td width="24%" align="center" scope="col">&nbsp;</td>
                        
                        <td width="46%" align="center" nowrap scope="col"><h3><strong>FEDERAL COLLEGE OF EDUCATION, ABEOKUTA</strong><br>
                        OFFICIAL TRANSCRIPT</h3></td>
                        <td width="30%">
                          <table width="50%" style="float:right">
                            <tr>
                              <th>Page:</th>
                              <td>&nbsp;</td>
                              <th>{{$loop->iteration}}</th>
                            </tr>
                            <tr>
                            <th width="27%">Date:</th>
                            <td width="3%">&nbsp;</td>
                            <th width="70%">{{date_format(now(),"d/m/Y")}}</th>
                            </tr>
                            <tr>
                              <th >Time:</th>
                              <td>&nbsp;</td>
                              <th>{{date_format(now(),"H:i:s")}}</th>
                              </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td align="center"></td>
                      <td align="center"></td>
                        <th>&nbsp;</th>
                        
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
                          <td>{{$levels->Level}}</td>
                      </tr>
                      <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>
                  </table>
                    {{-- Header end --}}
                    <table style="width: 100%; margin-top: 5px; font-size: 14px; font-family:'New Times Roman', serif;" border="0" cellspacing="0">
                    <tr style="height: 2.5px;"><td colspan="7" style="border-top: 2px dotted #000; height: 2.5px;"></td></tr>
                    
                    
                            <tr>
                                <td>S/N</td>
                                <td>COURSE CODE</td>
                                
                                <td>COURSE TITLE</td>
            
                                <td>UNITS</td>
                                <td>STATUS</td>
                                <td>GRADE</td>
                                
                                <td>REMARK</td>
                            </tr>
                            <tr style="height: 2.5px;"><td colspan="7" style="border-bottom: 2px dotted #000; height: 2.5px;"></td></tr>
                            <?php 
                            $thelevel = $levels->Level;
                            $firstsem = collect($transcript)->where('Level', $thelevel)->where('Semester', 1)->all();
                            ?>
                            <tr><td><strong>Semester</strong></td><td>First Semester</td></tr>
                            <tr><td><strong>Session</strong></td><td>{{$levels->SessionYear}}</td></tr>
                            @foreach($firstsem as $index=>$results)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$results->SubjectCode}}</td>
                                
                                <td>{{$results->SubjectName}}</td>
                                <td>{{$results->SubjectValue}}</td>
                                <td>{{$results->SubjectUnit}}</td>
            
                                <td>
                                    <?php $total = $results->EXAM + $results->CA;?>
                                        @if($total >= 70)
                                        A 
                                        @elseif($total >= 60 && $total <= 69)
                                        B 
                                        @elseif($total >= 50 && $total <= 59)
                                        C
                                        @elseif($total >= 45 && $total <= 49)
                                        D 
                                        @elseif($total >= 40 && $total <= 44)
                                        E 
                                        @elseif($total < 40)
                                        F
                                        @endif
                                </td>
                                <td>
                                        @if($total > 39)
                                        Passed 
                                        @else
                                        failed 
                                        @endif
                                </td>
                            </tr>
                            @endforeach
                            <tr style="height: 2.5px;"><td colspan="7" style="height: 2.5px;"></td></tr>
                            <tr style="height: 2.5px;"><td colspan="7" style="border-top: 1px dotted #000; height: 2.5px;"></td></tr>
                            <tr style="height: 2.5px;"><td colspan="7" style="border-top: 1px dotted #000; height: 2.5px;"></td></tr>

                            <?php
                            $secondsem = collect($transcript)->where('Level', $thelevel)->where('Semester', 2)->all();
                            ?>
                            <tr>
                              <td style="height:10px"></td>
                              <td></td>
                            </tr>
                            <tr><td><strong>Semester</strong></td><td>Second Semester</td></tr>
                            <tr><td><strong>Session</strong></td><td>{{$levels->SessionYear}}</td></tr>
                            <tr>
                              <td style="height:10px"></td>
                              <td></td>
                            </tr>
                            @foreach($secondsem as $index=>$results)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$results->SubjectCode}}</td>
                                
                                <td>{{$results->SubjectName}}</td>
                                <td>{{$results->SubjectValue}}</td>
                                <td>{{$results->SubjectUnit}}</td>
            
                                <td>
                                        <?php $total = $results->EXAM + $results->CA;?>
                                            @if($total >= 70)
                                            A 
                                            @elseif($total >= 60 && $total <= 69)
                                            B 
                                            @elseif($total >= 50 && $total <= 59)
                                            C
                                            @elseif($total >= 45 && $total <= 49)
                                            D 
                                            @elseif($total >= 40 && $total <= 44)
                                            E 
                                            @elseif($total < 40)
                                            F
                                            @endif
                              </td>
                                <td>
                                            @if($total > 39)
                                            Passed 
                                            @else
                                            failed 
                                            @endif
                                </td>
                            </tr>
                            @endforeach
                            <tr style="height: 2.5px;"><td colspan="7" style="height: 2.5px;"></td></tr>
                            <tr style="height: 2.5px;"><td colspan="7" style="border-top: 1px dotted #000; height: 2.5px;"></td></tr>
                            <tr style="height: 2.5px;"><td colspan="7" style="border-top: 1px dotted #000; height: 2.5px;"></td></tr>
                            
            
                        </table>
                        <p style="page-break-after: always;">&nbsp;</p>
                    @endforeach
      <p>&nbsp;</p>

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
                            
                            @foreach($deptsummary->where('dcode', '!=', 'DEWS') as $allsummary)
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
                              if ($transcript[0]->Level == 300 && $transcript[0]->Semester==1) {
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
                            if ($transcript[0]->Level == 300 && $transcript[0]->Semester==1) {
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
                  @else
                      <p>Student Transcript Not Found. </p>
                  @endif
                  @endif
    </div>

</div>


@endsection