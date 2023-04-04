<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Leaderboard;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
	public function profile() {
		$user = Auth::guard(session('role'))->user();
		return response(view('student.profile', ['user' => $user]));
	}

    public function leaderboard() {
		$rankings = Leaderboard::get()
			->sortBy('duration');
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
