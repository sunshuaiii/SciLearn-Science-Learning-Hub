<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TopicController;

Route::view('/home', 'home');
Route::redirect('/', 'home');

#region authentication
Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/login/student', [LoginController::class, 'showStudentLoginForm']);
Route::post('/login/admin', [LoginController::class, 'loginAdmin']);
Route::post('/login/student', [LoginController::class, 'loginStudent']);
Route::get('/register/admin', [RegisterController::class, 'showAdminRegisterForm']);
Route::post('/register/admin', [RegisterController::class, 'createAdmin']);
Route::get('/register/student', [RegisterController::class, 'showStudentRegisterForm']);
Route::post('/register/student', [RegisterController::class, 'createStudent']);
Route::get('/logout', [LoginController::class, 'logout']);
#endregion

//search article and show result
Route::get('/search', [SearchController::class, 'search']);


// modules
Route::view('/modules', 'modules');
// Route to show topics for a module
Route::get('/modules/{moduleName}', [ModuleController::class, 'showTopics']);
Route::post('/modules/challenges/submit', [ModuleController::class, 'submitChallenges'])->name('challenges.submit');
// Route to show articles for a topic
Route::get('/modules/{moduleName}/{topicId}', [ModuleController::class, 'showArticles']);
// Route to show the content of an article
Route::get('/modules/{moduleName}/{topicId}/{articleId}', [ModuleController::class, 'showArticleContent']);

// leaderboard
Route::get('/leaderboard', [StudentController::class, 'leaderboard']);

// features for registered students
Route::middleware(['auth'])->group(function () {
	// using the same controller
	Route::controller(StudentController::class)->group(function () {
		Route::get('/students/profile', 'profile');
		Route::get('/students/progress', 'progress');
		Route::get('/students/profile/avatar', 'avatar');
		Route::put('/students/profile/avatar/changeAvatar/{id}', 'changeAvatar');
		Route::get('/students/edit', 'edit');
		Route::get('/students/password', 'editPassword');
		Route::put('/students', 'update');
		Route::put('/students/password', 'updatePassword');
	});

	// Route to start a quiz for an article
	Route::get('/modules/{moduleName}/{topicId}/{articleId}/quiz', [ModuleController::class, 'startQuiz']);
	Route::post('/modules/{moduleName}/{topicId}/{articleId}/quiz/submit', [ModuleController::class, 'submitQuiz'])->name('quiz.submit');

	// collection
	Route::get('/collections/{collectionId}/showTopics', [CollectionController::class, 'showTopics']);
	Route::post('/collections/{collectionId}/addTopic', [CollectionController::class, 'addTopic']);
	Route::post('/collections/{collectionId}/removeTopic', [CollectionController::class, 'removeTopic']);
	Route::resource('/collections', CollectionController::class);
});


Route::controller(AdminController::class)->group(function () {
	Route::get('/lecture_content', 'lectureContent');

	Route::get('/showModule/{id}', 'showModule');

	Route::get('/createTopic/{module_id}', 'createTopic');
	Route::post('/storeTopic', 'storeTopic');
	Route::get('/showTopic/{id}', 'showTopic');
	Route::get('/editTopic/{id}', 'editTopic');
	Route::put('/updateTopic/{id}', 'updateTopic');
	Route::delete('/destroyTopic/{id}', 'destroyTopic');

	Route::get('/createArticle/{topic_id}', 'createArticle');
	Route::post('/storeArticle', 'storeArticle');
	Route::get('/showArticle/{id}', 'showArticle');
	Route::get('/editArticle/{id}', 'editArticle');
	Route::put('/updateArticle/{id}', 'updateArticle');
	Route::delete('/destroyArticle/{id}', 'destroyArticle');

	Route::get('/createQuiz/{article_id}', 'createQuiz');
	Route::post('/storeQuiz', 'storeQuiz');
	Route::get('/showQuiz/{id}', 'showQuiz');
	Route::get('/editQuiz/{id}', 'editQuiz');
	Route::put('/updateQuiz/{id}', 'updateQuiz');
	Route::delete('/destroyQuiz/{id}', 'destroyQuiz');

	Route::get('/createQuestions/{quiz_id}', 'createQuestions');
	Route::post('/storeQuestions', 'storeQuestions');
	Route::get('/showQuestions/{id}', 'showQuestions');
	Route::get('/editQuestions/{id}', 'editQuestions');
	Route::put('/updateQuestions/{id}', 'updateQuestions');
	Route::delete('/destroyQuestions/{id}', 'destroyQuestions');
});


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