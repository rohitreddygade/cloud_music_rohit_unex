@extends("layout.main")
@section('title')
Home @stop
@section('page_title')
Forgot Password @stop
@section('content')
<center class="head"><h1>Login</h1></center>
<form class="login" method="post" action="{{URL::route('forgot-password-post')}}">
	<div class="field">
		<input  type="text" placeholder='Email' name="email" {{(Input::old('email') ? 'value="'.e(Input::old('email')).'"' : '')}} >
		@if($errors->has('email'))
			{{$errors->first('email')}}
		@endif
	</div>
	<div class="submit">	
			<input type='submit' value="Search">
			{{Form::token()}}
	</div>
	
</form>

@stop