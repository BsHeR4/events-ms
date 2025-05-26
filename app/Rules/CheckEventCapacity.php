<?php

namespace App\Rules;

use App\Models\Event;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckEventCapacity implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $event = Event::withCount('reservations')->findOrFail($value);
        if (!is_null($event->max_member) && $event->reservations_count >= $event->max_member)
            $fail('Sorry, this event has reached the maximum number of members');
    }
}
