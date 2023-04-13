@extends('layouts.app')

@section('title', 'Module Details')

@section('content')
<br>

<nav class="head-nav" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item"><a href="/lecture_content">Lecture Content</a></li>
		<li class="breadcrumb-item active" aria-current="page">Module: {{$module->name}}</li>
	</ol>
</nav>

<br>

<br> <br> <br>
<h1 style="text-align: center;">Module: {{$module->name}}</h1>
<hr>

@if(session('message'))
<div class="alert alert-success">
	{{session('message')}}
</div>
@endif

<div class="container" style="margin-bottom:5rem;">

	<input type="button" id="addArticle" value="Add Topic" class="btn btn-primary" onclick="window.location.href='/createTopic/{{$module->id}}';">

	<br /><br />

	<div id="verticalScroll">
		<table>
			<thead>
				<tr>
					<th>Topic</th>
					<th>Article</th>
					<th>Quiz</th>
				</tr>
			</thead>
			<tbody>
				@foreach($module->getTopics as $topic)
				@php
				$prev_topic = null;
				@endphp
				@foreach($topic->getArticles as $article)

				<tr class="showEdit">
					@if ($topic->name != $prev_topic)
					<td onclick="window.location.href='/showTopic/{{$topic->id}}';" rowspan="{{count($topic->getArticles)}}">{{$topic->name}}</td>
					@endif
					<td onclick="window.location.href='/showArticle/{{$article->id}}';">{{$article->title}} </td>
					<td onclick="window.location.href='/showQuiz/{{$article->getQuiz->id}}';">{{$article->getQuiz->name}}</td>
				</tr>
				@php
				$prev_topic = $topic->name;
				@endphp
				@endforeach
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