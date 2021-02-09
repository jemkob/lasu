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
                                          <label for="">Programmes</label>
                                          <select class="form-control" name="programmes" id="programmes">
                                            <option value="0" disable="true" selected="true">--- Select Programme ---</option>
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
                                <label for="">Semester</label>
                                <select class="form-control" name="semester" id="semester">
                                  <option value="0" disable="true" selected="true">-- Select Semester --</option>
                                  <option value="1">1st Semester</option> 
                                  <option value="2">2nd Semester</option>
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
                  
                          
        
                  @if(isset($results))
                  @if(count($results) > 0)
                  @dump($results4);
                  <form action="{{url('summary/print')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="pfaculty" value="{{$faculty}}">
                    <input type="hidden" name="plevel" value="{{$level}}">
                    <input type="hidden" name="pdepartment" value="{{$department}}">
                    <input type="hidden" name="pprogram" value="{{$programme}}">
                    <input type="hidden" name="psemester" value="{{$semester}}">
                    <input type="hidden" name="psession" value="{{$session01}}">
                    <button class="btn btn-primary" type="submit">print</button>
                   </form>
                   </div>
                  <table width="100%" border="0">
                      <tr>
                        <th scope="col" rowspan="5"><img src="../images/logo.png" width="114" height="99" /></th>
                        <td align="center" scope="col"><h3><strong>FEDERAL COLLEGE OF EDUCATION ABEOKUTA</strong></h3></td>
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
                  
                  <table border="1" width="100%">
                    <tr>
                      <th rowspan="2">S/N</th>
                      <th rowspan="2">MATRIC NO</th>
                      
                      <th colspan="4" align="center">{{$deptcode1}}</th>
                      @if (count($results2) < 1) 
                      @else
                      <th colspan="4" align="center">{{$deptcode2}}</th>
                      @endif
                      <th colspan="4" align="center">{{$deptcode3}}</th>
                      <th colspan="4" align="center">{{$deptcode4}}</th>
                      <th colspan="4" align="center">OVERALL</th>
                      <th colspan="1" align="center">REMARKS</th>
                      
                     
                    </tr>
                    <tr>
                      
                      
                      <th>TCP</th>
                      <th>TNU</th>
                      <th>TNUP</th>
                      <th>CGPA</th>
                      @if (count($results2) < 1) 
                      @else
                      <th>TCP</th>
                      <th>TNU</th>
                      <th>TNUP</th>
                      <th>CGPA</th>
                      @endif
                      <th>TCP</th>
                      <th>TNU</th>
                      <th>TNUP</th>
                      <th>CGPA</th>
                      <th>TCP</th>
                      <th>TNU</th>
                      <th>TNUP</th>
                      <th>CGPA</th>
                      <th>TCP</th>
                      <th>TNU</th>
                      <th>TNUP</th>
                      <th>CGPA</th>
                      <th> </th>
                      
                    </tr>
                          @foreach($results as $index=>$result)
                              
                              
                              <tr>
                              <td>{{$index+1}}</td>
                              <td>{{$result->matricno}}</td>
                              
                              
                              <?php
                              //first department
                              $themat = $result->matricno;
                              $collection = collect($results1);
                              $filtered = $collection->where('matricno', $themat);
                              $filtered->all();
              
                              $rescollection = collect($resultaddup);
                              $resfiltered = $rescollection->where('matricno', $themat)->where('departmentid', $deptid1);
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
                              <td align="center"><?php 
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
                                }

                                $tcp1 = $allcalc;
                                $tnu1 = $results1->first()->sum2;
                                $tnup1 = $results1->first()->sum;
                                
                                
                                $cgpa1 = 0;
                              if($allcalc > 0 && $alltnups1 > 0){
                                $cgpa1 = number_format($allcalc/$tnu1, 2);
                              } else {
                                $cgpa1 = 0;
                              }
                                // $cgpa1 = number_format($allcalc/$alltnups1, 2);
                                $tnuaddup1 = collect($results1)->where('matricno', $themat)->sum('sum2');

                                ?>
                                
                                {{$allcalc}}
                               
                              </td>
                              <td>{{$tnu1}}</td>
                              {{-- <td align="center">{{$results1->first()->sum}}{{$alltnups}}</td> --}}
                              <td>{{$alltnups1}}</td>
                              <td>{{$cgpa1}}</td>
              
              
                              <?php
                              //second department
                              if (count($results2) < 1) {
                                $tcp2 = 0;
                                $tnu2 = 0;
                                $tnup2 = 0;
                                $cgpa2 = 0;
                                $alltnups2 = 0;
                                $tnuaddup2 = 0;

                              }else {

                              
                              $themat = $result->matricno;
                              $collection = collect($results2);
                              $filtered = $collection->where('matricno', $themat);
                              $filtered->all();
              
                              $rescollection = collect($resultaddup);
                              $resfiltered = $rescollection->where('matricno', $themat)->where('departmentid', $deptid2);
                              $resfiltered->all();
                              $allcalc= 0;
                              $alltnups2 = 0;
                              
                              ?>
                              <td align="center"><?php 
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

                                $alltnups2 +=$gettnup; 
                                $tcp2 = $allcalc;
                                $tnu2 = $results2->first()->sum2;
                                $tnup2 = $results2->first()->sum;
                              }
                              $cgpa2 = 0;
                              $tnuaddup2 = collect($results2)->where('matricno', $themat)->sum('sum2');
                              if($allcalc > 0 && $alltnups2 > 0){
                                $cgpa2 = number_format($allcalc/$tnuaddup2, 2);
                              } else {
                                $cgpa2 = 0;
                              }
                                
                                ?>
                                
                                {{$allcalc}}
                              </td>
                              <td align="center">{{$results2->first()->sum2}}</td>
                              <td align="center">{{$alltnups2}}</td>
                              <td align="center">{{$cgpa2}}</td>
                            <?php } ?>
                              <?php 
                              //third department
                              $themat = $result->matricno;
                              $collection = collect($results3);
                              $filtered = $collection->where('matricno', $themat);
                              $filtered->all();
              
                              $rescollection = collect($resultaddup);
                              $resfiltered = $rescollection->where('matricno', $themat)->where('departmentid', $deptid3);
                              $resfiltered->all();
                              $allcalc= 0;
                              $alltnups3=0;
                              $tnup3=0;
                              ?>
                              <td align="center"><?php 
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

                                $alltnups3 +=$gettnup; 
                                
                                $tcp3 = $allcalc;
                                $tnu3 = $results3->first()->sum2;
                                $tnup3 = $results3->first()->sum;
                              }
                              $cgpa3 = 0;
                              $tnuaddup3 = collect($results3)->where('matricno', $themat)->sum('sum2');
                              if($allcalc > 0 && $alltnups3 > 0){
                                $cgpa3 = number_format($allcalc/$tnuaddup3, 2);
                              } else {
                                $cgpa3 = 0;
                              }
                                
                                ?>
                                
                                {{$allcalc}}
                              </td>
                              <td align="center">{{$tnuaddup3}}</td>
                              <td align="center">{{$alltnups3}}</td>
                              <td align="center">{{$cgpa3 }}</td>
              
              
                              <?php
                              //last department
                              $themat = $result->matricno;
                              $collection = collect($results4);
                              $filtered = $collection->where('matricno', $themat);
                              $filtered->all();
              
                              $rescollection = collect($resultaddup);
                              $resfiltered = $rescollection->where('matricno', $themat)->where('departmentid', $deptid4);
                              $resfiltered->all();
                              $allcalc= 0;
                              $alltnups4=0;
                              ?>
                              <td align="center"><?php 
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

                                $alltnups4 +=$gettnup; 
                                
                                $tcp4 = $allcalc;
                                $tnu4 = $results4->first()->sum2;
                                $tnup4 = $results4->first()->sum;
                              }
                              $cgpa4 = 0;
                              $tnuaddup4 = collect($results4)->where('matricno', $themat)->sum('sum2');
                              if($allcalc > 0 && $alltnups4 > 0){
                                $cgpa4 = number_format($allcalc/$tnuaddup4, 2);
                              } else {
                                $cgpa4 = 0;
                              }
                                
                                ?>
                                
                                {{$allcalc}}
                              </td>
                              <td align="center">{{$tnuaddup4}}</td>
                              <td align="center">{{$alltnups4}}</td>
                              <td align="center">{{$cgpa4}}</td>
                              {{-- Overall Departments --}}
                              <td align="center">{{$tcp1+$tcp2+$tcp3+$tcp4}}</td>
                              <td align="center">{{$tnu1+$tnu2+$tnu3+$tnu4}}</td>
                              <td align="center">{{$alltnups1+$alltnups2+$alltnups3+$alltnups4}}</td>
                              <?php 
                              $alltcp = $tcp1+$tcp2+$tcp3+$tcp4;
                              // $alltnu = $tnu1+$tnu2+$tnu3+$tnu4;
                              $alltnu = $tnuaddup1+$tnuaddup2+$tnuaddup3+$tnuaddup4;
                              //echo $alltnu.'<-all tnu and all tcp->'.$alltcp;
                              $totalcgpa = 0;
                              if($alltcp > 0 && $alltnu > 0){
                                $totalcgpa = number_format($alltcp/$alltnu, 2);
                              } else {
                                $totalcgpa = 0;
                              }
                              //$totalcgpa = number_format($alltcp/$alltnu, 2);
                              $checkco = 0;
                              $theco = '';
                              ?>

                              <td align="center">{{$totalcgpa}}</td>
                              
                              <td align="left">
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
                                  echo 'Passed';
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
                                echo '<b>O/S:</b>';
                                foreach($diff as $diffs){
                                echo $diffs->subjectcodeco. '('.$diffs->subjectunitco.''.$diffs->subjectvalueco.') ';
                                }
                              }
                                ?>
                              </td>
                              </tr>
                            
                            
                                  
                          @endforeach    
                          </table>
                      <p>&nbsp;</p>
                     

                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                  @else
                      <p>No posts found</p>
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
              $('#departments').append('<option value="'+ departmentsObj.DepartmantID +'">'+ departmentsObj.DepartmentName +'</option>');
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