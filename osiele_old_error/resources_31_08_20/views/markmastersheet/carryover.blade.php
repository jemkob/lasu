<!--Carry Over students -->
@if(count($COresults) > 0)
{{-- Modified --}}
<?php
 $addup = collect($COresultaddup);
//$keyed = $addup->groupby('matricno')->keyby('subjectcodeco');
 $grouped = $addup->sortBy('matricno')->groupby('matricno');
 $groupedheader = $addup->sortBy('matricno')->groupby('matricno')->first();
 $header = collect($compulsorycourses)->sortBy('matricno')->groupby('matricno')->first();
 //$grouped = collect($grouped)->sortBy('matricno');
 //$flatten = $grouped->flatten();
 //print_r($grouped);
 //dump($grouped);
 //dump($keyed);
?>
<div class="table-responsive">
 <table width="1500px" border="2" style="width: 100%; margin-top: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; border-left: 1px solid #000; font-size: 12px;" >
<thead style="display: table-header-group;">
<tr>   
 
  <th></th>
  <th></th>
  <th></th>
   @foreach($header->sortby('subjectcodeco') as $key=>$gee)
   <th colspan="2">{{$gee->subjectcodeco}} [{{$gee->subjectunitco}} {{$gee->subjectvalueco}}]</th>
    @endforeach
    <th colspan="4">Current</th>
    <th>Remark</th>
    
</tr>
<tr>
    <th>S/N</th>
    <th>MatricNo</th>
    <th>Name</th>
    @foreach($header as $key=>$gee)
    <td>TO</td><td>GP</td>
     @endforeach
     <td>TCP</td><td>TNU</td><td>TNUP</td><td>GP</td>
     <th>Remark</th>
</tr>
</thead>
<tbody>
 @foreach($grouped as $index=>$grp)
 <tr>
   <td><?php $i = array_search($index, array_keys($grouped->toArray()));?> {{$i+1}}</td>
   <td>{{$index}}</td>
   <td >{{$grp[0]->surname}} {{$grp[0]->firstname}} {{$grp[0]->middlename}}  </td>
   {{-- @dump($header)
   asaasasdfasdfsdf
@dump($grp) --}}
    @foreach($header as $key=>$gee)
    {{-- {{dump($header[0]->subjectcodeco)}} --}}
  {{-- {{  array_get($header, 'subjectcodeco')}} --}}
  {{-- {{dump($grp)}} --}}
  <?php if(!isset($grp[$key]->subjectcodeco)) { 
      $actualcourse = collect($grp)->where('subjectcodeco', $gee->subjectcodeco)->flatten();
      $actualcourse->all();
    ?>
    <td>@if(isset($actualcourse[0]->subjectcodeco))
       {{$actualcourse[0]->examca}}
      @endif</td>
    <td>
        @if(isset($actualcourse[0]->subjectcodeco))
        <?php 
        $calculate = $actualcourse[0]->examca;
        if ($calculate >= 70)  {$calculates = 5;}
                elseif ($calculate >= 60 && $calculate <= 69)  {$calculates = 4; $gettnup = $actualcourse[0]->tnu;}
                elseif ($calculate >= 50 && $calculate <= 59)  {$calculates = 3; $gettnup = $actualcourse[0]->tnu;}
                elseif ($calculate >= 45 && $calculate <= 49)  {$calculates = 2; $gettnup = $actualcourse[0]->tnu;}
                elseif ($calculate >= 40 && $calculate <= 44)  {$calculates = 1; $gettnup = $actualcourse[0]->tnu;}
                elseif ($calculate <= 39)  {$calculates = 0; $gettnup = 0;}
                ?>
                 {{$calculates}}
        @endif
    </td>
  <?php } else { ?>
  <?php
  //  if($gee->subjectcodeco == $grp[$key]->subjectcodeco){
   ?>
   
   <?php
      $actualcourse = collect($grp)->where('subjectcodeco', $gee->subjectcodeco)->flatten(1);
      $actualcourse->all();
        //echo $actualcourse; 
        // echo data_get($actualcourse, 'key.subjectcodeco');
        
        ?>
    <td>
      @if(isset($actualcourse[0]->subjectcodeco))
      {{$actualcourse[0]->examca}} 
    @endif
  </td>
    <td>
      @if(isset($actualcourse[0]->subjectcodeco))
      <?php 
      $calculate = $actualcourse[0]->examca;
      if ($calculate >= 70)  {$calculates = 5;}
              elseif ($calculate >= 60 && $calculate <= 69)  {$calculates = 4; $gettnup = $actualcourse[0]->tnu;}
              elseif ($calculate >= 50 && $calculate <= 59)  {$calculates = 3; $gettnup = $actualcourse[0]->tnu;}
              elseif ($calculate >= 45 && $calculate <= 49)  {$calculates = 2; $gettnup = $actualcourse[0]->tnu;}
              elseif ($calculate >= 40 && $calculate <= 44)  {$calculates = 1; $gettnup = $actualcourse[0]->tnu;}
              elseif ($calculate <= 39)  {$calculates = 0; $gettnup = 0;}
              ?>
               {{$calculates}}
      @endif
      </td>
    <?php // } else { ?>
      {{-- <td>NA</td>
      <td>NA</td> --}}
    <?php //}
    } ?>
    @endforeach
    {{-- Get current tnu,tnup, tcp and cgpa --}}
    <?php
            $themat = $index;
            $collection = collect($COresults1);
            $filtered = $collection->where('matricno', $themat);
            $filtered->all();

            $rescollection = collect($COresultaddup);
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
              $tnu1 = $COresults1->first()->sum2;
              $tnup1 = $COresults1->first()->sum;
              
              }
              $cgpa1 = 0;
              // $cgpa1 = number_format($allcalc/$alltnups1, 2);
              $tnuaddup1 = collect($COresults1)->where('matricno', $themat)->sum('sum2');
            if($allcalc > 0 && $tnuaddup1 > 0){
              $cgpa1 = number_format($allcalc/$tnuaddup1, 2);
            } else {
              $cgpa1 = 0;
            }
              // $cgpa1 = number_format($allcalc/$alltnups1, 2);
              //$tnuaddup1 = collect($results1)->where('matricno', $themat)->sum('sum2');

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
                $rescollection = collect($COresultaddup);
                  $resfiltered = $rescollection->where('matricno', $themat);
                  $resfiltered->all();
                //print_r($resfiltered);
                //check to see if any exam and ca sum is gt 39, if it is then remove from the list
                $passed = collect($resfiltered);
                $passed1 = $passed->reject(function ($value, $key) { return $value->examca > 39; });

                $passed1->all();

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


                if(count($passed1) > 0 || ((isset($diff)) && !empty($diff))) {
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
                
                ?>
            </td>
    {{-- end current tnu, tnup, tcp and cgpa --}}
  </tr>
</tbody>
  

 @endforeach
 </table>
</div>
{{-- End of Modiefied --}}


    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
@endif
    <!-- End Carry over  -->