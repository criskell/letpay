<?php

declare(strict_types=1);

namespace App\DTO\Payment;

final readonly class ExternalPaymentResponseDTO
{
    public function __construct(
        public string $provider,
        public string $providerId,
        public int $feeInCents,
        public ?object $paymentMethodInstructions
    ) {}
}
