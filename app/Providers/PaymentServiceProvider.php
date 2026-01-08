<?php

namespace App\Providers;

use App\Services\Payment\PaymentRouter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

final class PaymentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PaymentRouter::class, function (Application $app) {
            $providers = collect(config('payments.providers'))
                ->map(fn($className) => $app->make($className));

            return new PaymentRouter($providers);
        });
    }
}
