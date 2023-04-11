<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

		Gate::define('hasLogined', function($user) {
			$guards = ['admin', 'student'];

			foreach ($guards as $guard)
            	if (Auth::guard($guard)->check())
					return true;

			return false;
		});

		Gate::define('isAdmin', function(User $user) {
			return $user->is_admin == 1
			? Response::allow()
            : Response::denyAsNotFound();
		});
	}
}