
  
   @extends('adminlte::page')

    @section('content') 
    @if(Auth::user()->Registered == NULL)
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
{{-- @dd($posts) --}}
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
            font-size: 16px;
            padding-left: 10px;
            /* font-weight: bold; */
            /* width: 365px; */
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
        .courses{
            border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa; font-size: 14px;
        }
        .coursetitle{
            border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa; font-size: 18px;
        }
        @media print
        {
        .noprint {display:none;}
        }
        hr {
  border-top: 3px solid grey;
}
    </style>
    <div class="box" id="checkCourse">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title"></h4>
                </div>
            </div>
            
            <div class="noprint" align="center">
                  
            <button onclick="javascript:window.print()" class="btn btn-warning">Print this page</button>

           </div>

           
          <table align="center" width="700px">
              <tr>
                  <td width="25%" align="center"><img alt="" class="auto-style6" src="../images/logo.png" /></td>
                  <td  width="50%" align="center"><h3>LAGOS STATE UNIVERSITY, OJO</h3>
                    <h4>(FCE Abeokuta Study Centre)</h4></td>
                  <td  width="25%" align="center"><img alt="" class="auto-style6" src="../images/osielelogo.jpg" /></td>

              </tr>
          </table>
          <hr >
          {{-- <table width="100%" border="1"cellspacing=4><tr><td> </td></tr></table> --}}
          

<div style="text-transform:uppercase;">
{{-- <table width="300" align="right">
                            <tr>
                            <td align="right" nowrap><strong>Date printed:</strong></td>
                            <td align="left">{{date_format(now(),"d/m/Y")}}</td>
                            </tr>
                            <tr>
                              <td style="text-align:right"><strong>Time:</strong></td>
                              <td align="left">{{date_format(now(),"H:i:s")}}</td>
    </tr>
  </table> --}}
   
        <br />

        <table style="width: 70%; margin-top: 5px; padding:0 0 2px 5px; border: 2px solid #aaa; font-size: 32px;" align="center" cellpadding = "10">
            <tr>
                <td >
                    <table>
                        <tr>
                            <td class="auto-style10">
                               <strong>Name: </strong> 
                                {{Auth::user()->Surname }} {{Auth::user()->Firstname }} {{Auth::user()->Middlename }} <br>
                                <strong>Matric. No.: </strong> {{$matricno}} <br>
                                <strong>Course: </strong>@if(!empty($studentprogramme)) {{$studentprogramme->DepartmentName}} @endif<br>
                                <strong>Receipt No.: </strong> 2388499393<br>
                                <strong>Remita Retrieval Ref.: </strong>  rrr <br>
                                <strong>Exam Pass ID: </strong> Id
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="30%">
                    <div style="text-align: center; border:2px solid #aaa; padding:5px;">
                        <img src="https://placehold.co/220x140?text={{Auth::user()->Surname}}\n {{Auth::user()->Firstname}}" alt="">
                    </div>
                </td>
            </tr>
        </table>

            <div style="text-align: center;">
                <h3>Course Details</h3>
            </div>

  <table style="width: 70%; margin-top: 5px; border-top: 1px solid #aaa; border-bottom: 1px solid #aaa;" border="0" cellspacing="0" align="center">
            <tr>
                <th class = "coursetitle">S/N</th>
                <th class = "coursetitle">Course Code</th>
                <th class = "coursetitle">Course Title</th>
                <th class = "coursetitle">Unit</th>
                <th class = "coursetitle">Status</th>
            </tr>
           @foreach($posts as $index =>$post)
                    
           
                        <tr>
                            <td  class = "courses">{{$loop->index+1}} @if($_SERVER['REMOTE_ADDR'] == '41.223.65.6') {{$post->Id}} {{$post->sessionid}} @endif</td>
                            <td  class = "courses">{{$post->CourseCode}}</td>
                            <td  class = "courses">{{$post->CourseTitle}}</td>
                            <td  class = "courses">{{$post->CourseUnit}}</td>
                            <td  class = "courses">{{$post->CourseStatus}}</td>
                           
                               
                            
            
                        </tr>
                    
            @endforeach
        </table>
    
            {{-- <table width="100%">
                <tr>
                    <th width="80%" align="left" nowrap class="auto-style5" style="font-size: small">Total number of units registered : {{$posts->sum('courseunit')}}<br />
                    </th>
                    <th width="20%" align="right" nowrap><span class="auto-style5" style="font-size: small">Date Registered: @if(count($posts)>0) {{$posts[0]->created_at}}@endif </span></th>
              </tr>
            </table> --}}
           
            <br />
  
            <div style="text-align: center; font-weight:bold; font-size:15px;">
                The student whose particulars appears above is hereby cleared to sit for 2023 Modular Year Examination
            </div>
            <table style="width: 70%; margin-top: 5px; border-top: 0px solid #aaa; border-bottom: 0px solid #aaa;" border="0" border-color="black" align="center">
                <tr>
                    <td>
                     <u>For Office Use</u>   
                    </td>
                </tr>
           
  <table style="width: 70%; height:50px; margin-top: 5px; border-top: 1px solid #aaa; border-bottom: 1px solid #aaa;" border="1" border-color="black" align="center">
                <tr>
                    <th align="center" class="auto-style5">
                        Coordinator's Signature/Date
                    </th>
                    <th align="center" valign="bottom" class="auto-style13">
                    </th>
                  
                </tr>
  </table>
  <p style="page-break-before: always"></p>

  <div style="text-align: center; font-weight:bold; font-size:18px;">
    GRADUATION OF OFFENCES IF COMMITTED DURING THE UNIVERSITY EXAMINATION
</div>
<br>
  <table style="width: 70%; height:50px; margin-top: 5px; border-top: 1px solid #aaa; border-bottom: 1px solid #aaa;" border="1" border-color="black" align="center">
                <tr>
                    <th style="width: 3%;">S/N</td>
                    <th style="width: 70%;">Offence</td>
                    <th style="width: 27%;">Senate Decisions (Penalty)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Impersonation (within and outside LASU)</td>
                    <td>Expulsion</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Smuggling question papers out of examination
                        hall for help and returning with answer scripts</td>
                    <td>Expulsion</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Failure to appeal before the Misconduct Panel</td>
                    <td>Suspension for 1 Semester after
                        which non appearances leads to
                        Expulsion</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Being found in Examination Hall with Jottings
                        relevant to the examination (in the locker)</td>
                    <td>Rustication (2 Semesters)</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Physical attack or assault on Invigilators/fellow
                        students </td>
                    <td>Rustication (2 Semesters)</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Coming to examination with prepared answer
                        scripts  </td>
                    <td>Expulsion</td>
                </tr>

                <tr>
                    <td>7</td>
                    <td>Writing relevant materials on palms or any part
                        of the body </td>
                    <td>Rustication (2 Semesters)</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Writing relevant materials on palms or any part
                        of the body </td>
                    <td>Rustication (2 Semesters)</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Exchange of sheets, copying other students or
                        exchange of question papers in Examination Hall </td>
                    <td>Rustication (2 Semesters)</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Failure to submit answer scripts at the end of
                        examination </td>
                    <td>Rustication (1 Semesters)</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Rudeness, insubordination, Disobedience and
                        Disorderly behaviour within the examination hall </td>
                    <td>Rustication (1 Semesters)</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>Failure and or refusal to fill the Examination Misconduct form when apprehended </td>
                    <td>Rustication (1 Semesters)</td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>Use of cell phones in the examination hall </td>
                    <td>Rustication (1 Semesters)</td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>Refusal to submit self for search by an invigilator of same sex  </td>
                    <td>Rustication (1 Semesters)</td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>Being in possession of answer scripts without being authorized </td>
                    <td>Rustication (1 Semesters)</td>
                </tr>
                <tr>
                    <td>15</td>
                    <td>Destruction of evidence </td>
                    <td>Rustication (2 Semesters)</td>
                </tr>
                <tr>
                    <td>16</td>
                    <td>Discussion during examination, consultation, giving information or assistance or soliciting</td>
                    <td>Student will be awarded zero if found culpable by Examination Malpractice Committee</td>
                </tr>
            </table>
</div>
            @endif

            
        </div>
    </div>
            @endsection
