<?php

namespace App\ValueObjects;

use Exception;

class Currency {
    public function __construct(string $value) {
        $validCurrencies = ['USD', 'RTGS'];

        if ( ! in_array($value, $validCurrencies)) {
            throw new Exception('Not valid currency');
        }

        $this->value = $value;
    }

    private $value;

    public function getValue() {
        return $this->value;
    }

    public static function RTGS() {
        return new Currency('RTGS');
    }
}