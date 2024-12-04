
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
                    <input class="form-control" placeholder="Surname" name="Surname" type="text" id="Surname" value="{{$showstudent->Surname}}" required disabled>
                </div>

                <div class="form-group">
                        
                    <label for="firstname">First Name</label>
                    <input class="form-control" placeholder="Middle Name" name="firstname" type="text" id="firstname" value="{{$showstudent->Firstname}}" disabled required>
                </div>

                <div class="form-group">
                    <label for="Middlename">Middle Name</label>
                    <input class="form-control" placeholder="Middle Name" name="Middlename" type="text" id="Middlename" value="{{$showstudent->Middlename}}" disabled>
                    
                </div>

                
                {{-- <div class="form-group">
                   
                    <label for="facultyName">School Name</label>
                   
                    <select class="form-control" name="facultys" id="facultys" disabled="disabled">
                            <option value="" disable="true" selected="true">-- Select School --</option>
                            @foreach ($school as $key => $value)
                            <option value="{{$value->FacultyName}}" {{ $value->FacultyName == $showstudent->FacultyName ? 'selected="true"' : "" }}>{{$value->FacultyName}}</option>
                            @endforeach
                        </select>
                </div> --}}


                {{-- <div class="form-group">
                    <label for="SOR">State</label>
                    <input class="form-control" placeholder="State" name="SOR" type="text" id="SOR" value="{{$showstudent->SOR}}">
                </div>

                <div class="form-group">
                    
                    <label for="country">Country</label>
                    <input class="form-control" placeholder="Country" name="country" type="text" id="country" value="{{$showstudent->Nationality}}">
                </div> --}}

               
            </div>
            <div class="col-md-4">

                <div class="form-group">
                    <label for="phonenumber">Phone Number</label>
                <input class="form-control" placeholder="Phone Number" name="phonenumber" type="text" id="phonenumber" value="{{$showstudent->PhoneNumber}}" disabled>
                </div>

                <div class="form-group">
                    <label for="level">Email</label>
                    <input class="form-control" placeholder="Enter your email address" name="email" type="email" id="email" value="{{$showstudent->Email}}" disabled>
                </div>


                
                {{-- <div class="form-group">
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
                </div> --}}
                
                {{-- <div class="form-group">
                    <label for="level">NIN</label>
                    <input class="form-control" placeholder="Enter your NIMC (NIN)" name="nin" type="text"  id="nin" value="{{$showstudent->NIN}}">
                </div> --}}
            </div>
            <div class="col-md-4">

                

                <div class="form-group">
                    <label for="">Gender</label><br />
                    <input disabled type="radio" name="gender" id="genderm" value="Male" {{ strtoupper($showstudent->Gender) === "MALE" ? "checked" : "" }}  /> <label for="genderm">Male</label>
                    <input disabled type="radio" name="gender" id="genderf" value="Female" {{ strtoupper($showstudent->Gender) == "FEMALE" ? "checked" : "" }} /> <label for="genderf">Female</label>
                </div>
                @if($showstudent->Department == 3 || $showstudent->Department == 25 || $showstudent->Department == 26 || $showstudent->Department == 27 || $showstudent->Department == 28 || $showstudent->Department == 29 )
                <div class="form-group">
                    <label for="">EDM Option</label><br />
                    <select class="form-control" name="department" id="" required>
                        <option value="3" disable="true" {{ $showstudent->Department == 3 ? "selected" : "" }}>-- Select EDM Option  --</option>
                        
                        <option value="25" {{ $showstudent->Department == 25 ? "selected" : "" }}>EDM Accounting</option>
                        <option value="26" {{ $showstudent->Department == 26 ? "selected" : "" }}>EDM Business</option>
                        <option value="27" {{ $showstudent->Department == 27 ? "selected" : "" }}>EDM Economics</option>
                        <option value="28" {{ $showstudent->Department == 28 ? "selected" : "" }}>EDM Political Science</option>
                        <option value="29" {{ $showstudent->Department == 29 ? "selected" : "" }}>EDM Geography</option>
                    </select>
                    
                </div>
                @endif
                
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