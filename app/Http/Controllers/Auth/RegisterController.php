<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Student;
use App\Models\Admin;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
		if(Admin::get()->count() > 0)
		abort(404);
	}

	public function showAdminRegisterForm() {
		$this->adminExist();			
			
		return view('auth.register', ['role' => 'admin']);
	}

	public function createAdmin(Request $request) {
		$this->adminExist();

		$request->validate([
			'name' => 'required|unique:admins|max:255',
			'email' => 'required|unique:admins|email|max:255',
			'password' => 'required|min:8|confirmed',
		]); // if invalid, return back to the original page and show error message
				
		Admin::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

		return redirect('/login/admin');
	}

	public function showStudentRegisterForm() {
		return view('auth.register', ['role' => 'student']);
	}

	public function createStudent(Request $request) {
		$request->validate([
			'name' => 'required|unique:students|max:255',
			'email' => 'required|unique:students|email|max:255',
			'password' => 'required|min:8|confirmed',
		]); // if invalid, return back to the original page and show error message
				
		Student::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

		return redirect('/login/student');
	}
}
