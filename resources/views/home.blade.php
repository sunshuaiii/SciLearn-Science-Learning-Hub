@extends('layouts.app')

@section('title', 'Home')

@section('content')

<div class="container my-4">
  <a href="home">Home</a>
</div>

<br>

<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="card cartoonish-card">
        <div class="card-body">
          <h5 class="card-title">Module 1</h5>
          <p class="card-text">Learn about the contributions of famous scientists like Marie Curie, Nikola Tesla, and more!</p>
          <a href="/modules/famous-scientists" class="btn cartoonish-btn">Famous Scientists</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card cartoonish-card">
        <div class="card-body">
          <h5 class="card-title">Module 2</h5>
          <p class="card-text">Find out about some interesting and amazing fun facts about science you probably never even knew or heard of!</p>
          <a href="/modules/fun-facts" class="btn cartoonish-btn">Fun Facts</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card cartoonish-card">
        <div class="card-body">
          <h5 class="card-title">Module 3</h5>
          <p class="card-text">Explore around the learning center for wonderful topics on Physics, Chemistry, and Biology!</p>
          <a href="/modules/learning-center" class="btn cartoonish-btn">Learning Center</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card cartoonish-card">
        <div class="card-body">
          <h5 class="card-title">Module 4</h5>
          <p class="card-text">Challenge yourself to the quizzes to test your knowledge and memory after completing your lessons!</p>
          <a href="/modules/challenges" class="btn cartoonish-btn">Challenges</a>
        </div>
      </div>
    </div>
  </div>
</div>

<br> <br> <br>

<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://picsum.photos/800/400?random=1" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        <a href="#" class="btn btn-primary btn-cartoonish">Read More</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://picsum.photos/800/400?random=2" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        <a href="#" class="btn btn-primary btn-cartoonish">Read More</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://picsum.photos/800/400?random=3" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        <a href="#" class="btn btn-primary btn-cartoonish">Read More</a>
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

@endsection