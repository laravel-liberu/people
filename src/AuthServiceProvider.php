<?php

namespace LaravelLiberu\People;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use LaravelLiberu\People\Models\Person;
use LaravelLiberu\People\Policies\Person as Policy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Person::class => Policy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
