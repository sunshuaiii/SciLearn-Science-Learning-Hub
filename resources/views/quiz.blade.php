@extends('layouts.app')

@section('title', 'Quiz')

@section('content')

<!DOCTYPE html>
<html lang="en-US">

<div class="container my-4">
    <a href="home">Home</a> > <a href="/modules"> Modules </a> > <a href="quiz"> Quiz </a>
</div>

@include('quizContent')

// todo: add a record to userquizzes if the user completed a quiz

@endsection