@extends('layouts.app')

@section('title', 'Topic Details')

@section('content')
<br>

<nav class="head-nav" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/lecture_content">Lecture Content</a></li>
		<li class="breadcrumb-item"><a href="/showModule/{{$topic->module_id}}">Module: {{App\Models\Module::find($topic->module_id)->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Topic: {{$topic->name}}</a></li>
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

<br> <br> <br>
<h1 style="text-align: center;">Topic Details</h1>
<hr>

<div class="container" style="margin-bottom:5rem;">

<input type="button" id="edit" value="Edit" class="btn btn-primary"
	onclick="window.location.href='/editTopic/{{$topic->id}}';">
<input type="button" id="delete button" value="Delete" class="btn btn-primary">
<input type="button" id="addArticle" value="Add Article" class="btn btn-primary"
	onclick="window.location.href='/createArticle/{{$topic->id}}';">


	<br/>

	<!-- pass to controller using DELETE request -->
	<form method="POST" action="/destroyTopic/{{$topic->id}}" id="delete_form_id" style="margin-bottom:2rem;">
		@csrf
		@method('DELETE') <!-- Form Method Spoofing -->
		<input id="id" name="id" type="hidden" value="{{$topic['id']}}">

		<span id="delete confirmation" style="display:none;">
			<br/>
			Delete this item?
			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit" value="Delete" class="btn btn-primary">
				<input type="button" value="Do No Delete" id="cancel" class="btn btn-primary">
			</div>
		</span>
	</form>

<form id="readonly_form_id" class="form-horizontal">
	<input id="id" name="id" type="hidden" value="{{$topic['id']}}">

	<div class="form-group">
		<label for="name" class="control-label col-sm-2">Name</label>
		<input id="name" name="name" type="text" class="form-control col-sm-10" value="{{$topic->name}}" readonly>
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
		<label for="image" class="control-label col-sm-2">Image:</label><br/>
		<div class="col-sm-8">
			<img src="{{ $topic['image'] }}" alt="Card image" class="img-thumbnail">
		</div>
	</div>
	

	<br/>

</form>

	<br>


<div id="verticalScroll">
<table>
		<thead>
			<tr>
				<th>Article</th>
				<th>Quiz</th>
			</tr>
		</thead>
		<tbody>
			@foreach($topic->getArticles as $article)
				<tr class="showEdit">
					<td onclick="window.location.href='/showArticle/{{$article->id}}';">{{$article->title}} </td>
					<td onclick="window.location.href='/showQuiz/{{$article->getQuiz->id}}';">{{$article->getQuiz->name}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	</div>

</div>

	<style>
	#verticalScroll {
		height: 600px;
		overflow: auto;
	}

	table {
		border-collapse: collapse;
		width: 100%;
	}

	th,
	td {
		padding: 8px;
		text-align: left;
		border-bottom: 1px solid #ddd;
	}

	th {
		background-color: #f2f2f2;
	}

	tr:hover {
		background-color: #f5f5f5;
	}

	.showEdit {
		cursor: pointer;
	}

	td:hover {
		color: #ff6600;
	}

	.control-label {
    text-align: left;
	}
</style>

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