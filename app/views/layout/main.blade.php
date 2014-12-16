<!DOCTYPE html>
<html>
	<head>
		<title>@yield('title')</title>
		{{ HTML::style('assets/css/main.css') }}
	</head>
	<body>
		
		<nav class="wrapper">
			@include('layout.nav')
		</nav>
				@if(Session::has('global'))
			<p id="global"> {{Session::get('global')}}</p>
		@endif
		
		<div class="content">
				@yield('content')
		</div>
	</body>
</html>