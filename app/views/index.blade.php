@extends("layout.main")
@section('title')
Home @stop
@section('content')
<center><h1>Home Page</h1></center>

@if(Auth::check())
	<p>{{'UserName:'}}</p>
@else
	<p>Please Login</p>
@endif
@stop