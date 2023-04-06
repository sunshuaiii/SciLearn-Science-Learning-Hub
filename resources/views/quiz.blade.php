@extends('layouts.app')

@section('title', 'Quiz')

@section('content')

<!DOCTYPE html>
<html lang="en-US">

<div class="container my-4">
  <a href="home">Home</a> > <a href="/modules"> Quiz </a>
</div>

<br> <br>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-sm-6">
      <div class="card bg-light">
        <div class="card-body">
          <h5 class="card-title text-center mb-4">An object starts its linear motion from rest. Which of the following quantities does not change throughout the motion?</h5>
          <form>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="answer" id="answer1" value="option1">
                  <label class="form-check-label" for="answer1">
                    London
                  </label>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="answer" id="answer2" value="option2">
                  <label class="form-check-label" for="answer2">
                    Berlin
                  </label>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="answer" id="answer3" value="option3">
                  <label class="form-check-label" for="answer3">
                    Paris
                  </label>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="answer" id="answer4" value="option4">
                  <label class="form-check-label" for="answer4">
                    Madrid
                  </label>
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-primary mt-3" onclick="checkAnswer()">Submit</button>
          </form>
          <div id="answer-feedback" class="mt-3 d-none"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function checkAnswer() {
    const correctAnswer = "option3";
    const selectedAnswer = document.querySelector('input[name="answer"]:checked').value;
    const answerFeedback = document.getElementById("answer-feedback");
    
    if (selectedAnswer === correctAnswer) {
      answerFeedback.classList.remove("d-none");
      answerFeedback.classList.add("alert", "alert-success");
      answerFeedback.innerHTML = "Correct! Paris is the capital of France.";
    } else {
      answerFeedback.classList.remove("d-none");
      answerFeedback.classList.add("alert", "alert-danger");
      answerFeedback.innerHTML = "Incorrect. The correct answer is Paris.";
    }
  }
</script>

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