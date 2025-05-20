<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use Illuminate\Validation\ValidationException;

class WalletController extends Controller
{
    public function show()
    {
        $wallet = Wallet::first();

        if (!$wallet) {
            try {
                $wallet = Wallet::create(['balance' => 0]);
            } catch (\Exception $e) {
                return response()->json([
                    'walletId' => 1,
                    'balance' => 0,
                    'note' => 'wallet criada virtualmente porque houve falha ao salvar no banco',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }

        return response()->json([
            'walletId' => $wallet->id,
            'balance' => $wallet->balance,
        ]);
    }

    public function deposit(Request $request)
    {
        try {
            $request->validate([
                'amount' => 'required|numeric|min:0.01',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'mensagem' => 'O valor para depósito tem que ser maior que 0'
            ], 422);
        }

        $wallet = Wallet::first() ?? Wallet::create(['balance' => 0]);
        $wallet->balance += $request->amount;
        $wallet->save();

        return response()->json([
            'mensagem' => 'Depósito realizado com sucesso',
            'newBalance' => $wallet->balance,
        ]);
    }

    public function withdrawal(Request $request)
    {
        try {
            $request->validate([
                'amount' => 'required|numeric|min:0.01',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'mensagem' => 'O valor para saque tem que ser maior que 0.'
            ], 422);
        }

        $wallet = Wallet::first() ?? Wallet::create(['balance' => 0]);
        $amount = $request->input('amount');

        if ($amount > $wallet->balance) {
            return response()->json([
                'mensagem' => 'Saldo insuficiente para realizar o saque. Seu saldo atual é: ' . $wallet->balance,
            ], 400);
        }

        $wallet->balance -= $amount;
        $wallet->save();

        return response()->json([
            'mensagem' => 'Saque realizado com sucesso',
            'newBalance' => $wallet->balance,
        ]);
    }

    public function transfer(Request $request)
    {
        try {
            $request->validate([
                'amount' => 'required|numeric|min:0.01',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'mensagem' => 'O valor para transferencia tem que ser maior que 0.',
            ], 422);
        }

        $amount = $request->input('amount');

        $originWallet = Wallet::first() ?? Wallet::create(['balance' => 0]);

        if ($originWallet->balance < $amount) {
            return response()->json([
                'mensagem' => 'Saldo insuficiente para realizar a transferência',
            ], 400);
        }

        // aqui eu optei por fazer uma transferencia simulada, pegando apenas um id do usuario diferente do original...

        $destinationWallet = Wallet::where('id', '!=', $originWallet->id)->first();

        if (!$destinationWallet) {
            $destinationWallet = Wallet::create(['balance' => 0]);
        }

        $originWallet->balance -= $amount;
        $destinationWallet->balance += $amount;

        $originWallet->save();
        $destinationWallet->save();

        return response()->json([
            'mensagem' => 'Transferência realizada com sucesso',
            'valorTransferencia' => $amount,
            'saldoOriginal' => $originWallet->balance,
            'ValorDestinatario' => $destinationWallet->balance,
        ]);
    }
}
