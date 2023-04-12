<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //Gate::define('adherent', function ($user){
          //  return $user->roles()->where('nom', 'adherent')->exists();
        //});


        Gate::define('administrateur', function ($user) {
            return $user->roles()->where('nom', 'administrateur')->exists();
        });
    }
}
