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
  .topbottomborder 
  {
    border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;
}
  
  </style>
<div class="box">
  <div class="box-header with-border noprint">
    <h3 class="box-title">Result Slip</h3>
  </div>
    <div class="box-body">
            <div class="row noprint">
                    <div class="col-sm-8">
                      <form action="{{url('printcounterstart')}}" method="post">
                        {{csrf_field()}}
                        <table>
                            <tr>
                                <td>Begin Date</td><td>End Date</td><td></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="begin" id="" required>

                                </td>
                                <td> 
                                    <input type="date" name="end" id="" required>
                                </td>
                                
                                <td><button class="btn btn-primary" type="submit">Get Print Count</button></td>
                            </tr>
                        </table>
                       <div class="col-md-6">
                                
                            </div>
                            
                      </form>
                      <?php
/* 
                        $begin = new DateTime( '18-10-2019' );
                        $end = new DateTime( '30-10-2019' );
                        $end = $end->modify( '+1 day' );

                        $interval = new DateInterval('P1D');
                        $daterange = new DatePeriod($begin, $interval ,$end);

                        foreach($daterange as $date){
                            echo $date->format("Ymd") . "<br>";
                        } */
                        ?>
                        @if(isset($printed))
                        <h3>
                            Resultslip printed between {{$begin}} and {{$end}}
                        </h3>
                         <div class="col-md-6">
                            
                            <table class="table table-responsive table-bordered">
                                <tr>
                                    <th></th>
                                    <th>
                                        User
                                    </th>
                                    <th>
                                        Print Count
                                    </th>
                                </tr>
                                
                                @foreach($printed as $prints)
                                <tr>
                                    <td>
                                        {{$loop->index+1}}
                                    </td>
                                    <td>
                                        {{$prints->username}}
                                    </td>
                                    <td>
                                        {{$prints->printcount}}
                                    </td>
                                </tr>
                                @endforeach
                                
                            </table>   
                        </div>
                        @endif
                    </div>
                  </div>
                  
                          
        
                  

                      
    </div>

</div>


@endsection