<?php

declare(strict_types=1);

namespace App\DTO\Payment;

final readonly class PaymentSimulationDTO
{
    public function __construct(public int $feeInCents) {}
}
