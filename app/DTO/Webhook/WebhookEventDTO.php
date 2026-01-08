<?php

namespace App\DTO\Webhook;

final readonly class WebhookEventDTO
{
    public function __construct(
        public string $operation,
        public string $idempotencyKey,
        public string $provider,
        public string $payload,
    ) {}
}
