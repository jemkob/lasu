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
    <h3 class="box-title">PIN Manager</h3>
  </div>
  

    <div class="box-body">
        <div class="col">
        <?php
          $code = substr(uniqid(), -10);
        //  $pincount = $request->input('pincount');
         for ($x = 0; $x <= 6000; $x++) {
           ?>
            
            <table width="100%" border="4" cellpadding="0" cellspacing="0" bordercolor="#000000">
                <tr>
                  <td width="50%" height="74">Serial No.: {{$x}}</td>
                  <td width="50%">PIN: {{$code}}</td>
                </tr>
              </table>
              <br><br>
         <?php }?>
          


        </div>
    </div>
    {{-- <div class="box-body">
            <div class="row noprint">
                <div class="col-sm-12">
                  @if(count($pins) > 0)
                  <div class="table-responsive">
                      <table width="100%">
                          <thead>
                           <tr>
                            <th scope="col">PIN</th>
                            <th scope="col">MATRIC NO.</th>
                            <th>LOGIN COUNT</th>
                            <th scope="col">#</th>
                            <th scope="col">#</th>
                            
                          </tr>
                         </thead>
                         <tbody class="table table-striped table-bordered table-hover">
                           @foreach($pins as $pin)
                           <tr>
                             <td>{{$pin->pinkey}}</td>
                             <td>{{$pin->matricno}}</td>
                             <td>{{$pin->level}}</td>
                             <td>
                               @if(empty($pin->matricno))
                               <form action="">
                                 <input type="text" name="matricno" id="matricno" placeholder="Matric No"> <input type="button" value="Submit" class="btn btn-success">
                               </form>
                               @endif
                              </td>
                             <td></td>
                           </tr>
                           @endforeach
                         </tbody>
                         </table>
                  </div>
                  End of Modiefied
                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                  @else
                      <p>No result found</p>
                  @endif
    </div>
  </div>
</div> --}}    
@endsection