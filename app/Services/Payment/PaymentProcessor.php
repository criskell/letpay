<?php

declare(strict_types=1);

namespace App\Services\Payment;

use App\DTO\Payment\PaymentDTO;
use App\DTO\Payment\PaymentResponseDTO;
use App\Enums\Payment\PaymentStatusEnum;
use App\Models\Payment;
use Illuminate\Support\Str;

final class PaymentProcessor
{
    public function __construct(private PaymentRouter $paymentRouter) {}

    public function process(PaymentDTO $paymentDTO)
    {
        $idempotencyKey = $paymentDTO->idempotencyKey;

        if (is_null($idempotencyKey)) {
            $idempotencyKey = Str::uuid7();
        }

        Payment::create([
            'grow_amount_in_cents' => $paymentDTO->amountInCents,
            'status' => PaymentStatusEnum::PENDING,
            'idempotency_key' => $idempotencyKey,
            'method' => $paymentDTO->method,
        ]);

        $providerExternalPayment = $this->paymentRouter->dispatch($paymentDTO);

        if (is_null($providerExternalPayment)) {
            return null;
        }

        return new PaymentResponseDTO($paymentDTO, $providerExternalPayment->paymentMethodInstructions);
    }
}
