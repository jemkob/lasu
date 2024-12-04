@extends('adminlte::page')





@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Result Viewer</h3>
  </div>
    <div class="box-body">
    


   @if (count($results) === 0)
... html showing no articles found
@elseif (count($results) >= 1)
... print out results
    @foreach($results as $article)
    print article
    @endforeach
@endif


    </div>

</div>
@endsection
