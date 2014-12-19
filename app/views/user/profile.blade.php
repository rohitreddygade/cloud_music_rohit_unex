@extends("layout.main")
@section('title')
Home @stop
@section('page_title')
Profile @stop
@section('content')
<h3>
Name: {{$user->username}}<br>

Email: {{$user->email}}<br>

Last Updated: {{$user->created_at}}<br>

Account Created: {{$user->updated_at}}<br>
</h3>
@stop