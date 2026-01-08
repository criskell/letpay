<?php

declare(strict_types=1);

namespace App\Enums\Payment;

enum PaymentStatusEnum: string
{
    case PENDING = 'PENDING';
    case FAILED = 'FAILED';
    case APPROVED = 'APPROVED';
}
