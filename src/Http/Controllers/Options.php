<?php

namespace LaravelLiberu\People\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelLiberu\People\Models\Person;
use LaravelLiberu\Select\Traits\OptionsBuilder;

class Options extends Controller
{
    use OptionsBuilder;

    protected $model = Person::class;

    protected $queryAttributes = ['name', 'appellative', 'nin', 'phone'];
}
