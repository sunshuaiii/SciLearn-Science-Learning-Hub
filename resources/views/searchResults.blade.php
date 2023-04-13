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

<h4 style="text-align: left;">{{ count($results) }} related topics found</h5>

<div class="container">
    <div class="row">
        @if(count($results) > 0)
        <div style="display:none">{{ $i=0 }}</div>
        @foreach($results as $result)
        <div class="col-md-3">
            <div class="card cartoonish-card">
                <img class="card-img" src="{{ $result->image }}" alt="Card image" style="object-fit:cover;" width="640" height="180">
                <div class="card-body">
                    <h5 class="card-title">{{ $result->name }}</h5>
                </div>
                <div class="card-btn">
                    <a href={{"/modules/".$result->moduleName."/".$result->id}} class="btn cartoonish-btn">Start Learning</a>
                </div>
                @if (Auth::guard(session('role'))->user())
                <div style="margin-bottom: 0.5rem;">
                    <div class="progress" style="height: 1.5rem;">
                        <div class="progress-bar bg-success progress-bar-striped active" role="progressbar" aria-valuenow="{{ $progress[$i] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress[$i++] * 100 }}%;">
                            {{ number_format($progress[$i - 1]*100, 2, '.', ',') }}%
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endforeach
        @else
        <br> <br> <br>
        <h4 style="text-align: center;">Type something else to search for the topics.</h4>
        @endif
    </div>
</div>

<br> <br> <br>

@endsection