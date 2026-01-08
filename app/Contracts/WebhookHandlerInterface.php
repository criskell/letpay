<?php

namespace App\Contracts;

use App\DTO\Webhook\WebhookEventDTO;

interface WebhookHandlerInterface
{
    public function handle(WebhookEventDTO $webhookEventDTO): void;
}
