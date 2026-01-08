<?php

namespace App\Http\Controllers\Payment;

use App\DTO\Webhook\WebhookEventDTO;
use App\Models\WebhookEvent;
use App\Services\Payment\PaymentApprover;
use App\Services\Webhook\WebhookReceiver;
use Illuminate\Http\Request;

final class TestProviderWebhookReceiverController
{
    public function __construct(private WebhookReceiver $webhookReceiver) {}

    public function receive(Request $request)
    {
        $request->validate([
            'correlation_id' => 'required|string',
        ]);

        $paymentId = $request->input('correlation_id');

        $webhookEvent = new WebhookEventDTO(
            operation: 'PAYMENT',
            idempotencyKey: $paymentId,
            provider: 'TEST',
            payload: $request->getContent(),
        );

        $isAlreadyProcessed = $this->webhookReceiver->receiveWebhook($webhookEvent);

        if ($isAlreadyProcessed) {
            return response()->json([
                'error' => 'Webhook already processed.'
            ], 400);
        }
    }
}
