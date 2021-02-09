@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Student Manager</h3>
  </div>
    <div class="box-body">


        Hi there
        @if(count($users) > 1)
         @foreach($users as $user)

         <a href ="studentmanager/{{$user->StudentID}}">{{$user->Firstname}} {{$user->Surname}}</a> <br>

         @endforeach

         @else

         no one

         @endif
          

    </div>

</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection