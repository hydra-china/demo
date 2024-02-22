<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        $userId = backpack_user()->id;

        $myWallet = Wallet::query()->where('user_id', $userId)->first();

        if (!$myWallet) {
            return redirect('verify');
        }

        return view('wallet', [
            'wallet' => $myWallet
        ]);
    }

    public function withdraw()
    {

    }
}
