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
  td, th {
    padding: 6px;
}
  </style>
<div class="box">
  <div class="box-header with-border noprint">
    <h3 class="box-title">Result Manager</h3>
  </div>
    <div class="box-body">
            <div class="row noprint">
                    <div class="col-sm-4">
                      <form action="{{url('akokasummary/search')}}" method="post">
                        {{csrf_field()}}
                              

                                  <div class="form-group">
                                        <label for="">School</label>
                                        <select class="form-control" name="faculties" id="faculties" required="required">
                                          <option value="" disable="true" selected="true">--- Select School ---</option>
                                            @foreach ($faculties as $key => $value)
                                              <option value="{{$value->FacultyID}}">{{ $value->FacultyName }}</option>
                                            @endforeach
                                        </select>
                                      </div>
                            
                                      <div class="form-group">
                                        <label for="">Departments</label>
                                        <select class="form-control" name="departments" id="departments" required="required">
                                          <option value="" disable="true" selected="true">--- Select Department ---</option>
                                        </select>
                                      </div>
                          
                                      <div class="form-group">
                                          <label for="">Programmes</label>
                                          <select class="form-control" name="programmes" id="programmes" required="required">
                                            <option value="" disable="true" selected="true">--- Select Programme ---</option>
                                          </select>
                                        </div>

                                  <div class="form-group">
                                        <label for="">Session</label>
                                        <select class="form-control" name="sessions" id="sessions" required="required">
                                          <option value="" disable="true" selected="true">-- Select Session --</option>
                                            @foreach ($sessions as $key => $value)
                                              <option value="{{$value->SessionID}}">{{ $value->SessionYear }}</option>
                                            @endforeach
                                        </select>
                                      </div>
                
                              <div class="form-group">
                                <label for="">Semester</label>
                                <select class="form-control" name="semester" id="semester" required="required">
                                  <option value="" disable="true" selected="true">-- Select Semester --</option>
                                  <option value="1">1st Semester</option> 
                                  <option value="2">2nd Semester</option>
                                </select>
                              </div>
                              <div class="form-group">
                                    <label for="">Level</label>
                                    <select class="form-control" name="level" id="level" required="required">
                                      <option value="" disable="true" selected="true">-- Select Level --</option>
                                      <option value="100">100</option> 
                                      <option value="200">200</option>
                                      <option value="300">300</option>
                                      <option value="400">300+</option>
                                      <option value="500">300++</option>
                                    </select>
                                  </div>

                                  <div class="form-group" id="bedas">
                                    <label for="">BED Accounting/BED Secretariat</label>
                                    <select class="form-control" name="bedasi" id="bedasi">
                                      <option value="" disable="true" selected="true">-- Select Level --</option>
                                      <option value="beda">BED Accounting</option> 
                                      <option value="beds">BED Secretariat</option>
                                      
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
                        <th scope="col" rowspan="5"></th>
                        <td align="center" scope="col"><h4><strong>FEDERAL COLLEGE OF EDUCATION (TECH) EXAM RESULT SHEET <br>
                          {{$theschool->FacultyName}} <br>
                  @if(isset($bedas) && !empty($bedas)) @if($bedas =='beda') BED/ACC @else BED/SEC @endif
                              @else 
                              COURSE: {{$theprogramme->SubjectCombinName}}
                              @endif
                              <br>
                              SEMESTER: {{$semester}} <br>
                              LEVEL: @if($level > 300) 300+ @else {{$level}} @endif <br>



                        </strong></h4></td>
                        <th scope="col">
                          {{-- <table width="100%">
                            <tr>
                            <th nowrap>Date printed:&nbsp;&nbsp; </th>
                            <th>{{date_format(now(),"d/m/Y")}}</th>
                            </tr>
                            <tr>
                              <th style="text-align:right">Time:&nbsp;&nbsp;</th>
                              <th>{{date_format(now(),"H:i:s")}}</th>
                              </tr>
                          </table> --}}
                        </th>
                      </tr>
                      <tr>
                        <td align="center"></td>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                      </tr>
                     
                    </table>
                    {{-- Header end --}}
                    
                  <table border="1" width="100%" class="table-responsive" cellpadding="30">
                    <thead>
                      <tr>
                        <td colspan="5" style="text-align:center;"><strong>DETAILED RESULT</strong> </td>
                      </tr>
                    <tr>
                      <th rowspan="2">S/N</th>
                      <th rowspan="2" nowrap>MATRIC NO</th>
                      <th  style="text-align:center;">CURRENT SEMESTER</th>
                      <th style="text-align:center;">PREVIOUS SEMESTER</th>
                      <th  style="text-align:center;">REMARK</th>
                      {{-- <th colspan="1" style="text-align:center;">REMARKS</th> --}}
                      
                     
                    </tr>
                    
                    </thead>
                          @foreach($results as $index=>$result)
                              
                              
                              <tr style="vertical-align:top">
                              <td style="text-align:center;">{{$index+1}}</td>
                              {{-- <td style="text-transform:uppercase;">{{$result->surname}} {{$result->firstname}} {{$result->middlename}}</td> --}}
                              <td>{{$result->matricno}}</td>
                              
                              
                              <?php
                              //first department
                              $themat = $result->matricno;
                              $collection = collect($results1);
                              $filtered = $collection->where('matricno', $themat);
                              $filtered->all();
              
                              ?>
                              <td align="left">
                                <?php 
                                if($level > 100){
                                if($semester == 2){
                                  $rescollection = collect($resultaddup)->where('subjectvalueco', '!=', 'R')->where('rsemester', $semester-1)->where('rlevel', $level);
                                }else{
                                  $rescollection = collect($resultaddup)->where('subjectvalueco', '!=', 'R')->where('rlevel', $level-100);
                                }
                              } else {
                                if($semester == 1){
                                  $rescollection = collect($resultaddup)->where('subjectvalueco', '!=', 'R')->where('rsemester', $semester)->where('rlevel', $level);
                                }else{
                                  $rescollection = collect($resultaddup)->where('subjectvalueco', '!=', 'R')->where('rlevel', $level);
                                }
                              }
                                
                                
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
                                $set1='';
                                $set2='';
                                // if($semester==1){
                                $set1 = collect($compulsorycourses)->where('subjectlevel', $level)->where('semester', $semester);
                                /* }else{
                                $set1 = collect($compulsorycourses)->where('subjectlevel', $level);
                                } */
                                $set2 = collect($resfiltered); // Contents omitted for brevity
                                $diff = array();
                                $set1->each(function($item, $key) use($set2, &$diff) {
                                    $exists = $set2->where('subjectcodeco', $item->subjectcodeco)->first(); // Where clause omitted for brevity
                                    if(!$exists) {
                                        array_push($diff, $item);
                                    }
                                });

                                //prev outstanding
                                $resfilteredp = $rescollection->where('matricno', $themat)->where('rlevel', $level-100)->sortKeys()->uniqueStrict('subjectcodeco');
                                  $resfilteredp->values()->all();

                                $set1p='';
                                $set2p='';
                                $set1p = collect($compulsorycourses)->where('subjectlevel', $level-100); // Contents omitted for brevity
                                //  $set1 = $set1->reject(function ($value, $key) { return $value->subjectvalueco = 'E'; });
                                // dd($set1p);
                                $set2p = collect($resfilteredp); // Contents omitted for brevity
                                $diffp = array();
                                $set1p->each(function($item, $key) use($set2p, &$diffp) {
                                    $exists = $set2p->where('subjectcodeco', $item->subjectcodeco)->first(); // Where clause omitted for brevity
                                    if(!$exists) {
                                        array_push($diffp, $item);
                                    }
                                });
                                //outstanding ends
                                //for oustanding of previous and current course
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
                                if(count($passed1) > 0) {
                                  //sort resfiltered aka carryover
                                $resfiltered = collect($passed1)->sortby('subjectcodeco');
                                
                                echo ' ';
                                  foreach ($resfiltered as $co){
                                  //$checkco = $co->ca+$co->exam;
                                    if($co->examca <= 39){                                
                                    $theco = $co->subjectcodeco. '('.$co->subjectunitco.''.$co->subjectvalueco.'), '.$co->examca;
                                    echo $theco.' | ';
                                    }
                                    // echo $checkco.' '.$co->subjectcodeco;
                                    
                                  }
                                } else {
                                  if (count($results2) < 1){
                                        if(($level == 300 && $semester == 2) && ($cgpa1 < 1 || $cgpa3 < 1 || $cgpa4 < 1 )){
                                        echo 'FAIL';
                                      } elseif(($level > 300) && ($cgpa1 < 1 || $cgpa3 < 1 || $cgpa4 < 1)) {
                                        echo 'FAIL';
                                      } else {
                                        echo 'PASS';
                                      }

                                  }else {
                                      if(($level == 300 && $semester == 2) && ($cgpa1 < 1 || $cgpa2 < 1 || $cgpa3 < 1 || $cgpa4 < 1 )){
                                      echo 'FAILED';
                                    } elseif(($level > 300) && ($cgpa1 < 1 || $cgpa2 < 1 || $cgpa3 < 1 || $cgpa4 < 1)) {
                                      echo 'FAILED';
                                    } else {
                                      echo 'PASS';
                                    }
                                  }
                                  
                                }
                                
                               

                                
                              
                              /* if((isset($diffp)) && !empty($diffp)){
                              foreach($diffp as $diffs){
                                echo $diffs->subjectcodeco. '('.$diffs->subjectunitco.''.$diffs->subjectvalueco.') ';
                                }
                              } */
                                ?>
                              </td>
                              <td align="left">
                                <?php 
                                
                                $rescollection = collect($resultaddup)->where('subjectvalueco', '!=', 'R')->where('rsemester', $semester)->where('rlevel', $level);
                                
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
                                $set1='';
                                $set2='';
                                // if($semester==1){
                                $set1 = collect($compulsorycourses)->where('subjectlevel', $level)->where('semester', $semester);
                                /* }else{
                                $set1 = collect($compulsorycourses)->where('subjectlevel', $level);
                                } */
                                $set2 = collect($resfiltered); // Contents omitted for brevity
                                $diff = array();
                                $set1->each(function($item, $key) use($set2, &$diff) {
                                    $exists = $set2->where('subjectcodeco', $item->subjectcodeco)->first(); // Where clause omitted for brevity
                                    if(!$exists) {
                                        array_push($diff, $item);
                                    }
                                });

                                //prev outstanding
                                $resfilteredp = $rescollection->where('matricno', $themat)->where('rlevel', $level-100)->sortKeys()->uniqueStrict('subjectcodeco');
                                  $resfilteredp->values()->all();

                                $set1p='';
                                $set2p='';
                                $set1p = collect($compulsorycourses)->where('subjectlevel', $level-100); // Contents omitted for brevity
                                //  $set1 = $set1->reject(function ($value, $key) { return $value->subjectvalueco = 'E'; });
                                // dd($set1p);
                                $set2p = collect($resfilteredp); // Contents omitted for brevity
                                $diffp = array();
                                $set1p->each(function($item, $key) use($set2p, &$diffp) {
                                    $exists = $set2p->where('subjectcodeco', $item->subjectcodeco)->first(); // Where clause omitted for brevity
                                    if(!$exists) {
                                        array_push($diffp, $item);
                                    }
                                });
                                //outstanding ends
                                //for oustanding of previous and current course
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
                                if(count($passed1) > 0) {
                                  //sort resfiltered aka carryover
                                $resfiltered = collect($passed1)->sortby('subjectcodeco');
                                
                                echo ' ';
                                  foreach ($resfiltered as $co){
                                  //$checkco = $co->ca+$co->exam;
                                    if($co->examca <= 39){                                
                                    $theco = $co->subjectcodeco. '('.$co->subjectunitco.''.$co->subjectvalueco.'), '.$co->examca;
                                    echo $theco.' | ';
                                    }
                                    // echo $checkco.' '.$co->subjectcodeco;
                                    
                                  }
                                } else {
                                  if (count($results2) < 1){
                                        if(($level == 300 && $semester == 2) && ($cgpa1 < 1 || $cgpa3 < 1 || $cgpa4 < 1 )){
                                        echo 'FAIL';
                                      } elseif(($level > 300) && ($cgpa1 < 1 || $cgpa3 < 1 || $cgpa4 < 1)) {
                                        echo 'FAIL';
                                      } else {
                                        echo 'PASS';
                                      }

                                  }else {
                                      if(($level == 300 && $semester == 2) && ($cgpa1 < 1 || $cgpa2 < 1 || $cgpa3 < 1 || $cgpa4 < 1 )){
                                      echo 'FAIL';
                                    } elseif(($level > 300) && ($cgpa1 < 1 || $cgpa2 < 1 || $cgpa3 < 1 || $cgpa4 < 1)) {
                                      echo 'FAIL';
                                    } else {
                                      echo 'PASS';
                                    }
                                  }
                                  
                                }
                                
                               

                                
                              
                              /* if((isset($diffp)) && !empty($diffp)){
                              foreach($diffp as $diffs){
                                echo $diffs->subjectcodeco. '('.$diffs->subjectunitco.''.$diffs->subjectvalueco.') ';
                                }
                              } */
                                ?>
                              </td>
                              <td align="left" nowrap>
                                <?php 
                                
                                $rescollection = collect($resultaddup)->where('subjectvalueco', '!=', 'R');
                                
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
                                $set1='';
                                $set2='';
                                if($semester==1){
                                $set1 = collect($compulsorycourses)->where('subjectlevel', $level)->where('semester', $semester);
                                }else{
                                $set1 = collect($compulsorycourses)->where('subjectlevel', $level);
                                }
                                $set2 = collect($resfiltered); // Contents omitted for brevity
                                $diff = array();
                                $set1->each(function($item, $key) use($set2, &$diff) {
                                    $exists = $set2->where('subjectcodeco', $item->subjectcodeco)->first(); // Where clause omitted for brevity
                                    if(!$exists) {
                                        array_push($diff, $item);
                                    }
                                });

                                //prev outstanding
                                $resfilteredp = $rescollection->where('matricno', $themat)->where('rlevel', $level-100)->sortKeys()->uniqueStrict('subjectcodeco');
                                  $resfilteredp->values()->all();

                                $set1p='';
                                $set2p='';
                                $set1p = collect($compulsorycourses)->where('subjectlevel', $level-100); // Contents omitted for brevity
                                //  $set1 = $set1->reject(function ($value, $key) { return $value->subjectvalueco = 'E'; });
                                // dd($set1p);
                                $set2p = collect($resfilteredp); // Contents omitted for brevity
                                $diffp = array();
                                $set1p->each(function($item, $key) use($set2p, &$diffp) {
                                    $exists = $set2p->where('subjectcodeco', $item->subjectcodeco)->first(); // Where clause omitted for brevity
                                    if(!$exists) {
                                        array_push($diffp, $item);
                                    }
                                });
                                //outstanding ends
                                //for oustanding of previous and current course
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
                                if(count($passed1) > 0 || ((isset($diff)) && !empty($diff)) || ((isset($diffp)) && !empty($diffp) && !empty($ost))) {
                                  //sort resfiltered aka carryover
                                $resfiltered = collect($passed1)->sortby('subjectcodeco');
                                
                                // echo 'F. ';
                                $i =0;
                                  foreach ($resfiltered as $co){
                                  //$checkco = $co->ca+$co->exam;
                                    if($co->examca <= 39){   
                                      $i = $i + 1;                             
                                    $theco = $co->subjectcodeco. '('.$co->subjectunitco.''.$co->subjectvalueco.'), '.$co->examca;
                                    // echo $theco.' | ';
                                    }
                                    // echo $checkco.' '.$co->subjectcodeco;
                                    
                                  }
                                  echo $i .' COURSES OUTSTANDING';
                                } else {
                                  if (count($results2) < 1){
                                        if(($level == 300 && $semester == 2) && ($cgpa1 < 1 || $cgpa3 < 1 || $cgpa4 < 1 )){
                                        echo 'FAIL';
                                      } elseif(($level > 300) && ($cgpa1 < 1 || $cgpa3 < 1 || $cgpa4 < 1)) {
                                        echo 'FAILED';
                                      } else {
                                        echo 'PASS';
                                      }

                                  }else {
                                      if(($level == 300 && $semester == 2) && ($cgpa1 < 1 || $cgpa2 < 1 || $cgpa3 < 1 || $cgpa4 < 1 )){
                                      echo 'FAILED';
                                    } elseif(($level > 300) && ($cgpa1 < 1 || $cgpa2 < 1 || $cgpa3 < 1 || $cgpa4 < 1)) {
                                      echo 'FAILED';
                                    } else {
                                      echo 'PASS';
                                    }
                                  }
                                  
                                  
                                }
                                
                               

                                //echo $diff['subjectcodeco'][0];
                              //   if((isset($diff)) && !empty($diff) || ((isset($diffp)) && !empty($diffp) && !empty($ost))) {
                              //   echo '<span class="os"><b>O/S:</b></span>';
                              //   foreach($diff as $diffs){
                              //   echo $diffs->subjectcodeco. '('.$diffs->subjectunitco.''.$diffs->subjectvalueco.') ';
                              //   }
                               

                              //   foreach($ost as $diffs){
                              //   echo $diffs->subjectcodeco. '('.$diffs->subjectunitco.''.$diffs->subjectvalueco.') ';
                              //   }
                              // }
                              
                              /* if((isset($diffp)) && !empty($diffp)){
                              foreach($diffp as $diffs){
                                echo $diffs->subjectcodeco. '('.$diffs->subjectunitco.''.$diffs->subjectvalueco.') ';
                                }
                              } */
                                ?>
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
                      <table width="100%">
                        <tr>
                          <td>
                            ___________________________ <br>
                            DEAN {{$theschool->FacultyName}}
                          </td>
                          <td align="right">
                            <span >___________________________ <br>
                            HOD {{$theprogramme->SubjectCombinName}}</span>
                            
                          </td>
                        </tr>
                      </table>
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
            $('#departments').append('<option value="" disable="true" selected="true">--- Select Department ---</option>');

            $('#programmes').empty();
            $('#programmes').append('<option value="" disable="true" selected="true">--- Select Programme ---</option>');

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