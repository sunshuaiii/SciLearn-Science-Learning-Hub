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
                    <h5 class="card-title text-center mb-4">{{ $question['question'] }}</h5>
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer" id="answer1" value="1">
                                    <label class="form-check-label" for="answer1">
                                        1. {{ $question['option1'] }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer" id="answer2" value="2">
                                    <label class="form-check-label" for="answer2">
                                        2. {{ $question['option2'] }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer" id="answer3" value="3">
                                    <label class="form-check-label" for="answer3">
                                        3. {{ $question['option3'] }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer" id="answer4" value="4">
                                    <label class="form-check-label" for="answer4">
                                        4. {{ $question['option4'] }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary mt-3" onclick="checkAnswer('{{ json_encode($question) }}')">Submit</button>
                    </form>
                    <div id="answer-feedback" class="mt-3 d-none"></div>
                    <br>
                </div>
            </div>
            <br>
            @endforeach
        </div>
    </div>
</div>

<script>
    function checkAnswer(question) {
        const correctAnswer = JSON.parse(question).answer;
        console.log(correctAnswer);
        if (document.querySelector('input[name="answer"]') === null) {
            console.log("Please select an answer!");

        } else {
            const selectedAnswer = document.querySelector('input[name="answer"]:checked').value; //bug
        }

        const answerFeedback = document.getElementById("answer-feedback");
        console.log(answerFeedback);

        if (selectedAnswer.toString() === correctAnswer.toString()) {
            answerFeedback.classList.remove("d-none");
            answerFeedback.classList.add("alert", "alert-success");
            answerFeedback.innerHTML = "You got it right!";
        } else {
            answerFeedback.classList.remove("d-none");
            answerFeedback.classList.add("alert", "alert-danger");
            answerFeedback.innerHTML = "Incorrect. The correct answer is " + correctAnswer + ".";
        }

    }
</script>

<br> <br> <br>

@endsection