<?php

declare(strict_types=1);

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
     * Get supported payment methods.
     */
    public function getPaymentMethods(): array;

    /**
     * Simulate a payment, obtaining the fee for example.
     */
    public function simulatePayment(PaymentDTO $payment): PaymentSimulationDTO;

    /**
     * Register a Payment with the provider.
     */
    public function process(PaymentDTO $payment): ?ExternalPaymentResponseDTO;

    /**
     * Receives a raw webhook from the payment provider.
     */
    public function handleWebhook();
}
