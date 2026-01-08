<?php

namespace App\Services\Payment;

use App\DTO\Payment\PaymentDTO;

final class PaymentRouter
{
    public function __construct(private array $providers) {}

    public function dispatch(PaymentDTO $payment) {}
}
