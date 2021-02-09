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
  @page {
   margin-left: 1mm;
   margin-right: 1mm;
   margin-bottom: 20mm;
   margin-top: 15mm;
  }
  .table-responsive { overflow-x: visible !important; }
  </style>
  <style type="text/css" media="print,screen" >
    table td {
      font-size: 13px;
    }
    th {
    font-family:Arial;
    color:black;
    font-size: 13px;
    }
    thead {
      display:table-header-group;
    }
    tbody {
      display:table-row-group;
    }
    table {
page-break-inside: auto !important;
}

thead {
display: table-header-group !important;
}



.table-responsive {
overflow: visible !important;
}
    </style>
  
<div class="box">
  <div class="box-header with-border noprint">
    <h3 class="box-title">Exam Mark Sheet I</h3>
  </div>
    <div class="box-body">
            <div class="row noprint">
                    <div class="col-sm-4">
                      <form action="{{url('ems4/search')}}" method="post">
                        {{csrf_field()}}
                              

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
                  //  $departments = collect($dept);
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
                                       <th scope="col" rowspan="5"><img src="../images/logo.png" /></th>
                                       <td align="center" scope="col"><h3><strong>FEDERAL COLLEGE OF EDUCATION ABEOKUTA</strong></h3></td>
                                       <th scope="col">&nbsp;</th>
                                     </tr>
                                     <tr>
                                       <td align="center"><h5><STRong><u> NCE EXAM MARK SHEET</u></STRong></h5></td>
                                       <th>&nbsp;</th>
                                       <td>&nbsp;</td>
                                     </tr>
                                     <tr>
                                       <th>&nbsp;</th>
                                       <th>&nbsp;</th>
                                       <td>&nbsp;</td>
                                     </tr>
                                     <tr>
                                       <td align='center' style="font-size: 11px;"><table width="100%" border="0" cellpadding="1" cellspacing="1">
                                        <tr>
                                          <td style="font-size: 11px;">
                                          {{-- <strong>SCHOOL:</strong>&nbsp;{{$theschool}}&emsp; --}}
                                          <strong>SEMESTER:</strong>
                                          &nbsp;@if($results[0]->Semester == 1) 1ST @else 2ND @endif <strong> &emsp; SESSION:</strong>{{$thesession}}<br>
                                          <strong>COURSE TITLE:</strong>&nbsp;{{$subjectlevel->SubjectName}} &emsp;<strong>COURSE CODE:</strong>&nbsp;{{$subjectlevel->SubjectCode}} &emsp;<strong>UNIT:</strong>&nbsp;{{$subjectlevel->SubjectValue}} &emsp;
                                          <strong>STATUS:</strong>&nbsp;{{$subjectlevel->SubjectUnit}} 
                                          </td>
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
                             <th width="6%" scope="col">S/N</th>
                             <th width="10%" scope="col">Matric</th>
                             <th width="15%" scope="col">SubComb</th>
                             <th scope="col" colspan="4" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;CA SCORE&nbsp;&nbsp;&nbsp;&nbsp;</th>
                             <th width="4%" scope="col">TOTAL C.A. (40%)</th>
                             <th scope="col" colspan="6" nowrap>EXAMINATION SCORE</th>
                             <th scope="col">TOTAL EXAM (60%)</th>
                             <th scope="col">TOTAL CA & EXAM (100%)</th>
                             <th scope="col">H.O.D EXTERNAL MODERATOR'S REMARK</th>
                         
                           </tr>
                         
                           <tr>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td align="center">1</td>
                             <td align="center">2</td>
                             <td align="center">3</td>
                             <td align="center">4</td>
                             <td></td>
                             <td align="center">1</td>
                             <td align="center">2</td>
                             <td align="center">3</td>
                             <td align="center">4</td>
                             <td align="center">5</td>
                             <td align="center">6</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                           </tr>
                         </thead>
                         <tbody>
                           @foreach($results as $index=>$result)
                           <tr>
                             <td>{{$index+1}}</td>
                             <td>{{$result->MatricNo}}</td>
                             <td>{{$result->SubjectCombinName}}</td>
                             <td style="padding-top:7px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;</td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;</td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;</td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;</td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;</td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;</td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;</td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;</td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;</td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;</td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;</td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;</td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;</td>
                           </tr>
                           @endforeach
                         </tbody>
                         <tfoot>
                             <tr>
                               <td colspan="17">
                                 <div class="col-12">
                                   <br><br>
                          NAME OF EXAMINER__________________________________________________ SIGNATURE_______________ DATE______________<br />
                          <br><br>
                          NAME OF HEAD OF DEPARTMENT__________________________________________________ SIGNATURE_________________ DATE____________<br />
                          <br><br>
                          MODERATOR'S NAME__________________________________________________ SIGNATURE_________________ DATE_____________<br /></div>
                             <table align="center" style="padding-top:30px;">
                               <tr>
                               <td>
                                 
                                 <br /></td>
                             </tr>
                             <tr>
                               <td>
                                 <br /></td>
                             </tr>
                             <tr>
                               <td></td>
                             </tr>
                           </table>
                               </td>
                             </tr>
                           </tfoot>
                         </table>
                  </div>
                  {{-- End of Modiefied --}}

                  
                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                  @else
                  <br><br> <p>No record was found!</p>
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