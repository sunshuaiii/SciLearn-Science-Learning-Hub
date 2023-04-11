@extends('layouts.app')
 
@section('title', 'Profile')
 
@section('content')

<br/>
<h1>Change Username Or Email</h1>

<form method="POST" action="/students" id="edit_form_id" class="form-horizontal">
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
			<input type="button" onclick="history.back()" value="Cancel" class="btn btn-primary">
		</div>
	</div>
</form>
<br/>
@endsection