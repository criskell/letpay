<?php

use App\Http\Controllers\Payment\PaymentController;
use Illuminate\Support\Facades\Route;

Route::post('/payments', [PaymentController::class, 'create']);
