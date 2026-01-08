<?php

declare(strict_types=1);

namespace App\Services\Payment;

use App\Enums\Payment\PaymentStatusEnum;
use App\Models\Payment;

final class PaymentApprover
{
    public function approve(string $paymentId)
    {
        Payment::where('idempotency_key', $paymentId)->update([
            'status' => PaymentStatusEnum::APPROVED,
        ]);
    }
}
