@extends('layouts.app')

@section('title', "Topics")

@section('content')

<!DOCTYPE html>
<html lang="en-US">

<div class="container my-4">
    <a href="/home">Home</a> > <a href="/modules">Modules</a> > <a>{{ $moduleNameToShow }}</a>
</div>

<br> <br>

<h1 style="text-align: center;">{{$moduleNameToShow}}</h1>

<br>

@if($moduleName != 'challenges')
<h2 style="text-align: center;">Choose a topic</h1>
    <div class="container">
        <div class="row">
            @if(count($topicsWithTag1) > 0)
            <h4 class="card-title">Tag: {{ $topicsWithTag1->first()->tag }}</h4>
            @foreach($topicsWithTag1 as $topic)
            <div class="col-md-3">
                <div class="card cartoonish-card">
                    <img class="card-img" src="{{ $topic['image'] }}" alt="Card image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $topic['name'] }}</h5>
                    </div>
                    <div class="card-btn">
                        <a href={{$moduleName."/".$topic['id']}} class="btn cartoonish-btn">Start Learning</a>
                    </div>
                </div>
            </div>
            @endforeach
            @endif

            @if(count($topicsWithTag2) > 0)
            <h4 class="card-title">Tag: {{ $topicsWithTag2->first()->tag }}</h4>
            @foreach($topicsWithTag2 as $topic)
            <div class="col-md-3">
                <div class="card cartoonish-card">
                    <img class="card-img" src="{{ $topic['image'] }}" alt="Card image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $topic['name'] }}</h5>
                    </div>
                    <div class="card-btn">
                        <a href={{$moduleName."/".$topic['id']}} class="btn cartoonish-btn">Start Learning</a>
                    </div>
                </div>
            </div>
            @endforeach
            @endif

            @if(count($topicsWithTag3) > 0)
            <h4 class="card-title">Tag: {{ $topicsWithTag3->first()->tag }}</h4>
            @foreach($topicsWithTag3 as $topic)
            <div class="col-md-3">
                <div class="card cartoonish-card">
                    <img class="card-img" src="{{ $topic['image'] }}" alt="Card image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $topic['name'] }}</h5>
                    </div>
                    <div class="card-btn">
                        <a href={{$moduleName."/".$topic['id']}} class="btn cartoonish-btn">Start Learning</a>
                    </div>
                </div>
            </div>
            @endforeach
            @endif

            @if(count($topicsWithTag4) > 0)
            <h4 class="card-title">Topics</h4>
            @foreach($topicsWithTag4 as $topic)
            <div class="col-md-3">
                <div class="card cartoonish-card">
                    <img class="card-img" src="{{ $topic['image'] }}" alt="Card image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $topic['name'] }}</h5>
                    </div>
                    <div class="card-btn">
                        <a href={{$moduleName."/".$topic['id']}} class="btn cartoonish-btn">Start Learning</a>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>

    @elseif($moduleName == 'challenges')
    <div class="container">
        <div class="row">
            <div class="col-md-3; text-align: center;">
                <div class="text-card">
                    <div class="card-body">
                        <h3 class="card-title">Challenge yourself to complete all 10 random questions correctly to enter the leaderboard!</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br> <br>

    @include('startChallenge')

    @endif

    <br> <br> <br>

    @endsection