<?php

namespace App\Services\Webhook;

use App\DTO\Webhook\WebhookEventDTO;
use App\Models\WebhookEvent;
use Illuminate\Database\UniqueConstraintViolationException;

final class WebhookReceiver
{
    public function __construct(private WebhookDispatcher $webhookDispatcher) {}

    public function receiveWebhook(WebhookEventDTO $webhookDTO): bool
    {
        try {
            WebhookEvent::create([
                'operation' => $webhookDTO->operation,
                'idempotency_key' => $webhookDTO->idempotencyKey,
                'provider' => $webhookDTO->provider,
                'payload' => $webhookDTO->payload,
            ]);
        } catch (UniqueConstraintViolationException $e) {
            // Idempotency is implemented here.
            // We sign that webhook is already processed.
            return true;
        }

        $this->webhookDispatcher->dispatch($webhookDTO);

        return false;
    }
}
