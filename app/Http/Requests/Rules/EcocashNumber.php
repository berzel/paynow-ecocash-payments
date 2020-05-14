<?php

namespace App\Http\Requests\Rules;

use Illuminate\Contracts\Validation\Rule;

class EcocashNumber implements Rule {

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $number
     * @return bool
     */
    public function passes($attribute, $number) {
        return strlen($number) == 10 && intval(str_split($number)[2]) >= 7;
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message() {
        return 'The :attribute must be a valid ecocash number in the format 0777777777.';
    }
}