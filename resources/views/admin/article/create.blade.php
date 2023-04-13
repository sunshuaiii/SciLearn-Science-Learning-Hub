@extends('layouts.app')

@section('title', 'Create Article')

@section('content')
<br>

<nav class="head-nav" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item"><a href="/lecture_content">Lecture Content</a></li>
		<li class="breadcrumb-item"><a href="/showModule/{{$module_id}}">Module: {{App\Models\Module::find($module_id)->name}}</a></li>
		<li class="breadcrumb-item"><a href="/showTopic/{{$topic_id}}">Topic: {{App\Models\Topic::find($topic_id)->name}}</a></li>
		<li class="breadcrumb-item active" aria-current="page">Create Article</a></li>
	</ol>
</nav>

<br> <br> <br>
<h1 style="text-align: center;">Create Article</h1>
<hr>

<div class="container" style="margin-bottom:5rem;">

	<br />

	<form method="POST" action="/storeArticle" id="edit_form_id">
		@csrf

		<div class="form-group">
			<label for="title" class="control-label col-sm-2">Title</label>
			<input id="title" name="title" type="text" class="form-control col-sm-10">
			@error('title') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<div class="form-group">
			<label for="content" class="control-label col-sm-2">Article Content</label>
			<input id="content" name="content" type="text" class="form-control col-sm-10">
			@error('content') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<div class="form-group">
			<label for="topic_id" class="control-label col-sm-2">Topic</label>
			<select name="topic_id" class="form-select" id="topic">
				@foreach(App\Models\Topic::all() as $topic)
				@if ($topic->id == $topic_id)
				<option value="{{$topic->id}}" selected>{{$topic->name}}</option>
				@else
				<option value="{{$topic->id}}">{{$topic->name}}</option>
				@endif
				@endforeach
				<!-- <option selected disabled>Please select one</option> -->
			</select>
			@error('topic') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<div class="form-group">
			<label for="image" class="control-label col-sm-2">New Image Path</label><br />
			<input id="image" name="image" type="text" class="form-control col-sm-10">
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
		console.log(document.getElementById("topic").value);
		// return false;
	};
</script>

<style>
	.control-label {
		text-align: left;
	}
</style>
@endsection