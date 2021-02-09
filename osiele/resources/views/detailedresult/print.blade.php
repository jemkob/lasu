<style type="text/css">
  
  
  @media print
  {
  .noprint {display:none;}
  }
  
  @media screen
  {
  
  }
  body { font: 12pt Georgia, "Times New Roman", Times, serif; line-height: 1.3; } 
  @page { /* switch to landscape */ size: landscape; /* set page margins */ margin: 0.5cm; /* Default footers */ @bottom-left { content: "Department of Strategy"; } @bottom-right { content: counter(page) " of " counter(pages); } } /* footer, header - position: fixed */ 
  #header { position: fixed; width: 100%; top: 0; left: 0; right: 0; } 
  #footer { position: fixed; width: 100%; bottom: 0; left: 0; right: 0; page-break-after: always; } 
  /* Fix overflow of headers and content */ 
  body { padding-top: 50px; } 
  .custom-page-start { margin-top: 50px; } 
  .custom-footer-page-number:after { content: counter(page); }

  </style>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

  
<div class="box">
  
    <div class="box-body">
            
                          
        
                  {{-- Header --}}
                   @if(isset($results))
                   <div id="header">

                  <table width="100%" border="0">
                      <tr>
                        <th scope="col" rowspan="5"><img src="../images/logo.png" width="114" height="99" /></th>
                        <td align="center" scope="col"><h2><strong>FEDERAL COLLEGE OF EDUCATION ABEOKUTA</strong></h2></td>
                        <th scope="col">&nbsp;</th>
                      </tr>
                      <tr>
                        <td align="center"><h4>NCE DETAILED RESULT</h4></td>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
                          <tr>
                            <td width="69" scope="col"><strong>SCHOOL</strong></td>
                            <td width="199" nowrap="nowrap" scope="col"><span id="school">{{$theschool->FacultyName}}</span></td>
                            <td width="16" scope="col">&nbsp;</td>
                            <td width="92" scope="col"><strong>PROGRAME</strong></td>
                            <td width="135" scope="col">{{$theprogramme->SubjectCombinName}}</td>
                            <td width="45" scope="col">&nbsp;</td>
                            <td width="51" scope="col"><strong>LEVEL</strong></td>
                            <td width="42" scope="col">{{$level}}</td>
                            <td width="86" scope="col"><strong>SEMESTER</strong></td>
                            <td width="39" scope="col"> {{$semester}}</td>
                            <td width="67" scope="col"><strong>SESSION</strong></td>
                            <td width="93" scope="col">{{$thisession->SessionYear}}</td>
                            </tr>
                        </table></td>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                    {{-- Header end --}}
                   
                 
                  <table width="100%">
                    
                      <tr>
                      <td style="font-size:10px">Date printed: {{date_format(now(),"d/m/Y H:i:s")}}</td>
                      </tr>
                    </table>
                    </div>
                  @if(count($results) > 0)
                  {{-- Modified --}}
                  <?php
                   $addup = collect($resultaddup);
                  //$keyed = $addup->groupby('matricno')->keyby('subjectcodeco');
                   $grouped = $addup->sortBy('matricno')->groupby('matricno');
                   $groupedheader = $addup->sortBy('matricno')->groupby('matricno')->first();
                   //$grouped = collect($grouped)->sortBy('matricno');
                   //$flatten = $grouped->flatten();
                   //print_r($grouped);
                   //dump($grouped);
                   //dump($keyed);
                  ?>
                  <div class="table-responsive" style="padding-top: 100px;">
                   <table border="1" style="width: 100%; font-size: x-small;" >
                  <tr>   
                   
                    <th></th>
                    <th></th>
                    <th></th>
                     @foreach($groupedheader->sortby('subjectcodeco') as $key=>$gee)
                     <th colspan="4">{{$gee->subjectcodeco}}</th>
                      @endforeach
                      <th colspan="4">Current</th>
                      <th>Remark</th>
                      
                  </tr>
                  <tr>
                      <th>S/N</th>
                      <th>MatricNo</th>
                      <th>Name</th>
                      @foreach($groupedheader as $key=>$gee)
                      <td>CA</td><td>EX</td><td>TO</td><td>GP</td>
                       @endforeach
                       <td>TCP</td><td>TNU</td><td>TNUP</td><td>GP</td>
                       <th>Remark</th>
                  </tr>
                   @foreach($grouped as $index=>$grp)
                   <tr>
                     <td><?php $i = array_search($index, array_keys($grouped->toArray()));?> {{$i+1}}</td>
                     <td>{{$index}}</td>
                     <td >{{$grp[0]->surname}} {{$grp[0]->firstname}} {{$grp[0]->middlename}}  </td>
                      @foreach($grp->sortby('subjectcodeco') as $key=>$gee)
                      <td>{{$gee->ca}}</td><td>{{$gee->exam}}</td> <td>{{$gee->examca}}</td>
                      <td>
                        <?php 
                        $calculate = $gee->examca;
                        if ($calculate >= 70)  {$calculates = 5*$gee->tnu;}
                                elseif ($calculate >= 60 && $calculate <= 69)  {$calculates = 4*$gee->tnu; $gettnup = $gee->tnu;}
                                elseif ($calculate >= 50 && $calculate <= 59)  {$calculates = 3*$gee->tnu; $gettnup = $gee->tnu;}
                                elseif ($calculate >= 45 && $calculate <= 49)  {$calculates = 2*$gee->tnu; $gettnup = $gee->tnu;}
                                elseif ($calculate >= 40 && $calculate <= 44)  {$calculates = 1*$gee->tnu; $gettnup = $gee->tnu;}
                                elseif ($calculate <= 39)  {$calculates = 0*$gee->tnu; $gettnup = 0;}
                                ?>
                                 {{$calculates}}
                        </td>
                      @endforeach
                      {{-- Get current tnu,tnup, tcp and cgpa --}}
                      <?php
                              $themat = $index;
                              $collection = collect($results1);
                              $filtered = $collection->where('matricno', $themat);
                              $filtered->all();
              
                              $rescollection = collect($resultaddup);
                              $resfiltered = $rescollection->where('matricno', $themat);
                              $resfiltered->all();
                              $allcalc= 0;
                              $alltnups1 = 0;

                              $tcp1=0;
                              $tcp2=0;
                              $tcp3=0;
                              $tcp4=0;

                              $tnu1=0;
                              $tnu2=0;
                              $tnu3=0;
                              $tnu4=0;
                              ?>
                              <td align="center" style="width:30px"><?php 
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

                                $alltnups1 +=$gettnup; 

                                $tcp1 = $allcalc;
                                $tnu1 = $results1->first()->sum2;
                                $tnup1 = $results1->first()->sum;
                                
                                }
                                $cgpa1 = 0;
                              if($allcalc > 0 && $alltnups1 > 0){
                                $cgpa1 = number_format($allcalc/$alltnups1, 2);
                              } else {
                                $cgpa1 = 0;
                              }
                                // $cgpa1 = number_format($allcalc/$alltnups1, 2);
                                $tnuaddup1 = collect($results1)->where('matricno', $themat)->sum('sum2');

                                ?>
                                
                                {{$allcalc}}
                               
                              </td>
                              <td style="width:30px">{{$tnuaddup1}}</td>
                              {{-- <td align="center">{{$results1->first()->sum}}{{$alltnups}}</td> --}}
                              <td style="width:30px">{{$alltnups1}}</td>
                              <td style="width:30px">{{$cgpa1}}</td>
                              {{-- End of Current cgpa, tnu, tnup --}}

                              <td style="width:300px">
                                  <?php 
                                  $rescollection = collect($resultaddup);
                                    $resfiltered = $rescollection->where('matricno', $themat);
                                    $resfiltered->all();
                                  //print_r($resfiltered);
                                  //check to see if any exam and ca sum is gt 39, if it is then remove from the list
                                  $passed = collect($resfiltered);
                                  $passed1 = $passed->reject(function ($value, $key) { return $value->examca > 39; });
  
                                  $passed1->all();
  
                                  if(count($passed1) > 0) {
                                  echo 'F. ';
                                    foreach ($resfiltered as $co){
                                    //$checkco = $co->ca+$co->exam;
                                      if($co->examca <= 39){                                
                                      $theco = $co->subjectcodeco. '('.$co->subjectunitco.''.$co->subjectvalueco.'), '.$co->examca;
                                      echo $theco.' | ';
                                      }
                                      // echo $checkco.' '.$co->subjectcodeco;
                                      
                                    }
                                  } else {
                                    echo 'Passed ';
                                  }
  
                                  $set1='';
                                  $set2='';
                                  $set1 = collect($compulsorycourses); // Contents omitted for brevity
                                  $set2 = collect($resfiltered); // Contents omitted for brevity
                                  $diff = array();
                                  $set1->each(function($item, $key) use($set2, &$diff) {
                                      $exists = $set2->where('subjectcodeco', $item->subjectcodeco)->first(); // Where clause omitted for brevity
                                      if(!$exists) {
                                          array_push($diff, $item);
                                      }
                                  });
  
                                  //echo $diff['subjectcodeco'][0];
                                  if((isset($diff)) && !empty($diff)) {
                                  echo '<b> O/S:</b>';
                                  foreach($diff as $diffs){
                                  echo $diffs->subjectcodeco. '('.$diffs->subjectunitco.''.$diffs->subjectvalueco.') ';
                                  }
                                }
                                  ?>
                              </td>
                      {{-- end current tnu, tnup, tcp and cgpa --}}
                    </tr>
                    
                  
                   @endforeach
                   </table>
                  </div>
                  {{-- End of Modiefied --}}

                  
                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                  @else
                      <p>No result found</p>
                  @endif
                  @endif
    </div>

</div>