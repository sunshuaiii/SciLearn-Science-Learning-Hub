<h2>Progress</h2>
<div id="verticalTable">
<table class="table table-hover" >
	<thead>
		<tr>
			<th>Module</th>
			<th>Topic</th>
			<th>Quiz</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($quizzes as $quiz)
			<tr>
				<td>{{App\Models\Module::find(App\Models\Topic::find($quiz->topic_id)->module_id)->name}}</td>
				<td>{{App\Models\Topic::find($quiz->topic_id)->name}}</td>
				<td>{{$quiz->name}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
</div>

<style>
#verticalTable {
  height: 400px;
  overflow: scroll;
}
</style>