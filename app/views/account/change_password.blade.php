@extends("layout.main")
@section('title')
Home @stop
@section('page_title')
Change Password @stop
@section('content')
<form class="login" method="post" action="{{URL::route('change-password-post')}}">
	<div class="field">
		<input  type="password" placeholder='Current Password' name="password"  >
		@if($errors->has('password'))
			{{$errors->first('password')}}
		@endif
	</div>
	<div class="field">
		<input  type="password" placeholder='New Password' name="new_password"  >
		@if($errors->has('new_password'))
			{{$errors->first('new_password')}}
		@endif
	</div>
	<div class="field">
		<input  type="password" placeholder='New Password' name="new_password_again"  >
		@if($errors->has('new_password_again'))
			{{$errors->first('new_password_again')}}
		@endif

	</div>
	<div class="submit">	
			<input type='submit' value="Search">
			{{Form::token()}}
	</div>
	
</form>

@stop