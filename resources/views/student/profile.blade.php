@extends('layouts.app')
 
@section('title', 'Profile')
 
@section('content')
<div class="container my-4">
    <a href="/home">Home </a> > <a href="/students/profile">Profile </a>
</div>

Hi, {{$user->username}} <br/> <br/>

@if(session('message'))
<div class="alert alert-success">
	{{session('message')}}
</div>
@endif

@include('student.edit')

@include('student.progress')



@endsection