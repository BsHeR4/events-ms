<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailRule implements ValidationRule
{
    /**
     * Run the validation rule which it make sure that the email shuld be
     * a valid email address by contain:
     * - latin letters
     * - numbers
     * - `@`
     * - `.`
     * @example Format E-mail: 'user@examplee.com`
     * 
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^.*(?=[a-z)(?=.*[\d\x])(?=.*[@])(?=.*[.]).*$/', $value)) {
            $fail("Invalid email address. Valid e-mail can contain only latin letters, numbers, '@' and '.',  Format Example: user@example.com");
        }
    }
}
