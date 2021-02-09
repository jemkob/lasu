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
  <style type="text/css" media="print">
    @page
    {
        size: auto; /* auto is the initial value */
        margin: 2mm 4mm 0mm 0mm;  this affects the margin in the printer settings
    }
    thead
    {
        display: table-header-group;
    }
    tfoot
    {
        display: table-footer-group;
    }
</style>
<div class="box" style="text-transform:uppercase;">
  <div class="box-header with-border noprint">
    <h3 class="box-title">Academic Standing</h3>
  </div>
    <div class="box-body">
            <div class="row noprint">
                    <div class="col-sm-8">
                      <form action="{{url('academicstanding')}}" method="post">
                        {{csrf_field()}}
                        <table>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td><strong> Matric No.</strong></td>
                                <td><input type="text" name="matricno" id="matricno" class="form-control" placeholder="Matric No." required="required"></td>
                                <td><button class="btn btn-primary" type="submit">Get Results</button></td>
                            </tr>
                        </table>
                       <div class="col-md-6">
                                
                            </div>
                      </form>
                    </div>
                  </div>
                  
                          
        
                  @if(isset($academicstanding))
                  @if(count($academicstanding) > 0)
                  
                   <?php 
                  // $all= collect($academicstanding)->groupby('Level')->all();
                   ?>
                   @foreach($tlevel as $levels)
                  <table border="0" style="width: 100%; margin-top: 5px; font-size: 12px; font-family:'New Times Roman', serif;">
                      <tr>
                        <td width="24%" align="center" scope="col">&nbsp;</td>
                        
                        <td width="46%" align="center" nowrap scope="col"><h3><strong>FEDERAL COLLEGE OF EDUCATION, ABEOKUTA</strong><br>
                        ACADEMIC STANDING</h3></td>
                        <td width="30%">
                          <table width="50%" style="float:right; font-size: 12px; font-family:'New Times Roman', serif; font-weight:bold;">
                            <tr>
                              <td>Page:</td>
                              <td>&nbsp;</td>
                              <td align="left" nowrap>&emsp;{{$loop->iteration}}</td>
                            </tr>
                            <tr>
                            <td width="27%">Date:</td>
                            <td width="3%">&nbsp;</td>
                            <td width="70%" nowrap>&emsp;{{date_format(now(),"d/m/Y")}}</td>
                            </tr>
                            <tr>
                              <td >Time:</td>
                              <td>&nbsp;</td>
                              <td nowrap>&emsp;{{date_format(now(),"H:i:s")}}</td>
                              </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td align="center"></td>
                      <td align="center"></td>
                        <th>&nbsp;</th>
                        
                      </tr>
                     
                    </table>
                    <table cellspacing="10" style="width: 100%; margin-top: 5px; font-size: 12px; font-family:'New Times Roman', serif;text-transform:uppercase;">
                      <tr>
                      <th width="153" align="left" nowrap>STUDENT NUMBER:</th>
                      <th width="18">&nbsp;</th>
                      <td width="958"><strong>{{$student->MatricNo}}</strong></td>
                      </tr>
                      <tr>
                          <th align="left">STUDENT NAME: </th>
                          <th>&nbsp;</th>
                          <td><strong>{{$student->Surname}} {{$student->Firstname}} {{$student->Middlename}}</strong></td>
                      </tr>
                      <tr>
                         <th align="left"> SUB/COMB:</th> 
                          <th>&nbsp;</th>
                          <td><table width="673" border="0" style="font-size: 12px; font-family:'New Times Roman', serif;text-transform:uppercase;">
                            <tr>
                                <td width="490"><strong>@if(empty($student->subcourse)){{$subcom->SubjectCombinName}}
                            @else 
                              @if($student->subcourse == 'beda')
                              BED/BED - ACCOUNTING
                              @else
                              BED/BED - OFFICE TECH. MANAGEMENT
                              @endif
                            @endif </strong></td>
                                <td width="52"><strong>LEVEL:</strong></td>
                                <td width="117"><strong>
                                  @if($levels->Level > 300) 300+ @else {{$levels->Level}} @endif
                                </strong></td>
                              </tr>
                        </table></td>
                      </tr>
                      <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>
                  </table>
                    {{-- Header end --}}
                    <table style="width: 100%; margin-top: 5px; font-size: 12px; font-family:'New Times Roman', serif;" border="0" cellspacing="0">
                    <tr style="height: 2.5px;"><td colspan="7" style="border-top: 2px dotted #000; height: 2.5px;"></td></tr>
                    
                    
                            <tr>
                                <td><strong>NO.</strong></td>
                                <td><strong>SUBJECT</strong></td>
                                
                                <td align="center"><strong>TITLE</strong></td>
            
                                <td align="center"><strong>UNIT</strong></td>
                                <td align="center"><strong>STATUS</strong></td>
                                <td align="center"><strong>GRADE</strong></td>
                                
                                <td align="center"><strong>REMARK</strong></td>
                            </tr>
                            <tr style="height: 2.5px;"><td colspan="7" style="border-bottom: 2px dotted #000; height: 2.5px;"></td></tr>
                            <?php 
                            $thelevel = $levels->Level;
                            $firstsem = collect($academicstanding)->where('Level', $thelevel)->where('Semester', 1)->all();
                            ?>
                            @if(count($firstsem) > 0)
                            <tr><td colspan="7"><table style="margin-top: 5px; font-size: 12px; font-family:'New Times Roman', serif;" width="260" border="0">
                              <tr>
                                <td width="77"><strong>Session:</strong></td>
                                <td width="173">{{$levels->SessionYear}}</td>
                              </tr>
                              <tr>
                                <td><strong>Semester:</strong></td>
                                <td>First</td>
                              </tr>
                      </table></td></tr>
                            <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
                            @foreach($firstsem as $index=>$results)
                            <tr>
                                <td valign="top" style="height: 4.5px;">{{$loop->iteration}}</td>
                                <td align="center" valign="top">{{$results->SubjectCode}}</td>
                                
                                <td valign="top">{{$results->SubjectName}}</td>
                                <td align="center" valign="top">{{$results->TNU}}</td>
                                <td align="center" valign="top">{{$results->SubjectValue}}</td>
            
                                <td align="center" valign="top">
                                    <?php $total = $results->EXAM + $results->CA;?>
                                        @if($total >= 70)
                                        A 
                                        @elseif($total >= 60 && $total <= 69)
                                        B 
                                        @elseif($total >= 50 && $total <= 59)
                                        C
                                        @elseif($total >= 45 && $total <= 49)
                                        D 
                                        @elseif($total >= 40 && $total <= 44)
                                        E 
                                        @elseif($total < 40)
                                        F
                                        @endif
                                </td>
                                <td align="center" valign="top">
                                        @if($total > 39)
                                        Passed 
                                        @else
                                        failed 
                                        @endif
                                </td>
                            </tr>
                            @endforeach
                            <tr style="height: 2.5px;"><td colspan="7" style="height: 2.5px;"></td></tr>
                            <tr style="height: 2.5px;"><td colspan="7" style="border-top: 1px dotted #000; height: 2.5px;"></td></tr>
                            <tr style="height: 2.5px;"><td colspan="7" style="border-top: 1px dotted #000; height: 2.5px;"></td></tr>
                            @endif

                          <?php
                          $secondsem = collect($academicstanding)->where('Level', $thelevel)->where('Semester', 2)->all();
                          
                          ?>
                          @if(count($secondsem) > 0)
                            <tr>
                              <td style="height:10px"></td>
                              <td></td>
                            </tr>
                            <tr><td colspan="7"><table style="margin-top: 5px; font-size: 12px; font-family:'New Times Roman', serif;" width="260" border="0">
                              <tr colspan="7">
                                <td width="77"><strong>Session:</strong></td>
                                <td width="173">{{$levels->SessionYear}}</td>
                              </tr>
                              <tr>
                                <td><strong>Semester:</strong></td>
                                <td>Second</td>
                              </tr>
                      </table></td></tr>
                            <tr>
                              <td style="height:10px"></td>
                              <td></td>
                              
                            </tr>
                            @foreach($secondsem as $index=>$results)
                            <tr>
                                <td valign="top" style="height: 4px;">{{$loop->iteration}}</td>
                              <td align="center" valign="top">{{$results->SubjectCode}}</td>
                                
                                <td valign="top">{{$results->SubjectName}}</td>
                                <td align="center" valign="top">{{$results->TNU}}</td>
                                <td align="center" valign="top">{{$results->SubjectValue}}</td>
            
                                <td align="center" valign="top">
                                        <?php $total = $results->EXAM + $results->CA;?>
                                            @if($total >= 70)
                                            A 
                                            @elseif($total >= 60 && $total <= 69)
                                            B 
                                            @elseif($total >= 50 && $total <= 59)
                                            C
                                            @elseif($total >= 45 && $total <= 49)
                                            D 
                                            @elseif($total >= 40 && $total <= 44)
                                            E 
                                            @elseif($total < 40)
                                            F
                                            @endif
                              </td>
                                <td align="center" valign="top">
                                            @if($total > 39)
                                            Passed 
                                            @else
                                            failed 
                                            @endif
                                </td>
                            </tr>
                            @endforeach
                            <tr style="height: 2.5px;"><td colspan="7" style="height: 2.5px;"></td></tr>
                            <tr style="height: 2.5px;"><td colspan="7" style="border-top: 1px dotted #000; height: 2.5px;"></td></tr>
                            <tr style="height: 2.5px;"><td colspan="7" style="border-top: 1px dotted #000; height: 2.5px;"></td></tr>
                            @endif
                            
            
                        </table>
                        @if($loop->last)
      <p style="page-break-after: avoid;">&nbsp;</p>
                        @else 
                        <p style="page-break-after: always;">&nbsp;</p>
                        @endif
                    @endforeach
      
                      
                          
                  
      @else
<p>Student Academic Standing Not Available. </p>
                  @endif
                  @endif
    </div>

</div>


@endsection