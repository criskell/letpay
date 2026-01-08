<?php

namespace App\DTO\Payment;

readonly class PaymentSimulationDTO
{
    public function __construct(public int $feeInCents) {}
}
