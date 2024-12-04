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
  <style type="text/css" media="print">
    @page
    {
        size: auto; /* auto is the initial value */
        margin: 2mm 4mm 0mm 0mm;  this affects the margin in the printer settings
    }
    thead
    {
        display: table-header-group;
    }
    tfoot
    {
        display: table-footer-group;
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
                  <table border="0" style="width: 100%; margin-top: 5px; font-size: 12px; font-family:'New Times Roman', serif;">
                      <tr>
                        <td width="24%" align="center" scope="col">&nbsp;</td>
                        
                        <td width="46%" align="center" nowrap scope="col"><h3><strong>FEDERAL COLLEGE OF EDUCATION, ABEOKUTA</strong><br>
                        OFFICIAL TRANSCRIPT</h3></td>
                        <td width="30%">
                          <table width="50%" style="float:right; font-size: 12px; font-family:'New Times Roman', serif; font-weight:bold;">
                            <tr>
                              <td>Page:</td>
                              <td>&nbsp;</td>
                              <td align="left" nowrap>&emsp;{{$loop->iteration}}</td>
                            </tr>
                            <tr>
                            <td width="27%">Date:</td>
                            <td width="3%">&nbsp;</td>
                            <td width="70%" nowrap>&emsp;{{date_format(now(),"d/m/Y")}}</td>
                            </tr>
                            <tr>
                              <td >Time:</td>
                              <td>&nbsp;</td>
                              <td nowrap>&emsp;{{date_format(now(),"H:i:s")}}</td>
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
                    <table cellspacing="10" style="width: 100%; margin-top: 5px; font-size: 12px; font-family:'New Times Roman', serif;text-transform:uppercase;">
                      <tr>
                      <th width="153" align="left" nowrap>STUDENT NUMBER:</th>
                      <th width="18">&nbsp;</th>
                      <td width="958"><strong>{{$student->MatricNo}}</strong></td>
                      </tr>
                      <tr>
                          <th align="left">STUDENT NAME: </th>
                          <th>&nbsp;</th>
                          <td><strong>{{$student->Surname}} {{$student->Firstname}} {{$student->Middlename}}</strong></td>
                      </tr>
                      <tr>
                         <th align="left"> SUB/COMB:</th> 
                          <th>&nbsp;</th>
                          <td><table width="673" border="0" style="font-size: 12px; font-family:'New Times Roman', serif;text-transform:uppercase;">
                            <tr>
                                <td width="490"><strong>@if(empty($student->subcourse)){{$subcom->SubjectCombinName}}
                            @else 
                              @if($student->subcourse == 'beda')
                              BED/BED - ACCOUNTING
                              @else
                              BED/BED - OFFICE TECH. MANAGEMENT
                              @endif
                            @endif </strong></td>
                                <td width="52"><strong>LEVEL:</strong></td>
                                <td width="117"><strong>
                                  @if($levels->Level > 300) 300+ @else {{$levels->Level}} @endif
                                </strong></td>
                              </tr>
                        </table></td>
                      </tr>
                      <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>
                  </table>
                    {{-- Header end --}}
                    <table style="width: 100%; margin-top: 5px; font-size: 12px; font-family:'New Times Roman', serif;" border="0" cellspacing="0">
                    <tr style="height: 2.5px;"><td colspan="7" style="border-top: 2px dotted #000; height: 2.5px;"></td></tr>
                    
                    
                            <tr>
                                <td><strong>NO.</strong></td>
                                <td><strong>SUBJECT</strong></td>
                                
                                <td align="center"><strong>TITLE</strong></td>
            
                                <td align="center"><strong>UNIT</strong></td>
                                <td align="center"><strong>STATUS</strong></td>
                                <td align="center"><strong>GRADE</strong></td>
                                
                                <td align="center"><strong>REMARK</strong></td>
                            </tr>
                            <tr style="height: 2.5px;"><td colspan="7" style="border-bottom: 2px dotted #000; height: 2.5px;"></td></tr>
                            <?php 
                            $thelevel = $levels->Level;
                            $firstsem = collect($transcript)->where('Level', $thelevel)->where('Semester', 1)->all();
                            ?>
                            @if(count($firstsem) > 0)
                            <tr><td colspan="7"><table style="margin-top: 5px; font-size: 12px; font-family:'New Times Roman', serif;" width="260" border="0">
                              <tr>
                                <td width="77"><strong>Session:</strong></td>
                                <td width="173">
                                  
                                  @if($levels->old_sessionId == 0) 
                                  {{$levels->SessionYear}}
                                  @else 
                                      @foreach($sessions as $ses) 
                                      @if($levels->old_sessionId == $ses->SessionID)
                                      {{$ses->SessionYear}}
                                      @endif
                                    @endforeach
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <td><strong>Semester:</strong></td>
                                <td>First</td>
                              </tr>
                      </table></td></tr>
                            <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
                            @foreach($firstsem as $index=>$results)
                            <tr>
                                <td valign="top" style="height: 4.5px;">{{$loop->iteration}}</td>
                                <td align="center" valign="top">{{$results->SubjectCode}}</td>
                                
                                <td valign="top">{{$results->SubjectName}}</td>
                                <td align="center" valign="top">{{$results->TNU}}</td>
                                <td align="center" valign="top">{{$results->SubjectValue}}</td>
            
                                <td align="center" valign="top">
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
                                <td align="center" valign="top">
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
                            @endif

                          <?php
                          $secondsem = collect($transcript)->where('Level', $thelevel)->where('Semester', 2)->all();
                          
                          ?>
                          @if(count($secondsem) > 0)
                            <tr>
                              <td style="height:10px"></td>
                              <td></td>
                            </tr>
                            <tr><td colspan="7"><table style="margin-top: 5px; font-size: 12px; font-family:'New Times Roman', serif;" width="260" border="0">
                              <tr colspan="7">
                                <td width="77"><strong>Session:</strong></td>
                                <td width="173">
                                  @if($levels->old_sessionId == 0) 
                                  {{$levels->SessionYear}}
                                  @else 
                                      @foreach($sessions as $ses) 
                                      @if($levels->old_sessionId == $ses->SessionID)
                                      {{$ses->SessionYear}}
                                      @endif
                                    @endforeach
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <td><strong>Semester:</strong></td>
                                <td>Second</td>
                              </tr>
                      </table></td></tr>
                            <tr>
                              <td style="height:10px"></td>
                              <td></td>
                              
                            </tr>
                            @foreach($secondsem as $index=>$results)
                            <tr>
                                <td valign="top" style="height: 4px;">{{$loop->iteration}}</td>
                              <td align="center" valign="top">{{$results->SubjectCode}}</td>
                                
                                <td valign="top">{{$results->SubjectName}}</td>
                                <td align="center" valign="top">{{$results->TNU}}</td>
                                <td align="center" valign="top">{{$results->SubjectValue}}</td>
            
                                <td align="center" valign="top">
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
                                <td align="center" valign="top">
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
                            @endif
                            
            
                        </table>
                        @if($loop->last)
      <p style="page-break-after: avoid;">&nbsp;</p>
                        @else 
                        <p style="page-break-after: always;">&nbsp;</p>
                        @endif
                    @endforeach
      
                      <table style="width: 100%; margin-top: 5px; font-size: 12px; font-family:'New Times Roman', serif;" border="0" cellspacing="0">
                        <tr style="height: 2.5px;"><td colspan="4" style="height: 2.5px;"></td></tr>
                            <tr style="height: 2.5px;"><td colspan="15" style="border-top: 1px dotted #000; height: 2.5px;"></td></tr>
                           
                            <tr>
                                <td  class="auto-style5"></td>
                                <td class="auto-style5">CODE</td>
                                <td colspan="4" align="center" >PREVIOUS</td>
                                <td colspan="4" align="center" >CURRENT</td>   
                                <td colspan="4" align="center">CUMMULATIVE</td>
                                <td>GRADE</td>             
                            </tr>
                            <tr style="height: 2.5px;"><td colspan="15" style="height: 2.5px;"></td></tr>
                            <tr style="height: 2.5px;"><td colspan="15" style="border-top: 1px dotted #000; height: 2.5px;"></td></tr>
                            <tr>
                               
                                <td class="auto-style5"></td>
                                <td class="auto-style5"></td>
                                <td align="center" >TCP</td>
                                <td align="center">TNU</td>
                                <td align="center">TNUP</td>
                                <td align="center">GPA</td>
                                <td align="center"  class="auto-style5">TCP</td>
                                <td align="center">TNU</td>
                                <td align="center">TNUP</td>
                                <td align="center">GPA</td>
                                <td align="center">CTCP</td>
                                <td align="center">CTNU</td>
                                <td align="center">CTNUP</td>
                                <td align="center">CGPA</td>
                            </tr>
                            {{-- @dd($deptsummary) --}}
                            @foreach($deptsummary->where('dcode', '!=', 'DEWS') as $allsummary)
                            <tr>
                                <td>{{$allsummary->dname}}</td>
                                <td >{{$allsummary->dcode}} </td>
                
                
                                {{-- Prev Summary --}}
                            <?php
                            if ($allsummary->dcode =='TP' && $levels->Level == 300 ) {
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
                                <td align="right">{{$prevtcp}}</td>
                                <td align="right">{{$prevtnuaddup}}</td>
                                <td align="right">{{$prevalltnups}}</td>
                                <td align="right">{{$prevcgpa}}</td> 

                              {{-- Current Summary --}}
                            <?php
                            /* if ($allsummary->dcode !='TP') {
                                  
  
                                } else { */
                                  $curtcp = 0;
                                  $curcgpa = 0;
                                  $curalltnups = 0;
                                  $curtnuaddup = 0;
                              $thesummary = collect($summary);
                              if ($transcript[0]->Level >= 300 ) {
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
                              <td align="right">{{$curtcp}}</td>
                                <td align="right">{{$curtnuaddup}}</td>
                                <td align="right">{{$curalltnups}}</td>
                                <td align="right">{{$curcgpa}}</td>
                                
                                <?php
                                $cumtcp = $curtcp + $prevtcp;
                                $cumtnu = $curtnuaddup + $prevtnuaddup;
                                $cumalltnup = $curalltnups + $prevalltnups;
                                $cumcgpa = 0;
                                if($cumtcp > 0 && $cumtnu > 0){
                                $cumcgpa = number_format($cumtcp/$cumtnu, 2);
                                } 
                                ?>

                                
                              <td align="right">{{$cumtcp}}</td>
                                <td align="right">{{$cumtnu}}</td>
                                <td align="right">{{$cumalltnup}}</td>
                                <td align="right">{{$cumcgpa}} &nbsp;&nbsp;&nbsp;</td>
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
                            </tr>
                            @endforeach

                            <tr>
                                <td colspan="2">OVERALL PERFOMANCE</td>

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
                                // $prevtcp = 0;
                                // $prevtnuaddup = 0;
                                // $prevalltnups = 0;
                              }
                            }
                          // }
                                ?>
                                <td align="right">{{$prevtcp}}</td>
                                <td align="right">{{$prevtnuaddup}}</td>
                                <td align="right">{{$prevalltnups}}</td>
                                <td align="right">{{$prevcgpa}}</td> 

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
                              <td align="right">{{$curtcp}}</td>
                                <td align="right">{{$curtnuaddup}}</td>
                                <td align="right">{{$curalltnups}}</td>
                                <td align="right">{{$curcgpa}}</td>

                                <?php
                                $cumtcp = $curtcp + $prevtcp;
                                $cumtnu = $curtnuaddup + $prevtnuaddup;
                                $cumalltnup = $curalltnups + $prevalltnups;
                                $cumcgpa = 0;
                                if($cumtcp > 0 && $cumtnu > 0){
                                $cumcgpa = number_format($cumtcp/$cumtnu, 2);
                                } 
                                ?>

                                
                              <td align="right">{{$cumtcp}}</td>
                                <td align="right">{{$cumtnu}}</td>
                                <td align="right">{{$cumalltnup}}</td>
                                <td align="right">{{$cumcgpa}} &nbsp;&nbsp;&nbsp;</td>
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
                                
                            </tr>
                            <tr style="height: 2.5px;"><td colspan="15" style="height: 2.5px;"></td></tr>
                            <tr style="height: 2.5px;"><td colspan="15" style="border-top: 1px dotted #000; height: 2.5px;"></td></tr>
                            <tr style="height: 2.5px;"><td colspan="15" style="border-top: 1px dotted #000; height: 2.5px;"></td></tr>
                            
                           
                          </table>
                          
                  <table width="100%" border="0" style="width: 100%; margin-top: 5px; font-size: 12px; font-family:'New Times Roman', serif;text-transform:uppercase;">
                        <tr>
                          <td width="70%" valign="top">
                            <table width="330" style="margin-top: 5px; font-size: 12px; font-family:'New Times Roman', serif;text-transform:uppercase;">
                            <tr>
                            <td>OUTSTANDING SUBJECTS FAILED:</td>
                            <td>NO.&emsp; CR.</td>
                            </tr>
                            <?php $totalout = 0; ?>
                            @foreach($deptsummary->where('dcode', '!=', 'DEWS') as $allsummary)
                            <tr>
                                <td>{{$allsummary->dname}}</td>
                                <td><?php 
                                
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
                                   $totalout = $totalout + count($resfiltered);
                                    echo count($resfiltered).'&emsp;&emsp;&emsp;'.$resfiltered->sum('subjectunitco');
                                    
                                    } else {
                                      echo '0&emsp;&emsp;&emsp;0';
                                    }
                            
                                    /* if((isset($diff)) && !empty($diff)) {
                                    echo '<b>O/S:</b>';
                                    echo count($diff);
                                    } */
                                ?></td>
                                <td>&nbsp;</td>
                            </tr>
                            @endforeach
                            <tr>
                              <td>TOTAL SUBJECTS OUTSTANDING</td>
                              <td>{{$totalout}}</td>
                              </tr>
                              
                            
                              </table>
                          </td>
                          <td width="30%"><table width="87%" style="width: 100%; margin-top: 5px; font-size: 12px; font-family:'New Times Roman', serif;text-transform:uppercase;">
                            <tr>
                              <td colspan="2" align="center">C.G.P.A.</td>
                              <td width="30%">GRADE</td>
                              <td width="26%">LETTER</td>
                            </tr>
                            <tr>
                              <td width="20%">4.50</td>
                              <td width="24%">5.00</td>
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
                        <tr>
                          <td colspan="2" align="center" valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2" align="center" valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2" align="center" valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2" align="center" valign="top"><table width="221" border="0">
                          <tr style="height: 2.5px;"><td width="215" style="height: 2.5px;"></td></tr>
                            <tr style="height: 2.5px;"><td style="border-top: 1px dotted #000; height: 2.5px;"></td></tr>
                             
                            <tr style="height: 2.5px;"><td style="border-top: 1px dotted #000; height: 2.5px;"></td></tr>
                           
                            <tr>
                              <td align="center">REGISTRAR</td>
                            </tr>
                            
                          </table></td>
                          
                    </tr>
      </table>
      @else
<p>Student Transcript Not Found. </p>
                  @endif
                  @endif
    </div>

</div>


@endsection