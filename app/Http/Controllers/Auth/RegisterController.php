<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // no need to login again if already logined
        $this->middleware('guest')->except('logout');
		$this->middleware('guest:admin')->except('logout');
		$this->middleware('guest:student')->except('logout');
    }

	private function adminExist() {
		if(User::where('is_admin', true)->get()->count() > 0)
			abort(404);
	}

	public function showAdminRegisterForm() {
		$this->adminExist();			
			
		return view('auth.register', ['role' => 'admin']);
	}

	public function createAdmin(Request $request) {
		$this->adminExist();

		$request->validate([
			'username' => 'required|unique:users|max:255',
			'email' => 'required|unique:users|email|max:255',
			'password' => 'required|min:8|confirmed',
		]); // if invalid, return back to the original page and show error message
				
		$faker = Faker::create();
        $numberOfAvatars = DB::table('avatars')->count();

		User::create([
			'username' => $request->username,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'is_admin' => true,
			'avatar_id' => $faker->numberBetween(1, $numberOfAvatars),
		]);
		return redirect('/login/admin');
	}

	public function showStudentRegisterForm() {
		return view('auth.register', ['role' => 'student']);
	}

	public function createStudent(Request $request) {
		$request->validate([
			'username' => 'required|unique:users|max:255',
			'email' => 'required|unique:users|email|max:255',
			'password' => 'required|min:8|confirmed',
		]); // if invalid, return back to the original page and show error message

		$faker = Faker::create();
        $numberOfAvatars = DB::table('avatars')->count();

		User::create([
			'username' => $request->username,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'avatar_id' => $faker->numberBetween(1, $numberOfAvatars),
		]);

		return redirect('/login/student');
	}
}
