<?php

namespace App\ValueObjects;

class PaynowKey {

    /**
     * Repressentation of the paynow key
     *
     * @param string $value The key as provided by paynow
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