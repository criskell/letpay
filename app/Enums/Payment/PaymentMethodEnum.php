<?php

declare(strict_types=1);

namespace App\Enums\Payment;

enum PaymentMethodEnum: string
{
    case CREDIT_CARD = 'CREDIT_CARD';
    case PIX = 'PIX';
}
