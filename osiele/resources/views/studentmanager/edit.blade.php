
@extends('adminlte::page')

@section('content')
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
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
        ...
        @if(!empty($pin))
        <h3>Pin: {{$pin->pinkey}}</h3>
        @endif
        
        {!! Form::open(['action'=> ['StudentManagerController@update', $showstudent->StudentID], 'method' => 'POST', 'files' => true]) !!}

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {{Form::label('matricno', 'Matric No')}}
                    {{Form::text('MatricNo', $showstudent->MatricNo, ['class' => 'form-control', 'placeholder'=>'Matric No'])}}
                </div>
                <div class="form-group">
                    {{Form::label('admissioncode', 'Admission Code')}}
                <input type="text" name="MatricNo" value="{{$showstudent->AdmissionCode}}" id="" class="form-control">
                </div>

                <div class="form-group">
                        {{Form::label('surname', 'Surname')}}
                        {{Form::text('Surname', $showstudent->Surname, ['class' => 'form-control', 'placeholder'=>'Surname'])}}
                </div>

                <div class="form-group">
                        {{Form::label('firstname', 'First Name')}}
                        {{Form::text('firstname', $showstudent->Firstname, ['class' => 'form-control', 'placeholder'=>'Surname'])}}
                </div>

                <div class="form-group">
                    {{Form::label('Middlename', 'Middle Name')}}
                    {{Form::text('Middlename', $showstudent->Middlename, ['class' => 'form-control', 'placeholder'=>'MiddleName'])}}
                </div>

                


                {{-- <div class="form-group">
                    {{Form::label('SOR', 'State')}}
                    {{Form::text('SOR', $showstudent->SOR, ['class' => 'form-control', 'placeholder'=>'State'])}}
                </div> --}}

                {{-- <div class="form-group">
                    {{Form::label('country', 'Country')}}
                    {{Form::text('country', $showstudent->Nationality, ['class' => 'form-control', 'placeholder'=>'Country'])}}
                </div> --}}
            </div>
            <div class="col-md-4">
                
                {{-- <div class="form-group">
                    {{Form::label('Jambregno', 'Jamb Registration No.')}}
                    {{Form::text('JambRegNo', $showstudent->JambRegNo, ['class' => 'form-control', 'placeholder'=>'Jamb Reg No'])}}
                </div> --}}

                <div class="form-group">
                    <label for="phonenumber">Phone Number</label>
                <input class="form-control" placeholder="Phone Number" name="phonenumber" type="text" id="phonenumber" value="{{$showstudent->PhoneNumber}}">
                </div>

                <div class="form-group">
                    <label for="phonenumber">Sponsor Phone Number</label>
                <input class="form-control" placeholder="sPhone Number" name="sphonenumber" type="text" id="sphonenumber" value="{{$showstudent->SponsorsPhoneNumber}}">
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
                    <label for="religion">Departmment</label>
                    <select class="form-control" name="combination" id="combination">
                        <option value="0" disable="true" selected="true">-- Select Department --</option>
                        @foreach ($program as $key => $value)
                        <option value="{{$value->DepartmentID}}" {{ $value->DepartmentID == $showstudent->Department ? 'selected="true"' : "" }}>{{$value->DepartmentName}}</option>
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

                {{-- @if (isset($images->StudentImage))
                <div class="form-group">
                    <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($images->StudentImage)) }}"  width="200" height="150">
                </div>
                @endif --}}
                <div class="form-group">
                    <span id="errorName5" style="color: red;"></span>
                  <input type="file" name="imagefile" id="imagefile" onchange="return Validate(); this.value=null;return false;"/>
                </div>
                <input type="hidden" name="studentid" value="{{$showstudent->StudentID}}">
                
                <div class="form-group">
                {{ Form::hidden('_method', 'PUT') }}
                {{Form::submit('Submit', ['class'=>'btn btn-success'])}}
                </div>
                
            </div>
            
                {!! Form::close() !!}

        </div>

    </div>

</div>
@endsection