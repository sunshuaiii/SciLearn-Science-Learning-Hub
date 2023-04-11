<!-- Display a listing of the resource. -->

@extends('components.layout')
 
@section('title', 'List of Drinks')
 
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
			@foreach($drinks as $drink)
				<tr>
					<td>{{$drink->id}}</td>
					<td>{{$drink['category']}}</td>
					<td>{{$drink->name}}</td>
					<td>{{$drink->expiry_date}}</td>
					<td><button><a href="{{route('drinks.edit', $drink)}}">Edit/Delete</a></button></td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<span class="pagination">
		{{$drinks->links()}}
	</span>
@endsection