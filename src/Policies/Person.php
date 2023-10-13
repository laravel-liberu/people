<?php

namespace LaravelLiberu\People\Policies;

use LaravelLiberu\People\Models\Person as Model;
use LaravelLiberu\Users\Models\User;

class Person
{
    public function before(User $user)
    {
        if ($user->isAdmin() || $user->isSupervisor()) {
            return true;
        }
    }

    public function store(User $user, Model $model, array $companies)
    {
        return true;
    }

    public function update(User $user, Model $model, array $companies)
    {
        return true;
    }

    public function destroy(User $user, Model $model)
    {
        return true;
    }
}
