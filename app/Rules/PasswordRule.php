<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordRule implements ValidationRule
{
    /**
     * Run the validation rule which it make sure that the password should be
     * a strong password by contain at least:
     * - one number
     * - Non-alphanumeric (!@#$%^&*)
     * - and both uppercase and lowercase letters
     * @example Format Password: Bsher@123
     * 
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!preg_match('/^.*(?=[a-z)(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@#$%^&*]).*$/',$value))
        {
            $fail('Password must contain at least one number and Non-alphanumeric (!@#$%^&*) and both uppercase and lowercase letters.');
        }
    }
}
