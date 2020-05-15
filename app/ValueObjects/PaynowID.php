<?php

namespace App\ValueObjects;

class PaynowID {

    /**
     * Repressentation of the paynow integration id
     *
     * @param string $value The id as provided by paynow
     */
    public function __construct(string $value) {
        $this->value = $value;
    }

    /**
     * The value of the key as provided by paynow
     *
     * @var [type]
     */
    private $value;

    /**
     * Get the value of the key
     *
     * @return string $value
     */
    public function getValue() {
        return $this->value;
    }
}