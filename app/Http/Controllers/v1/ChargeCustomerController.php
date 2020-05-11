<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Paynow\Payments\Paynow;

class ChargeCustomerController extends Controller {

    public function __invoke(Request $request){
        $validated = $this->validate($request, [
            'paynow_integration_id' => ['required', 'numeric'],
            'paynow_integration_key' => ['required'],
            'customer_number' => ['required'],
            'amount' => ['required']
        ]);

        $paynow = new Paynow(
            $validated['paynow_integration_id'],
            $validated['paynow_integration_key'],
            'http://example.com/gateways/paynow/update',
            'http://example.com/return?gateway=paynow'
        );

        $payment = $paynow->createPayment('REF-45', 'berzelbtumbude@gmail.com');
        $payment->add('Some item name', $validated['amount']);

        $response = $paynow->sendMobile($payment, $validated['customer_number'], 'ecocash');

        if ($response->success()) {
            return response()->json([
                'id' => rand(100, 9999),
                'status' => 'Created',
                'method' => 'EcoCash',
                'poll_url' => $response->pollUrl()
            ], 201);
        }

        return response()->json($validated);
    }
}