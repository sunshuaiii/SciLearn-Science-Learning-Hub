@extends('layouts.app')

@section('title', "Topics")

@section('content')

@isset($collection)
<h1>Collection is set</h1>
@endisset

<br>

<nav class="head-nav" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/collections">Collections</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $collection['name'] }}</li>
  </ol>
</nav>

<br> <br>

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
          <li><a class="dropdown-item" href="/collections/{{ $collection['id'] }}/topics">Add or Delete Topics</a></li>
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

  <div class="container">
    <div class="row">
      @if(count($topicsWithTag1) <= 0 && count($topicsWithTag2) <=0 && count($topicsWithTag3) <=0 && count($topicsWithTag4) <=0) <br><br><br><br><br><br><br><br><br>
        <br><br>
        <h5 class="text-center text-secondary">You do not have any topic in this collection yet!</h5>
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
      @endif
    </div>
  </div>

  @include('editCollectionModal', ['collectionId' => $collection['id'], 'collectionName' => $collection['name']])
  @include('deleteCollectionModal', ['collectionId' => $collection['id']])
</div>

<br> <br> <br>

@endsection