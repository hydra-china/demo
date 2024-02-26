<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Profile;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        $userId = backpack_user()->id;

        $loan = Loan::query()->where('user_id', $userId)->where('valid', 1)->first();

        if (!$loan) {
            return redirect()->back()->with('error', 'Chưa tạo khoản vay');
        }

        $myWallet = Wallet::query()->where('user_id', $userId)->first();

        $myWallet->setAttribute('account_bank', hide_numbers($myWallet->getAttribute('account_bank')));

        return view('wallet', [
            'wallet' => $myWallet
        ]);
    }

    public function withdraw()
    {
    }
}
