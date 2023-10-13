<?php

namespace LaravelLiberu\People\Tables\Builders;

use Illuminate\Database\Eloquent\Builder;
use LaravelLiberu\Helpers\Services\Obj;
use LaravelLiberu\People\Models\Person as Model;
use LaravelLiberu\Tables\Contracts\CustomFilter;
use LaravelLiberu\Tables\Contracts\Table;

class Person implements Table, CustomFilter
{
    private const TemplatePath = __DIR__.'/../Templates/people.json';

    public function query(): Builder
    {
        return Model::selectRaw('
            people.id, people.name, people.appellative, people.email, people.phone,
            people.birthday, CASE WHEN users.id is null THEN 0 ELSE 1 END as "user",
            companies.name as company, people.created_at
        ')->leftJoin('users', 'people.id', '=', 'users.person_id')
            ->leftJoin(
                'company_person',
                fn ($join) => $join
                    ->on('people.id', '=', 'company_person.person_id')
                    ->where('company_person.is_main', true)
            )->leftJoin('companies', 'company_person.company_id', 'companies.id');
    }

    public function filterApplies(Obj $params): bool
    {
        return $params->get('user')?->filled('exists') ?? false;
    }

    public function filter(Builder $query, Obj $params)
    {
        return $query->when(
            $params->get('user')->get('exists'),
            fn ($query) => $query->whereNotNull('users.id'),
            fn ($query) => $query->whereNull('users.id')
        );
    }

    public function templatePath(): string
    {
        return self::TemplatePath;
    }
}
