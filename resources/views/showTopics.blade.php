@extends('layouts.app')

@section('title', 'addTopic')

@section('content')

<div class="container my-4">
  <a href="home">Home</a> > <a href="/collections"> Collections  </a> > <a href="/collections/{{$collection['id']}}"> {{$collection['name']}} > <a href="/collections/{{$collection->id}}/addTopics"> Add Topics 
</div>

<br>

<div class="container">
  <h1 class="card-title">Added Topics in Collection</h1>
  <br>
  <div class="row">
    @forelse($addedTopics as $topic)
      <div class="col-md-3">
          <div class="card cartoonish-card">
              <img class="card-img" src="{{ $topic['image'] }}" alt="Card image">
              <div class="card-body">
                  <h5 class="card-title">{{ $topic['name'] }}</h5>
              </div>
              <form action="/collections/{{$collection['id']}}/removeTopics" method="post">
                @csrf
                <input type="text" name="id" id="id" hidden value="{{$topic['id']}}">
                <button type="submit" class="btn cartoonish-btn">Remove Topics</button>
              </form>
          </div>
      </div>
    @empty 
      <h4 class="center text-secondary">No topic added in this collection yet!</h4>
    @endforelse
  </div>

  <br><br>
  <h1 class="card-title">Other Topics</h1>
  <br>

  {{$topicsWithTag1}}

  <div class="row">
      @if(count($topicsWithTag1) <= 0 && count($topicsWithTag2) <= 0 && count($topicsWithTag3) <= 0 && count($topicsWithTag4) <= 0)
      <br><br><br><br><br><br><br><br><br>
      <h5 class="text-center text-secondary">No topic can be add now!</h5>
      <br><br><br><br><br>
      @else
          @if(count($topicsWithTag1) > 0)
          <h4 class="card-title">Tag: {{ $topicsWithTag1->first()->tag }}</h4>
          @foreach($topicsWithTag1 as $topic)
          <div class="col-md-3">
              <div class="card cartoonish-card">
                  <img class="card-img" src="{{ $topic['image'] }}" alt="Card image">
                  <div class="card-body">
                      <h5 class="card-title">{{ $topic['name'] }}</h5>
                  </div>
                  <form action="/collections/{{$collection['id']}}/addTopics" method="post">
                    @csrf
                    <input type="text" name="id" id="id" hidden value="{{$topic['id']}}">
                    <button type="submit" class="btn cartoonish-btn">Add Topics</button>
                  </form>
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
                  <form action="/collections/{{$collection['id']}}/addTopics" method="post">
                    @csrf
                    <input type="text" name="id" id="id" hidden value="{{$topic['id']}}">
                    <button type="submit" class="btn cartoonish-btn">Add Topics</button>
                  </form>
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
                  <form action="/collections/{{$collection['id']}}/addTopics" method="post">
                    @csrf
                    <input type="text" name="id" id="id" hidden value="{{$topic['id']}}">
                    <button type="submit" class="btn cartoonish-btn">Add Topics</button>
                  </form>
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
                  <form action="/collections/{{$collection['id']}}/addTopics" method="post">
                    @csrf
                    <input type="text" name="id" id="id" hidden value="{{$topic['id']}}">
                    <button type="submit" class="btn cartoonish-btn">Add Topics</button>
                  </form>
              </div>
          </div>
          @endforeach
          @endif
      @endif
  </div>
</div>

<br><br><br>


@endsection