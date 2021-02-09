@extends('adminlte::page')

@section('content')
<table id="payments" class="table table-bordered table-striped table-hover">

    <thead>
    <tr>
      <th>S/No</th>
      <th>Matric/JAMB No</th>
      <th>Payment Ref</th>
      <th>Amount</th>
      <th>Level</th>
      <th>Status</th>
      <th>Date</th>
      
    </tr>
    </thead>
    <tbody>
    @foreach($payments as $pay)
    <tr>
    
      <td>{{$loop->index+1}}</td>
      <td>{{$pay->matricno}}</td>
      <td>{{$pay->referenceno}}</td>
      <td>{{number_format($pay->amount,2)}}</td>
      <td>{{$pay->level}}</td>
      <td>{{$pay->status}}</td>
      <td>{{date('d-m-Y',strtotime($pay->transactiondate))}}</td>
    </tr>
    
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>S/No</th>
        <th>Matric/JAMB No</th>
        <th>Payment Ref</th>
        <th>Amount</th>
        <th>Level</th>
        <th>Status</th>
        <th>Date</th>
    </tr>
    </tfoot>
  </table>

  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
                    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
                    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
                    
                     
                     <script type="text/javascript">
                        $(document).ready(function() {
                        $('#payments').DataTable(
                            {
                                "lengthMenu": [[-1, 10, 25, 50, 100], ["All", 10, 25, 50, 100]]
                            }
                        );
                    } );
                    </script>

@endsection