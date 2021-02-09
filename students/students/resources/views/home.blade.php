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
                @if(!empty($details) || !empty(Auth::user()->StudentImage))
                <img class="rounded" src="student_images/{{Auth::user()->StudentImage}}" height="100%" width="100%">
                @elseif(!empty($details->StudentImage))
                <img class="rounded" src="data:image/jpg;base64,{{ chunk_split(base64_encode($details->StudentImage)) }}" height="100%" width="100%">
                @else 
            <img class="rounded" src="student_images/{{Auth::user()->StudentImage}}" height="100%" width="100%">
                @endif

                <div class="row text-center m-t-10">
                        <div class="col-md-12">
                            <strong>Address</strong>
                            <p>
                                <p>{{Auth::user()->StudentAddress}}</p>
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

                        <h3>Programme: <span class="label label-default">({{Auth::user()->Major.'/'.Auth::user()->Minor}})</span></h3>
                        <hr>
                        @if(Auth::user()->Level > 300)
                        <h5>{{Auth::user()->Major}}<span class="pull-right">{{Auth::user()->Level/400 * 100}}%</span></h5>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:{{Auth::user()->Level/400 * 100}}%;"><span class="sr-only">{{Auth::user()->Level/400 * 100}}% Complete</span> </div>
                        </div>
                        <h5>{{Auth::user()->Minor}} <span class="pull-right">{{Auth::user()->Level/400 * 100}}%</span></h5>
                        <div class="progress">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{Auth::user()->Level/400 * 100}}%;"><span class="sr-only">{{Auth::user()->Level/400 * 100}}% Complete</span> </div>
                        </div>
                        <h5>EDU<span class="pull-right">{{Auth::user()->Level/400 * 100}}%</span></h5>
                        
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:{{Auth::user()->Level/400 * 100}}%;"><span class="sr-only">{{Auth::user()->Level/400 * 100}}% Complete</span> </div>
                        </div>
                        <h5>GSE <span class="pull-right">{{Auth::user()->Level/400 * 100}}%</span></h5>
                        <div class="progress">
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: {{Auth::user()->Level/400 * 100}}%;"><span class="sr-only">{{Auth::user()->Level/400 * 100}}% Complete</span> </div>
                        </div>
                        @else
                        <h5>{{Auth::user()->Major}}<span class="pull-right">{{Auth::user()->Level/300 * 100}}%</span></h5>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:{{Auth::user()->Level/300 * 100}}%;"><span class="sr-only">{{Auth::user()->Level/300 * 100}}% Complete</span> </div>
                        </div>
                        <h5>{{Auth::user()->Minor}} <span class="pull-right">{{Auth::user()->Level/300 * 100}}%</span></h5>
                        <div class="progress">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{Auth::user()->Level/300 * 100}}%;"><span class="sr-only">{{Auth::user()->Level/300 * 100}}% Complete</span> </div>
                        </div>
                        <h5>EDU<span class="pull-right">{{Auth::user()->Level/300 * 100}}%</span></h5>
                        
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:{{Auth::user()->Level/300 * 100}}%;"><span class="sr-only">{{Auth::user()->Level/300 * 100}}% Complete</span> </div>
                        </div>
                        <h5>GSE <span class="pull-right">{{Auth::user()->Level/300 * 100}}%</span></h5>
                        <div class="progress">
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: {{Auth::user()->Level/300 * 100}}%;"><span class="sr-only">{{Auth::user()->Level/300 * 100}}% Complete</span> </div>
                        </div>
                        @endif
                        
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

