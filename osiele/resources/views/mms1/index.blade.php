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
 
  </style>
<div class="box">
  <div class="box-header with-border noprint">
    <h3 class="box-title">Result Manager</h3>
  </div>
    <div class="box-body">
      <div class="row noprint">
        <div class="col-sm-4">
          <form action="{{url('summary/search')}}" method="post">
            {{csrf_field()}}
                  

                      <div class="form-group">
                            <label for="">Faculties</label>
                            <select class="form-control" name="faculties" id="faculties">
                              <option value="0" disable="true" selected="true">--- Select Faculty ---</option>
                                @foreach ($faculties as $key => $value)
                                  <option value="{{$value->FacultyID}}">{{ $value->FacultyName }}</option>
                                @endforeach
                            </select>
                          </div>
                
                          <div class="form-group">
                            <label for="">Departments</label>
                            <select class="form-control" name="departments" id="departments">
                              <option value="0" disable="true" selected="true">--- Select Department ---</option>
                            </select>
                          </div>
              

                      <div class="form-group">
                            <label for="">Session</label>
                            <select class="form-control" name="sessions" id="sessions">
                              <option value="0" disable="true" selected="true">-- Select Session --</option>
                                @foreach ($sessions as $key => $value)
                                  <option value="{{$value->SessionID}}">{{ $value->SessionYear }}</option>
                                @endforeach
                            </select>
                          </div>
    
                  <div class="form-group">
                        <label for="">Level</label>
                        <select class="form-control" name="level" id="level">
                          <option value="0" disable="true" selected="true">-- Select Level --</option>
                          <option value="100">100</option> 
                          <option value="200">200</option>
                          <option value="300">300</option>
                          <option value="400">400</option>
                          <option value="500">500</option>
                        </select>
                      </div>
    
                  
                  <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Get Results</button>
                </div>
          </form>
        </div>
      </div>
    </div>  
                          
        {{-- {{$resultaddup}} --}}
        @if(isset($results))
        @if(count($results) > 0)

        
        <div class="noprint" align="center">
        
          <button onclick="javascript:window.print()" class="btn btn-warning">Print this page</button>

        </div>

        <table width="100%" border="0">
          <tr>
            <th scope="col" rowspan="5"><img src="../images/logo.png" width="114" height="99" /></th>
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
            <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
              <tr>
                
                <td  scope="col">&nbsp;</td>
                <td  scope="col"><strong>DEPARTMENT</strong></td>
                <td  scope="col" nowrap>{{$departmentname->DepartmentName}}</td>
                <td  scope="col">&nbsp;</td>
                <td  scope="col"><strong>MODULE</strong></td>
                <td  scope="col">{{$level}}</td>
                <td  scope="col"><strong>SESSION</strong></td>
                <td  scope="col">{{$thisession->SessionYear}}</td>
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
          
        <table border="1" width="100%" class="table-responsive">
          <thead>
          <tr>
            <th rowspan="2">S/N</th>
            <th rowspan="2">NAME</th>
            <th rowspan="2">MATRIC NO</th>
            
          <th colspan="4" style="text-align:center;">CURRENT</th>
            
            <th colspan="4" style="text-align:center;">OVERALL</th>
            <th colspan="1" style="text-align:center;">REMARKS</th>
            
            
          </tr>
          <tr>
            
            
            <th> TCP </th>
            <th> TNU </th>
            <th> TNUP </th>
            <th> CGPA </th>
            
            <th> TCP </th>
            <th> TNU </th>
            <th> TNUP </th>
            <th> CGPA </th>
            <th> </th>
            
          </tr>
          </thead>
                @foreach($results as $index=>$result)
                    
                    
                    <tr style="vertical-align:top">
                    <td style="text-align:center;">{{$loop->iteration}}</td>
                    <td style="text-transform:uppercase;">{{$result->surname}} {{$result->firstname}} {{$result->middlename}}</td>
                    <td>{{$result->matricno}}</td>
                    
                    
                    <?php
                    //first department
                    $themat = $result->matricno;
                    $collection = collect($results1);
                    $filtered = $collection->where('matricno', $themat);
                    $filtered->all();

                    if($result->entrylevel == 100){
                      $rescollection = collect($resultaddup);
                    }else{
                      $rescollection = collect($resultaddup)->where('rlevel', '>', 100);
                    }
                    
                    $resfiltered = $rescollection->where('matricno', $themat)->sortbydesc('subjectcodeco')->unique();
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
                    <td align="center">
                      {{-- @dump($resfiltered) --}}
                      <?php 
                      foreach($resfiltered as $resfilt){
                        $calculate=$resfilt->ca+$resfilt->exam;
                        $gettnup = $resfilt->tnu;
                      
                      // if ($calculate >= 70)  {$calculates = 5*$resfilt->tnu;}
                      // elseif ($calculate >= 60 && $calculate <= 69)  {$calculates = 4*$resfilt->tnu; $gettnup = $resfilt->tnu;}
                      // elseif ($calculate >= 50 && $calculate <= 59)  {$calculates = 3*$resfilt->tnu; $gettnup = $resfilt->tnu;}
                      // elseif ($calculate >= 45 && $calculate <= 49)  {$calculates = 2*$resfilt->tnu; $gettnup = $resfilt->tnu;}
                      // elseif ($calculate >= 40 && $calculate <= 44)  {$calculates = 1*$resfilt->tnu; $gettnup = $resfilt->tnu;}
                      // elseif ($calculate <= 44)  {$calculates = 0*$resfilt->tnu; $gettnup = 0;}
                      if ($calculate >= 70)  {$calculates = 5*$resfilt->tnu;}
                        elseif ($calculate >= 60 && $calculate <= 69)  {$calculates = 4*$resfilt->tnu; $gettnup = $resfilt->tnu;}
                        elseif ($calculate >= 50 && $calculate <= 59)  {$calculates = 3*$resfilt->tnu; $gettnup = $resfilt->tnu;}
                        elseif ($calculate >= 45 && $calculate <= 49)  {$calculates = 2*$resfilt->tnu; $gettnup = $resfilt->tnu;}
                        elseif ($calculate >= 40 && $calculate <= 44)  {$calculates = 1*$resfilt->tnu; $gettnup = $resfilt->tnu;}
                        
                        elseif ($calculate < 40)  {$calculates = 0*$resfilt->tnu; $gettnup = 0;}
                      //endif
                      $allcalc +=$calculates;

                      $alltnups1 +=$gettnup; 
                      }

                      $tcp1 = $allcalc;
                      // $tnu1 = $results1->first()->sum2;
                      // $tnup1 = $results1->first()->sum;
                      
                      
                      $cgpa1 = 0.00;
                      // $tnuaddup1 = collect($results1)->where('matricno', $themat)->sum('sum2');
                      $tnuaddup1 = collect($results1)->where('matricno', $themat)->sum('sum');
                      // $tnuaddup1 = collect($resfiltered)->where('matricno', $themat)->sum('sum');
                      
                      $abcd =  collect($results1)->where('matricno', $themat);
                    if($allcalc > 0 && $tnuaddup1 > 0){
                      $cgpa1 = number_format($allcalc/$tnuaddup1, 2);
                    } else {
                      $cgpa1 = 0.00;
                    }
                      // $cgpa1 = number_format($allcalc/$alltnups1, 2);
                      

                      ?>
                      
                      {{$allcalc}}
                      
                    </td>
                    <td align="center">
                      {{$tnuaddup1}} </td>
                    {{-- <td align="center">{{$results1->first()->sum}}{{$alltnups}}</td> --}}
                    <td align="center">{{$alltnups1}}</td>
                    <td align="center">{{number_format($cgpa1, 2)}}</td>
    
    
                    
                    {{-- End Teaching practice --}}

                    {{-- Overall Departments --}}
                    <td align="center">{{$tcp1}}</td>
                    <td align="center">{{$tnuaddup1}}</td>
                    <td align="center">{{$alltnups1}}</td>
                    <?php 
                    $alltcp = $tcp1;
                    // $alltnu = $tnu1+$tnu2+$tnu3+$tnu4;
                    $alltnu = $tnuaddup1;
                    //echo $alltnu.'<-all tnu and all tcp->'.$alltcp;
                    $totalcgpa = 0;
                    if($alltcp > 0 && $alltnu > 0){
                      $totalcgpa = number_format($alltcp/$alltnu, 2);
                    } else {
                      $totalcgpa = 0.00;
                    }
                    //$totalcgpa = number_format($alltcp/$alltnu, 2);
                    $checkco = 0;
                    $theco = '';
                    ?>

                    <td align="center">{{number_format($totalcgpa, 2)}}</td>
                    
                    <td align="left">
                      @if(Auth::user()->Username == 'adminh')
        {{-- @dump(collect($compulsorycourses)->where('subjectvalueco', '!=', 'E')->all()) --}}

        +++++++++++++++++++++++++++++++++++++++
        {{-- @php $collection = collect($compulsorycourses)->where('subjectvalueco', '!=', 'E')->all()->toArray();

        $differentItems = $collection->diff(collect($resultaddup)->where('matricno', $themat)->all()->toArray());

        $differentItems->all(); @endphp
        @dump($differentItems) --}}

        {{-- @dump(collect($resultaddup)->where('matricno', $themat)->all()) --}}
        @endif
                      
                      <?php 
                      
                      $rescollection = collect($resultaddup);
                      
                      // if(isset($results5)){
                      //   $rescollection = collect($resultaddup)->where('subjectvalueco', '!=', 'R')->where('subjectvalueco', '!=', 'E');
                      // }
                        $resfiltered = $rescollection->where('matricno', $themat)->sortKeys()->uniqueStrict('subjectcodeco');
                        $resfiltered->values()->all();
                      // echo $resfiltered;
                      //check to see if any exam and ca sum is gt 39, if it is then remove from the list
                      
                      $passed = collect($resfiltered);
                      $passed1 = $passed->reject(function ($value, $key) { return $value->examca > 39; });

                      // $passed1->sortby('subjectcodeco');
                      $passed1->all(); 
                      
                      //outstanding start
                      // dump($compulsorycourses);
                      $set1='';
                      $set2='';
                      
                      

                      $set1 = collect($compulsorycourses)->where('subjectvalueco', '!=', 'E');

                      if($result->entrylevel == 100){
                        $set1 = collect($compulsorycourses)->where('subjectlevel', $level)->where('subjectvalueco', '!=', 'E');
                      }else{
                        $set1 = collect($set1)->where('subjectlevel', '>', 100)->where('subjectvalueco', '!=', 'E');
                      }
                      // dump($set1. ' entry ='.$result->entrylevel);
                      
                          // $set1 = collect($compulsorycourses)->where('subjectlevel', $level);
                          
                      
                      // $set1 = collect($compulsorycourses)->where('subjectlevel', $level)->where('semester', $semester); // Contents omitted for brevity
                      //  $set1 = $set1->reject(function ($value, $key) { return $value->subjectvalueco = 'E'; });
                      $set2 = collect($resfiltered); // Contents omitted for brevity
                      $diff = array();
                      $set1->each(function($item, $key) use($set2, &$diff) {
                          $exists = $set2->where('subjectcodeco', $item->subjectcodeco)->first(); // Where clause omitted for brevity
                          if(!$exists) {
                              array_push($diff, $item);
                          }
                      });

                      //prev outstanding
                      if($result->entrylevel == 100){
                      $resfilteredp = $rescollection->where('matricno', $themat)->where('rlevel', $level-100)->sortKeys()->uniqueStrict('subjectcodeco');
                        $resfilteredp->values()->all();

                      $set1p='';
                      $set2p='';
                      if($level < 600){
                        $set1p = collect($compulsorycourses)->where('subjectlevel', $level-100); 
                      } 
                    }else{
                      $resfilteredp = $rescollection->where('matricno', $themat)->where('rlevel', $level-100)->sortKeys()->uniqueStrict('subjectcodeco');
                        $resfilteredp->values()->all();

                      $set1p='';
                      $set2p='';
                      if($level < 600){
                        $set1p = collect($compulsorycourses)->where('subjectlevel', $level-100); 
                      }
                    }
                      //commented out for checking if it conforms to all
                      // else {
                      //   $set1p = collect($compulsorycourses)->where('subjectlevel', 200); 
                        
                      // }
                      // Contents omitted for brevity
                      //  $set1 = $set1->reject(function ($value, $key) { return $value->subjectvalueco = 'E'; });
                      // dd($set1p);
                      // dd($resfilteredp);
                      $set2p = collect($resfilteredp); // Contents omitted for brevity
                      $diffp = array();
                      // if($level < 400){
                      $set1p->each(function($item, $key) use($set2p, &$diffp) {
                          $exists = $set2p->where('subjectcodeco', $item->subjectcodeco)->first(); // Where clause omitted for brevity
                          if(!$exists) {
                              array_push($diffp, $item);
                          }
                      });
                    // }
                      //outstanding ends
                      //for oustanding of previous and current course
                      // @dump($diffp);
                      $theos='';
                      $thecos='';
                      $theos = collect($diffp); // Contents omitted for brevity
                      $thecos = collect($resfiltered); // Contents omitted for brevity
                      $ost = array();
                      $theos->each(function($item, $key) use($thecos, &$ost) {
                          $exists = $thecos->where('subjectcodeco', $item->subjectcodeco)->first(); // Where clause omitted for brevity
                          if(!$exists) {
                              array_push($ost, $item);
                          }
                      });
                      // echo $passed1;
                      // echo $resfiltered.' =====';
                      if(count($passed1) > 0 || ((isset($diff)) && !empty($diff)) ) {
                      // if(count($passed1) > 0 || ((isset($diff)) && !empty($diff))){
                        //sort resfiltered aka carryover
                      $resfiltered = collect($passed1)->sortby('subjectcodeco');
                      
                      echo 'F. '; 
                      // dump($resfiltered->where)
                        foreach ($resfiltered as $co){
                        $checkco = $co->ca+$co->exam;
                          if($co->examca < 40){                                
                          $theco = $co->subjectcodeco. '('.$co->subjectunitco.''.$co->subjectvalueco.'), '.$co->examca;
                          echo $theco.' | ';
                          }
                          // echo $checkco.' '.$co->subjectcodeco;
                          
                        }
                      } else {
                        // if (count($results2) < 1){
                        //       if(($level == 300 && $semester == 2) && ($cgpa1 < 1 || $cgpa3 < 1 || $cgpa4 < 1 )){
                        //       echo 'FAILED';
                        //     } elseif(($level > 300) && ($cgpa1 < 1 || $cgpa3 < 1 || $cgpa4 < 1)) {
                        //       echo 'FAILED';
                        //     } else {
                        //       echo 'PASSED';
                        //     }

                        // }else {
                        //     if(($level == 300 && $semester == 2) && ($cgpa1 < 1 || $cgpa2 < 1 || $cgpa3 < 1 || $cgpa4 < 1 )){
                        //     echo 'FAILED';
                        //   } elseif(($level > 300) && ($cgpa1 < 1 || $cgpa2 < 1 || $cgpa3 < 1 || $cgpa4 < 1)) {
                        //     echo 'FAILED';
                        //   } else {
                            echo 'PASSED';
                        //   }
                        // }
                        
                        
                      }
                      
                      

                      //echo $diff['subjectcodeco'][0];
                      if((isset($diff)) && !empty($diff) && ((isset($diffp)) && !empty($diffp) && !empty($ost))) {
                      // if((isset($diff)) && !empty($diff) ) {
                      echo '<span class="os"><b>O/S:</b></span>';
                      foreach($diff as $diffs){
                      echo $diffs->subjectcodeco. '('.$diffs->subjectunitco.''.$diffs->subjectvalueco.') ';
                      }
                      
                      // if(Auth::user()->Username == 'admin'){
                      //     // return $resultaddup;
                      //   foreach($ost as $diffs){
                      //   echo $diffs->subjectcodeco. '('.$diffs->subjectunitco.''.$diffs->subjectvalueco.') ';
                      //   }
                      // }
                      
                    }
                    
                    //Can't remeber why this
                    // if((isset($diffp)) && !empty($diffp)){
                    // foreach($diffp as $diffs){
                    //   echo $diffs->subjectcodeco. '('.$diffs->subjectunitco.''.$diffs->subjectvalueco.') ';
                    //   }
                    // }
                      ?>
                      {{-- <!-- @dump($resfiltered) --> --}}
                    </td>
                    </tr>
                  
                  
                        
                @endforeach    
                </table>
            <p>&nbsp;</p>
            {{-- {{-- <div style="text-align:center"> --}}
            <?php 
            /* $summarypassed = collect($resultaddup)->where('subjectvalueco', '!=', 'R');
            $summarypassedsorted = $summarypassed->reject(function ($value, $key) { return $value->examca > 39; })->groupby('matricno');
            $resultspassed = collect($results)->whereNotIn('matricno', $summarypassedsorted->keys());
            $resultsfailed = collect($results)->whereIn('matricno', $summarypassedsorted->keys()); */
            ?>
          {{-- <u>SUMMARY</u>&emsp;|&emsp; <strong>Total Students: </strong> {{count($results)}} &emsp;|&emsp; <strong>Total Passed: </strong>{{count($resultspassed)}} &emsp;|&emsp; <strong>Total Failed: </strong>{{count($resultsfailed)}} 
            </div> --}}

            <p>&nbsp;</p>
            <p>&nbsp;</p>
        @else
            <p>No Result for this level.</p>
        @endif
        @endif
    </div>

</div>

<script src="{{asset('jscss/bootstrap.min.js')}}"></script>
    <script src="{{asset('jscss/jquery.min.js')}}"></script>

   
  
      <script type="text/javascript">
        $('#faculties').on('change', function(e){
          console.log(e);
          var faculty_id = e.target.value;
          $.get('/json-departments?faculty_id=' + faculty_id,function(data) {
            console.log(data);
            $('#departments').empty();
            $('#departments').append('<option value="0" disable="true" selected="true">--- Select Department ---</option>');

            $('#programmes').empty();
            $('#programmes').append('<option value="0" disable="true" selected="true">--- Select Programme ---</option>');

            $.each(data, function(index, departmentsObj){
              $('#departments').append('<option value="'+ departmentsObj.DepartmentID +'">'+ departmentsObj.DepartmentName +'</option>');
            })
          });
        });

        $('#departments').on('change', function(e){
          console.log(e);
          var department_id = e.target.value;
          $.get('/json-programmes?department_id=' + department_id,function(data) {
            console.log(data);
            $('#programmes').empty();
            $('#programmes').append('<option value="" disable="true" selected="true">--- Select Programme ---</option>');

            $.each(data, function(index, programmesObj){
              $('#programmes').append('<option value="'+ programmesObj.SubjectCombinID +'">'+ programmesObj.SubjectCombinName +'</option>');
            })
          });
        });
   
      </script> 
      
 <script type="text/javascript">
      $(document).ready(function () {
    toggleFields(); 

    $("#programmes").change(function () {
        toggleFields();
    });
    $("#level").change(function () {
        toggleFields();
    });

}); 

function toggleFields() {
    if ($("#programmes").val() == "90" && $("#level").val() >= 300)
        $("#bedas").show();
    else
        $("#bedas").hide();
}
</script>
      
    
    
@endsection