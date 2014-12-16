@extends("layout.main")
@section('title')
Home @stop
@section('content')
<center><h1>Login</h1></center>
<form class="login" method="post" action="{{URL::route('forgot-password-post')}}">
	<div class="field">
		<input  type="text" placeholder='Email' name="email" {{(Input::old('email') ? 'value="'.e(Input::old('email')).'"' : '')}} >
		@if($errors->has('email'))
			{{$errors->first('email')}}
		@endif
	</div>
	<div class="field">	
			<input type='submit' value="Search">
			{{Form::token()}}
	</div>
	
</form>

@stop