<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payment;

use App\DTO\Payment\PaymentDTO;
use App\Http\Requests\Payment\StorePaymentRequest;
use App\Services\Payment\PaymentProcessor;

final class PaymentController
{
    public function __construct(private PaymentProcessor $paymentProcessor) {}

    public function create(StorePaymentRequest $request)
    {
        $idempotencyKey = $request->header('X-Idempotency-Key');

        $payment = PaymentDTO::fromPayload($request->validated() + [
            'idempotencyKey' => $idempotencyKey,
        ]);

        $responseDTO = $this->paymentProcessor->process($payment);

        if (!$responseDTO) {
            return response()->json([
                'error' => 'Failed to process a payment.',
            ]);
        }

        return $responseDTO;
    }
}
