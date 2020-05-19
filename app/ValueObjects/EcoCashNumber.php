<?php

namespace App\ValueObjects;

use InvalidArgumentException;

class EcoCashNumber {

    private $number;

    /**
     * Create a new ecocash number instance
     *
     * @param [type] $number
     */
    public function __construct($number) {
        $econetNumberPattern = '/^((\+|00)?263|0)?7(7|8)\d{7}$/';
        if ( ! preg_match($econetNumberPattern, $number)) {
            throw new InvalidArgumentException('Invalid ecocash number.');
        }

        $this->number = '0' . substr($number, -9);
    }

    /**
     * Get the number
     *
     * @return void
     */
    public function getValue() {
        return $this->number;
    }
}