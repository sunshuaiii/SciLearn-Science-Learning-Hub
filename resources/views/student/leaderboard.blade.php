<!-- Display a listing of the resource. -->

@extends('layouts.app')

@section('title', 'Leaderboard')

@section('content')
<br>

<nav class="head-nav" aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Leaderboard</li>
	</ol>
</nav>

<h1 style="text-align: center;">Leaderboard</h1>

<table class="table table-hover" style="margin-bottom: 3rem">
	<thead>
		<tr>
			<th>Rank</th>
			<th>Username</th>
			<th>Time Taken</th>
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

@include('startChallenge')

@endsection