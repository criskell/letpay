<?php

namespace App\Services\Payment;

use App\Contracts\PaymentProviderInterface;
use App\DTO\Payment\ExternalPaymentResponseDTO;
use App\DTO\Payment\PaymentDTO;
use App\DTO\Payment\PaymentSimulationDTO;
use App\DTO\Payment\PixPaymentInstructionsDTO;
use App\Enums\Payment\PaymentMethodEnum;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Str;
use GuzzleHttp\Psr7\Response as PsrResponse;

/**
 * Payment provider for testing payment attempt failures and retries.
 * 
 * There is a 50% chance of it failing.
 */
final class UnstableTestPaymentProvider implements PaymentProviderInterface
{
    private const FIXED_FEE_IN_CENTS = 10;

    public function getId(): string
    {
        return 'UNSTABLE_TEST';
    }

    public function getPaymentMethods(): array
    {
        return [PaymentMethodEnum::PIX, PaymentMethodEnum::CREDIT_CARD];
    }

    public function simulatePayment(PaymentDTO $payment): PaymentSimulationDTO
    {
        return new PaymentSimulationDTO(self::FIXED_FEE_IN_CENTS);
    }

    public function createPayment(PaymentDTO $payment): ?ExternalPaymentResponseDTO
    {
        $response = $this->createMockedResponse();

        if ($response->failed()) {
            return null;
        }

        $responseBody = $response->json();

        ['pixCode' => $pixCode, 'id' => $providerExternalPaymentId] = $responseBody['data'];

        return new ExternalPaymentResponseDTO(
            $providerExternalPaymentId,
            new PixPaymentInstructionsDTO(pixCode: $pixCode),
        );
    }

    public function handleWebhook()
    {
        throw new \Exception('Not implemented');
    }

    private function createMockedResponse(): Response
    {
        $isFailed = random_int(0, 1) == 0;

        if ($isFailed) {
            return new Response(
                new PsrResponse(
                    status: 500,
                    headers: [],
                    body: json_encode([
                        'error' => 'Failed to generate PIX',
                    ])
                )
            );
        }

        $pixCode = $this->generateRandomPixCode();

        return new Response(
            new PsrResponse(
                status: 200,
                headers: [],
                body: json_encode([
                    'data' => [
                        'id' => Str::orderedUuid(),
                        'pixCode' => $pixCode,
                    ],
                ])
            )
        );
    }

    private function generateRandomPixCode(): string
    {
        return '000201010212261060014br.gov.bcb.pix2584https://api.unstable-provider.com/unstable/testing?transaction='
            . Str::random(48)
            . '.015802BR5909LOCALHOST6009Sao Paulo62360532867ba5173c734202ac659721306b38c963044BCA';
    }
}
