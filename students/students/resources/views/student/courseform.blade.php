
  
   @extends('adminlte::page')

    @section('content') 
    @if(empty($posts2year))
    <div class="box" id="checkCourse">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Course Form</h4>
                </div>
            </div>
            <!-- /.row -->
            <!-- .row -->
            <div class="box-body">
                <div class="alert alert-warning">You haven't registered for the new session.</div>
                <a href="{{url('student/courseregistration')}}"> Click here to register</a>
            </div>
        </div>
    </div>
    

   @else

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
        @media print
        {
        .noprint {display:none;}
        }
    </style>
            <div class="noprint" align="center">
                  
            <button onclick="javascript:window.print()" class="btn btn-warning">Print this page</button>

           </div>
<div style="text-transform:uppercase;">
<table width="300" align="right">
                            <tr>
                            <td align="right" nowrap><strong>Date printed:</strong></td>
                            <td align="left">{{date_format(now(),"d/m/Y")}}</td>
                            </tr>
                            <tr>
                              <td style="text-align:right"><strong>Time:</strong></td>
                              <td align="left">{{date_format(now(),"H:i:s")}}</td>
    </tr>
  </table>
    <div>
            <p>
                <img alt="" class="auto-style6" src="../images/logo.png" />
            </p>
            <p align="center" style="font-size: x-large">FEDERAL COLLEGE OF EDUCATION,OSIELE, ABEOKUTA</p>
            <p align="center" style="font-size: large">Course Registration Form</p>
            <p align="center" style="font-size: medium">{{$posts2year->sessionyear}} First Semester</p>
  </div>
        <br />
  <table>
            <tr>
                <td colspan="4" style="text-align: center; border: double">STUDENT MATRIC NO :
                    {{$posts2year->MatricNo }}</td>
                <td>
                    @if(!empty(Auth::user()->StudentImage))
                <img class="rounded" src={{url('student_images/'.Auth::user()->StudentImage)}} height="100" width="100">
                @else
                    <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($posts2year->stdimg)) }}" height="100" width="100">
                @endif </td>
            </tr>
            <tr>
                <td class="auto-style10">NAMES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{$posts2year->Surname }} {{$posts2year->Firstname }} {{$posts2year->Middlename }}
                </td>
            </tr>
            <tr>
                <td class="auto-style15">COUNTRY&nbsp;&nbsp;&nbsp;&nbsp;
                    {{$posts2year->Nationality }}</td>
                <td class="auto-style16">GENDER&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{$posts2year->Gender }}</td>
    
            </tr>
            <tr>
                <td class="auto-style10">STATE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$posts2year->SOR }}</td>
                <td class="auto-style7">PHONE NO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{$posts2year->PhoneNumber }}</td>
    
            </tr>
            <tr>
              <td class="auto-style10">L/GOVT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$posts2year->LGA }}</td>
                <td nowrap class="auto-style7">EMAIL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{$posts2year->Email }}</td>
            </tr>
            <tr>
                <td class="auto-style10">PROGRAM&nbsp;&nbsp;&nbsp;&nbsp; 
                    @if(!empty($posts2year->SubCourse) && $posts2year->SubCourse=='beda')
                    BED/ACCOUNTING
                    @elseif(!empty($posts2year->SubCourse) && $posts2year->SubCourse=='beds')
                    BED/SECRETARIAT
                    @else
                    {{$posts2year->Major }}/{{$posts2year->Minor }}
                    @endif
                </td>
                <td class="auto-style7">LEVEL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @if($posts2year->Level == 400) 
                    300+ 
                    @elseif($posts2year->Level == 500)
                    300++
                    @elseif($posts2year->Level == 600)
                    300+++
                    @elseif($posts2year->Level == 700)
                    300++++
                    @else
                    {{$posts2year->Level }}
                    @endif
                </td>
            </tr>
    
    
        </table>
        
  <table style="width: 100%; margin-top: 5px; border-top: 1px solid #aaa; border-bottom: 1px solid #aaa; font-size: x-small; font-weight: 700;" border="0" cellspacing="0">
            <tr>
                <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">S/N</th>
                <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">Course Code</th>
                <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">Course Title</th>
                <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">Cr</th>
                <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">St</th>
                <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">Course Lecturer</th>
            </tr>
           @foreach($posts as $index =>$post)
                    
           
                        <tr>
                            <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$index+1}}</td>
                            <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post->subjectcode}}</td>
                            <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post->subjectname}}</td>
                            <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post->subjectvalue}}</td>
                            <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post->subjectunit}}</td>
                            <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post->lectlastname.' '.$post->lectfirstname}}</td>
                           
                               
                            
            
                        </tr>
                    
            @endforeach
        </table>
    
            <table width="100%">
                <tr>
                    <th width="80%" align="left" nowrap class="auto-style5" style="font-size: small">Total number of units registered : {{$posts->sum('subjectvalue')}}<br />
                    </th>
                    <th width="20%" align="right" nowrap><span class="auto-style5" style="font-size: small">Date Registered: @if(count($posts)>0) {{$posts[0]->created_at}}@endif </span></th>
              </tr>
            </table>
            @if($posts2year->Level < 300)
            <p style="page-break-before: always"></p>
            
    
  <table width="300" align="right">
                            <tr>
                            <td align="right" nowrap><strong>Date printed:</strong></td>
                            <td align="left">{{date_format(now(),"d/m/Y")}}</td>
                            </tr>
                            <tr>
                              <td style="text-align:right"><strong>Time:</strong></td>
                              <td align="left">{{date_format(now(),"H:i:s")}}</td>
                              </tr>
                          </table>
            <div>
                <p>
                    <img alt="" class="auto-style6" src="../images/logo.png" />
                </p>
                <p align="center" style="font-size: x-large">FEDERAL COLLEGE OF EDUCATION, ABEOKUTA</p>
                <p align="center" style="font-size: large">Course Registration Form</p>
                <p align="center" style="font-size: medium">{{$posts2year->sessionyear}} Second Semester</p>
                 <p align="center" style="font-size: small">{{$posts2year->Surname }} {{$posts2year->Firstname }} {{$posts2year->Middlename }}</p>
                
            </div>
            @endif
            <br />
  <table style="width: 100%; margin-top: 5px; border-top: 1px solid #aaa; border-bottom: 1px solid #aaa; font-size: x-small; font-weight: 700;" border="0" cellspacing="0">
                <tr>
                    <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">S/N</th>
                    <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">Course Code</th>
                    <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">Course Title</th>
                    <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">Cr</th>
                    <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">St</th>
                    <th style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">Course Lecturer</th>
                </tr>
               @foreach($posts2 as $index =>$post2)
                        
               
                            <tr>
                                <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$index+1}}</td>
                                <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post2->subjectcode}}</td>
                                <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post2->subjectname}}</td>
                                <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post2->subjectvalue}}</td>
                                <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post2->subjectunit}}</td>
                                <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$post2->lectlastname.' '.$post2->lectfirstname}}</td>
                
                            </tr>
                        
                @endforeach
  </table>
    
  <table width="100%" border="0">
    <tr>
      <th width="72%" align="left" nowrap class="auto-style9">Total number of units registered : {{$posts2->sum('subjectvalue')}}</th>
      <th width="28%" align="right" nowrap><span class="auto-style5" style="font-size: small">Date Registered: </span> @if(count($posts2)>0) {{$posts2[0]->created_at}} @endif</th>
    </tr>
  </table>
  <table>
                
                <tr>
                    <th height="96" align="center" valign="bottom" class="auto-style5">
                        <span class="auto-style12"><strong>...................................................</strong></span><br class="auto-style8" />
                        <br class="auto-style8" />
                        <span class="auto-style8">H.O.D (EDU) Sign/Date</span><br class="auto-style8" />
                    </th>
                    <th align="center" valign="bottom" class="auto-style13"><span class="auto-style8">
                        .......................................................</span><br class="auto-style8" />
                        <br class="auto-style8" />
                        <span class="auto-style8">&nbsp;H.O.D Sign/Date&nbsp;</span><br class="auto-style8" />
                  </th>
                  <th align="center" valign="bottom" class="auto-style14"><span class="auto-style8">..................................................</span>
                        <br class="auto-style8" />
                        <br class="auto-style8" />
                      <span class="auto-style8">School Officer/Date</span></th>
    
    
                </tr>
    
    
                <tr>
                    <th height="93" align="center" valign="bottom" class="auto-style3"><span class="auto-style8"><br />
                        ..................................................<br class="auto-style8" />
                    </span><br class="auto-style8" />
                        <span class="auto-style8">H.O.D (GSE) Sign/Date</span>
                  </th>
    
                    <th align="center" valign="bottom" class="auto-style5"><span class="auto-style8"> ..................................................</span><br class="auto-style8" />
                        <br class="auto-style8" />
                        <span class="auto-style8">H.O.D Sign/Date</span><br class="auto-style8" />
                  </th>
                    <th align="center" valign="bottom" class="auto-style5"><span class="auto-style8">..................................................</span><br class="auto-style8" />
                        <br class="auto-style8" />
                  <span class="auto-style8">Dean&#39;s Sign/Date</span></th>
    
                </tr>
  </table>
</div>
            @endif

            @endsection
