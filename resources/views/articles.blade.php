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

<br> <br> <br>
  <h1 style="text-align: center;">Articles</h1>
<hr>

<div class="container">
    <div class="row">
        @if(count($articles) > 0)
        <h4 class="card-title">Topic: {{ $topicName }}</h4>
        @foreach($articles as $article)
        <div class="col-md-3">
            <div class="card cartoonish-card">
                <div style="margin-bottom: 0.5rem;">
                    <span style="display: inline-block; padding: 2px 6px; border-radius: 10px; text-align: center; background-color: {{ $article->completed ? '#28a745' : '#5598e0' }};">
                        <span style="color: black;">
                            {{ $article->completed ? 'Completed' : 'In Progress' }}
                        </span>
                    </span>
                </div>
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