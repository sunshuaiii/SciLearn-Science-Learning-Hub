<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
	/**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$guards)
    {
		// register in app\Http\Kernel under global/group/route
		// group/route middleware need to declare in routes\web also
		// if ($request->session()->has('user')) // null value will return false
		// if (Auth::check()) // does not work

		$guards = empty($guards) ? ['admin', 'student'] : $guards;

		foreach ($guards as $guard)
            if (Auth::guard($guard)->check())
				return $next($request);

        return redirect('/login/student');
    }
}
