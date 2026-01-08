<?php

namespace App\Http\Controllers\Payment;

use App\Services\Payment\PaymentApprover;
use Illuminate\Http\Request;

final class TestProviderWebhookReceiverController
{
    public function __construct(private PaymentApprover $paymentApprover) {}

    public function receive(Request $request)
    {
        $request->validate([
            'correlation_id' => 'required|string',
        ]);

        $paymentId = $request->input('correlation_id');

        $this->paymentApprover->approve($paymentId);
    }
}
