<!-- Show the form for editing the specified resource. -->

@extends('components.layout')
@section('title', 'Edit/Delete Drink')
@section('content')
	<form method="POST" action="{{route('drinks.update', $drink)}}" id="edit_form_id">
		@csrf
		@method('PUT') <!-- Form Method Spoofing -->

		<input id="id" name="id" type="hidden" value="{{$drink['id']}}">

		<label for="category">Category</label>
		<input id="category" name="category" type="text" value="{{$drink['category']}}">
	
		<label for="name">Name</label>
		<input id="name" name="name" type="text" value="{{$drink->name}}">

		<label for="expiry_date">Expiry Date</label>
		<input id="expiry_date" name="expiry_date" type="date" value="{{$drink['expiry_date']}}">
		
		<input type="submit" value="Save">
		<a href="/drinks">
			<input type="button" value="Cancel">
		</a>
	</form>
	
	<!-- pass $drink to controller using DELETE request -->
	<form method="POST" action="{{route('drinks.destroy', $drink)}}" id="delete_form_id">
		@csrf
		@method('DELETE') <!-- Form Method Spoofing -->
		<input id="id" name="id" type="hidden" value="{{$drink['id']}}">
		<input type="button" value="Delete" id="delete button">
		<span id="delete confirmation" style="display:none">
			Delete this item?
			<input name="deleteType" type="submit" value="Permanant Delete">
			<input name="deleteType" type="submit" value="Move to Recycle Bin">
			<input type="button" value="Do No Delete" id="do no delete button">
		</span>
	</form>

	<script>
		document.getElementById("delete button").onclick = function() {
			const deleteConfirmation = document.getElementById("delete confirmation");
			if (deleteConfirmation.style.display === "none")
				deleteConfirmation.style.display = "block";
			else
				deleteConfirmation.style.display = "none";
		};
		document.getElementById("do not delete button").onclick = function() {
			const deleteConfirmation = document.getElementById("delete confirmation");
			deleteConfirmation.style.display = "none";
		};
	</script>
@endsection