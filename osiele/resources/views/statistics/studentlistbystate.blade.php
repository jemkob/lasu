@extends('adminlte::page')

@section('content')
<title>student</title>
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
    <h3 class="box-title">Student List</h3>
  </div>
    <div class="box-body">
    <div class="row noprint">
            <div class="col-sm-4">
                <form action="{{url('statistics/getlist')}}" method="post">
                {{csrf_field()}}
                    <div class="form-group">
                        <label for="">Student List</label>
                        <select class="form-control" name="studentlist" id="studentlist">
                            <option value="school">By School</option>
                            <option value="subjectcombination">By Subject Combination</option>
                            <option value="department">By Department</option>
                            <option value="level">By Level</option>
                            
                        </select>
                        </div>
                        
                <div class="col-md-6">
                <button class="btn btn-primary" type="submit">Get Stats</button>
            </div>
        </form>
    </div>
    </div>
                          
        
        {{-- Header --}}
            <div style="font-size:10px">Date printed: {{date_format(now(),"d/m/Y H:i:s")}}</div>
            
        
        @if(isset($students) && count($students) > 0)
        {{-- Modified --}}
        
        <div class="table-responsive">
            <table width="100%" border="1" class="table table-striped">
                <thead>
                <tr>
                    <th>
                        <table width="100%" border="0">
                            <tr>
                            <th scope="col" rowspan="5"><img src="../images/logo.png" width="114" height="99" /></th>
                            <td align="center" scope="col"><h3><strong>FEDERAL COLLEGE OF EDUCATION ABEOKUTA</strong></h3>{{$sessions->SessionYear}}</td>
                            <th scope="col">&nbsp; </th>
                            </tr>
                            
                        </table>
                    </th>
                </tr>
                </thead>
                
                @foreach($program as $prog)
                <?php 
                
                ?>
                <tr>
                    <td>
                        <h2 class="bg-success">{{$prog->SubjectCombinName}}</h2>
                        <?php
                        $statistics = collect($students)->where('program', $prog->SubjectCombinName);
                        $statistics->all();
                        ?>
                    
                            <table width="100%" border="1">
                                      <tr>
                                        <th scope="col">LEVEL</th>
                                        <th scope="col">MALE</th>
                                        <th scope="col">FEMALE</th>
                                        <th scope="col">TOTAL STUDENTS</th>
                                      </tr> 
                                      <?php $alltotal= 0; $totalfemale= 0; $totalmale = 0;?>
                                    @foreach($statistics as $stats)
                                   
                                    <?php 
                                                             
                                        $alltotal += $stats->total;
                                        $totalfemale += $stats->female;
                                        $totalmale += $stats->male; ?>
                                    <tr>
                                      <td>{{$stats->level}}</td>
                                      <td>{{$stats->male}}</td>
                                      <td>{{$stats->female}}</td>
                                      <td>{{$stats->total}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                      <td align="right">TOTAL</td>
                                      <td>{{$totalmale}}</td>
                                      <td>{{$totalfemale}}</td>
                                      <td>{{$alltotal}}</td>
                                    </tr>
                                  </table>
                    </td>
                </tr>
                @endforeach
                <tr>
                <td align="right">TOTAL</td>
                
                </tr>
            
                </table>
        </div>
        {{-- End of Modiefied --}}

        @elseif(isset($school) && count($school) > 0)
        {{-- Modified --}}
        
        <div class="table-responsive">
            <table width="100%" border="1" class="table table-striped">
                <thead>
                <tr>
                    <th>
                        <table width="100%" border="0">
                            <tr>
                            <th scope="col" rowspan="5"><img src="../images/logo.png" width="114" height="99" /></th>
                            <td align="center" scope="col"><h3><strong>FEDERAL COLLEGE OF EDUCATION ABEOKUTA</strong></h3></td>
                            <th scope="col">{{$sessions->SessionYear}}</th>
                            </tr>
                        </table>
                    </th>
                </tr>
                </thead>
                
                @foreach(collect($faculty)->where('facultyname', '!=', 'DEWS') as $fac)
                <?php 
                
                ?>
                <tr>
                    <td>
                        <h2 class="bg-success">{{$fac->FacultyName}}</h2>
                        <?php
                        // $statistics = collect($school)->where('facultyname', $fac->FacultyName);
                        // $statistics->all();
                        ?>
                    
                            <table width="100%" border="1">
                                      <tr>
                                        <th scope="col">LEVEL</th>
                                        <th scope="col">MALE</th>
                                        <th scope="col">FEMALE</th>
                                        <th scope="col">TOTAL STUDENTS</th>
                                      </tr> 
                                      <?php $alltotal= 0; $totalfemale= 0; $totalmale = 0;?>
                                      {{-- @dump($statistics) --}}
                                    @foreach($school->where('facultyid', $fac->FacultyID) as $stats)
                                   
                                    <?php 
                                                             
                                        $alltotal += $stats->total;
                                        $totalfemale += $stats->female;
                                        $totalmale += $stats->male; ?>
                                    <tr>
                                      <td>{{$stats->level}}</td>
                                      <td>{{$stats->male}}</td>
                                      <td>{{$stats->female}}</td>
                                      <td>{{$stats->male + $stats->female}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                      <td align="right">TOTAL</td>
                                      <td>{{$totalmale}}</td>
                                      <td>{{$totalfemale}}</td>
                                      <td>{{$totalmale + $totalfemale}}</td>
                                    </tr>
                                  </table>
                    </td>
                </tr>
                @endforeach
                <tr>
                <td><h2 class="bg-success">GRAND TOTAL: {{count($allstudents)}}</h2></td>
                
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