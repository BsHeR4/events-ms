<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'start_time',
        'end_time',
        'user_id',
        'event_type_id',
        'location_id',
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class);
    }


    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function EventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
