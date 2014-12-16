@extends('layout.main')

@section('title')
Create Account @stop

@section('content')
	<center><h1>Create Account</h1></center>
	<form action="{{URL::route('account-create-post')}}" method="post">
		<div class="sinup">

			<div class="field">
				<input type="text" name="email" placeholder='Email'{{(Input::old('email') ? 'value="'.e(Input::old('email')).'"' : '')}}>
				@if($errors->has('email'))
					{{$errors->first('email')}}
				@endif
			</div>

			<div class="field">
				<input type="text" name="username" placeholder='Username' {{(Input::old('username') ? 'value="'.e(Input::old('username')).'"' : '')}} >
				@if($errors->has('username'))
					{{$errors->first('username')}}
				@endif
			</div>

			<div class="field">
				<input type="password" name="password" placeholder='Password'>
				@if($errors->has('password'))
					{{$errors->first('password')}}
				@endif
			</div>

			<div class="field">
				<input type="password" name="password_again" placeholder='Password'>
				@if($errors->has('password_again'))
					{{$errors->first('password_again')}}
				@endif

			</div>
			<div class="field">
				<input type='submit' value="Create">
				{{Form::token()}}
			</div>

		</div>
	</form>
@stop