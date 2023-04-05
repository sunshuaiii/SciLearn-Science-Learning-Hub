<!-- Display a listing of the resource. -->

@extends('layouts.app')
 
@section('title', 'Leaderboard')
 
@section('content')
<div class="container my-4">
    <a href="/home">Home </a> > <a href="/leaderboard">Leaderboard </a>
</div>

<h1 style="text-align: center;">Leaderboard</h1>

	<table class="table table-hover" style="margin-bottom: 3rem">
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

	<hr>
<div style="margin:3rem">
	<h4 style="text-align: center;"> Start the challenge now!</h4>
	<button class="center">Start</button>
</div>
@endsection