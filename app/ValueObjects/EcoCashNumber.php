<?php

namespace App\ValueObjects;

use InvalidArgumentException;

class EcoCashNumber {

    private $number;

    public function __construct($number) {
        if (strlen($number) !== 10) {
            throw new InvalidArgumentException('EcoCash number should be 10 digits long.');
        }

        $prefix = substr($number, 0, 3);
        if (!in_array($prefix, ['077', '078'])) {
            throw new InvalidArgumentException('EcoCash number should be in the format 077XXXXXXX or 078XXXXXXX');
        }

        $this->number = $number;
    }

    public function getValue() {
        return $this->number;
    }
}