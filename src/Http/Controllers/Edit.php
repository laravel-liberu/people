<?php

namespace LaravelLiberu\People\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelLiberu\People\Forms\Builders\Person;
use LaravelLiberu\People\Models\Person as Model;

class Edit extends Controller
{
    public function __invoke(Model $person, Person $form)
    {
        return ['form' => $form->edit($person)];
    }
}
