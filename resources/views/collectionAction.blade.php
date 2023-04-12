@extends('layouts.app')

@section('title', "Topics Collected")

@section('content')


<br>

<nav class="head-nav" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/collections">Collections</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $collection['name'] }}</li>
  </ol>
</nav>

<br> <br> <br>
  <h1 style="text-align: center;">Topics Collected in {{ $collection['name'] }}</h1>
<hr>

<div class="container">
  @if($errors->any())
  <br>
  <div class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
    <span style="color: red;">{{ $error }}</span>
    @endforeach
  </div>
  @endif

  <div class="row">
    <div class="col-1">
      <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Actions
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/collections/{{ $collection['id'] }}/showTopics">Add or Delete Topics</a></li>
          <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editCollectionModal">Edit Collection Name</a></li>
        </ul>
      </div>
    </div>

    <div class="col-2">
      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCollectionModal">
        Delete Collection
      </button>
    </div>
  </div>

  <br><br>

  <div class="container">
    <div class="row">
      @if(count($famousScientistTopics) <= 0 && count($funFactsTopics) <=0 && count($learningCenterTopics) <=0 && count($challengesTopics) <=0) <br><br><br><br><br><br><br><br><br>
        <br><br>
        <h5 class="text-center text-secondary">You do not have any topic in this collection yet!</h5>
        <br><br><br><br><br>
      @else
        @if(count($famousScientistTopics) > 0)
          <h4 class="card-title">Module: Famous Scientist</h4>
          @foreach($famousScientistTopics as $topic)
          <div class="col-md-3">
            <div class="card cartoonish-card">
              <img class="card-img" src="{{ $topic['image'] }}" alt="Card image">
              <div class="card-body">
                <h5 class="card-title">{{ $topic['name'] }}</h5>
              </div>
              <div class="card-btn">
                <a href="/modules/famous-scientists/{{$topic['id']}}" class="btn cartoonish-btn">Start Learning</a>
              </div>
            </div>
          </div>
          @endforeach
        @endif

        @if(count($funFactsTopics) > 0)
          <h4 class="card-title">Module: Fun Facts</h4>
          @foreach($funFactsTopics as $topic)
          <div class="col-md-3">
            <div class="card cartoonish-card">
              <img class="card-img" src="{{ $topic['image'] }}" alt="Card image">
              <div class="card-body">
                <h5 class="card-title">{{ $topic['name'] }}</h5>
              </div>
              <div class="card-btn">
                <a href="/modules/fun-facts/{{$topic['id']}}" class="btn cartoonish-btn">Start Learning</a>
              </div>
            </div>
          </div>
          @endforeach
        @endif

        @if(count($learningCenterTopics) > 0)
          <h4 class="card-title">Module: Learning Center</h4>
          @foreach($learningCenterTopics as $topic)
          <div class="col-md-3">
            <div class="card cartoonish-card">
              <img class="card-img" src="{{ $topic['image'] }}" alt="Card image">
              <div class="card-body">
                <h5 class="card-title">{{ $topic['name'] }}</h5>
              </div>
              <div class="card-btn">
                <a href="/modules/learning-center/{{$topic['id']}}" class="btn cartoonish-btn">Start Learning</a>
              </div>
            </div>
          </div>
          @endforeach
        @endif
 
        @if(count($challengesTopics) > 0)
          <h4 class="card-title">Module: Challenges</h4>
          @foreach($challengesTopics as $topic)
          <div class="col-md-3">
            <div class="card cartoonish-card">
              <img class="card-img" src="{{ $topic['image'] }}" alt="Card image">
              <div class="card-body">
                <h5 class="card-title">{{ $topic['name'] }}</h5>
              </div>
              <div class="card-btn">
                <a href="/modules/challenges/{{$topic['id']}}" class="btn cartoonish-btn">Start Learning</a>
              </div>
            </div>
          </div>
          @endforeach
        @endif
      @endif
    </div>
  </div>

  @include('editCollectionModal', ['collectionId' => $collection['id'], 'collectionName' => $collection['name']])
  @include('deleteCollectionModal', ['collectionId' => $collection['id']])
</div>

<br> <br> <br>

@endsection