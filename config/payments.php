<?php

use App\Services\Payment\TestPaymentProvider;
use App\Services\Payment\UnstableTestPaymentProvider;

return [
    'providers' => [
        TestPaymentProvider::class,
        UnstableTestPaymentProvider::class,
    ],
];
