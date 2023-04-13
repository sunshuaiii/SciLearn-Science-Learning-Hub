@extends('layouts.app')

@section('title', 'Lecture Content')

@section('content')
<br>

<nav class="head-nav" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Lecture Content</li>
	</ol>
</nav>

<br> <br> <br>
<h1 style="text-align: center;">Lecture Content</h1>
<hr>

@if(session('message'))
<div class="alert alert-success">
	{{session('message')}}
</div>
@endif

<div id="verticalScroll">
	<table>
		<thead>
			<tr>
				<th>Module</th>
				<th>Topic</th>
				<th>Article</th>
				<th>Quiz</th>
			</tr>
		</thead>
		<tbody>
			@foreach(App\Models\Module::all() as $module)
				@if ($module->getTopics->count() == 0)
				<tr>
					<td onclick="window.location.href='/showModule/{{$module->id}}';">{{$module->name}} </td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				@else
					@foreach($module->getTopics as $topic)
						@php
							$prev_topic = null;
						@endphp

						@if ($topic->getArticles->count() == 0)
							<tr>
								<td onclick="window.location.href='/showModule/{{$module->id}}';">{{$module->name}} </td>
								<td onclick="window.location.href='/showTopic/{{$topic->id}}';">{{$topic->name}}</td>
								<td></td>
								<td></td>
							</tr>
						@else
							@foreach($topic->getArticles as $article)
								<tr class="showEdit">
									<td onclick="window.location.href='/showModule/{{$module->id}}';">{{$module->name}} </td>
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
						@endif
					@endforeach
				@endif
			@endforeach
		</tbody>
	</table>
</div>

<br> <br> <br>

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
</style>

@endsection