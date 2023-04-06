@extends('layouts.app')

@section('title', 'Article')

@section('content')

<!DOCTYPE html>
<html lang="en-US">

<div class="container my-4">
    <a href="/home">Home</a> > <a href="/modules">Modules</a> > <a href="/modules/$moduleName">{{ $moduleNameToShow }}</a> > <a>{{ $topicName }}</a> > <a>{{ $article['title'] }}</a>
</div>

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
    <a href="challenges" class="btn cartoonish-btn">Start the quiz</a>
</div>

<br> <br>

@endsection