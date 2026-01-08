<?php

namespace App\Contracts;

use App\DTO\Payment\ExternalPaymentResponseDTO;
use App\DTO\Payment\PaymentDTO;
use App\DTO\Payment\PaymentSimulationDTO;

/**
 * A provider offers us a way to create payments using a supported payment method.
 */
interface PaymentProviderInterface
{
    /**
     * Get payment provider ID.
     */
    public function getId(): string;

    /**
     * Simulate a payment, obtaining the fee for example.
     */
    public function simulatePayment(PaymentDTO $payment): PaymentSimulationDTO;

    /**
     * Register a Payment with the provider.
     */
    public function createPayment(PaymentDTO $payment): ?ExternalPaymentResponseDTO;

    /**
     * Receives a raw webhook from the payment provider.
     */
    public function handleWebhook();
}
