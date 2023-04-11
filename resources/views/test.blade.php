<!DOCTYPE html>
<html lang="en-US">

<br> <br>

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <form method="POST" action="{{ route('quiz.submit') }}">
                @csrf

                @foreach($questions as $question)
                <div class="quiz-card mx-auto">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Question {{ $loop->iteration }} - {{ $question->question }}</h5>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer{{ $loop->iteration }}" id="answer1{{ $loop->iteration }}" value="1">
                                    <label class="form-check-label" for="answer1{{ $loop->iteration }}">
                                        1. {{ $question->option1 }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer{{ $loop->iteration }}" id="answer2{{ $loop->iteration }}" value="2">
                                    <label class="form-check-label" for="answer2{{ $loop->iteration }}">
                                        2. {{ $question->option2 }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer{{ $loop->iteration }}" id="answer3{{ $loop->iteration }}" value="3">
                                    <label class="form-check-label" for="answer3{{ $loop->iteration }}">
                                        3. {{ $question->option3 }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer{{ $loop->iteration }}" id="answer4{{ $loop->iteration }}" value="4">
                                    <label class="form-check-label" for="answer4{{ $loop->iteration }}">
                                        4. {{ $question->option4 }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary mt-3" onclick="checkAnswer('{{ json_encode($question) }}', {{ $loop->iteration }})">Submit</button>

                        <div id="answer-feedback{{ $loop->iteration }}" class="mt-3 d-none"></div>
                        <br>
                    </div>
                </div>
                <br>
                @endforeach
            </form>
        </div>
    </div>
</div>

<script>
    var timeLimit = 120; // 2 minutes in seconds
    var timeElapsed = 0;
    var timerId;

    function startTimer() {
        timerId = setInterval(countdown, 1000);
        document.getElementById("start-timer-btn").disabled = true;
    }

    function countdown() {
        timeElapsed++;
        const timeRemaining = timeLimit - timeElapsed;
        document.getElementById("timer").innerHTML = formatTime(timeRemaining);

        if (timeRemaining <= 0) {
            clearInterval(timerId);
            document.getElementById("submit-btn").click();
        }
    }

    function formatTime(seconds) {
        const min = Math.floor(seconds / 60);
        const sec = seconds % 60;
        return `${min.toString().padStart(2, '0')}:${sec.toString().padStart(2, '0')}`;
    }

    function checkAnswer(question, questionNumber) {
        const correctAnswer = JSON.parse(question).answer;
        const selectedAnswer = document.querySelector('input[name="answer' + questionNumber + '"]:checked');
        const answerFeedback = document.getElementById("answer-feedback" + questionNumber);
        const radioButtons = document.querySelectorAll('input[type="radio"]');

        // check if an answer is selected
        if (!selectedAnswer) {
            // If not, it shows an error message.
            answerFeedback.classList.remove("d-none");
            answerFeedback.classList.add("alert", "alert-danger");
            answerFeedback.innerHTML = "Please select an answer!";
        } else {
            // If an answer is selected, it disables all radio buttons for that question to prevent changing the answer. 
            $('input[name=answer' + questionNumber + ']').attr('disabled', true);

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
                answerFeedback.innerHTML = "Incorrect. The correct answer is " + correctAnswer + ".";
            }
        }
    }
</script>

<br> <br> <br>