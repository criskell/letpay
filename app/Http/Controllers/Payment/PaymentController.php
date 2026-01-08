<?php

namespace App\Http\Controllers\Payment;

use App\DTO\Payment\PaymentDTO;
use App\Http\Requests\StorePaymentRequest;
use App\Services\Payment\PaymentProcessor;

final class PaymentController
{
    public function __construct(private PaymentProcessor $paymentProcessor) {}

    public function create(StorePaymentRequest $storePayment)
    {
        $payment = PaymentDTO::fromPayload($storePayment->validated());
        $this->paymentProcessor->process($payment);
    }
}
