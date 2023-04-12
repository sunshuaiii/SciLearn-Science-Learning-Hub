@extends('layouts.app')

@section('title', "Collection Topics")

@section('content')

<br>

<nav class="head-nav" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/collections">Collections</a></li>
    <li class="breadcrumb-item"><a href="/collections/{{$collection['id']}}">{{ $collection['name'] }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Topics</a></li>
  </ol>
</nav>

<br> <br> <br>
  <h1 style="text-align: center;">Collection Topics</h1>
<hr>

<br> <br>

<div class="container">
  <h1>Added Topics</h1>
  <div class="row">
  @forelse($addedTopics as $topic)
    <div class="col-md-3">
        <div class="card cartoonish-card">
            <img class="card-img" src="{{ $topic['image'] }}" alt="Card image">
            <div class="card-body">
                <h5 class="card-title">{{ $topic['name'] }}</h5>
            </div>
            <form action="/collections/{{$collection['id']}}/removeTopic" method="post">
              @csrf
              <input type="text" hidden name="id" id="id" value="{{ $topic['id'] }}">
              <div class="card-btn">
                <button class="cartoonish-btn" type="submit">Remove Topic</button>
              </div>
            </form>
        </div>
    </div>
  @empty
    <br>
    <h4 class="text-secondary">No topics added in this collection yet!</h4>
    <br>
  @endforelse
  </div>

  <h1>Other Topics</h1>
  <div class="row">
  @forelse($otherTopics as $topic)
    <div class="col-md-3">
        <div class="card cartoonish-card">
            <img class="card-img" src="{{ $topic['image'] }}" alt="Card image">
            <div class="card-body">
                <h5 class="card-title">{{ $topic['name'] }}</h5>
            </div>
            <form action="/collections/{{$collection['id']}}/addTopic" method="post">
              @csrf
              <input type="text" hidden name="id" id="id" value="{{ $topic['id'] }}">
              <div class="card-btn">
                <button class="cartoonish-btn" type="submit">Add Topic</button>
              </div>
            </form>
        </div>
    </div>
  @empty
    <br>
    <h4 class="text-secondary">No topics available to add.</h4>
    <br>
  @endforelse
  </div>
  
</div>

<br> <br> <br>

@endsection