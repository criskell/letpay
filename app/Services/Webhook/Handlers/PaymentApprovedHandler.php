<?php

namespace App\Services\Webhook\Handlers;

use App\Contracts\WebhookHandlerInterface;
use App\DTO\Webhook\WebhookEventDTO;
use App\Services\Payment\PaymentApprover;

final class PaymentApprovedHandler implements WebhookHandlerInterface
{
    public function __construct(private PaymentApprover $paymentApprover) {}

    public function handle(WebhookEventDTO $webhookEventDTO): void
    {
        $this->paymentApprover->approve($webhookEventDTO->idempotencyKey);
    }
}
