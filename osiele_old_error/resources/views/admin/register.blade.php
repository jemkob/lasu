@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('invoice') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}" required autofocus>

                                @if ($errors->has('surname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="othertname" class="col-md-4 col-form-label text-md-right">{{ __('Other Name') }}</label>

                            <div class="col-md-6">
                                <input id="othername" type="text" class="form-control{{ $errors->has('othername') ? ' is-invalid' : '' }}" name="othername" value="{{ old('othername') }}" autofocus>

                                @if ($errors->has('othername'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('othername') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                            
                            <div class="col-md-6">
                                <select id="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" value="{{ old('country') }}">
                                <option value="Nigeria">Nigeria</option>
                                <option value="Other">Other</option>
                                </select>

                                @if ($errors->has('country'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('state') }}</label>
                            
                            <div class="col-md-6">
                                <select id="state" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{ old('state') }}">
                                    <option value="Abia">Abia</option>
                                    <option value="Adamawa">Adamawa</option>
                                    <option value="Akwa-Ibom">Akwa-Ibom</option>
                                    <option value="Anambra">Anambra</option>
                                    <option value="Abuja">Abuja</option>
                                    <option value="Bauchi">Bauchi</option>
                                    <option value="Bayelsa">Bayelsa</option>
                                    <option value="Benue">Benue</option>
                                    <option value="Borno">Borno</option>
                                    <option value="Cross River">Cross River</option>
                                    <option value="Delta">Delta</option>
                                    <option value="Ebonyi">Ebonyi</option>
                                    <option value="Edo">Edo</option>
                                    <option value="Ekiti">Ekiti</option>
                                    <option value="Enugu">Enugu</option>
                                    <option value="Gombe">Gombe</option>
                                    <option value="Imo">Imo</option>
                                    <option value="Jigawa">Jigawa</option>
                                    <option value="Kaduna">Kaduna</option>
                                    <option value="Kano">Kano</option>
                                    <option value="Katsina">Katsina</option>
                                    <option value="Kebbi">Kebbi</option>
                                    <option value="Kogi">Kogi</option>
                                    <option value="Kwara">Kwara</option>
                                    <option value="Lagos">Lagos</option>
                                    <option value="Nassarawa">Nassarawa</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Ogun">Ogun</option>
                                    <option value="Ondo">Ondo</option>
                                    <option value="Osun">Osun</option>
                                    <option value="Oyo">Oyo</option>
                                    <option value="Plateau">Plateau</option>
                                    <option value="Rivers">Rivers</option>
                                    <option value="Sokoto">Sokoto</option>
                                    <option value="Taraba">Taraba</option>
                                    <option value="Yobe">Yobe</option>
                                    <option value="Zamfara">Zamfara</option>
                                    <option value="Others">Others</option>
                                </select>

                                @if ($errors->has('state'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lag" class="col-md-4 col-form-label text-md-right">{{ __('LGA') }}</label>

                            <div class="col-md-6">
                                <input id="lga" type="text" class="form-control{{ $errors->has('lga') ? ' is-invalid' : '' }}" name="lga" value="{{ old('lga') }}" required autofocus>

                                @if ($errors->has('lga'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lga') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subjectcomb" class="col-md-4 col-form-label text-md-right">{{ __('Subject Combination') }}</label>
                            
                            <div class="col-md-6">
                                <select id="subjectcomb" class="form-control{{ $errors->has('subjectcomb') ? ' is-invalid' : '' }}" name="state" value="{{ old('subjectcomb') }}">
                        
                            <option value="AGE/AGE">AGE/AGE</option>
                            <option value="ANF/ANF">ANF/ANF</option>
                            <option value="ARB/ISS">ARB/ISS</option>
                            <option value="BED/BED">BED/BED</option>
                            <option value="BIO/CHE">BIO/CHE</option>
                            <option value="BIO/MAT">BIO/MAT</option>
                            <option value="BIO/PHY">BIO/PHY</option>
                            <option value="CHE/MAT">CHE/MAT</option>
                            <option value="CHE/PHY">CHE/PHY</option>
                            <option value="CRS/ENG">CRS/ENG</option>
                            <option value="CRS/POL">CRS/POL</option>
                            <option value="CSC/MAT">CSC/MAT</option>
                            <option value="CSC/PHY">CSC/PHY</option>
                            <option value="ECE/ECE">ECE/ECE</option>
                            <option value="ECO/CRS">ECO/CRS</option>
                            <option value="ECO/MAT">ECO/MAT</option>
                            <option value="ECO/POL">ECO/POL</option>
                            <option value="ENG/ECO">ENG/ECO</option>
                            <option value="ENG/FRE">ENG/FRE</option>
                            <option value="ENG/HAU">ENG/HAU</option>
                            <option value="ENG/IGBO">ENG/IGBO</option>
                            <option value="ENG/MUS">ENG/MUS</option>
                            <option value="ENG/POL">ENG/POL</option>
                            <option value="ENG/SOS">ENG/SOS</option>
                            <option value="ENG/THA">ENG/THA</option>
                            <option value="ENG/YOR">ENG/YOR</option>
                            <option value="FAA/FAA">FAA/FAA</option>
                            <option value="FRE/YOR">FRE/YOR</option>
                            <option value="HEC/HEC">HEC/HEC</option>
                            <option value="ISC/BIO">ISC/BIO</option>
                            <option value="ISC/CHE">ISC/CHE</option>
                            <option value="ISC/CSC">ISC/CSC</option>
                            <option value="ISS/ECO">ISS/ECO</option>
                            <option value="ISS/ENG">ISS/ENG</option>
                            <option value="ISS/POL">ISS/POL</option>
                            <option value="ISS/SOS">ISS/SOS</option>
                            <option value="MUS/CRS">MUS/CRS</option>
                            <option value="MUS/SOS">MUS/SOS</option>
                            <option value="MUS/YOR">MUS/YOR</option>
                            <option value="PED/PED">PED/PED</option>
                            <option value="PHE/PHE">PHE/PHE</option>
                            <option value="PHY/MAT">PHY/MAT</option>
                            <option value="SOS/CRS">SOS/CRS</option>
                            <option value="SOS/FRE">SOS/FRE</option>
                            <option value="SOS/HAU">SOS/HAU</option>
                            <option value="SOS/IGBO">SOS/IGBO</option>
                            <option value="SOS/YOR">SOS/YOR</option>
                            <option value="YOR/HAU">YOR/HAU</option>
                        
                            </select>
                        @if ($errors->has('state'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mailsd Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                                             

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
