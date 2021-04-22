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
    <h3 class="box-title">Attendance Sheet</h3>
  </div>
    <div class="box-body">
            <div class="row noprint">
                    <div class="col-sm-4">
                      <form action="{{url('attendance')}}" method="post">
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
                                <button class="btn btn-primary" type="submit">Get List</button>
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
                                       <td align="center"><h5><STRong><u> NCE ATTENDANCE SHEET</u></STRong></h5></td>
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
                             <th width="3%" scope="col">S/N</th>
                             <th width="10%" scope="col">MATRIC NO.</th>
                             <th width="20%" scope="col">NAMES</th>
                             <th width="10%" scope="col">SCRIPT NO.</th>
                             <th width="10%" scope="col">SIGN IN</th>
                             <th width="10%" scope="col">SIGN OUT</th>
                         
                           </tr>
                         
                           
                         </thead>
                         <tbody>
                           @foreach($results as $index=>$result)
                           <tr>
                             <td>{{$index+1}}</td>
                             <td>{{$result->MatricNo}}</td>
                             <td>{{$result->Surname.' '.$result->Firstname.' '.$result->Middlename}}</td>
                             <td></td>
                             <td></td>
                             <td></td>
                             
                           </tr>
                           @endforeach
                         </tbody>
                         <tfoot>
                            <tr>
                              <td colspan="17">
                                <div class="col-12"><b><br>
                                  Absentee(s)____________
                                  <br><br>
                         NAME OF INVIGILATOR__________________________________________________ SIGNATURE_______________ DATE______________<br />
                         <br><br>
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