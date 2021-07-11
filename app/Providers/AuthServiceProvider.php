<?php

namespace App\Providers;

use App\Models\Roles;
use App\Models\Season;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\SettingsPolicy;
use App\Policies\UserPolicy;
use App\Policies\RolePolicy;
use App\Policies\SeasonPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Roles::class => RolePolicy::class,
        Settings::class => SettingsPolicy::class,
        Season::class => SeasonPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
