<?php

declare(strict_types=1);

namespace App\DTO\Payment;

use JsonSerializable;

final readonly class PixPaymentInstructionsDTO implements JsonSerializable
{
    public function __construct(
        // BR Code.
        public string $pixCode,

        // Not all providers return an image for the QR Code.
        public ?string $qrCodeImageUrl = null,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'pixCode' => $this->pixCode,
            'qrCodeImageUrl' => $this->qrCodeImageUrl,
        ];
    }
}
