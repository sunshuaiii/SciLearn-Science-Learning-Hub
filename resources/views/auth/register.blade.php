<!-- Show the form for creating a new resource. -->

@extends('layouts.app')

@section('title', $role == 'admin' ? 'Admin Register' : 'Register')

@section('content')
<br>
<h1>{{$role == 'admin' ? 'Admin Register' : 'Register'}}</h1>
<br>
<form method="POST" action="{{'/register/'.$role}}" id="form_id" class="form-horizontal">
	@csrf
	<div class="form-group">
		<label for="username" class="control-label col-sm-2">Username</label>
		<input id="username" name="username" type="text" class="form-control col-sm-10" value="{{ old('username') }}">
		@error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
	</div>

	<div class="form-group">
		<label for="email" class="control-label col-sm-2">Email</label>
		<input id="email" name="email" type="email" class="form-control col-sm-10" value="{{ old('email') }}">
		@error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
	</div>

	<div class="form-group">
		<label for="password" class="control-label col-sm-2">Password</label>
		<input id="password" name="password" type="password" class="form-control">
		@error('password') <div class="alert alert-danger">{{ $message }}</div> @enderror
	</div>

	<div class="form-group">
		<label for="password_confirmation" class="control-label col-sm-2">Confirm Password</label>
		<input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
		@error('password_confirmation') <div class="alert alert-danger">{{ $message }}</div> @enderror
	</div>

	<input type='hidden' id='role' name='role' value='{{$role}}'>
	<br>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<input type="submit" value="Register" class="btn btn-primary">
		</div>
	</div>
	<br>
	<a href="{{'/login/'.$role}}">Already have an account? Sign in now!</a>
	<br> <br>
</form>


<script>
	document.getElementById("form_id").onsubmit = function() {
		console.log(document.getElementById("role").value + " " + document.getElementById("email").value + " " + document.getElementById("password").value);
	};
</script>
@endsection