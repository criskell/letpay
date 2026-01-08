<?php

namespace App\DTO\Payment;

readonly class ExternalPaymentResponseDTO
{
    public function __construct(
        public string $providerId,
        public ?object $paymentMethodInstructions
    ) {}
}
