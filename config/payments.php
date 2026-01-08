<?php

use App\Services\Payment\Provider\TestPaymentProvider;
use App\Services\Payment\Provider\UnstableTestPaymentProvider;

return [
    'providers' => [
        TestPaymentProvider::class,
        UnstableTestPaymentProvider::class,
    ],
];
