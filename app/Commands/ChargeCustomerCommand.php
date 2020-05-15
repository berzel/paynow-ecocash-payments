<?php

namespace App\Commands;

use App\ValueObjects\Money;
use App\ValueObjects\EcoCashNumber;

class ChargeCustomerCommand {
    public $reason;
    public $resultUrl;
    public $customerEmail;

    /**
     * Create a new ChargeCustomerCommand
     *
     * @param EcoCashNumber $number The ecocash number being charged
     * @param Money $money The amount of money being charged
     */
    public function __construct(EcoCashNumber $number, Money $money) {
        $this->amount = $money->getAmount();
        $this->customerNumber = $number->getValue();
    }


    /**
     * The amount of money
     *
     * @var [type]
     */
    private $amount;

    /**
     * Get the amount being charged
     *
     * @return void
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * The customer's ecocashnumber
     *
     * @var [type]
     */
    private $customerNumber;

    /**
     * Get the number of the customer being charged
     *
     * @return void
     */
    public function getCustomerNumber() {
        return $this->customerNumber;
    }
}