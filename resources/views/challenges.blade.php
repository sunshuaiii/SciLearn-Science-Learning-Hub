@extends('layouts.app')

@section('title', 'Start Challenges')

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

<br> <br> <br>
<h1 style="text-align: center;">Start Challenges</h1>
<hr>

<!-- The section includes a button with an onclick function to start a stopwatch and show the questions. -->
<div class="text-center">
    <button type="button" class="btn btn-primary" id="start-stopwatch" onclick="startStopwatch();">Start</button>
    <div id="stopwatch" class="text-center">Press Start To Start the Challenges</div>
</div>

<div class="container mt-5" hidden id="challenges-container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <form id="challenges-form" method="POST" action="{{ route('challenges.submit') }}" onsubmit="return validateSubmit();">
                @csrf

                <input type="hidden" name="start_time" id="start-time" value="">

                @foreach($questions as $question)

                <!-- to show the correct answers for testing purpose -->
                The answer is {{$question->answer}}
                <div class="challenges-card mx-auto">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Question {{ $loop->iteration }} - {{ $question->question }}</h5>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer{{ $loop->iteration }}" id="answer{{ $loop->iteration }}_1" value="1">
                                    <label class="form-check-label" for="answer{{ $loop->iteration }}_1">
                                        <label class="form-check-label" for="answer{{ $loop->iteration }}_1">
                                            1. {{ $question->option1 }}
                                        </label>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer{{ $loop->iteration }}" id="answer{{ $loop->iteration }}_2" value="2">
                                    <label class="form-check-label" for="answer{{ $loop->iteration }}_2">
                                        <label class="form-check-label" for="answer{{ $loop->iteration }}_2">
                                            2. {{ $question->option2 }}
                                        </label>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer{{ $loop->iteration }}" id="answer{{ $loop->iteration }}_3" value="3">
                                    <label class="form-check-label" for="answer{{ $loop->iteration }}_3">
                                        <label class="form-check-label" for="answer{{ $loop->iteration }}_3">
                                            3. {{ $question->option3 }}
                                        </label>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer{{ $loop->iteration }}" id="answer{{ $loop->iteration }}_4" value="4">
                                    <label class="form-check-label" for="answer{{ $loop->iteration }}_4">
                                        <label class="form-check-label" for="answer{{ $loop->iteration }}_4">
                                            4. {{ $question->option4 }}
                                        </label>
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
                <input type="hidden" name="questions" value="{{ json_encode($questions) }}">
                <input type="hidden" name="elapsed_time" id="elapsed-time">

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
        document.getElementById("start-time").value = startTime;
        document.getElementById("challenges-container").removeAttribute("hidden");
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

        // Calculate time taken
        var elapsedTime = Date.now() - startTime;
        // convert elapsed time to minutes and seconds
        var minutes = Math.floor(elapsedTime / (60 * 1000));
        var seconds = Math.floor((elapsedTime % (60 * 1000)) / 1000);
        var timeTaken = minutes + ' minutes ' + (seconds < 10 ? '0' + seconds : seconds) + ' seconds';
        // Add the time taken as a hidden input to the form
        var timeTakenInput = document.createElement("input");
        timeTakenInput.setAttribute("type", "hidden");
        timeTakenInput.setAttribute("name", "time_taken");
        timeTakenInput.setAttribute("value", timeTaken);
        document.getElementById("challenges-form").appendChild(timeTakenInput);
        document.getElementById('elapsed-time').value = elapsedTime;
        return true;
    }
</script>

@endsection