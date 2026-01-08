<?php

namespace App\DTO\Payment;

readonly class PixPaymentInstructionsDTO
{
    public function __construct(
        // BR Code.
        public string $pixCode,

        // Not all providers return an image for the QR Code.
        public ?string $qrCodeImageUrl = null,
    ) {}
}
