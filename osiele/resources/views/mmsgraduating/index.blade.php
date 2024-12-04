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
    <h3 class="box-title">Graduating List</h3>
  </div>
    <div class="box-body">
            <div class="row noprint">
                    <div class="col-sm-4">
                      <form action="{{url('mmsgraduating/search')}}" method="post">
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
                            
                                      {{-- <div class="form-group">
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
                                        </div> --}}

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
                                <select class="form-control" name="semesterd" id="semesterd" required="required" disabled="disabled">
                                    <option value="" disable="true" selected="true">-- Select Semester --</option>
                                    <option value="2" selected="true">2nd Semester</option>
                                    </select>
                                    <input type="hidden" name="semester" value="2">
                              </div>
                              <div class="form-group">
                                    <label for="">Level</label>
                                    <select class="form-control" name="level" id="level" required="required">
                                      <option value="" disable="true" selected="true">-- Select Level --</option>
                                      
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
                        <th scope="col" rowspan="5"><img src="../images/logo.png" width="114" height="99" /></th>
                        <td align="center" scope="col"><h3><strong>FEDERAL COLLEGE OF EDUCATION ABEOKUTA</strong></h3></td>
                        <th scope="col">
                          <table width="100%">
                            <tr>
                            <th nowrap>Date printed:</th>
                            <th>{{date_format(now(),"d/m/Y")}}</th>
                            </tr>
                            <tr>
                              <th style="text-align:right">Time:</th>
                              <th>{{date_format(now(),"H:i:s")}}</th>
                              </tr>
                          </table>
                        </th>
                      </tr>
                      <tr>
                        <td align="center"><h4>ACADEMIC SESSION {{$thisession->SessionYear}} GRAD LIST</h4></td>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                          <td align="center">SCH: {{$theschool->FacultyName}}</td>
                          <th>&nbsp;</th>
                          <td>&nbsp;</td>
                        </tr>
                      <tr>
                        <th>&nbsp;</th>
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

                    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
                    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
                    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
                    
                     
                     <script type="text/javascript">
                        $(document).ready(function() {
                        $('#graduate').DataTable(
                            {
                                "lengthMenu": [[-1, 10, 25, 50, 100], ["All", 10, 25, 50, 100]]
                            }
                        );
                    } );
                    </script>
                    
                  <table border="1" width="100%" id="graduate" class="display table-responsive" style="text-transform:uppercase;">
                    <thead>
                    <tr>
                      <th>S/N</th>
                      <th>MATRIC NO.</th>
                      <th>LAST NAME</th>
                      <th>FIRST NAME</th>
                      <th>MIDDLE NAME</th>
                      <th>GENDER</th>
                      <th>STATE</th>
                      <th>SCHOOL</th>
                      <th>MAJOR</th>
                      <th style="text-align:center;">CGPA</th>
                      <th>GRADE</th>
                      
                     
                    </tr>
                    
                    </thead>
                    {{-- <tr><td>@dd($results)</td></tr> --}}
                    <?php //$allmatric= array();?>
                    {{-- @foreach($results as $index=>$result) --}}
                    <?php 

                                
                                // $rescollection = collect($resultaddup)->where('subjectvalueco', '!=', 'R');
                                //   $resfiltered = $rescollection->where('matricno', $result->matricno)->sortKeys()->uniqueStrict('subjectcodeco');
                                //   $resfiltered->values()->all();
                                // $passed = collect($resfiltered);
                                // $passed1 = $passed->reject(function ($value, $key) { return $value->examca > 39; });
                                // $passed1->all(); 
                                // $set1='';
                                // $set2='';
                                // $set1 = collect($compulsorycourses); // Contents omitted for brevity
                                // $set2 = collect($resfiltered); // Contents omitted for brevity
                                // $diff = array();
                                // $set1->each(function($item, $key) use($set2, &$diff) {
                                //     $exists = $set2->where('subjectcodeco', $item->subjectcodeco)->first(); // Where clause omitted for brevity
                                //     if(!$exists) {
                                //         array_push($diff, $item);
                                //     }
                                // });
                                
                                // if(count($passed1) > 0 || ((isset($diff)) && !empty($diff))) {
                                // $resfiltered = collect($passed1)->sortby('subjectcodeco');
                                // $allmatric[] = $result->matricno;
                                // } 
                                // ?>
                                {{-- // @endforeach --}}
                                 <?php 
                                // // $allmatrics = array();
                                // // $allmatrics = rtrim($allmatric, ', ');
                                // // $allmatric = explode(',', $allmatrics); 
                                // $results = collect($results)->whereNotIn('matricno', $allmatric);
                                // $results->all();
                                ?>
                                
                               {{-- @dd($results) --}}

                          @foreach($results as $index=>$result)
                              
                              
                              <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$result->matricno}}</td>
                              <td style="text-transform:uppercase;">{{$result->surname}}</td>
                              <td style="text-transform:uppercase;">{{$result->firstname}}</td>
                              <td style="text-transform:uppercase;">{{$result->middlename}}</td>
                              <td>{{$result->gender}}</td>
                              <td>{{$result->state}}</td>
                              <td>{{$result->school}}</td>
                              
                              <?php
                              //first department
                              $themat = $result->matricno;
                              $collection = collect($results1);
                              $filtered = $collection->where('matricno', $themat);
                              $filtered->all();
              
                              $rescollection = collect($resultaddup);
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
                                // $tnu1 = $results1->first()->sum2;
                                // $tnup1 = $results1->first()->sum;
                                
                                
                                $cgpa1 = 0.00;
                                $tnuaddup1 = collect($results1)->where('matricno', $themat)->sum('sum2');
                              if($allcalc > 0 && $alltnups1 > 0){
                                $cgpa1 = number_format($allcalc/$tnuaddup1, 2);
                              } else {
                                $cgpa1 = 0.00;
                              }
                                // $cgpa1 = number_format($allcalc/$alltnups1, 2);
                                

                                ?>
                                
                               
                               {{number_format($cgpa1, 2)}}
                              </td>
                              <td>
                                @if($cgpa1 >= 4.5)
                        distinction 
                        @elseif($cgpa1 >= 3.5 && $cgpa1 <= 4.49)
                        credit 
                        @elseif($cgpa1 >= 2.4 && $cgpa1 <= 3.49)
                        merit 
                        @elseif($cgpa1 >= 1.5 && $cgpa1 <= 2.39)
                        pass 
                        @elseif($cgpa1 >= 1.0 && $cgpa1 <= 1.49)
                        low pass 
                        @elseif($cgpa1 < 1.0)
                        FAILED 
                        @endif
                              </td>
                              
                           
                              
                              </tr>
                          @endforeach    
                          </table>

                          {{-- <input type="button" id="btnHide" Value=" Show Summary Passed " />
<input type="button" id="btnReset" Value=" Reset " /> --}}
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
    {{-- <script src="{{asset('jscss/jquery.min.js')}}"></script> --}}

   
  
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
{{-- Summary passed --}}
<script type="text/javascript">
    $("#passedRows td").each(function() {
        var cellText = $(this).text();
        if ($.trim(cellText) == '') {
            $(this).css('background-color', 'cyan');
        }
    });

    $('#btnHide').click(function() {
        $("#passedRows tr td").each(function() {
            var cell = $.trim($(this).text());
            if (cell.length == 0) {
                $(this).parent().hide();
            }
        });
    });
    $('#btnReset').click(function() {
        $("#passedRows tr").each(function() {
            $(this).show();
        });
    });

</script>
      
@endsection