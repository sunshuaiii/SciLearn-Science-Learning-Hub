@extends('layouts.app')

@section('title', 'Search Results')

@section('content')

<!DOCTYPE html>
<html lang="en-US">

<br>

<nav class="head-nav" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Search Results</li>
    </ol>
</nav>

<br> <br> <br>
<h1 style="text-align: center;">Search Results</h1>
<hr>

<h5 style="text-align: left;">{{ count($results) }} topics found</h5>

@if (count($results) > 0)
<div class="container">
    <div class="row">
        <br> <br>
        <div class="container">
            <div class="row">
                @foreach ($results as $result)
                <div class="col-md-3">
                    <div class="card cartoonish-card">
                        <img class="card-img" src="{{ $result->image }}" alt="Card image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $result->name }}</h5>
                        </div>
                        <div class="card-btn">
                            <a href={{"/modules/".$result->moduleName."/".$result->id}} class="btn cartoonish-btn">Start
                                Learning</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@else
<br> <br> <br>
<h4 style="text-align: center;">Type something else to search for the topics.</h4>
@endif

<br> <br> <br>

@endsection