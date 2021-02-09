@extends('adminlte::page')





@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Result Manager</h3>
  </div>
    <div class="box-body">
            <div class="row">
                    <div class="col-sm-4">
                      <form action="{{url('mms1/search')}}" method="post">
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
                  <table border="1" width="100%">
                    <tr>
                      <th rowspan="2">S/N</th>
                      <th rowspan="2">MATRIC NO</th>
                      
                      <th colspan="4" align="center">{{$deptcode1}}</th>
                      <th colspan="4" align="center">{{$deptcode2}}</th>
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
                              ?>
                              <td align="center"><?php 
                                foreach($resfiltered as $resfilt){
                                 $calculate=$resfilt->ca+$resfilt->exam;
                                
                                if ($calculate >= 70)  {$calculates = 5*$resfilt->tnu;}
                                elseif ($calculate >= 60 && $calculate <= 69)  {$calculates = 4*$resfilt->tnu;}
                                elseif ($calculate >= 50 && $calculate <= 59)  {$calculates = 3*$resfilt->tnu;}
                                elseif ($calculate >= 45 && $calculate <= 49)  {$calculates = 2*$resfilt->tnu;}
                                elseif ($calculate >= 40 && $calculate <= 44)  {$calculates = 1*$resfilt->tnu;}
                                elseif ($calculate <= 39)  {$calculates = 0*$resfilt->tnu;}
                                //endif
                                $allcalc +=$calculates;
                                $tcp1 = $allcalc;
                                $tnu1 = $results1->first()->sum2;
                                $tnup1 = $results1->first()->sum;
                                $cgpa1 = number_format($allcalc/$results1->first()->sum, 2);
                                }
                                ?>
                                
                                {{$allcalc}} 
                              </td>
                              <td align="center">{{$results1->first()->sum2}}</td>
                              <td align="center">{{$results1->first()->sum}}</td>
                              <td align="center">{{number_format($allcalc/$results1->first()->sum, 2) }}</td>
              
              
                              <?php
                              //second department
                              $themat = $result->matricno;
                              $collection = collect($results2);
                              $filtered = $collection->where('matricno', $themat);
                              $filtered->all();
              
                              $rescollection = collect($resultaddup);
                              $resfiltered = $rescollection->where('matricno', $themat)->where('departmentid', $deptid2);
                              $resfiltered->all();
                              $allcalc= 0;
                              ?>
                              <td align="center"><?php 
                                foreach($resfiltered as $resfilt){
                                 $calculate=$resfilt->ca+$resfilt->exam;
                                
                                if ($calculate >= 70)  {$calculates = 5*$resfilt->tnu;}
                                elseif ($calculate >= 60 && $calculate <= 69)  {$calculates = 4*$resfilt->tnu;}
                                elseif ($calculate >= 50 && $calculate <= 59)  {$calculates = 3*$resfilt->tnu;}
                                elseif ($calculate >= 45 && $calculate <= 49)  {$calculates = 2*$resfilt->tnu;}
                                elseif ($calculate >= 40 && $calculate <= 44)  {$calculates = 1*$resfilt->tnu;}
                                elseif ($calculate <= 39)  {$calculates = 0*$resfilt->tnu;}
                                //endif
                                $allcalc +=$calculates;
                                $tcp2 = $allcalc;
                                $tnu2 = $results2->first()->sum2;
                                $tnup2 = $results2->first()->sum;
                                $cgpa2 = number_format($allcalc/$results2->first()->sum, 2);
                                }
                                ?>
                                
                                {{$allcalc}}
                              </td>
                              <td align="center">@foreach ($results2 as $resu) {{$resu->sum2}} @endforeach</td>
                              <td align="center">@foreach ($results2 as $resu) {{$resu->sum}} @endforeach</td>
                              <td align="center"></td>
                              
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
                              ?>
                              <td align="center"><?php 
                                foreach($resfiltered as $resfilt){
                                 $calculate=$resfilt->ca+$resfilt->exam;
                                
                                if ($calculate >= 70)  {$calculates = 5*$resfilt->tnu;}
                                elseif ($calculate >= 60 && $calculate <= 69)  {$calculates = 4*$resfilt->tnu;}
                                elseif ($calculate >= 50 && $calculate <= 59)  {$calculates = 3*$resfilt->tnu;}
                                elseif ($calculate >= 45 && $calculate <= 49)  {$calculates = 2*$resfilt->tnu;}
                                elseif ($calculate >= 40 && $calculate <= 44)  {$calculates = 1*$resfilt->tnu;}
                                elseif ($calculate <= 39)  {$calculates = 0*$resfilt->tnu;}
                                //endif
                                $allcalc +=$calculates;
                                $tcp3 = $allcalc;
                                $tnu3 = $results3->first()->sum2;
                                $tnup3 = $results3->first()->sum;
                                $cgpa3 = number_format($allcalc/$results3->first()->sum, 2);
                                }
                                ?>
                                
                                {{$allcalc}}
                              </td>
                              <td align="center">{{$filtered->first()->sum2}}</td>
                              <td align="center">{{$filtered->first()->sum}}</td>
                              <td align="center">{{number_format($allcalc/$results3->first()->sum, 2) }}</td>
              
              
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
                              ?>
                              <td align="center"><?php 
                                foreach($resfiltered as $resfilt){
                                 $calculate=$resfilt->ca+$resfilt->exam;
                                
                                if ($calculate >= 70)  {$calculates = 5*$resfilt->tnu;}
                                elseif ($calculate >= 60 && $calculate <= 69)  {$calculates = 4*$resfilt->tnu;}
                                elseif ($calculate >= 50 && $calculate <= 59)  {$calculates = 3*$resfilt->tnu;}
                                elseif ($calculate >= 45 && $calculate <= 49)  {$calculates = 2*$resfilt->tnu;}
                                elseif ($calculate >= 40 && $calculate <= 44)  {$calculates = 1*$resfilt->tnu;}
                                elseif ($calculate <= 39)  {$calculates = 0*$resfilt->tnu;}
                                //endif
                                $allcalc +=$calculates;
                                $tcp4 = $allcalc;
                                $tnu4 = $results4->first()->sum2;
                                $tnup4 = $results4->first()->sum;
                                $cgpa4 = number_format($allcalc/$results4->first()->sum, 2);
                                }
                                ?>
                                
                                {{$allcalc}}
                              </td>
                              <td align="center">{{$results4->first()->sum2}}</td>
                              <td align="center">{{$results4->first()->sum}}</td>
                              <td align="center">{{number_format($allcalc/$results4->first()->sum, 2) }}</td>
                              <td align="center">{{$tcp1+$tcp3+$tcp4}}</td>
                              <td align="center">{{$tnu1+$tnu3+$tnu4}}</td>
                              <td align="center">{{$tnup1+$tnup3+$tnup4}}</td>
                              <?php 
                              $alltcp = $tcp1+$tcp3+$tcp4;
                              $alltnu = $tnu1+$tnu3+$tnu4;
                              $totalcgpa = number_format($alltcp/$alltnu, 2);
                              ?>

                              <td align="center">{{$totalcgpa}}</td>
                              <td align="center">&nbsp;</td>
                              
                              
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