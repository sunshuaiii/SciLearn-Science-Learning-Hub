<!-- Show the form for creating a new resource. -->

@extends('layouts.app')

@section('title', $role == 'admin' ? 'Admin Register' : 'Register')

@section('content')
<br>

<nav class="head-nav" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Register</li>
	</ol>
</nav>

<br> <br> <br>
<h1 style="text-align: center;">{{$role == 'admin' ? 'Admin Register' : 'Register'}}</h1>
<hr>

<br>
<div class="container mt-3">
	<form method="POST" action="{{'/register/'.$role}}" id="form_id" class="form-horizontal">
		@csrf
		<div class="mb-3 mt-3">
			<label for="username">Username</label>
			<input id="username" name="username" type="text" class="form-control col-sm-10" placeholder="Enter username" value="{{ old('username') }}">
			@error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<div class="mb-3 mt-3">
			<label for="email">Email</label>
			<input id="email" name="email" type="email" class="form-control col-sm-10" placeholder="Enter email" value="{{ old('email') }}">
			@error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<div class="mb-3">
			<label for="password">Password</label>
			<div class="input-group">
				<input type="password" class="form-control col-sm-10" id="password" placeholder="Enter password" name="password">
				<div class="input-group-append">
					<div class="input-group-text">
						<input type="checkbox" onclick="showPassword()"> Show Password
					</div>
				</div>
			</div>
			@error('password') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<div class="mb-3">
			<label for="password_confirmation">Password</label>
			<div class="input-group">
				<input type="password" class="form-control col-sm-10" id="password_confirmation" placeholder="Confirm password" name="password_confirmation">
				<div class="input-group-append">
					<div class="input-group-text">
						<input type="checkbox" onclick="showPasswordConfirmation()"> Show Password
					</div>
				</div>
			</div>
			@error('password_confirmation') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<input type='hidden' id='role' name='role' value='{{$role}}'>

		<br>

		<button type="submit" class="btn btn-primary">Register</button>

		<br> <br>
		<a href="{{'/login/'.$role}}">Already have an account? Sign in now!</a>
		<br> <br>
	</form>
</div>

<script>
	document.getElementById("form_id").onsubmit = function() {
		console.log(document.getElementById("role").value + " " + document.getElementById("email").value + " " + document.getElementById("password").value);
	};
</script>

<script>
    function showPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

	function showPasswordConfirmation() {
		var y = document.getElementById("password_confirmation");
        if (y.type === "password") {
			y.type = "text";
        } else {
			y.type = "password";
        }
    }
</script>

@endsection