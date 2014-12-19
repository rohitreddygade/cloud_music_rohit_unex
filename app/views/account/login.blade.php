@extends("layout.main")
@section('title')
Home @stop
@section('page_title')
Login @stop
@section('content')
<form class="login" method="post" action="{{URL::route('login-post')}}">
	<div class="field">
		<input  type="text" placeholder='Email' name="email" {{(Input::old('email') ? 'value="'.e(Input::old('email')).'"' : '')}} >
		@if($errors->has('email'))
			{{$errors->first('email')}}
		@endif
	</div>
	<div class="field">
		<input type='password' name='password' placeholder='Password'>
		@if($errors->has('password'))
			{{$errors->first('password')}}
		@endif
	</div>
	<div class="submit">	
			<input type='submit' value="login">
			{{Form::token()}}
	</div>
	<div class="field">
			<input type="checkbox" name='remember' id="remember" checked="checked" >
			<label for='remember'>Keep me logged in</label>
	</div>
	<a href="{{URL::route('forgot-password')}}">forgot your password</a><br>
</form>

@stop