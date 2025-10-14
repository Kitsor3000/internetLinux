<?php

namespace App\Providers;

use App\Models\Location;
use App\Models\MissingPerson;
use App\Policies\LocationPolicy;
use App\Policies\MissingPersonPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Location::class => LocationPolicy::class,
        MissingPerson::class => MissingPersonPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
