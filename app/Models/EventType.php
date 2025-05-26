<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    protected $fillable = ['name'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value),
            set: fn($value) => strtolower($value),
        );
    }
}
