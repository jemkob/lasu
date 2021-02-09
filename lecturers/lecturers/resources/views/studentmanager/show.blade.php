@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Student Manager</h3>
  </div>
    <div class="box-body">


        Hi there
        {{$showstudent->Surname}}
        

    </div>

</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection