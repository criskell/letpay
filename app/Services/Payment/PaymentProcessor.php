<?php

namespace App\Services\Payment;

use App\DTO\Payment\PaymentDTO;
use App\Models\Payment;

final class PaymentProcessor
{
    public function __construct(private final PaymentRouter $paymentRouter) {}

    public function process(PaymentDTO $payment)
    {
        $payment = Payment::create([
            'amount_in_cents' => $payment->amountInCents,
        ]);

        $providerExternalPayment = $this->paymentRouter->dispatch($payment);
    }
}
