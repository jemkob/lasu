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
    <h3 class="box-title">PIN Manager | Add PIN</h3>
  </div>
  

    <div class="box-body">
        @if (!isset($getpins))
        <div class="col-sm-12">
            <form action="{{url('addpin')}}" method="post" >
              {{ csrf_field() }}
                <table width="20%" border="0">
                  <tr>
                    <td nowrap>
                      <input type="number" name="pincount" id="pincount" class="form-control" placeholder="Enter total Pin" required="required">
                    </td>
                  </tr>
                  <br>
                  <tr>
                    <td>
                      <button class="btn btn-success" type="submit">Generate Additional Pin(s)</button>
                  </td>
                  </tr>
                </table>
              </form>


        </div>
        @else
        <div class="col">
        


            @foreach($getpins as $pins)
            <table width="100%" border="4" cellpadding="0" cellspacing="0" bordercolor="#000000" align="center">
               <tr>
                 <td width="50%" height="74" align="center" style="font-size:18px; font-weight:bold;">Serial No.: {{$pins->PinID}}</td>
                 <td width="50%" align="center" style="font-size:28px; font-weight:bold;">PIN: {{$pins->PinKey}}</td>
               </tr>
               <tr bordercolor="#FFFFFF">
                 <td height="10" align="center">&nbsp;</td>
                 <td align="right" style="font-size:10px;">Powered by Splashnet Tech. Ltd.</td>
               </tr>
             </table>
             <br><br>
                 
            @endforeach
             
   
   
           </div>
        @endif
    </div>
      
@endsection