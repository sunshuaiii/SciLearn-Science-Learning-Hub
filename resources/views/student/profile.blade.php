@extends('layouts.app')
 
@section('title', 'Profile')
 
@section('content')
<div class="container my-4">
    <a href="/home">Home </a> > <a href="/students/profile">Profile </a>
</div>

{{Auth::guard(session('role'))->user()->name}} <br/>

@include('student.progress')

@endsection