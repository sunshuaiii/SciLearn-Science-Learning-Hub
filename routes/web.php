<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::redirect('/', '/home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

#region authentication
Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/login/student', [LoginController::class,'showStudentLoginForm']);
Route::post('/login', [LoginController::class,'login']);
Route::get('/register/admin', [RegisterController::class,'showAdminRegisterForm']);
Route::post('/register/admin', [RegisterController::class,'createAdmin']);
Route::get('/register/student', [RegisterController::class,'showStudentRegisterForm']);
Route::post('/register/student', [RegisterController::class,'createStudent']);
Route::get('/logout', [LoginController::class,'logout']);
#endregion

Route::view('leaderboard', 'leaderboard');
Route::view('modules', 'modules');
Route::view('collections','collections');
Route::view('badges', 'badges');
Route::view('profile','profile');
Route::view('signIn', 'signIn');

Route::get('/test', [TestController::class, 'test'])->name('test');