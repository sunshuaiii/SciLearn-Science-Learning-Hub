<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;

Route::get('/home', [HomeController::class, 'index'])-> name('home');
Route::view('leaderboard', 'leaderboard');
Route::view('modules', 'modules');
Route::view('collections','collections');
Route::view('badges', 'badges');
Route::view('profile','profile');
Route::view('signIn', 'signIn');

Route::get('/test', [TestController::class, 'test'])-> name('test');