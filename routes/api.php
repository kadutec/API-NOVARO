<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController;

Route::get('/wallets', [WalletController::class, 'show']);

// Route::get('/wallets', function () {
//     return 'hello';
// });
Route::post('/wallets', [WalletController::class, 'deposit']);
Route::post('/wallets/withdrawal', [WalletController::class, 'withdrawal']);
Route::post('/wallets/transfer', [WalletController::class, 'transfer']);