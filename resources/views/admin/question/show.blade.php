@extends('layouts.app')

@section('title', 'Question Details')

@section('content')
<br>

<nav class="head-nav" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item"><a href="/lecture_content">Lecture Content</a></li>
		<li class="breadcrumb-item"><a href="/showModule/{{$module_id}}">Module: {{App\Models\Module::find($module_id)->name}}</a></li>
		<li class="breadcrumb-item"><a href="/showTopic/{{$topic_id}}">Topic: {{App\Models\Topic::find($topic_id)->name}}</a></li>
		<li class="breadcrumb-item"><a href="/showArticle/{{$article_id}}">Article: {{App\Models\Article::find($article_id)->title}}</a></li>
		<li class="breadcrumb-item"><a href="/showQuiz/{{$quiz_id}}">Quiz: {{App\Models\Quiz::find($quiz_id)->name}}</a></li>
		<li class="breadcrumb-item active" aria-current="page">Question: {{$question->question}}</a></li>
	</ol>
</nav>

<br> <br> <br> <br> <br> 
<h1 style="text-align: center;">Question Details</h1>
<hr>

<div class="container justify-content-center" style="margin-bottom:5rem;">
	@if(session('message'))
	<div class="alert alert-success">
		{{session('message')}}
	</div>
	@endif
</div>

<div class="container" style="margin-bottom:5rem;">

	<input type="button" id="edit" value="Edit" class="btn btn-primary" onclick="window.location.href='/editQuestion/{{$question->id}}';">
	<input type="button" id="delete button" value="Delete" class="btn btn-primary">
	<input type="button" id="addQuestion" value="Add Question" class="btn btn-primary" onclick="window.location.href='/createQuestion/{{$question->id}}';">


	<br />

	<!-- pass to controller using DELETE request -->
	<form method="POST" action="/destroyQuestion/{{$question->id}}" id="delete_form_id" style="margin-bottom:2rem;">
		@csrf
		@method('DELETE') <!-- Form Method Spoofing -->
		<input id="id" name="id" type="hidden" value="{{$question['id']}}">

		<span id="delete confirmation" style="display:none;">
			<br />
			Delete this question?
			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit" value="Delete" class="btn btn-primary">
				<input type="button" value="Do No Delete" id="cancel" class="btn btn-primary">
			</div>
		</span>
	</form>

	<form id="readonly_form_id" class="form-horizontal">
		<input id="id" name="id" type="hidden" value="{{$question['id']}}">

		<div class="row">
			<div class="col-md-6">
				<form id="readonly_form_id" class="form-horizontal">
					<div class="form-group">
						<label for="question" class="control-label col-sm-4">Question:</label>
						<div class="col-sm-8">
							<input id="question" name="question" type="text" class="form-control" value="{{$question->question}}" readonly>
						</div>
					</div>
					<br />
				</form>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<form id="readonly_form_id" class="form-horizontal">
					<div class="form-group">
						<label for="option1" class="control-label col-sm-4">Option 1:</label>
						<div class="col-sm-8">
							<input id="option1" name="option1" type="text" class="form-control" value="{{$question->option1}}" readonly>
						</div>
					</div>
					<br />
				</form>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<form id="readonly_form_id" class="form-horizontal">
					<div class="form-group">
						<label for="option2" class="control-label col-sm-4">Option 2:</label>
						<div class="col-sm-8">
							<input id="option2" name="option2" type="text" class="form-control" value="{{$question->option2}}" readonly>
						</div>
					</div>
					<br />
				</form>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<form id="readonly_form_id" class="form-horizontal">
					<div class="form-group">
						<label for="option3" class="control-label col-sm-4">Option 3:</label>
						<div class="col-sm-8">
							<input id="option3" name="option3" type="text" class="form-control" value="{{$question->option3}}" readonly>
						</div>
					</div>
					<br />
				</form>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<form id="readonly_form_id" class="form-horizontal">
					<div class="form-group">
						<label for="option4" class="control-label col-sm-4">Option 4:</label>
						<div class="col-sm-8">
							<input id="option4" name="option4" type="text" class="form-control" value="{{$question->option4}}" readonly>
						</div>
					</div>
					<br />
				</form>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<form id="readonly_form_id" class="form-horizontal">
					<div class="form-group">
						<label for="answer" class="control-label col-sm-4">Answer:</label>
						<div class="col-sm-8">
							<input id="answer" name="answer" type="text" class="form-control" value="{{$question->answer}}" readonly>
						</div>
					</div>
					<br />
				</form>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<form id="readonly_form_id" class="form-horizontal">
					<div class="form-group">
						<label for="explanation" class="control-label col-sm-4">Explanation:</label>
						<div class="col-sm-8">
							<input id="explanation" name="explanation" type="text" class="form-control" value="{{$question->explanation}}" readonly>
						</div>
					</div>
					<br />
				</form>
			</div>
		</div>

	</form>

	<br> <br> <br>

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