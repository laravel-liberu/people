<?php

namespace LaravelLiberu\People\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\RoutesNotifications;
use Illuminate\Support\Collection;
use LaravelLiberu\Addresses\Traits\Addressable;
use LaravelLiberu\Companies\Models\Company;
use LaravelLiberu\DynamicMethods\Traits\Relations;
use LaravelLiberu\Helpers\Traits\AvoidsDeletionConflicts;
use LaravelLiberu\Helpers\Traits\CascadesMorphMap;
use LaravelLiberu\Rememberable\Traits\Rememberable;
use LaravelLiberu\Tables\Traits\TableCache;
use LaravelLiberu\TrackWho\Traits\CreatedBy;
use LaravelLiberu\TrackWho\Traits\UpdatedBy;
use LaravelLiberu\Users\Models\User;

class Person extends Model
{
    use Addressable,
        AvoidsDeletionConflicts,
        CascadesMorphMap,
        CreatedBy,
        HasFactory,
        Relations,
        Rememberable,
        RoutesNotifications,
        TableCache,
        UpdatedBy;

    protected $guarded = ['id'];

    protected $casts = [
        'birthday' => 'datetime',
    ];

    protected $touches = ['user'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class)
            ->withPivot(['position', 'is_main']);
    }
    
    public function mandataryFor(): Collection
    {
        return $this->companies()
            ->withPivot('position')
            ->wherePivot('is_mandatary', true)
            ->get();
    }

    public function hasUser()
    {
        return $this->user()->exists();
    }

    public function company()
    {
        return $this->companies->where('pivot.is_main', true)->first();
    }

    public function appellative()
    {
        return $this->appellative ?? $this->name;
    }

    public function position(Company $company)
    {
        return $this->companies()
            ->wherePivot('company_id', $company->id)
            ->first()->pivot->position;
    }

    public function syncCompanies($companyIds, $mainCompanyId)
    {
        $pivotIds = Collection::wrap($companyIds)
            ->reduce(fn ($pivot, $value) => $pivot->put($value, [
                'is_main' => $value === $mainCompanyId,
                'is_mandatary' => $this->mandataryFor()->pluck('id')
                    ->contains($value),
            ]), new Collection());

        $this->companies()->sync($pivotIds->toArray());
    }
}
