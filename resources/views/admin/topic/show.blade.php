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

<br>

<div class="container" style="margin-bottom:5rem;">

@if(session('message'))
<div class="alert alert-success">
    {{session('message')}}
</div>
@endif

<form id="readonly_form_id" class="form-horizontal">
	<div class="form-group">
		<label for="name" class="control-label col-sm-2">Name</label>
		<input id="name" name="name" type="text" class="form-control col-sm-10" value="{{$topic->name}}" readonly>
	</div>

	<div class="form-group">
		<label for="tag" class="control-label col-sm-2">Tag</label>
		<input id="tag" name="tag" type="text" class="form-control col-sm-10" value="{{$topic->tag}}" readonly>
	</div>

	<div class="form-group">
		<label for="order" class="control-label col-sm-2">Order</label>
		<input id="order" name="order" type="text" class="form-control col-sm-10" value="{{$topic->order}}" readonly>
	</div>

	<div class="form-group">
		<label for="module" class="control-label col-sm-2">Module</label>
		<input id="module" name="module" type="text" class="form-control col-sm-10" value="{{App\Models\Module::find($topic->module_id)->name}}" readonly>
	</div>

	<div class="form-group">
		<label for="image" class="control-label col-sm-2">Image</label>
		<img src="{{ $topic['image'] }}" alt="Card image">
	</div>
	

	<br/>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<input type="button" id="edit" value="Edit" class="btn btn-primary"
				onclick="window.location.href='/editTopic/{{$topic->id}}';">
		</div>
	</div>
</form>

<br/>

	<!-- pass to controller using DELETE request -->
	<form method="POST" action="/destroyTopic/{{$topic->id}}" id="delete_form_id">
		@csrf
		@method('DELETE') <!-- Form Method Spoofing -->
		<input id="id" name="id" type="hidden" value="{{$topic['id']}}">
		<div class="col-sm-offset-2 col-sm-10">
			<input type="button" id="delete button" value="Delete" class="btn btn-primary">
		</div>

		<span id="delete confirmation" style="display:none;">
			<br/>
			Delete this item?
			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit" value="Delete" class="btn btn-primary">
				<input type="button" value="Do No Delete" id="cancel" class="btn btn-primary">
			</div>
		</span>
	</form>
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
