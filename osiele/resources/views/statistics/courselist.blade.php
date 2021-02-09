@extends('adminlte::page')

@section('content')
<title>studnet</title>
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
    <div class="box-body" style="text-transform:uppercase;">
        {{-- Header --}}
            <div style="font-size:10px">Date printed: {{date_format(now(),"d/m/Y H:i:s")}}</div>
        @if(isset($courselist) && count($courselist) > 0)
        {{-- Modified --}}
        
        <div class="table-responsive">
            <table width="100%" border="1" class="table table-striped">
                <thead>
                <tr>
                    <th>
                        <table width="100%" border="0">
                            <tr>
                            <th scope="col" rowspan="5"><img src="../images/logo.png" width="114" height="99" /></th>
                            <td align="center" scope="col"><h3><strong>FEDERAL COLLEGE OF EDUCATION ABEOKUTA</strong></h3><h4>LIST OF COURSES</h4></td>
                            <th scope="col">&nbsp;</th>
                            </tr>
                        </table>
                    </th>
                </tr>
                </thead>
                
               
                <?php 
                
                ?>
                <tr>
                    <td>
                        
                    
                    <table width="100%" border="1">
                        <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">COURSE CODE</th>
                        <th scope="col">COURSE TITLE</th>
                        <th scope="col">VALUE</th>
                        <th scope="col">UNIT</th>
                        <th scope="col">DEPARTMENT</th>
                        </tr> 
                    @foreach($courselist as $stats)
                    <tr>
                        <td>{{$loop->iteration}}
                        <td>{{$stats->SubjectCode}}</td>
                        <td>{{$stats->SubjectName}}</td>
                        <td>{{$stats->SubjectValue}}</td>
                        <td>{{$stats->SubjectUnit}}</td>
                        <td nowrap>{{$stats->DepartmentName}}</td>
                    </tr>
                    @endforeach
                    </table>
                    </td>
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

      
    
@endsection