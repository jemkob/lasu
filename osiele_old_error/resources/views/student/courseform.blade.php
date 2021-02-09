
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
                    <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($posts2year->StudentImage)) }}" height="100" width="100"> </td>
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
                <td class="auto-style7">EMAIL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{$posts2year->Email }}</td>
            </tr>
            <tr>
                <td class="auto-style10">PROGRAM&nbsp;&nbsp;&nbsp;&nbsp; {{$posts2year->Major }}/{{$posts2year->Minor }}</td>
                <td class="auto-style7">LEVEL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{$posts2year->Level }}</td>
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
                            
                           
                                @if( $lecturers->where('SubjectID', '=', $post->subjectid)== $post->subjectunit)
                                @foreach($lecturers as $lecturer)
                                
                                <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$lecturer->SubjectID}}</td>
                                
                                @endforeach
                                @else
                                <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">N/A..</td>
                                @endif
                            
            
                        </tr>
                    
            @endforeach
        </table>
    
            <table>
                <tr>
                    <th style="font-size: small" class="auto-style5">Total number of units registered : {{$posts->sum('subjectvalue')}}<br />
                    </th>
                </tr>
                <tr>
                    <th class="auto-style5">&nbsp;</th>
                    <th class="auto-style13">&nbsp;</th>
                    <th class="auto-style14">&nbsp;</th>
    
    
                </tr>
    
    
                <tr>
                    <th class="auto-style3">&nbsp;</th>
    
                    <th class="auto-style5">&nbsp;</th>
                    <th class="auto-style5">&nbsp;</th>
    
                </tr>
            </table>
    
            <p style="page-break-before: always"></p>
    
    
            <div>
                <p>
                    <img alt="" class="auto-style6" src="../images/logo.png" />
                </p>
                <p align="center" style="font-size: x-large">FEDERAL COLLEGE OF EDUCATION, ABEOKUTA</p>
                <p align="center" style="font-size: large">Course Registration Form</p>
                <p align="center" style="font-size: medium">{{$posts2year->sessionyear}} Second Semester</p>
            </div>
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
                                
                               
                                    @if( $lecturers->where('SubjectID', '=', $post2->subjectid)== $post2->subjectunit)
                                    @foreach($lecturers as $lecturer)
                                    
                                    <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">{{$lecturer->SubjectID}}</td>
                                    
                                    @endforeach
                                    @else
                                    <td style="border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; border-left: 1px solid #aaa; border-right: 1px solid #aaa;">N/A..</td>
                                    @endif
                                
                
                            </tr>
                        
                @endforeach
            </table>
    
            <table>
                <tr>
                    <th class="auto-style9">Total number of units registered : {{$posts2->sum('subjectvalue')}}<br />
                    </th>
                </tr>
                <tr>
                    <th class="auto-style5">
                        <span class="auto-style12"><strong>...................................................</strong></span><br class="auto-style8" />
                        <br class="auto-style8" />
                        <span class="auto-style8">H.O.D (EDU) Sign/Date</span><br class="auto-style8" />
                    </th>
                    <th class="auto-style13"><span class="auto-style8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        .......................................................</span><br class="auto-style8" />
                        <br class="auto-style8" />
                        <span class="auto-style8">&nbsp;H.O.D Sign/Date&nbsp;</span><br class="auto-style8" />
                    </th>
                    <th class="auto-style14"><span class="auto-style8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ..................................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                        <br class="auto-style8" />
                        <br class="auto-style8" />
                        <span class="auto-style8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School Officer/Date</span><br class="auto-style8" />
                    </th>
    
    
                </tr>
    
    
                <tr>
                    <th class="auto-style3"><span class="auto-style8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
                        <br />
                        &nbsp;..................................................</span><br class="auto-style8" />
                        <span class="auto-style8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;H.O.D (GSE) Sign/Date</span><br class="auto-style8" />
                        <br />
                        <br />
                    </th>
    
                    <th class="auto-style5"><span class="auto-style8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ..................................................</span><br class="auto-style8" />
                        <br class="auto-style8" />
                        <span class="auto-style8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; H.O.D Sign/Date</span><br class="auto-style8" />
                    </th>
                    <th class="auto-style5"><span class="auto-style8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;..................................................</span><br class="auto-style8" />
                        <br class="auto-style8" />
                        <span class="auto-style8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dean&#39;s Sign/Date&nbsp;&nbsp;&nbsp; </span>
                        <br class="auto-style8" />
                    </th>
    
                </tr>
            </table>
            <hr style="height: -12px" />
    
    