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
      border-bottom:1px solid gray;
      font-size: 13px;
    }
    tr {page-break-inside: avoid;}
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
    <h3 class="box-title">Exam Mark Sheet III</h3>
  </div>
    <div class="box-body">
            <div class="row noprint">
                    <div class="col-sm-4">
                      <form action="{{url('ems3/search')}}" method="post">
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
                                        <label for="">Course</label>
                                        <select class="form-control" name="course" id="course">
                                          <option value="0" disable="true" selected="true">--- Select Course ---</option>
                                          @foreach ($subject as $key => $value)
                                              <option value="{{$value->SubjectID}}">{{ $value->SubjectCode }}</option>
                                            @endforeach
                                        </select>
                                      </div>
                              <div class="col-md-6">
                                <button class="btn btn-primary" type="submit">Get EMS</button>
                            </div>
                      </form>
                    </div>
                  </div>
                          
        
                  {{-- Header --}}
                   @if(isset($results))

                 
                 
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
                             <th colspan="17">
                                 <table width="100%" border="0">
                                     <tr>
                                       <th scope="col" rowspan="5"><img src="../images/logo.png" width="114" height="99" /></th>
                                       <td align="center" scope="col"><h3><strong>FEDERAL COLLEGE OF EDUCATION ABEOKUTA</strong></h3></td>
                                       <th scope="col">&nbsp;</th>
                                     </tr>
                                     <tr>
                                       <td align="center"><h5>NCE DETAILED RESULT</h4></td>
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
                             </th>
                           </tr>
                           <tr>
                             <th scope="col">S/N</th>
                             <th scope="col">Matric</th>
                             <th scope="col">SubComb</th>
                             <th scope="col" colspan="4" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;CA SCORE&nbsp;&nbsp;&nbsp;&nbsp;</th>
                             <th scope="col">TOTAL C.A. (40%)</th>
                             <th scope="col" colspan="6" nowrap>EXAMINATION SCORE</th>
                             <th scope="col">TOTAL EXAM(60%)</th>
                             <th scope="col">TOTAL CA & EXAM(100%)</th>
                             <th scope="col">H.O.D EXTERNAL MODERATOR'S REMARK</th>
                         
                           </tr>
                         
                           <tr>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>1</td>
                             <td>2</td>
                             <td>3</td>
                             <td>4</td>
                             <td></td>
                             <td>1</td>
                             <td>2</td>
                             <td>3</td>
                             <td>4</td>
                             <td>5</td>
                             <td>6</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                           </tr>
                         </thead>
                         <tbody>
                           @foreach($results as $result)
                           <tr>
                             <td>&nbsp;</td>
                             <td>{{$result->MatricNo}}</td>
                             <td>{{$result->SubjectCombinName}}</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                           </tr>
                           @endforeach
                         </tbody>
                         <tfoot>
                             <tr>
                               <td colspan="17">
                                 <div class="col-12"></div>
                             <table align="center" style="padding-top:30px;">
                               <tr>
                               <td>NAME OF EXAMINER__________________________________    SIGNATURE_________________________    DATE_________________________<br />
                                 <br /></td>
                             </tr>
                             <tr>
                               <td> NAME OF HEAD OF DEPARTMENT______________________________     SIGNATURE_________________________     DATE____________________________<br />
                                 <br /></td>
                             </tr>
                             <tr>
                               <td>MODERATOR'S NAME________________________________________    SIGNATURE_________________________     DATE_______________________<br /></td>
                             </tr>
                           </table>
                               </td>
                             </tr>
                           </tfoot>
                         </table>
                         <table style="border: thin solid #000000; width: 100%;margin-left: 1%; margin-top: 30px;font-size:small; height: 146px;" cellspacing="0">
                            <tr style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style146"><span class="auto-style112">S/N</th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-color: #000000;" class="auto-style147">Matric No</th>
                                 <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style148">SubjectComb</span></th>
                                
                                <th colspan="4" style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style153"><span class="auto-style112">CA</th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style149"><span class="auto-style13">TOTAL C.A.</span><br class="auto-style13" />
                                    <span class="auto-style13">(40%)</span></th>
                                <th colspan="6" style="border: thin solid #000000" class="auto-style153">EXAMINATION SCORE</th>
                                <th style="border: thin solid #000000" class="auto-style150"><span class="auto-style13">TOTAL 
                                </span>
                                    <br class="auto-style13" />
                                    <span class="auto-style13">EXAM(60%)</span></th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style151"><span class="auto-style13">TOTAL</span><br class="auto-style13" />
                                    <span class="auto-style13">&nbsp;CA & 
                                    </span>
                                    <br class="auto-style13" />
                                    <span class="auto-style13">EXAM(100%)</span></th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style152"><span class="auto-style13">H.O.D</span><br class="auto-style13" />
                                    <span class="auto-style13">&nbsp;EXTERNAL</span><br class="auto-style13" />
                                    <span class="auto-style13">&nbsp;MODERATOR'S 
                                    </span>
                                    <br class="auto-style13" />
                                    </span>
                                    <span class="auto-style13"><span class="auto-style112">REMARK</span></span></th>
                            </tr>
                
                            <tr style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-color: #000000;" class="auto-style113"></th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-color: #000000;" class="auto-style114">
                                    <h1 style="text-align: left"></h1>
                                </th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style136"></th>
                                
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style144"><span class="auto-style112">1</th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style142">2</th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style131">3</th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style131">4</th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style119"></th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style142">1</th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style142">2</th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style131">3</th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style142">4</th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style142">5</th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style142">6</span></th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style123"></th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style143"></th>
                                <th style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" class="auto-style138"></th>
                            </tr>
                            
                            </tr>                      
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