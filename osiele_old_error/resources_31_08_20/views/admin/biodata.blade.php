@extends('adminlte::page')

@section('content')
<div class="box-body">

<p align="left"><img alt="Osiele" class="auto-style6" src="../Admin/Results/Image2.PNG" /> </p>
         <table align="center">
            <tr>
           <td align="center" class="auto-style1"><strong>FEDERAL COLLEGE OF EDUCATION, ABEOKUTA</strong></td>
            </tr>
            <tr>
                <td align="center" class="auto-style1"><strong>BIO DATA</strong></td>
            </tr>
        </table>
        <p align="center"><asp:Image ID="UserImage" Width="121px" height="121px" runat="server"/></p>
        <br />
        <br />


@foreach($posts as $post)

<table style="border: 1px solid #000; width: 100%; margin-top: 5px;" border="0" cellspacing="0" class="auto-style5">
  <tr>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style2" colspan="">Surname</td>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style4" colspan="">{{$post->Surname}}</td>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style3" colspan="">Firstname</td>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$post->Firstname}}</td>
  </tr>
  <tr>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style2" colspan="">Middlename</td>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style4" colspan="">{{$post->Middlename}}</td>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style3" colspan="">Marital Status</td>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$post->MaritalStatus}}</td>
  </tr>
  <tr>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style2" colspan="">Date of Birth</td>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style4" colspan="">{{$post->DateOfBirth}}</td>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style3" colspan="">Place of Birth</td>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$post->PlaceOfBirth}}</td>
  </tr>
  <tr>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style2" colspan="">Nationality</td>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style4" colspan="">{{$post->Nationality}}</td>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style3" colspan="">State</td>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$post->SOR}}</td>
  </tr>
  <tr>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style2" colspan="">LGA</td>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style4" colspan="">{{$post->LGA}}</td>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style3" colspan="">Religion</td>
      <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$post->Religion}}</td>
  </tr>

</table>

<hr />
        <table style="border: 1px solid #000; width: 100%; margin-top: 5px;" border="0" cellspacing="0" class="auto-style5">
            <tr>
                <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style2" colspan="">Sponsor&#39;s Details</td>
                <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style4" colspan="">{{$post->SponsorsName}}</td>
                <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style3" colspan="">Address of Sponsor</td>
                <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$post->SponsorsAddress}}</td>
                <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style7" colspan="">Phone Number of Sponsor</td>
                <td style="border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;" class="auto-style1" colspan="">{{$post->SponsorsPhoneNumber}}</td>
            </tr>

        </table>
        

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
                    <hr />
                    
                </div>

@endforeach


    
    	
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection