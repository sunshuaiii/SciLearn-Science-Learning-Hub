@extends('layouts.app')

@section('title', 'Challenges')

@section('content')

<!DOCTYPE html>
<html lang="en-US">

<br>

<nav class="head-nav" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/modules">Modules</a></li>
        <li class="breadcrumb-item active" aria-current="page">Challenges</li>
    </ol>
</nav>

// todo: show challenges result
// todo: add record to leaderboard

<div class="text-center">
    <button type="button" class="btn btn-primary" id="start-stopwatch" onclick="startStopwatch(); showQuestions()">Start</button>
    <div id="stopwatch" class="text-center">Press Start To Start the Challenges</div>
</div>

<div class="container mt-5" hidden id="challenges-container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <form id="challenges-form" method="POST" action="{{ route('challenges.submit') }}" onsubmit="return validateSubmit();">
                @csrf

                @foreach($questions as $question)
                <div class="challenges-card mx-auto">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Question {{ $loop->iteration }} - {{ $question->question }}</h5>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer{{ $loop->iteration }}" id="answer{{ $loop->iteration }}" value="1">
                                    <label class="form-check-label" for="answer1{{ $loop->iteration }}">
                                        1. {{ $question->option1 }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer{{ $loop->iteration }}" id="answer{{ $loop->iteration }}" value="2">
                                    <label class="form-check-label" for="answer2{{ $loop->iteration }}">
                                        2. {{ $question->option2 }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer{{ $loop->iteration }}" id="answer{{ $loop->iteration }}" value="3">
                                    <label class="form-check-label" for="answer3{{ $loop->iteration }}">
                                        3. {{ $question->option3 }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer{{ $loop->iteration }}" id="answer{{ $loop->iteration }}" value="4">
                                    <label class="form-check-label" for="answer4{{ $loop->iteration }}">
                                        4. {{ $question->option4 }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="answer-feedback{{ $loop->iteration }}" class="mt-3 d-none"></div>
                        <br>
                    </div>
                </div>
                <br>
                @endforeach
                <button type="submit" id="submit-button" class="btn btn-primary mt-1 center">Submit</button>
            </form>
        </div>
    </div>
</div>

<br> <br> <br>

<script>
    var startTime;
    var intervalId;

    function startStopwatch() {
        startTime = Date.now();
        intervalId = setInterval(updateStopwatch, 10);
        document.getElementById("start-stopwatch").disabled = true;
    }

    function updateStopwatch() {
        var elapsedTime = Date.now() - startTime;
        var minutes = Math.floor(elapsedTime / (60 * 1000));
        var seconds = Math.floor((elapsedTime % (60 * 1000)) / 1000);
        document.getElementById('stopwatch').innerHTML = minutes + ':' + (seconds < 10 ? '0' + seconds : seconds);
    }

    function stopStopwatch() {
        clearInterval(intervalId);
    }

    function showQuestions() {
        document.getElementById("challenges-container").removeAttribute("hidden");
    }

    function validateSubmit() {
        // check if at least one answer is selected for each question
        var questions = document.querySelectorAll('.challenges-card');
        for (var i = 0; i < questions.length; i++) {
            var questionNumber = i + 1;
            var answerSelected = false;
            var answerInputs = questions[i].querySelectorAll('input[type="radio"]');
            for (var j = 0; j < answerInputs.length; j++) {
                if (answerInputs[j].checked) {
                    answerSelected = true;
                    stopStopwatch();
                    break;
                }
            }
            if (!answerSelected) {
                // if no answer is selected, show an error message and stop form submission
                var errorMessage = 'Please select an answer for Question ' + questionNumber + '.';
                alert(errorMessage);
                return false;
            }
        }
        return true;
    }
</script>

@endsection