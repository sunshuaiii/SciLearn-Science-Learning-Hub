@extends('layouts.app')

@section('title', 'Modules')

@section('content')

<!DOCTYPE html>
<html lang="en-US">

<div class="container my-4">
  <a href="home">Home</a> > <a href="/modules"> Modules </a>
</div>

@include('modulesContent')

@endsection