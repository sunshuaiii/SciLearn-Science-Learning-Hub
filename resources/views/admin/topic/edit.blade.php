@extends('layouts.app')

@section('title', 'Edit Topic')

@section('content')
<br>

<nav class="head-nav" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item"><a href="/lecture_content">Lecture Content</a></li>
		<li class="breadcrumb-item"><a href="/showModule/{{$module_id}}">Module: {{App\Models\Module::find($module_id)->name}}</a></li>
		<li class="breadcrumb-item"><a href="/showTopic/{{$topic->id}}">Topic: {{$topic->name}}</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit Topic</li>
	</ol>
</nav>

<br> <br> <br>
<h1 style="text-align: center;">Edit Topic</h1>
<hr>

<div class="container" style="margin-bottom:5rem;">

	<br />

	<form method="POST" action="/updateTopic/{{$topic->id}}" id="edit_form_id">
		@csrf
		@method('PUT') <!-- Form Method Spoofing -->

		<input id="id" name="id" type="hidden" value="{{$topic['id']}}">

		<div class="form-group">
			<label for="name" class="control-label col-sm-2">Topic Name</label>
			<input id="name" name="name" type="text" class="form-control col-sm-10" value="{{$topic->name}}">
			@error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<div class="form-group">
			<label for="tag" class="control-label col-sm-2">Tag</label>
			<select name="tag" class="form-select" id="tag" @if($module_id !=3) disabled @endif>
				@php
				$tags = ['', 'Physics', 'Chemistry', 'Biology'];
				@endphp

				@foreach($tags as $tag)
				@if ($tag == $topic->tag)
				<option value="{{$tag}}" selected>{{$tag}}</option>
				@else
				<option value="{{$tag}}">{{$tag}}</option>
				@endif
				@endforeach
				<!-- <option selected disabled>Please select one</option> -->
			</select>
			@error('tag') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<div class="form-group">
			<label for="module_id" class="control-label col-sm-2">Module</label>
			<select name="module_id" class="form-select" id="module" onchange="toggleTagSelection()">
				@foreach(App\Models\Module::all() as $module)
				@if ($module->id == $topic->module_id)
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
			<label for="image" class="control-label col-sm-2">New Image Path</label><br />
			<input id="image" name="image" type="text" class="form-control col-sm-10" value="{{$topic->image}}">
			@error('image') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<br />

		<input type="submit" value="Save" class="btn btn-primary">

		<input type="button" value="Cancel" class="btn btn-primary" onclick="history.back()">

	</form>

	<br />
</div>

<script>
	function toggleTagSelection() {
		var module_id = document.getElementById("module").value;
		if (module_id == 3) {
			document.getElementById("tag").disabled = false;
		} else {
			document.getElementById("tag").disabled = true;
		}
	}
</script>

<style>
	.control-label {
		text-align: left;
	}
</style>
@endsection