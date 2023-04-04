@extends('layouts.app')
 
@section('title', $role == 'admin' ? 'Admin Login' : 'Login')
 
@section('content')
	<div class="container mt-3">
		<h2>Login</h2>
		<form method="POST" action="/login">
			@csrf
			<div class="mb-3 mt-3">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ old('email') }}">
				@error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
			</div>
			<div class="mb-3">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
				@error('password') <div class="alert alert-danger">{{ $message }}</div>	@enderror
			</div>
			<div class="form-check mb-3">
				<label class="form-check-label">
					<input class="form-check-input" type="checkbox" name="remember" value="{{ old('remember') }}"> Remember me
				</label>
			</div>

			<input type='hidden' name='role' value='{{$role}}'>

			<!-- @error('login failed') <div class="alert alert-danger">{{ $message }}</div>	@enderror -->
			<button type="submit" class="btn btn-primary">Login</button>
		</form>
	</div>

	<a href="{{'/register/'.$role}}">Register</a>
@endsection