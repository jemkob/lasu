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
  <div style="float:left;">
    <form action="{{url('pin/searchpin')}}" method="get" >
      {{ csrf_field() }}
        <table width="100%" border="0">
          <tr>
            <td nowrap>
              <input type="text" name="search" id="search" class="form-control" placeholder="Matric No/Pin">
            </td>
            <td>
              <button class="btn btn-success" type="submit">Search</button>
          </td>
          </tr>
        </table>
      </form>
      
    </div>
    <div class="box-body">
            <div class="row noprint">
                <div class="col-sm-3">
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