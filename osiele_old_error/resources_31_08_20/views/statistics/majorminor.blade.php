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
    <h3 class="box-title">Total Registered Per Combination</h3>
  </div>
    <div class="box-body">
                  {{-- Header --}}
                  
            {{-- <div style="font-size:10px">Date printed: {{date_format(now(),"d/m/Y H:i:s")}}</div> --}}
                      
                    
                  
                  {{-- Modified --}}
                  <?php
                  $majors = DB::table('subjectcombinations')->orderby('subjectcombinname')->get();
                  $student = DB::table('students')
                  ->select('level', DB::raw('CONCAT(major, "/", minor) as majorminor'))
                  ->where('registered', 'true')
                  ->get();
                  ?>
                  <div class="table-responsive" style="text-transform:uppercase;">
                     <table class="table table-responsive table-bordered table-striped"">
                         <tr>
                             <th>Combination</th><th>100</th><th>200</th><th>300</th><th>300+</th><th>300++</th>
                         </tr>
                         @foreach($majors as $major)
                         <tr>
                         <td>{{$major->SubjectCombinName}}</td>
                         <td>{{$student->where('level', 100)->where('majorminor', $major->SubjectCombinName)->count()}}</td>
                         <td>{{$student->where('level', 200)->where('majorminor', $major->SubjectCombinName)->count()}}</td>
                         <td>{{$student->where('level', 300)->where('majorminor', $major->SubjectCombinName)->count()}}</td>
                         <td>{{$student->where('level', 400)->where('majorminor', $major->SubjectCombinName)->count()}}</td>
                         <td>{{$student->where('level', 500)->where('majorminor', $major->SubjectCombinName)->count()}}</td>
                        </tr>
                         @endforeach
                         
                         <tr>
                            <th>Total</td>
                            <th>{{$student->where('level', 100)->count()}}</th>
                            <th>{{$student->where('level', 200)->count()}}</th>
                            <th>{{$student->where('level', 300)->count()}}</th>
                            <th>{{$student->where('level', 400)->count()}}</th>
                            <th>{{$student->where('level', 500)->count()}}</th>
                           </tr>
                        
                        
                        <tr >
                            <th>Grand Total</th>
                            
                            <th>{{$student->count()}}</th>
                           </tr>
                     </table>
                  </div>
                  {{-- End of Modiefied --}}

                  
                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                  
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