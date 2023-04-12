<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<form id="readonly_form_id" class="form-horizontal">
				<div class="form-group row">
					<label for="username" class="control-label col-sm-3 col-form-label">Username:</label>
					<div class="col-sm-9">
						<input id="username" name="username" type="text" class="form-control" value="{{$user->username}}" readonly>
					</div>
				</div>

				<br>

				<div class="form-group row">
					<label for="email" class="control-label col-sm-3 col-form-label">Email:</label>
					<div class="col-sm-9">
						<input id="email" name="email" type="email" class="form-control" value="{{$user->email}}" readonly>
					</div>
				</div>
				<br />
				<div class="form-group row">
					<label for="email" class="control-label col-sm-3 col-form-label"></label>
					<div class="col-sm-9">
						<button type="button" id="edit" class="btn btn-primary mr-3" onclick="window.location.href='/students/edit';">Edit</button>
						<button type="button" class="btn btn-primary mr-3" onclick="window.location.href='/students/profile/avatar';">Change Avatar</button>
						<button type="button" id="change-password" class="btn btn-primary" onclick="window.location.href='/students/password';">Change Password</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<br>