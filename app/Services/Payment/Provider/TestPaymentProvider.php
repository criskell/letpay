<?php

namespace App\Services\Payment;

use App\Contracts\PaymentProviderInterface;
use App\DTO\Payment\ExternalPaymentResponseDTO;
use App\DTO\Payment\PaymentDTO;
use App\DTO\Payment\PaymentSimulationDTO;
use App\DTO\Payment\PixPaymentInstructionsDTO;
use App\Enums\Payment\PaymentMethodEnum;
use Illuminate\Support\Str;

final class TestPaymentProvider implements PaymentProviderInterface
{
    private const FIXED_FEE_IN_CENTS = 60;

    public function getId(): string
    {
        return 'TEST';
    }

    public function getPaymentMethods(): array
    {
        return [PaymentMethodEnum::PIX];
    }

    public function simulatePayment(PaymentDTO $payment): PaymentSimulationDTO
    {
        return new PaymentSimulationDTO(self::FIXED_FEE_IN_CENTS);
    }

    public function createPayment(PaymentDTO $payment): ?ExternalPaymentResponseDTO
    {
        $pixCode = '000201010212261060014br.gov.bcb.pix2584https://api.woovi.com/openpix/testing?transactionID=' . Str::random(48) . '.015802BR5909LOCALHOST6009Sao Paulo62360532867ba5173c734202ac659721306b38c963044BCA';
        $qrCodeImageUrl = 'https://test-payment-provider.criskell.com/qrcodes/' . $payment->idempotencyKey;

        return new ExternalPaymentResponseDTO(
            Str::orderedUuid(),
            new PixPaymentInstructionsDTO(
                pixCode: $pixCode,
                qrCodeImageUrl: $qrCodeImageUrl,
            ),
        );
    }

    public function handleWebhook()
    {
        throw new \Exception('Not implemented');
    }
}
