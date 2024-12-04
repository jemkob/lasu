<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>@extends('adminlte::page')
@section('content')
<style type="text/css">
  .auto-style3 {
      width: 220px;
  }

  .auto-style5 {
      width: 252px;
  }

  .auto-style6 {
      width: 85px;
      height: 64px;
  }

  .auto-style7 {
      font-size: small;
      font-weight: bold;
      width: 235px;
  }

  .auto-style8 {
      font-size: small;
  }

  .auto-style9 {
      width: 290px;
      font-size: small;
      height: 41px;
  }

  .auto-style10 {
      font-size: small;
      font-weight: bold;
      width: 365px;
  }

  .auto-style12 {
      font-weight: normal;
      font-size: small;
  }

  .auto-style13 {
      width: 199px;
  }

  .auto-style14 {
      width: 200px;
  }
  .auto-style15 {
      font-size: small;
      font-weight: bold;
      width: 365px;
      height: 21px;
  }
  .auto-style16 {
      font-size: small;
      font-weight: bold;
      width: 235px;
      height: 21px;
  }
  .auto-style17 {
      width: 235px;
  }
</style>
<style type="text/css">
  
  
  @media print
  {
  .noprint {display:none;}
  }
  
  @media screen
  {
  
  }
  
  </style>

<div class="box">
  <div class="box-header with-border noprint">
    <h3 class="box-title">Course Registration Manager</h3>
  </div>
    <div class="box-body">
      <div class="row noprint">
        <div class="col-sm-4">
          <form action="{{url('courseregistration/printbysession')}}" method="post">
            
            {{csrf_field()}}
            <div class="form-group">
                <label for="">Session</label>
                <select class="form-control" name="sessions" id="sessions" required="required">
                  <option value="" disable="true" selected="true">-- Select Session --</option>
                    @foreach ($sessions as $key => $value)
                      <option value="{{$value->SessionID}}">{{ $value->SessionYear }}</option>
                    @endforeach
                </select>
              </div>

                    <div class="form-group">
                        <label for="">Matric No</label>
                        <input type="text"  class="form-control" name="matricno" id="matricno" required="required">
                    </div>
                  
                  <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Get Course Form</button>
                </div>
          </form>
        </div>
      </div>
                  <p></p> <p></p>       
        
@if(isset($courseview))
    @if (count($courseview) === 0)
    <div class="alert alert-danger">
        <strong>No Registered Course for this student.</strong>
    </div>
    @elseif (count($courseview) >= 1)
    <div class="noprint" align="center"><button class="btn btn-defualt" onclick="window.print();return false;" >Print</button></div>


    <div style="background-image:url('../images/logo.png'); background-repeat: no-repeat;">
      {{-- <p>
          <img alt="" class="auto-style6" src="../images/logo.png" />
      </p> --}}
      <p align="center" style="font-size: x-large">FEDERAL COLLEGE OF EDUCATION,OSIELE, ABEOKUTA</p>
      <p align="center" style="font-size: medium"><strong>Course Registration Form</strong></p>
      <p align="center" style="font-size: medium">{{$ses->SessionYear}} First Semester</p>
  </div>
  <br />Date Printed: <?= Date(now())?>
  <table style="text-transform:uppercase">
      <tr>
          <td colspan="4" style="text-align: center; border: double">STUDENT MATRIC NO :
              {{$students->MatricNo }}</td>
          <td>@if(isset($studentimage) && strlen($studentimage->StudentImage) > 0)
              <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($studentimage->StudentImage)) }}" height="100" width="100">
              @else
              <img src="../images/logo.png" height="100" width="100">
              @endif
             </td> 
      </tr>
      <tr>
          <td class="auto-style10">NAMES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              {{$students->Surname }} {{$students->Firstname }} {{$students->Middlename }}
          </td>
      </tr>
      <tr>
          <td class="auto-style15">COUNTRY&nbsp;&nbsp;&nbsp;&nbsp;
              {{$students->Nationality }}</td>
          <td class="auto-style16">GENDER&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              {{$students->Gender }}</td>

      </tr>
      <tr>
          <td class="auto-style10">STATE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$students->SOR }}</td>
          <td class="auto-style7">PHONE NO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              {{$students->PhoneNumber }}</td>

      </tr>
      <tr>
        <td class="auto-style10">L/GOVT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$students->LGA }}</td>
        <td class="auto-style7" nowrap>EMAIL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        {{$students->Email }}</td>
      </tr>
      <tr>
          <td class="auto-style10">PROGRAM&nbsp;&nbsp;&nbsp;&nbsp; {{$students->Major }}/{{$students->Minor }}</td>
          <td class="auto-style7">LEVEL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              {{$students->Level }}</td>
      </tr>


  </table>
  
  <table style="width: 100%; margin-top: 5px; border-top: 1px solid #aaa; border-bottom: 1px solid #aaa; font-size: x-small; font-weight: 700; text-transform:uppercase;" border="0" cellspacing="0">
      <tr>
          <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">S/N</th>
          <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">Course Code</th>
          <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">Course Title</th>
          <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">Cr</th>
          <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">St</th>
          <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">Course Lecturer</th>
      </tr>
     @foreach($courseview as $index =>$post)
              
     
                  <tr>
                      <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$index+1}}</td>
                      <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post->subjectcode}}</td>
                      <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post->subjectname}}</td>
                      <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post->subjectvalue}}</td>
                      <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post->subjectunit}}</td>
                      
                     
                         
                          <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post->lsurname.' '.$post->lfirstname}}</td>
                         
                      
      
                  </tr>
              
      @endforeach
  </table>

      <table>
          <tr>
              <th style="font-size: small" class="auto-style5">Total number of units registered : {{$courseview->sum('subjectvalue')}}<br />
              </th>
          </tr>
          
      </table>
     @if($students->Level != 300)
      <p style="page-break-before: always"></p>
      @endif


      <div>
        @if($students->Level != 300)
          <p>
              <img alt="" class="auto-style6" src="../images/logo.png" />
          </p>
          @endif
          <p align="center" style="font-size: x-large">FEDERAL COLLEGE OF EDUCATION, ABEOKUTA</p>
          <p align="center" style="font-size: large">Course Registration Form</p>
          <p align="center" style="font-size: medium">{{$ses->SessionYear}} Second Semester</p>
      </div>
      <table style="width: 100%; margin-top: 5px; border-top: 1px solid #aaa; border-bottom: 1px solid #aaa; font-size: x-small; font-weight: 700; text-transform:uppercase;" border="0" cellspacing="0">
          <tr>
              <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">S/N</th>
              <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">Course Code</th>
              <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">Course Title</th>
              <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">Cr</th>
              <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">St</th>
              <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">Course Lecturer</th>
          </tr>
         @foreach($courseview1 as $index =>$post2)
                  
         
                      <tr>
                          <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$index+1}}</td>
                          <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post2->subjectcode}}</td>
                          <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post2->subjectname}}</td>
                          <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post2->subjectvalue}}</td>
                          <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post2->subjectunit}}</td>
                          
                              
                              <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post2->lsurname.' '.$post2->lfirstname}}</td>
                              
                          
          
                      </tr>
                  
          @endforeach
      </table>

      <table>
          <tr>
              <th width="483" class="auto-style9">Total number of units registered : {{$courseview1->sum('subjectvalue')}}<br />
              </th>
          </tr>
          <tr>
              <th align="center" valign="middle" class="auto-style5">
                  <span class="auto-style12"><strong>...................................................</strong></span><br class="auto-style8" />
                  <span class="auto-style8">H.O.D (EDU) Sign/Date</span><br>
                  <br>                  
                  <br class="auto-style8" />
              </th>
              <th width="257" align="center" valign="middle" class="auto-style13"><span class="auto-style8">.......................................................</span><br class="auto-style8" />
                  <span class="auto-style8">H.O.D Sign/Date&nbsp;</span><br>
                  <br>                  
                  <br class="auto-style8" />
              </th>
              <th width="287" align="center" valign="middle" class="auto-style14"><span class="auto-style8"> .................................................. </span>
                  <br class="auto-style8" />
                  <span class="auto-style8">School Officer/Date</span>
                  <br><br><br class="auto-style8" />
              </th>


          </tr>


          <tr>
              <th align="center" valign="middle" class="auto-style3"><span class="auto-style8">..................................................</span><br class="auto-style8" />
                  <span class="auto-style8">H.O.D (GSE) Sign/Date</span><br />
                  <br />
              </th>

              <th align="center" valign="middle" class="auto-style5"><span class="auto-style8"> ..................................................</span><br class="auto-style8" />
                <span class="auto-style8">H.O.D Sign/Date</span><br class="auto-style8" />
              </th>
              <th align="center" valign="middle" class="auto-style5"><span class="auto-style8">..................................................</span><br class="auto-style8" />
                <span class="auto-style8">Dean&#39;s Sign/Date&nbsp;&nbsp;&nbsp; </span></th>

          </tr>
      </table>
 @endif
@endif



    </div>

</div>


@endsection



</body>
</html>
