@extends('layouts.app')

@section('title', 'Create Quiz')

@section('content')
<br>

<nav class="head-nav" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item"><a href="/lecture_content">Lecture Content</a></li>
		<li class="breadcrumb-item"><a href="/showModule/{{$module_id}}">Module: {{App\Models\Module::find($module_id)->name}}</a></li>
		<li class="breadcrumb-item"><a href="/showTopic/{{$topic_id}}">Topic: {{App\Models\Topic::find($topic_id)->name}}</a></li>
		<li class="breadcrumb-item"><a href="/showArticle/{{$article_id}}">Article: {{App\Models\Article::find($article_id)->title}}</a></li>
		<li class="breadcrumb-item active" aria-current="page">Create Quiz</a></li>
	</ol>
</nav>

<br> <br> <br>
<h1 style="text-align: center;">Create Quiz</h1>
<hr>

<div class="container" style="margin-bottom:5rem;">

	<br />

	<form method="POST" action="/storeQuiz" id="edit_form_id">
		@csrf

		<div class="form-group">
			<label for="name" class="control-label col-sm-2">Name</label>
			<input id="name" name="name" type="text" class="form-control col-sm-10">
			@error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<div class="form-group">
			<label for="article_id" class="control-label col-sm-2">Article Title</label>
			<select name="article_id" class="form-select" id="article">
				@foreach(App\Models\Article::all() as $article)
				@if ($article->id == $article_id)
				<option value="{{$article->id}}" selected>{{$article->title}}</option>
				@else
				<option value="{{$article->id}}">{{$article->title}}</option>
				@endif
				@endforeach
				<!-- <option selected disabled>Please select one</option> -->
			</select>
			@error('article') <div class="alert alert-danger">{{ $message }}</div> @enderror
		</div>

		<br />

		<input type="submit" value="Save" class="btn btn-primary">

		<input type="button" value="Cancel" class="btn btn-primary" onclick="history.back()">

	</form>

	<br />
</div>

<script>
	document.getElementById("edit_form_id").onsubmit = function() {
		console.log(document.getElementById("article").value);
		// return false;
	};
</script>

<style>
	.control-label {
		text-align: left;
	}
</style>
@endsection