<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'amount' => 'required|integer',
            'method' => 'required|in:PIX'
        ];
    }
}
