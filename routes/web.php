<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ModuleController;
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

// modules
Route::view('/modules', 'modules');
Route::view('/modules/learning-center', 'learning-center');
Route::view('/modules/fun-facts', 'fun-facts');
Route::view('/modules/challenges', 'challenges');

// learning center
Route::get('/modules/{moduleName}', [ModuleController::class, 'showTopics']);



// leaderboard
Route::get('leaderboard', [StudentController::class, 'leaderboard']);

// if students want to do quiz, ask them to login first
Route::middleware(['auth'])->group(function () {
	// Route::get('/students/profile', [StudentController::class, 'profile']);
	// using the same controller
	Route::controller(StudentController::class)->group(function() {
		Route::get('/students/profile', 'profile');
		Route::get('/students/progress', 'progress');
	});
});

// Route::resource('modules', ModuleController::class);
Route::resource('modules.topics', TopicController::class)->shallow();
Route::resource('modules.topics.articles', ArticleController::class)->shallow();
Route::resource('modules.topics.quizzess', QuizController::class)->shallow();
Route::resource('students.collections', CollectionController::class)->shallow();
Route::resource('students.badges', BadgeController::class)->shallow();

Route::get('/test', [TestController::class, 'test'])->name('test');

/*
 * Actions Handled by Resource Controllers
 * HTTP Request		URL		 						Action		Route Name
 * get				/users							index		users.index
 * get				/users/create					create		users.create
 * post				/users							store		users.store
 * get				/users/{user}					show		users.show
 * get				/users/{user}/edit				edit		users.edit
 * put/patch		/users/{user}					update		users.update
 * delete			/users/{user}					destroy		users.destroy
 * 
 * using shallow nesting 
 * get				/users/{user}/drinks			index		users.drinks.index
 * get				/users/{user}/drinks/create		create		users.drinks.create
 * post				/users/{user}/drinks			store		users.drinks.store
 * get				/drinks/{drink}					show		drinks.show
 * get				/drinks/{drink}/edit			edit		drinks.edit
 * put/patch		/drinks/{drink}					update		drinks.update
 * delete			/drinks/{drink}					destroy		drinks.destroy
 */
