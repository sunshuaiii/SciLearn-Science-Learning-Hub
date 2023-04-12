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

<br> <br> <br>
  <h1 style="text-align: center;">Leaderboard</h1>
<hr>

<table>
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

<style>
	table {
		border-collapse: collapse;
		width: 100%;
	}

	th, td {
		padding: 8px;
		text-align: left;
		border-bottom: 1px solid #ddd;
	}

	th {
		background-color: #f2f2f2;
	}

	tr:hover {
		background-color:#f5f5f5;
	}
</style>

@include('startChallenge')

<br> <br> <br>

@endsection