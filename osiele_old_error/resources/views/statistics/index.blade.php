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
  <style type="text/css" media="print,screen" >
    table td {
      
      font-size: 13px;
    }
    th {
    font-family:Arial;
    color:black;
    background-color:lightgrey;
    font-size: 13px;
    }
    thead {
      display:table-header-group;
    }
    tbody {
      display:table-row-group;
    }
    </style>
  
<div class="box">
  <div class="box-header with-border noprint">
    <h3 class="box-title">Exam Mark Sheet I</h3>
  </div>
    <div class="box-body">
            <div class="row noprint">
                    <div class="col-sm-4">
                      <form action="{{url('statistics/search')}}" method="post">
                        {{csrf_field()}}
                              
                        
                          

                                  <div class="form-group">
                                        <label for="">Faculties</label>
                                        <select class="form-control" name="faculties" id="faculties">
                                          <option value="0" disable="true" selected="true">--- Select Faculty ---</option>
                                            @foreach ($faculties as $key => $value)
                                              <option value="{{$value->FacultyName}}">{{ $value->FacultyName }}</option>
                                            @endforeach
                                        </select>
                                      </div>
                            
                                      
                                      <table width="100%" border="0">
                                            <tr>
                                              <td><input name="gender" type="checkbox" id="gender" value="gender">
                                              <label for="gender">Gender</label></td>
                                              <td><input name="email" type="checkbox" id="email" value="email">
                                              <label for="email">Email</label></td>
                                            </tr>
                                            <tr>
                                              <td><input name="state" type="checkbox" id="state" value="sor">
                                              <label for="state">State</label></td>
                                              <td><input name="phone" type="checkbox" id="phone" value="phonenumber">
                                              <label for="phone">Phone Number</label></td>
                                            </tr>
                                            <tr>
                                              <td><input name="lg" type="checkbox" id="lg" value="lga">
                                              <label for="lg">Local Government</label></td>
                                              <td><input name="age" type="checkbox" id="age" value="dateofbirth">
                                              <label for="age">Age</label></td>
                                            </tr>
                                            
                                          </table>
                              <div class="col-md-6">
                                <button class="btn btn-primary" type="submit">Get EMS</button>
                            </div>
                      </form>
                    </div>
                  </div>
                          
        
                  {{-- Header --}}
                   @if(isset($results))
                   {{--<div class="noprint">
                     <br><br>
                    <hr>
                   
                   </div>
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
                            <td width="69" scope="col"><strong>SCHOOL:</strong></td>
                            <td width="199" nowrap="nowrap" scope="col"><span id="school"></span></td>
                            <td width="16" scope="col">&nbsp;</td>
                            <td width="92" scope="col"><strong>PROGRAME:</strong></td>
                            <td width="135" scope="col"></td>
                            <td width="45" scope="col">&nbsp;</td>
                            <td width="51" scope="col"><strong>LEVEL:</strong></td>
                            <td width="42" scope="col"></td>
                            <td width="86" scope="col"><strong>SEMESTER:</strong></td>
                            <td width="39" scope="col"> </td>
                            <td width="67" scope="col"><strong>SESSION:</strong></td>
                            <td width="93" scope="col"></td>
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
                     Header end --}}

                 
                 
                      <div style="font-size:10px">Date printed: {{date_format(now(),"d/m/Y H:i:s")}}</div>
                      
                    
                  @if(count($results) > 0)
                  {{-- Modified --}}
                  <?php
                   $addup = collect($results);
                  //$keyed = $addup->groupby('matricno')->keyby('subjectcodeco');
                   $grouped = $addup->sortBy('matricno');
                   $departments = collect($dept);
                   //$grouped = collect($grouped)->sortBy('matricno');
                   //$flatten = $grouped->flatten();
                   //print_r($grouped);
                   //dump($grouped);
                   //dump($keyed);
                  ?>
                  <div class="table-responsive">
                      <table width="100%" border="1">
                          <thead>
                           <tr>
                             <th colspan="4">
                                 <table width="100%" border="0">
                                     <tr>
                                       <th scope="col" rowspan="5"><img src="../images/logo.png" width="114" height="99" /></th>
                                       <td align="center" scope="col"><h3><strong>FEDERAL COLLEGE OF EDUCATION ABEOKUTA</strong></h3></td>
                                       <th scope="col">&nbsp;</th>
                                     </tr>
                                     <tr>
                                       <td align="center"><h4></h4></td>
                                       <th>&nbsp;</th>
                                       <td>&nbsp;</td>
                                     </tr>
                                     <tr>
                                       <th>&nbsp;</th>
                                       <th>&nbsp;</th>
                                       <td>&nbsp;</td>
                                     </tr>
                                     <tr>
                                       <td></td>
                                       <th>&nbsp;</th>
                                       <td>&nbsp;</td>
                                     </tr>
                                     <tr>
                                       <td align="center">&nbsp;</td>
                                       <td align="center">&nbsp;</td>
                                       <td>&nbsp;</td>
                                     </tr>
                                   </table>
                             </th>
                           </tr>
                           <tr>
                            <th scope="col">STATE</th>
                            <th scope="col">LOCAL GOVT.</th>
                            <th scope="col">MALE</th>
                            <th scope="col">FEMALE</th>
                            <th scope="col">TOTAL STUDENTS</th>
                            
                          </tr>
                         </thead>
                         <tbody class="table table-striped table-bordered table-hover">
                           <?php $alltotal= 0; $totalfemale= 0; $totalmale = 0;?>
                           @foreach($results as $result)
                           <?php 
                           
                           $alltotal += $result->total;
                           $totalfemale += $result->female;
                           $totalmale += $result->male; ?>
                           <tr>
                             <td>{{strtoupper($result->state)}}</td>
                             <td>{{strtoupper($result->LG)}}</td>
                             <td>{{$result->male}}</td>
                             <td>{{$result->female}}</td>
                             <td>{{$result->total}}</td>
                             
                             
                           </tr>
                           @endforeach
                           <tr>
                            <td align="right">TOTAL</td>
                            <td>{{$totalmale}}</td>
                            <td>{{$totalfemale}}</td>
                            <td>{{$alltotal}}</td>
                          </tr>
                         </tbody>
                        
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