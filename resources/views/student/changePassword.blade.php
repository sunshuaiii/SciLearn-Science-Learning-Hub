@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<br>

<nav class="head-nav" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item"><a href="/students/profile">Profile</a></li>
		<li class="breadcrumb-item active" aria-current="page">Change Password</li>
	</ol>
</nav>

<br> <br> <br>
<h1 style="text-align: center;">Change Password</h1>
<hr>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<form method="POST" action="/students/password" id="changePasswordForm" class="form-horizontal">
				@csrf
				@method('PUT') <!-- Form Method Spoofing -->
				<div class="form-group row">
					<label for="oldPassword" class="control-label col-sm-2">Old Password</label>
					<div class="col-sm-9">
						<input id="oldPassword" name="oldPassword" type="password" class="form-control">
						@error('oldPassword') <div class="alert alert-danger">{{ $message }}</div> @enderror
					</div>
				</div>

				<br>

				<div class="form-group row">
					<label for="new_password" class="control-label col-sm-2">New Password</label>
					<div class="col-sm-9">
						<input id="new_password" name="new_password" type="password" class="form-control">
						@error('new_password') <div class="alert alert-danger">{{ $message }}</div> @enderror
					</div>
				</div>

				<br>

				<div class="form-group row">
					<label for="new_password_confirmation" class="control-label col-sm-2">Confirm New Password</label>
					<div class="col-sm-9">
						<input id="new_password_confirmation" name="new_password_confirmation" type="password" class="form-control">
						@error('new_password_confirmation') <div class="alert alert-danger">{{ $message }}</div> @enderror
					</div>
				</div>

				<br>

				<div class="form-group row">
					<label for="new_password_confirmation" class="control-label col-sm-2"></label>
					<div class="col-sm-9">
						<input type="submit" value="Save" class="btn btn-primary">
						<input type="button" onclick="history.back()" class="btn btn-primary" value="Cancel">
					</div>
				</div>

			</form>
		</div>
	</div>
</div>

<br />

@endsection