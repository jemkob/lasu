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
        <div class="col-sm-12">
            <form action="{{url('generatepin')}}" method="post" >
              {{ csrf_field() }}
                <table width="20%" border="0">
                  <tr>
                    <td nowrap>
                      <input type="number" name="pincount" id="pincount" class="form-control" placeholder="Enter total Pin" required="required">
                    </td>
                    <td>
                      <button class="btn btn-success" type="submit">Generate Pin</button>
                  </td>
                  </tr>
                </table>
              </form>


        </div>
    </div>
      
@endsection