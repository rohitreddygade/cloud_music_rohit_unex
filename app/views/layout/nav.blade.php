<ul class="navbar">
	<li><a href="{{URL::route('index')}}">Home</a>&nbsp; &nbsp; </li>
	@if(Auth::check())
		<!--SinIn-->
		<li><a href="{{URL::route('logout')}}">Logout&nbsp; &nbsp; </a></li>
		<li><a href="{{URL::route('change_password')}}">Change password&nbsp; &nbsp; </a></li>
	@else
		<!--NotSinIn-->
		<li><a href="{{URL::route('login')}}">Login&nbsp; &nbsp; </a></li>
		<li><a href="{{URL::route('account-create')}}">Create Account&nbsp; &nbsp; </a></li>
	@endif
</ul>