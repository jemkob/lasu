@extends('adminlte::page')

@section('title', 'Student Dashboard')

@section('content')
<div class="box">
<div class="box-header with-border">
    <h2 class="box-title">Dashboard</h2>
</div>
    <div class="box-body">
        <div class="row box-body">
            <div class="col-md-4 thumbnail">
                @if(!empty($details))
                <img class="img-circle" src="data:image/jpg;base64,{{ chunk_split(base64_encode($details->StudentImage)) }}" height="100%" width="100%">
                @else 
                <img class="img-circle" src="" height="100%" width="100%">
                @endif
                <img src="https://placehold.co/600x400?text={{Auth::user()->Surname}}\n {{Auth::user()->Firstname}}" alt="">

                <div class="row text-center m-t-10">
                        <div class="col-md-12">
                            {{-- <strong>Address</strong> --}}
                            <p>
                                <p></p>
                                <br />
                                <p>{{Auth::user()->HomeAddress}}</p>
                                <br />
                                <p>{{Auth::user()->SponsorsAddress}}</p>
                            </p>
                        </div>
                    </div>
            </div>
            <div class="col-md-8">
                <div class="white-box">
                        <div class="row">
                            <div class="col-md-4 col-xs-6 b-r">
                                <strong>Full Name</strong>
                                <br>
                                <p class="text-muted">{{Auth::user()->Surname.' '.Auth::user()->Firstname.' '.Auth::user()->Middlename}}</p>
                            </div>
                            <div class="col-md-4 col-xs-6 b-r">
                                <strong>Mobile</strong>
                                <br>
                                <p class="text-muted">{{Auth::user()->PhoneNumber}}</p>

                            </div>
                            <div class="col-md-4 col-xs-6 b-r">
                                <strong>Email</strong>
                                <br>
                                <p class="text-muted">{{Auth::user()->Email}}</p>
                            </div>
                        </div>
                        <hr>

                        <h3>Matric No: <span class="label label-warning">{{Auth::user()->MatricNo}}</span></h3>
                        <hr>

                        <h3>Current Level: <span class="label label-warning">{{Auth::user()->Level}} Level</span></h3>
                        <hr>

                        <h3>Programme: <span class="label label-default">({{$department->DepartmentName}})</span></h3>
                        <hr>
                        
                        
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

