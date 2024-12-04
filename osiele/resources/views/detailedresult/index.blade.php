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
                      <form action="{{url('detailedresult/search')}}" method="post">
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
                          
        
                  {{-- Header --}}
                   @if(isset($results))
                   <form action="{{url('detailedresult/print')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="pfaculty" value="{{$faculty}}">
                    <input type="hidden" name="plevel" value="{{$level}}">
                    <input type="hidden" name="pdepartment" value="{{$department}}">
                    <input type="hidden" name="psession" value="{{$session01}}">
                    <button class="btn btn-primary" type="submit">print</button>
                   </form>

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

                 
                  <table width="100%">
                    
                      <tr>
                      <td style="font-size:10px">Date printed: {{date_format(now(),"d/m/Y H:i:s")}}</td>
                      </tr>
                    </table>
                    
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
                  <div class="table-responsive">
                   <table width="1500px" border="2" style="width: 100%; margin-top: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; border-left: 1px solid #000; font-size: 10px;" class="table-responsive">
                  <tr>   
                   
                    <th></th>
                    <th></th>
                    <th></th>
                     {{-- @foreach($groupedheader->sortby('subjectcodeco') as $key=>$gee)
                     <th colspan="4">{{$gee->subjectcodeco}} [{{$gee->subjectunitco}} {{$gee->subjectvalueco}}]</th>
                      @endforeach --}}

                    @foreach($compulsorycourses as $key=>$gee)
                    <th colspan="4">{{$gee->subjectcodeco}} [{{$gee->subjectunitco}} {{$gee->subjectvalueco}}]</th>
                      @endforeach
                      <th colspan="4">Current</th>
                      <th>Remark</th>
                      
                  </tr>
                  <tr>
                      <th>S/N</th>
                      <th>MatricNo</th>
                      <th>Name</th>
                      @foreach($compulsorycourses as $key=>$gee)
                      <td>CA</td><td>EX</td><td>TO</td><td>GP</td>
                       @endforeach
                       <td>TCP</td><td>TNU</td><td>TNUP</td><td>GP</td>
                       <th>Remark</th>
                  </tr>
                   @foreach($grouped->sortby('subjectcodeco') as $index=>$grp)
                   <tr>
                     <td><?php $i = array_search($index, array_keys($grouped->toArray()));?> {{$loop->iteration}}</td>
                     <td>{{$index}}</td>
                     <td >{{$grp[0]->surname}} {{$grp[0]->firstname}} {{$grp[0]->middlename}}  </td>

                      {{-- @foreach($grp->sortby('subjectcodeco') as $key=>$gee)
                      <td>{{$gee->ca}}</td><td>{{$gee->exam}}</td> <td>{{$gee->examca}}</td>
                      <td> --}}
                        <?php 
                        // $calculate = $gee->examca;
                        // if ($calculate >= 70)  {$calculates = 5*$gee->tnu;}
                        //         elseif ($calculate >= 60 && $calculate <= 69)  {$calculates = 4*$gee->tnu; $gettnup = $gee->tnu;}
                        //         elseif ($calculate >= 50 && $calculate <= 59)  {$calculates = 3*$gee->tnu; $gettnup = $gee->tnu;}
                        //         elseif ($calculate >= 45 && $calculate <= 49)  {$calculates = 2*$gee->tnu; $gettnup = $gee->tnu;}
                                
                        //         elseif ($calculate < 45)  {$calculates = 0*$gee->tnu; $gettnup = 0;}
                                ?>
                                 {{-- {{$calculates}}
                        </td>
                      @endforeach --}}
                      @foreach($compulsorycourses as $cc)
                        <?php
                        $gee = $grp->where('subjectcodeco', $cc->subjectcodeco)->first();
                        ?>
                        @if(!empty($gee))
                        <td>{{$gee->ca}}</td><td>{{$gee->exam}}</td> <td>{{$gee->examca}}</td>
                        <td>
                          <?php 
                          $calculate = $gee->examca;
                          if ($calculate >= 70)  {$calculates = 5*$gee->tnu;}
                                  elseif ($calculate >= 60 && $calculate <= 69)  {$calculates = 4*$gee->tnu; $gettnup = $gee->tnu;}
                                  elseif ($calculate >= 50 && $calculate <= 59)  {$calculates = 3*$gee->tnu; $gettnup = $gee->tnu;}
                                  elseif ($calculate >= 45 && $calculate <= 49)  {$calculates = 2*$gee->tnu; $gettnup = $gee->tnu;}
                                  
                                  elseif ($calculate < 45)  {$calculates = 0*$gee->tnu; $gettnup = 0;}
                                  ?>
                                  {{$calculates}}
                          </td>
                          @else 
                          <td>0</td>
                          <td>0</td>
                          <td>0</td>
                          <td>0</td>
                        @endif

                          
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
                                elseif ($calculate < 45)  {$calculates = 0*$resfilt->tnu; $gettnup = 0;}
                                //endif
                                $allcalc +=$calculates;

                                $alltnups1 +=$gettnup; 

                                $tcp1 = $allcalc;
                                $tnu1 = $results1->first()->sum2;
                                $tnup1 = $results1->first()->sum;
                                
                                }
                                $cgpa1 = 0;
                                $tnuaddup1 = collect($results1)->where('matricno', $themat)->sum('sum2');
                              if($allcalc > 0 && $tnuaddup1 > 0){
                                $cgpa1 = number_format($allcalc/$tnuaddup1, 2);
                              } else {
                                $cgpa1 = 0;
                              }
                                // $cgpa1 = number_format($allcalc/$alltnups1, 2);
                                

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
  
                                  if(count($passed1) > 0 || isset($diff) && !empty($diff)) {
                                  echo 'F. ';
                                    foreach ($resfiltered as $co){
                                    //$checkco = $co->ca+$co->exam;
                                      if($co->examca <= 39){                                
                                      $theco = $co->subjectcodeco. '('.$co->subjectunitco.''.$co->subjectvalueco.'), '.$co->examca;
                                      echo $theco.' | ';
                                      }
                                    }
                                  } else {
                                    echo 'Passed ';
                                  }
  
                                  //echo $diff['subjectcodeco'][0];
                                  if((isset($diff)) && !empty($diff)) {
                                  echo '<b> O/S: </b>';
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
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
            $('#programmes').append('<option value="0" disable="true" selected="true">--- Select Programme ---</option>');

            $.each(data, function(index, programmesObj){
              $('#programmes').append('<option value="'+ programmesObj.SubjectCombinID +'">'+ programmesObj.SubjectCombinName +'</option>');
            })
          });
        });
   
      </script> 
    
    
@endsection