<?php

namespace LaravelLiberu\People\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelLiberu\People\Forms\Builders\Person;

class Create extends Controller
{
    public function __invoke(Person $form)
    {
        return ['form' => $form->create()];
    }
}
