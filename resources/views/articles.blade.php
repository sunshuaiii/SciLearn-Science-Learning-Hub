@extends('layouts.app')

@section('title', 'Articles')

@section('content')

<!DOCTYPE html>
<html lang="en-US">

<div class="container my-4">
    <a href="/home">Home</a> > <a href="/modules">Modules</a> > <a href="$moduleName">{{ $moduleNameToShow }}</a> > <a href="$topicName">{{ $topicName }}</a>
</div>

<h1 style="text-align: center;">Articles</h1>

<br> <br> <br>

<div class="container">
    <div class="row">
        @if(count($articles) > 0)
        <h4 class="card-title">{{ $topicName }}</h4>
        @foreach($articles as $article)
        <div class="col-md-3">
            <div class="card cartoonish-card">
                <div class="card-body">
                    <h5 class="card-title">{{ $article['title'] }}</h5>
                    <!-- image -->
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