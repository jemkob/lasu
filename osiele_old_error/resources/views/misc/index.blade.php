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
    <h3 class="box-title">Minimum And Maximum Manager</h3>
  </div>
  <div style="float:left;">
    
      
    </div>
    <div class="box-body">
            <div class="row noprint">
                <div class="col">
                  @if(count($minmax) > 0)
                  <div class="table-responsive">
                      <table width="100%" class="table table-striped table-hover">
                          
                           <tr>
                            <th scope="col">Major</th>
                            <th scope="col">Level</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Min</th>
                            <th scope="col">Maximum</th>
                            <th scope="col">Edu Min.</th>
                            <th scope="col">Edu Max.</th>
                            <th scope="col">Gse Min</th>
                            <th scope="col">Gse Max</th>
                            
                          </tr>
                         
                         <tbody class="table table-striped table-hover">
                           @foreach($minmax as $mini)
                           <form action="{{url('minmax/update')}}" method="post" class="form-control" >
                              {{ csrf_field() }}
                              <input type="hidden" name="minmaxid" value="{{$mini->MinMaxID}}">
                           <tr>
                             <td>{{$mini->Code}}</td>
                             <td>{{$mini->Level}}</td>
                             <td>{{$mini->Semester}}</td>
                             <td><input type="number" name="mini" value="{{ $mini->Minimum}}" class="form-control col-md-3" ></td>
                             <td><input type="number" name="maxi" value="{{ $mini->Maximum}}" class="form-control"></td>
                             <td><input type="number" name="edumin" value="{{ $mini->EduMin}}" class="form-control"></td>
                             <td><input type="number" name="edumax" value="{{ $mini->EduMax}}" class="form-control"></td>
                             <td><input type="number" name="gsemin" value="{{ $mini->GseMin}}" class="form-control"></td>
                             <td><input type="number" name="gsemax" value="{{ $mini->GseMax}}" class="form-control"></td>
                             <td><button class="btn btn-success" type="submit">Submit</button></td>
                           </tr>
                           </form>
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