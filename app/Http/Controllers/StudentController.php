<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\Leaderboard;
use App\Models\Topic;
use App\Models\Avatar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
	public function profile() {
		$user = Auth::guard(session('role'))->user();
		$quizzesTaken = $user->getQuizzes;
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
				$numberOfQuiz = $topic->getArticles->count();
				$quizzesTakenCount = 0;
				foreach ($topic->getArticles as $article) {
					// return Quiz::find(1);
					// return Quiz::where('article_id', $article->id)->get();

					if ($quizzesTaken->contains($article->getQuiz))
						$quizzesTakenCount++;
				}
				$progress[$i++] = $quizzesTakenCount / $numberOfQuiz;
			}
		}

		// return $progress;
		return response(view('student.profile', ['user' => $user, 'progress' => $progress]));
	} 

	public function edit() {
		$user = Auth::guard(session('role'))->user();
		return response(view('student.changeUsernameOrEmail', ['user' => $user]));
	}

	public function editPassword() {
		$user = Auth::guard(session('role'))->user();
		return response(view('student.changePassword', ['user' => $user]));
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

	public function update(Request $request) {
		$user = Auth::guard(session('role'))->user();

		$request->validate([
			'username' => ['required', 'max:255', Rule::unique('users')->ignore($user->id)],
			'email' => ['required', 'max:255', Rule::unique('users')->ignore($user->id)],
		]); // unique rule without itself 

		$user->update([
			'username' => $request->username,
			'email' => $request->email,
		]);
		$request->session()->flash('message', 'Username or email updated.');
		return $this->profile();
	}

	public function updatePassword(Request $request) {
		$user = Auth::guard(session('role'))->user();
		
		$request->validate([
			'oldPassword' => ['required', function ($attribute, $value, $fail) use ($user) {
				if (!Hash::check($value, $user->password))
					$fail('Old Password is not correct.');
			}],
			'new_password' => 'required|min:8|different:oldPassword',
			'new_password_confirmation' => 'same:new_password',
		]);

		$user->update([
			'password' => Hash::make($request->new_password),
		]);
		$request->session()->flash('message', 'Password updated.');
		return $this->profile();
	}

	public function avatar() {
		$user = Auth::guard(session('role'))->user();
		$user = User::findOrFail($user->id);

		if ($user->avatar_id == 0) {
			$userAvatarImagePath = "/images/AvatarIcon.png";
		} else {
			$userAvatarImagePath = Avatar::findOrFail($user->avatar_id)->image;
		}

		$avatars = Avatar::all();

		return response(view('student.avatar', ['userAvatarImagePath' => $userAvatarImagePath, 'avatars' => $avatars]));
	}

	public function changeAvatar($id) {
		$user = Auth::guard(session('role'))->user();
		$user = User::findOrFail($user->id);
		$user->avatar_id = $id;
		$user->save();
		$request->session()->flash('message', 'Avatar updated.');
		return redirect()->back();
	}
}
