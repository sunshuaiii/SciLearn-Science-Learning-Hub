<form method="POST" action="/student" id="edit_form_id" class="form-horizontal">
	@csrf
	@method('PUT') <!-- Form Method Spoofing -->

	<div class="form-group row">
		<label for="username" class="control-label col-sm-2">Username</label>
		<input id="username" name="username" type="text" class="form-control col-sm-10" value="{{$user->username}}">
		@error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
	</div>

	<div class="form-group row">
		<label for="email" class="control-label col-sm-2">Email</label>
		<input id="email" name="email" type="email" class="form-control col-sm-10" value="{{$user->email}}">
		@error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
	</div>
	<br/>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<input type="submit" value="Save" class="btn btn-primary">
			<input type="button" id="reload" value="Cancel" class="btn btn-primary">
		</div>
	</div>
</form>
<br/>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<button id="change password" class="btn btn-primary">Change Password</button>
	</div>
</div>

<form method="POST" action="/student/password" id="changePasswordForm" class="form-horizontal" style="display:none">
	@csrf
	@method('PUT') <!-- Form Method Spoofing -->
	<div class="form-group">
		<label for="oldPassword" class="control-label col-sm-2">Old Password</label>
		<input id="oldPssword" name="oldPassword" type="password" class="form-control">
		@error('oldPassword') <div class="alert alert-danger">{{ $message }}</div> @enderror
	</div>

	<div class="form-group">
		<label for="new_password" class="control-label col-sm-2">New Password</label>
		<input id="new_password" name="new_password" type="password" class="form-control">
		@error('password') <div class="alert alert-danger">{{ $message }}</div> @enderror
	</div>

	<div class="form-group">
		<label for="new_password_confirmation" class="control-label col-sm-2">Confirm New Password</label>
		<input id="new_password_confirmation" name="new_password_confirmation" type="password" class="form-control">
		@error('password_confirmation') <div class="alert alert-danger">{{ $message }}</div> @enderror
	</div>

	
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
	<input type="submit" value="Save" class="btn btn-primary">
	<button id="cancel change password" class="btn btn-primary">Cancel</button>
	</div>
</div>

</form>

<script>
	document.getElementById("reload").onclick = function() {
		location.reload();
	};
	
	document.getElementById("change password").onclick = function() {
		const changePasswordForm = document.getElementById("changePasswordForm");
		if (changePasswordForm.style.display === "none")
		changePasswordForm.style.display = "block";
		else
		changePasswordForm.style.display = "none";
	};
	document.getElementById("cancel change password").onclick = function() {
		const changePasswordForm = document.getElementById("changePasswordForm");
		if (changePasswordForm.style.display === "none")
		changePasswordForm.style.display = "block";
		else
		changePasswordForm.style.display = "none";
	};
</script>
