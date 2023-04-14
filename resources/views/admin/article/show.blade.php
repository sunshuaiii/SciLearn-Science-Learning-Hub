@extends('layouts.app')

@section('title', 'Article Details')

@section('content')
<br>

<nav class="head-nav" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item"><a href="/lecture_content">Lecture Content</a></li>
		<li class="breadcrumb-item"><a href="/showModule/{{$module_id}}">Module: {{App\Models\Module::find($module_id)->name}}</a></li>
		<li class="breadcrumb-item"><a href="/showTopic/{{$topic_id}}">Topic: {{App\Models\Topic::find($topic_id)->name}}</a></li>
		<li class="breadcrumb-item active" aria-current="page">Article: {{$article->title}}</a></li>
	</ol>
</nav>

<br> <br> <br>
<h1 style="text-align: center;">Article Details</h1>
<hr>

<div class="container justify-content-center" style="margin-bottom:5rem;">
	@if(session('message'))
	<div class="alert alert-success">
		{{session('message')}}
	</div>
	@endif
</div>

<div class="container" style="margin-bottom:5rem;">

	<input type="button" id="edit" value="Edit" class="btn btn-primary" onclick="window.location.href='/editArticle/{{$article->id}}';">
	<input type="button" id="delete button" value="Delete" class="btn btn-primary">
	<input type="button" id="addQuiz" value="Add Quiz" class="btn btn-primary" onclick="window.location.href='/createQuiz/{{$article->id}}';">


	<br />

	<!-- pass to controller using DELETE request -->
	<form method="POST" action="/destroyArticle/{{$article->id}}" id="delete_form_id" style="margin-bottom:2rem;">
		@csrf
		@method('DELETE') <!-- Form Method Spoofing -->
		<input id="id" name="id" type="hidden" value="{{$article['id']}}">

		<span id="delete confirmation" style="display:none;">
			<br />
			Delete this article? This will also delete the associated quizzes, and questions.
			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit" value="Delete" class="btn btn-primary">
				<input type="button" value="Do Not Delete" id="cancel" class="btn btn-primary">
			</div>
		</span>
	</form>

	<form id="readonly_form_id" class="form-horizontal">
		<input id="id" name="id" type="hidden" value="{{$article['id']}}">
		<div class="row">
			<div class="col-md-6">
				<form id="readonly_form_id" class="form-horizontal">
					<div class="form-group">
						<label for="title" class="control-label col-sm-4">Article Title:</label>
						<div class="col-sm-8">
							<input id="title" name="title" type="text" class="form-control" value="{{$article->title}}" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="content" class="control-label col-sm-4">Content:</label>
						<div class="col-sm-8">
							<input id="content" name="content" type="text" class="form-control" value="{{$article->content}}" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="image" class="control-label col-sm-2">Image:</label><br />
						<div class="col-sm-8">
							<img src="{{ $article['image'] }}" alt="Card image" class="img-thumbnail">
						</div>
					</div>


					<br />

				</form>
			</div>
		</div>
	</form>

	<br> <br> <br>
	<h1 style="text-align: center;">Article: {{$article->title}}</h1>
	<hr>

	<div id="verticalScroll">
		<table>
			<thead>
				<tr>
					<th>Quiz</th>
					<th>Question</th>
				</tr>
			</thead>
			<tbody>
				@if($article->getQuiz)
				@php
				$prev_article = null;
				$quiz = $article->getQuiz;
				@endphp
				@foreach($quiz->getQuestions as $question)
				<tr class="showEdit">
					@if ($article->title != $prev_article)
					<td onclick="window.location.href='/showQuiz/{{$quiz->id}}';" rowspan="{{count($quiz->getQuestions)}}">{{$article->title}}</td>
					@endif
					<td onclick="window.location.href='/showQuestion/{{$question->id}}';">{{$question->question}} </td>
				</tr>
				@php
				$prev_article = $article->title;
				@endphp
				@endforeach
				@endif
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