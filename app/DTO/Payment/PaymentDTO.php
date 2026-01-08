<?php

namespace App\DTO\Payment;

readonly class PaymentDTO
{
    public function __construct(public string $idempotencyKey, public int $amountInCents) {}

    public static function fromPayload(array $payload)
    {
        return new self(
            $payload['idempotencyKey'],
            $payload['amount']
        );
    }
}
