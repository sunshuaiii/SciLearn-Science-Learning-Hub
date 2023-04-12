@extends('layouts.app')

@section('title', "Topics")

@section('content')

<br>

<nav class="head-nav" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/profile">Profile</a></li>
    <li class="breadcrumb-item active" aria-current="page">Avatar</li>
  </ol>
</nav>

<br> <br> <br>
<h1 style="text-align: center;">Current Avatar</h1>
<hr>
<div class="container">
  <div class="col">
    <img src="{{$userAvatarImagePath}}" class="avatar-img" alt="avatar image">
  </div>
</div>

<br> <br> <br>
<h1 style="text-align: center;">Avatar List</h1>
<hr>

<div class="container">
  <div class="row row-cols-3 row-cols-md-5 g-4">
    @foreach($avatars as $avatar)
    <div class="col">
      <img src="{{$avatar['image']}}" class="avatar-img" alt="avatar image">
      <br>
      <form action="/students/profile/avatar/changeAvatar/{{$avatar['id']}}" method="post">
        @method('put')
        @csrf
        <button type="submit" class="btn btn-primary">Select Avatar</button>
      </form>
    </div>
    @endforeach
  </div>
</div>

<br><br><br>

@endsection