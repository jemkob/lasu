@extends('adminlte::page')

@section('content')
<title>Student List</title>
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
    <h3 class="box-title">Student List {{substr(uniqid(), -6)}}</h3>
  </div>
    <div class="box-body">
    <div class="row noprint">
            <div class="col-sm-4">
                <form action="{{url('statistics/getlecturerlist')}}" method="post">
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
            
        
        @if(isset($lecturercourses) && count($lecturercourses) > 0)
        {{-- Modified --}}
        
        <div class="table-responsive" style="text-transform:uppercase;">
            <table width="100%" border="1" class="table table-striped">
                
                <tr>
                    <th>
                        <table width="100%" border="0">
                            <tr>
                            <th scope="col" rowspan="5"><img src="../images/logo.png" width="114" height="99" /></th>
                            <td align="center" scope="col"><h3><strong>FEDERAL COLLEGE OF EDUCATION ABEOKUTA</strong></h3></td>
                            <th scope="col">&nbsp;</th>
                            </tr>
                            <tr>
                                <td align="center" scope="col">TOTAL COURSES BY LECTURER</td>
                                <td ></td>
                                <td></td>
                            </tr>
                        </table>
                    </th>
                </tr>
                
                
                <tr>
                    <td>
                        <?php
                        $statistics = collect($lecturercourses);
                        $statistics->all();
                        ?>
                        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
                        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
                        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
                        
                         
                         <script type="text/javascript">
                            $(document).ready(function() {
                            $('#example').DataTable(
                                {
                                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
                                }
                            );
                        } );
                        </script>
                    
                            <table id="example" class="display" width="100%">
                                <thead>
                                      <tr>
                                        <th scope="col">S/N</th>
                                        <th scope="col">FULL NAME</th>
                                        <th scope="col">TOTAL COURSES</th>
                                      </tr></thead> 
                                      <tbody>
                                    @foreach($statistics as $key=>$stats)
                                   
                                    <tr>
                                      <td>{{$key+1}}</td>
                                      <td>{{$stats->surname.' '.$stats->firstname.' '.$stats->middlename}}</td>
                                      <td>{{$stats->subjects}}</td>
                                    </tr>
                                    @endforeach
                                      </tbody>
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