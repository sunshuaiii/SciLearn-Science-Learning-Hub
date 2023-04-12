@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<br>

<nav class="head-nav" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </ol>
</nav>

<br> <br> <br>
  <h1 style="text-align: center;">User Profile</h1>
<hr>

<h3 style="text-align: center;">Hi, {{$user->username}} </h3> <br>

@if(session('message'))
<div class="alert alert-success">
    {{session('message')}}
</div>
@endif

@include('student.edit')

@include('student.progress')



@endsection