@extends('layouts.app')

@section('title', 'Quiz Result')

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
        <li class="breadcrumb-item active" aria-current="page">Quiz Results</li>
    </ol>
</nav>

<br> <br> <br>
  <h1 style="text-align: center;">Quiz Results</h1>
<hr>

<div style="text-align:center;">
    <h3>You can check your progress in the user profile.</h3>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Quiz Result') }}</div>

                <div class="card-body">
                    <p>Score: {{ $score }}/{{ $totalQuestions }}</p>
                    <p>Incorrect Answers: {{ $incorrectAnswers }}</p>
                    <p>Percentage: {{ $percentage }}%</p>

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
                            @for ($i = 0; $i < count($questions); $i++) <tr>
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