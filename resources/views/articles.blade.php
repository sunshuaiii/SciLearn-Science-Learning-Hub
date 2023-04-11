@extends('layouts.app')

@section('title', 'Articles')

@section('content')

<!DOCTYPE html>
<html lang="en-US">

<br>

<nav class="head-nav" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/modules">Modules</a></li>
        <li class="breadcrumb-item"><a href="/modules/{{ isset($moduleName) ? $moduleName : '' }}">{{ isset($moduleNameToShow) ? $moduleNameToShow : '' }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ isset($topicName) ? $topicName : '' }}</li>
    </ol>
</nav>

<br> <br>

<h1 style="text-align: center;">Articles</h1>

<br> <br>

<div class="container">
    <div class="row">
        @if(count($articles) > 0)
        <h4 class="card-title">Topic: {{ $topicName }}</h4>
        @foreach($articles as $article)
        <div class="col-md-3">
            <div class="card cartoonish-card">
                <img class="card-img" src="{{ $article['image'] }}" alt="Card image">
                <div class="card-body">
                    <h5 class="card-title">{{ $article['title'] }}</h5>
                </div>
                <div class="d-flex justify-content-center">
                    <a href={{"/modules/".$moduleName."/".$topicId."/".$article['id']}} class="btn cartoonish-btn">Show Article</a>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>

<br> <br> <br>

@endsection