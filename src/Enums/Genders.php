<?php

namespace LaravelEnso\People\Enums;

use LaravelEnso\Enums\Services\Enum;

class Genders extends Enum
{
    final public const Female = 1;
    final public const Male = 2;

    protected static array $data = [
        self::Female => 'female',
        self::Male => 'male',
    ];
}
