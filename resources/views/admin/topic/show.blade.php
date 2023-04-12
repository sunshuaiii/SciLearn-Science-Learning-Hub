@extends('layouts.app')

@section('title', 'Topic Details')

@section('content')
<br>

<nav class="head-nav" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item"><a href="/lecture_content">Lecture Content</a></li>
		<li class="breadcrumb-item active" aria-current="page">Topic Details</li>
	</ol>
</nav>

<br> <br> <br>
<h1 style="text-align: center;">Topic Details</h1>
<hr>

<div class="container justify-content-center" style="margin-bottom:5rem;">

	@if(session('message'))
	<div class="alert alert-success">
		{{session('message')}}
	</div>
	@endif

	<div class="row">
		<div class="col-md-6">
			<form id="readonly_form_id" class="form-horizontal">
				<div class="form-group">
					<label for="name" class="control-label col-sm-4">Name:</label>
					<div class="col-sm-8">
						<input id="name" name="name" type="text" class="form-control" value="{{$topic->name}}" readonly>
					</div>
				</div>

				<div class="form-group">
					<label for="tag" class="control-label col-sm-4">Tag:</label>
					<div class="col-sm-8">
						<input id="tag" name="tag" type="text" class="form-control" value="{{$topic->tag}}" readonly>
					</div>
				</div>

				<div class="form-group">
					<label for="order" class="control-label col-sm-4">Order:</label>
					<div class="col-sm-8">
						<input id="order" name="order" type="text" class="form-control" value="{{$topic->order}}" readonly>
					</div>
				</div>

				<div class="form-group">
					<label for="module" class="control-label col-sm-4">Module:</label>
					<div class="col-sm-8">
						<input id="module" name="module" type="text" class="form-control" value="{{App\Models\Module::find($topic->module_id)->name}}" readonly>
					</div>
				</div>

				<div class="form-group">
					<label for="image" class="control-label col-sm-4">Image:</label>
					<div class="col-sm-8">
						<img src="{{ $topic['image'] }}" alt="Card image" class="img-thumbnail">
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<input type="button" id="edit" value="Edit" class="btn btn-primary" onclick="window.location.href='/editTopic/{{$topic->id}}';">
					</div>
				</div>
			</form>
		</div>
	</div>

	<br>

	<div class="col-md-6">
		<!-- pass to controller using DELETE request -->
		<form method="POST" action="/destroyTopic/{{$topic->id}}" id="delete_form_id" class="form-horizontal">
			@csrf
			@method('DELETE') <!-- Form Method Spoofing -->
			<input id="id" name="id" type="hidden" value="{{$topic['id']}}">
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
					<input type="button" id="delete_button" value="Delete" class="btn btn-danger">
				</div>
			</div>

			<div id="delete_confirmation" style="display:none;">
				<br>
				<p class="text-danger">Are you sure you want to delete this item?</p>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<input type="submit" value="Delete" class="btn btn-danger">
						<input type="button" value="Cancel" id="cancel" class="btn btn-secondary">
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	document.getElementById("delete button").onclick = function() {
		const deleteConfirmation = document.getElementById("delete confirmation");
		if (deleteConfirmation.style.display === "none")
			deleteConfirmation.style.display = "block";
		else
			deleteConfirmation.style.display = "none";
	};
	document.getElementById("cancel").onclick = function() {
		const deleteConfirmation = document.getElementById("delete confirmation");
		deleteConfirmation.style.display = "none";
	};
</script>

@endsection