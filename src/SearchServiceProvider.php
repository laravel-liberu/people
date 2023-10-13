<?php

namespace LaravelLiberu\People;

use LaravelLiberu\People\Models\Person;
use LaravelLiberu\Searchable\SearchServiceProvider as ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    public $register = [
        Person::class => [
            'group' => 'Person',
            'attributes' => ['name', 'appellative', 'email', 'phone'],
            'label' => 'name',
            'permissionGroup' => 'administration.people',
        ],
    ];
}
