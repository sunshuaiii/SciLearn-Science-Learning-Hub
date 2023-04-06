@extends('layouts.app')

@section('title', 'Modules')

@section('content')

<div class="container my-4">
  <a href="home">Home</a> > <a href="/modules"> Modules </a>
</div>

<br> <br>

<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="card cartoonish-card">
        <div class="card-body">
          <h5 class="card-title">Module 1</h5>
          <p class="card-text">Learn about the contributions of famous scientists like Marie Curie, Nikola Tesla, and more!</p>
        </div>
        <div class="card-btn">
          <a href="/modules/famous-scientists" class="btn cartoonish-btn">Famous Scientists</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card cartoonish-card">
        <div class="card-body">
          <h5 class="card-title">Module 2</h5>
          <p class="card-text">Find out about some interesting and amazing fun facts about science you probably never even knew or heard of!</p>

        </div>
        <div class="card-btn">
          <a href="/modules/fun-facts" class="btn cartoonish-btn">Fun Facts</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card cartoonish-card">
        <div class="card-body">
          <h5 class="card-title">Module 3</h5>
          <p class="card-text">Explore around the learning center for wonderful topics on Physics, Chemistry, and Biology!</p>
        </div>
        <div class="card-btn">
          <a href="/modules/learning-center" class="btn cartoonish-btn">Learning Center</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card cartoonish-card">
        <div class="card-body">
          <h5 class="card-title">Module 4</h5>
          <p class="card-text">Challenge yourself to the quizzes to test your knowledge and memory after completing your lessons!</p>
        </div>
        <div class="card-btn">
          <a href="/modules/challenges" class="btn cartoonish-btn">Challenges</a>
        </div>
      </div>
    </div>
  </div>
</div>

<br> <br> <br>

@endsection