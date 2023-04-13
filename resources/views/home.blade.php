@extends('layouts.app')

@section('title', 'Home')

@section('content')
<br>

<nav class="head-nav" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Home</li>
  </ol>
</nav>

<br> <br>

<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('images/home/isaac.jpg') }}" class="d-block w-100">
      <div class="carousel-caption d-none d-md-block">
        <h5>If I have seen further it is by standing on the shoulders of Giants.</h5>
        <p>- Isaac Newton</p>
        <a href="modules" class="btn btn-primary btn-cartoonish">Read More</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/home/marie.jpg') }}" class="d-block w-100">
      <div class="carousel-caption d-none d-md-block">
        <h5>Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less.</h5>
        <p>- Marie Curie</p>
        <a href="modules" class="btn btn-primary btn-cartoonish">Read More</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/home/galileo.png') }}" class="d-block w-100">
      <div class="carousel-caption d-none d-md-block">
        <h5>You cannot teach a man anything; you can only help him discover it in himself.</h5>
        <p>- Galileo Galilei</p>
        <a href="modules" class="btn btn-primary btn-cartoonish">Read More</a>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<br> <br> <br>

<hr>

@include('modulesContent')

@endsection