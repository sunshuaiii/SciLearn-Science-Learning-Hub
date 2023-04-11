@extends('layouts.app')
 
@section('title', 'Profile')
 
@section('content')

<br/>
<h1>Change Password</h1>

<form method="POST" action="/students/password" id="changePasswordForm" class="form-horizontal">
	@csrf
	@method('PUT') <!-- Form Method Spoofing -->
	<div class="form-group">
		<label for="oldPassword" class="control-label col-sm-2">Old Password</label>
		<input id="oldPassword" name="oldPassword" type="password" class="form-control">
		@error('oldPassword') <div class="alert alert-danger">{{ $message }}</div> @enderror
	</div>

	<div class="form-group">
		<label for="new_password" class="control-label col-sm-2">New Password</label>
		<input id="new_password" name="new_password" type="password" class="form-control">
		@error('new_password') <div class="alert alert-danger">{{ $message }}</div> @enderror
	</div>

	<div class="form-group">
		<label for="new_password_confirmation" class="control-label col-sm-2">Confirm New Password</label>
		<input id="new_password_confirmation" name="new_password_confirmation" type="password" class="form-control">
		@error('new_password_confirmation') <div class="alert alert-danger">{{ $message }}</div> @enderror
	</div>

	<br/>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<input type="submit" value="Save" class="btn btn-primary">
			<input type="button" onclick="history.back()" class="btn btn-primary" value="Cancel">
		</div>
	</div>

</form>
<br/>
@endsection