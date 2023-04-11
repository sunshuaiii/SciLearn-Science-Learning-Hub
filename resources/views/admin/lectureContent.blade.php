@extends('layouts.app')

@section('title', 'Lecture Content')

@section('content')
<div class="container my-4">
    <a href="/home">Home </a> > <a href="/admin/lectureContent">Lecture Content </a>
</div>
<br>

@if(session('message'))
<div class="alert alert-success">
    {{session('message')}}
</div>
@endif

<table class="table" >
	<thead>
		<tr>
			<th>Module</th>
			<th>Topic</th>
			<th>Articles</th>
			<th>Quiz</th>
		</tr>
	</thead>
	<tbody>
		@foreach(App\Models\Module::all() as $module)
			@foreach($module->getTopics as $topic)
				@foreach($topic->getArticles as $article)
				
				<tr class="showEdit">
					<td onclick="window.location.href='/showModule/{{$module->id}}';">{{$module->name}} </td>
					<td onclick="window.location.href='/showTopic/{{$topic->id}}';">{{$topic->name}} </td>
					<td onclick="window.location.href='/showArticle/{{$article->id}}';">{{$article->title}} </td>
					<td onclick="window.location.href='/showQuiz/{{$article->getQuiz->id}}';">{{$article->getQuiz->name}}</td>
				</tr>
				@endforeach
			@endforeach
		@endforeach
	</tbody>
</table>

<style>
td:hover {
	color: #ff6600;
}
</style>

@endsection
