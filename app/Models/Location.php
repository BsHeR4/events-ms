<?php

namespace App\Models;

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
        return $this->morphOne(Image::class, 'imageable');
    }
    
}
