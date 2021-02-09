
@extends('adminlte::page')

@section('content')
{{-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> --}}
<script src="{{asset('jscss/jquery.min.frs.js')}}"></script>
<script src="{{asset('jscss/bootstrap.min.js')}}"></script>
<script src="{{asset('jscss/moment.min.js')}}"></script>
<script src="{{asset('jscss/daterangepicker.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('jscss/daterangepicker.css')}}" />

<script type="text/javascript">
function Validate()
{
     var resultfile =document.getElementById("imagefile").value;
     if(resultfile!='')
     {
           var checkimg = imagefile.toLowerCase();
          if (!checkimg.match(/(\.jpg|\.png|\.jpeg)$/)){ // validation of file extension using regular expression before file upload
              document.getElementById("imagefile").focus();
              document.getElementById("errorName5").innerHTML="Wrong file selected"; 
              return false;
           }
           document.getElementById("errorName5").innerHTML=""; 
        return true;
      }
}
</script>


<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Student Manager</h3>
  </div>
    <div class="box-body">
        
        <form action="{{url('student/updateinfo')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
        <div class="row">
            <div class="col-md-4">
                
                <div class="form-group">
                        
                        <label for="surname">Surname</label>
                    <input class="form-control" placeholder="Surname" name="Surname" type="text" id="Surname" value="{{$showstudent->Surname}}">
                </div>

                <div class="form-group">
                        
                    <label for="firstname">First Name</label>
                    <input class="form-control" placeholder="Middle Name" name="firstname" type="text" id="firstname" value="{{$showstudent->Firstname}}">
                </div>

                <div class="form-group">
                    <label for="Middlename">Middle Name</label>
                    <input class="form-control" placeholder="Middle Name" name="Middlename" type="text" id="Middlename" value="{{$showstudent->Middlename}}">
                    
                </div>

                
                <div class="form-group">
                   
                    <label for="facultyName">School Name</label>
                   
                    <select class="form-control" name="facultys" id="facultys" disabled="disabled">
                            <option value="" disable="true" selected="true">-- Select School --</option>
                            @foreach ($school as $key => $value)
                            <option value="{{$value->FacultyName}}" {{ $value->FacultyName == $showstudent->FacultyName ? 'selected="true"' : "" }}>{{$value->FacultyName}}</option>
                            @endforeach
                        </select>
                </div>


                <div class="form-group">
                    <label for="SOR">State</label>
                    <input class="form-control" placeholder="State" name="SOR" type="text" id="SOR" value="{{$showstudent->SOR}}">
                </div>

                <div class="form-group">
                    
                    <label for="country">Country</label>
                    <input class="form-control" placeholder="Country" name="country" type="text" id="country" value="{{$showstudent->Nationality}}">
                </div>

                <div class="form-group">
                    <label for="sponsorsname">Sponsors Name</label>
                    <input class="form-control" placeholder="sponsorsname" name="sponsorsname" type="text" id="sponsorsname" value="{{$showstudent->SponsorsName}}">
                </div>

                <div class="form-group">
                    <label for="sponsorsaddress">Sponsors Address</label>
                    <input class="form-control" placeholder="Sponsors Address" name="sponsorsaddress" type="text" id="sponsorsaddress" value="{{$showstudent->SponsorsAddress}}">
                </div>

                <div class="form-group">
                    <label for="sponsorsphonenumber">Sponsors Phone Number</label>
                    <input class="form-control" placeholder="Sponsors Address" name="sponsorsphonenumber" type="text" id="sponsorsphonenumber" value="{{$showstudent->SponsorsPhoneNumber}}">
                </div>
            </div>
            <div class="col-md-4">
                
                <div class="form-group">
                    <label for="JambRegNo">Jamb Reg No</label>
                    <input class="form-control" placeholder="Jamb Reg No" name="JambRegNo" type="text" id="JambRegNo" value="{{$showstudent->JambRegNo}}">
                </div>

                <div class="form-group">
                    <label for="phonenumber">Phone Number</label>
                <input class="form-control" placeholder="Phone Number" name="phonenumber" type="text" id="phonenumber" value="{{$showstudent->PhoneNumber}}">
                </div>

                <div class="form-group">
                    <label for="level">Level</label>
                    <input class="form-control" placeholder="Level" name="level" type="text" id="level" value="{{$showstudent->Level}}">
                </div>

                <div class="form-group">
                    <label for="Middlename">Phone Number (Next Of Kin)</label>
                    <input class="form-control" placeholder="Phone Number (Next Of Kin)" name="phonenumbernextofkin" type="text" id="phonenumbernextofkin" value="{{$showstudent->PhoneNumberNextOfKin}}">
                </div>

                <div class="form-group">
                    <label for="maritalstatus">Marital Status</label>
                    <input class="form-control" placeholder="Marital Status" name="maritalstatus" type="text" id="maritalstatus" value="{{$showstudent->MaritalStatus}}">
                </div>

                <div class="form-group">
                    <label for="maritalstatus">Date Of Birth</label>
                    <input class="form-control" placeholder="Date Of Birth" name="dateofbirth" type="text" id="dateofbirth" value="{{$showstudent->DateOfBirth}}">
                    <script>
                            $(function() {
                              $('input[name="dateofbirth"]').daterangepicker({
                                singleDatePicker: true,
                                showDropdowns: true,
                                minYear: 1901,
                                maxYear: parseInt(moment().format('YYYY'),10)
                              }, function(start, end, label) {
                                var years = moment().diff(start, 'years');
                                alert("You are " + years + " years old!");
                              });
                            });
                    </script>
                </div>

                <div class="form-group">
                    <label for="placeofbirth">Place Of Birth</label>
                    <input class="form-control" placeholder="Place Of Birth" name="placeofbirth" type="text" id="placeofbirth" value="{{$showstudent->PlaceOfBirth}}">
                </div>

                <div class="form-group">
                    <label for="salutation">Salutation</label>
                    <input class="form-control" placeholder="Salutation" name="salutation" type="text" id="salutation" value="{{$showstudent->Salution}}">
                </div>
                
            </div>
            <div class="col-md-4">

                <div class="form-group">
                    <label for="religion">Programme (Subject Combination)</label>
                    <select class="form-control" name="combination" id="combination">
                        <option value="0" disable="true" selected="true">-- Select Combination --</option>
                        @foreach ($program as $key => $value)
                        <option value="{{$value->SubjectCombinName}}" {{ $value->SubjectCombinName == $showstudent->Major.'/'.$showstudent->Minor ? 'selected="true"' : "" }}>{{$value->SubjectCombinName}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Gender</label><br />
                    <input type="radio" name="gender" id="genderm" value="Male" {{ strtoupper($showstudent->Gender) === "MALE" ? "checked" : "" }} /> <label for="genderm">Male</label>
                    <input type="radio" name="gender" id="genderf" value="Female" {{ strtoupper($showstudent->Gender) == "FEMALE" ? "checked" : "" }} /> <label for="genderf">Female</label>
                </div>
                

                <div class="form-group">
                    <label for="religion">Religion</label>
                    <input class="form-control" placeholder="Religion" name="religion" type="text" id="religion" value="{{$showstudent->Religion}}">
                </div>

                <div class="form-group">
                    <label for="homeaddress">Home Address</label>
                    
                    <textarea class="form-control" name="homeaddress" id="homeaddress" rows="3" placeholder="Home Address">{{$showstudent->HomeAddress}}</textarea>
                </div>

                @if (isset($images->StudentImage))
                <div class="form-group">
                    <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($images->StudentImage)) }}"  width="200" height="150">
                </div>
                @endif
                <div class="form-group">
                    <span id="errorName5" style="color: red;"></span>
                  <input type="file" name="imagefile" id="imagefile" onchange="return Validate(); this.value=null;return false;"/>
                </div>
                <input type="hidden" name="studentid" value="{{$showstudent->StudentID}}">
                
                <div class="form-group">
                
               
                <button type="submit" class="btn btn-success">Update Information</button>
                </div>
                
            </div>
            

        </div>
        </form>

    </div>

</div>


@endsection