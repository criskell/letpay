<?php

declare(strict_types=1);

namespace App\Services\Payment;

use App\Contracts\PaymentProviderInterface;
use App\DTO\Payment\PaymentDTO;
use App\Enums\Payment\PaymentMethodEnum;
use Illuminate\Support\Collection;

final class PaymentRouter
{
    public function __construct(private Collection $providers) {}

    public function dispatch(PaymentDTO $payment)
    {
        /** @var PaymentProviderInterface $provider */
        $provider = $this->providers
            ->filter(
                fn(PaymentProviderInterface $provider) =>
                in_array(PaymentMethodEnum::tryFrom($payment->method), $provider->getPaymentMethods())
            )
            ->sort(function (PaymentProviderInterface $provider) use ($payment) {
                $simulation = $provider->simulatePayment($payment);

                return $simulation->feeInCents;
            })
            ->first();

        if (!$provider) {
            return null;
        }

        $response = $provider->process($payment);

        if (!$response) {
            return null;
        }

        return $response;
    }
}
