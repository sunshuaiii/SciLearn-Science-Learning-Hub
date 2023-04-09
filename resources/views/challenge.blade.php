@extends('layouts.app')

@section('title', 'Challenge')

@section('content')

<!DOCTYPE html>
<html lang="en-US">

<div class="container my-4">
    <a href="home">Home</a> > <a href="/modules"> Modules </a> > <a href="challenges"> Challenge </a>
</div>

@include('quizContent')

@endsection