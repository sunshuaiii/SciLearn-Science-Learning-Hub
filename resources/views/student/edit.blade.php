<form id="readonly_form_id" class="form-horizontal">
	<div class="form-group row">
		<label for="username" class="control-label col-sm-2">Username</label>
		<input id="username" name="username" type="text" class="form-control col-sm-10" value="{{$user->username}}" readonly>
	</div>

	<div class="form-group row">
		<label for="email" class="control-label col-sm-2">Email</label>
		<input id="email" name="email" type="email" class="form-control col-sm-10" value="{{$user->email}}" readonly>
	</div>
	<br/>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<input type="button" id="edit" value="Edit" class="btn btn-primary"
				onclick="window.location.href='/students/edit';">
		</div>
	</div>
</form>

<br/><br/>

<div class="col-sm-offset-2 col-sm-10">
	<button class="btn btn-primary" onclick="window.location.href='/students/profile/avatar';">Change Avatar</button>
	<button id="change password" class="btn btn-primary"
	onclick="window.location.href='/students/password';">
		Change Password</button>
</div>
<br>