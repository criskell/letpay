<?php

use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Payment\TestProviderWebhookReceiverController;
use Illuminate\Support\Facades\Route;

Route::post('/payments', [PaymentController::class, 'create']);
Route::post('/webhooks/providers/test', [TestProviderWebhookReceiverController::class, 'receive']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
});
