@extends('layouts.app')

@section('title', 'Module Details')

@section('content')
<br>

<nav class="head-nav" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/lecture_content">Lecture Content</a></li>
        <li class="breadcrumb-item active" aria-current="page">Module Details</li>
    </ol>
</nav>

<br>


@if(session('message'))
<div class="alert alert-success">
    {{session('message')}}
</div>
@endif

<form id="readonly_form_id" class="form-horizontal">
	<div class="form-group row">
		<label for="name" class="control-label col-sm-2">Username</label>
		<input id="name" name="name" type="text" class="form-control col-sm-10" value="{{$module->name}}" readonly>
	</div>

	<div class="form-group row">
		<label for="email" class="control-label col-sm-2">Email</label>
		<input id="email" name="email" type="email" class="form-control col-sm-10" value="{{$user->email}}" readonly>
	</div>
	<br/>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<input type="button" id="edit" value="Edit" class="btn btn-primary"
				onclick="window.location.href='/students/edit';">
		</div>
	</div>
</form>

@endsection
