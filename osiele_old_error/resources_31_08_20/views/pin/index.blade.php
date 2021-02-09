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
    
    </style>
  
<div class="box">
  <div class="box-header with-border noprint">
    <h3 class="box-title">PIN Manager</h3>
  </div>
  <hr>
    <div class="box-body">
            <div class="row noprint">
                <div class="col-md-8">
                  @if(count($pins) > 0)
                  <div class="table-responsive">

                    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
                    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
                    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
                    
                     
                     <script type="text/javascript">
                        $(document).ready(function() {
                        $('#pins').DataTable(
                            {
                                "lengthMenu": [[25, 50, 100, 200, 500, -1], [25, 50, 100, 200, 500, "All"]]
                            }
                        );
                    } );
                    </script>

                      <table width="100%" class="table-responsive table" id="pins">
                          <thead>
                           <tr>
                            <th scope="col">PIN</th>
                            <th scope="col">MATRIC NO.</th>
                            <th>STUDENT ID</th>
                            <th scope="col">#</th>
                            <th scope="col">#</th>
                            
                          </tr>
                         </thead>
                         <tbody class="table table-striped table-bordered table-hover">
                           @foreach($pins as $pin)
                           <tr>
                             <td>{{$pin->pinkey}}</td>
                             <td>{{$pin->matricno}} @if(empty($pin->matricno)) {{$pin->jambreg}} @endif
                              @if(empty($pin->studentpin)) UNUSED @endif</td>
                             <td>{{$pin->level}}</td>
                             <td>
                              </td>
                             <td></td>
                           </tr>
                           @endforeach
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
    </div>
</div>    
@endsection