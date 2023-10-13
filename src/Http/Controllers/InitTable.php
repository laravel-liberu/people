<?php

namespace LaravelLiberu\People\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelLiberu\People\Tables\Builders\Person;
use LaravelLiberu\Tables\Traits\Init;

class InitTable extends Controller
{
    use Init;

    protected $tableClass = Person::class;
}
