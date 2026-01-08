<?php

namespace App\Services\Webhook;

use App\DTO\Webhook\WebhookEventDTO;
use App\Services\Webhook\Handlers\PaymentApprovedHandler;

final class WebhookDispatcher
{
    private array $handlersByOperation;

    public function __construct(PaymentApprovedHandler $paymentApprovedHandler)
    {
        // Implement a simple jump table. O(1).
        $this->handlersByOperation = [
            'PAYMENT' => $paymentApprovedHandler,
        ];
    }

    public function dispatch(WebhookEventDTO $webhookEventDTO)
    {
        $this->handlersByOperation[$webhookEventDTO->operation]->handle($webhookEventDTO);
    }
}
