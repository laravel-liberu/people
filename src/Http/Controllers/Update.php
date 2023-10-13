<?php

namespace LaravelLiberu\People\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelLiberu\People\Http\Requests\ValidatePerson;
use LaravelLiberu\People\Models\Person;

class Update extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidatePerson $request, Person $person)
    {
        $this->authorize('update', [$person, $request->get('companies')]);

        tap($person)->update($request->validatedExcept('companies', 'company'))
            ->syncCompanies(
                $request->get('companies'),
                $request->get('company')
            );

        return ['message' => __('The person was successfully updated')];
    }
}
