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
            @foreach()
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
            @endforeach
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

<br> <br> <br>

@endsection