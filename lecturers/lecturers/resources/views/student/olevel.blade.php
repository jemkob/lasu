@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">O'Level Information</h3>
  </div>
  <div class="box-body">


        <p align="center"><asp:Image ID="UserImage" Width="121px" height="121px" runat="server"/></p>
        <br />
        <br />


@foreach($posts as $post)



     

        <hr />

         <div class="col-md-12">
          <h3>Jamb Details</h3>

          
          <table style="border: 1px solid #000; width: 100%; margin-top: 5px;" border="0" cellspacing="0" class="auto-style5">

              <thead>
                  <tr>
                      <th>Registration Number</th>
                      <th>Center Number</th>
                      <th>Year</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$jamb->RegNo}}</td>
                      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$jamb->Center}}</td>
                      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$jamb->Year}}</td>
                  </tr>

              </tbody>
          </table>
          <table style="border: 1px solid #000; width: 100%; margin-top: 5px;" border="0" cellspacing="0" class="auto-style5">

                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jambdetails as $jmb)
                    <tr>
                        <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$jmb->Subject}}</td>
                        <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$jmb->Score}}</td>
                    </tr>
                    @endforeach
                    <tr>
<td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">TOTAL SCORE</td>
                    <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$sumscore}}</td>
                    </tr>
                </tbody>
            </table> 
            @if($jmb->Score <= 0)
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".jambresult">Add JAMB Result</button>
            @endif
        </div>
       

       

    <div class="col-md-12">
            <hr /><br />
                    <h3>O'Level Details</h3>
        
                    
                    <table style="border: 1px solid #000; width: 100%; margin-top: 5px;" border="0" cellspacing="0" class="auto-style5">
                        <thead>
                            <tr>
                                <th>Exam Type</th>
        
                                <th>Exam Year</th>
                                <th>Center Number</th>
                                <th>Reg Number</th>
                            </tr>
        
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$olevel->ExamType}}</td>
                                <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$olevel->ExamYear}}</td>
                                <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$olevel->CenterNumber}}</td>
                                <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$olevel->RegNo}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="border: 1px solid #000; width: 100%; margin-top: 5px;" border="0" cellspacing="0" class="auto-style5">
                        <thead>
                            <tr>
                                <th>Subject Name</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($oleveldetails as $odetails)
                            <tr>
                                <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$odetails->SubjectName}}</td>
                                <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$odetails->Grade}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                
                @if($odetails->SubjectName == "")
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".jambresult">Add O'Level Result</button>
                @endif
                    <hr />
                    
                </div>

@endforeach

</div>

</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection