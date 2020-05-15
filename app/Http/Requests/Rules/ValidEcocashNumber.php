<?php

namespace App\Http\Requests\Rules;

use InvalidArgumentException;
use App\ValueObjects\EcoCashNumber;
use Illuminate\Contracts\Validation\Rule;

class ValidEcocashNumber implements Rule {

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $number
     * @return bool
     */
    public function passes($attribute, $number) {
        try {
            new EcoCashNumber($number);
            return true;
        }

        catch (InvalidArgumentException $exception) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message() {
        return 'The :attribute must be a valid ecocash number in the format 077XXXXXXX.';
    }
}