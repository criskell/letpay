<?php

declare(strict_types=1);

namespace App\DTO\Payment;

use JsonSerializable;

final readonly class PaymentResponseDTO implements JsonSerializable
{
    public function __construct(
        public PaymentDTO $payment,
        public ?object $paymentMethodInstructions
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'payment' => $this->payment,
            'instructions' => $this->paymentMethodInstructions,
        ];
    }
}
