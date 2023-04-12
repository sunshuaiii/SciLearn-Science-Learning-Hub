@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<br>

<nav class="head-nav" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item"><a href="/students/profile">Profile</a></li>
		<li class="breadcrumb-item active" aria-current="page">Leaderboard</li>
	</ol>
</nav>

<br> <br> <br>
<h1 style="text-align: center;">Change Username Or Email</h1>
<hr>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<form method="POST" action="/students" id="edit_form_id" class="form-horizontal">
				@csrf
				@method('PUT') <!-- Form Method Spoofing -->

				<div class="form-group row">
					<label for="username" class="control-label col-sm-3 col-form-label">Username:</label>
					<div class="col-sm-9">
						<input id="username" name="username" type="text" class="form-control col-sm-10" value="{{$user->username}}">
						@error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
					</div>
				</div>

				<br>

				<div class="form-group row">
					<label for="email" class="control-label col-sm-3 col-form-label">Email:</label>
					<div class="col-sm-9">
						<input id="email" name="email" type="email" class="form-control col-sm-10" value="{{$user->email}}">
						@error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
					</div>
				</div>

				<br>

				<div class="form-group row">
					<label for="email" class="control-label col-sm-3 col-form-label"></label>
					<div class="col-sm-9">
						<input type="submit" value="Save" class="btn btn-primary">
						<input type="button" onclick="history.back()" value="Cancel" class="btn btn-primary">
					</div>
				</div>
			</form>
		</div>

	</div>
</div>

<br>
@endsection