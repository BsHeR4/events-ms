<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    protected $fillable = [
        'governorate',
        'street',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->ofMany('created_at', 'max');
    }

    protected function governorate():Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value),
            set: fn($value) => strtolower($value),
        );
    }

    protected function street():Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value),
            set: fn($value) => strtolower($value),
        );
    }
}
