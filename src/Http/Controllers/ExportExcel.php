<?php

namespace LaravelLiberu\People\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelLiberu\People\Tables\Builders\Person;
use LaravelLiberu\Tables\Traits\Excel;

class ExportExcel extends Controller
{
    use Excel;

    protected $tableClass = Person::class;
}
