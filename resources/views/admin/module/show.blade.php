<!-- Display the specified resource. -->

@extends('components.layout')
 
@section('title', 'Drink Details')
 
@section('sidebar')
    @parent
    <p>This is appended to the master sidebar.</p>
@endsection
 
@section('content')
<table class="table table-hover">
		<thead>
		<tr>
			<th>ID</th>
			<th>Category</th>
			<th>Drink</th>
			<th>Expiry Date</th>
		</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{$drink->id}}</td>
				<td>{{$drink['category']}}</td>
				<td>{{$drink->name}}</td>
				<td>{{$drink->expiry_date}}</td>
				<td><button><a href="{{route('drinks.edit', $drink)}}">Edit/Delete</a></button></td>
			</tr>
		</tbody>
	</table>
@endsection