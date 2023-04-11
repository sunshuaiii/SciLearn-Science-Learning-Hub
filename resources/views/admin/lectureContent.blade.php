@extends('layouts.app')

@section('title', 'Lecture Content')

@section('content')
<div class="container my-4">
    <a href="/home">Home </a> > <a href="/admin/lectureContent">Lecture Content </a>
</div>
<br>
<table class="table table-hover" >
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
				<tr>
					<td>{{$module->name}}</td>
					<td>{{$topic->name}}</td>
					<td>{{$article->title}}</td>
					<td>{{$article->getQuiz->name}}</td>
				</tr>
				@endforeach
			@endforeach
		@endforeach
	</tbody>
</table>

@endsection
