@extends('layouts.app')

@section('title', 'Quiz')

@section('content')

<!DOCTYPE html>
<html lang="en-US">

<br>

<nav class="head-nav" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/modules">Modules</a></li>
        <li class="breadcrumb-item"><a href="/modules/{{ isset($moduleName) ? $moduleName : '' }}">{{ isset($moduleNameToShow) ? $moduleNameToShow : '' }}</a></li>
        <li class="breadcrumb-item"><a href="/modules/{{ isset($moduleName) ? $moduleName : '' }}/{{ isset($topicId) ? $topicId : '' }}">{{ isset($topicName) ? $topicName : '' }}</a></li>
        <li class="breadcrumb-item"><a href="/modules/{{ isset($moduleName) ? $moduleName : '' }}/{{ isset($topicId) ? $topicId : '' }}/{{ isset($articleId) ? $articleId : '' }}">{{ isset($articleTitle) ? $articleTitle : '' }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Quiz</li>
    </ol>
</nav>

<br> <br> <br>
  <h1 style="text-align: center;">Quiz</h1>
<hr>

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <form id="quiz-form" method="POST" action="{{ route('quiz.submit', ['moduleName' => $moduleName, 'topicId' => $topicId, 'articleId' => $articleId]) }}" onsubmit="return validateQuiz()">
                @csrf

                @foreach($questions as $question)
                <div class="quiz-card mx-auto">
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
                        <button type="button" id="check-answer-{{ $loop->iteration }}" class="btn btn-primary mt-3" onclick="checkAnswer('{{ json_encode($question) }}', {{ $loop->iteration }})">Check Answer</button>

                        <div id="answer-feedback{{ $loop->iteration }}" class="mt-3 d-none"></div>
                        <br>
                    </div>
                </div>
                <br>
                @endforeach
                <button type="submit" class="btn btn-primary mt-1 center">Submit Quiz</button>
            </form>
        </div>
    </div>
</div>

<script>
    function checkAnswer(question, questionNumber) {
        const correctAnswer = JSON.parse(question).answer;
        const selectedAnswer = document.querySelector('input[name="answer' + questionNumber + '"]:checked');
        const answerFeedback = document.getElementById("answer-feedback" + questionNumber);

        // check if an answer is selected
        if (!selectedAnswer) {
            // If not, it shows an error message.
            answerFeedback.classList.remove("d-none");
            answerFeedback.classList.add("alert", "alert-danger");
            answerFeedback.innerHTML = "Please select an answer!";
        } else {
            // can only check the answer once
            document.getElementById("check-answer-" + questionNumber).disabled = true;

            // checks whether the selected answer is correct or not 
            if (selectedAnswer.value.toString() === correctAnswer.toString()) {
                // if the answer is correct, it shows a success message
                answerFeedback.classList.remove("d-none", "alert-danger");
                answerFeedback.classList.add("alert", "alert-success");
                answerFeedback.innerHTML = "You got it right!";
            } else {
                // otherwise, it shows an error message with the correct answer.
                answerFeedback.classList.remove("d-none", "alert-success");
                answerFeedback.classList.add("alert", "alert-danger");
                answerFeedback.innerHTML = "Incorrect answer.";
            }
        }
    }

    function validateQuiz() {
        // check if at least one answer is selected for each question
        var questions = document.querySelectorAll('.quiz-card');
        for (var i = 0; i < questions.length; i++) {
            var questionNumber = i + 1;
            var answerSelected = false;
            var answerInputs = questions[i].querySelectorAll('input[type="radio"]');
            for (var j = 0; j < answerInputs.length; j++) {
                if (answerInputs[j].checked) {
                    answerSelected = true;
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

<br> <br> <br>

@endsection