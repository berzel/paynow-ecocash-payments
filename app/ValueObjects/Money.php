<?php

namespace App\ValueObjects;

use InvalidArgumentException;

class Money {

    /**
     * Create a new Money instance
     *
     * @param [type] $amount
     * @param [type] $currency
     */
    public function __construct($amount, Currency $currency) {
        $amount = floatval($amount);

        if ( ! is_float($amount)) {
            throw new InvalidArgumentException('Invalid value for money');
        }

        if ($amount < 0.0) {
            throw new InvalidArgumentException('Amount of money can not be less than zero');
        }

        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * The amount of money
     *
     * @var [type]
     */
    private $amount;

    /**
     * Get the amount of this money
     *
     * @return void
     */
    public function getAmount() {
        return $this->amount;
    }
}