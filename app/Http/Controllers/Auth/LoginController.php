<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Avatar;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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


	public function showAdminLoginForm() {
		return view('auth.login', ['role' => 'admin']);
	}

	public function showStudentLoginForm() {
		return view('auth.login', ['role' => 'student']);
	}

	public function loginAdmin(Request $request) {
		$credentials = $request->validate([
			'email' => 'required',
			'password' => 'required',
		]);

		if (Auth::guard($request->role)->attempt([
			'email' => $request->email, 
			'password' => $request->password, 
			'is_admin' => true],
			$request->get('remember')
			)) { // true if authentication was successful
			// An authenticated session will be started 
			session(['role' => $request->role]); // to tell which guard is authenticated
			
			$request->session()->regenerate(); // regenerate the user's session to prevent session fixation
			return redirect()->intended('/');
		}
		
		return back()->withErrors(['login failed' => 'Login failed. The email or password is incorrect.'])
					->withInput(); // with role hidden input
	}

	public function loginStudent(Request $request) {
		$credentials = $request->validate([
			'email' => ['required', function ($attribute, $value, $fail) {
				if (User::where('email', $value)->get()->count() == 0)
					$fail('This email is not registered.');
			}],
			'password' => 'required',
		]);

		if (Auth::guard($request->role)->attempt([
			'email' => $request->email, 
			'password' => $request->password, 
			'is_admin' => false],
			$request->get('remember')
			)) { // true if authentication was successful
			// An authenticated session will be started 
			session(['role' => $request->role]); // to tell which guard is authenticated
			
			$request->session()->regenerate(); // regenerate the user's session to prevent session fixation
			
			$userAvatarId = Auth::guard(session('role'))->user()->avatar_id;
			$userAvatarImagePath = Avatar::where('id', $userAvatarId)->get()->value('image');
			$request->session()->put('userAvatarImagePath', $userAvatarImagePath);

			return redirect()->intended('/');
		}
		
		return back()->withErrors(['login failed' => 'Login failed. The email or password is incorrect.'])
					->withInput(); // with role hidden input
	}

	public function logout(Request $request) {
		Auth::logout(); // will remove the authentication information from the user's session
		$request->session()->invalidate(); //  invalidate the user's session
		$request->session()->regenerateToken(); // regenerate their CSRF token
		// session(['role' => 'guest']);
		session()->forget('role');
        return redirect()->intended('/');
	}
}
