<?php

namespace App\Services;

use Exception;
use App\Payment;
use Paynow\Payments\Paynow;
use App\ValueObjects\PaynowID;
use App\ValueObjects\PaynowKey;
use App\TransferObjects\PaymentDto;
use App\Commands\ChargeCustomerCommand;

class PaynowService {

    private $paynowId;
    private $paynowKey;

    /**
     * Create a new PaynowService instance
     *
     * @param string $id
     * @param string $key
     */
    public function __construct(PaynowID $id, PaynowKey $key) {
        $this->paynowId = $id->getValue();
        $this->paynowKey = $key->getValue();
    }

    /**
     * Charge an EcoCash customer
     *
     * @param ChargeCustomerCommand $command
     * @return \App\TransferObjects\PaymentDto
     */
    public function chargeCustomer(ChargeCustomerCommand $command) {
        $paynow = new Paynow($this->paynowId, $this->paynowKey, $returnUrl = '', $command->resultUrl ?? url());

        $payment = new Payment();
        $paynowPayment = $paynow->createPayment("REF-$payment->id", $command->customerEmail ?? 'berzelbtumbude@gmail.com');
        $paynowPayment->add($command->reason ?? 'Item 1', $command->getAmount());

        $response = $paynow->sendMobile($paynowPayment, $command->getCustomerNumber(), 'ecocash');

        if ($response->success()) {
            // TODO: Update the payment details and save to DB
            
            $paymentDto = new PaymentDto();
            $paymentDto->id = $payment->id;
            $paymentDto->status = $payment->status;
            $paymentDto->method = $payment->method;
            $paymentDto->pollUrl = $response->pollUrl();

            return $paymentDto;
        }

        throw new Exception($response->data()['error']);
    }
}