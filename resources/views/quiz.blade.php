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
    <div class="row">
        <div class="col-md-8 mx-auto">
            @foreach($questions as $question)
            <div class="quiz-card mx-auto">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Question {{ $loop->iteration }} - {{ $question['question'] }}</h5>
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer{{ $loop->iteration }}" id="answer1{{ $loop->iteration }}" value="1">
                                    <label class="form-check-label" for="answer1{{ $loop->iteration }}">
                                        1. {{ $question['option1'] }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer{{ $loop->iteration }}" id="answer2{{ $loop->iteration }}" value="2">
                                    <label class="form-check-label" for="answer2{{ $loop->iteration }}">
                                        2. {{ $question['option2'] }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer{{ $loop->iteration }}" id="answer3{{ $loop->iteration }}" value="3">
                                    <label class="form-check-label" for="answer3{{ $loop->iteration }}">
                                        3. {{ $question['option3'] }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer{{ $loop->iteration }}" id="answer4{{ $loop->iteration }}" value="4">
                                    <label class="form-check-label" for="answer4{{ $loop->iteration }}">
                                        4. {{ $question['option4'] }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary mt-3" onclick="checkAnswer('{{ json_encode($question) }}', {{ $loop->iteration }})">Submit</button>
                    </form>
                    <div id="answer-feedback{{ $loop->iteration }}" class="mt-3 d-none"></div>
                    <br>
                </div>
            </div>
            <br>
            @endforeach
        </div>
    </div>
</div>

<script>
    function checkAnswer(question, questionNumber) {
        const correctAnswer = JSON.parse(question).answer;
        const selectedAnswer = document.querySelector('input[name="answer' + questionNumber + '"]:checked');
        const answerFeedback = document.getElementById("answer-feedback" + questionNumber);

        if (!selectedAnswer) {
            answerFeedback.classList.remove("d-none");
            answerFeedback.classList.add("alert", "alert-danger");
            answerFeedback.innerHTML = "Please select an answer!";
        } else {
            if (selectedAnswer.value.toString() === correctAnswer.toString()) {
                answerFeedback.classList.remove("d-none", "alert-danger");
                answerFeedback.classList.add("alert", "alert-success");
                answerFeedback.innerHTML = "You got it right!";
            } else {
                answerFeedback.classList.remove("d-none", "alert-success");
                answerFeedback.classList.add("alert", "alert-danger");
                answerFeedback.innerHTML = "Incorrect. The correct answer is " + correctAnswer + ".";
            }
        }
    }
</script>

<br> <br> <br>

@endsection