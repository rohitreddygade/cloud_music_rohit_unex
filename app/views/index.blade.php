@extends("layout.main")
@section('title')
Home @stop
@section('page_title')
Home Page @stop
@section('content')
@if(Auth::check())
	<p>{{'UserName:'}}</p>
@else
	<p>Please Login</p>
@endif
@stop