<!DOCTYPE html>
<html>
	<head>
		<title>@yield('title')</title>
		{{ HTML::style('assets/css/main.css') }}
	</head>
	<body>
		<nav class="wrapper">
			@include('layout.nav')
		</nav><br>
				@if(Session::has('global'))<br>
			<p id="global"> {{Session::get('global')}}</p>
		@endif
		<h1 class="page_title">@yield('page_title')</h1>
		<div class="content">
				@yield('content')
		</div>
	</body>
</html>