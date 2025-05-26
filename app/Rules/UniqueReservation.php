<?php

namespace App\Rules;

use App\Models\Reservation;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueReservation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exists = Reservation::where('user_id', auth()->id())
            ->where('event_id', $value)
            ->exists();

            if($exists)
            $fail('You are already regestired for this event');
    }
}
