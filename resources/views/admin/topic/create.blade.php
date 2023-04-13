@extends('layouts.app')

@section('title', 'Create Topic')

@section('content')
<br>

<nav class="head-nav" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item"><a href="/lecture_content">Lecture Content</a></li>
		<li class="breadcrumb-item"><a href="/showModule/{{$module_id}}">Module: {{App\Models\Module::find($module_id)->name}}</a></li>
		<li class="breadcrumb-item active" aria-current="page">Create Topic</li>
	</ol>
</nav>

<br> <br> <br>
<h1 style="text-align: center;">Add Topic</h1>
<hr>

<div class="container" style="margin-bottom:5rem;">

	<br />

	<form method="POST" action="/storeTopic" id="edit_form_id">
		@csrf

		<div class="form-group">
			<label for="name" class="control-label col-sm-2">Name</label>
			<input id="name" name="name" type="text" class="form-control col-sm-10">
			@error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		@if($module_id == 3)
		<div class="form-group">
			<label for="tag" class="control-label col-sm-2">Tag</label>
			<select name="tag" class="form-select" id="tag">
				@php
				$tags = ['', 'Physics', 'Chemistry', 'Biology'];
				@endphp

				@foreach($tags as $tag)
				<option value="{{$tag}}">{{$tag}}</option>
				@endforeach
				<!-- <option selected disabled>Please select one</option> -->
			</select>
			@error('tag') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>
		@else
		<div class="form-group">
			<label for="tag" class="control-label col-sm-2">Tag</label>
			<select name="tag" class="form-select" id="tag" disabled>
				@php
				$tags = ['', 'Physics', 'Chemistry', 'Biology'];
				@endphp

				@foreach($tags as $tag)
				<option value="{{$tag}}">{{$tag}}</option>
				@endforeach
			</select>
			@error('tag') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>
		@endif

		<div class="form-group">
			<label for="module_id" class="control-label col-sm-2">Module</label>
			<select name="module_id" class="form-select" id="module">
				@foreach(App\Models\Module::all() as $module)
				@if ($module->id == $module_id)
				<option value="{{$module->id}}" selected>{{$module->name}}</option>
				@else
				<option value="{{$module->id}}">{{$module->name}}</option>
				@endif
				@endforeach
				<!-- <option selected disabled>Please select one</option> -->
			</select>
			@error('module') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<div class="form-group">
			<label for="image" class="control-label col-sm-2">Image</label><br />
			<input type="file" class="form-control" id="image" placeholder="Image" name="image">
			@error('image') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<br />

		<input type="submit" value="Save" class="btn btn-primary">

		<input type="button" value="Cancel" class="btn btn-primary" onclick="history.back()">

	</form>

	<br />
</div>

<script>
	document.getElementById("edit_form_id").onsubmit = function() {
		console.log(document.getElementById("module").value);
		// return false;
	};
</script>

<style>
	.control-label {
		text-align: left;
	}
</style>
@endsection