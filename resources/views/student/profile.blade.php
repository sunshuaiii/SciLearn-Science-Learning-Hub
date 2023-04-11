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

<br>

{{$user->username}} <br/> <br/>

@include('student.edit')

@include('student.progress')



@endsection