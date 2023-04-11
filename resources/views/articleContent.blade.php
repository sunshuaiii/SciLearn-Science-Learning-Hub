@extends('layouts.app')

@section('title', 'Article')

@section('content')

<!DOCTYPE html>
<html lang="en-US">

<br>

<nav class="head-nav" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/modules">Modules</a></li>
        <li class="breadcrumb-item"><a href="/modules/{{ isset($moduleName) ? $moduleName : '' }}">{{ isset($moduleNameToShow) ? $moduleNameToShow : '' }}</a></li>
        <li class="breadcrumb-item"><a href="/modules/{{ isset($moduleName) ? $moduleName : '' }}/{{ isset($topicId) ? $topicId : '' }}">{{ isset($topicName) ? $topicName : '' }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ isset($article['title']) ? $article['title'] : '' }}</li>
    </ol>
</nav>

<br><br>

<h1 style="text-align: center;">{{ $article['title']}}</h1>

<br> <br>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="article-content">
                @foreach (explode("\n\n", $article->content) as $paragraph)
                <p>{{ $paragraph }}</p>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <?php
            $imagePath = $article['image'];
            ?>
            <img src="<?php echo $imagePath; ?>" alt="$article['title']" class="img-fluid">
        </div>
    </div>
</div>

<br> <br>

<div style="margin:3rem; text-align: center;">
    <h3> Attempt the quiz on this article.</h3>
    <a href={{$article['id']."/quiz"}} class="btn cartoonish-btn">Start the quiz</a>
</div>

<br> <br>

@endsection