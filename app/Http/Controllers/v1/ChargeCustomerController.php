<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Services\PaynowService;
use App\Http\Controllers\Controller;
use App\Commands\ChargeCustomerCommand;
use App\Http\Requests\Rules\ValidEcocashNumber;

class ChargeCustomerController extends Controller {

    /**
     * The PaynowService instance
     *
     * @var [type]
     */
    private $paynowService;

    /**
     * Create a new controller instance
     *
     * @param PaynowService $paynowService
     */
    public function __construct(PaynowService $paynowService) {
        $this->paynowService = $paynowService;
    }

    /**
     * Charge a customer
     *
     * @param Request $request
     * @return void
     */
    public function __invoke(Request $request){
        $validated = $this->validate($request, [
            'amount' => ['required'],
            'reason' => ['nullable', 'max:160'],
            'result_url' => ['nullable', 'url'],
            'customer_email' => ['nullable', 'email'],
            'customer_number' => ['required', new ValidEcocashNumber],
        ]);

        $command = new ChargeCustomerCommand();
        $command->amount = $validated['amount'];
        $command->reason = $validated['reason'] ?? null;
        $command->resultUrl = $validated['result_url'] ?? null;
        $command->customerNumber = $validated['customer_number'];
        $command->customerEmail = $validated['customer_email'] ?? null;

        $payment = $this->paynowService->chargeCustomer($command);

        return response()->json([
            'id' =>$payment->id,
            'status' => $payment->status,
            'method' => $payment->method,
            'poll_url' => $payment->pollUrl
        ], 201);
    }
}