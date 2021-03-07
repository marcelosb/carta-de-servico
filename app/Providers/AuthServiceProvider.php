<?php

namespace App\Providers;

use App\Models\Faq;
use App\Models\Secretary;
use App\Models\Service;
use App\Policies\FaqPolicy;
use App\Policies\SecretaryPolicy;
use App\Policies\ServicePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Secretary::class => SecretaryPolicy::class,
        Service::class => ServicePolicy::class,
        Faq::class => FaqPolicy::class,
        User::class => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if ($user::isAdministrator()) {
                return true;
            }
        });
    }
}
