<!-- Show the form for creating a new resource. -->

@extends('layouts.app')

@section('title', 'Lecture Content')

@section('content')
<div class="container my-4">
    <a href="/home">Home </a> > <a href="/admin/createModule">Create Module </a>
</div>
<br>

<form method="POST" action="" id="form_id">
		@csrf
		
		<label for="category">Category</label>
		<input id="category" name="category" type="text">
	
		<label for="name">Name</label>
		<input id="name" name="name" type="text">

		<label for="expiry_date">Expiry Date</label>
		<input id="expiry_date" name="expiry_date" type="date">
		
		<input type="submit">
</form>


@endsection
