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
 
  table {
    counter-reset: rowNumber-2;
}

table tr {
    counter-increment: rowNumber;
}

table tr td:first-child::before {
    content: counter(rowNumber);
    min-width: 1em;
    margin-right: 0.5em;
}
  </style>
<div class="box">
  <div class="box-header with-border noprint">
    <h3 class="box-title">Result Manager</h3>
  </div>
    <div class="box-body">
      <div class="row noprint">
        <div class="col-sm-4">
          <form action="{{url('graduating/searchgraduating')}}" method="post">
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
                          {{-- <option value="100">100</option> 
                          <option value="200">200</option>
                          <option value="300">300</option>
                          <option value="400">400</option> --}}
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
                      <td style="visibility: hidden"></td>
                      <td align="center" scope="col"><h2><strong>LAGOS STATE UNIVERSITY, OJO, ABEOKUTA CAMPUS</strong></h2>
                        <h3>SANDWICH DEGREE PROGRAMME DIRECTORATE</h3>
                      </td>
                      <th scope="col">&nbsp;</th>
                    </tr>
                    <tr>
                      <td style="visibility: hidden"></td>
                      <td align="center"><h3>LIST OF GRADUATING STUDENTS FOR SENATE APPROVAL</h3></td>
                      <th>&nbsp;</th>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td style="visibility: hidden"></td>
                      <td align="center"><h2>{{$departmentname->DepartmentName}} {{$thisession->SessionYear}} ACADEMIC SESSION</h2></td>
                      <th>&nbsp;</th>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td style="visibility: hidden"></td>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td style="visibility: hidden"></td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                    {{-- Header end --}}
                    
                  <table border="1" width="100%" class="table-responsive">
                    <thead>
                    <tr>
                      {{-- <td style="visibility: hidden"></td> --}}
                      <th rowspan="2">S/N</th>
                      <th rowspan="2"> NAME</th>
                      <th rowspan="2"> MATRIC NO </th>
                      <th style="text-align:center;"> TCP </th>
                      <th style="text-align:center;"> TNU </th>
                      <th style="text-align:center;"> TNUP </th>
                      <th style="text-align:center;"> CGPA </th>
                      <th style="text-align:center;"> GRADE </th>
                      <th style="text-align:center;"> CLASS </th>
                     
                     
                    </tr>
                    <tr>
                      
                      
                    </tr>
                    </thead>
                          @foreach($results as $index=>$result)


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
                              <?php 
                                foreach($resfiltered as $resfilt){
                                 $calculate=$resfilt->ca+$resfilt->exam;
                                 $gettnup = $resfilt->tnu;
                                
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
                                $gunit = 144;
                                if($result->entrylevel == 100){
                                  $gunit = 144;
                                }else{
                                  $gunit = 108;
                                }

                                $rescollection = collect($resultaddup);
                                
                                  $resfiltered = $rescollection->where('matricno', $themat)->sortKeys()->uniqueStrict('subjectcodeco');
                                  $resfiltered->values()->all();
                                // echo $resfiltered;
                                //check to see if any exam and ca sum is gt 39, if it is then remove from the list
                                
                                $passed = collect($resfiltered);
                                $passed1 = $passed->reject(function ($value, $key) { return $value->examca > 40; })->where('subjectvalueco', '!=', 'E');
                                // $passed1->sortby('subjectcodeco');
                                $passed1->all();

                                if(count($passed1) > 0 ) {
                                // if(count($passed1) > 0 || ((isset($diff)) && !empty($diff))){
                                  //sort resfiltered aka carryover
                                $resfiltered = collect($passed1)->sortby('subjectcodeco');
                                
                                }
                                

                                ?>
                                
                                {{-- {{$alltnups1.' => '.$gunit}} --}}
                               
                              
{{-- 108, 144  --}}
                              
                              @if($alltnups1 >= $gunit && count($passed1) < 1)

                              <tr style="vertical-align:top">
                              <td style="text-align:center;"> </td>
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
                              <td align="center"><?php 
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
                              <td align="center">{{$tnuaddup1}} </td>
                              {{-- <td align="center">{{$results1->first()->sum}}{{$alltnups}}</td> --}}
                              <td align="center">{{$alltnups1}}</td>
                              <td align="center">{{number_format($cgpa1, 2)}}</td>
              
                              <td align="center">
                                @php
                                $gp = $cgpa1;
                                    if($gp >= 4.50){
                                    echo 'A';
                                    }elseif($gp >= 3.50 && $gp <= 4.49){
                                      echo 'B';
                                    }elseif($gp >= 2.40 && $gp <= 3.49){
                                      echo 'C';
                                    }elseif($gp >= 1.50 && $gp <= 2.39){
                                      echo 'D';
                                    }elseif($gp >= 1.00 && $gp <= 1.50){
                                      echo 'E';
                                    }else{
                                      echo 'F';
                                    }
                                @endphp
                              </td>
                              <td style="text-align:center;">
                                @php
                                    if($gp >= 4.50){
                                    echo '1st Class';
                                  }elseif($gp >= 3.50 && $gp <= 4.49){
                                    echo '2nd Class Upper';
                                  }elseif($gp >= 2.40 && $gp <= 3.49){
                                    echo '2nd Class Lower';
                                  }elseif($gp >= 1.50 && $gp <= 2.39){
                                    echo '3rd Class';
                                  }elseif($gp >= 1.00 && $gp <= 1.50){
                                    echo 'Pass';
                                  }else{
                                    echo 'Failed';
                                  }
                                @endphp
                              </td>
                              
                              
                              
                              
                              </tr>
                              
                              @endif
                            
                            
                                  
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
                      <div class="row display-1" style="font-size:16px;padding-top:20px; font-weight:bold;">
                        <div class="col-md-4 text-center">
                          <br>
                          _______________________________________
                          <br>Dr. E.O. Adeniji<br>
                          COORDINATOR LASU, FCE, ABEOKUTA
                        </div>
                        <div class="col-md-4 text-center">
                          <br>
                          ______________________________
                          <br>Prof. J.O. Adeogun
                          <br>
                          DIRECTOR, SANDWICH DEGREE PROGRAMME
                                   
                        </div>
                        <div class="col-md-4 text-center">
                          <br>
                          ______________________________
                          <br>Prof. S.O. Makinde
                          <br>
                          DEAN, FACULTY OF EDUCATION
                                   
                        </div>
                      </div>
                      
                      

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