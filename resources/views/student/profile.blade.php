@extends('layouts.app')
 
@section('title', 'Profile')
 
@section('content')
{{Auth::guard(session('role'))->user()->name}}




@endsection