@extends('layouts.app')

@section('title', 'Learning Center')

@section('content')

<div class="container my-4">
    <a href="home">Home</a> > <a href="/modules">Modules</a> > <a href="learning-center">Learning Center</a>
</div>

@foreach($topics as $topic)
<h1>{{ $topic['name'] }}</h1>
@endforeach

@endsection