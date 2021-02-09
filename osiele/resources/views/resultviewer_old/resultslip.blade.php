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
  @page {
   margin-left: 1mm;
   margin-right: 1mm;
   margin-top: 4mm;
  }
  .topbottomborder 
  {
    border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;
}
  
  </style>
<div class="box">
  <div class="box-header with-border noprint">
    <h3 class="box-title">Result Slip</h3>
  </div>
    <div class="box-body" style="text-transform:uppercase;">
            <div class="row noprint">
                    <div class="col-sm-8">
                      <form action="{{url('resultslip')}}" method="post">
                        {{csrf_field()}}
                        <table>
                            <tr>
                                <td>Session</td><td>Level</td><td>Semester</td><td>Matric No.</td>
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
                                <td>
                                    <select class="form-control" name="level" id="level">
                                    <option value="0" disable="true" selected="true">-- Select Level --</option>
                                    <option value="100">100</option> 
                                    <option value="200">200</option>
                                    <option value="300">300</option>
                                    <option value="400">400</option>
                                    <option value="500">500</option>
                                    </select>
                                </td>
                                <td> 
                                    <select class="form-control" name="semester" id="semester">
                                    <option value="0" disable="true" selected="true">-- Select Semester --</option>
                                    <option value="1">1st Semester</option> 
                                    <option value="2">2nd Semester</option>
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
                        <th scope="col" rowspan="5"><img src="../images/logo.png" height="99" /></th>
                        <td align="center" scope="col"><h3><strong>FEDERAL COLLEGE OF EDUCATION ABEOKUTA</strong></h3></td>
                        <th scope="col">
                          <table width="100%">
                            <tr>
                            <th nowrap>Date:&nbsp;&nbsp; </th>
                            <td>{{date_format(now(),"d/m/Y")}}</td>
                            </tr>
                            <tr>
                              <th>Time:&nbsp;&nbsp;</th>
                              <td>{{date_format(now(),"H:i:s")}}</td>
                              </tr>
                          </table>
                        </th>
                      </tr>
                      <tr>
                        <td align="center"><h4>RESULT SLIP</h4></td>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                      <td align="center"><h4><?php echo $resultslip[0]->Semester == 1 ? "1ST SEMESTER" : "2ND SEMESTER"; ?> {{$thesession->SessionYear}}</h4></td>
                        <th>&nbsp;</th>
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
                                <th class="topbottomborder">S/N</th>
                                <th class="topbottomborder">COURSE CODE</th>
                                <th class="topbottomborder">SCT</th>
                                <th class="topbottomborder">COURSE TITLE</th>
            
                                <th class="topbottomborder">UNITS</th>
                                                   <th class="topbottomborder">STATUS</th>
                                <th class="topbottomborder">GRADE</th>
                                <th class="topbottomborder">SCORE</th>
                                <th class="topbottomborder">ABS</th>
                            </tr>
                            @foreach($resultslip->sortby('SubjectCode') as $index=>$results)
                            <tr>
                                <td class="topbottomborder">{{$loop->iteration}}</td>
                                <td class="topbottomborder">{{$results->SubjectCode}}</td>
                                <td class="topbottomborder">A</td>
                                <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; text-transform:uppercase" class="auto-style5">{{$results->SubjectName}}</td>
                                <td class="topbottomborder">{{$results->SubjectValue}}</td>
                                <td class="topbottomborder">{{$results->SubjectUnit}}</td>
            
                                <td class="topbottomborder">
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
                                <td class="topbottomborder">{{$results->CA+$results->EXAM}}</td>
                                <td class="topbottomborder"></td>
                            </tr>
                            @endforeach
                            <tr>
                                <?php 
                                    $result= collect($regunitf)->where('examca', '<', 40)->sum('tnu');
                                    $result2= collect($regunitf)->sum('tnu');
                                    //$regunitfailed= $result->sum('tnu');
                                ?>

                            <td colspan="9" align="center" style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000;" class="auto-style5"><table width="100%" border="0">
                              <tr>
                              	  <td width="14%"></td>
                                  <td width="44%"><strong>Number of Credit Unit Registered : {{$result2}}</strong></td>
                                  <td width="42%"><strong>Total Number of Credit Unit Failed: {{$result}}</strong></td>
                                </tr>
                              </table></td>
                               
                            </tr>
            
                        </table>
                  
                  
                        <?php 
                          $rescollection = collect($summary);
                            $resfiltered = $rescollection->sortKeys()->unique('subjectcodeco');
                            $resfiltered->all();
                          
                          //check to see if any exam and ca sum is gt 39, if it is then remove from the list
                          $passed = collect($resfiltered);
                          $passed1 = $passed->reject(function ($value, $key) { return $value->examca > 39; });

                          $passed1->sortby('subjectcodeco');
                          $passed1->all();
                          ?>
                      <p align="center"><strong>Carried course(s) for the next semester</strong></p>
                      <table style="width: 100%; margin-top: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; border-left: 1px solid #000; font-size: 12px;" border="0" cellspacing="0">
                            <tr>
                                
                                <th class="topbottomborder">COURSE CODE</th>
                                <th class="topbottomborder">COURSE TITLE</th>
                                <th class="topbottomborder">STATUS</th>
                                <th class="topbottomborder">UNIT</th>
                                <th class="topbottomborder">SCORE</th>
                                <th class="topbottomborder">REMARK</th>
                            </tr>
                            @if(count($passed1)>0)
                            @foreach ($passed1->sortby('subjectcodeco') as $co)
                            <tr>
                                <td class="topbottomborder">{{$co->subjectcodeco}}</td>
                                <td class="topbottomborder">{{$co->subjectnameco}}</td>
                                <td class="topbottomborder">{{$co->subjectvalueco}}</td>
                                <td class="topbottomborder">{{$co->subjectunitco}}</td>
                                <td class="topbottomborder">{{$co->examca}}</td>
                                <td class="topbottomborder">FAILED</td>
                            </tr>
                            @endforeach
                            
                            
                            
                            <tr>
                            <td colspan="4" align="center" style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000;" class="auto-style5"><strong>Number of Courses : </strong> {{count($passed1)}}</td>
                                <td colspan="4" style="border-bottom: 1px solid #000; border-top: 1px solid #000;" class="auto-style5"><strong></strong></td>
                            </tr>
                            @endif
                        </table>
                        
                        
                        <?php
                            //outstanding variables
                            $set1='';
                            $set2='';
                            $set1 = collect($compulsorycourses)->where('subjectvalueco', '!=', 'E'); // Contents omitted for brevity
                            $set2 = collect($resfiltered); // Contents omitted for brevity
                            $diff = array();
                            $set1->each(function($item, $key) use($set2, &$diff) {
                                $exists = $set2->where('subjectcodeco', $item->subjectcodeco)->first(); // Where clause omitted for brevity
                                if(!$exists) {
                                    array_push($diff, $item);
                                }
                            });
                            //end outstanding
                            ?>
                            
                            @if((isset($diff)) && !empty($diff)) 

                        <p align="center"><strong>Course(s) Not taken</strong></p>
                      <table style="width: 100%; margin-top: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; border-left: 1px solid #000; font-size: 12px;" border="0" cellspacing="0">
                            <tr>
                                
                                <th class="topbottomborder">COURSE CODE</th>
                                <th class="topbottomborder">COURSE TITLE</th>
                                <th class="topbottomborder">STATUS</th>
                                <th class="topbottomborder">UNIT</th>
                                <th class="topbottomborder">REMARK</th>
                            </tr>
                            
                            
                            @foreach ($diff as $co)
                            <tr>
                                <td class="topbottomborder">{{$co->subjectcodeco}}</td>
                                <td class="topbottomborder">{{$co->subjectnameco}}</td>
                                <td class="topbottomborder">{{$co->subjectvalueco}}</td>
                                <td class="topbottomborder">{{$co->subjectunitco}}</td>
                                <td class="topbottomborder">OUTSTANDING</td>
                            </tr>
                            @endforeach
                            
                            
                            
                            <tr>
                            <td colspan="4" align="center" style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000;" class="auto-style5"><strong>Number of Courses : </strong> {{count($diff)}}</td>
                                <td colspan="4" style="border-bottom: 1px solid #000; border-top: 1px solid #000;" class="auto-style5"><strong></strong></td>
                            </tr>
                            
                        </table>
                        @endif

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
                              /* if ($resultslip[0]->Level == 300 && $resultslip[0]->Semester==1) {
                            $resfiltered = $thesummary->where('deptcode', 'TP');
                            } else { */
                              //$resfiltered = $thesummary;
                              $resfiltered = $thesummary->where('deptcode', $allsummary->dcode);
                            //}
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
                                
                                
                              }
                              $curtcp = $allcalc;
                              $curcgpa = 0;
                              $curtnuaddup = collect($deptresults)->where('deptname', $allsummary->dname)->sum('sum2');
                             
                              if($allcalc > 0 && $curtnuaddup > 0){
                                $curcgpa = number_format($allcalc/$curtnuaddup, 2);
                              } else {
                                $curcgpa = 0;
                              }
                            // }  
                                 ?>
                              @if($resultslip[0]->Level == 300 && $resultslip[0]->Semester==1)
                                @if($allsummary->dcode ==='TP')    
                                <td class="topbottomborder">{{$curtcp}}</td>
                                <td class="topbottomborder">{{$curtnuaddup}}</td>
                                <td class="topbottomborder">{{$curalltnups}}</td>
                                <td class="topbottomborder">{{$curcgpa}}</td>
                                @else
                                <td class="topbottomborder">0</td>
                                <td class="topbottomborder">0</td>
                                <td class="topbottomborder">0</td>
                                <td class="topbottomborder">0</td>
                                @endif
                              @else
                              <td class="topbottomborder">{{$curtcp}}</td>
                              <td class="topbottomborder">{{$curtnuaddup}}</td>
                              <td class="topbottomborder">{{$curalltnups}}</td>
                              <td class="topbottomborder">{{$curcgpa}}</td>
                              @endif

                                
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
                      <div align='center'>
                      <table>
                        <tr>
                          <td>___________________</td>
                        </tr>
                        <tr>
                          <td style="text-align:center;">REGISTRAR</td>
                        </tr>
                      </table>
                      </div>
                      
                  @else
                      <p>Student Resultslip Not Found. </p>
                  @endif
                  @endif
    </div>

</div>


@endsection