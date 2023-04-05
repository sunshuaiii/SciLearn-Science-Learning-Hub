<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Module;
use App\Models\Leaderboard;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
	public function profile() {
		$quizzesTaken = Auth::guard(session('role'))->user()->getQuizzes;
		// $quizzes = Quiz::getUsers->where('user_id')
		// $users = DB::table('users')
        //     ->join('userquizzes', 'users.id', '=', 'userquizzes.user_id')
        //     ->join('quizzes', 'quizzes.id', '=', 'userquizzes.quiz_id')
        //     ->join('topics', 'topics.id', '=', 'quizzes.topic_id')
        //     ->join('modules', 'modules.id', '=', 'topics.module_id')
        //     ->select('modules.name as module_name', 'topics.name as topic_name', 'quizzes.name as quiz_name')
        //     ->get();
		$progress = [];
		$i = 0;
		foreach (Module::all() as $module) {
			foreach ($module->getTopics as $topic) {
				$numberOfQuiz = $topic->getQuizzes->count();
				$quizzesTakenCount = 0;
				foreach ($topic->getQuizzes as $quiz) {
					if ($quizzesTaken->contains($quiz))
						$quizzesTakenCount++;
				}
				$progress[$i++] = $quizzesTakenCount / $numberOfQuiz;
			}
		}

		// return $progress;
		return response(view('student.profile', ['user' => $user, 'progress' => $progress]));
	}

    public function leaderboard() {
		$rankings = Leaderboard::get()
			->sortBy('duration')->take(10);
		$users = array();
		$i = 1;
		foreach ($rankings as $ranking) {
			array_push($users, array($i, User::find($ranking->user_id)->username, $ranking->duration));
			$i++;
		}
		// return $users;
		return response(view('student.leaderboard', ['users' => $users]));
	}
}
