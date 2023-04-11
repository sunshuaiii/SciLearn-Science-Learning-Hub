@extends('layouts.app')

@section('title', "Topics")

@section('content')

<!DOCTYPE html>
<html lang="en-US">

<br>

<nav class="head-nav" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/modules">Modules</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $moduleNameToShow }}</li>
    </ol>
</nav>

<br> <br>

<h1 style="text-align: center;">{{$moduleNameToShow}}</h1>

<br>

@if($moduleName != 'challenges')
<h2 style="text-align: center;">Choose a topic</h1>
    <div class="container">
        <div class="row">

            <br> <br>

            <div class="container">
                <div class="row">
                    @if(count($topicsWithTag1) > 0)
                    <h4 class="card-title">Tag: {{ $topicsWithTag1->first()->tag }}</h4>
                    <div style="display:none">{{ $i=0 }}</div>
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
                            <div style="margin-bottom: 0.5rem;">
                                <div class="progress" style="height: 1.5rem;">
                                    <div class="progress-bar bg-success progress-bar-striped active" role="progressbar" aria-valuenow="{{ $progress[$i] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress[$i++] * 100 }}%;">
                                        {{ number_format($progress[$i - 1], 2, '.', ',') }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                    @if(count($topicsWithTag2) > 0)
                    <h4 class="card-title">Tag: {{ $topicsWithTag2->first()->tag }}</h4>
                    <div style="display:none">{{ $i=0 }}</div>
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
                            <div style="margin-bottom: 0.5rem;">
                                <div class="progress" style="height: 1.5rem;">
                                    <div class="progress-bar bg-success progress-bar-striped active" role="progressbar" aria-valuenow="{{ $progress[$i] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress[$i++] * 100 }}%;">
                                        {{ number_format($progress[$i - 1], 2, '.', ',') }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                    @if(count($topicsWithTag3) > 0)
                    <h4 class="card-title">Tag: {{ $topicsWithTag3->first()->tag }}</h4>
                    <div style="display:none">{{ $i=0 }}</div>
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
                            <div style="margin-bottom: 0.5rem;">
                                <div class="progress" style="height: 1.5rem;">
                                    <div class="progress-bar bg-success progress-bar-striped active" role="progressbar" aria-valuenow="{{ $progress[$i] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress[$i++] * 100 }}%;">
                                        {{ number_format($progress[$i - 1], 2, '.', ',') }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                    @if(count($topicsWithTag4) > 0)
                    <h4 class="card-title">Topics</h4>
                    <div style="display:none">{{ $i=0 }}</div>
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
                            <div style="margin-bottom: 0.5rem;">
                                <div class="progress" style="height: 1.5rem;">
                                    <div class="progress-bar bg-success progress-bar-striped active" role="progressbar" aria-valuenow="{{ $progress[$i] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress[$i++] * 100 }}%;">
                                        {{ number_format($progress[$i - 1], 2, '.', ',') }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($moduleName == 'challenges')
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

    <br> <br> <br>

    @endsection