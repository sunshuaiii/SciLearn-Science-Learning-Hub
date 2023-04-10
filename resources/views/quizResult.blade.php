@extends('layouts.app')

@section('title', 'Quiz Result')

@section('content')

<!DOCTYPE html>
<html lang="en-US">

<div class="container my-4">
    <a href="home">Home</a> > <a href="/modules"> Modules </a> > <a href="quiz"> Quiz </a>
</div>

<br> <br> <br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Quiz Result') }}</div>

                <div class="card-body">
                    <p>Score: {{ $score }}/{{ $totalQuestions }}</p>
                    <p>Incorrect Answers: {{ $incorrectAnswers }}</p>
                    <p>Percentage: {{ $percentage }}%</p>
                    <p>Time Taken: {{ $timeTaken }} seconds</p>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Your Answer</th>
                                <th>Correct Answer</th>
                                <th>Explanation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($questions); $i++)
                            <tr>
                                <td>{{ $questions[$i]->question }}</td>
                                <td>{{ $answers[$i] }}</td>
                                <td>{{ $questions[$i]->answer }}</td>
                                <td>{{ $questions[$i]->explanation }}</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<br> <br> <br>

@endsection