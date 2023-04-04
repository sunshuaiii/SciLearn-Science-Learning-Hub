<!-- Display a listing of the resource. -->

@extends('layouts.app')
 
@section('title', 'Leaderboard')
 
@section('content')
	<table class="table table-hover">
		<thead>
		<tr>
			<th>Rank</th>
			<th>Username</th>
			<th>Time</th>
		</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td>{{$user[0]}}</td>
					<td>{{$user[1]}}</td>
					<td>{{gmdate("H:i:s", $user[2])}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection