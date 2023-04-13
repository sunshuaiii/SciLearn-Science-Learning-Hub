@extends('layouts.app')

@section('title', 'Edit Quiz')

@section('content')
<br>

<nav class="head-nav" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item"><a href="/lecture_content">Lecture Content</a></li>
		<li class="breadcrumb-item"><a href="/showModule/{{$module_id}}">Module: {{App\Models\Module::find($module_id)->name}}</a></li>
		<li class="breadcrumb-item"><a href="/showTopic/{{$topic_id}}">Topic: {{App\Models\Topic::find($topic_id)->name}}</a></li>
		<li class="breadcrumb-item"><a href="/showArticle/{{$article_id}}">Article: {{App\Models\Article::find($article_id)->title}}</a></li>
		<li class="breadcrumb-item active" aria-current="page">Quiz: {{$quiz->name}}</a></li>
	</ol>
</nav>

<br> <br> <br>
<h1 style="text-align: center;">Edit Quiz</h1>
<hr>

<div class="container" style="margin-bottom:5rem;">

	<br />

	<form method="POST" action="/updateQuiz/{{$quiz->id}}" id="edit_form_id">
		@csrf
		@method('PUT') <!-- Form Method Spoofing -->

		<input id="id" name="id" type="hidden" value="{{$quiz['id']}}">

		<div class="form-group">
			<label for="name" class="control-label col-sm-2">Quiz Name</label>
			<input id="name" name="name" type="text" class="form-control col-sm-10" value="{{$quiz->name}}">
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

<style>
	.control-label {
		text-align: left;
	}
</style>
@endsection