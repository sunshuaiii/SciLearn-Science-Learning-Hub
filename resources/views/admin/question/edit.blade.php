@extends('layouts.app')

@section('title', 'Edit Question')

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
<h1 style="text-align: center;">Edit Question</h1>
<hr>

<div class="container" style="margin-bottom:5rem;">

	<br />

	<form method="POST" action="/updateQuestion/{{$question->id}}" id="edit_form_id">
		@csrf
		@method('PUT') <!-- Form Method Spoofing -->

		<input id="id" name="id" type="hidden" value="{{$question['id']}}">

		<div class="form-group">
			<label for="question" class="control-label col-sm-2">Question</label>
			<input id="question" name="question" type="text" class="form-control col-sm-10" value="{{$question['question']}}">
			@error('question') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<div class="form-group">
			<label for="option1" class="control-label col-sm-2">Option 1</label>
			<input id="option1" name="option1" type="text" class="form-control col-sm-10" value="{{$question['option1']}}">
			@error('option1') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<div class="form-group">
			<label for="option2" class="control-label col-sm-2">Option 2</label>
			<input id="option2" name="option2" type="text" class="form-control col-sm-10" value="{{$question['option2']}}">
			@error('option2') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<div class="form-group">
			<label for="option3" class="control-label col-sm-2">Option 3</label>
			<input id="option3" name="option3" type="text" class="form-control col-sm-10" value="{{$question['option3']}}">
			@error('option3') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<div class="form-group">
			<label for="option4" class="control-label col-sm-2">Option 4</label>
			<input id="option4" name="option4" type="text" class="form-control col-sm-10" value="{{$question['option4']}}">
			@error('option4') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<div class="form-group">
			<label for="answer" class="control-label col-sm-2">Answer</label>
			<select name="answer" class="form-select" id="quiz">
				@foreach(range(1, 4) as $num)
				<option value="{{ $num }}">{{ $num }}</option>
				@endforeach
			</select>
			@error('quiz') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<div class="form-group">
			<label for="explanation" class="control-label col-sm-2">Explanation</label>
			<input id="explanation" name="explanation" type="text" class="form-control col-sm-10" value="{{$question['explanation']}}">
			@error('explanation') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<div class="form-group">
			<label for="quiz_id" class="control-label col-sm-2">Quiz Name</label>
			<select name="quiz_id" class="form-select" id="quiz">
				@foreach(App\Models\Quiz::all() as $quiz)
				@if ($quiz->id == $quiz_id)
				<option value="{{$quiz->id}}" selected>{{$quiz->name}}</option>
				@else
				<option value="{{$quiz->id}}">{{$quiz->name}}</option>
				@endif
				@endforeach
				<!-- <option selected disabled>Please select one</option> -->
			</select>
			@error('quiz') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<br />

		<input type="submit" value="Save" class="btn btn-primary">

		<input type="button" value="Cancel" class="btn btn-primary" onclick="history.back()">

	</form>

	<br />
</div>

<style>
	.control-label {
		text-align: left;
	}
</style>
@endsection