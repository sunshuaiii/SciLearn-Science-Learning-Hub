@extends('layouts.app')

@section('title', 'Modules')

@section('content')

<!DOCTYPE html>
<html lang="en-US">

<br>

<nav class="head-nav" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Modules</li>
  </ol>
</nav>

@include('modulesContent')

@endsection