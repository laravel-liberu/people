<?php

namespace LaravelLiberu\People\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Config;

class Person extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'appellative' => $this->appellative,
            'birthday' => $this->birthday?->format(Config::get('config.liberu.dateFormat')),
            'phone' => $this->phone,
        ];
    }
}
