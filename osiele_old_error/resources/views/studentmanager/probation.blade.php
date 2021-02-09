@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Probation/Withdrawn Students</h3>
  </div>
  <div class="box-body">
  <div class="row">
        <div class="col-md-12">
          <table id="probation" class="table table-striped table-responsive table-bordered">
              <tr>
                  <th>S/N</th>
                  <th>Matric No.</th>
                  <th>Name</th>
                  <th>Level</th>
                  <th>Status</th>
              </tr>
              @foreach($probation as $probations)
              <tr style="text-transform:uppercase;">
                <td>{{$loop->iteration}}</td>
                <td>{{$probations->MatricNo}}</td>
                <td>{{$probations->Surname}} {{$probations->Firstname}} {{$probations->Middlename}}</td>
                <td>{{$probations->Level}}</td>
                <td>{{$probations->IsProbation}}</td>
                
              </tr>
              @endforeach

          </table>
        </div>
      
      </div>
  </div>

</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script>
$(function () {
$("#probation").DataTable();
});
</script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
@endsection

