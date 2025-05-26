<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Event extends Model
{
    use Prunable;

    protected $fillable = [
        'name',
        'description',
        'max_member',
        'start_time',
        'end_time',
        'user_id',
        'organizer_id',
        'event_type_id',
        'location_id',
    ];

    protected $with = [
        'organizer',
        'location',
        'eventType',
        'image'
    ];

    /**
     * Get the model query that determines which records should be pruned
     *
     * This will prune all events whose `end_time` is more than one day in the past
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function prunable()
    {
        return $this->whereDate('end_time', '<', now()->subDays(1));
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'reservations');
    }

    public function organizer()
    {
        return $this->belongsTo(User::class);
    }


    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->ofMany('created_at', 'max');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function ScopeUsersEvents($query, $userId)
    {
        return $query->whereHas('users', function ($q) use ($userId) {
            return $q->where('users.id', $userId);
        })->with(['organizer', 'location', 'eventType', 'image']);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value),
            set: fn($value) => strtolower($value),
        );
    }

    /**
     * this contain a global scope to ensure 
     * that the event always equal today or a future day
     */
    protected static function booted()
    {
        static::addGlobalScope('start_time', function (Builder $builder) {
            $builder->where('start_time', '>=', now());
        });
    }
}
