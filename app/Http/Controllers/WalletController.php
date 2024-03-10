<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Profile;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdraw;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $title = "Rút tiền thất bại";

        $action = false;

        if ($myWallet['reason'] == 'Rút tiền về tài khoản ngân hàng thành công') {
            $title = 'Rút tiền thành công';
            $action = true;
        }

        return view('wallet', [
            'wallet' => $myWallet,
            'title' => $title,
            'action' => true,
            'bg' =>  $action ? "text-success" : "text-danger"
        ]);
    }

    public function withdraw(Request $request)
    {
        $amount = $request->get('amount');

        $user = User::query()->where('id', backpack_user()->id)->firstOrFail();

        $wallet = Wallet::query()->where('user_id', $user['id'])->firstOrFail();

        $wallet->update([
            'reason' => 'Điểm tín dụng không đủ'
        ]);

        Withdraw::query()->create([
            'amount' => $amount,
            'wallet_id' => $wallet['id'],
            'phone' => $user['username'],
            'status' => 0,
        ]);

    }

    public function checkWithdraw(): JsonResponse
    {
        $user = User::query()->where('id', backpack_user()->id)->firstOrFail();

        $wallet = Wallet::query()->where('user_id', $user['id'])->firstOrFail();

        $withdraw = Withdraw::query()->where([
            'wallet_id' => $wallet['id'],
            'phone' => $user['username'],
            'status' => 0
        ])->exists();

        if ($withdraw) {
            return response()->json([], 400);
        }

        return response()->json([
            'status' => 'oke'
        ]);
    }
}
