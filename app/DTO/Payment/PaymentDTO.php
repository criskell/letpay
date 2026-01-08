<?php

declare(strict_types=1);

namespace App\DTO\Payment;

use JsonSerializable;

final readonly class PaymentDTO implements JsonSerializable
{
    public function __construct(
        public string $method,
        public int $amountInCents,
        public ?string $idempotencyKey,
    ) {}

    public static function fromPayload(array $payload)
    {
        return new self(
            $payload['method'],
            $payload['amount'],
            $payload['idempotencyKey'],
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'method' => $this->method,
            'amount' => $this->amountInCents,
            'idempotencyKey' => $this->idempotencyKey,
        ];
    }
}
