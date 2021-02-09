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
    <div class="box-body">
    <div class="row noprint">
            <div class="col-sm-4">
                <form action="{{url('statistics/getinfo')}}" method="get">
                {{csrf_field()}}
                    <div class="form-group">
                        <label for="">Student List</label>
                        <select class="form-control" name="level" id="level">
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="300">300</option>
                            <option value="400">300+</option>
                            <option value="500">300++</option>
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
        
        <div class="table-responsive" style="text-transform:uppercase;">
            <table width="100%" border="1" class="table table-striped">
                <thead>
                <tr>
                    <th>
                        <table width="100%" border="0">
                            <tr>
                            <th scope="col" rowspan="5"><img src="../images/logo.png" width="114" height="99" /></th>
                            <td align="center" scope="col"><h3><strong>FEDERAL COLLEGE OF EDUCATION ABEOKUTA</strong></h3></td>
                            <th scope="col">&nbsp;</th>
                            </tr>
                            <tr>
                                <td align="center" scope="col">{{$students[0]->level}} LEVEL STUDENTLIST</td>
                                <td ></td>
                                <td></td>
                            </tr>
                        </table>
                    </th>
                </tr>
                
                
                <tr>
                    <td>
                        <?php
                        $statistics = collect($students);
                        $statistics->all();
                        $statistics = str_ireplace('{"','["',$statistics);
                        $statistics = str_ireplace('"}','"]',$statistics);
                        $statistics = implode(", ", collect($statistics)->toArray());
                        dump($statistics);
                        ?>
                        <script>
                            $(document).ready(function() {
                            $('#example').DataTable();
                        } );
                        </script>
                        
                    
                           
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