@extends('layouts.app')

@section('content')
<br>
<h3>Search Results</h3>
<hr>
@if (count($results) > 0)
<ul>
    @foreach ($results as $result)
    <a href="/">
        <li>{{ $result->name }}</li>
    </a>
    @endforeach
</ul>
@else
<p>No results found.</p>
@endif
@endsection